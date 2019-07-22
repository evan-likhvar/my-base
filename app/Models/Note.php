<?php

namespace App\Models;

use App\TranslatableModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends TranslatableModel
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function scopePublicPublished($query)
    {
        return $query->where('access', 'public')->where('confirmed',1)->where('published_at','<',Carbon::now());
    }

    public function scopeInCategory($query,string $categoryName)
    {
        return $query->where('access', 'public')->where('confirmed',1)->where('published_at','<',Carbon::now());
    }

    public function locales()
    {
        return $this->hasMany('App\Models\ModelLocales\NoteLocale');
    }

    /**
     * return array of fields then must be translatable
     *
     * @return array
     */
    protected function translatableFields(): array
    {
        return ['title','note','content','owner_note_comment'];
    }

    /**
     * return prefix for translate table
     *
     * @return string
     */
    protected function translationTable(): string
    {
        return 'App\Models\ModelLocales\NoteLocale';
    }

    /**
     * return foreign key to origin table from translationTable
     *
     * @return string
     */
    protected function keyToOrigin(): string
    {
        return 'note_id';
    }
}
