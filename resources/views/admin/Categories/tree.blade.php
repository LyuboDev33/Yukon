
<div class="category-tree-item">

    <div class="category-tree-row">

        <!-- Category Info -->
        <div class="category-tree-info">

            <span class="category-tree-icon">
                @if (!empty($category['children']))
                    <i class="fa fa-folder"></i>
                @else
                    <i class="fa fa-folder-open"></i>
                @endif
            </span>

            <div class="category-tree-details">

                <strong class="category-tree-name">
                    {{ $category['name'] }}
                </strong>

                <small class="category-tree-meta">
                    @if ($depth === 0)
                        Главна категория
                    @else
                        Подкатегория · Ниво {{ $depth }}
                    @endif
                </small>

            </div>

        </div>

        <!-- Actions -->
        <div class="category-tree-actions">

            <button
                type="button"
                class="btn btn-sm btn-outline-secondary add-subcategory-btn"
                data-category-id="{{ $category['id'] }}"
                data-category-name="{{ $category['name'] }}"
                title="Добави подкатегория"
            >
                <i class="fa fa-plus"></i>
                <span class="d-none d-md-inline ms-1">
                    Подкатегория
                </span>
            </button>

            <form
                action="{{ route('category.destroy', $category['id']) }}"
                method="POST"
                class="category-delete-form"
                data-category-name="{{ $category['name'] }}"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-sm btn-outline-danger"
                    title="Изтрий категорията"
                >
                    <i class="fa fa-trash"></i>
                </button>

            </form>

        </div>

    </div>

    <!-- Children -->
    @if (!empty($category['children']))

        <div class="category-tree-children">

            @foreach ($category['children'] as $child)

                @include('admin.Categories.tree', [
                    'category' => $child,
                    'depth' => $depth + 1,
                ])

            @endforeach

        </div>

    @endif

</div>
