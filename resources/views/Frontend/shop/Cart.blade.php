<x-frontend>
    @section('SEO')
        <title>Количка | ЮКОН ООД – Кашони и опаковки от велпапе</title>
        <meta name="description"
            content="Прегледайте избраните кашони и опаковки от велпапе в количката на ЮКОН ООД. Проверете количествата, единичните цени и стойността на поръчката.">
        <meta name="robots" content="noindex,nofollow">
        <meta name="googlebot" content="noindex,nofollow">
        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ЮКОН ООД">
        <meta property="og:title" content="Количка | ЮКОН ООД">
        <meta property="og:description" content="Прегледайте продуктите, количествата и цените във вашата количка.">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Количка | ЮКОН ООД">
        <meta name="twitter:description" content="Вашата количка с кашони и опаковки от велпапе.">
        <meta name="author" content="ЮКОН ООД">
        <meta name="application-name" content="ЮКОН ООД">
    @endsection

    <section class="promo-sec bg-cover jarallax" data-jarallax data-speed=".4">
        <div class="parallax-overly"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="promo-wrap">
                        <h1 class="display-2 text-info">Количка</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Начало</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Количка</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cart-section sec-padding yk-cart">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    @foreach ($errors->all() as $error)
                        <p class="mb-1">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (count($products))
                @php
                    $cartQuantity = collect($products)->sum(fn($item) => (int) $item['quantity']);
                @endphp
                <div class="row g-4 align-items-start">
                    <div class="col-lg-8">
                        <div class="yk-card">
                            <div class="yk-cart-header">
                                <h2 class="yk-heading mb-0">Вашите продукти</h2>
                                <span class="yk-count">{{ $cartQuantity }} бр. общо</span>
                            </div>

                            @foreach ($products as $key => $product)
                                @php
                                    $qty = (int) $product['quantity'];
                                    $unit = (float) $product['final_price'];
                                    $lineTotal = round($qty * $unit, 2);
                                    $discount = (float) ($product['discount'] ?? 0);
                                @endphp
                                <article class="yk-item">
                                    <a class="yk-thumb" href="{{ route('shop.show', $product['slug']) }}">
                                        <img src="{{ asset('assets/images/products/' . $product['image']) }}"
                                            alt="{{ $product['name'] }}" loading="lazy">
                                    </a>
                                    <div>
                                        <a class="yk-product-name" href="{{ route('shop.show', $product['slug']) }}">
                                            {{ $product['name'] }}
                                        </a>
                                        <div class="yk-unit">
                                            @if ($discount > 0)
                                                <del>{{ number_format((float) $product['price'], 2, '.', ' ') }} €</del>
                                                <span class="yk-discount">-{{ $product['discount'] }}%</span>
                                                <br>
                                            @endif
                                            <strong>{{ number_format($unit, 2, '.', ' ') }} €</strong> / бр.
                                        </div>
                                        <span class="yk-quantity">{{ $qty }} бр.</span>
                                    </div>
                                    <div class="yk-item-end text-lg-end">
                                        <div>
                                            <small class="yk-muted d-block mb-1">Общо</small>
                                            <div class="yk-line-total">{{ number_format($lineTotal, 2, '.', ' ') }} €
                                            </div>
                                        </div>
                                        <form action="{{ route('cart.remove', $key) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="yk-remove"
                                                aria-label="Премахни {{ $product['name'] }} от количката">
                                                <i class="fa-regular fa-trash-can me-1" aria-hidden="true"></i>
                                                Премахни
                                            </button>
                                        </form>
                                    </div>
                                </article>
                            @endforeach
                            <div class="yk-card-footer">
                                <a class="yk-continue" href="{{ route('shop.index') }}">
                                    <i class="fa fa-arrow-left me-2" aria-hidden="true"></i> Продължи пазаруването
                                </a>
                            </div>
                        </div>

                        {{-- Mobile/tablet: expandable order breakdown, no extra JS needed. --}}
                        <details class="yk-card yk-mobile-review" id="mobileOrderReview">
                            <summary>
                                <span><i class="fa-solid fa-receipt me-2" aria-hidden="true"></i>Прегледай
                                    поръчката</span>
                                <strong>{{ number_format($subtotal, 2, '.', ' ') }} €</strong>
                            </summary>
                            <div class="yk-summary">
                                <h3 class="yk-summary-title">Вашата поръчка</h3>
                                @foreach ($products as $product)
                                    <div class="yk-summary-item">
                                        <div>
                                            <span>{{ $product['name'] }}</span>
                                            <small>{{ (int) $product['quantity'] }} бр. ×
                                                {{ number_format((float) $product['final_price'], 2, '.', ' ') }}
                                                €</small>
                                        </div>
                                        <strong>{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                            €</strong>
                                    </div>
                                @endforeach
                                <div class="yk-summary-row mt-2">
                                    <span>Междинна сума</span>
                                    <strong>{{ number_format($subtotal, 2, '.', ' ') }} €</strong>
                                </div>
                                <div class="yk-summary-row">
                                    <span>Доставка</span>
                                    <span class="yk-muted">Уточнява се при поръчка</span>
                                </div>
                                <div class="yk-summary-total">
                                    <span>Общо за продуктите</span>
                                    <strong>{{ number_format($subtotal, 2, '.', ' ') }} €</strong>
                                </div>
                            </div>
                        </details>
                        <div class="d-lg-none mt-3">
                            <a class="yk-checkout" href="{{ route('checkout') }}">
                                Продължи към плащане <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 yk-desktop-summary">
                        <aside class="yk-card yk-summary">
                            <h3 class="yk-summary-title">Вашата поръчка</h3>
                            @foreach ($products as $product)
                                <div class="yk-summary-item">
                                    <div>
                                        <span>{{ $product['name'] }}</span>
                                        <small>{{ (int) $product['quantity'] }} бр. ×
                                            {{ number_format((float) $product['final_price'], 2, '.', ' ') }} €</small>
                                    </div>
                                    <strong>{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                        €</strong>
                                </div>
                            @endforeach
                            <div class="yk-summary-row mt-2">
                                <span>Междинна сума</span>
                                <strong>{{ number_format($subtotal, 2, '.', ' ') }} €</strong>
                            </div>
                            <div class="yk-summary-row">
                                <span>Доставка</span>
                                <span class="yk-muted">Уточнява се при поръчка</span>
                            </div>
                            <div class="yk-summary-total">
                                <span>Общо за продуктите</span>
                                <strong>{{ number_format($subtotal, 2, '.', ' ') }} €</strong>
                            </div>
                            <a class="yk-checkout" href="{{ route('checkout') }}">
                                Продължи към плащане <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                            <p class="yk-note">Доставката се уточнява при поръчка.</p>
                        </aside>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="yk-card yk-empty">
                            <div class="yk-empty-icon"><i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                            </div>
                            <h2 class="yk-heading">Количката Ви е празна</h2>
                            <p class="yk-muted my-3">Все още нямате добавени продукти. Разгледайте нашите кашони и
                                опаковки от велпапе и изберете подходящите за Вас.</p>
                            <a href="{{ route('shop.index') }}" class="yk-checkout d-inline-flex px-4">Разгледайте
                                продуктите <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-frontend>
