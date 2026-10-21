<x-backend>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <h3 class="mb-0">Всички продукти админ табло</h3>

        <div class="product-search-bar d-flex gap-2">

            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass product-search-icon"></i>
                <input type="text" class="form-control product-search-input" placeholder="Търси по име">
            </div>

            <div class="position-relative">
                <i class="fa-solid fa-barcode product-search-icon"></i>
                <input type="text" class="form-control product-search-input" placeholder="Търси по каталожен номер">
            </div>

        </div>

        <a class="btn btn-secondary rounded-pill px-4" href="{{ route('admin.products.create') }}">
            <i class="fa-solid fa-plus me-2"></i>
            Създай продукт
        </a>

    </div>

    <hr>

    {{-- ================= FLASH MESSAGES ================= --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ================= PRODUCTS ================= --}}

    <section class="product">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="product__items">

                        {{-- ================= RESULTS HEADER ================= --}}

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="product__showing-result">
                                    <div class="product__showing-text-box">

                                        <p class="product__showing-text">
                                            Показване на
                                            {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                                            от {{ $products->total() }} общо
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ================= PRODUCTS GRID ================= --}}

                        <div class="product__all">
                            <div class="row g-4">

                                @forelse ($products as $product)

                                    <div class="col-xl-3 col-lg-4 col-md-6">

                                        <div class="product__all-single shadow bg-white h-100 d-flex flex-column">

                                            {{-- ================= PRODUCT IMAGE ================= --}}

                                            <div class="product__all-img">

                                                @if ($product->main_image)
                                                    <img src="{{ asset('assets/images/products/' . $product->main_image) }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="{{ asset('assets/images/shop/shop-product-1-1.jpg') }}"
                                                        alt="{{ $product->name }}">
                                                @endif

                                            </div>

                                            {{-- ================= PRODUCT CONTENT ================= --}}

                                            <div class="product__all-content d-flex flex-column flex-grow-1">

                                                {{-- PRODUCT NAME --}}

                                                <h4 class="product__all-title">

                                                    <a href="{{ route('admin.products.show', $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>

                                                </h4>

                                                {{-- SKU --}}

                                                <p class="small text-muted mb-2">
                                                    <strong>SKU:</strong>
                                                    {{ $product->sku }}
                                                </p>

                                                {{-- ================= CATEGORIES ================= --}}

                                                <div class="mb-3">

                                                    <h6 class="fw-bold mb-2">
                                                        Категории
                                                    </h6>

                                                    @if ($product->categories->isNotEmpty())
                                                        <div class="d-flex flex-wrap align-items-center gap-2">

                                                            @foreach ($product->categories as $category)
                                                                <span class="badge bg-secondary">
                                                                    {{ $category->name }}
                                                                </span>

                                                                @unless ($loop->last)
                                                                    <i class="fa-solid fa-arrow-right text-muted"></i>
                                                                @endunless
                                                            @endforeach

                                                        </div>
                                                    @else
                                                        <p class="small text-muted mb-0">
                                                            Няма добавени категории.
                                                        </p>
                                                    @endif

                                                </div>

                                                {{-- ================= QUANTITY PRICING ================= --}}

                                                <div class="mb-3">

                                                    <h6 class="fw-bold mb-2">
                                                        <i class="fa-solid fa-tags me-1"></i>
                                                        Цени според количеството
                                                    </h6>

                                                    @if ($product->prices->isNotEmpty())
                                                        <div class="table-responsive">

                                                            <table
                                                                class="table table-sm table-bordered align-middle mb-0">

                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>От</th>
                                                                        <th>До</th>
                                                                        <th>Цена/бр.</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>

                                                                    @foreach ($product->prices->sortBy('min_quantity') as $price)
                                                                        <tr>

                                                                            {{-- MIN QUANTITY --}}

                                                                            <td>
                                                                                {{ $price->min_quantity }}
                                                                            </td>

                                                                            {{-- MAX QUANTITY --}}

                                                                            <td>
                                                                                {{ $price->max_quantity ?? '∞' }}
                                                                            </td>

                                                                            {{-- PRICE --}}

                                                                            <td>

                                                                                @if ($product->discount)
                                                                                    <div class="d-flex flex-column">

                                                                                        <del class="text-muted small">
                                                                                            {{ number_format($price->price, 2) }}
                                                                                            €
                                                                                        </del>

                                                                                        <span
                                                                                            class="text-danger fw-bold">
                                                                                            {{ number_format($price->price - ($price->price * $product->discount) / 100, 2) }}
                                                                                            €
                                                                                        </span>

                                                                                    </div>
                                                                                @else
                                                                                    <span class="fw-bold">
                                                                                        {{ number_format($price->price, 2) }}
                                                                                        €
                                                                                    </span>
                                                                                @endif

                                                                            </td>

                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        {{-- DISCOUNT BADGE --}}

                                                        @if ($product->discount)
                                                            <div class="mt-2">

                                                                <span class="badge bg-danger">
                                                                    Отстъпка: -{{ $product->discount }}%
                                                                </span>

                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="alert alert-warning py-2 px-3 mb-0 small">

                                                            <i class="fa-solid fa-triangle-exclamation me-1"></i>

                                                            Няма добавени цени към този продукт.

                                                        </div>
                                                    @endif

                                                </div>

                                                {{-- ================= ACTION BUTTONS ================= --}}

                                                <div
                                                    class="product__all-btn-box d-flex gap-2 flex-column pe-3 ps-3 mt-auto">

                                                    <a class="btn btn-info p-2 text-white rounded-pill"
                                                        href="{{ route('admin.products.show', $product->slug) }}">

                                                        <i class="fa-solid fa-pen-to-square me-1"></i>
                                                        Редактирай

                                                    </a>

                                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Сигурен ли си, че искаш да изтриеш този продукт?');"
                                                        class="m-0">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-danger text-white btn-sm rounded-pill p-2 w-100">

                                                            <i class="fa-solid fa-trash me-1"></i>
                                                            Изтрий

                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="col-12">

                                        <div class="alert alert-info">

                                            Все още няма създадени продукти.

                                            <a href="{{ route('admin.products.create') }}">
                                                Създай първия
                                            </a>.

                                        </div>

                                    </div>

                                @endforelse

                            </div>
                        </div>

                        {{-- ================= PAGINATION ================= --}}

                        @if ($products->hasPages())
                            <div class="row mt-4">

                                <div class="col-12 d-flex justify-content-center">
                                    {{ $products->links() }}
                                </div>

                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

</x-backend>
