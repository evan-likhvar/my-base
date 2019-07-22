<?php

namespace App\Interfaces;

use App\TranslatableModel;

interface TranslatableContract
{
    public static function bootTranslatableModelTrait():void;
    public function translate(TranslatableModel $model, array $translation):void;
    public static function getTranslation(TranslatableModel $model): array;

}