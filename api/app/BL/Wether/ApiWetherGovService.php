<?php
namespace App\BL\Wether;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ApiWetherGovService implements IWetherService{
    public function getWether($latitude, $longitude){
        try {
            $url = "https://api.weather.gov/points/$latitude,$longitude";
            $point = Http::get($url);
            $pointJson = $point->json();
            if(!isset($pointJson['properties']['forecast'])) {
                throw new Exception('No wether data found');
            }
            $forcastUrl = $pointJson['properties']['forecast'];
            $response = Http::get($forcastUrl);
            $json = $response->json();
            return $json['properties']['periods'][0];
        } catch (Exception $ex){
            Log::error($ex);
            return [];
        }
    }
}