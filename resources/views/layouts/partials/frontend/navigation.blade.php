<ul class="navbar-nav mx-auto align-items-xl-center">

    <!-- Home -->
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('home') }}"> Начало
        </a>
    </li>


    <!-- Projects -->
    <li class="nav-item dropdown">
        <a class="nav-link " href="{{ route('shop.index') }}" aria-expanded="false">
            Магазин
        </a>

        {{-- <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('shop.index') }}">Всички продукти</a></li>
            <li><a class="dropdown-item" href="case-studies-2.html">Projects 2</a></li>
            <li><a class="dropdown-item" href="single-casestudy.html">Project Details</a></li>
        </ul> --}}
    </li>

        <!-- Contact -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">За нас</a>
    </li>

    <!-- Contact -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('machines') }}">Машини</a>
    </li>

    <!-- Contact -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">Контакти</a>
    </li>

</ul>
