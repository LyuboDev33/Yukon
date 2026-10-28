
<x-frontend>

    <!-- Promo Section Start -->
    <section class="machine-hero">
        <img
            src="{{ asset('assets/images/promo.jpg') }}"
            alt=""
            class="machine-hero-bg"
        >

        <div class="machine-hero-overlay"></div>

        <div class="container">
            <div class="machine-hero-content">
                <span class="machine-eyebrow">ИНДУСТРИАЛНО ОБОРУДВАНЕ</span>

                <h1>JAGENBERG DIANA 105</h1>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Начало</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span>Машини</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            JAGENBERG DIANA 105
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Promo Section End -->


    <!-- Machine Details Section Start -->
    <section class="machine-details-section">
        <div class="container">

            <div class="machine-heading">
                <div>
                    <span class="machine-category">
                        Машини за конвертиране на кашони и картони
                    </span>

                    <h2>Машина за три точково лепене на кутии</h2>

                    <p class="machine-subtitle">
                        JAGENBERG DIANA 105 · Модел 105 · 1998 г.
                    </p>
                </div>

                <div class="machine-price">
                    <span>Продажна цена</span>
                    <strong>24 000 €</strong>
                </div>
            </div>


            <div class="row g-4">

                <!-- Main Content -->
                <div class="col-lg-8">

                    <article class="machine-main-card">

                        <!-- Image Gallery -->
                        <div class="machine-gallery">
                            @forelse ($images as $image)
                                <a
                                    href="{{ $image }}"
                                    class="machine-gallery-item"
                                    data-fancybox="machine-gallery"
                                    aria-label="Преглед на снимка на JAGENBERG DIANA 105"
                                >
                                    <img
                                        src="{{ $image }}"
                                        alt="Машина JAGENBERG DIANA 105"
                                        loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                    >

                                    <span class="machine-image-zoom">
                                        <i class="fa fa-search-plus"></i>
                                    </span>
                                </a>
                            @empty
                                <div class="machine-gallery-empty">
                                    <i class="fa fa-image"></i>
                                    <p>В момента няма налични снимки.</p>
                                </div>
                            @endforelse
                        </div>


                        <!-- Seller Description -->
                        <section class="machine-content-section">
                            <div class="machine-section-heading">
                                <span class="machine-section-number">01</span>
                                <h3>Описание на продавача</h3>
                            </div>

                            <p>
                                Годината на производство е 1998 г.
                            </p>

                            <p>
                                Машината разполага с три точки на залепване.
                                Минималният размер е 350 × 410 мм, а максималният
                                е 889 × 1041 мм.
                            </p>

                            <p>
                                Машината може да лепи картон и велпапе с E и B вълни.
                                Разполагаме с техническа документация с инструкция
                                за експлоатация.
                            </p>

                            <p>
                                Машината е на разположение по всяко време за оглед.
                            </p>

                            <div class="machine-notice">
                                <i class="fa fa-info-circle"></i>
                                <p>
                                    Препоръчваме да проверите техническите
                                    характеристики и текущото работно състояние
                                    с продавача преди покупка.
                                </p>
                            </div>
                        </section>


                        <!-- AI Description -->
                        <section class="machine-content-section">
                            <div class="machine-section-heading">
                                <span class="machine-section-number">02</span>
                                <h3>Автоматично описание</h3>
                            </div>

                            <p>
                                Тази машина за обработка на кашони, модел
                                JAGENBERG 105, е произведена през 1998 г.
                                Проектирана е за залепване на картон и велпапе,
                                съвместима с видове вълни E и B. Разполага с три
                                точки за залепване и поддържа минимални размери
                                350 × 410 мм и максимални размери 889 × 1041 мм.
                            </p>

                            <p>
                                Конструкцията включва метална рамка, цилиндрични
                                валяци, релси, транспортни ленти и вериги за
                                придвижване на материалите през процеса на залепване.
                            </p>

                            <p>
                                Машината разполага с контролен панел, управляваща
                                единица и система с манометър и тръби. Описанието
                                посочва наличието на аварийни бутони.
                            </p>

                            <p>
                                Оборудването показва следи от употреба. Наличната
                                информация не потвърждава независимо текущото му
                                техническо състояние.
                            </p>

                            <p>
                                Предоставя се техническа документация с инструкции
                                за работа. Машината е на разположение за оглед
                                и закупуване.
                            </p>

                            <p class="machine-disclaimer">
                                <i class="fa fa-robot"></i>
                                Описанието е генерирано с помощта на изкуствен
                                интелект въз основа на наличната информация.
                                Възможно е да не отразява всички спецификации
                                или състоянието на оборудването.
                            </p>
                        </section>


                        <!-- Technical Specifications -->
                        <section class="machine-content-section">
                            <div class="machine-section-heading">
                                <span class="machine-section-number">03</span>
                                <h3>Технически характеристики</h3>
                            </div>

                            <div class="machine-specifications">
                                <div class="machine-spec-row">
                                    <span>Производител</span>
                                    <strong>JAGENBERG</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Модел</span>
                                    <strong>DIANA 105</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Година на производство</span>
                                    <strong>1998 г.</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Точки на залепване</span>
                                    <strong>3</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Минимален размер</span>
                                    <strong>350 × 410 мм</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Максимален размер</span>
                                    <strong>889 × 1041 мм</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Обработвани материали</span>
                                    <strong>Картон и велпапе E/B</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Техническа документация</span>
                                    <strong>Налична</strong>
                                </div>
                            </div>
                        </section>


                        <!-- Frequently Asked Questions -->
                        <section class="machine-content-section">
                            <div class="machine-section-heading">
                                <span class="machine-section-number">04</span>
                                <h3>Често задавани въпроси</h3>
                            </div>

                            <div class="machine-faq">

                                <details>
                                    <summary>
                                        Кога е произведен този JAGENBERG DIANA 105?
                                    </summary>
                                    <p>
                                        Машината е произведена през 1998 г.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Може ли оборудването да бъде проверено под напрежение?
                                    </summary>
                                    <p>
                                        Според информацията в обявата оборудването
                                        е налично за проверка под напрежение.
                                        Потвърдете това с продавача предварително.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Къде се намира машината?
                                    </summary>
                                    <p>
                                        Пиперков Чифлик, България.
                                    </p>
                                </details>

                            </div>

                            <p class="machine-disclaimer">
                                Въпросите и отговорите са генерирани с помощта
                                на изкуствен интелект и са само за ориентир.
                            </p>
                        </section>

                    </article>
                </div>


                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="machine-sidebar">

                        <!-- Project Information -->
                        <div class="machine-sidebar-card">
                            <h3 class="machine-sidebar-title">
                                Информация за машината
                            </h3>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-industry"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Производител</span>
                                    <strong>JAGENBERG</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Местоположение</span>
                                    <strong>Пиперков Чифлик, България</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Година</span>
                                    <strong>1998 г.</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-layer-group"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Категория</span>
                                    <strong>Машини за кашони и картон</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-hashtag"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Номер на обявата</span>
                                    <strong>P250606053</strong>
                                </div>
                            </div>

                            <div class="machine-sidebar-price">
                                <span>Цена</span>
                                <strong>24 000 €</strong>
                            </div>
                        </div>


                        <!-- Contact Info -->
                        <div class="machine-sidebar-card">
                            <h3 class="machine-sidebar-title">
                                Контактна информация
                            </h3>

                            <p class="machine-contact-description">
                                Свържете се с нас за повече информация,
                                оглед или въпроси относно оборудването.
                            </p>

                            <div class="machine-contact-item">
                                <i class="fa fa-location-dot"></i>
                                <span>Пиперков Чифлик, България</span>
                            </div>

                            <!-- Replace these with your actual contact details -->
                            <div class="machine-contact-item">
                                <i class="fa fa-phone"></i>
                                <span>Свържете се с продавача</span>
                            </div>

                            <a href="{{ url('/contact') }}" class="machine-contact-button">
                                Изпратете запитване
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>


                        <!-- Brochures -->
                        <div class="machine-sidebar-card">
                            <h3 class="machine-sidebar-title">
                                Документация
                            </h3>

                            <p class="machine-contact-description">
                                Според обявата е налична техническа документация
                                с инструкция за експлоатация.
                            </p>

                            <div class="machine-document-note">
                                <i class="fa fa-file-lines"></i>
                                <span>Техническа документация</span>
                            </div>

                            <p class="machine-small-note">
                                За получаване на документацията се свържете
                                с продавача.
                            </p>
                        </div>

                    </aside>
                </div>

            </div>
        </div>
    </section>
    <!-- Machine Details Section End -->


    <!-- Fancybox -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="machine-gallery"]', {});
            }
        });
    </script>

</x-frontend>
