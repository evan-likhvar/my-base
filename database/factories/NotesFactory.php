<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Note;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|

create note related for category

|
*/

$factory->define(Note::class, function (Faker $faker) {

    $user = (new User())->all()->random();
    $access = config('site-constants.note-access');
    shuffle($access);
    return [
        'user_id' => $user->id,
        'title' => $faker->name,
        'note' => $faker->realText(400),
        'content' => function() use($faker){
            $paragraphs = [];
            for ($i = 0; $i < rand(4, 10); $i++) {
                $paragraphs[] = $faker->realText(rand(400, 1000));
            }
            return '<p>'.implode('</p><p>',$paragraphs).'</p>';
        },
        'owner_note_comment' => $faker->text(100),
        'access' => $access[0],
        'confirmed' => rand(0, 10) > 0 ? 1 : 0,
        'published_at' => $faker->dateTimeThisMonth
    ];
});
