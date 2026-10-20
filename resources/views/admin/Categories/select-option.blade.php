
<option
    value="{{ $category['id'] }}"
    @selected(old('category_parent_id') == $category['id'])
>
    {{ str_repeat('— ', $depth) }}{{ $category['name'] }}
</option>

@if (!empty($category['children']))

    @foreach ($category['children'] as $child)

        @include('admin.Categories.select-option', [
            'category' => $child,
            'depth' => $depth + 1,
        ])

    @endforeach

@endif
