<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\ModelLocales\CategoryLocale;
use Faker\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->state(CategoryLocale::class,'ru', function () {

    $ru_faker = Factory::create( 'ru_RU');

    return [
        'locale'=>'ru',
        'name' => $ru_faker->realText(15),
        'description' => $ru_faker->realText(100),
    ];
});
