<?php


use Illuminate\Database\Seeder;

class LocaleCategoryNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        factory(App\Models\Category::class, 5)->create()->each(function (App\Models\Category $category) {

            //создать три локали для категории
            \App\Models\ModelLocales\CategoryLocale::create([
                'category_id' => $category->id,
                'locale' => 'en',
                'name' => $category->name,
                'description' => $category->description
            ]);
            $category->locales()->save(factory(App\Models\ModelLocales\CategoryLocale::class)->states('ru')->make());
            $category->locales()->save(factory(App\Models\ModelLocales\CategoryLocale::class)->states('ua')->make());

            //создать статьи для каждой локали
            //for ($i = 0; $i<rand(1, 6); $i++) {
            for ($i = 0; $i < 2; $i++) {
                /** @var \App\Models\Note $mainNote */
                $mainNote = $category->notes()->save(factory(App\Models\Note::class)->make());

                \App\Models\ModelLocales\NoteLocale::create([
                    'note_id' => $mainNote->id,
                    'locale' => 'en',
                    'title' => $mainNote->title,
                    'note' => $mainNote->note,
                    'content' => $mainNote->content,
                    'owner_note_comment' => $mainNote->owner_note_comment,
                ]);
                $mainNote->locales()->save(factory(App\Models\ModelLocales\NoteLocale::class)->states('ru')->make());
                $mainNote->locales()->save(factory(App\Models\ModelLocales\NoteLocale::class)->states('ua')->make());
            }
        });
    }
}
