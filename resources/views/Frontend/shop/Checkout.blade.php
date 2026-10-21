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

    <section class="yk-checkout main-content-wrapper">
        <div class="container">
            <div class="yk-checkout__eyebrow">Последна стъпка</div>
            <h1 class="yk-checkout__heading">Завършване на поръчката</h1>
            <p class="yk-checkout__intro">Попълнете данните си и прегледайте поръчката преди потвърждение.</p>

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

            <form action="{{ route('order.create') }}" method="POST" id="yk-checkout-form">
                @csrf
                <input type="hidden" name="promo_code"
                    value="{{ old('promo_code', session('promo_code.promo_code_name', '')) }}">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="yk-checkout__card shadow">
                            <div class="yk-checkout__section-heading"><span class="yk-checkout__number">01</span>
                                <h2>Вашите данни</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 yk-checkout__field">
                                    <label class="yk-checkout__label" for="fname">Име <span
                                            class="yk-checkout__required">*</span></label>
                                    <input class="yk-checkout__input" type="text" name="fname" id="fname"
                                        value="{{ old('fname') }}" placeholder="Вашето име" autocomplete="given-name"
                                        required>
                                    @error('fname')
                                        <div class="yk-checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 yk-checkout__field">
                                    <label class="yk-checkout__label" for="lname">Фамилия <span
                                            class="yk-checkout__required">*</span></label>
                                    <input class="yk-checkout__input" type="text" name="lname" id="lname"
                                        value="{{ old('lname') }}" placeholder="Вашата фамилия"
                                        autocomplete="family-name" required>
                                    @error('lname')
                                        <div class="yk-checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 yk-checkout__field">
                                    <label class="yk-checkout__label" for="phone">Телефон <span
                                            class="yk-checkout__required">*</span></label>
                                    <input class="yk-checkout__input" type="tel" name="phone" id="phone"
                                        value="{{ old('phone') }}" placeholder="08XXXXXXXX" autocomplete="tel"
                                        required>
                                    @error('phone')
                                        <div class="yk-checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 yk-checkout__field">
                                    <label class="yk-checkout__label" for="email">Имейл <span
                                            class="yk-checkout__required">*</span></label>
                                    <input class="yk-checkout__input" type="email" name="email" id="email"
                                        value="{{ old('email') }}" placeholder="example@email.com" autocomplete="email"
                                        required>
                                    @error('email')
                                        <div class="yk-checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="yk-checkout__card checkout-delivery shadow">
                            <div class="yk-checkout__section-heading"><span class="yk-checkout__number">02</span>
                                <h2>Начин на доставка</h2>
                            </div>
                            <div class="yk-checkout__choices">
                                <div class="yk-checkout__choice">
                                    <input type="radio" name="delivery_method" id="delivery-personal"
                                        value="personal"
                                        {{ old('delivery_method', 'personal') === 'personal' ? 'checked' : '' }}>
                                    <label for="delivery-personal"><span class="yk-checkout__choice-icon"><i
                                                class="fa-solid fa-house"></i></span><span><strong>До личен
                                                адрес</strong><small>Доставка до посочен адрес</small></span></label>
                                </div>
                                <div class="yk-checkout__choice">
                                    <input type="radio" name="delivery_method" id="delivery-office" value="office"
                                        {{ old('delivery_method') === 'office' ? 'checked' : '' }}>
                                    <label for="delivery-office"><span class="yk-checkout__choice-icon"><i
                                                class="fa-solid fa-box"></i></span><span><strong>До офис на
                                                Еконт</strong><small>Вземане от избран офис</small></span></label>
                                </div>
                            </div>
                            @error('delivery_method')
                                <div class="yk-checkout__error">{{ $message }}</div>
                            @enderror
                            @error('delivery')
                                <div class="yk-checkout__error">{{ $message }}</div>
                            @enderror
                            <div id="personal-delivery"
                                class="yk-checkout__panel {{ old('delivery_method', 'personal') === 'personal' ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-sm-6 yk-checkout__field mb-sm-0">
                                        <label class="yk-checkout__label" for="city">Град <span
                                                class="yk-checkout__required">*</span></label>
                                        <select name="city" id="city"
                                            class="yk-checkout__input attribute-choice">
                                            <option value="">Напишете град и го изберете</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->name }}"
                                                    {{ old('city') === $city->name ? 'selected' : '' }}>
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 yk-checkout__field mb-0">
                                        <label class="yk-checkout__label" for="billing_address">Адрес <span
                                                class="yk-checkout__required">*</span></label>
                                        <input class="yk-checkout__input" type="text" name="billing_address"
                                            id="billing_address" value="{{ old('billing_address') }}"
                                            placeholder="Улица, номер, вход, етаж..." autocomplete="street-address">
                                        @error('billing_address')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="office-delivery"
                                class="yk-checkout__panel {{ old('delivery_method') === 'office' ? '' : 'd-none' }}">
                                <div class="yk-checkout__field mb-0">
                                    <label class="yk-checkout__label" for="office_list">Град / офис на Еконт <span
                                            class="yk-checkout__required">*</span></label>
                                    <select name="office_list" id="office_list"
                                        class="yk-checkout__input attribute-choice">
                                        <option value="">Изберете офис на Еконт</option>
                                        @foreach ($offices as $office)
                                            @php $officeValue = $office->name . ' [' . $office->office_id . ']'; @endphp
                                            <option value="{{ $officeValue }}"
                                                {{ old('office_list') === $officeValue ? 'selected' : '' }}>
                                                {{ $office->name }} [{{ $office->office_id }}] — {{ $office->city }}
                                                — {{ $office->full_address }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="yk-checkout__hint">Изберете удобен офис от списъка.</div>
                                    @error('office_list')
                                        <div class="yk-checkout__error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="yk-checkout__card checkout-invoice shadow">
                            <div class="yk-checkout__section-heading"><span class="yk-checkout__number">03</span>
                                <h2>Фактура</h2>
                            </div>
                            <label class="yk-checkout__invoice-toggle" for="request_invoice">
                                <span><strong>Желая фактура</strong><small>Добавете фирмени данни, ако поръчвате от
                                        името на фирма.</small></span>
                                <input type="checkbox" name="request_invoice" id="request_invoice" value="1"
                                    {{ old('request_invoice') ? 'checked' : '' }}>
                            </label>
                            <div
                                class="checkout-invoice__fields yk-checkout__invoice-fields {{ old('request_invoice') ? '' : 'd-none' }}">
                                <div class="row">
                                    <div class="col-sm-6 yk-checkout__field">
                                        <label class="yk-checkout__label" for="company_name">Име на фирма <span
                                                class="yk-checkout__required">*</span></label>
                                        <input class="yk-checkout__input" name="company_name" id="company_name"
                                            value="{{ old('company_name') }}" type="text">
                                        @error('company_name')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 yk-checkout__field">
                                        <label class="yk-checkout__label" for="company_mol">МОЛ <span
                                                class="yk-checkout__required">*</span></label>
                                        <input class="yk-checkout__input" name="company_mol" id="company_mol"
                                            value="{{ old('company_mol') }}" type="text">
                                        @error('company_mol')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 yk-checkout__field mb-sm-0">
                                        <label class="yk-checkout__label" for="company_bulstat">ЕИК / Булстат <span
                                                class="yk-checkout__required">*</span></label>
                                        <input class="yk-checkout__input" name="company_bulstat" id="company_bulstat"
                                            value="{{ old('company_bulstat') }}" type="text" inputmode="numeric">
                                        @error('company_bulstat')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 yk-checkout__field mb-0">
                                        <label class="yk-checkout__label" for="company_address">Адрес на фирма <span
                                                class="yk-checkout__required">*</span></label>
                                        <input class="yk-checkout__input" name="company_address" id="company_address"
                                            value="{{ old('company_address') }}" type="text">
                                        @error('company_address')
                                            <div class="yk-checkout__error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @error('company')
                                <div class="yk-checkout__error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <aside class="yk-checkout__summary">
                            <details class="yk-checkout__mobile-review" id="yk-mobile-review">
                                <summary><span><i class="fa-solid fa-chevron-down me-2"></i> Прегледай
                                        поръчката</span><span
                                        class="yk-checkout__mobile-total">{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                        €</span></summary>
                                <div class="yk-checkout__mobile-review-body">
                                    @foreach ($products ?? [] as $product)
                                        <div class="yk-checkout__item">
                                            <img class="yk-checkout__item-img"
                                                src="{{ asset('assets/images/products/' . $product['image']) }}"
                                                alt="{{ $product['name'] }}" loading="lazy">
                                            <div class="yk-checkout__item-main"><span
                                                    class="yk-checkout__item-name">{{ $product['name'] }}</span>
                                                <div class="yk-checkout__item-meta">{{ $product['quantity'] }} бр. ×
                                                    {{ number_format((float) $product['final_price'], 2, '.', ' ') }} €
                                                    / бр.</div>
                                            </div>
                                            <span
                                                class="yk-checkout__item-total">{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                                €</span>
                                        </div>
                                    @endforeach
                                    @if (!empty($promoCode))
                                        <div class="yk-checkout__row"><span>Промо код:
                                                {{ $promoCode['promo_code_name'] }}</span><strong>-{{ $promoCode['percentage_promo_code'] }}%</strong>
                                        </div>
                                    @endif
                                    <div class="yk-checkout__row"><span>Доставка</span><strong>Уточнява се</strong>
                                    </div>
                                    <div class="yk-checkout__row yk-checkout__grand"><span>Общо за
                                            продуктите</span><strong>{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                            €</strong></div>
                                </div>
                            </details>

                            <div class="yk-checkout__card shadow">
                                <div class="yk-checkout__desktop-items">
                                    <h2 class="yk-checkout__summary-title">Вашата поръчка</h2>
                                    @foreach ($products ?? [] as $product)
                                        <div class="yk-checkout__item">
                                            <a href="{{ route('shop.show', $product['slug']) }}"><img
                                                    class="yk-checkout__item-img"
                                                    src="{{ asset('assets/images/products/' . $product['image']) }}"
                                                    alt="{{ $product['name'] }}" loading="lazy"></a>
                                            <div class="yk-checkout__item-main">
                                                <a class="yk-checkout__item-name"
                                                    href="{{ route('shop.show', $product['slug']) }}">{{ $product['name'] }}</a>
                                                <div class="yk-checkout__item-meta">{{ $product['quantity'] }} бр. ×
                                                    {{ number_format((float) $product['final_price'], 2, '.', ' ') }} €
                                                    / бр.</div>
                                                @if ((float) ($product['discount'] ?? 0) > 0)
                                                    <span class="yk-checkout__discount">-{{ $product['discount'] }}%
                                                        отстъпка</span>
                                                @endif
                                            </div>
                                            <span
                                                class="yk-checkout__item-total">{{ number_format((float) $product['final_price'] * (int) $product['quantity'], 2, '.', ' ') }}
                                                €</span>
                                        </div>
                                    @endforeach
                                    @if (!empty($promoCode))
                                        <div class="yk-checkout__row"><span>Промо код:
                                                {{ $promoCode['promo_code_name'] }}</span><strong>-{{ $promoCode['percentage_promo_code'] }}%</strong>
                                        </div>
                                        @if (isset($promoDiscount))
                                            <div class="yk-checkout__row"><span>Отстъпка с промо
                                                    код</span><strong>-{{ number_format((float) $promoDiscount, 2, '.', ' ') }}
                                                    €</strong></div>
                                        @endif
                                    @endif
                                    <div class="yk-checkout__row"><span>Доставка</span><strong>Уточнява се</strong>
                                    </div>
                                    <div class="yk-checkout__row yk-checkout__grand"><span>Общо за
                                            продуктите</span><strong>{{ number_format((float) ($subtotal ?? 0), 2, '.', ' ') }}
                                            €</strong></div>
                                    <p class="yk-checkout__note">Доставката се уточнява при потвърждаване на поръчката.
                                    </p>
                                </div>

                                <div class="yk-checkout__promo">
                                    <h3>Имате промо код?</h3>
                                    <div class="yk-checkout__promo-row">
                                        <input class="yk-checkout__input" type="text" id="promo-code-input"
                                            value="{{ session('promo_code.promo_code_name', '') }}"
                                            placeholder="Въведете промо код" autocomplete="off">
                                        <button class="yk-checkout__promo-btn" type="button"
                                            id="apply-promo-code">{{ session()->has('promo_code') ? 'Приложен' : 'Приложи' }}</button>
                                    </div>
                                    <div id="promo-code-message" class="yk-checkout__hint" role="status"
                                        aria-live="polite"></div>
                                </div>

                                <div class="yk-checkout__promo">
                                    <h3>Начин на плащане</h3>
                                    <label class="yk-checkout__payment" for="cash-on-delivery">
                                        <input type="radio" name="payment_method" id="cash-on-delivery"
                                            value="cash_on_delivery" checked>
                                        <span><strong><i class="fa-solid fa-money-bill-wave me-2"></i> Плащане при
                                                получаване</strong><small>Заплащате при получаване на
                                                пратката.</small></span>
                                    </label>
                                </div>
                                <button class="yk-checkout__submit" type="submit" id="yk-submit-order"><i
                                        class="fa-solid fa-check"></i> Завърши поръчката <i
                                        class="fa-solid fa-arrow-right"></i></button>
                                <p class="yk-checkout__note text-center"><i class="fa-solid fa-lock me-1"></i> Данните
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
            checkoutInvoice();
            checkoutDelivery();
            checkoutPromo();
            checkoutSubmit();
        });

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



        function checkoutDelivery() {

            const personalRadio = document.getElementById('delivery-personal');
            const officeRadio = document.getElementById('delivery-office');

            const personalDelivery = document.getElementById('personal-delivery');
            const officeDelivery = document.getElementById('office-delivery');

            if (
                !personalRadio ||
                !officeRadio ||
                !personalDelivery ||
                !officeDelivery
            ) {
                return;
            }

            function toggleDeliveryFields() {

                const isPersonal = personalRadio.checked;

                // Show the selected delivery method.
                personalDelivery.classList.toggle('d-none', !isPersonal);
                officeDelivery.classList.toggle('d-none', isPersonal);

                // Update required fields without disabling Choices.js.
                const city = document.getElementById('city');
                const address = document.getElementById('billing_address');
                const office = document.getElementById('office_list');

                if (city) {
                    city.required = isPersonal;
                }

                if (address) {
                    address.required = isPersonal;
                }

                if (office) {
                    office.required = !isPersonal;
                }
            }

            personalRadio.addEventListener('change', toggleDeliveryFields);
            officeRadio.addEventListener('change', toggleDeliveryFields);

            toggleDeliveryFields();
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

        function checkoutSubmit() {
            const form = document.getElementById('yk-checkout-form');
            const button = document.getElementById('yk-submit-order');
            if (!form || !button) return;
            form.addEventListener('submit', function() {
                if (!form.checkValidity()) return;
                button.disabled = true;
                button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Обработваме поръчката...';
            });
        }
    </script>
</x-frontend>
