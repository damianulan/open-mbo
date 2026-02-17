<?php

namespace App\Support\Lang;

use Illuminate\Support\Str;
use Spatie\TranslationLoader\LanguageLine;

/**
 * @property int $id
 * @property string $group
 * @property string $key
 * @property array<array-key, mixed> $text
 * @property int $editable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereEditable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LanguageModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
