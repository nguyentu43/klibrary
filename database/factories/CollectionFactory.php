<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Collection;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => function(){
            return User::first()->id;
        }
    ];
});
