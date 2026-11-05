<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{


    /**
     * Display all offers.
     */
    public function index(Request $request)
    {
        $offers = Offer::query()
            ->when($request->filled('offer_id'), function ($query) use ($request) {
                $query->where('id', $request->input('offer_id'));
            })
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Display an individual offer.
     */
    public function show(Offer $offer)
    {
        return view('admin.offers.show', [
            'offer' => $offer,
            'offerStatuses' => Offer::STATUSES,
        ]);
    }

    /**
     * Update the offer status.
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(array_keys(Offer::STATUSES)),
            ],
        ]);

        $offer->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.offers.show', $offer)
            ->with('success', 'Статусът на запитването беше обновен успешно.');
    }

    /**
     * Store a custom cardboard box offer request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'length' => ['required', 'integer', 'min:1', 'max:100000'],
            'width' => ['required', 'integer', 'min:1', 'max:100000'],
            'height' => ['required', 'integer', 'min:1', 'max:100000'],
        ], [
            'name.required' => 'Моля, въведете вашето име.',
            'phone.required' => 'Моля, въведете телефонен номер.',
            'length.required' => 'Моля, въведете дължината.',
            'width.required' => 'Моля, въведете ширината.',
            'height.required' => 'Моля, въведете височината.',
            'length.integer' => 'Дължината трябва да бъде цяло число.',
            'width.integer' => 'Ширината трябва да бъде цяло число.',
            'height.integer' => 'Височината трябва да бъде цяло число.',
            'length.min' => 'Дължината трябва да бъде поне 1 мм.',
            'width.min' => 'Ширината трябва да бъде поне 1 мм.',
            'height.min' => 'Височината трябва да бъде поне 1 мм.',
            'length.max' => 'Въведената дължина е твърде голяма.',
            'width.max' => 'Въведената ширина е твърде голяма.',
            'height.max' => 'Въведената височина е твърде голяма.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $offer = Offer::create([
            ...$validator->validated(),
            'status' => Offer::STATUSES['pending'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Вашето запитване беше изпратено успешно!',
            'offer_id' => $offer->id,
        ], 201);
    }
}
