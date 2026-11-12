<?php

namespace App\Services\Admin;

use App\Models\Admin\PigeonExpressOffice;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PigeonExpressService
{
    /**
     * Retrieve all offices from the Pigeon Express API.
     *
     * @return array
     * @throws RuntimeException
     */
    private static function offices(): array
    {
        $allOffices = [];
        $page = 1;
        $lastPage = 1;

        do {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.pigeonexpress.com/v1/offices?per_page=100&page={$page}",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTPHEADER => [
                    "X-API-Key: " . env('PIGEON_EXPRESS_PK'),
                    "X-API-Secret: " . env('PIGEON_SECRET_KEY'),
                ],
            ]);

            $response = curl_exec($curl);

            if ($response === false) {
                $error = curl_error($curl);
                curl_close($curl);

                throw new RuntimeException("Pigeon Express API error: {$error}");
            }

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            $result = json_decode($response, true);

            if (
                $httpCode !== 200 ||
                !is_array($result) ||
                !($result['success'] ?? false) ||
                !isset($result['data'], $result['meta']['last_page']) ||
                !is_array($result['data'])
            ) {
                throw new RuntimeException('Неуспешно извличане на офисите от Pigeon Express.');
            }

            $allOffices = array_merge($allOffices, $result['data']);

            $lastPage = (int) $result['meta']['last_page'];
            $page++;

        } while ($page <= $lastPage);

        return $allOffices;
    }

    /**
     * Retrieve and insert all Pigeon Express offices into the database.
     *
     * @return void
     */
    public static function insertOffices(): void
    {
        $offices = self::offices();

        $records = [];

        foreach ($offices as $office) {
            $records[] = [
                'code' => $office['code'],
                'address' => $office['address'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::transaction(function () use ($records) {
            PigeonExpressOffice::query()->delete();

            foreach (array_chunk($records, 100) as $chunk) {
                PigeonExpressOffice::insert($chunk);
            }
        });
    }
}
