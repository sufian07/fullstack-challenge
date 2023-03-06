<?php
namespace App\BL\Wether;

interface IWetherService {
    public function getWether($latitude, $longitude);
}