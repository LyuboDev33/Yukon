<x-frontend>

    @section('SEO')
        <title>{{ $product->name }} | ЮКОН – Картонени кутии и опаковки</title>

        <meta name="description" content="{!! $product->description ?? '' !!}">

        <meta name="robots" content="index,follow,max-image-preview:large">

        <link rel="canonical" href="{{ route('shop.show', $product->slug) }}">

        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="product">
        <meta property="og:site_name" content="ЮКОН">
        <meta property="og:title" content="{{ $product->name }} | ЮКОН">
        <meta property="og:description"
            content="{{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 155) }}">
        <meta property="og:url" content="{{ route('shop.show', $product->slug) }}">

        @if ($product->main_image)
            <meta property="og:image" content="{{ asset('assets/images/products/' . $product->main_image) }}">
            <meta property="og:image:alt" content="{{ $product->name }}">
        @endif

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $product->name }} | ЮКОН">
        <meta name="twitter:description" content="{!! $product->description ?? '' !!}">

        @if ($product->main_image)
            <meta name="twitter:image" content="{{ asset('assets/images/products/' . $product->main_image) }}">
        @endif
    @endsection


    <!-- Product Details -->
    <section class="product-details sec-padding yukon-product-page">
        <div class="container">
            <div class="row">

                <!-- Product Gallery -->

                <!-- Product Gallery -->
                <div class="col-xl-6">

                    <div class="product-media mb-3">

                        @if ($galleryImages->isNotEmpty())

                            <!-- Main Product Image -->
                            <div class="product-details__img mb-3">

                                <a href="{{ $galleryImages->first() }}" data-fancybox="product-gallery" class="d-block">

                                    <img src="{{ $galleryImages->first() }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 rounded-3">

                                </a>

                            </div>

                            <!-- Gallery Thumbnails -->
                            @if ($galleryImages->count() > 1)

                                <div class="product-gallery d-flex flex-column gap-2">

                                    @foreach ($galleryImages->skip(1) as $image)
                                        <a href="{{ $image }}" data-fancybox="product-gallery"
                                            class="product-gallery__item">

                                            <img src="{{ $image }}" alt="{{ $product->name }}"
                                                class="img-fluid rounded-3">

                                        </a>
                                    @endforeach

                                </div>

                            @endif

                        @endif

                    </div>

                </div>




                <!-- Product Information -->
                <div class="col-xl-6 mt-4 mt-xl-0 yukon-product-info-column">

                    <div class="product-info yukon-product-card">

                        <h1 class="display-3 yukon-product-title">
                            {{ $product->name }}
                        </h1>


                        <!-- Quantity Pricing Table -->
                        <div class="product-quantity-prices yukon-price-tiers my-4 shadow">

                            <h4 class="mb-3">
                                Цени според количеството
                            </h4>

                            @if ($priceTiers->isNotEmpty())

                                <div class="table-responsive">

                                    <table class="table align-middle yukon-tier-table">

                                        <thead>
                                            <tr>
                                                <th>Количество</th>
                                                <th class="text-end">Цена за брой</th>
                                            </tr>
                                        </thead>

                                        <tbody id="productPriceTiers">

                                            @foreach ($priceTiers as $tier)
                                                <tr data-min="{{ $tier['min_quantity'] }}"
                                                    data-max="{{ $tier['max_quantity'] }}"
                                                    data-price="{{ $tier['price'] }}"
                                                    data-original-price="{{ $tier['original_price'] }}">

                                                    <td>
                                                        @if ($tier['max_quantity'] !== null)
                                                            {{ $tier['min_quantity'] }}
                                                            –
                                                            {{ $tier['max_quantity'] }}
                                                            бр.
                                                        @else
                                                            От {{ $tier['min_quantity'] }} бр.
                                                        @endif
                                                    </td>

                                                    <td class="text-end">

                                                        <strong>
                                                            {{ $tier['price'] }} €
                                                        </strong>

                                                        @if ($product->discount)
                                                            <del class="text-muted small ms-2">
                                                                {{ $tier['original_price'] }} €
                                                            </del>
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                            @else
                                <div class="alert alert-warning">
                                    Все още няма определени цени за този продукт.
                                </div>

                            @endif

                        </div>


                        <!-- Add to Cart -->
                        <form action="{{ route('product.cart.add', $product) }}" method="POST" id="addToCartForm">
                            @csrf

                            <div class="mb-3 yukon-quantity-field" id="productQuantitySection">

                                <label for="quantity" class="form-label fw-bold">
                                    Въведете желаното от вас количество
                                </label>

                                <input type="text" id="quantity" name="quantity" class="form-control"
                                    inputmode="numeric" pattern="[0-9]+" maxlength="10"
                                    data-stock="{{ $product->stock }}" value="{{ old('quantity', 1) }}" required
                                    @if ($product->stock < 1) disabled @endif>

                                <small id="priceError" class="text-danger"></small>

                                <small class="text-muted">
                                    Наличност: {{ $product->stock }} бр.
                                </small>

                                @error('quantity')
                                    <p class="text-danger mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            <!-- Calculated Price -->
                            <div class="yukon-order-summary my-4">

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Избрано количество:</span>
                                    <strong id="calculatedQuantity">—</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Единична цена:</span>
                                    <strong id="unitPrice">—</strong>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">

                                    <strong>Обща цена:</strong>

                                    <h3 class="mb-0" id="totalPrice">
                                        —
                                    </h3>

                                </div>

                            </div>


                            <!-- Validation Message -->
                            <p id="priceError" class="text-danger mb-3"></p>


                            <button type="submit" class="btn yukon-cart-button" id="addToCartButton" disabled>
                                <i class="fa-solid fa-cart-shopping me-2"></i>
                                Добави в количката
                            </button>

                        </form>


                        <!-- Product Metadata -->
                        <div class="product-meta yukon-product-meta mt-4">

                            <p class="sku">
                                <strong>Каталожен номер:</strong>
                                {{ $product->sku }}
                            </p>

                            @if ($product->categories->isNotEmpty())
                                <p class="sku">
                                    <strong>Категории:</strong>
                                    {{ $product->categories->pluck('name')->join(', ') }}
                                </p>
                            @endif

                            <p class="sku">

                                <strong>Наличност:</strong>

                                @if ((int) $product->stock > 0)
                                    <span class="text-success">
                                        В наличност
                                    </span>
                                @else
                                    <span class="text-danger">
                                        Изчерпан
                                    </span>
                                @endif

                            </p>

                        </div>





                        <!-- Product Variants -->
                        @if ($product->variants->isNotEmpty() || $product->variantParent->isNotEmpty())

                            <div class="mt-4">

                                <h4 class="mb-3">
                                    Варианти на продукта
                                </h4>

                                <div class="d-flex flex-wrap gap-3">

                                    @foreach ($product->variantParent as $parent)
                                        <a href="{{ route('shop.show', $parent->slug) }}"
                                            class="product-variant-card">

                                            <img src="{{ asset('assets/images/products/' . $parent->main_image) }}"
                                                alt="{{ $parent->name }}">

                                            <span>Основен</span>

                                        </a>
                                    @endforeach


                                    <a href="{{ route('shop.show', $product->slug) }}"
                                        class="product-variant-card active">

                                        <img src="{{ asset('assets/images/products/' . $product->main_image) }}"
                                            alt="{{ $product->name }}">

                                        <span>{{ $product->name }}</span>

                                    </a>


                                    @foreach ($product->variants as $variant)
                                        <a href="{{ route('shop.show', $variant->slug) }}"
                                            class="product-variant-card">

                                            <img src="{{ asset('assets/images/products/' . $variant->main_image) }}"
                                                alt="{{ $variant->name }}">

                                            <span>{{ $variant->name }}</span>

                                        </a>
                                    @endforeach

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>
        </div>
    </section>


    <!-- Mobile-only sticky shortcut to the quantity selector -->
    @if ((int) $product->stock > 0 && $priceTiers->isNotEmpty())
        <div class="yukon-mobile-cart-bar" id="mobileCartBar" aria-hidden="true">
            <button type="button" class="yukon-mobile-cart-button" id="mobileCartScrollButton">
                <i class="fa-solid fa-cart-shopping me-2" aria-hidden="true"></i>
                Добави в количката
                <i class="fa-solid fa-arrow-down ms-2" aria-hidden="true"></i>
            </button>
        </div>
    @endif

    <!-- Similar Products -->
    @include('Frontend.shop.partials.similar-products', [
        'similarProducts' => $similarProducts,
    ])

    <hr>

    <!-- Last Viewed Products -->
    @include('Frontend.shop.partials.last-viewed-products')


    <!-- Cart Success Modal -->
    @if (session('success'))
        <div class="modal fade cart-feedback-modal" id="cartSuccessModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content position-relative">

                    <button type="button" class="btn-close cart-feedback-modal__close" data-bs-dismiss="modal"
                        aria-label="Затвори"></button>

                    <div class="modal-body text-center p-5">

                        <div class="cart-feedback-modal__icon cart-feedback-modal__icon--success">
                            <i class="fas fa-check"></i>
                        </div>

                        <h4>Продуктът е добавен</h4>

                        <p class="mb-0">
                            {{ session('success') }}
                        </p>

                        <div class="cart-feedback-modal__actions">

                            <a href="{{ route('checkout') }}" class="btn ">
                                Към поръчка
                            </a>

                            <a href="{{ route('cart') }}" class="btn">
                                Към количката
                            </a>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    @endif


    <script>
        $(document).ready(function() {

            let initialQuantity = $('#quantity').val();
            $('#quantity').val(initialQuantity.replace(/[^0-9]/g, ''));

            calculatePrice();

            $('#quantity').on('input', function() {

                let quantity = $(this).val();

                quantity = quantity.replace(/[^0-9]/g, '');

                $(this).val(quantity);

                calculatePrice();

            });

            @if (session('success'))
                const modalElement = document.getElementById('cartSuccessModal');

                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            @endif

        });


        function calculatePrice() {

            let quantityInput = $('#quantity').val();
            let stock = Number($('#quantity').attr('data-stock'));

            $('#addToCartButton').prop('disabled', true);
            $('#priceError').text('');

            // Empty input.
            if (quantityInput === '') {
                $('#priceError').text('Моля, въведете количество.');
                return;
            }

            let quantity = Number(quantityInput);

            // Quantity must be a positive whole number.
            if (!Number.isSafeInteger(quantity) || quantity < 1) {
                $('#priceError').text('Моля, въведете валидно количество.');
                return;
            }

            // Quantity exceeds available stock.
            if (quantity > stock) {
                $('#priceError').text('Няма повече количество от това, което сте поискали.');
                return;
            }

            let unitPrice = null;
            let originalPrice = null;
            let highestMin = -1;

            // Find the highest pricing threshold reached.
            $('#productPriceTiers tr').each(function() {

                let min = Number($(this).attr('data-min'));

                if (quantity >= min && min > highestMin) {

                    highestMin = min;
                    unitPrice = Number($(this).attr('data-price'));
                    originalPrice = Number($(this).attr('data-original-price'));

                }

            });

            if (unitPrice === null || !Number.isFinite(unitPrice)) {
                $('#priceError').text('Няма определена цена за това количество.');
                return;
            }

            let totalPrice = unitPrice * quantity;

            $('#productUnitPrice').text(unitPrice.toFixed(2) + ' €');
            $('#unitPrice').text(unitPrice.toFixed(2) + ' €');
            $('#totalPrice').text(totalPrice.toFixed(2) + ' €');
            $('#calculatedQuantity').text(quantity + ' бр.');

            if (originalPrice > unitPrice) {

                $('#productOriginalPrice').text(originalPrice.toFixed(2) + ' €');
                $('#productDiscountInfo').removeClass('d-none');

            } else {

                $('#productDiscountInfo').addClass('d-none');

            }

            $('#addToCartButton').prop('disabled', false);

        }
    </script>


    <!-- Mobile sticky cart visibility / smooth scrolling; pricing JavaScript above is unchanged. -->
    <script>
        $(document).ready(function() {
            const $bar = $('#mobileCartBar');
            const $quantity = $('#quantity');

            if (!$bar.length || !$quantity.length) {
                return;
            }

            const bar = $bar[0];
            const quantity = $quantity[0];
            const mobileQuery = window.matchMedia('(max-width: 767.98px)');

            function updateMobileCartBar() {
                if (!mobileQuery.matches) {
                    $bar.removeClass('is-visible').attr('aria-hidden', 'true');
                    return;
                }

                const rect = quantity.getBoundingClientRect();
                const quantityVisible = rect.bottom > 0 && rect.top < window.innerHeight;
                $bar.toggleClass('is-visible', !quantityVisible);
                $bar.attr('aria-hidden', quantityVisible ? 'true' : 'false');
            }

            $('#mobileCartScrollButton').on('click', function() {
                document.getElementById('productQuantitySection').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            });

            $(window).on('scroll resize', updateMobileCartBar);
            updateMobileCartBar();
        });
    </script>

</x-frontend>
