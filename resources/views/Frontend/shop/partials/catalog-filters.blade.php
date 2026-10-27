
@php
    // Give each rendered copy of the partial unique panel IDs.
    $filterInstance = $filterInstance ?? 'catalog-filters-' . uniqid();
@endphp

<form
    method="GET"
    action="{{ url()->current() }}"
    class="catalog-filter-form"
>
    {{-- Currently applied filters --}}
    @if (collect($filters)->contains(fn ($filter) => request()->filled($filter['slug'])))
        <div class="catalog-applied-filters">
            <div class="catalog-applied-filters__heading">
                <span>Приложени филтри</span>

                <a href="{{ url()->current() }}" class="catalog-applied-filters__clear">
                    Изчисти всички
                </a>
            </div>

            <div class="catalog-applied-filters__list">
                @foreach ($filters as $filter)
                    @if (request()->filled($filter['slug']))
                        <a
                            href="{{ request()->fullUrlWithoutQuery([$filter['slug'], 'page']) }}"
                            class="catalog-applied-filter"
                        >
                            <span>
                                {{ $filter['name'] }}:
                                {{ collect($filter['values'])->firstWhere('slug', request($filter['slug']))['name'] ?? request($filter['slug']) }}
                            </span>

                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="catalog-filter-list">

        @foreach ($filters as $filter)
            @php
                $filterId = $filterInstance . '-' . $filter['slug'];
                $selectedValue = request($filter['slug']);

                $selectedOption = collect($filter['values'])
                    ->firstWhere('slug', $selectedValue);
            @endphp

            <div class="catalog-filter-item">

                <button
                    type="button"
                    class="catalog-filter-trigger"
                    aria-expanded="false"
                    aria-controls="{{ $filterId }}"
                >
                    <span class="catalog-filter-trigger__text">
                        <span class="catalog-filter-trigger__name">
                            {{ $filter['name'] }}
                        </span>

                        <span class="catalog-filter-trigger__selected">
                            {{ $selectedOption['name'] ?? 'Всички' }}
                        </span>
                    </span>

                    <i class="fa-solid fa-chevron-down catalog-filter-chevron" aria-hidden="true"></i>
                </button>

                <div
                    class="catalog-filter-panel"
                    id="{{ $filterId }}"
                    hidden
                >
                    <label
                        for="{{ $filterId }}-select"
                        class="catalog-filter-field-label"
                    >
                        {{ $filter['name'] }}
                    </label>

                    <select
                        id="{{ $filterId }}-select"
                        name="{{ $filter['slug'] }}"
                        class="catalog-filter-select"
                    >
                        <option value="">Всички</option>

                        @foreach ($filter['values'] as $value)
                            <option
                                value="{{ $value['slug'] }}"
                                @selected((string) $selectedValue === (string) $value['slug'])
                            >
                                {{ $value['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        @endforeach

    </div>

    <div class="catalog-filter-actions">
        <button type="submit" class="catalog-filter-submit">
            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
            Приложи филтрите
        </button>

        <a
            href="{{ url()->current() }}"
            class="catalog-filter-reset"
        >
            Изчисти
        </a>
    </div>
</form>

