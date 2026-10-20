<x-backend>

    @section('title', 'Категории')

    <div class="category-admin">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Управление на категории</h3>
                <p class="text-muted mb-0">
                    Създавайте категории и организирайте техните подкатегории.
                </p>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- CREATE CATEGORY -->
        <div class="category-card mb-4" id="create-category">

            <div class="category-card__header">
                <h5 class="mb-0">
                    <i class="fa fa-plus-circle me-2 "></i>
                    Създай нова категория
                </h5>
            </div>

            <div class="category-card__body">

                <form action="{{ route('category.create') }}" method="POST" id="categoryCreateForm">

                    @csrf

                    <div class="row g-3">

                        <!-- Category Name -->
                        <div class="col-md-6">
                            <label for="categoryName" class="form-label">
                                Име на категорията
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="categoryName"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Напр: Кутия за храна" value="{{ old('name') }}" required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Parent Category -->
                        <div class="col-md-6">
                            <label for="categoryParent" class="form-label">
                                Родителска категория
                                <small class="text-muted">(по избор)</small>
                            </label>

                            <select name="category_parent_id" id="categoryParent"
                                class="form-select @error('category_parent_id') is-invalid @enderror">

                                <option value="">
                                    — Няма (главна категория) —
                                </option>

                                @foreach ($categoriesTree as $category)
                                    @include('admin.Categories.select-option', [
                                        'category' => $category,
                                        'depth' => 0,
                                    ])
                                @endforeach

                            </select>

                            @error('category_parent_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text" id="selectedParentHelp">
                                Изберете категория, под която да създадете новата.
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus me-1"></i>
                                Добави категория
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>


        <!-- CATEGORY TREE -->
        <div class="category-card">

            <div class="category-card__header">
                <div>
                    <h5 class="mb-1">Структура на категориите</h5>
                    <small class="text-muted">
                        Преглед, добавяне и изтриване на категории.
                    </small>
                </div>
            </div>

            <div class="category-card__body">

                @if (count($categoriesTree) > 0)

                    <div class="category-tree">

                        @foreach ($categoriesTree as $category)
                            @include('admin.Categories.tree', [
                                'category' => $category,
                                'depth' => 0,
                            ])
                        @endforeach

                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-folder-open fa-3x text-muted mb-3"></i>

                        <h6>Все още няма категории</h6>

                        <p class="text-muted mb-0">
                            Създайте първата си категория от формата по-горе.
                        </p>
                    </div>

                @endif

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const parentSelect = document.getElementById('categoryParent');
            const categoryName = document.getElementById('categoryName');
            const categoryForm = document.getElementById('create-category');
            const parentHelp = document.getElementById('selectedParentHelp');

            // Add subcategory buttons.
            document.querySelectorAll('.add-subcategory-btn').forEach(function(button) {

                button.addEventListener('click', function() {

                    const categoryId = this.dataset.categoryId;
                    const categoryNameText = this.dataset.categoryName;

                    parentSelect.value = categoryId;

                    parentHelp.textContent =
                        'Новата категория ще бъде добавена под „' +
                        categoryNameText +
                        '“.';

                    categoryForm.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    setTimeout(function() {
                        categoryName.focus({
                            preventScroll: true
                        });
                    }, 350);

                });

            });

            // Update parent helper when manually selecting a category.
            parentSelect.addEventListener('change', function() {

                const selected = this.options[this.selectedIndex];

                if (this.value) {
                    parentHelp.textContent =
                        'Новата категория ще бъде добавена под „' +
                        selected.textContent.trim() +
                        '“.';
                } else {
                    parentHelp.textContent =
                        'Новата категория ще бъде главна категория.';
                }

            });

            // Delete confirmation.
            document.querySelectorAll('.category-delete-form').forEach(function(form) {

                form.addEventListener('submit', function(event) {

                    const name = this.dataset.categoryName;

                    const confirmed = confirm('Сигурни ли сте, че искате да изтриете категорията „' + name + '“?');

                    if (!confirmed) {
                        event.preventDefault();
                    }

                });

            });

        });
    </script>

</x-backend>
