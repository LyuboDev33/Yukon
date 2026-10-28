<x-frontend>

    @section('SEO')
        <title>Автоматична машина за щамповане TSP / KAM | Машини за картон</title>

        <meta name="description"
            content="Автоматично устройство за щамповане TSP / KAM за обработка на картон и велпапе. Свържете се с нас за технически характеристики, снимки и информация за наличността.">

        <meta name="robots" content="index,follow">
    @endsection

    <!-- Hero Section -->
    <section class="machine-hero">
        <div class="machine-hero-bg"></div>
        <div class="machine-hero-overlay"></div>

        <div class="container">
            <div class="machine-hero-content">
                <span class="machine-eyebrow">
                    Машини за производство на опаковки
                </span>

                <h1>
                    Автоматична машина за щамповане TSP / KAM
                </h1>

                <p>
                    Решение за щамповане и изрязване на картон и велпапе,
                    предназначено за обработка на плоски листови материали.
                </p>
            </div>
        </div>
    </section>

    <!-- Machine Details -->
    <section class="machine-details-section">
        <div class="container">
            <div class="row">

                 <div class="machine-heading">
                <div>
                    <span class="machine-category">
                        Ламинатори
                    </span>

                    <h2>Автоматична машина за щамповане TSP / KAM</h2>


                </div>

                <div class="machine-price">
                    <span>Продажна цена</span>
                    <strong>14 500 €</strong>
                </div>
            </div>

                <!-- Main Content -->
                <div class="col-lg-8">

                    <div class="machine-main-card">

                        <div class="machine-gallery">
                            @forelse ($images as $image)
                                <a
                                    href="{{ $image }}"
                                    class="machine-gallery-item"
                                    data-fancybox="machine-gallery"
                                >
                                    <img
                                        src="{{ $image }}"
                                        alt="Автоматична машина за щамповане TSP / KAM"
                                        loading="lazy"
                                    >

                                    <span class="machine-image-zoom">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                </a>
                            @empty
                                <div class="machine-gallery-empty">
                                    <i class="fas fa-image"></i>
                                    <p>
                                        В момента няма налични снимки на машината.
                                    </p>
                                </div>
                            @endforelse
                        </div>

                        <div class="machine-content-section">

                            <span class="machine-category">
                                Автоматични машини за щамповане
                            </span>

                            <h2 class="machine-heading">
                                Автоматично устройство за щамповане TSP / KAM
                            </h2>

                            <p class="machine-subtitle">
                                Машина за обработка на картон и велпапе
                            </p>

                            <p>
                                Автоматичното устройство за щамповане TSP / KAM
                                е описано като машина за щамповане и изрязване
                                на плоски листови материали. Посоченото приложение
                                включва обработка на картон и велпапе — материали,
                                използвани широко в производството на опаковки.
                            </p>

                            <p>
                                Наличната информация идентифицира машината като
                                автоматично устройство за щамповане и режещ шаблон.
                                Подробни технически характеристики, параметри на
                                производителността и данни за конкретната конфигурация
                                не са предоставени в описанието.
                            </p>

                            <div class="machine-notice">
                                <i class="fas fa-info-circle"></i>

                                <div>
                                    <strong>Важно уточнение</strong>
                                    <p>
                                        За машината не са предоставени потвърдени
                                        данни за година на производство, работни
                                        размери, мощност, производителност или
                                        техническо състояние. Свържете се с нас
                                        за допълнителна информация.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <!-- Applications -->
                        <div class="machine-content-section">

                            <h3 class="machine-section-heading">
                                <span class="machine-section-number">01</span>
                                Предназначение и приложения
                            </h3>

                            <p>
                                Според наличното описание машината е предназначена
                                за операции по щамповане и изрязване на плоски
                                листови материали.
                            </p>

                            <div class="machine-specifications">

                                <div class="machine-spec-row">
                                    <span>Тип машина</span>
                                    <strong>
                                        Автоматично устройство за щамповане
                                    </strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Идентификация</span>
                                    <strong>TSP / KAM</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Обработка</span>
                                    <strong>Щамповане и изрязване</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Материали</span>
                                    <strong>Картон и велпапе</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Формат на материала</span>
                                    <strong>Плоски листове</strong>
                                </div>

                            </div>

                        </div>

                        <!-- Technical Information -->
                        <div class="machine-content-section">

                            <h3 class="machine-section-heading">
                                <span class="machine-section-number">02</span>
                                Технически характеристики
                            </h3>

                            <p>
                                В предоставената информация не са посочени
                                числени технически параметри. Преди покупка
                                е необходимо да бъдат потвърдени характеристиките,
                                съобразени с конкретните производствени нужди.
                            </p>

                            <div class="machine-specifications">

                                <div class="machine-spec-row">
                                    <span>Производител</span>
                                    <strong>Не е посочен</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Модел</span>
                                    <strong>TSP / KAM — според описанието</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Година на производство</span>
                                    <strong>Не е посочена</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Размер на работния формат</span>
                                    <strong>Не е посочен</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Електрическа мощност</span>
                                    <strong>Не е посочена</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Производителност</span>
                                    <strong>Не е посочена</strong>
                                </div>

                                <div class="machine-spec-row">
                                    <span>Техническо състояние</span>
                                    <strong>Не е потвърдено</strong>
                                </div>

                            </div>

                            <p class="machine-disclaimer">
                                Информацията е представена според наличното
                                описание на продукта. Техническите параметри
                                следва да бъдат потвърдени от продавача.
                            </p>

                        </div>

                        <!-- Buyer Information -->
                        <div class="machine-content-section">

                            <h3 class="machine-section-heading">
                                <span class="machine-section-number">03</span>
                                Какво да проверите преди покупка
                            </h3>

                            <p>
                                За да се прецени дали машината е подходяща за
                                конкретното производство, препоръчваме да бъдат
                                изискани следните данни:
                            </p>

                            <ul>
                                <li>
                                    Максимален и минимален размер на обработвания лист.
                                </li>
                                <li>
                                    Поддържани видове и дебелини на картона и велпапето.
                                </li>
                                <li>
                                    Производителност и работна скорост.
                                </li>
                                <li>
                                    Електрически изисквания и необходима мощност.
                                </li>
                                <li>
                                    Видове съвместими щанци и режещи инструменти.
                                </li>
                                <li>
                                    Налични аксесоари, резервни части и техническа документация.
                                </li>
                                <li>
                                    Текущо техническо състояние и история на обслужването.
                                </li>
                            </ul>

                        </div>

                        <!-- FAQ -->
                        <div class="machine-content-section">

                            <h3 class="machine-section-heading">
                                <span class="machine-section-number">04</span>
                                Често задавани въпроси
                            </h3>

                            <div class="machine-faq">

                                <details>
                                    <summary>
                                        За какво е предназначена машината?
                                    </summary>

                                    <p>
                                        Според наличното описание машината е
                                        предназначена за щамповане и изрязване
                                        на картон, велпапе и други подходящи
                                        плоски листови материали.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Какви са максималните размери на листа?
                                    </summary>

                                    <p>
                                        Максималните размери не са посочени в
                                        предоставената информация. Те трябва
                                        да бъдат потвърдени от продавача.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Включени ли са щанци и инструменти?
                                    </summary>

                                    <p>
                                        Няма информация дали към машината се
                                        предлагат щанци, режещи инструменти,
                                        аксесоари или резервни части. Необходимо
                                        е допълнително потвърждение.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Какво е техническото състояние на машината?
                                    </summary>

                                    <p>
                                        В предоставеното описание няма потвърдени
                                        данни за текущото техническо състояние,
                                        историята на работа или сервизното обслужване.
                                    </p>
                                </details>

                                <details>
                                    <summary>
                                        Как мога да получа повече информация?
                                    </summary>

                                    <p>
                                        Свържете се с нас, за да получите наличните
                                        снимки, технически характеристики, информация
                                        за цената и подробности за състоянието и
                                        комплектовката на машината.
                                    </p>
                                </details>

                            </div>

                        </div>

                    </div>
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
                                <div class="machine-info-icon">
                                    <i class="fas fa-industry"></i>
                                </div>

                                <div>
                                    <span class="machine-info-label">
                                        Тип
                                    </span>

                                    <strong>
                                        Автоматична машина за щамповане
                                    </strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <div class="machine-info-icon">
                                    <i class="fas fa-tag"></i>
                                </div>

                                <div>
                                    <span class="machine-info-label">
                                        Модел / идентификация
                                    </span>

                                    <strong>TSP / KAM</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <div class="machine-info-icon">
                                    <i class="fas fa-box"></i>
                                </div>

                                <div>
                                    <span class="machine-info-label">
                                        Материали
                                    </span>

                                    <strong>Картон и велпапе</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <div class="machine-info-icon">
                                    <i class="fas fa-cogs"></i>
                                </div>

                                <div>
                                    <span class="machine-info-label">
                                        Операции
                                    </span>

                                    <strong>Щамповане и изрязване</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <div class="machine-info-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>

                                <div>
                                    <span class="machine-info-label">
                                        Състояние
                                    </span>

                                    <strong>Не е потвърдено</strong>
                                </div>
                            </div>

                            <div class="machine-info-item">
                                <div class="machine-info-icon">
                                    <i class="fas fa-euro-sign"></i>
                                </div>

                              
                            </div>

                        </div>

                        <!-- Contact -->
                        <div class="machine-sidebar-card">

                            <h3 class="machine-sidebar-title">
                                Интересувате се от машината?
                            </h3>

                            <p class="machine-contact-description">
                                Свържете се с нас за повече информация относно
                                наличността, цената, техническите характеристики
                                и възможностите за оглед.
                            </p>

                            <a
                                href="{{ url('/contact') }}"
                                class="machine-contact-button"
                            >
                                <i class="fas fa-envelope"></i>
                                Изпратете запитване
                            </a>

                            <p class="machine-small-note">
                                Посочете, че запитването ви е за автоматичната
                                машина за щамповане TSP / KAM.
                            </p>

                        </div>

                        <!-- Important Note -->
                        <div class="machine-sidebar-card">

                            <h3 class="machine-sidebar-title">
                                Допълнителна информация
                            </h3>

                            <p>
                                Подробни технически данни, снимки, документация
                                и информация за комплектовката не са включени
                                в предоставеното описание.
                            </p>

                            <p class="machine-document-note">
                                Препоръчваме да потвърдите всички важни параметри
                                с продавача преди вземане на решение за покупка.
                            </p>

                        </div>

                    </aside>

                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Fancybox !== 'undefined') {
                Fancybox.bind('[data-fancybox="machine-gallery"]', {});
            }
        });
    </script>

</x-frontend>
