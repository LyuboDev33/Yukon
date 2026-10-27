<?php

namespace App\Services;

use App\Models\Admin\Promocode;
use App\Models\AttributeType;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class ShopService
{

    /**
     * Calculate the subtotal for all products.
     *
     * @param array $products
     * @return float
     */
    public static function calculateSubtotal(array $products): float
    {
        $subtotal = 0;

        foreach ($products as $product) {
            $subtotal += self::calculateProductTotal($product);
        }

        return round($subtotal, 2);
    }

    /**
     * Calculate the total price for one product.
     *
     * @param array $product
     * @return float
     */
    public static function calculateProductTotal(array $product): float
    {
        $quantity = (int) ($product['quantity'] ?? 1);
        $finalPrice = (float) ($product['final_price'] ?? 0);

        $total = $finalPrice * $quantity;

        if (! empty($product['lens_index'])) {
            $lensIndexPrice = (float) (
                $product['lens_index']['price'] ?? 0
            );

            $total += $lensIndexPrice * $quantity;
        }

        if (! empty($product['glass_value'])) {
            $glassValuePrice = (float) (
                $product['glass_value']['price'] ?? 0
            );

            $total += $glassValuePrice * $quantity;
        }

        return round($total, 2);
    }

    /**
     * This method returns all filters
     *
     * @return array[]
     */
    public static function filters(): array
    {
        $types = AttributeType::with('values')->get();

        $filters = [];

        foreach ($types as $type) {
            $values = [];

            foreach ($type->values as $value) {
                $values[$value->id] = [
                    'name' => $value->value,
                    'slug' => $value->slug,
                ];
            }

            if (! empty($values)) {
                $filters[] = [
                    'name' => $type->name,
                    'slug' => $type->slug,
                    'values' => array_values($values),
                ];
            }
        }

        return $filters;
    }

    /**
     * Remove empty values from the filter URL.
     *
     * @param Request $request
     * @return RedirectResponse|null
     */
    public static function filterLinks(Request $request)
    {
        $cleanQuery = [];

        foreach ($request->query() as $key => $value) {
            if ($value !== null && $value !== '') {
                $cleanQuery[$key] = $value;
            }
        }

        if ($cleanQuery == $request->query()) {
            return null;
        }

        return redirect()->to(
            $request->url() . '?' . http_build_query($cleanQuery)
        );
    }

    /**
     * Add a product to wishlist
     *
     * @param Product $product
     * @return JsonResponse
     */
    public static function addToWishlist(Product $product): JsonResponse
    {
        $wishlist = Session::get('wishlist', []);

        $productId = $product->id;

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);

            Session::put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'action' => 'removed',
                'count' => count($wishlist),
            ]);
        }

        $finalPrice = $product->discount
            ? $product->price - (($product->price * $product->discount) / 100)
            : $product->price;

        $wishlist[$productId] = [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'url' => route('shop.show', $product->slug),
            'price' => $product->price,
            'discount' => $product->discount,
            'final_price' => round($finalPrice, 2),
            'image' => $product->main_image,
        ];

        Session::put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'action' => 'added',
            'message' => 'Продуктът беше добавен в любими.',
            'count' => count($wishlist),
        ]);
    }

    /**
     * Store the last 4 viewed products in the session.
     *
     * @param Product $product
     * @return void
     */
    public static function lastViewedProducts(Product $product): void
    {
        $lastViewedProducts = Session::get('lastViewedProducts', []);

        // Remove the product if it has already been viewed.
        unset($lastViewedProducts[$product->id]);

        // Get the product's quantity-based prices.
        $prices = $product->prices
            ->sortBy('min_quantity')
            ->map(function ($price) {
                return [
                    'min_quantity' => $price->min_quantity,
                    'max_quantity' => $price->max_quantity,
                    'price' => (float) $price->price,
                ];
            })
            ->values()
            ->toArray();

        // Build each assigned category with its complete parent path.
        $categories = $product->categories
            ->map(function ($category) {
                $path = [];
                $currentCategory = $category;

                while ($currentCategory) {
                    array_unshift($path, [
                        'id' => $currentCategory->id,
                        'name' => $currentCategory->name,
                        'slug' => $currentCategory->slug,
                    ]);

                    $currentCategory = $currentCategory->parent;
                }

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'ancestors' => array_slice($path, 0, -1),
                    'path' => $path,
                ];
            })
            ->values()
            ->toArray();

        // Remove parent categories when a deeper assigned category includes them.
        $categories = collect($categories)
            ->reject(function ($category) use ($categories) {
                return collect($categories)->contains(function ($otherCategory) use ($category) {
                    return $otherCategory['id'] !== $category['id']
                        && collect($otherCategory['path'])->contains('id', $category['id']);
                });
            })
            ->values()
            ->toArray();

        // Add the newest product to the beginning.
        $lastViewedProducts = [
            $product->id => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'url' => route('shop.show', $product->slug),
                'image' => $product->main_image,
                'prices' => $prices,
                'discount' => $product->discount,
                'categories' => $categories,
            ],
        ] + $lastViewedProducts;

        // Keep only the latest 4 viewed products.
        $lastViewedProducts = array_slice($lastViewedProducts, 0, 4, true);

        Session::put('lastViewedProducts', $lastViewedProducts);
    }

    /**
     * Apply the promo code
     *
     * @param Request $request
     * @return JsonResponse
     */
    public static function applyPromoCode($request): JsonResponse
    {

        $validated = $request->validate([
            'promo_code' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'promo_code.required' => 'Моля, въведете промо код.',
            'promo_code.string' => 'Промо кодът е невалиден.',
            'promo_code.max' => 'Промо кодът е прекалено дълъг.',
        ]);

        $promoCode = Promocode::query()
            ->where(
                'promo_code_name',
                trim($validated['promo_code'])
            )
            ->where('is_active', true)
            ->first();

        if (! $promoCode) {
            return response()->json([
                'success' => false,
                'message' =>
                'Промо кодът е невалиден или не е активен.',
            ], 422);
        }

        $percentage = (int) $promoCode->percentage_promo_code;

        if ($percentage <= 0 || $percentage > 100) {
            return response()->json([
                'success' => false,
                'message' =>
                'Промо кодът има невалиден процент отстъпка.',
            ], 422);
        }

        Session::put('promo_code', [
            'promo_code_name' => $promoCode->promo_code_name,
            'percentage_promo_code' => $percentage,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Промо кодът беше приложен успешно.',
        ]);
    }

    /**
     * Get similar products based on the current product's category.
     *
     * @param Product $product
     * @return Collection
     */
    public static function similarProducts(Product $product): Collection
    {
        return Product::with([
            'prices' => function ($query) {
                $query->orderBy('min_quantity', 'asc');
            },
            'categories',
            'attributeValues.type',
        ])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest('id')
            ->take(4)
            ->get()
            ->map(function ($similarProduct) {

                $brand = $similarProduct->attributeValues->first(
                    fn($attributeValue) =>
                    $attributeValue->type?->name === 'Марка'
                );

                $similarProduct->brand = $brand?->value;

                return $similarProduct;
            });
    }


    /**
     * Calculate product pricing based on the requested quantity.
     *
     * The applicable price is determined by the highest
     * min_quantity that is less than or equal to the quantity.
     *
     * @param Product $product
     * @param int $quantity
     * @return array
     */
    public static function calculateProductPrice(Product $product, int $quantity): array
    {
        if ($quantity < 1) {
            throw new \InvalidArgumentException(
                'Количеството трябва да бъде поне 1.'
            );
        }

        // Find the applicable quantity-based price.
        $priceTier = $product->prices()
            ->where('min_quantity', '<=', $quantity)
            ->orderByDesc('min_quantity')
            ->first();

        if (!$priceTier) {
            throw new \InvalidArgumentException(
                'Няма определена цена за избраното количество.'
            );
        }

        // Original unit price from the database.
        $originalUnitPrice = (float) $priceTier->price;

        // Product discount percentage.
        $discount = (float) ($product->discount ?? 0);

        // Final unit price after discount.
        $unitPrice = round(
            $originalUnitPrice * (1 - $discount / 100),
            2
        );

        // Total price for the requested quantity.
        $totalPrice = round($unitPrice * $quantity, 2);

        return [
            'quantity' => $quantity,
            'original_unit_price' => $originalUnitPrice,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'discount' => $discount,
        ];
    }
}
