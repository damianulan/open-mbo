<?php

namespace App\Support\Search;

use App\Support\Search\Dtos\ResultItem;
use App\Support\Search\Factories\IndexResource;
use App\Support\Search\Factories\ModelResourceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Lucent\Support\Traits\UUID;

/**
 * @property string $id
 * @property string $source_type
 * @property string $source_id
 * @property string $attribute
 * @property string $trigram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read IndexResource|null $resource
 * @property-read ResultItem|null $result_item
 * @property-read Model|Eloquent $source
 *
 * @method static Builder<static>|IndexModel newModelQuery()
 * @method static Builder<static>|IndexModel newQuery()
 * @method static Builder<static>|IndexModel query()
 * @method static Builder<static>|IndexModel search(string $input)
 * @method static Builder<static>|IndexModel whereAttribute($value)
 * @method static Builder<static>|IndexModel whereCreatedAt($value)
 * @method static Builder<static>|IndexModel whereId($value)
 * @method static Builder<static>|IndexModel whereSource(\Illuminate\Database\Eloquent\Model $source)
 * @method static Builder<static>|IndexModel whereSourceId($value)
 * @method static Builder<static>|IndexModel whereSourceType($value)
 * @method static Builder<static>|IndexModel whereTrigram($value)
 * @method static Builder<static>|IndexModel whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class IndexModel extends Model
{
    use UUID;

    protected $table = 'search_indexes';

    protected $fillable = [
        'source_type',
        'source_id',
        'attribute',
        'trigram',
    ];

    public function source(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function scopeWhereSource(Builder $query, Model $source): void
    {
        $query->where('source_type', $source::class)
            ->where('source_id', $source->id);
    }

    public function scopeSearch(Builder $query, string $input): void
    {
        $trigrams = ModelResourceFactory::getTrigrams($input);
        $query->select('source_type', 'source_id')
            ->whereHas('source')
            ->whereIn('trigram', $trigrams)
            ->groupBy('source_type')
            ->groupBy('source_id')
            ->havingRaw('COUNT(DISTINCT trigram) >= ?', [count($trigrams)])
            ->orderBy('created_at', 'desc');
    }

    protected function resource(): Attribute
    {
        return Attribute::make(
            get: fn (): ?IndexResource => $this->source->getSearchResource(),
        );
    }

    protected function resultItem(): Attribute
    {
        return Attribute::make(
            get: function (): ?ResultItem {
                $resource = $this->source->getSearchResource();
                if ($resource) {
                    return $resource->resultItem();
                }

                return null;
            },
        );
    }
}
