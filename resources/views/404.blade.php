
<x-frontend>

    @section('SEO')
        <title>Страница 404 | ЮКОН</title>
        <meta name="robots" content="noindex, follow">
    @endsection

    <section class="error-page">
        <div class="container">
            <div class="error-page__wrapper">

                <!-- Decorative background -->
                <div class="error-page__decoration error-page__decoration--one"></div>
                <div class="error-page__decoration error-page__decoration--two"></div>

                <!-- Floating icon -->
                <div class="error-page__icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <!-- Large 404 typography -->
                <div class="error-page__number">
                    404
                </div>

                <!-- Text -->
                <div class="error-page__content">

                    <span class="error-page__label">
                        <span class="error-page__label-dot"></span>
                        СТРАНИЦАТА НЕ Е НАМЕРЕНА
                    </span>

                    <h1 class="error-page__title">
                        Опа! Нещо се <span>обърка.</span>
                    </h1>

                    <p class="error-page__description">
                        Изглежда страницата, която търсите, е преместена,
                        изтрита или никога не е съществувала.
                        Но не се притеснявайте — винаги можете да се върнете
                        към началото.
                    </p>

                    <div class="error-page__actions">

                        <a href="{{ route('home') }}"
                           class="error-page__button error-page__button--primary">
                            <i class="fa-solid fa-house"></i>
                            Към началната страница
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </div>

                <!-- Bottom decoration -->
                <div class="error-page__footer">
                    <span class="error-page__footer-line"></span>
                    <span>
                        <i class="fa-solid fa-circle-info"></i>
                        Код на грешката: 404
                    </span>
                    <span class="error-page__footer-line"></span>
                </div>

            </div>
        </div>
    </section>

</x-frontend>
