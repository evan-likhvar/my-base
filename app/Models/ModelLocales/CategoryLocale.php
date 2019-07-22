<?php

namespace App\Models\ModelLocales;

use Illuminate\Database\Eloquent\Model;

class CategoryLocale extends Model
{
    protected $table = 'z_categories';

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
