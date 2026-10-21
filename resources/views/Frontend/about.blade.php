
<x-frontend>

    @section('SEO')
        <title>За нас | ЮКОН ООД – Производство на кашони и опаковки от велпапе</title>

        <meta name="description"
            content="ЮКОН ООД е производител на кашони и опаковки от велпапе от 1996 г. в Кюстендил. Изработваме транспортни, щанцови, каширани и луксозни опаковки по нуждите на клиентите.">

        <meta name="keywords"
            content="ЮКОН ООД, Юкон Кюстендил, производство на кашони, производство на опаковки, кашони от велпапе, опаковки от велпапе, транспортни опаковки, щанцови опаковки, каширани опаковки, луксозни опаковки, картонени кутии, производител на кашони, велпапе Кюстендил">

        <meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">
        <meta name="googlebot" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">

        <link rel="canonical" href="{{ url('/about') }}">

        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ЮКОН ООД">
        <meta property="og:title" content="За нас | ЮКОН ООД – Кашони и опаковки от велпапе">
        <meta property="og:description"
            content="От 1996 г. ЮКОН ООД произвежда качествени кашони, картонени кутии и опаковки от велпапе. Разгледайте нашата дейност и решения за опаковане.">
        <meta property="og:url" content="{{ url('/about') }}">

        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="ЮКОН ООД – Производство на кашони и опаковки">
        <meta name="twitter:description"
            content="Производство на кашони, транспортни, щанцови, каширани и луксозни опаковки от велпапе. ЮКОН ООД, Кюстендил, от 1996 г.">

        <meta name="author" content="ЮКОН ООД">
        <meta name="application-name" content="ЮКОН ООД">
        <meta name="theme-color" content="#f59e0b">


    @endsection


    <!-- Breadcrumb Section Start -->
    <section class="promo-sec bg-cover jarallax" data-jarallax data-speed=".4">
        <div class="parallax-overly"></div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="promo-wrap">

                        <h1 class="display-2 text-info">За нас</h1>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">Начало</a>
                                </li>

                                <li class="breadcrumb-item active" aria-current="page">
                                    За нас
                                </li>

                            </ol>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- About Section Start -->
    <section class="about-details sec-padding">
        <div class="container">
            <div class="row align-items-center gy-5">

                <div class="col-lg-6">

                    <div class="about-thumb me-lg-4">

                        <img class="img-fluid"
                            src="{{ asset('/assets/images/about-d.jpg') }}"
                            alt="ЮКОН ООД – производство на кашони и опаковки от велпапе"
                            loading="lazy">

                        <h2 class="display-2">
                            Производство на кашони и опаковки от велпапе
                        </h2>

                        <a href="{{ url('/contacts') }}" class="btn btn-primary">
                            Свържете се с нас
                            <i class="fa fa-arrow-right"></i>
                            <span></span>
                        </a>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="row gy-4 abs-info-wrap">

                        <div class="col-lg-6 col-sm-6">
                            <div class="abs-info">

                                <h3 class="display-5">Основана през</h3>

                                <div class="d-flex align-items-center justify-content-between border-bottom">
                                    <img src="{{ asset('/assets/images/icons/time.svg') }}"
                                        alt="Година на основаване"
                                        loading="lazy">

                                    <span class="display-1">1996г.</span>
                                </div>

                                <p>
                                    Дългогодишен опит в производството на
                                    опаковки от велпапе.
                                </p>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="abs-info">

                                <h3 class="display-5">Местоположение</h3>

                                <div class="d-flex align-items-center justify-content-between border-bottom">
                                    <img src="{{ asset('/assets/images/icons/location.svg') }}"
                                        alt="Местоположение"
                                        loading="lazy">

                                    <span class="h4 mb-0">Кюстендил</span>
                                </div>

                                <p>
                                    Българска компания с производство
                                    в град Кюстендил.
                                </p>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="abs-info">

                                <h3 class="display-5">Нашите клиенти</h3>

                                <div class="d-flex align-items-center justify-content-between border-bottom">
                                    <img src="{{ asset('/assets/images/icons/employee.svg') }}"
                                        alt="Нашите клиенти"
                                        loading="lazy">

                                    <span class="h4 mb-0">Бизнеси</span>
                                </div>

                                <p>
                                    Работим с малки, средни и големи
                                    клиенти от различни сфери.
                                </p>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <div class="abs-info">

                                <h3 class="display-5">Нашата специализация</h3>

                                <div class="d-flex align-items-center justify-content-between border-bottom">
                                    <img src="{{ asset('/assets/images/icons/revenue.svg') }}"
                                        alt="Опаковки от велпапе"
                                        loading="lazy">

                                    <span class="h4 mb-0">Велпапе</span>
                                </div>

                                <p>
                                    Изработваме различни видове кашони,
                                    кутии и картонени опаковки.
                                </p>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- About Section End -->


    <!-- Working Process Section Start -->
    <section class="process-sec bg-shade sec-padding position-relative overflow-hidden">

        <div class="container">

            <div class="sec-intro mx-auto text-center">

                <span class="sub-title fadeInUp">
                    НАШИЯТ ПОДХОД
                </span>

                <h2 class="sec-title">
                    Качествени опаковки, съобразени с Вашите нужди
                </h2>

                <p>
                    Подхождаме индивидуално към всяко запитване,
                    за да предложим подходящо решение за опаковане.
                </p>

            </div>

            <div class="process-wrapper d-flex justify-content-between flex-wrap mt-5">

                <div class="process-card text-center fadeInUp" data-delay=".2">

                    <span class="count mx-auto icon-lg bg-shade rounded-circle">
                        01
                    </span>

                    <div class="process-thumb rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/assets/images/st1.png') }}"
                            alt="Обсъждане на нуждите от опаковки"
                            loading="lazy">
                    </div>

                    <h3 class="display-4">
                        Обсъждане на нуждите
                    </h3>

                    <p>
                        Запознаваме се с Вашите изисквания за вид,
                        размери и предназначение на опаковката.
                    </p>

                </div>

                <div class="process-card text-center fadeInUp" data-delay=".4">

                    <span class="count mx-auto icon-lg bg-shade rounded-circle">
                        02
                    </span>

                    <div class="process-thumb rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/assets/images/st2.png') }}"
                            alt="Избор на материали и опаковки"
                            loading="lazy">
                    </div>

                    <h3 class="display-4">
                        Подходящо решение
                    </h3>

                    <p>
                        Подбираме подходящ вид велпапе и конструкция
                        според характеристиките на продукта.
                    </p>

                </div>

                <div class="process-card text-center fadeInUp" data-delay=".6">

                    <span class="count mx-auto icon-lg bg-shade rounded-circle">
                        03
                    </span>

                    <div class="process-thumb rounded-circle d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/assets/images/st3.png') }}"
                            alt="Производство на кашони и опаковки"
                            loading="lazy">
                    </div>

                    <h3 class="display-4">
                        Производство
                    </h3>

                    <p>
                        Изработваме кашони и опаковки от велпапе
                        с внимание към качеството и детайлите.
                    </p>

                </div>

            </div>

        </div>

    </section>
    <!-- Working Process Section End -->


    <!-- Company Information Section Start -->
    <section class="about-sec3 sec-padding">

        <div class="container">

            <div class="row align-items-center gy-5">

                <div class="col-xl-5 col-lg-7 mx-lg-auto">

                    <div class="about-media3 position-relative">

                        <div class="feat-img position-relative">

                            <img src="{{ asset('/assets/images/about-ft.jpg') }}"
                                class="img-fluid round"
                                alt="ЮКОН ООД – производство на опаковки"
                                loading="lazy">

                            <div class="experien-stat">

                                <p class="text-info m-0">
                                    35г. в производството на опаковки
                                </p>

                            </div>

                        </div>

                        <div class="d-flex ab-sm-ft align-items-center gap-4">

                            <img class="round img-fluid"
                                src="{{ asset('/assets/images/about-ft2.png') }}"
                                alt="Картонени кашони и кутии"
                                loading="lazy">

                            <img class="img-fluid"
                                src="{{ asset('/assets/images/about-ft3.png') }}"
                                alt="Опаковки от велпапе"
                                loading="lazy">

                        </div>

                    </div>

                </div>

                <div class="col-xl-7">

                    <div class="about-content3">

                        <span class="sub-title fadeInUp">
                            ЗА ЮКОН ООД
                        </span>

                        <h2 class="sec-title">
                            Надежден партньор в производството на кашони и опаковки
                        </h2>

                        <p>
                            ЮКОН ООД е основана през 1996 година.
                            През всички тези години работим на българския пазар,
                            като произвеждаме качествени кашони и опаковки
                            от велпапе според нуждите на нашите клиенти.
                        </p>

                        <p>
                            Специализирани сме в производството на опаковки
                            от вълнообразен картон (велпапе), включително
                            транспортни кашони, рекламни кутии, рекламни дисплеи,
                            касетки за плодове и зеленчуци, луксозни опаковки,
                            кутии за пици и торти, кутии за обувки и други.
                        </p>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active"
                                    id="mission-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#mission"
                                    type="button"
                                    role="tab"
                                    aria-controls="mission"
                                    aria-selected="true">
                                    Нашата мисия
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                    id="vission-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#vission"
                                    type="button"
                                    role="tab"
                                    aria-controls="vission"
                                    aria-selected="false">
                                    Защо нас?
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                    id="history-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#history"
                                    type="button"
                                    role="tab"
                                    aria-controls="history"
                                    aria-selected="false">
                                    Нашият опит
                                </button>
                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active"
                                id="mission"
                                role="tabpanel"
                                aria-labelledby="mission-tab">

                                <div class="d-sm-flex gap-4 mb-3">

                                    <div class="tab-txt">

                                        <p>
                                            Нашата цел е да произвеждаме
                                            качествени и функционални опаковки
                                            от велпапе, съобразени с индивидуалните
                                            нужди на всеки клиент.
                                        </p>

                                        <p>
                                            Стремим се да предлагаме подходящи
                                            решения за съхранение, транспортиране
                                            и представяне на различни продукти.
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade"
                                id="vission"
                                role="tabpanel"
                                aria-labelledby="vission-tab">

                                <div class="d-sm-flex gap-4 mb-3">

                                    <div class="tab-txt">

                                        <p>
                                            Избирайки ЮКОН ООД, Вие се доверявате
                                            на надежден партньор, на когото
                                            можете да разчитате за добре
                                            свършена работа.
                                        </p>

                                        <p>
                                            Разполагаме със силен и отговорен
                                            екип от професионалисти, специализирани
                                            в изработката на опаковки от велпапе.
                                        </p>

                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade"
                                id="history"
                                role="tabpanel"
                                aria-labelledby="history-tab">

                                <div class="d-sm-flex gap-4 mb-3">

                                    <div class="tab-txt">

                                        <p>
                                            От 1996 година работим с малки,
                                            средни и големи клиенти.
                                            Независимо от поставената задача,
                                            винаги подхождаме професионално.
                                        </p>

                                        <p>
                                            Няма по-голямо признание от доволните
                                            клиенти. Това ни насърчава постоянно
                                            да развиваме своите способности
                                            и да повишаваме качеството на
                                            нашите продукти.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="d-sm-flex align-items-center about-cta gap-5 mt-5">

                            <a href="{{ url('/contacts') }}" class="btn btn-primary">
                                Свържете се с нас
                                <i class="fa fa-arrow-right"></i>
                                <span></span>
                            </a>

                            <div class="quick-call d-flex align-items-center">

                                <span class="bg-dark icon-lg rounded-circle text-info">
                                    <i class="fa-solid fa-phone-volume"></i>
                                </span>

                                <div class="conn-txt ms-3">

                                    <p class="m-0">
                                        Свържете се с нас:
                                    </p>

                                    <a class="h6 text-primary" href="tel:+359888886103">
                                        0888 886 103
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Company Information Section End -->




</x-frontend>
