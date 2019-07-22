<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }

    public function limitNotes($limit)
    {
        return $this->notes()->limit($limit)->get();
    }

    public function locales()
    {
        return $this->hasMany('App\Models\ModelLocales\CategoryLocale');
    }
}
