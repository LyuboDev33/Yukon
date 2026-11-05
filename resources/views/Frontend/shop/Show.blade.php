<x-frontend>

    @section('SEO')
        <title>{{ $product->name }} | ЮКОН – Картонени кутии и опаковки</title>

        <meta name="description" content="{{ strip_tags($product->description ?? '') }}">

        <meta name="robots" content="index,follow,max-image-preview:large">

        <link rel="canonical" href="{{ route('shop.show', $product->slug) }}">

        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="product">
        <meta property="og:site_name" content="ЮКОН">

        <meta property="og:title" content="{{ $product->name }} | ЮКОН">

        <meta property="og:description" content="{{ strip_tags($product->description ?? '') }}">

        <meta property="og:url" content="{{ route('shop.show', $product->slug) }}">

        @if ($product->main_image)
            <meta property="og:image" content="{{ asset('assets/images/products/' . $product->main_image) }}">

            <meta property="og:image:alt" content="{{ $product->name }}">
        @endif

        <meta name="twitter:card" content="summary_large_image">

        <meta name="twitter:title" content="{{ $product->name }} | ЮКОН">

        <meta name="twitter:description" content="{{ strip_tags($product->description ?? '') }}">

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

                                <a href="{{ $galleryImages->first() }}" data-fancybox="product-gallery"
                                    class="d-block">

                                    <img src="{{ $galleryImages->first() }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100 rounded-3">

                                </a>

                            </div>

                            <!-- Gallery Thumbnails -->
                            @if ($galleryImages->count() > 1)

                                <div class="product-gallery gap-2">
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
                        <div>
                            <h3>Описание на продукта: </h3>
                            {!! $product->description !!}
                        </div>


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

                        <hr>

                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <h4 class="text-center mt-4">
                                Имате нужда от кутии със специфични размери?
                            </h4>

                            <button type="button" class="btn yukon-cart-button" id="customOfferButton">
                                Направете запитване
                            </button>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(
                    document.getElementById('cartSuccessModal')
                );

                modal.show();
            });
        </script>
    @endif

    <div class="modal fade custom-offer-modal-wrapper" id="customOfferModal" tabindex="-1"
        aria-labelledby="customOfferModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content custom-offer-modal">

                <!-- Header -->
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <div>
                        <h4 class="modal-title fw-bold" id="customOfferModalLabel">
                            Запитване за кашони по размер
                        </h4>

                        <p class="text-muted mb-0 mt-2 small">
                            Попълнете желаните размери и вашите данни.
                            Ще се свържем с вас с индивидуална оферта.
                        </p>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Затвори"></button>
                </div>

                <!-- Form -->
                <form id="customOfferForm" action="{{ route('offers.store') }}" method="POST">
                    @csrf

                    <div class="modal-body px-4 py-3">

                        <div class="row g-4 align-items-start">

                            <!-- Dimensions -->
                            <div class="col-lg-5">

                                <h5 class="fw-bold mb-3">
                                    Размери на кашона
                                </h5>

                                <div class="row g-3">

                                    <div class="col-12">
                                        <label class="checkout__label" for="customLength">
                                            Дължина (L) в мм
                                            <span class="checkout__">*</span>
                                        </label>

                                        <input type="number" class="checkout__input" id="customLength"
                                            name="length" value="600" min="1" step="1">
                                    </div>

                                    <div class="col-12">
                                        <label class="checkout__label" for="customWidth">
                                            Ширина (W) в мм
                                            <span class="checkout__">*</span>
                                        </label>

                                        <input type="number" class="checkout__input" id="customWidth"
                                            name="width" value="400" min="1" step="1">
                                    </div>

                                    <div class="col-12">
                                        <label class="checkout__label" for="customHeight">
                                            Височина (H) в мм
                                            <span class="checkout__">*</span>
                                        </label>

                                        <input type="number" class="checkout__input" id="customHeight"
                                            name="height" value="400" min="1" step="1">
                                    </div>

                                </div>
                            </div>

                            <!-- 3D Box Preview -->
                            <div class="col-lg-7">


                                <div class="custom-offer-preview">

                                    <!-- Volume -->
                                    <div class="custom-offer-volume" style="">

                                        <span style="color:#718096; font-size:12px; font-weight:600;">
                                            Изчислен обем
                                        </span>

                                        <strong id="customBoxVolume" style="color:#2d3748; font-size:17px;">
                                            96.0 литра
                                        </strong>
                                    </div>

                                    <!-- Box -->
                                    <div class="box-wrapper">

                                        <svg id="customBoxSvg" viewBox="90 -45 540 440" width="100%"
                                            height="100%" preserveAspectRatio="xMidYMid meet"
                                            style="display:block; width:100%; height:100%;"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <defs>
                                                <pattern id="kraftPattern" width="4" height="4"
                                                    patternUnits="userSpaceOnUse">
                                                    <rect width="4" height="4" fill="#dca876" />
                                                    <line x1="0" y1="0" x2="0"
                                                        y2="4" stroke="#d39e6b" stroke-width="1" />
                                                </pattern>

                                                <pattern id="kraftSidePattern" width="4" height="4"
                                                    patternUnits="userSpaceOnUse">
                                                    <rect width="4" height="4" fill="#b98553" />
                                                    <line x1="0" y1="0" x2="0"
                                                        y2="4" stroke="#ab7745" stroke-width="1" />
                                                </pattern>

                                                <pattern id="kraftTopPattern" width="4" height="4"
                                                    patternUnits="userSpaceOnUse">
                                                    <rect width="4" height="4" fill="#e9ba8c" />
                                                    <line x1="0" y1="0" x2="4"
                                                        y2="0" stroke="#dfb082" stroke-width="1" />
                                                </pattern>

                                                <linearGradient id="frontShade" x1="0" y1="0"
                                                    x2="1" y2="0">
                                                    <stop offset="0%" stop-color="rgba(0,0,0,0.15)" />
                                                    <stop offset="20%" stop-color="rgba(0,0,0,0)" />
                                                    <stop offset="100%" stop-color="rgba(0,0,0,0.05)" />
                                                </linearGradient>

                                                <linearGradient id="sideShade" x1="0" y1="0"
                                                    x2="1" y2="0">
                                                    <stop offset="0%" stop-color="rgba(0,0,0,0.2)" />
                                                    <stop offset="100%" stop-color="rgba(0,0,0,0)" />
                                                </linearGradient>

                                                <linearGradient id="topShade" x1="0" y1="1"
                                                    x2="0" y2="0">
                                                    <stop offset="0%" stop-color="rgba(0,0,0,0.12)" />
                                                    <stop offset="100%" stop-color="rgba(255,255,255,0.15)" />
                                                </linearGradient>

                                                <marker id="customBoxArrow" viewBox="0 0 10 10" refX="5"
                                                    refY="5" markerWidth="6" markerHeight="6"
                                                    orient="auto-start-reverse">
                                                    <path d="M 0 1 L 10 5 L 0 9 Z" fill="#2D3748" />
                                                </marker>
                                            </defs>

                                            <!-- Shadow -->
                                            <path d="M 330 355 L 120 235 L 330 115 L 540 235 Z" fill="rgba(0,0,0,0.08)"
                                                filter="blur(6px)" />

                                            <path d="M 330 350 L 130 235 L 330 120 L 530 235 Z" fill="rgba(0,0,0,0.12)"
                                                filter="blur(2px)" />

                                            <!-- Front -->
                                            <path d="M 330 340 L 140 230 L 140 90 L 330 200 Z"
                                                fill="url(#kraftPattern)" stroke="#5c3b17" stroke-width="1.2" />

                                            <path d="M 330 340 L 140 230 L 140 90 L 330 200 Z"
                                                fill="url(#frontShade)" />

                                            <!-- Side -->
                                            <path d="M 330 340 L 520 230 L 520 90 L 330 200 Z"
                                                fill="url(#kraftSidePattern)" stroke="#4d2f10" stroke-width="1.2" />

                                            <path d="M 330 340 L 520 230 L 520 90 L 330 200 Z"
                                                fill="url(#sideShade)" />

                                            <!-- Top -->
                                            <path d="M 330 200 L 140 90 L 330 -20 L 520 90 Z"
                                                fill="url(#kraftTopPattern)" stroke="#5c3b17" stroke-width="1.2" />

                                            <path d="M 330 200 L 140 90 L 330 -20 L 520 90 Z" fill="url(#topShade)" />

                                            <!-- Cardboard fold -->
                                            <line x1="235" y1="145" x2="425" y2="35"
                                                stroke="#4d2f10" stroke-width="2" opacity="0.85" />

                                            <line x1="235" y1="145" x2="425" y2="35"
                                                stroke="#ffebc2" stroke-width="0.8" opacity="0.4" />

                                            <!-- Dimension arrows -->
                                            <line x1="320" y1="358" x2="130" y2="248"
                                                stroke="#2D3748" stroke-width="2" marker-start="url(#customBoxArrow)"
                                                marker-end="url(#customBoxArrow)" />

                                            <line x1="340" y1="358" x2="530" y2="248"
                                                stroke="#2D3748" stroke-width="2" marker-start="url(#customBoxArrow)"
                                                marker-end="url(#customBoxArrow)" />

                                            <line x1="545" y1="230" x2="545" y2="90"
                                                stroke="#2D3748" stroke-width="2" marker-start="url(#customBoxArrow)"
                                                marker-end="url(#customBoxArrow)" />

                                            <!-- Dynamic dimensions -->
                                            <text id="customTxtL" x="210" y="323" font-family="'Segoe UI', Arial"
                                                font-size="15" font-weight="bold" fill="#2D3748"
                                                transform="rotate(30, 210, 323)">
                                                600 мм
                                            </text>

                                            <text id="customTxtW" x="445" y="323" font-family="'Segoe UI', Arial"
                                                font-size="15" font-weight="bold" fill="#2D3748"
                                                transform="rotate(-30, 445, 323)">
                                                400 мм
                                            </text>

                                            <text id="customTxtH" x="560" y="165" font-family="'Segoe UI', Arial"
                                                font-size="15" font-weight="bold" fill="#2D3748">
                                                400 мм
                                            </text>

                                        </svg>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Contact information -->
                        <h5 class="fw-bold mb-3">
                            Данни за контакт
                        </h5>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="checkout__label" for="customName">
                                    Име
                                    <span class="checkout__">*</span>
                                </label>

                                <input type="text" class="checkout__input" id="customName" name="name"
                                    placeholder="Вашето име" maxlength="255" autocomplete="name">
                            </div>

                            <div class="col-md-6">
                                <label class="checkout__label" for="customPhone">
                                    Телефон
                                    <span class="checkout__">*</span>
                                </label>

                                <input type="tel" class="checkout__input" id="customPhone" name="phone"
                                    placeholder="+359 888 123 456" maxlength="30" autocomplete="tel">
                            </div>

                        </div>

                        <div id="customOfferMessage" class="mt-3 d-none" role="alert" aria-live="polite"></div>

                    </div>

                    <!-- Footer -->
                    <div class="modal-footer custom-offer-footer border-0 px-4 pb-4 pt-2">

                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                            Затвори
                        </button>

                        <button type="submit" class="btn yukon-cart-button" id="customOfferSubmit">
                            Изпрати запитване
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            let initialQuantity = $('#quantity').val();
            $('#quantity').val(initialQuantity.replace(/[^0-9]/g, ''));

            calculatePrice();
            initializeMobileCartBar();
            initializeCustomOfferModal();

            $('#quantity').on('input', function() {
                let quantity = $(this).val();

                quantity = quantity.replace(/[^0-9]/g, '');

                $(this).val(quantity);

                calculatePrice();
            });
        });

        function calculatePrice() {
            let quantityInput = $('#quantity').val();
            let stock = Number($('#quantity').attr('data-stock'));

            $('#addToCartButton').prop('disabled', true);
            $('#priceError').text('');

            if (quantityInput === '') {
                $('#priceError').text('Моля, въведете количество.');
                return;
            }

            let quantity = Number(quantityInput);

            if (!Number.isSafeInteger(quantity) || quantity < 1) {
                $('#priceError').text('Моля, въведете валидно количество.');
                return;
            }

            if (quantity > stock) {
                $('#priceError').text('Няма повече количество от това, което сте поискали.');
                return;
            }

            let unitPrice = null;
            let originalPrice = null;
            let highestMin = -1;

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

        function initializeMobileCartBar() {
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
        }

        function initializeCustomOfferModal() {
            const modalElement = document.getElementById('customOfferModal');
            const form = document.getElementById('customOfferForm');

            if (!modalElement || !form) {
                return;
            }

            const modal = bootstrap.Modal.getOrCreateInstance(modalElement);

            $('#customOfferButton').on('click', function() {
                modal.show();
            });

            // AJAX submission

            $(form).on('submit', function(event) {
                event.preventDefault();

                const $form = $(this);
                const $button = $('#customOfferSubmit');

                // Remove previous errors
                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.invalid-feedback').remove();

                $button.prop('disabled', true).text('Изпращане...');

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $form.find('input[name="_token"]').val(),
                        'Accept': 'application/json'
                    },

                    success: function(response) {
                        $('#customOfferMessage')
                            .removeClass('d-none alert-danger')
                            .addClass('alert alert-success')
                            .text(response.message);

                        form.reset();
                    },

                    error: function(xhr) {
                        console.log(xhr.responseJSON.errors);
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;

                            $.each(errors, function(field, messages) {
                                const $input = $form.find('[name="' + field + '"]');

                                $input.addClass('is-invalid');

                                $input.after(
                                    $('<div class="invalid-feedback d-block"></div>')
                                    .text(messages[0])
                                );
                            });

                            // Scroll to the first invalid field in the form
                            const firstInvalid = $form.find('.is-invalid')[0];

                            if (firstInvalid) {
                                firstInvalid.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                            }
                        }
                    },

                    complete: function() {
                        $button.prop('disabled', false).text('Изпрати запитване');
                    }
                });
            });


            // Remove validation error when editing an input
            $(form).on('input', 'input', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            // Reset modal when closed
            $(modalElement).on('hidden.bs.modal', function() {
                form.reset();

                $(form).find('.is-invalid').removeClass('is-invalid');
                $(form).find('.invalid-feedback').remove();

                $('#customOfferMessage')
                    .addClass('d-none')
                    .removeClass('alert alert-success alert-danger')
                    .text('');
            });
        }
    </script>


</x-frontend>
