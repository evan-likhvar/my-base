<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class, 5)->create()->each(function (App\Models\Category $category) {
            for ($i = 0; $i<rand(15, 20); $i++)
                $category->notes()->save(factory(App\Models\Note::class)->make());
        });
    }
}
