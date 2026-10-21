<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Admin\Glass;
use App\Models\Admin\ProductVariants;
use App\Models\AttributeType;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminProductsController extends Controller
{
    /** Return all products */
    public function index()
    {
        $products = Product::with(['categories', 'attributeValues', 'prices'])
            ->latest()
            ->paginate(15);

        return view('admin.Products.Index', compact('products'));
    }

    /** Return the category tree
     *
     * @param Collection $categories
     * @param string $parentPath
     * @return array[]
     */
    private function flattenCategoryTree($categories, $parentPath = ''): array
    {
        $tree = [];

        foreach ($categories as $category) {

            $currentPath = $parentPath ? $parentPath . ' → ' . $category->name : $category->name;

            $tree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'path' => $currentPath,
            ];

            if ($category->children && $category->children->count()) {
                $tree = array_merge($tree, $this->flattenCategoryTree($category->children, $currentPath));
            }
        }

        return $tree;
    }

    /** Create the product view */
    public function createProductView()
    {
        $categories = Category::with('children')
            ->whereNull('category_parent_id')
            ->get();

        $categories = $this->flattenCategoryTree($categories);

        $attributeTypes = AttributeType::with('values')
            ->orderBy('name')
            ->get();

        return view('admin.Products.CreateProductView', [
            'categories'     => $categories,
            'attributeTypes' => $attributeTypes,
        ]);
    }

    /**
     * Show the product.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        $product = Product::with([
            'prices',
            'categories',
            'attributeValues',
            'variants',
            'variantParent',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $categories = Category::with('children')
            ->whereNull('category_parent_id')
            ->get();

        $categories = $this->flattenCategoryTree($categories);

        $attributeTypes = AttributeType::with('values')
            ->orderBy('name')
            ->get();

        $selectedAttributeValueIds = $product->attributeValues
            ->pluck('id')
            ->toArray();

        $selectedAttributes = [];

        foreach ($product->attributeValues as $attributeValue) {
            $selectedAttributes[$attributeValue->attribute_type_id] = $attributeValue->value;
        }



        return view('admin.Products.Show', [
            'product'                   => $product,
            'categories'                => $categories,
            'attributeTypes'            => $attributeTypes,
            'selectedAttributeValueIds' => $selectedAttributeValueIds,
            'selectedAttributes'        => $selectedAttributes,
        ]);
    }

    /** Create the product and a variation if $product is not null
     *
     * @param CreateProductRequest $request
     * @param Product|null $product
     * @return RedirectResponse
     */
    public function create(CreateProductRequest $request, ?Product $product = null): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $parentProduct = $product;

            $slug = Str::slug($validated['name']) . '-' . Str::slug($validated['sku']);

            if (Product::where('slug', $slug)->exists()) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'name' => 'Вече съществува продукт със същото име/SKU.',
                    ]);
            }

            // Upload the main image
            $mainImageName = ImageService::uploadSingleImage($request->file('main_image'), '/assets/images/products');
            $galleryNames  = ImageService::uploadGalleryImages($request->file('gallery'), '/assets/images/product_gallery');

            $createdProduct = Product::create([
                'name'        => $validated['name'],
                'sku'         => $validated['sku'],
                'slug'        => $slug,
                'video_link'  => $validated['video_link'],
                'discount'    => $validated['discount'],
                'description' => $validated['description'],
                'stock'       => $validated['stock'],
                'main_image'  => $mainImageName,
                'category_id' => $validated['category_id'],
                'gallery'     => $galleryNames,
            ]);

            $category = Category::with('parent')
                ->findOrFail($validated['category_id']);

            $categoriesToInsert = [];

            while ($category) {
                $categoriesToInsert[] = $category->id;
                $category = $category->parent;
            }

            foreach ($categoriesToInsert as $categoryId) {
                ProductCategory::create([
                    'product_id'  => $createdProduct->id,
                    'category_id' => $categoryId,
                ]);
            }


            $attributeValueNames = array_values(array_filter($request->input('attribute_values', [])));
            $attributeValueIds = AttributeValue::whereIn('value', $attributeValueNames)
                ->pluck('id')
                ->toArray();

            $createdProduct->attributeValues()->attach($attributeValueIds);


            if ($parentProduct) {
                ProductVariants::create([
                    'parent_product_id'  => $parentProduct->id,
                    'variant_product_id' => $createdProduct->id,
                ]);

                return back()->with(
                    'success',
                    'Вариантът беше добавен успешно!'
                );
            }

            return redirect()
                ->route('admin.products.show', $createdProduct->slug)
                ->with('success', 'Продуктът беше добавен успешно!');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'create_product' => $e->getMessage(),
                ]);
        }
    }


    /**
     * Update the product
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        try {
            $validated = $request->validated();

            $slug = Str::slug($validated['name']) . '-' . Str::slug($validated['sku']);

            $mainImageName = $product->main_image;

            if ($request->hasFile('main_image')) {
                if ($product->main_image) {
                    $oldPath = public_path('/assets/images/products/' . $product->main_image);

                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $mainImageName = ImageService::uploadSingleImage($request->file('main_image'), '/assets/images/products');
            }

            // === GALLERY ===
            $galleryNames = $product->gallery ?? [];

            if ($request->hasFile('gallery')) {

                $newGalleryNames = ImageService::uploadGalleryImages(
                    $request->file('gallery'),
                    '/assets/images/product_gallery'
                );

                $galleryNames = array_merge($galleryNames, $newGalleryNames);
            }

            $product->update([
                'name'        => $validated['name'],
                'sku'         => $validated['sku'],
                'slug'        => $slug,
                'discount'    => $validated['discount'],
                'description' => $validated['description'],
                'video_link'  => $validated['video_link'],
                'stock'       => $validated['stock'],
                'main_image'  => $mainImageName,
                'category_id' => $validated['category_id'],
                'gallery'     => $galleryNames,
            ]);

            $categoryIds = [];

            $category = Category::with('parent')->findOrFail($validated['category_id']);

            while ($category) {
                $categoryIds[] = $category->id;
                $category = $category->parent;
            }

            $product->categories()->sync($categoryIds);


            $attributeValueNames = array_values(array_filter($request->input('attribute_values', [])));
            $attributeValueIds = AttributeValue::whereIn('value', $attributeValueNames)
                ->pluck('id')
                ->toArray();

            $product->attributeValues()->sync($attributeValueIds);

            return redirect(route('admin.products.show', $product->slug))
                ->with('success', 'Продуктът беше обновен успешно!');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'create_product' => $e->getMessage(),
                ]);
        }
    }



    /** Delete a product
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Продуктът беше изтрит.');
    }


    /**
     * Create a single quantity-based price for a product.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPrice(Request $request, Product $product)
    {
        $validated = $request->validate([
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        ProductPrice::create([
            'product_id' => $product->id,
            'min_quantity' => $validated['min_quantity'],
            'max_quantity' => $validated['max_quantity'] ?? null,
            'price' => $validated['price'],
        ]);

        $prices = ProductPrice::where('product_id', $product->id)
            ->orderBy('min_quantity')
            ->get();

        $html = view('admin.components.create-product-pricing', ['prices' => $prices])->render();

        return response()->json([
            'success' => true,
            'message' => 'Цената беше добавена успешно!',
            'html' => $html,
        ]);
    }


    /**
     * Update an existing product price.
     *
     * Updates a single price record and returns the refreshed
     * pricing component as HTML in a JSON response.
     *
     * @param Request $request
     * @param ProductPrice $productPrice
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePrice(Request $request, ProductPrice $productPrice)
    {
        $validated = $request->validate([
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $productPrice->update($validated);

        $prices = ProductPrice::where('product_id', $productPrice->product_id)
            ->orderBy('min_quantity')
            ->get();

        $html = view('admin.components.create-product-pricing', [
            'prices' => $prices,
        ])->render();

        return response()->json([
            'success' => true,
            'message' => 'Цената беше редактирана успешно!',
            'html' => $html,
        ]);
    }


    /**
     * Delete an existing product price.
     *
     * Deletes a single price record and returns the refreshed
     * pricing component as HTML in a JSON response.
     *
     * @param ProductPrice $productPrice
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePrice(ProductPrice $productPrice)
    {
        $productId = $productPrice->product_id;

        $productPrice->delete();

        $prices = ProductPrice::where('product_id', $productId)
            ->orderBy('min_quantity')
            ->get();

        $html = view('admin.components.create-product-pricing', [
            'prices' => $prices,
        ])->render();

        return response()->json([
            'success' => true,
            'message' => 'Цената беше изтрита успешно!',
            'html' => $html,
        ]);
    }




    /**
     * Delete an image from the gallery
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function deleteGalleryImage(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'image' => [
                'required',
                'string',
            ],
        ]);

        $imageName = $validated['image'];
        $gallery = $product->gallery ?? [];


        if (!in_array($imageName, $gallery, true)) {
            return response()->json([
                'message' => 'Снимката не беше намерена в галерията на продукта.',
            ], 404);
        }

        $updatedGallery = array_values(array_filter($gallery, fn(string $galleryImage): bool => $galleryImage !== $imageName));

        $imagePath = public_path(
            'assets/images/product_gallery/' . $imageName
        );

        if (File::exists($imagePath) && !File::delete($imagePath)) {
            return response()->json([
                'message' => 'Файлът на снимката не можа да бъде изтрит.',
            ], 500);
        }

        $product->update([
            'gallery' => $updatedGallery,
        ]);

        return response()->json([
            'message' => 'Снимката беше изтрита успешно.',
            'gallery' => $updatedGallery,
        ]);
    }
}
