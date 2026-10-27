@props(['similarProducts'])

@if ($similarProducts->isNotEmpty())
    <div class="row container m-0-auto pb-5">

        <h3 class="mb-4 mt-3 text-center">Подобни продукти</h3>

        @foreach ($similarProducts as $product)
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mt-3">
                <div class="product__all-single shadow">

                    <div class="product__all-img">
                        <a href="{{ route('shop.show', $product->slug) }}">
                            @if ($product->main_image)
                                <img src="{{ asset('/assets/images/products/' . $product->main_image) }}"
                                    alt="{{ $product->name }}" />
                            @else
                                <img src="{{ asset('assets/images/shop/shop-product-1-1.jpg') }}"
                                    alt="{{ $product->name }}" />
                            @endif
                        </a>
                    </div>



                    <div class="product__all-content">


                        <h4 class="product__all-title">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h4>

                        @if ($product->categories->isNotEmpty())
                            <p class="small text-muted text-black mb-1">
                               <b> {{ $product->categories->pluck('name')->join(' -> ') }}</b>
                            </p>
                        @endif

                        @if ($product->brand)
                            <h4 class="small mb-3 mt-3">
                                Марка: {{ $product->brand }}
                            </h4>
                        @endif

                        {{-- Quantity-Based Pricing --}}
                        <div class="product-tier-prices mt-3">


                            <p class="fw-semibold small mb-2">
                                Цени според количеството:
                            </p>

                            <div class="d-flex flex-column gap-2">

                                @forelse ($product->prices->sortBy('min_quantity') as $price)
                                    <div class="product-tier-price">

                                        <span class="product-tier-price__quantity">
                                            @if (!empty($price->max_quantity))
                                                {{ $price->min_quantity }}–{{ $price->max_quantity }} бр.
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
                                @empty
                                    <span class="text-muted small">
                                        Цена при запитване
                                    </span>
                                @endforelse

                            </div>
                        </div>

                        {{-- Product Link --}}
                        <div class="product__all-btn-box d-flex justify-content-center mt-3">
                            <a class="thm-btn product__all-btn p-2" href="{{ route('shop.show', $product->slug) }}">
                                Разгледай
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endif
