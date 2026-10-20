<x-frontend>

    @section('SEO')
        <title>ReLux TopShopping | Луксозни часовници и премиум аксесоари</title>

        <meta name="description"
            content="Открийте внимателно подбрана селекция от автентични луксозни часовници и премиум аксесоари в ReLux TopShopping. Стил, качество и сигурно онлайн пазаруване.">

        <meta name="keywords"
            content="ReLux TopShopping, луксозни часовници, премиум часовници, оригинални часовници, маркови часовници, аксесоари, онлайн магазин за часовници">

        <meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">

        <meta name="googlebot" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1">

        <link rel="canonical" href="{{ url('/') }}">

        <meta property="og:locale" content="bg_BG">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="ReLux TopShopping">

        <meta property="og:title" content="ReLux TopShopping | Луксозни часовници и премиум аксесоари">

        <meta property="og:description"
            content="Подбрана селекция от автентични часовници и премиум аксесоари за хора с изискан стил.">

        <meta property="og:url" content="{{ url('/') }}">

        <meta name="twitter:card" content="summary_large_image">

        <meta name="twitter:title" content="ReLux TopShopping | Луксозни часовници и аксесоари">

        <meta name="twitter:description"
            content="Открийте автентични премиум часовници и аксесоари, подбрани с внимание към качеството и стила.">

        <meta name="author" content="ReLux TopShopping">
        <meta name="application-name" content="ReLux TopShopping">
        <meta name="theme-color" content="#171717">
    @endsection



    <!-- Slider Section Start -->
    <section class="slider-sec2 position-relative">


        <div class="hero-slider2">

            <div class="slide-item position-relative">

                <!-- Background Image -->
                <div class="item-bg" style="background-image: url('/assets/images/slider1.jpg');">
                </div>

                <!-- Hero Content -->
                <div class="slide-content">

                    {{-- <div class="parallax-txt">
                    <img src="/assets/images/slide-bg.png"
                         alt=""
                         class="img-fluid">
                </div> --}}

                    <span class="sub-title h5">
                        Impact of Movement
                    </span>

                    <h1 class="display-1 fw-bold">
                        International expert transport services.
                    </h1>

                    <p>
                        End-to-end supply chain support ensuring smooth operations,
                        faster turnaround, and complete peace of mind for every shipment.
                    </p>

                    <div class="d-sm-flex slide-cta gap-4">

                        <a href="quote.html" class="btn btn-hover btn-primary">
                            Get a Quote
                            <i class="fa fa-arrow-right"></i>
                            <span></span>
                        </a>

                        <a href="tracking.html" class="btn btn-outline">
                            Track Shipment
                            <i class="fa fa-arrow-right"></i>
                            <span></span>
                        </a>

                    </div>

                </div>

                <!-- Decorative Image -->
                <img src="/assets/images/slide-anim.png" class="abs-img start-0 bottom-0 d-none d-sm-block"
                    alt="">

            </div>

        </div>

    </section>
    <!-- Slider Section End -->


    <!-- About Section Start -->
    <section class="about-sec2 overflow-hidden">
        <img src="/assets/images/container.png" alt="container" class="position-absolute top-0">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xl-6 col-sm-8 ms-sm-auto">
                    <div class="about-media-box position-relative">
                        <div class="ab-main-img">
                            <img src="/assets/images/about-m.jpg" class="img-fluid" alt="">
                            <div class="experien-stat">
                                <p class="text-info m-0"> <span class="purecounter" data-purecounter-end="25">25</span>+
                                    Years
                                    Experience</p>
                            </div>
                            <div class="about-sm">
                                <img class="img-fluid" src="/assets/images/about-m2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 ps-xl-4">
                    <div class="about-content">
                        <span class="sub-title2 fadeInUp single">About Our Company</span>
                        <h2 class="sec-title">Why Businesses Trust Our Logistics Solutions</h2>
                        <p class="lead">With over four decades of experience providing solutions to large-scale
                            enterprises
                            throughout the globe, we offer end-to-end logistics tailored for specific markets.</p>
                        <ul class="check">
                            <li>Fast & Reliable Delivery</li>
                            <li>End-to-End Solutions</li>
                            <li>Smart Technology</li>
                            <li>Competitive Pricing</li>
                        </ul>
                        <div class="d-sm-flex align-items-center about-cta gap-5">
                            <a href="about.html" class="btn btn-primary">About More <i
                                    class="fa fa-arrow-right"></i><span style="top: 267.45px; left: 119.6px;"></span>
                            </a>

                            <div class="quick-call d-flex align-items-center">
                                <span class="bg-dark icon-lg rounded-circle text-info"><i
                                        class="fa-solid fa-phone-volume"></i></span>
                                <div class="conn-txt ms-3">
                                    <p class="m-0">Call Us Any Time:</p>
                                    <a class="h6 text-primary" href="tel:148359505285">148 359 505 285</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-footer d-sm-flex align-items-center gap-5 bg-shade round mt-5">
                        <div class="af-item d-flex align-items-start gap-4">
                            <img src="/assets/images/af-1.png" alt="transform">
                            <div class="af-info">
                                <h3 class="h5">Global logistics </h3>
                                <p>The is a long established fact that a reader.</p>
                            </div>
                        </div>
                        <div class="af-item d-flex align-items-start gap-4">
                            <img src="/assets/images/af-2.png" alt="transform">
                            <div class="af-info">
                                <h3 class="h5">Online Tracing</h3>
                                <p>The is a long established fact that a reader.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <div class="text-slide-sec sec-padding overflow-hidden">
        <div class="marque-active">
            <div class="text-slide-wrap">
                <div class="text-item">
                    <img src="/assets/images/star-1.png" alt="">
                    <h3 class="display-1">Transport</h3>
                </div>
                <div class="text-item">
                    <img src="/assets/images/star-1.png" alt="">
                    <h3 class="display-1">Logistic</h3>
                </div>
                <div class="text-item">
                    <img src="/assets/images/star-1.png" alt="">
                    <h3 class="display-1">Global Export</h3>
                </div>
                <div class="text-item">
                    <img src="/assets/images/star-1.png" alt="">
                    <h3 class="display-1">Transport</h3>
                </div>
                <div class="text-item">
                    <img src="/assets/images/star-1.png" alt="">
                    <h3 class="display-1">Global Import</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Services Section Start -->
    <div class="services-sec2 sec-padding overflow-hidden bg-cover jarallax" data-jarallax data-speed=".2">
        <img src="/assets/images/service2-bg.jpg" alt="parallax" class="jarallax-img">
        <div class="container ct-container p-0">
            <div class="row align-items-center serv-header">
                <div class="col-lg-8">
                    <div class="sec-intro">
                        <span class="sub-title2 fadeInUp single">Our Services</span>
                        <h2 class="sec-title">Dependable Import Services for Companies of All Sizes</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-slider-nav">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="service-slider2 swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s1.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/bus.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">International Transport</a>
                                    </h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s2.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/bus-gear.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Local Truck Transport</a></h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s3.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/plane-lg.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Skyline Express</a></h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s4.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/road.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Rail Personal Delivery</a>
                                    </h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s1.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/bus.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">International Transport</a>
                                    </h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s2.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/bus-gear.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Local Truck Transport</a></h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s3.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/plane-lg.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Skyline Express</a></h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-card2 round bg-info">
                                    <div class="serv-thumb" style="background-image: url('images/serv-s4.png');">
                                        <span class="icon round-2">
                                            <img src="/assets/images/icons/road.png" alt="">
                                        </span>
                                    </div>
                                    <h3 class="display-4"><a href="single-service.html">Rail Personal Delivery</a>
                                    </h3>
                                    <p>At TransHub, we revoluti cargo services,log prioritizing precision, efficiency,
                                        antransport
                                        worldwide connectivity </p>
                                    <div class="service-footer border-top">
                                        <a class="custom-btn" href="single-service.html"><span
                                                class="icon rounded-3"><i class="fa fa-arrow-right"></i></span>View
                                            Details</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services Section End -->
    <!-- Choose Section Start -->
    <section class="choose-sec2 bg-cover sec-padding" style="background-image: url('images/choose-bg.png');">
        <div class="container">
            <div class="sec-intro mx-auto text-center">
                <span class="sub-title2 fadeInUp">Why Choose Us</span>
                <h2 class="sec-title">Transportation Services We Are Often Considered</h2>
            </div>
            <div class="row g-1">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">Water
                            Installation</h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/water.svg" alt="Fan">
                        </span>
                    </div>
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">Air Heating
                            Installation </h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/air-heat.svg" alt="Fan">
                        </span>
                    </div>
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">Radiator
                            Heating</h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/fan.svg" alt="Fan">
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 d-sm-none d-lg-block">
                    <div class="choose-media">
                        <img src="/assets/images/choose-main.png" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 reverse-choose">
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">Celling
                            Installation</h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/celling.svg" alt="Fan">
                        </span>
                    </div>
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">AC
                            Conditioning</h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/ac-cond.svg" alt="Fan">
                        </span>
                    </div>
                    <div class="single-choose fadeInUp">
                        <h3 class="display-6 fw-bold">Floor
                            Heating</h3>
                        <span class="icon bg-primary">
                            <img src="/assets/images/icons/floor-heat.svg" alt="Fan">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choose Section End -->

    <!-- Video Section Start -->
    <section class="video-sec2 sec-padding jarallax" data-jarallax data-speed=".2">
        <div class="parallax-overly">
            <img src="/assets/images/serv-bg2.jpg" alt="" class="jarallax-img">
        </div>
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-4">
                    <span class="sub-title2">Our journey so far</span>
                </div>
                <div class="col-lg-8">
                    <h2 class="sec-title text-info">Smarter logistics and seamless solutions for modern supply chains.
                    </h2>
                </div>
            </div>
        </div>
        <div class="container ct-container">
            <div class="video-box jarallax position-relative text-center">
                <img src="/assets/images/video-bg.jpg" alt="video" class="jarallax-img">
                <a class="play-btn bg-info rounded-circle text-info icon" data-fancybox="video-gallery"
                    href="https://www.youtube.com/watch?v=wQMx7wc4jh8">
                    <span><i class="fa fa-play"></i></span>
                </a>
            </div>
        </div>

        <div class="container ct-container brands-wrap2">
            <h3 class="display-3 text-info">More Than <span class="purecounter text-primary"
                    data-purecounter-end="52000" data-purecounter-currency=" "></span> Brand with Work Here.</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="brands-carousel swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br1.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br2.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br3.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br4.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br5.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br6.png" alt="Brands"></a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#"><img src="/assets/images/br1.png" alt="Brands"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Video Section End -->

    <!-- Team Section Start -->
    <section class="team-sec sec-padding position-relative">
        <img src="/assets/images/slide-sh1.png" alt="icon" class="abs-img d-none d-lg-block top-0 stat-0">
        <div class="container">
            <div class="col-lg-6 mx-auto text-center sec-intro">
                <span class="sub-title2 fadeInUp">our Expert Team Members</span>
                <h2 class="sec-title">Meet our Special Support Team Members!</h2>
            </div>
            <div class="row gy-5">
                <div class="col-lg-3 col-sm-6 fadeInUp" data-delay=".2">
                    <div class="team-card fadeInUp">
                        <div class="team-thumb round overflow-hidden">
                            <a href="single-team.php"><img src="/assets/images/tm1.jpg" alt=""></a>
                            <div class="team-share">
                                <a class="icon link-icon rounded-circle" href="#"><i
                                        class="fa-solid fa-link"></i></a>
                                <div class="social-share">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="display-4 mb-0"><a href="single-team.html">Jenny Noah</a></h3>
                            <span>Head of operations</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 fadeInUp" data-delay=".3">
                    <div class="team-card">
                        <div class="team-thumb round overflow-hidden">
                            <a href="single-team.php"><img src="/assets/images/tm2.jpg" alt=""></a>
                            <div class="team-share">
                                <a class="icon link-icon rounded-circle" href="#"><i
                                        class="fa-solid fa-link"></i></a>
                                <div class="social-share">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="display-4 mb-0"><a href="single-team.html">Jenny Mache</a></h3>
                            <span>Head of operations</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 fadeInUp" data-delay=".4">
                    <div class="team-card">
                        <div class="team-thumb round overflow-hidden">
                            <a href="single-team.php"><img src="/assets/images/tm3.jpg" alt=""></a>
                            <div class="team-share">
                                <a class="icon link-icon rounded-circle" href="#"><i
                                        class="fa-solid fa-link"></i></a>
                                <div class="social-share">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="display-4 mb-0"><a href="single-team.html">Sofia Melisa</a></h3>
                            <span>Project Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 fadeInUp" data-delay=".5">
                    <div class="team-card">
                        <div class="team-thumb round overflow-hidden">
                            <a href="single-team.php"><img src="/assets/images/tm4.jpg" alt=""></a>
                            <div class="team-share">
                                <a class="icon link-icon rounded-circle" href="#"><i
                                        class="fa-solid fa-link"></i></a>
                                <div class="social-share">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="display-4 mb-0"><a href="single-team.html">Shane Darren</a></h3>
                            <span>Head of operations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Operation Section Start -->
    <section class="operation-sec bg-dark position-relative sec-padding">
        <div class="operate-bg jarallax bg-cover position-absolute" data-speed="0.8"
            style="background-image: url('images/opt-bg.png');"></div>

        <div class="container ct-container">
            <div class="row">
                <div class="col-lg-7 pe-lg-5">
                    <span class="sub-title2 fadeInUp single">Proven Success</span>
                    <h2 class="sec-title text-info">
                        We have helped clients optimize all logistics operations.
                    </h2>

                    <div class="ct-tab nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">

                        <button class="nav-link d-flex align-items-center justify-content-between active"
                            id="air-tab" data-bs-toggle="tab" data-bs-target="#air" type="button" role="tab"
                            aria-controls="air" aria-selected="true">
                            <span class="th-info text-start">
                                <span class="h4 d-block">Air Freight Solution</span>
                                <span class="p d-block">Our cargo service ensures reduced costs through efficient
                                    logistics and
                                    streamlined operations.</span>
                            </span>
                            <span class="icon-lg rounded-circle"><i class="fa fa-arrow-right"></i></span>
                        </button>

                        <button class="nav-link d-flex align-items-center justify-content-between" id="byroad-tab"
                            data-bs-toggle="tab" data-bs-target="#byroad" type="button" role="tab"
                            aria-controls="byroad" aria-selected="false">
                            <span class="th-info text-start">
                                <span class="h4 d-block">Warehouse Inventory</span>
                                <span class="p d-block">Our cargo service ensures reduced costs through efficient
                                    logistics and
                                    streamlined operations.</span>
                            </span>
                            <span class="icon-lg rounded-circle"><i class="fa fa-arrow-right"></i></span>
                        </button>

                        <button class="nav-link d-flex align-items-center justify-content-between" id="road-tab"
                            data-bs-toggle="tab" data-bs-target="#road" type="button" role="tab"
                            aria-controls="road" aria-selected="false">
                            <span class="th-info text-start">
                                <span class="h4 d-block">By Road Instant Solution</span>
                                <span class="p d-block">Our cargo service ensures reduced costs through efficient
                                    logistics and
                                    streamlined operations.</span>
                            </span>
                            <span class="icon-lg rounded-circle"><i class="fa fa-arrow-right"></i></span>
                        </button>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="air" role="tabpanel"
                            aria-labelledby="air-tab">
                            <div class="operation-content">
                                <div class="operation-thumb">
                                    <img src="/assets/images/tab-main1.jpg" class="img-fluid"
                                        alt="Air freight cargo plane">
                                </div>
                                <div class="opt-card bg-white rounded-4 p-4">
                                    <span><img src="/assets/images/tab-icon.png" alt="Icon"></span>
                                    <h3 class="mt-3 h5">Parcel Information</h3>
                                    <p>Lorain Air freight service deliver knowledge opportunity</p>
                                    <a class="link-btn" href="single-service.html">More Details <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="byroad" role="tabpanel" aria-labelledby="byroad-tab">
                            <div class="operation-content">
                                <div class="operation-thumb">
                                    <img src="/assets/images/tab-main2.jpg" class="img-fluid"
                                        alt="Warehouse inventory storage">
                                </div>
                                <div class="opt-card bg-white rounded-4 p-4">
                                    <span><img src="/assets/images/tab-icon.png" alt="Icon"></span>
                                    <h3 class="mt-3 h5">Parcel Information</h3>
                                    <p>Lorain Air freight service deliver knowledge opportunity</p>
                                    <a class="link-btn" href="single-service.html">More Details <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="road" role="tabpanel" aria-labelledby="road-tab">
                            <div class="operation-content">
                                <div class="operation-thumb">
                                    <img src="/assets/images/tab-main3.jpg" class="img-fluid"
                                        alt="Road logistics delivery truck">
                                </div>
                                <div class="opt-card bg-white rounded-4 p-4">
                                    <span><img src="/assets/images/tab-icon.png" alt="Icon"></span>
                                    <h3 class="mt-3 h5">By Road Instant Solution</h3>
                                    <p>Lorain Air freight service deliver knowledge opportunity</p>
                                    <a class="link-btn" href="single-service.html">More Details <i
                                            class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Operation Section End -->

    <!-- FAQ Section Start -->
    <section class="faq-sec overflow-hidden sec-padding position-relative">
        <img src="/assets/images/red-container.png" alt="container" class="anim-img right-top moveXS">
        <div class="container">
            <div class="sec-intro mx-auto text-center">
                <span class="sub-title2 fadeInUp">our Expert Team Members</span>
                <h2 class="sec-title">What Details Are Required for a Quote?</h2>
            </div>
            <div class="row gy-4">
                <div class="col-lg-7 fadeInUp">
                    <div class="faq-accordion rounded-4" id="tv-accordion">
                        <div class="accordion-item active">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button display-5" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How can I track my shipment?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" role="tabpanel" data-bs-parent="#tv-accordion">
                                <div class="accordion-body">
                                    <p>You can easily track your shipment by entering your Tracking ID into our online
                                        tracking
                                        tool. Once submitted, you’ll receive real‑time updates on your shipment’s
                                        location,
                                        delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button display-5 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    How do I get in touch with customer support?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo" data-bs-parent="#tv-accordion">
                                <div class="accordion-body">
                                    <p>Meeting project deadlines is a top priority. We understand the importance of
                                        timely
                                        delivery and have established a comprehensive approach to ensure that all
                                        projects are
                                        completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button display-5 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    What if my shipment is delayed or lost?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" role="tabpanel"
                                aria-labelledby="headingThree" data-bs-parent="#tv-accordion">
                                <div class="accordion-body">
                                    <p>Meeting project deadlines is a top priority. We understand the importance of
                                        timely
                                        delivery and have established a comprehensive approach to ensure that all
                                        projects are
                                        completed</p>
                                </div>
                            </div>
                        </div> <!-- Item End -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button display-5 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Can I schedule recurring shipments?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                role="tabpanel" data-bs-parent="#tv-accordion">
                                <div class="accordion-body">
                                    <p>Meeting project deadlines is a top priority. We understand the importance of
                                        timely
                                        delivery and have established a comprehensive approach to ensure that all
                                        projects are
                                        completed</p>
                                </div>
                            </div>
                        </div> <!-- Item End -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button display-5 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    What is your pricing model?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                role="tabpanel" data-bs-parent="#tv-accordion">
                                <div class="accordion-body">
                                    <p>Teachers play a central role in education. They impart knowledge, facilitate
                                        learning, and
                                        help students develop
                                        critical thinking skills. Teachers also contribute to the social and emotional
                                        development
                                        of
                                        students.</p>
                                </div>
                            </div>
                        </div> <!-- Item End -->
                    </div>
                </div>
                <div class="col-lg-5 fadeInUp" data-delay=".3">
                    <div class="contact-form rounded-4 position-relative">
                        <h3 class="display-4">Make An Appointment</h3>
                        <form id="ajax-contact" method="post" action="mailer.php">
                            <div class="form-group">
                                <input id="name" name="name" type="text" class="form-control"
                                    placeholder="Full Name" required>
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <div class="form-group">
                                <input id="email" name="email" type="email" class="form-control"
                                    placeholder="Email" required>
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="form-group">
                                <input id="phone" name="phone" type="text" class="form-control"
                                    placeholder="+554 6487 244" required>
                                <i class="fa-regular fa-headphones"></i>
                            </div>
                            <div class="form-group">
                                <select class="form-control tv-select" name="ftype" id="ftype">
                                    <option value="">Select Freight</option>
                                    <option value="Air Freight">Air Freight</option>
                                    <option value="General Cargo">General Cargo</option>
                                    <option value="Bulk Cargo">Bulk Cargo</option>
                                    <option value="Oversized Cargo">Oversized Cargo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="wight" name="wight" class="form-control"
                                    placeholder="Weight">
                                <i class="fa-regular fa-clipboard"></i>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">Book an Appointment <i
                                    class="fa fa-arrow-right"></i>
                                <span></span></button>
                            <div class="form-messagess mt-3">
                                <div id="form-messages"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section End -->

    <!-- Blog Section Start -->
    <!-- Blog Section Start -->
    <section class="blog-sec sec-padding bg-shade">
        <div class="container">
            <div class="d-sm-flex justify-content-between align-items-center">
                <div class="sec-intro mb-0">
                    <span class="sub-title2 fadeInUp single">Blog & News</span>
                    <h2 class="sec-title">Insights from Our Journal</h2>
                </div>
                <a href="blog.html" class="btn btn-primary fadeInUp">View all posts <i class="fa fa-arrow-right"></i>
                    <span></span></a>
            </div>
            <div class="row justify-content-md-center gy-4 mt-5">
                <div class="col-xl-4 col-md-6 fadeInUp" data-delay=".2">
                    <article class="blog-entry2 bg-info round">
                        <div class="blog-thumb">
                            <a href="single-post.html"><img src="/assets/images/blog4.jpg" alt=""
                                    class="img-fluid"></a>
                        </div>
                        <div class="blog-inner">
                            <div class="blog-meta d-flex gap-4">
                                <span><a href="#"><i class="fa-regular fa-user"></i>Adam Smith</a></span>
                                <span><a href="#"><i class="fa-regular fa-calendar"></i>07 Nov,2025</a></span>
                            </div>
                            <h3 class="display-4"><a href="single-post.html">TranHub Named a Finalist For Year’ 25
                                    Best Choice
                                    Award</a></h3>
                            <div class="blog-footer border-top">
                                <a href="single-post.html" class="link-btn">Learn more <i
                                        class="fa-solid fa-circle-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-xl-4 col-md-6 fadeInUp" data-delay=".4">
                    <article class="blog-entry2 bg-info round">
                        <div class="blog-thumb">
                            <a href="single-post.html"><img src="/assets/images/blog5.jpg" alt=""
                                    class="img-fluid"></a>
                        </div>
                        <div class="blog-inner">
                            <div class="blog-meta d-flex gap-4">
                                <span><a href="#"><i class="fa-regular fa-user"></i>Adam Smith</a></span>
                                <span><a href="#"><i class="fa-regular fa-calendar"></i>07 Nov,2025</a></span>
                            </div>
                            <h3 class="display-4"><a href="single-post.html">TransHub always deliver on time and on
                                    budget.</a>
                            </h3>
                            <div class="blog-footer border-top">
                                <a href="single-post.html" class="link-btn">Learn more <i
                                        class="fa-solid fa-circle-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-xl-4 col-md-6 fadeInUp" data-delay=".6">
                    <article class="blog-entry2 bg-info round">
                        <div class="blog-thumb">
                            <a href="single-post.html"><img src="/assets/images/blog6.jpg" alt=""
                                    class="img-fluid"></a>
                        </div>
                        <div class="blog-inner">
                            <div class="blog-meta d-flex gap-4">
                                <span><a href="#"><i class="fa-regular fa-user"></i>Adam Smith</a></span>
                                <span><a href="#"><i class="fa-regular fa-calendar"></i>07 Nov,2025</a></span>
                            </div>
                            <h3 class="display-4"><a href="single-post.html">We provide worldwide shipping
                                    services.</a></h3>
                            <div class="blog-footer border-top">
                                <a href="single-post.html" class="link-btn">Learn more <i
                                        class="fa-solid fa-circle-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const testimonialSplide = document.getElementById('testimonialSplide');

            if (!testimonialSplide) {
                return;
            }

            new Splide(testimonialSplide, {
                type: 'loop',
                perPage: 4,
                perMove: 1,
                gap: '20px',
                arrows: true,
                pagination: false,
                autoplay: false,
                interval: 5000,
                pauseOnHover: false,
                pauseOnFocus: false,
                speed: 800,
                breakpoints: {
                    991: {
                        perPage: 1,
                    },
                },
            }).mount();
        });
    </script>

</x-frontend>
