@props([
    'width' => 120,
    'mobileWidth' => 90,
])

<a href="/">
    <img
        class="d-none d-md-block rounded-pill"
        width="{{ $width }}"
        src="{{ asset('/assets/images/logo-yukon.png') }}?v={{ time() }}"
        alt="Logo"
    >

    <img
        class="d-block d-md-none rounded-pill"
        width="{{ $mobileWidth }}"
        src="{{ asset('/assets/images/logo-yukon.png') }}?v={{ time() }}"
        alt="Logo"
    >
</a>
