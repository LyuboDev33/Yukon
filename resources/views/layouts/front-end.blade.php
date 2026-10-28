<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="https://reluxtop.com/assets/img/watch.png">

    @yield('SEO')

    <!-- Favicon -->
    <link rel="icon" sizes="180x180" href="{{ asset('assets/images/favicon/favicon-yukon.png') }}?v={{ time() }}">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css">


    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/bootstrap.min.css') }}?v={{ filemtime(public_path('assets/css/bootstrap.min.css')) }}">


    <!-- Jarallax CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/jarallax.min.css') }}?v={{ filemtime(public_path('assets/css/jarallax.min.css')) }}">


    <!-- Nice Select CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/nice-select.css') }}?v={{ filemtime(public_path('assets/css/nice-select.css')) }}">


    <!-- Splide CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <!-- Main Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">

        <!-- Main Shop CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/shop.css') }}?v={{ time() }}">

            <!-- Main Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">

                <!-- Main Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/catalog.css') }}?v={{ time() }}">

        <link rel="stylesheet" href="{{ asset('assets/css/machines.css') }}?v={{ time() }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">

     <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

            <script src="https://cdn.jsdelivr.net/npm/tom-select@2.6.2/dist/js/tom-select.complete.min.js"></script>



    <!-- jQuery -->
    <script
        src="{{ asset('assets/js/jquery-3.7.1.min.js') }}?v={{ time() }}">
    </script>

</head>

<body class="font-sans antialiased">

    <div class="wrapper bg--shaft">

        @include('layouts.partials.frontend.header')

        <main>
            {{ $slot }}
        </main>

        @include('layouts.partials.frontend.footer')

    </div>

    <!-- Cookies Modal -->
    <div class="cookies__modal shadow">

        <img class="cookies" src="{{ asset('assets/images/cookie.webp') }}" alt="Бисквитки">

        <div>
            <p>
                <strong>ЮКОН ООД</strong> използва бисквитки за по-добро и
                персонализирано потребителско изживяване.
            </p>

            <div class="d-flex gap-4 justify-content-center mt-30">
                <button id="acceptBtn" type="button">
                    Добре, разбрах
                </button>
            </div>
        </div>

    </div>




    <!-- jQuery Marquee -->
    <script
        src="{{ asset('assets/js/jquery.marquee.min.js') }}?v={{ filemtime(public_path('assets/js/jquery.marquee.min.js')) }}">
    </script>

    <!-- jQuery Nice Select -->
    <script
        src="{{ asset('assets/js/jquery.nice-select.min.js') }}?v={{ filemtime(public_path('assets/js/jquery.nice-select.min.js')) }}">
    </script>

    <!-- Bootstrap Datepicker -->
    <script
        src="{{ asset('assets/js/bootstrap-datepicker.js') }}?v={{ filemtime(public_path('assets/js/bootstrap-datepicker.js')) }}">
    </script>

    <!-- Bootstrap Datepicker -->
    <script
        src="{{ asset('assets/js/bootstrap.bundle.min.js') }}?v={{ time() }}">
    </script>


    <!-- Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

        <!-- Form JS -->
    <script src="{{ asset('assets/js/custom-codes.js') }}?v={{ time() }}"></script>


    <!-- ======================================= -->
    <!-- CUSTOM INITIALIZATION -->
    <!-- ======================================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeFancybox();
            initializeChoicesJS();
        });

        function initializeFancybox() {
            if (typeof Fancybox === 'undefined') {
                return;
            }

            Fancybox.bind('[data-fancybox]', {});
        }

        function initializeChoicesJS() {
            if (typeof Choices === 'undefined') {
                return;
            }

            const attributeSelects = document.querySelectorAll(
                '.attribute-choice'
            );

            if (attributeSelects.length === 0) {
                return;
            }

            attributeSelects.forEach(function(select) {
                if (select.dataset.choicesInitialized === 'true') {
                    return;
                }

                new Choices(select, {
                    searchEnabled: true,
                    searchChoices: true,
                    itemSelectText: '',
                    searchResultLimit: -1,
                    searchPlaceholderValue: 'Търси стойност...',
                    noResultsText: 'Няма намерени резултати',
                    noChoicesText: 'Няма налични стойности',
                    placeholder: true,
                    removeItemButton: true,
                    shouldSort: false
                });

                select.dataset.choicesInitialized = 'true';
            });
        }
    </script>



</body>

</html>
