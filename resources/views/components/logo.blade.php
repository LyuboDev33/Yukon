@props([
    'width' => 120,
    'mobileWidth' => 90,
])

<a href="/">
    <img
        class="d-none d-md-block "
        width="{{ $width }}"
        src="{{ asset('/assets/images/logo-yukon-new.png') }}?v={{ time() }}"
        alt="Logo"
    >

    <img
        class="d-block d-md-none "
        width="{{ $mobileWidth }}"
        src="{{ asset('/assets/images/logo-yukon-new.png') }}?v={{ time() }}"
        alt="Logo"
    >
</a>
