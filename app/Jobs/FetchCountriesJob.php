<?php

namespace App\Jobs;

use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchCountriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $json = file_get_contents('https://restcountries.com/v3.1/all');
        $countries = json_decode($json, true);

        $now = now();

        collect($countries)->chunk(50)->each(function ($chunk) use ($now) {
            $insertData = [];

            foreach ($chunk as $country) {
                $insertData[] = [
                    'name_en' => $country['name']['common'],
                    'name_fa' => $country['translations']['per']['common'] ?? $country['name']['nativeName']['fas']['common'] ?? '',
                    'flag' => $country['flags']['png'],
                    'lat' => $country['latlng'][0] ?? 0,
                    'long' => $country['latlng'][1] ?? 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            Country::upsert($insertData, ['name_en'], ['name_fa', 'flag', 'lat', 'long', 'updated_at']);
        });

    }
}
