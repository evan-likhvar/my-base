<?php

namespace App;

use App\Interfaces\TranslatableContract;
use App\Traits\TranslatableModelTrait;
use Illuminate\Database\Eloquent\Model;

abstract class TranslatableModel extends Model implements TranslatableContract
{
    use TranslatableModelTrait;

    /**
     * return array of fields then must be translatable
     *
     * @return array
     */
    abstract protected function translatableFields(): array;

    /**
     * return translate table
     *
     * @return string
     */
    abstract protected function translationTable(): string;

    /**
     * return foreign key to origin table table
     *
     * @return string
     */
    abstract protected function keyToOrigin(): string;
}
