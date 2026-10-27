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
    @endsection

    <section class="catalog">
        <div class="container">

            {{-- Toolbar --}}
            <div class="catalog-toolbar">

                <div class="catalog-toolbar__summary">
                    <span class="catalog-toolbar__search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>

                    <span>
                        Показване на
                        <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong>
                        от
                        <strong>{{ $products->total() }}</strong>
                        продукта
                    </span>
                </div>

                <div class="catalog-toolbar__actions">

                    {{-- Desktop categories dropdown --}}
                    <div class="catalog-dropdown" data-catalog-dropdown>
                        <button type="button" class="catalog-pill catalog-pill--outline catalog-dropdown__trigger"
                            aria-expanded="false" aria-controls="catalogCategoriesDropdown">
                            <i class="fa-solid fa-layer-group"></i>
                            Категории
                            <i class="fa-solid fa-chevron-down catalog-pill__chevron"></i>
                        </button>

                        <div class="catalog-dropdown__panel catalog-categories-panel" id="catalogCategoriesDropdown"
                            hidden>
                            <div class="catalog-panel__heading">
                                <span>Категории</span>
                                <a href="{{ route('shop.index') }}">Всички продукти</a>
                            </div>

                            <ul class="catalog-category-tree">
                                @foreach ($categoriesTree as $node)
                                    @include('Frontend.shop.partials.category-tree', [
                                        'node' => $node,
                                        'activeSlug' => $category?->slug,
                                    ])
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Desktop filters dropdown --}}
                    <div class="catalog-dropdown" data-catalog-dropdown>
                        <button type="button" class="catalog-pill catalog-dropdown__trigger" aria-expanded="false"
                            aria-controls="catalogFiltersDropdown">
                            <i class="fa-solid fa-sliders"></i>
                            Филтри
                            <i class="fa-solid fa-chevron-down catalog-pill__chevron"></i>
                        </button>

                        <div class="catalog-dropdown__panel catalog-filters-panel" id="catalogFiltersDropdown" hidden>
                            <div class="catalog-panel__heading">
                                <span>Филтрирай продуктите</span>
                            </div>

                            @include('Frontend.shop.partials.catalog-filters')
                        </div>

                    </div>

                    {{-- Mobile sidebar trigger --}}
                    <button type="button" class="catalog-pill catalog-pill--mobile" id="catalogSidebarOpen"
                        aria-controls="catalogSidebar" aria-expanded="false">
                        <i class="fa-solid fa-sliders"></i>
                        Категории и филтри
                    </button>


                        {{-- Currently applied filters: outside the dropdown --}}
                        @include('Frontend.shop.partials.applied-filters')

                </div>
            </div>

                                                                        @include('Frontend.shop.partials.breadcrumb', $breadcrumbs ?? [])


            {{-- Active category / results --}}
            @if ($category)
                <div class="catalog-current-category">
                    <span>Категория:</span>
                    <strong>{{ $category->name }}</strong>
                    <a href="{{ route('shop.index') }}" aria-label="Премахни категорията">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            @endif

            {{-- Products --}}
            <div class="catalog-products">

                @forelse ($products as $product)
                    @php
                        $prices = $product->prices->sortBy('min_quantity');
                    @endphp

                    <article class="catalog-product">

                        <div class="catalog-product__image">
                            @if ($product->discount)
                                <span class="catalog-product__discount">
                                    -{{ $product->discount }}%
                                </span>
                            @endif

                            <a href="{{ route('shop.show', $product->slug) }}">
                                <img src="{{ $product->main_image
                                    ? asset('assets/images/products/' . $product->main_image)
                                    : asset('assets/images/shop/shop-product-1-1.jpg') }}"
                                    alt="{{ $product->name }}" loading="lazy">
                            </a>

                            <a href="{{ route('shop.show', $product->slug) }}" class="catalog-product__quick-view"
                                aria-label="Разгледай {{ $product->name }}">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </div>

                        <div class="catalog-product__body">

                            @if ($product->categories->isNotEmpty())
                                <div class="catalog-product__categories">
                                   <p class="text-xl-start"> {{ $product->categories->pluck('name')->join(' > ') }}</p>
                                </div>
                            @endif

                            <h2 class="catalog-product__title">
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h2>

                            @if ($product->brand)
                                <p class="catalog-product__brand">
                                    Марка: <strong>{{ $product->brand }}</strong>
                                </p>
                            @endif

                            <div class="catalog-product__prices">
                                @if ($prices->isNotEmpty())
                                    <div class="catalog-product__prices-title">
                                        Цени според количеството
                                    </div>

                                    @foreach ($prices as $price)
                                        <div class="catalog-price-row">
                                            <span>
                                                @if ($price->max_quantity)
                                                    {{ $price->min_quantity }}–{{ $price->max_quantity }} бр.
                                                @else
                                                    {{ $price->min_quantity }}+ бр.
                                                @endif
                                            </span>

                                            <span class="catalog-price-row__amount">
                                                @if ($product->discount)
                                                    <strong>
                                                        {{ number_format($price->price * (1 - $product->discount / 100), 2) }}
                                                        €
                                                    </strong>
                                                    <del>{{ number_format($price->price, 2) }} €</del>
                                                @else
                                                    <strong>{{ number_format($price->price, 2) }} €</strong>
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="catalog-product__unpriced">
                                        Цена при запитване
                                    </p>
                                @endif
                            </div>

                            @if ($product->stock <= 0)
                                <span class="catalog-product__stock">
                                    Няма наличност
                                </span>
                            @endif

                            <a href="{{ route('shop.show', $product->slug) }}" class="catalog-product__button">
                                Разгледай
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>
                    </article>

                @empty
                    <div class="catalog-empty">
                        <i class="fa-solid fa-box-open"></i>
                        <h3>Няма намерени продукти</h3>
                        <p>
                            {{ $category ? 'Няма налични продукти с избраните филтри.' : 'Все още няма налични продукти.' }}
                        </p>
                        <a href="{{ route('shop.index') }}" class="catalog-product__button">
                            Покажи всички продукти
                        </a>
                    </div>
                @endforelse

            </div>

            @if ($products->hasPages())
                <div class="catalog-pagination">
                    {{ $products->onEachSide(1)->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </section>

    {{-- Mobile sidebar --}}
    <div class="catalog-overlay" id="catalogOverlay"></div>

    <aside class="catalog-sidebar" id="catalogSidebar" aria-label="Категории и филтри" aria-hidden="true" inert>
        <div class="catalog-sidebar__header">

            <button type="button" id="catalogSidebarClose" aria-label="Затвори">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="catalog-sidebar__content">

            <div class="catalog-sidebar__section">
                <h3>Категории</h3>

                <a href="{{ route('shop.index') }}" class="catalog-sidebar__all {{ $category ? '' : 'is-active' }}">
                    Всички продукти
                </a>

                <ul class="catalog-category-tree">
                    @foreach ($categoriesTree as $node)
                        @include('Frontend.shop.partials.category-tree', [
                            'node' => $node,
                            'activeSlug' => $category?->slug,
                        ])
                    @endforeach
                </ul>
            </div>

            <hr>

            <div class="catalog-sidebar__section">
                <h3>Филтри</h3>
                @include('Frontend.shop.partials.catalog-filters')
            </div>

        </div>
    </aside>

    <script>
        $(document).ready(function() {
            initCatalogDropdowns();
            initCatalogSidebar();
            initCatalogOutsideClick();
            initCatalogKeyboardEvents();
            initCatalogCategoryTree();
            initCatalogFilters();
        });

        /**
         * Desktop categories and filters dropdowns.
         */
        function initCatalogDropdowns() {
            $('[data-catalog-dropdown]').each(function() {
                const dropdown = $(this);
                const trigger = dropdown.find('.catalog-dropdown__trigger').first();
                const panel = dropdown.find('.catalog-dropdown__panel').first();

                if (!trigger.length || !panel.length) return;

                trigger.on('click', function(event) {
                    event.stopPropagation();

                    const willOpen = panel.attr('hidden') !== undefined;

                    closeCatalogDropdowns(dropdown);

                    if (willOpen) {
                        panel.removeAttr('hidden');
                        dropdown.addClass('is-open');
                        trigger.attr('aria-expanded', 'true');
                    } else {
                        panel.attr('hidden', '');
                        dropdown.removeClass('is-open');
                        trigger.attr('aria-expanded', 'false');
                    }
                });
            });
        }

        function closeCatalogDropdowns(except = null) {
            $('[data-catalog-dropdown]').each(function() {
                const dropdown = $(this);

                if (except && dropdown[0] === except[0]) return;

                dropdown.find('.catalog-dropdown__panel').first().attr('hidden', '');
                dropdown.find('.catalog-dropdown__trigger').first().attr('aria-expanded', 'false');
                dropdown.removeClass('is-open');
            });
        }

        /**
         * Mobile sidebar.
         */
        function initCatalogSidebar() {
            const sidebar = $('#catalogSidebar');
            const overlay = $('#catalogOverlay');
            const openButton = $('#catalogSidebarOpen');
            const closeButton = $('#catalogSidebarClose');

            function setSidebarOpen(open) {
                if (!sidebar.length || !overlay.length) return;

                sidebar.toggleClass('is-open', open);
                overlay.toggleClass('is-visible', open);
                $('body').toggleClass('catalog-sidebar-open', open);

                sidebar.attr('aria-hidden', String(!open));
                sidebar.prop('inert', !open);
                openButton.attr('aria-expanded', String(open));

                if (open) {
                    closeCatalogDropdowns();
                    closeButton.trigger('focus');
                } else {
                    openButton.trigger('focus');
                }
            }

            openButton.on('click', function() {
                setSidebarOpen(true);
            });

            closeButton.on('click', function() {
                setSidebarOpen(false);
            });

            overlay.on('click', function() {
                setSidebarOpen(false);
            });

            window.setCatalogSidebarOpen = setSidebarOpen;
        }

        /**
         * Close desktop dropdowns when clicking outside.
         */
        function initCatalogOutsideClick() {
            $(document).on('click', function(event) {
                if (!$(event.target).closest('[data-catalog-dropdown]').length) {
                    closeCatalogDropdowns();
                }

                // Close individual filter panels when clicking outside their form.
                if (!$(event.target).closest('.catalog-filter-form').length) {
                    closeCatalogFilterPanels();
                }
            });
        }

        /**
         * Escape closes dropdowns, filter panels, and the mobile sidebar.
         */
        function initCatalogKeyboardEvents() {
            $(document).on('keydown', function(event) {
                if (event.key !== 'Escape') return;

                closeCatalogDropdowns();
                closeCatalogFilterPanels();

                if ($('#catalogSidebar').hasClass('is-open')) {
                    window.setCatalogSidebarOpen?.(false);
                }
            });
        }

        /**
         * Category tree.
         */
        function initCatalogCategoryTree() {
            $('.catalog-category-tree').each(function() {
                const tree = $(this);
                const activeItem = tree.find('.shop-category__item.active').first();

                if (activeItem.length) {
                    let item = activeItem;

                    while (item.length) {
                        item.addClass('open');

                        item.children('.shop-category__row')
                            .find('.category-toggle')
                            .first()
                            .attr('aria-expanded', 'true');

                        item = item.parent().closest('.shop-category__item');
                    }
                }

                tree.on('click', '.category-toggle', function(event) {
                    event.preventDefault();

                    const button = $(this);
                    const item = button.closest('.shop-category__item');
                    const willOpen = !item.hasClass('open');

                    item.toggleClass('open', willOpen);
                    button.attr('aria-expanded', String(willOpen));
                });
            });
        }

        /**
         * Individual attribute filter dropdowns.
         * Explicitly removes and restores the hidden attribute.
         */
        function initCatalogFilters() {
            $(document).on('click', '.catalog-filter-trigger', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const trigger = $(this);
                const panelId = trigger.attr('aria-controls');

                if (!panelId) return;

                // Search by ID directly. This also works when the partial
                // is rendered in both the desktop dropdown and mobile sidebar.
                const panel = document.getElementById(panelId);

                if (!panel) {
                    console.error('Catalog filter panel not found:', panelId);
                    return;
                }

                const willOpen = panel.hasAttribute('hidden');

                // Close all filter panels first.
                closeCatalogFilterPanels();

                if (willOpen) {
                    // THE IMPORTANT PART: remove the actual HTML attribute.
                    panel.removeAttribute('hidden');

                    trigger.attr('aria-expanded', 'true');
                    trigger.closest('.catalog-filter-item').addClass('is-open');
                } else {
                    panel.setAttribute('hidden', '');

                    trigger.attr('aria-expanded', 'false');
                    trigger.closest('.catalog-filter-item').removeClass('is-open');
                }
            });

            // Update the selected value displayed in the filter heading.
            $(document).on('change', '.catalog-filter-select', function() {
                const select = $(this);
                const selectedValue = select.val();
                const selectedText = select.find('option:selected').text();
                const item = select.closest('.catalog-filter-item');

                item.find('.catalog-filter-trigger__selected')
                    .text(selectedValue ? selectedText : 'Всички');
            });

            // Initialize Choices.js if it is loaded.
            if (typeof Choices !== 'undefined') {
                $('.catalog-filter-select').each(function() {
                    if (this.choicesInstance) return;

                    this.choicesInstance = new Choices(this, {
                        searchEnabled: true,
                        searchPlaceholderValue: 'Търси...',
                        itemSelectText: '',
                        shouldSort: false,
                        allowHTML: false,
                        placeholder: true,
                        placeholderValue: 'Изберете от падащото меню',
                        searchResultLimit: 200,
                        renderChoiceLimit: -1,
                        noResultsText: 'Няма намерени резултати',
                        noChoicesText: 'Няма налични опции'
                    });
                });
            }
        }

        /**
         * Hide all individual filter panels.
         */
        function closeCatalogFilterPanels() {
            document.querySelectorAll('.catalog-filter-panel').forEach(function(panel) {
                panel.setAttribute('hidden', '');
            });

            document.querySelectorAll('.catalog-filter-trigger').forEach(function(trigger) {
                trigger.setAttribute('aria-expanded', 'false');
            });

            document.querySelectorAll('.catalog-filter-item').forEach(function(item) {
                item.classList.remove('is-open');
            });
        }
    </script>
</x-frontend>
