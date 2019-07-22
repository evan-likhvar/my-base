<?php

namespace App\Traits;

use App\TranslatableModel;
use ReflectionClass;

trait TranslatableModelTrait
{
    public static function bootTranslatableModelTrait(): void
    {
        static::retrieved(function (TranslatableModel $model) {
            if (config('site-locales.DefaultLocale') != app()->getLocale())
                $model->translate($model, self::getTranslation($model));
        });
    }

    public function translate(TranslatableModel $model, array $translation): void
    {
        collect($model->translatableFields())->map(
            function ($field) use ($model, $translation) {
                if (!empty($translation[$field]))
                    $model->$field = $translation[$field];
            }
        );
    }

    /**
     * @param TranslatableModel $model
     * @return array
     * @throws \ReflectionException
     */
    public static function getTranslation(TranslatableModel $model): array
    {
        return ((new ReflectionClass($model->translationTable()))->newInstance())
            ::where($model->keyToOrigin(), $model->id)->where('locale', app()->getLocale())
            ->first()->toArray();
    }
}