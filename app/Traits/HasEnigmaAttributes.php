<?php

namespace App\Traits;

use App\Builders\Eloquent\EnigmaBuilder;
use App\Casts\Enigma;

trait HasEnigmaAttributes
{
    public function getEncryptedAttributes(): array
    {
        return $this->encrypted ?? [];
    }

    public function newEloquentBuilder($query): EnigmaBuilder
    {
        return new EnigmaBuilder($query);
    }

    public function getCasts()
    {
        if (config('app.enigma_models')) {
            $casts = [];
            foreach ($this->getEncryptedAttributes() as $attribute) {
                $casts[$attribute] = Enigma::class;
            }

            $this->mergeCasts($casts);
        }

        return parent::getCasts();
    }

    protected static function bootHasEnigmaAttributes(): void
    {
        static::creating(fn ($model) => self::setHash($model));

        static::updating(fn ($model) => self::setHash($model));
    }

    protected static function setHash($model)
    {
        $encrypted = $model->getEncryptedAttributes();

        foreach ($encrypted as $attribute) {
            if ($model->isDirty($attribute)) {
                $attributeHash = $attribute . '_hash';
                $model->{$attributeHash} = Enigma::hashValue($model->{$attribute});
            }
        }

        return $model;
    }
}
