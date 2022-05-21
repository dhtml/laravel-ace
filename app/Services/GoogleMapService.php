<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Cache;

class GoogleMapService
{

    /**
     * Retrieve the geolocation of an address using google map service
     *
     * @param $address
     * @return mixed
     */
    public static function getAddressLocation($address)
    {
        $address = str_replace(' ', '+', $address);

        $cacheLimit = config('api.google_map.cache_limit');

        return Cache::remember($address, $cacheLimit, function () use ($address) {
            $location = ['latitude' => 0, 'longitude' => 0];
            $apiKey = config('api.google_map.api_key');

            try {
                $url = 'https://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false&key=' . $apiKey;
                $geocode = file_get_contents($url);
                $output = json_decode($geocode);

                if ($output->status == 'OK') {
                    $location['latitude'] = $output->results[0]->geometry->location->lat;
                    $location['longitude'] = $output->results[0]->geometry->location->lng;
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            return $location;
        });
    }


}
