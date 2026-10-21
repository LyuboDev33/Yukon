
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


    <style>
        /* ==========================================
           YUKON - ORDER SUCCESS PAGE
        ========================================== */

        .yk-success {
            padding: 150px 0;
            background: #f7f9fc;
        }

        .yk-success__wrapper {
            max-width: 780px;
            margin: 0 auto;
            text-align: center;
        }

        .yk-success__card {
            position: relative;
            background: #ffffff;
            border: 1px solid #e7edf3;
            border-radius: 24px;
            padding: 65px 55px;
            box-shadow: 0 20px 60px rgba(20, 40, 63, 0.06);
            overflow: hidden;
        }

        .yk-success__card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(
                90deg,
                #d9a441,
                #f0c775,
                #d9a441
            );
        }

        /* Success Icon */

        .yk-success__icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #edf8f1;
            color: #25945c;
            font-size: 46px;
        }

        /* Badge */

        .yk-success__badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            background: #fdf5e7;
            color: #a77622;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.3px;
            margin-bottom: 22px;
        }

        /* Typography */

        .yk-success__title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 800;
            line-height: 1.2;
            color: #14283f;
            margin-bottom: 18px;
        }

        .yk-success__description {
            max-width: 520px;
            margin: 0 auto;
            color: #64748b;
            font-size: 16px;
            line-height: 1.85;
        }

        /* Divider */

        .yk-success__divider {
            height: 1px;
            background: #edf0f4;
            margin: 35px 0;
        }

        /* Next Steps */

        .yk-success__steps {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            text-align: left;
        }

        .yk-success__step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 20px;
            border: 1px solid #edf0f4;
            border-radius: 14px;
            background: #fbfcfe;
        }

        .yk-success__step-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #eef3f9;
            color: #14283f;
            font-size: 17px;
        }

        .yk-success__step h4 {
            margin: 0 0 6px;
            font-size: 15px;
            font-weight: 700;
            color: #14283f;
        }

        .yk-success__step p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Buttons */

        .yk-success__actions {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 35px;
        }

        .yk-success__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            padding: 14px 25px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .yk-success__btn--primary {
            background: #14283f;
            color: #ffffff;
            border: 1px solid #14283f;
        }

        .yk-success__btn--primary:hover {
            background: #243f5d;
            border-color: #243f5d;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .yk-success__btn--secondary {
            background: #ffffff;
            color: #14283f;
            border: 1px solid #dce3eb;
        }

        .yk-success__btn--secondary:hover {
            background: #f4f7fb;
            color: #14283f;
            border-color: #c8d3df;
            transform: translateY(-2px);
        }

        /* Responsive */

        @media (max-width: 767px) {
            .yk-success__card {
                padding: 45px 24px;
                border-radius: 18px;
            }

            .yk-success__icon {
                width: 82px;
                height: 82px;
                font-size: 38px;
                margin-bottom: 25px;
            }

            .yk-success__steps {
                grid-template-columns: 1fr;
            }

            .yk-success__actions {
                flex-direction: column;
            }

            .yk-success__btn {
                width: 100%;
            }
        }
    </style>


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
