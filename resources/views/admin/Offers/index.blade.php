
<x-backend>

    <div class="d-flex gap-2">
        <h3 class="col-lg-3">Всички запитвания за кашони</h3>
    </div>

    <hr>

    <form class="d-flex gap-3 flex-column"
        action="{{ route('admin.offers.index') }}"
        method="GET">

        <p>Потърсете запитване по номер:</p>

        <input
            class="col-lg-3 w-fit form-control rounded-5"
            type="number"
            name="offer_id"
            min="1"
            value="{{ request('offer_id') }}"
            placeholder="Номер на запитване">

        <button class="btn btn-primary rounded-pill" type="submit">
            Потърси
        </button>
    </form>

    <hr>

    <section class="mt-4">
        <div class="container">
            <div class="table-responsive">
                <table class="table cart-table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Клиент</th>
                            <th>Телефон</th>
                            <th>Размери (мм)</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th class="text-end">Действие</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($offers as $offer)
                            <tr>
                                <td>
                                    <strong>#{{ $offer->id }}</strong>
                                </td>

                                <td>
                                    {{ $offer->name }}
                                </td>

                                <td>
                                    <a href="tel:{{ $offer->phone }}">
                                        {{ $offer->phone }}
                                    </a>
                                </td>

                                <td>
                                    {{ $offer->length }} ×
                                    {{ $offer->width }} ×
                                    {{ $offer->height }}
                                </td>

                                <td>
                                    @switch($offer->status)
                                        @case('pending')
                                            <span class="badge bg-warning text-dark">
                                                {{ \App\Models\Offer::STATUSES[$offer->status] }}
                                            </span>
                                        @break

                                        @case('processing')
                                            <span class="badge bg-info text-dark">
                                                {{ \App\Models\Offer::STATUSES[$offer->status] }}
                                            </span>
                                        @break

                                        @case('completed')
                                            <span class="badge bg-success">
                                                {{ \App\Models\Offer::STATUSES[$offer->status] }}
                                            </span>
                                        @break

                                        @case('cancelled')
                                            <span class="badge bg-danger">
                                                {{ \App\Models\Offer::STATUSES[$offer->status] }}
                                            </span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">
                                                {{ $offer->status }}
                                            </span>
                                    @endswitch
                                </td>

                                <td>
                                    {{ $offer->created_at->format('d.m.Y H:i') }}
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.offers.show', $offer) }}"
                                        class="btn btn-info rounded-pill">
                                        Отвори
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Няма намерени запитвания.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $offers->links() }}
            </div>
        </div>
    </section>

</x-backend>
