<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminProductService
{
    /**
     * Apply product attribute and price filters.
     */
    public static function filteredProducts(
        Builder $query,
        Request $request
    ): Builder {
        $filters = $request->except([
            'page',
            'price-range',
            'stock',
        ]);

        foreach ($filters as $attributeTypeSlug => $attributeValueSlug) {
            if (empty($attributeValueSlug)) {
                continue;
            }

            $query->whereHas(
                'attributeValues',
                function ($query) use (
                    $attributeTypeSlug,
                    $attributeValueSlug
                ) {
                    $query->where('slug', $attributeValueSlug)
                        ->whereHas(
                            'type',
                            function ($query) use ($attributeTypeSlug) {
                                $query->where('slug', $attributeTypeSlug);
                            }
                        );
                }
            );
        }

        if ($request->filled('price-range')) {
            $query->whereBetween('price', [
                0,
                $request->integer('price-range'),
            ]);
        }

        if ($request->stock === 'in_stock') {
            $query->where('stock', '>', 0);
        }

        if ($request->stock === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        }

        return $query;
    }

    /**
     * Return the IDs of a category and all its descendants.
     * 
     * @param Collection $category
     * @return array[]
     * Fetches categories once instead of querying children recursively.
     */
    public static function getCategoryIds($category): array
    {
        $categories = Category::query()
            ->select(['id', 'category_parent_id'])
            ->get();

        $childrenByParent = $categories->groupBy('category_parent_id');

        $ids = [];

        $collectIds = function ($categoryId) use (
            &$collectIds,
            &$ids,
            $childrenByParent
        ) {
            $ids[] = $categoryId;

            foreach (
                $childrenByParent->get($categoryId, collect())
                as $child
            ) {
                $collectIds($child->id);
            }
        };

        $collectIds($category->id);

        return $ids;
    }

    /**
     * Shared base product query.
     */
    public static function productsQuery(): Builder
    {
        return Product::with([
            'categories',
            'attributeValues',
        ])->latest();
    }

    /**
     * Build the complete category tree using one database query.
     */
    public static function buildCategoriesTree(): array
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        $categoriesByParent = $categories->groupBy('category_parent_id');

        $buildTree = function ($parentId) use (
            &$buildTree,
            $categoriesByParent
        ): array {
            return $categoriesByParent
                ->get($parentId, collect())
                ->map(function ($category) use (&$buildTree) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'children' => $buildTree($category->id),
                    ];
                })
                ->values()
                ->toArray();
        };

        return $buildTree(null);
    }

    /**
     * Flatten a category tree into a list with full category paths.
     */
    public static function flattenCategoryTree(
        $categories,
        $parentPath = ''
    ): array {
        $tree = [];

        foreach ($categories as $category) {
            $currentPath = $parentPath
                ? $parentPath . ' → ' . $category->name
                : $category->name;

            $tree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'path' => $currentPath,
            ];

            if ($category->children && $category->children->count()) {
                $tree = array_merge(
                    $tree,
                    self::flattenCategoryTree(
                        $category->children,
                        $currentPath
                    )
                );
            }
        }

        return $tree;
    }

    /**
     * Find the breadcrumb path for a category in the category tree.
     */
    public static function getCategoryBreadcrumbs(
        array $categoriesTree,
        string $activeSlug
    ): array {
        foreach ($categoriesTree as $category) {
            if ($category['slug'] === $activeSlug) {
                return [[
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                ]];
            }

            if (!empty($category['children'])) {
                $childPath = self::getCategoryBreadcrumbs(
                    $category['children'],
                    $activeSlug
                );

                if (!empty($childPath)) {
                    return array_merge(
                        [[
                            'name' => $category['name'],
                            'slug' => $category['slug'],
                        ]],
                        $childPath
                    );
                }
            }
        }

        return [];
    }
}
