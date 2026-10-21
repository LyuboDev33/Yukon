
@if (count($prices) === 0)
    <div class="alert alert-info mb-0">
        Няма добавени цени към този продукт
    </div>
@else
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>От (бр.)</th>
                    <th>До (бр.)</th>
                    <th>Цена за 1 бр.</th>
                    <th>Действия</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($prices as $price)
                    <tr>
                        <td>
                            <form id="update-price-{{ $price->id }}"
                                class="update-product-price-form"
                                action="{{ route('admin.products.prices.update', $price->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                            </form>

                            <input
                                type="number"
                                name="min_quantity"
                                min="1"
                                value="{{ $price->min_quantity }}"
                                class="form-control"
                                form="update-price-{{ $price->id }}"
                                required>
                        </td>

                        <td>
                            <input
                                type="number"
                                name="max_quantity"
                                min="1"
                                value="{{ $price->max_quantity }}"
                                class="form-control"
                                form="update-price-{{ $price->id }}"
                                placeholder="Без ограничение">
                        </td>

                        <td>
                            <input
                                type="number"
                                name="price"
                                min="0"
                                step="0.01"
                                value="{{ $price->price }}"
                                class="form-control"
                                form="update-price-{{ $price->id }}"
                                required>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    form="update-price-{{ $price->id }}"
                                    class="btn btn-primary btn-sm">
                                    Запази
                                </button>

                                <form
                                    class="delete-product-price-form"
                                    action="{{ route('admin.products.prices.delete', $price->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Изтрий
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
