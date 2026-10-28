<x-frontend>

    <!-- Services Section Start -->
    <section class="services-sec bg-shade sec-padding">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="service-card bg-white round">
                        <div class="service-head d-flex gap-3 align-items-center">
                            <img src="/assets/images/machines/serv1.png" alt="Icon">
                            <h3 class="display-4 m-0">
                                <a href="{{ route('machine', 'jagenberg-105') }}">Машина за три точково лепене на кутии
                                    {{-- JAGENBERG DIANA 105 --}}
                                </a>
                            </h3>
                        </div>
                        <div class="service-thumb">
                            <img class="img-fluid" src="/assets/images/machines/main-machine1.jpg" alt="">
                        </div>
                        <p>Тази машина за обработка на кашон и плоскости модел JAGENBERG 105 е произведена през 1998 г.
                            Проектирана е за залепване на кашон и велпапе, съвместима специално с видове вълни "E" и
                            "B".</p>
                        <p>Цена: <b>24 000 € </b></p>
                        <div class="service-footer border-top">
                            <a class="custom-btn" href="{{ route('machine', 'jagenberg-105') }}">
                                <span class="icon rounded-3">
                                    <i class="fa fa-arrow-right"></i></span>Прочети повече
                            </a>
                        </div>
                    </div>
                </div> <!-- Service End -->
                <div class="col-lg-4">
                    <div class="service-card bg-white round">
                        <div class="service-head d-flex gap-3 align-items-center">
                            <img src="/assets/images/icons/serv2.png" alt="Icon">
                            <h3 class="display-4 m-0"><a href="{{ route('machine', 'universal') }}">Ламинатор
                                    UNIVERSAL</a></h3>
                        </div>
                        <div class="service-thumb">
                            <img class="img-fluid" src="/assets/images/machines/universal-main.jpg" alt="">
                        </div>
                        <p>Масивна немска конструкция (тежка употреба): Изработена с изключително здрава чугунена рамка
                            и тежки механични зъбни колела от златната ера на германското инженерство.
                        </p>
                        <p>Цена: <b>28 500 € </b></p>
                        <div class="service-footer border-top">
                            <a class="custom-btn" href="{{ route('machine', 'universal') }}">
                                <span class="icon rounded-3">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                                Прочети повече
                            </a>
                        </div>
                    </div>
                </div> <!-- Service End -->
                <div class="col-lg-4">
                    <div class="service-card bg-white round">
                        <div class="service-head d-flex gap-3 align-items-center">
                            <img src="/assets/images/icons/serv3.png" alt="Icon">
                            <h3 class="display-4 m-0"><a href="{{ route('machine', 'tsp') }}">TSP KAM Die-cutter</a></h3>
                        </div>
                        <div class="service-thumb">
                            <img class="img-fluid" src="/assets/images/machines/tsp.jpg" alt="">
                        </div>
                        <p>Машина за щамповане на картон и велпапе.</p>
                              <p>Цена: <b>14 500 € </b></p>
                        <div class="service-footer border-top">
                            <a class="custom-btn" href="{{  route('machine', 'tsp') }}"><span class="icon rounded-3"><i
                                        class="fa fa-arrow-right"></i></span>Прочети повече</a>
                        </div>
                    </div>
                </div> <!-- Service End -->

            </div>
        </div>
    </section>
    <!-- Services Section End -->

</x-frontend>
