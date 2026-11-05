
<x-backend>

    <section class="content-main">

        <div class="content-header mb-4">
            <div>
                <h2 class="content-title card-title">
                    Детайли на запитване
                </h2>

                <p>
                    Информация за запитване №: {{ $offer->id }}
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Status management -->
        <div class="mb-4">
            <div class="card-body">

                <h5 class="mb-3">
                    Статус на запитването
                </h5>

                <form method="POST"
                    action="{{ route('admin.offers.update', $offer) }}">

                    @csrf
                    @method('PATCH')

                    <div class="row align-items-end">

                        <div class="col-lg-6">

                            <label for="status" class="form-label">
                                Изберете статус
                            </label>

                            <select id="status"
                                name="status"
                                class="form-select"
                                required>

                                @foreach ($offerStatuses as $value => $label)
                                    <option value="{{ $value }}"
                                        @selected(old('status', $offer->status) === $value)>
                                        {{ $label }}
                                    </option>
                                @endforeach

                            </select>

                            @error('status')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-lg-3">
                            <button type="submit"
                                class="btn btn-primary">
                                Запази статус
                            </button>
                        </div>

                        <div class="col-lg-3 text-end">
                            @switch($offer->status)
                                @case('pending')
                                    <span class="badge bg-warning text-dark p-2">
                                        {{ $offerStatuses[$offer->status] }}
                                    </span>
                                @break

                                @case('processing')
                                    <span class="badge bg-info text-dark p-2">
                                        {{ $offerStatuses[$offer->status] }}
                                    </span>
                                @break

                                @case('completed')
                                    <span class="badge bg-success p-2">
                                        {{ $offerStatuses[$offer->status] }}
                                    </span>
                                @break

                                @case('cancelled')
                                    <span class="badge bg-danger p-2">
                                        {{ $offerStatuses[$offer->status] }}
                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary p-2">
                                        {{ $offer->status }}
                                    </span>
                            @endswitch
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <hr>

        <!-- Offer details -->
        <div class="bg-white">

            <header class="card-header">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-3">

                        <span>
                            <i class="fa fa-calendar"></i>

                            <strong>
                                {{ $offer->created_at->format('d.m.Y H:i') }}
                            </strong>
                        </span>

                        <br>

                        <small class="text-muted">
                            № Запитване: {{ $offer->id }}
                        </small>

                    </div>

                </div>
            </header>

            <div class="card-body">

                <div class="row mt-3">

                    <!-- Customer -->
                    <div class="col-md-6 mb-4">
                        <article class="d-flex align-items-start gap-3">

                            <span
                                class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                style="width:42px;height:42px;flex-shrink:0;">

                                <i class="fa fa-user text-white"></i>
                            </span>

                            <div>
                                <h6 class="mb-2">
                                    Информация за клиента
                                </h6>

                                <p class="mb-1">
                                    <strong>Име:</strong>
                                    {{ $offer->name }}
                                </p>

                                <p class="mb-1">
                                    <strong>Телефон:</strong>

                                    <a href="tel:{{ $offer->phone }}">
                                        {{ $offer->phone }}
                                    </a>
                                </p>
                            </div>

                        </article>
                    </div>

                    <!-- Offer -->
                    <div class="col-md-6 mb-4">
                        <article class="d-flex align-items-start gap-3">

                            <span
                                class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                style="width:42px;height:42px;flex-shrink:0;">

                                <i class="fa fa-box text-white"></i>
                            </span>

                            <div>
                                <h6 class="mb-2">
                                    Информация за запитването
                                </h6>

                                <p class="mb-1">
                                    <strong>Номер:</strong>
                                    #{{ $offer->id }}
                                </p>

                                <p class="mb-1">
                                    <strong>Статус:</strong>
                                    {{ $offerStatuses[$offer->status] ?? $offer->status }}
                                </p>

                                <p class="mb-1">
                                    <strong>Дата:</strong>
                                    {{ $offer->created_at->format('d.m.Y H:i') }}
                                </p>
                            </div>

                        </article>
                    </div>

                </div>

                <hr>

                <h5 class="mb-3">
                    Размери на кашона
                </h5>

                <div class="table-responsive">
                    <table class="table cart-table align-middle">
                        <thead>
                            <tr>
                                <th>Дължина (L)</th>
                                <th>Ширина (W)</th>
                                <th>Височина (H)</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <strong>{{ $offer->length }} мм</strong>
                                </td>

                                <td>
                                    <strong>{{ $offer->width }} мм</strong>
                                </td>

                                <td class="text-end">
                                    <strong>{{ $offer->height }} мм</strong>
                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('admin.offers.index') }}"
                    class="btn btn-primary mt-3">
                    Назад към запитванията
                </a>

            </div>
        </div>

    </section>

</x-backend>
