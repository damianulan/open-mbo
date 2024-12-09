<?php

namespace App\Facades\Fields;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Facades\Forms\RequestForms;

/**
 * 
 *
 * @property string $id
 * @property string $fullname
 * @property string $slug
 * @property string $field_type
 * @property string $db_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereDbType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereFieldType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FieldModel extends Model
{
    use UUID, RequestForms;

    protected $table = 'facades_fields';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'slug',
    ];

}
