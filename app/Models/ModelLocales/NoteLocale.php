<?php

namespace App\Models\ModelLocales;

use Illuminate\Database\Eloquent\Model;

class NoteLocale extends Model
{
    protected $table = 'z_notes';

    public function note()
    {
        return $this->belongsTo('App\Models\Note');
    }

}
