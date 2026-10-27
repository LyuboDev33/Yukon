@props(['breadcrumbs' => []])

@if (!empty($breadcrumbs))
    <nav aria-label="Breadcrumb" class="shop-breadcrumb">
        <ol>
            <li>
                <a href="{{ route('shop.index') }}">Начало</a>
            </li>

            @foreach ($breadcrumbs as $breadcrumb)
                <li>
                    <span aria-hidden="true">/</span>

                    @if (!$loop->last)
                        <a href="{{ route('shop.category', $breadcrumb['slug']) }}">
                            {{ $breadcrumb['name'] }}
                        </a>
                    @else
                        <span aria-current="page">
                            {{ $breadcrumb['name'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
