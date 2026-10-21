<?php

use App\Models\API\City;
use App\Services\Admin\EkontService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Services\Admin\SpeedyService;


Route::prefix('admin/api')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/cities', function () {

            $regions = Http::get('https://bgpostcode.com/api/v1/regions')->json();

            City::truncate();

            foreach ($regions as $region) {

                $cities = Http::get(
                    "https://bgpostcode.com/api/v1/regions/{$region['id']}/city"
                )->json();

                foreach ($cities as $city) {

                    City::create([
                        'name' => $city['name'],
                    ]);
                }
            }

            return redirect(route('dashboard'));
        });

        Route::get('/ekont', function () {
            EkontService::insertOffices();
        });

        Route::get('/speedy', function () {
            SpeedyService::insertOffices();
        });

    });
