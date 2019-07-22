<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ModelLocales\NoteLocale;
use Faker\Factory;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|

create note related for category

|
*/

$factory->state(NoteLocale::class, 'ua', function (Faker $faker) {

    $ru_faker = Factory::create( 'uk_UA');

    return [
        'locale'=>'ua',
        'title' => $ru_faker->name,
        'note' => $ru_faker->realText(400),
        'content' => function() use($ru_faker){
            $paragraphs = [];
            for ($i = 0; $i < rand(4, 10); $i++) {
                $paragraphs[] = $ru_faker->realText(rand(400, 1000));
            }
            return '<p>'.implode('</p><p>',$paragraphs).'</p>';
        },
        'owner_note_comment' => $faker->text(100),
    ];
});
