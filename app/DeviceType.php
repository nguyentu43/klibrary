<?php

namespace App;

class DeviceType
{
    const KINDLE_BASIC = 'kindle';
    const KINDLE_DX = 'kindle_dx';
    const KINDLE_FIRE = 'kindle_fire';
    const KINDLE_PAPERWHITE = 'kindle_pw';
    const KINDLE_PAPERWHITE3 = 'kindle_pw3';
    const KINDLE_VOYAGE = 'kindle_voyage';
    const KINDLE_OASIS = 'kindle_oasis';

    public static function getAllDeviceName()
    {
        return [
            'kindle' => 'Kindle Basic',
            'kindle_dx' => 'Kindle DX',
            'kindle_fire' => 'Kindle Fire',
            'kindle_pw' => 'Kindle Paperwhite 1, 2',
            'kindle_pw3' => 'Kindle Paperwhite 3',
            'kindle_voyage' => 'Kindle Voyage',
            'kindle_oasis' => 'Kindle Oasis'
        ];
    }
}