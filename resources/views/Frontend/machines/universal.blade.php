
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

                <h1>UNIVERSAL Ламинатор</h1>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Начало</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span>Машини</span>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            UNIVERSAL
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
                        Ламинатори
                    </span>

                    <h2>Ламинатор UNIVERSAL</h2>

                    <p class="machine-subtitle">
                        UNIVERSAL · 1978 г. · Произведен в Германия
                    </p>
                </div>

                <div class="machine-price">
                    <span>Продажна цена</span>
                    <strong>28 500 €</strong>
                    <small>Цената е по договаряне</small>
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
                                    aria-label="Преглед на снимка на ламинатор UNIVERSAL"
                                >
                                    <img
                                        src="{{ $image }}"
                                        alt="Ламинатор UNIVERSAL"
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
                                Моделът е произведен в Германия през 1978 г.
                                Машината е била напълно ремонтирана преди
                                няколко години.
                            </p>

                            <p>
                                Максималният размер на листа е 1400 × 1500 мм,
                                а минималният размер е 350 × 410 мм.
                            </p>

                            <div class="machine-notice">
                                <i class="fa fa-info-circle"></i>
                                <p>
                                    Според информацията в обявата машината е
                                    в добро състояние и е в производството.
                                    Потвърдете техническото състояние и
                                    подробностите с продавача преди покупка.
                                </p>
                            </div>
                        </section>


                        <!-- Additional Description -->
                        <section class="machine-content-section">
                            <div class="machine-section-heading">
                                <span class="machine-section-number">02</span>
                                <h3>Конструкция и характеристики</h3>
                            </div>

                            <p>
                                UNIVERSAL е ламинатор, произведен в Германия
                                през 1978 г. Според предоставеното описание
                                машината е преминала основен ремонт преди
                                няколко години.
                            </p>

                            <p>
                                Описанието на продавача акцентира върху
                                масивната конструкция, чугунената рамка и
                                механичните компоненти, характерни за
                                оборудването от този период.
                            </p>

                            <p>
                                Машината използва механично задвижване с
                                вериги и валове. Според обявата конструкцията
                                е проектирана за продължителна експлоатация
                                и поддръжка.
                            </p>

                            <p>
                                Продавачът посочва, че машината е ремонтирана,
                                като критичните износващи се части са били
                                обслужени. Подробностите за извършените ремонти
                                и актуалното техническо състояние следва да
                                бъдат потвърдени при оглед.
                            </p>

                            <p class="machine-disclaimer">
                                <i class="fa fa-info-circle"></i>
                                Информацията за конструкцията и ремонта е
                                представена според описанието на продавача.
                                Препоръчваме да проверите всички характеристики
                                и състоянието на машината преди покупка.
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
                                    <strong>UNIVERSAL</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Модел</span>
                                    <strong>UNIVERSAL</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Година на производство</span>
                                    <strong>1978 г.</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Държава на производство</span>
                                    <strong>Германия</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Категория</span>
                                    <strong>Ламинатори</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Минимална дължина на листа</span>
                                    <strong>350 см (по данни от обявата)</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Минимална ширина на листа</span>
                                    <strong>410 см (по данни от обявата)</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Максимална дължина на листа</span>
                                    <strong>1400 см (по данни от обявата)</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Максимална ширина на листа</span>
                                    <strong>1500 см (по данни от обявата)</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Размери (Д × Ш × В)</span>
                                    <strong>19000 × 25000 × 27000</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Тегло</span>
                                    <strong>5400 кг</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Състояние</span>
                                    <strong>Добро, в производство (според обявата)</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Идентификационен номер</span>
                                    <strong>P261006119</strong>
                                </div>
                            </div>

                            <p class="machine-disclaimer">
                                <i class="fa fa-exclamation-circle"></i>
                                Размерите за листовете и общите габарити са
                                възпроизведени от обявата. Посочените единици
                                изглеждат необичайни за подобна машина.
                                Потвърдете ги с продавача преди покупка.
                            </p>
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
                                        Кога е произведен ламинаторът UNIVERSAL?
                                    </summary>
                                    <p>
                                        Машината е произведена в Германия през 1978 г.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Ремонтирана ли е машината?
                                    </summary>
                                    <p>
                                        Според продавача машината е била напълно
                                        ремонтирана преди няколко години.
                                        Поискайте информация за извършените ремонти
                                        и обслужените компоненти.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Какви размери листове поддържа?
                                    </summary>
                                    <p>
                                        Посочените в обявата минимални размери са
                                        350 × 410, а максималните — 1400 × 1500.
                                        Единиците трябва да бъдат потвърдени с продавача.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Къде се намира машината?
                                    </summary>
                                    <p>
                                        Обявата посочва местоположение България.
                                        За точния адрес и възможностите за оглед
                                        се свържете с продавача.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Каква е цената?
                                    </summary>
                                    <p>
                                        Обявената цена е 28 500 €. Цената е
                                        по договаряне.
                                    </p>
                                </details>

                            </div>

                            <p class="machine-disclaimer">
                                Отговорите са обобщени въз основа на информацията
                                в обявата. Потвърдете всички подробности с продавача.
                            </p>
                        </section>

                    </article>
                </div>


                <!-- Sidebar -->
                <div class="col-lg-4">
                    <aside class="machine-sidebar">

                        <!-- Machine Information -->
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
                                    <strong>UNIVERSAL</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Местоположение</span>
                                    <strong>България</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Година</span>
                                    <strong>1978 г.</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-layer-group"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Категория</span>
                                    <strong>Ламинатори</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-hashtag"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Номер на обявата</span>
                                    <strong>P261006119</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <span class="machine-info-icon">
                                    <i class="fa fa-wrench"></i>
                                </span>

                                <div>
                                    <span class="machine-info-label">Състояние</span>
                                    <strong>Добро, в производство според обявата</strong>
                                </div>
                            </div>

                            <div class="machine-sidebar-price">
                                <span>Цена по договаряне</span>
                                <strong>28 500 €</strong>
                            </div>
                        </div>


                        <!-- Contact Info -->
                        <div class="machine-sidebar-card">
                            <h3 class="machine-sidebar-title">
                                Контактна информация
                            </h3>

                            <p class="machine-contact-description">
                                Свържете се с нас за повече информация,
                                договаряне на цената или организиране на оглед.
                            </p>

                            <div class="machine-contact-item">
                                <i class="fa fa-location-dot"></i>
                                <span>България</span>
                            </div>

                            <div class="machine-contact-item">
                                <i class="fa fa-user"></i>
                                <span>Специален контакт в обявата: Ilya Z.</span>
                            </div>

                            <a href="{{ url('/contact') }}" class="machine-contact-button">
                                Изпратете запитване
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>


                        <!-- Documentation -->
                        <div class="machine-sidebar-card">
                            <h3 class="machine-sidebar-title">
                                Допълнителна информация
                            </h3>

                            <p class="machine-contact-description">
                                Според обявата машината е ремонтирана преди
                                няколко години и е в производството.
                            </p>

                            <div class="machine-document-note">
                                <i class="fa fa-file-lines"></i>
                                <span>Информация за ремонт и техническо състояние</span>
                            </div>

                            <p class="machine-small-note">
                                Поискайте от продавача подробности за ремонта,
                                техническата документация и възможностите за оглед.
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
