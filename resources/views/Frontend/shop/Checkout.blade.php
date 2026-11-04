<x-frontend>
    @section('SEO')
        <title>Завършване на поръчката | ЮКОН ООД</title>
        <meta name="description"
            content="Потвърдете поръчката си на кашони и опаковки от велпапе от ЮКОН ООД. Изберете доставка, въведете данните си и прегледайте стойността на продуктите.">
        <meta name="robots" content="noindex,nofollow">
        <meta name="googlebot" content="noindex,nofollow">
        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ЮКОН ООД">
        <meta property="og:title" content="Завършване на поръчката | ЮКОН ООД">
        <meta property="og:description" content="Прегледайте избраните продукти и завършете поръчката си в ЮКОН ООД.">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Завършване на поръчката | ЮКОН ООД">
        <meta name="author" content="ЮКОН ООД">
        <meta name="application-name" content="ЮКОН ООД">
        <meta name="theme-color" content="#d18b36">
    @endsection

    <section class="checkout main-content-wrapper">
        <div class="container">
            <div class="checkout__eyebrow">Последна стъпка</div>
            <h1 class="checkout__heading">Завършване на поръчката</h1>
            <p class="checkout__intro">Попълнете данните си и прегледайте поръчката преди потвърждение.</p>

            @if ($errors->any())
                <div class="alert alert-danger mb-4" role="alert">
                    <strong>Моля, проверете въведените данни.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('order.create') }}" method="POST" id="checkout-form">
                @csrf
                <input type="hidden" name="promo_code"
                    value="{{ old('promo_code', session('promo_code.promo_code_name', '')) }}">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="checkout__card shadow">
                            <div class="checkout__section-heading"><span class="checkout__number">01</span>
                                <h2>Вашите данни</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 checkout__field">
                                    <label class="checkout__label" for="fname">Име <span
                                            class="checkout__required">*</span></label>
                                    <input class="checkout__input" type="text" name="fname" id="fname"
                                        value="{{ old('fname') }}" placeholder="Вашето име" autocomplete="given-name"
                                        required>
                                    @error('fname')
                                        <div class="checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 checkout__field">
                                    <label class="checkout__label" for="lname">Фамилия <span
                                            class="checkout__required">*</span></label>
                                    <input class="checkout__input" type="text" name="lname" id="lname"
                                        value="{{ old('lname') }}" placeholder="Вашата фамилия"
                                        autocomplete="family-name" required>
                                    @error('lname')
                                        <div class="checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 checkout__field">
                                    <label class="checkout__label" for="phone">Телефон <span
                                            class="checkout__required">*</span></label>
                                    <input class="checkout__input" type="tel" name="phone" id="phone"
                                        value="{{ old('phone') }}" placeholder="08XXXXXXXX" autocomplete="tel"
                                        required>
                                    @error('phone')
                                        <div class="checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 checkout__field">
                                    <label class="checkout__label" for="email">Имейл <span
                                            class="checkout__required">*</span></label>
                                    <input class="checkout__input" type="email" name="email" id="email"
                                        value="{{ old('email') }}" placeholder="example@email.com" autocomplete="email"
                                        required>
                                    @error('email')
                                        <div class="checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="checkout__card checkout-delivery shadow">
                            <div class="checkout__section-heading"><span class="checkout__number">02</span>
                                <h2>Начин на доставка</h2>
                            </div>
                            <input type="hidden" name="delivery_method" id="delivery_method"
                                value="{{ old('delivery_method', 'personal') }}">

                            <div class="checkout__choices nav" id="checkout-delivery-tabs" role="tablist">
                                <button
                                    class="checkout__choice nav-link {{ old('delivery_method', 'personal') === 'personal' ? 'active' : '' }}"
                                    id="delivery-personal-tab" data-bs-toggle="tab"
                                    data-bs-target="#personal-delivery" type="button" role="tab"
                                    aria-controls="personal-delivery"
                                    aria-selected="{{ old('delivery_method', 'personal') === 'personal' ? 'true' : 'false' }}"
                                    data-delivery="personal">
                                    <span class="checkout__choice-icon"><i class="fa-solid fa-house"></i></span>
                                    <span><strong>Личен адрес</strong><small>Доставка до посочен адрес</small></span>
                                </button>
                                <button
                                    class="checkout__choice nav-link {{ old('delivery_method') === 'office' ? 'active' : '' }}"
                                    id="delivery-office-tab" data-bs-toggle="tab" data-bs-target="#office-delivery"
                                    type="button" role="tab" aria-controls="office-delivery"
                                    aria-selected="{{ old('delivery_method') === 'office' ? 'true' : 'false' }}"
                                    data-delivery="office">
                                    <span class="checkout__choice-icon"><i class="fa-solid fa-box"></i></span>
                                    <span><strong>Еконт</strong><small>Доставка до офис на Еконт</small></span>
                                </button>
                                <button
                                    class="checkout__choice nav-link {{ old('delivery_method') === 'speedy' ? 'active' : '' }}"
                                    id="delivery-speedy-tab" data-bs-toggle="tab" data-bs-target="#speedy-delivery"
                                    type="button" role="tab" aria-controls="speedy-delivery"
                                    aria-selected="{{ old('delivery_method') === 'speedy' ? 'true' : 'false' }}"
                                    data-delivery="speedy">
                                    <span class="checkout__choice-icon"><i class="fa-solid fa-truck-fast"></i></span>
                                    <span><strong>Спиди</strong><small>Доставка до офис на Спиди</small></span>
                                </button>
                            </div>
                            @error('delivery_method')
                                <div class="checkout__error">{{ $message }}</div>
                            @enderror
                            @error('delivery')
                                <div class="checkout__error">{{ $message }}</div>
                            @enderror

                            <div class="tab-content" id="checkout-delivery-content">
                                <div id="personal-delivery"
                                    class="checkout__panel tab-pane fade {{ old('delivery_method', 'personal') === 'personal' ? 'show active' : '' }}"
                                    role="tabpanel" aria-labelledby="delivery-personal-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-sm-6 checkout__field mb-sm-0">
                                            <label class="checkout__label" for="city">Град <span
                                                    class="checkout__required">*</span></label>
                                            <select name="city" id="city"
                                                class="checkout__input attribute-choice">
                                                <option value="">Напишете град и го изберете</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->name }}"
                                                        {{ old('city') === $city->name ? 'selected' : '' }}>
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                                <div class="checkout__error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 checkout__field mb-0">
                                            <label class="checkout__label" for="billing_address">Адрес <span
                                                    class="checkout__required">*</span></label>
                                            <input class="checkout__input" type="text" name="billing_address"
                                                id="billing_address" value="{{ old('billing_address') }}"
                                                placeholder="Улица, номер, вход, етаж..."
                                                autocomplete="street-address">
                                            @error('billing_address')
                                                <div class="checkout__error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div id="office-delivery"
                                    class="checkout__panel tab-pane fade {{ old('delivery_method') === 'office' ? 'show active' : '' }}"
                                    role="tabpanel" aria-labelledby="delivery-office-tab" tabindex="0">
                                    <div class="checkout__field mb-0">
                                        <label class="checkout__label" for="ekont_office_list">Офис на Еконт <span
                                                class="checkout__required">*</span></label>
                                        <select id="ekont_office_list" class="checkout__input" data-office-select>
                                            <option value="">Изберете офис на Еконт</option>
                                            @foreach ($ekontOffices as $office)
                                                <option value="{{ $office->name }} [{{ $office->office_id }}]"
                                                    {{ old('delivery_method') === 'office' && old('office_list') === $office->name . ' [' . $office->office_id . ']' ? 'selected' : '' }}>
                                                    {{ $office->name }} [{{ $office->office_id }}] —
                                                    {{ $office->city }} — {{ $office->full_address }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="checkout__hint">Изберете удобен офис от списъка.</div>
                                        @error('office_list')
                                            @if (old('delivery_method') === 'office')
                                                <div class="checkout__error">{{ $message }}</div>
                                            @endif
                                        @enderror
                                    </div>
                                </div>

                                <div id="speedy-delivery"
                                    class="checkout__panel tab-pane fade {{ old('delivery_method') === 'speedy' ? 'show active' : '' }}"
                                    role="tabpanel" aria-labelledby="delivery-speedy-tab" tabindex="0">
                                    <div class="checkout__field mb-0">
                                        <label class="checkout__label" for="speedy_office_list">Офис на Спиди <span
                                                class="checkout__required">*</span></label>
                                        <select id="speedy_office_list" class="checkout__input" data-office-select>
                                            <option value="">Изберете офис на Спиди</option>
                                            @foreach ($speedyOffices as $office)
                                                <option value="{{ $office->name }} [{{ $office->office_id }}]"
                                                    {{ old('delivery_method') === 'speedy' && old('office_list') === $office->name . ' [' . $office->office_id . ']' ? 'selected' : '' }}>
                                                    {{ $office->name }} [{{ $office->office_id }}] —
                                                    {{ $office->city }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="checkout__hint">Изберете удобен офис от списъка.</div>
                                        @error('office_list')
                                            @if (old('delivery_method') === 'speedy')
                                                <div class="checkout__error">{{ $message }}</div>
                                            @endif
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="office_list" id="selected_office"
                                value="{{ old('office_list') }}">
                        </div>

                        <div class="checkout__card checkout-invoice shadow">
                            <div class="checkout__section-heading"><span class="checkout__number">03</span>
                                <h2>Фактура</h2>
                            </div>
                            <label class="checkout__invoice-toggle" for="request_invoice">
                                <span><strong>Желая фактура</strong><small>Добавете фирмени данни, ако поръчвате от
                                        името на фирма.</small></span>
                                <input type="checkbox" name="request_invoice" id="request_invoice" value="1"
                                    {{ old('request_invoice') ? 'checked' : '' }}>
                            </label>
                            <div
                                class="checkout-invoice__fields checkout__invoice-fields {{ old('request_invoice') ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-sm-6 checkout__field">
                                        <label class="checkout__label" for="company_name">Име на фирма <span
                                                class="checkout__required">*</span></label>
                                        <input class="checkout__input" name="company_name" id="company_name"
                                            value="{{ old('company_name') }}" type="text">
                                        @error('company_name')
                                            <div class="checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 checkout__field">
                                        <label class="checkout__label" for="company_mol">МОЛ <span
                                                class="checkout__required">*</span></label>
                                        <input class="checkout__input" name="company_mol" id="company_mol"
                                            value="{{ old('company_mol') }}" type="text">
                                        @error('company_mol')
                                            <div class="checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 checkout__field mb-sm-0">
                                        <label class="checkout__label" for="company_bulstat">ЕИК / Булстат <span
                                                class="checkout__required">*</span></label>
                                        <input class="checkout__input" name="company_bulstat" id="company_bulstat"
                                            value="{{ old('company_bulstat') }}" type="text" inputmode="numeric">
                                        @error('company_bulstat')
                                            <div class="checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 checkout__field mb-0">
                                        <label class="checkout__label" for="company_address">Адрес на фирма <span
                                                class="checkout__required">*</span></label>
                                        <input class="checkout__input" name="company_address" id="company_address"
                                            value="{{ old('company_address') }}" type="text">
                                        @error('company_address')
                                            <div class="checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @error('company')
                                <div class="checkout__error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <aside class="checkout__summary">
                            <details class="checkout__mobile-review" id="yk-mobile-review">
                                <summary><span><i class="fa-solid fa-chevron-down me-2"></i> Прегледай
                                        поръчката</span><span
                                        class="checkout__mobile-total">{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                        €</span></summary>
                                <div class="checkout__mobile-review-body">
                                    @foreach ($products ?? [] as $product)
                                        <div class="checkout__item">
                                            <img class="checkout__item-img"
                                                src="{{ asset('assets/images/products/' . $product['image']) }}"
                                                alt="{{ $product['name'] }}" loading="lazy">
                                            <div class="checkout__item-main"><span
                                                    class="checkout__item-name">{{ $product['name'] }}</span>
                                                <div class="checkout__item-meta">{{ $product['quantity'] }} бр. ×
                                                    {{ number_format((float) $product['final_price'], 2, '.', ' ') }} €
                                                    / бр.</div>
                                            </div>
                                            <span
                                                class="checkout__item-total">{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                                €</span>
                                        </div>
                                    @endforeach
                                    @if (!empty($promoCode))
                                        <div class="checkout__row"><span>Промо код:
                                                {{ $promoCode['promo_code_name'] }}</span><strong>-{{ $promoCode['percentage_promo_code'] }}%</strong>
                                        </div>
                                    @endif
                                    <div class="checkout__row"><span>Доставка</span><strong>Уточнява се</strong>
                                    </div>
                                    <div class="checkout__row checkout__grand"><span>Общо за
                                            продуктите</span><strong>{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                            €</strong></div>
                                </div>
                            </details>

                            <div class="checkout__card shadow">
                                <div class="checkout__desktop-items">
                                    <h2 class="checkout__summary-title">Вашата поръчка</h2>
                                    @foreach ($products ?? [] as $product)
                                        <div class="checkout__item">
                                            <a href="{{ route('shop.show', $product['slug']) }}"><img
                                                    class="checkout__item-img"
                                                    src="{{ asset('assets/images/products/' . $product['image']) }}"
                                                    alt="{{ $product['name'] }}" loading="lazy"></a>
                                            <div class="checkout__item-main">
                                                <a class="checkout__item-name"
                                                    href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a>
                                                <div class="checkout__item-meta">{{ $product['quantity'] }} бр. ×
                                                    {{ number_format((float) $product['final_price'], 2, '.', ' ') }} €
                                                    / бр.</div>
                                                @if ((float) ($product['discount'] ?? 0) > 0)
                                                    <span class="checkout__discount">-{{ $product['discount'] }}%
                                                        отстъпка</span>
                                                @endif
                                            </div>
                                            <span
                                                class="checkout__item-total">{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                                €</span>
                                        </div>
                                    @endforeach
                                    @if (!empty($promoCode))
                                        <div class="checkout__row"><span>Промо код:
                                                {{ $promoCode['promo_code_name'] }}</span><strong>-{{ $promoCode['percentage_promo_code'] }}%</strong>
                                        </div>
                                        @if (isset($promoDiscount))
                                            <div class="checkout__row"><span>Отстъпка с промо
                                                    код</span><strong>-{{ number_format((float) $promoDiscount, 2, '.', ' ') }}
                                                    €</strong></div>
                                        @endif
                                    @endif
                                    <div class="checkout__row"><span>Доставка</span><strong>Уточнява се</strong>
                                    </div>
                                    <div class="checkout__row checkout__grand"><span>Общо за
                                            продуктите</span><strong>{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                            €</strong></div>
                                    <p class="checkout__note">Доставката се уточнява при потвърждаване на поръчката.
                                    </p>
                                </div>

                                <div class="checkout__promo">
                                    <h3>Имате промо код?</h3>
                                    <div class="checkout__promo-row">
                                        <input class="checkout__input" type="text" id="promo-code-input"
                                            value="{{ session('promo_code.promo_code_name', '') }}"
                                            placeholder="Въведете промо код" autocomplete="off">
                                        <button class="checkout__promo-btn" type="button"
                                            id="apply-promo-code">{{ session()->has('promo_code') ? 'Приложен' : 'Приложи' }}</button>
                                    </div>
                                    <div id="promo-code-message" class="checkout__hint" role="status"
                                        aria-live="polite"></div>
                                </div>

                                <div class="checkout__promo">
                                    <h3>Начин на плащане</h3>
                                    <label class="checkout__payment" for="cash-on-delivery">
                                        <input type="radio" name="payment_method" id="cash-on-delivery"
                                            value="cash_on_delivery" checked>
                                        <span><strong><i class="fa-solid fa-money-bill-wave me-2"></i> Плащане при
                                                получаване</strong><small>Заплащате при получаване на
                                                пратката.</small></span>
                                    </label>
                                </div>
                                <button class="checkout__submit" type="submit" id="yk-submit-order"><i
                                        class="fa-solid fa-check"></i> Завърши поръчката <i
                                        class="fa-solid fa-arrow-right"></i></button>
                                <p class="checkout__note text-center"><i class="fa-solid fa-lock me-1"></i> Данните
                                    се използват за обработка на поръчката.</p>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            checkoutDelivery();
            checkoutInvoice();
            checkoutPromo();
        });

        function checkoutDelivery() {
            const method = document.getElementById('delivery_method');
            const selectedOffice = document.getElementById('selected_office');
            const city = document.getElementById('city');
            const address = document.getElementById('billing_address');
            const ekont = document.getElementById('ekont_office_list');
            const speedy = document.getElementById('speedy_office_list');

            const tabs = document.querySelectorAll('#checkout-delivery-tabs [data-delivery]');

            function sync() {
                const isPersonal = method.value === 'personal';

                city.disabled = !isPersonal;
                city.required = isPersonal;

                address.disabled = !isPersonal;
                address.required = isPersonal;

                ekont.disabled = method.value !== 'office';
                speedy.disabled = method.value !== 'speedy';

                selectedOffice.value = method.value === 'office' ?
                    ekont.value :
                    method.value === 'speedy' ?
                    speedy.value :
                    '';
            }

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', () => {
                    method.value = tab.dataset.delivery;

                    // Clear regular inputs.
                    address.value = '';
                    selectedOffice.value = '';

                    // Reset Slim Select instances AND their visible HTML.
                    [city, ekont, speedy].forEach(select => {
                        if (select.slim) {
                            select.slim.setSelected('');
                        } else {
                            select.value = '';
                        }
                    });

                    sync();
                });
            });

            [ekont, speedy].forEach(select => {
                select.addEventListener('change', sync);
            });

            sync();
        }

        function checkoutInvoice() {
            const checkbox = document.getElementById('request_invoice');
            const fields = document.querySelector('.checkout-invoice__fields');
            if (!checkbox || !fields) return;
            const inputs = fields.querySelectorAll('input, select, textarea');

            function sync() {
                fields.classList.toggle('d-none', !checkbox.checked);
                inputs.forEach(input => {
                    input.disabled = !checkbox.checked;
                    input.required = checkbox.checked;
                });
            }
            checkbox.addEventListener('change', sync);
            sync();
        }



        function checkoutPromo() {
            const button = document.getElementById('apply-promo-code');
            const input = document.getElementById('promo-code-input');
            const message = document.getElementById('promo-code-message');
            if (!button || !input || !message) return;
            async function apply() {
                const code = input.value.trim();
                message.textContent = '';
                if (!code) {
                    message.textContent = 'Моля, въведете промо код.';
                    message.style.color = '#bd3838';
                    return;
                }
                button.disabled = true;
                button.textContent = 'Проверка...';
                try {
                    const response = await fetch(@json(route('checkout.promo.apply')), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': @json(csrf_token()),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            promo_code: code
                        })
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        const error = data.errors?.promo_code?.[0] || data.message ||
                            'Промо кодът не можа да бъде приложен.';
                        throw new Error(error);
                    }
                    window.location.reload();
                } catch (error) {
                    message.textContent = error.message || 'Възникна грешка. Опитайте отново.';
                    message.style.color = '#bd3838';
                    button.disabled = false;
                    button.textContent = 'Приложи';
                }
            }
            button.addEventListener('click', apply);
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    apply();
                }
            });
        }
    </script>
</x-frontend>
