<?php

namespace App\Support\Lang;

use Illuminate\Support\Str;
use Spatie\TranslationLoader\LanguageLine;

class LanguageModel extends LanguageLine
{
    public $table = 'language_lines';

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
            $model->editable = $model->isEditable();

            return $model;
        });

        static::creating(function (self $model): self {
            $model->editable = $model->isEditable();

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
