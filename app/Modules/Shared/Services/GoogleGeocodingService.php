<?php

namespace App\Modules\Shared\Services;

use Illuminate\Support\Facades\Http;

class GoogleGeocodingService
{
    public function getAddressFromCoords(float $lat, float $lon): ?string
    {
        $apiKey = config('services.google_geocoding_api_key');
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'latlng' => "{$lat},{$lon}",
            'key' => $apiKey,
            'language' => 'ru',
        ]);

        if ($response->ok() && isset($response['results'][0]['formatted_address'])) {
            return $response['results'][0]['formatted_address'];
        }

        return null;
    }
}
