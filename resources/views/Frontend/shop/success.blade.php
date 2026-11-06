
<x-frontend>

    @section('SEO')
        <title>Успешна поръчка | ЮКОН ООД</title>

        <meta name="description"
            content="Вашата поръчка в ЮКОН ООД е приета успешно. Благодарим Ви за доверието! Очаквайте потвърждение по имейл и информация за доставката.">

        <meta name="robots" content="noindex,nofollow">
        <meta name="googlebot" content="noindex,nofollow">

        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ЮКОН ООД">
        <meta property="og:title" content="Успешна поръчка | ЮКОН ООД">
        <meta property="og:description"
            content="Вашата поръчка беше приета успешно. Благодарим Ви, че избрахте ЮКОН ООД.">
        <meta property="og:url" content="{{ url()->current() }}">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Успешна поръчка | ЮКОН ООД">
        <meta name="twitter:description"
            content="Благодарим Ви за поръчката! Очаквайте потвърждение от ЮКОН ООД.">

        <meta name="author" content="ЮКОН ООД">
        <meta name="application-name" content="ЮКОН ООД">
        <meta name="theme-color" content="#14283f">
    @endsection


    <!-- Order Success Start -->
    <section class="yk-success">

        <div class="container">

            <div class="yk-success__wrapper">

                <div class="yk-success__card">

                    <!-- Success Icon -->
                    <div class="yk-success__icon">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <!-- Status -->
                    <div class="yk-success__badge">
                        <i class="fa-solid fa-circle-check"></i>
                        Поръчката е приета
                    </div>

                    <!-- Heading -->
                    <h1 class="yk-success__title">
                        Благодарим Ви за поръчката!
                    </h1>

                    <p class="yk-success__description">
                        Получихме Вашата поръчка успешно.
                        Очаквайте имейл с подробности и потвърждение от нашия екип.
                    </p>

                    <div class="yk-success__divider"></div>

                    <!-- Next Steps -->
                    <div class="yk-success__steps">

                        <div class="yk-success__step">

                            <div class="yk-success__step-icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>

                            <div>
                                <h4>Проверете имейла си</h4>
                                <p>
                                    Изпратихме Ви информация за поръчката.
                                </p>
                            </div>

                        </div>

                        <div class="yk-success__step">

                            <div class="yk-success__step-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>

                            <div>
                                <h4>Очаквайте обаждане</h4>
                                <p>
                                    Ще се свържем с Вас за уточняване на доставката.
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="yk-success__actions">

                        <a href="{{ route('shop.index') }}"
                            class="yk-success__btn yk-success__btn--primary">

                            <i class="fa-solid fa-box-open"></i>
                            Разгледайте продуктите

                        </a>

                        <a href="{{ route('contact') }}"
                            class="yk-success__btn yk-success__btn--secondary">

                            <i class="fa-solid fa-headset"></i>
                            Свържете се с нас

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Order Success End -->

</x-frontend>
