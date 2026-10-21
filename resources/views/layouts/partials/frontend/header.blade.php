<!-- Header Start -->
<header class="header header-2">

    <div class="sticky-height"></div>

    <div class="header-wrapper">

        <!-- Top Header -->
        {{-- <div class="header-top d-none d-lg-block">
            <div class="container ct-container">

                <div class="d-flex justify-content-between align-items-center">

                    <!-- Contact Information -->
                    <div class="header-infos">
                        <ul class="d-none d-xl-flex flex-wrap align-items-center gap-4">

                            <li>
                                <i class="fa fa-phone"></i>
                                <a href="tel:+928208383727">
                                    Phone: +92 8208 383 727
                                </a>
                            </li>

                            <li>
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:info@transhub.com">
                                    Email: info@transhub.com
                                </a>
                            </li>

                            <li>
                                <i class="fa fa-location-dot"></i>
                                <span>123 Street, New York, USA</span>
                            </li>

                        </ul>

                        <div class="d-xl-none">
                            <a href="mailto:info@transhub.com">
                                info@transhub.com
                            </a>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="header-cta d-flex align-items-center gap-3">

                        <div class="social-share">
                            <a href="#" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>

                            <a href="#" aria-label="X">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>

                            <a href="#" aria-label="YouTube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>

                            <a href="#" aria-label="LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div> --}}

        <!-- Main Navigation -->
        <div class="header-nav-wrapper header-sticky">

            <nav class="navbar navbar-expand-xl">

                <div class="container ct-container">

                    <!-- Logo -->
                    <x-logo width="250" mobileWidth="150"/>

                    <!-- Desktop Navigation -->
                    <div class="desktop-navigation d-none d-xl-flex flex-grow-1">

                        @include('layouts.partials.frontend.navigation')

                    </div>

                    <!-- Right Actions -->
                    <div class="nav-cta d-none d-md-flex order-lg-3">

                        <div class="d-flex align-items-center gap-3">

                            <a href="{{ route('cart') }}" class="icon-lg position-relative bg-light rounded-circle">
                                <i class="fa fa-shopping-cart"></i>

                                <sup>
                                    {{ count(Session::get('products', [])) }}
                                </sup>
                            </a>

                            <a href="{{ route('contact') }}" class="btn btn-primary btn-hover">
                                Контакти
                                <i class="fa fa-arrow-right"></i>
                                <span></span>
                            </a>

                        </div>

                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="navbar-toggler offcanvas-nav-btn d-xl-none" type="button"
                        aria-label="Open navigation" aria-controls="mobile-sidebar" aria-expanded="false">
                        МЕНЮ
                        <i class="fa fa-bars ms-2"></i>
                    </button>

                </div>

            </nav>

        </div>

    </div>

</header>
<!-- Header End -->

<!-- Mobile Sidebar -->
@include('layouts.partials.frontend.sidebar')
