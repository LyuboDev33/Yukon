
<!-- Sidebar Overlay -->
<div class="main-overlay" id="sidebar-overlay"></div>

<!-- Mobile Sidebar -->
<aside
    class="mobile-sidebar"
    id="mobile-sidebar"
    aria-label="Mobile navigation"
    aria-hidden="true"
    inert
>

    <!-- Sidebar Header -->
    <div class="mobile-sidebar-header">

        <a href="/" class="mobile-sidebar-logo">
            <img
                src="{{ asset('assets/images/logo-w.svg') }}"
                alt="Logo"
            >
        </a>

        <button
            type="button"
            class="mobile-sidebar-close"
            aria-label="Close navigation"
        >
            <i class="fa fa-times"></i>
        </button>

    </div>

    <!-- Sidebar Navigation -->
    <nav class="mobile-sidebar-navigation" aria-label="Mobile menu">

        @include('layouts.partials.frontend.navigation')

    </nav>

    <!-- Sidebar Footer -->
    <div class="mobile-sidebar-footer">

        <a href="quote.html" class="btn btn-primary">
            Get a Free Quote
            <i class="fa fa-arrow-right"></i>
            <span></span>
        </a>

    </div>

</aside>
