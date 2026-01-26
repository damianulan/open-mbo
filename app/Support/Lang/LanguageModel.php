<?php

namespace App\Support\Lang;

use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Support\Str;

class LanguageModel extends LanguageLine
{
    /**
     * Parts of lang locations is enough
     *
     * @var array
     */
    protected $editables = [
        'alerts.%',
        'auth.failed',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function (self $model): self {
            $model->editable = $this->isEditable();
            return $model;
        });

        static::creating(function (self $model): self {
            $model->editable = $this->isEditable();
            return $model;
        });
    }

    public function isEditable(): bool
    {
        $output = false;
        $str = $this->group . '.' . $this->key;

        if (Str::contains($str, $this->editables)) {
            $output = true;
        }

        return $output;
    }
}
