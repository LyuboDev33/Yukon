@if (collect($filters)->contains(fn ($filter) => request()->filled($filter['slug'])))
    <div class="catalog-applied-filters">
        <span class="catalog-applied-filters__title">Избрани филтри:</span>

        <div class="catalog-applied-filters__list">
            @foreach ($filters as $filter)
                @if (request()->filled($filter['slug']))
                    <a
                        href="{{ request()->fullUrlWithoutQuery([$filter['slug'], 'page']) }}"
                        class="catalog-applied-filter"
                    >
                        {{ $filter['name'] }}:
                        {{ collect($filter['values'])->firstWhere('slug', request($filter['slug']))['name'] ?? request($filter['slug']) }}
                        <span aria-hidden="true">&times;</span>
                    </a>
                @endif
            @endforeach

            <a href="{{ url()->current() }}" class="catalog-applied-filters__clear">
                Изчисти всички
            </a>
        </div>
    </div>
@endif
