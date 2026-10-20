<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminCategoriesController extends Controller
{
    /**
     * Show all categories.
     */
    public function index()
    {
        return view('admin.Categories.Index', [
            'categoriesTree' => Category::tree(),
        ]);
    }

    /**
     * Create a new category.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'category_parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],
        ], [
            'name.required' => 'Името на категорията е задължително.',
            'name.string' => 'Името трябва да бъде текст.',
            'name.max' => 'Името не може да е по-дълго от 255 символа.',
            'category_parent_id.integer' => 'Невалидна родителска категория.',
            'category_parent_id.exists' => 'Избраната родителска категория не съществува.',
        ]);

        $slug = Str::slug($validated['name']);

        // Check if the slug already exists.
        if (Category::where('slug', $slug)->exists()) {
            return back()
                ->withErrors([
                    'name' => 'Вече съществува категория с това име.',
                ])
                ->withInput();
        }

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category_parent_id' => $validated['category_parent_id'] ?? null,
        ]);

        return back()->with(
            'success',
            'Успешно създадохте категорията „' . $validated['name'] . '“.'
        );
    }

    /**
     * Delete a category, its subcategories, and their products.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        DB::transaction(function () use ($category) {

            $deleteCategory = function (Category $category) use (&$deleteCategory) {

                $children = Category::where('category_parent_id', $category->id)->get();

                foreach ($children as $child) {
                    $deleteCategory($child);
                }

                // Products are deleted automatically through
                // the products.category_id foreign key cascade.
                $category->delete();
            };

            $deleteCategory($category);
        });

        return back()->with(
            'success',
            'Категорията, всички нейни подкатегории и продуктите към тях бяха изтрити успешно.'
        );
    }
}
