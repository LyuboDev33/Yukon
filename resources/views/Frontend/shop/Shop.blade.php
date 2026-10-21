<x-frontend>
    @section('SEO')
        <title>Онлайн магазин | ЮКОН</title>
        <meta name="description" content="Разгледайте продуктите, кашоните и опаковките в онлайн магазина на ЮКОН.">
        <meta name="robots" content="index,follow,max-image-preview:large">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ЮКОН">
        <meta property="og:title" content="Онлайн магазин | ЮКОН">
        <meta property="og:description" content="Кашони и опаковки от велпапе.">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">
        <link href="/assets/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.6.2/dist/js/tom-select.complete.min.js"></script>
    @endsection


    {{-- New template: products left, sidebar right --}}
    <section class="shop-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-9 pe-lg-4">
                    <div class="shop-wrapper">
                        <div class="shop-filters d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="result d-flex align-items-center gap-2">
                                <p class="m-0">
                                    Показване на {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                                    от {{ $products->total() }} продукта
                                </p>
                            </div>
                            <button type="button" class="btn btn-outline-dark d-lg-none" id="shopSidebarToggle"
                                aria-controls="shopFiltersSidebar" aria-expanded="false">
                                <i class="fa-solid fa-sliders me-2"></i> Филтри и категории
                            </button>
                        </div>

                        <div class="row products mt-4 g-4">

                            @forelse ($products as $product)

                                @php
                                    $prices = $product->prices->sortBy('min_quantity');
                                @endphp

                                <div class="col-xl-4 col-md-6 col-sm-6">

                                    <div class="product-entry shadow h-100 d-flex flex-column">

                                        <div class="product-thumb position-relative">

                                            @if ($product->discount)
                                                <div class="badge text-uppercase">
                                                    -{{ $product->discount }}%
                                                </div>
                                            @endif

                                            <a href="{{ route('shop.show', $product->slug) }}">
                                                <img class="img-fluid"
                                                    src="{{ $product->main_image
                                                        ? asset('assets/images/products/' . $product->main_image)
                                                        : asset('assets/images/shop/shop-product-1-1.jpg') }}"
                                                    alt="{{ $product->name }}" loading="lazy">
                                            </a>

                                            <div class="product-cta">

                                                <a href="{{ route('shop.show', $product->slug) }}"
                                                    title="Разгледай продукта"
                                                    aria-label="Разгледай {{ $product->name }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>

                                                {{-- @php
                                                    $wishlist = Session::get('wishlist', []);
                                                    $isInWishlist = isset($wishlist[$product->id]);
                                                @endphp

                                                <form action="{{ route('wishlist.add', $product) }}" method="POST"
                                                    class="wishlist-form m-0">

                                                    @csrf

                                                    <button type="submit" title="Добави в любими"
                                                        aria-label="Добави {{ $product->name }} в любими"
                                                        class="wishlist-btn">

                                                        <i
                                                            class="{{ $isInWishlist ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>

                                                    </button>

                                                </form> --}}

                                            </div>

                                        </div>

                                        <div class="product-txt d-flex flex-column flex-grow-1">

                                            @if ($product->categories->isNotEmpty())
                                                <p class="small text-muted mb-2">
                                                    {{ $product->categories->pluck('name')->join(' · ') }}
                                                </p>
                                            @endif

                                            <h3>
                                                <a href="{{ route('shop.show', $product->slug) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </h3>

                                            @if ($product->brand)
                                                <p class="small text-muted mb-2">
                                                    Марка: <strong>{{ $product->brand }}</strong>
                                                </p>
                                            @endif

                                            {{-- Quantity-based pricing --}}
                                            <div class="product-prices mt-3 mb-3">


                                                @if ($prices->isNotEmpty())
                                                    <div class="product-tier-prices mt-3">

                                                        <p class="fw-semibold small mb-2">
                                                            Цени според количеството:
                                                        </p>

                                                        <div class="d-flex flex-column gap-2">

                                                            @foreach ($prices as $price)
                                                                <div class="product-tier-price">

                                                                    <span class="product-tier-price__quantity">
                                                                        @if ($price->max_quantity)
                                                                            {{ $price->min_quantity }}–{{ $price->max_quantity }}
                                                                            бр.
                                                                        @else
                                                                            {{ $price->min_quantity }}+ бр.
                                                                        @endif
                                                                    </span>

                                                                    <span class="product-tier-price__value">

                                                                        @if ($product->discount)
                                                                            <strong>
                                                                                {{ number_format($price->price * (1 - $product->discount / 100), 2) }}
                                                                                €
                                                                            </strong>

                                                                            <del>
                                                                                {{ number_format($price->price, 2) }} €
                                                                            </del>
                                                                        @else
                                                                            <strong>
                                                                                {{ number_format($price->price, 2) }} €
                                                                            </strong>
                                                                        @endif

                                                                    </span>

                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                @else
                                                    <p class="text-muted small mb-0">
                                                        Цена при запитване
                                                    </p>
                                                @endif


                                            </div>

                                            @if ($product->stock <= 0)
                                                <div class="mb-3">
                                                    <span class="badge bg-danger">
                                                        Няма наличност
                                                    </span>
                                                </div>
                                            @endif

                                            {{-- View product button --}}
                                            <div>

                                                <a href="{{ route('shop.show', $product->slug) }}"
                                                    class="btn btn-primary w-100 rounded-3">

                                                    Разгледай
                                                    <i class="fa-solid fa-arrow-right ms-2"></i>

                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        {{ $category ? 'Няма налични продукти с избраните филтри.' : 'Все още няма налични продукти.' }}
                                    </div>
                                </div>

                            @endforelse

                        </div>

                        @if ($products->hasPages())
                            <div class="mt-5 d-flex justify-content-center overflow-auto">
                                {{ $products->onEachSide(1)->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="shop-sidebar-overlay" id="shopSidebarOverlay"></div>
                    <aside class="sidebar product-sidebar" id="shopFiltersSidebar" aria-label="Филтри и категории">
                        <div class="d-lg-none d-flex justify-content-between align-items-center mb-3">
                            <strong>Филтри</strong>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="shopSidebarClose"
                                aria-label="Затвори филтрите">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="widget search-widget">
                            <h3 class="widget-title">Филтри</h3>
                            <div class="widget-inner">
                                <form method="GET" action="{{ url()->current() }}" id="shopFiltersForm">
                                    @foreach ($filters as $filter)
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="filter-{{ $filter['slug'] }}">{{ $filter['name'] }}</label>
                                            <select id="filter-{{ $filter['slug'] }}" name="{{ $filter['slug'] }}"
                                                class="form-select attribute-choice">
                                                <option value="">Всички</option>
                                                @foreach ($filter['values'] as $value)
                                                    <option value="{{ $value['slug'] }}" @selected(request()->filled($filter['slug']) && request($filter['slug']) === $value['slug'])>
                                                        {{ $value['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label class="form-label" for="stock">Наличност</label>
                                        <select id="stock" name="stock" class="form-select attribute-choice">
                                            <option value="">Всички продукти</option>
                                            <option value="in_stock" @selected(request('stock') === 'in_stock')>В наличност</option>
                                            <option value="out_of_stock" @selected(request('stock') === 'out_of_stock')>Изчерпани
                                            </option>
                                        </select>
                                    </div>

                                    <div class="price-filter mb-4">
                                        <div class="price-filter__header d-flex flex-column mb-2">
                                            <label for="priceRange">Максимална цена</label>
                                            <span>До <strong
                                                    id="priceRangeValue">{{ request('price-range', 10000) }}</strong>
                                                €</span>
                                        </div>
                                        <input type="range" id="priceRange" name="price-range" min="0"
                                            max="10000" step="10"
                                            value="{{ request('price-range', 10000) }}" class="w-100">
                                        <div class="price-filter__limits d-flex justify-content-between">
                                            <span>0 €</span><span>10 000 €</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button type="submit" class="btn btn-primary">Филтрирай</button>
                                        <a href="{{ url()->current() }}"
                                            class="btn btn-outline-secondary">Изчисти</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="widget category-widget">
                            <h3 class="widget-title">Категории</h3>
                            <div class="widget-inner">
                                <ul class="list-unstyled shop-category__tree">
                                    <li class="{{ $category ? '' : 'active' }}">
                                        <a href="{{ route('shop.index') }}">Всички продукти</a>
                                    </li>
                                    @foreach ($categoriesTree as $node)
                                        @include('Frontend.shop.partials.category-tree', [
                                            'node' => $node,
                                            'activeSlug' => $category?->slug,
                                        ])
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('shopSidebarToggle');
            const close = document.getElementById('shopSidebarClose');
            const sidebar = document.getElementById('shopFiltersSidebar');
            const overlay = document.getElementById('shopSidebarOverlay');
            const priceRange = document.getElementById('priceRange');
            const priceValue = document.getElementById('priceRangeValue');

            function setSidebar(open) {
                if (!sidebar || !overlay) return;
                sidebar.classList.toggle('active', open);
                overlay.classList.toggle('active', open);
                document.body.classList.toggle('shop-sidebar-open', open);
                if (toggle) toggle.setAttribute('aria-expanded', String(open));
            }

            if (toggle) toggle.addEventListener('click', () => setSidebar(true));
            if (close) close.addEventListener('click', () => setSidebar(false));
            if (overlay) overlay.addEventListener('click', () => setSidebar(false));
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') setSidebar(false);
            });

            function updatePriceRange() {
                if (!priceRange || !priceValue) return;
                const percent = (Number(priceRange.value) / Number(priceRange.max || 1)) * 100;
                priceValue.textContent = Number(priceRange.value).toLocaleString('bg-BG');
                priceRange.style.background =
                    `linear-gradient(to right, #fc5523 0%, #fc5523 ${percent}%, #e6e6e6 ${percent}%, #e6e6e6 100%)`;
            }

            if (priceRange) {
                priceRange.addEventListener('input', updatePriceRange);
                updatePriceRange();
            }

            // Initialize Tom Select only when available; avoid initializing a select twice.
            if (typeof TomSelect !== 'undefined') {
                document.querySelectorAll('#shopFiltersForm select.attribute-choice').forEach(function(select) {
                    if (!select.tomselect) {
                        new TomSelect(select, {
                            allowEmptyOption: true,
                            create: false,
                            maxOptions: 200,
                            placeholder: 'Избери...',
                        });
                    }
                });
            }
        });
    </script>
</x-frontend>
