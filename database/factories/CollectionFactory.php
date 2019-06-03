<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Collection;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Collection::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'user_id' => User::first()->id
    ];
});

$factory->afterCreating(Collection::class, function($collection, $faker){
    $collection->books()->attach(DB::table('books')->limit(3)->pluck('id'));
});
