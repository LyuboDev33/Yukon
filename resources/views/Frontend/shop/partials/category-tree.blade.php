@php
    $hasChildren = !empty($node['children']);
    $isActive = ($activeSlug ?? null) === $node['slug'];
@endphp

<li class="shop-category__item {{ $isActive ? 'active' : '' }}">

    <div class="shop-category__row">
        <a
            href="{{ route('shop.category', $node['slug']) }}"
            class="shop-category__link"
        >
            {{ $node['name'] }}
        </a>

        @if ($hasChildren)
            <button
                type="button"
                class="category-toggle"
                aria-label="Покажи подкатегориите на {{ $node['name'] }}"
                aria-expanded="{{ $isActive ? 'true' : 'false' }}"
            >
                <i class="fa-solid fa-chevron-down"></i>
            </button>
        @endif
    </div>

    @if ($hasChildren)
        <ul class="shop-category__sublist">
            @foreach ($node['children'] as $child)
                @include('Frontend.shop.partials.category-tree', [
                    'node' => $child,
                    'activeSlug' => $activeSlug ?? null,
                ])
            @endforeach
        </ul>
    @endif

</li>

