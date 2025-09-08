<?php

namespace App\Support\DataTables;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property string $table_id
 * @property array<array-key, mixed> $columns
 * @property array<array-key, mixed> $selected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereUserId($value)
 * @mixin \Eloquent
 */
class SelectedColumns extends Model
{
    protected $table = 'datatables_columns_selected';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'table_id',
        'columns',
        'selected',
    ];

    protected $casts = [
        'columns' => 'array',
        'selected' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function findColumn(string $datatable_id)
    {
        return self::where('user_id', auth()->user()->id)->where('table_id', $datatable_id)->first();
    }
}
