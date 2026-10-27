@if (count(Session::get('lastViewedProducts', [])) > 0)

    <div class="row container m-0-auto pb-5">

        <h3 class="mb-4 mt-3 text-center">
            Последно разгледани продукти
        </h3>

        @foreach (Session::get('lastViewedProducts', []) as $product)
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 mt-3">

                <div class="product__all-single shadow">

                    <div class="product__all-img">

                        <a href="{{ $product['url'] }}">

                            @if (!empty($product['image']))
                                <img src="{{ asset('assets/images/products/' . $product['image']) }}"
                                    alt="{{ $product['name'] }}">
                            @else
                                <img src="{{ asset('assets/images/shop/shop-product-1-1.jpg') }}"
                                    alt="{{ $product['name'] }}">
                            @endif

                        </a>

                    </div>

                    <div class="product__all-content">

                        <h4 class="product__all-title">

                            <a href="{{ $product['url'] }}">
                                {{ $product['name'] }}
                            </a>

                        </h4>

                        <!-- Quantity-Based Pricing -->
                        <div class="product-tier-prices mt-3">

                            <p class="fw-semibold small mb-2">
                                Цени според количеството:
                            </p>

                            <div class="d-flex flex-column gap-2">

                                {{-- @dd($product) --}}

                                @if (!empty($product['categories']))
                                    <p class="small text-muted mb-1">
                                        @foreach ($product['categories'] as $category)
                                            @foreach ($category['path'] as $level)
                                                @if (!$loop->first)
                                                    &rsaquo;
                                                @endif

                                                {{ $level['name'] }}
                                            @endforeach

                                            @if (!$loop->parent->last)
                                                <span> · </span>
                                            @endif
                                        @endforeach
                                    </p>
                                @endif

                                @forelse (collect($product['prices'] ?? [])->sortBy('min_quantity') as $price)
                                    <div class="product-tier-price">

                                        <span class="product-tier-price__quantity">

                                            @if (!empty($price['max_quantity']))
                                                {{ $price['min_quantity'] }}–{{ $price['max_quantity'] }} бр.
                                            @else
                                                {{ $price['min_quantity'] }}+ бр.
                                            @endif

                                        </span>


                                        {{-- Recursive Categories --}}

                                        <span class="product-tier-price__value">

                                            @if (!empty($product['discount']))
                                                <strong>
                                                    {{ number_format($price['price'] * (1 - $product['discount'] / 100), 2) }}
                                                    €
                                                </strong>

                                                <del>
                                                    {{ number_format($price['price'], 2) }} €
                                                </del>
                                            @else
                                                <strong>
                                                    {{ number_format($price['price'], 2) }} €
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

                        <!-- Wishlist and Product Link -->
                        <div class="product__all-btn-box d-flex justify-content-center mt-3">

                            <a class="btn btn-primary product__all-btn p-2" href="{{ $product['url'] }}">

                                Разгледай

                            </a>

                            {{-- <form method="POST"
                                action="{{ route('wishlist.add', $product['id']) }}"
                                class="wishlist-form">

                                @csrf

                                <button type="submit" class="wishlist-btn">

                                    <i class="{{ isset(Session::get('wishlist', [])[$product['id']]) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>

                                </button>

                            </form> --}}

                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

@endif
