<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Mail\OrderCreated;
use App\Models\Admin\Promocode;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\ShopService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class OrdersController extends Controller
{




    /**
     * Add a product to the session cart.
     *
     * Validates stock availability and calculates pricing
     * entirely on the server using quantity-based prices.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function addProduct(Request $request, Product $product): RedirectResponse
    {
        // Validate the requested quantity.
        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ], [
            'quantity.required' => 'Моля, изберете количество.',
            'quantity.integer' => 'Количеството трябва да бъде цяло число.',
            'quantity.min' => 'Количеството трябва да бъде поне 1.',
        ]);

        $quantity = (int) $validated['quantity'];
        $stock = (int) $product->stock;

        // Check whether the product is available.
        if ($stock <= 0) {
            return back()
                ->withErrors([
                    'stock' => 'Този продукт няма наличност.',
                ])
                ->withInput();
        }

        // Check the requested quantity against stock.
        if ($quantity > $stock) {
            return back()
                ->withErrors([
                    'quantity' => 'Няма повече количество от това, което сте поискали.',
                ])
                ->withInput();
        }

        $products = Session::get('products', []);

        $productKey = (string) $product->id;

        $existingQuantity = isset($products[$productKey]) ? (int) $products[$productKey]['quantity'] : 0;

        $newQuantity = $existingQuantity + $quantity;

        if ($newQuantity > $stock) {
            return back()
                ->withErrors([
                    'quantity' => 'Няма повече количество от това, което сте поискали.',
                ])
                ->withInput();
        }

        // Calculate the correct price entirely on the backend.
        try {
            $pricing = ShopService::calculateProductPrice($product, $newQuantity);
        } catch (\InvalidArgumentException $exception) {

            return back()
                ->withErrors([
                    'quantity' => $exception->getMessage(),
                ])
                ->withInput();
        }

        $products[$productKey] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $pricing['original_unit_price'],
            'discount' => $pricing['discount'],
            'final_price' => $pricing['unit_price'],
            'total_price' => $pricing['total_price'],
            'quantity' => $pricing['quantity'],
            'image' => $product->main_image,
        ];

        Session::put('products', $products);

        return back()->with(
            'success',
            'Продуктът беше добавен успешно в количката!'
        );
    }


    /** Remove a product from the cart
     *
     * @param int $productId
     * @return RedirectResponse
     */
    public function removeProduct($productId): RedirectResponse
    {
        $products = Session::get('products', []);

        if (isset($products[$productId])) {

            if (! empty($products[$productId]['prescription_image'])) {

                Storage::disk('public')->delete(
                    $products[$productId]['prescription_image']
                );
            }

            unset($products[$productId]);

            Session::put('products', $products);
        }

        return back()->with(
            'success',
            'Продуктът беше премахнат успешно от количката.'
        );
    }


    /**
     * Create a new order.
     *
     * @param CreateOrderRequest $request
     * @return RedirectResponse
     */
    public function create(CreateOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $cartProducts = Session::get('products', []);

        if (empty($cartProducts)) {
            return back()
                ->withErrors([
                    'cart' => 'Количката е празна.',
                ])
                ->withInput();
        }

        $sessionPromoCode = Session::get('promo_code');

        try {
            $transactionResult = DB::transaction(function () use (
                $validated,
                $cartProducts,
                $sessionPromoCode
            ) {
                $verifiedProducts = [];
                $subtotalCents = 0;

                $cartProducts = collect($cartProducts)
                    ->sortBy(fn($item) => (int) ($item['product_id'] ?? 0));

                foreach ($cartProducts as $cartProduct) {

                    $productId = filter_var(
                        $cartProduct['product_id'] ?? null,
                        FILTER_VALIDATE_INT
                    );

                    $quantity = filter_var(
                        $cartProduct['quantity'] ?? null,
                        FILTER_VALIDATE_INT
                    );

                    if (
                        $productId === false ||
                        $productId === null ||
                        $quantity === false ||
                        $quantity === null ||
                        $quantity < 1
                    ) {
                        throw new \InvalidArgumentException(
                            'Невалиден продукт или количество в количката.'
                        );
                    }

                    $databaseProduct = Product::query()
                        ->whereKey($productId)
                        ->lockForUpdate()
                        ->first();

                    if (!$databaseProduct) {
                        throw new \InvalidArgumentException(
                            'Един от продуктите в количката вече не е наличен.'
                        );
                    }

                    if ((int) $databaseProduct->stock < $quantity) {
                        throw new \InvalidArgumentException(
                            'Няма достатъчна наличност за продукт: '
                                . $databaseProduct->name
                        );
                    }

                    // Always use the current database quantity tier.
                    $pricing = ShopService::calculateProductPrice(
                        $databaseProduct,
                        $quantity
                    );

                    // Convert to cents to avoid float accumulation.
                    $unitPriceCents = (int) round(
                        $pricing['unit_price'] * 100
                    );

                    $originalPriceCents = (int) round(
                        $pricing['original_unit_price'] * 100
                    );

                    $lineTotalCents = $unitPriceCents * $quantity;

                    $subtotalCents += $lineTotalCents;

                    $verifiedProducts[] = [
                        'model' => $databaseProduct,
                        'quantity' => $quantity,
                        'original_price_cents' => $originalPriceCents,
                        'unit_price_cents' => $unitPriceCents,
                        'line_total_cents' => $lineTotalCents,
                        'discount' => $pricing['discount'],
                    ];
                }

                $promoCode = null;
                $promoCodeName = null;
                $promoDiscountCents = 0;

                if (!empty($sessionPromoCode['promo_code_name'])) {

                    $promoCode = Promocode::query()
                        ->where(
                            'promo_code_name',
                            $sessionPromoCode['promo_code_name']
                        )
                        ->first();

                    if (!$promoCode) {
                        throw new \InvalidArgumentException(
                            'Промокодът вече не е валиден.'
                        );
                    }

                    $percentage = (float) $promoCode->percentage_promo_code;

                    if ($percentage < 0 || $percentage > 100) {
                        throw new \InvalidArgumentException(
                            'Промокодът има невалидна отстъпка.'
                        );
                    }

                    $promoDiscountCents = (int) round(
                        $subtotalCents * $percentage / 100
                    );

                    $promoCodeName = $promoCode->promo_code_name;
                }

                $totalCents = max(
                    0,
                    $subtotalCents - $promoDiscountCents
                );


                $order = Order::create([
                    'order_number' => 'ORD-' . date('dmy') . '-' . random_int(1000, 9999),

                    'first_name' => $validated['fname'],
                    'last_name' => $validated['lname'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'],

                    'delivery_method' => $validated['delivery_method'],

                    'city' => $validated['delivery_method'] === 'personal'
                        ? $validated['city']
                        : null,

                    'personal_address' => $validated['delivery_method'] === 'personal'
                        ? $validated['billing_address']
                        : null,

                    'courier' => $validated['delivery_method'] === 'office'
                        ? 'econt'
                        : null,

                    'office_list' => $validated['delivery_method'] === 'office'
                        ? $validated['office_list']
                        : null,

                    'request_invoice' => (bool) (
                        $validated['request_invoice'] ?? false
                    ),

                    'company_name' => !empty($validated['request_invoice'])
                        ? $validated['company_name']
                        : null,

                    'company_mol' => !empty($validated['request_invoice'])
                        ? $validated['company_mol']
                        : null,

                    'company_bulstat' => !empty($validated['request_invoice'])
                        ? $validated['company_bulstat']
                        : null,

                    'company_address' => !empty($validated['request_invoice'])
                        ? $validated['company_address']
                        : null,

                    'subtotal' => $subtotalCents / 100,
                    'promo_code' => $promoCodeName,
                    'delivery_price' => 0,
                    'total' => $totalCents / 100,

                    'payment_option' => $validated['payment_method'],
                    'status' => Order::STATUS_PENDING,
                ]);

                $orderProducts = [];

                foreach ($verifiedProducts as $item) {

                    $databaseProduct = $item['model'];
                    $quantity = $item['quantity'];

                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $databaseProduct->id,
                        'product_name' => $databaseProduct->name,
                        'product_slug' => $databaseProduct->slug,
                        'product_image' => $databaseProduct->main_image,

                        'price' => $item['original_price_cents'] / 100,
                        'discount' => $item['discount'],

                        'base_price' => $item['original_price_cents'] / 100,
                        'final_price' => $item['unit_price_cents'] / 100,

                        'quantity' => $quantity,
                    ]);

                    $databaseProduct->decrement('stock', $quantity);

                    $orderProducts[] = $orderProduct;
                }

                return [
                    'order' => $order,
                    'orderProducts' => collect($orderProducts),
                    'promoCode' => $promoCode,
                ];
            }, 3);

        } catch (\InvalidArgumentException $exception) {

            return back()
                ->withErrors([
                    'order' => $exception->getMessage(),
                ])
                ->withInput();
        } catch (\Throwable $exception) {

            report($exception);

            return back()
                ->withErrors([
                    'order' => 'Възникна грешка при създаването на поръчката. Моля, опитайте отново.',
                ])
                ->withInput();
        }

        $newOrder = $transactionResult['order'];
        $orderProducts = $transactionResult['orderProducts'];
        $promoCode = $transactionResult['promoCode'];

        Session::forget([
            'products',
            'promo_code',
        ]);

        try {
            Mail::to($newOrder->email)->send(
                new OrderCreated(
                    $newOrder,
                    $orderProducts,
                    $promoCode
                )
            );
        } catch (\Throwable $exception) {
            report($exception);
        }

        return redirect()->route('checkout.succes');
    }
}
