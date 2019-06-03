<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Device;
use App\Models\User;
use App\DeviceType;
use Faker\Generator as Faker;

$factory->define(Device::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => DeviceType::KINDLE_PAPERWHITE,
        'email' => $faker->username.'@kindle.com',
        'user_id' => User::first()->id
    ];
});
