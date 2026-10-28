<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class FrontEndController extends Controller
{
    /** Return the welcome view */
    public function welcome()
    {
        $products = Product::with([
            'categories',
            'attributeValues.type',
        ])
            ->latest()
            ->take(8)
            ->get();

        foreach ($products as $product) {
            $brand = $product->attributeValues->first(
                fn($attribute) => $attribute->type->name === 'Марка'
            );

            $product->brand = $brand?->value;
        }

        return view('Frontend.welcome', [
            'brands'   => $this->brand1(),
            'products' => $products,
        ]);
    }

    /** Return the contact view */
    public function contact()
    {
        return view('Frontend.contact');
    }

    /** Return the about view */
    public function about()
    {
        return view('Frontend.about', [
            'brands'  => $this->brand1(),
            'brands2' => $this->brand2(),
        ]);
    }

    /** Return the conditions */
    public function conditions()
    {
        return view('Frontend.legal.conditions');
    }

    /** Return the privacy */
    public function privacy()
    {
        return view('Frontend.legal.privacy');
    }

    /**
     * Return the view of a specific service.
     *
     * @param string $service
     * @return View
     */
    public function serviceShow(string $service)
    {
        $view = 'Frontend.services.' . $service;

        if (! View::exists($view)) {
            return view('errors.NotFound');
        }

        return view($view);
    }

    /** Return the view of the machiens seection */
    public function machines()
    {
        return view('Frontend.machines.index');
    }

    /** Return the single machine view
     *
     * @param string $name
     */
    public function machine(string $name)
    {
        $view = 'Frontend.machines.' . $name;

        if (!view()->exists($view)) {
            abort(404);
        }

        $imagePath = public_path('assets/images/machines/' . $name);

        $images = collect(File::files($imagePath))
            ->map(fn($file) => asset(
                'assets/images/machines/' . $name . '/' . $file->getFilename()
            ))
            ->values();

        return view($view, compact('images'));
    }

    /**
     * Get the primary brand logos.
     *
     * @return array
     */
    private function brand1(): array
    {
        return File::files(public_path('assets/images/brands'));
    }

    /**
     * Get the secondary brand logos.
     *
     * @return array
     */
    private function brand2(): array
    {
        return File::files(public_path('assets/images/brands_2'));
    }
}
