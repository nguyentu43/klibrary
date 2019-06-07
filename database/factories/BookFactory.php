<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Book;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'authors' => $faker->name(),
        'comments' => $faker->paragraph(),
        'identifier' => $faker->isbn10,
        'tags' => $faker->word,
        'publisher' => $faker->company,
        'language' => $faker->languageCode,
        'date' => $faker->date,
        'user_id' => function(){
            return User::first()->id;
        }
    ];
});

$factory->afterCreating(Book::class, function($book, $faker){
    $id = $book->id;
    Storage::put("ebooks/$id.docx", 'DEMO');
    $book->formats = [ [ 'type' => 'docx', 'size' => 4 ] ];
    $book->save();
});
