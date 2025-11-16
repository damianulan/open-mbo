<?php

namespace App\Support\DataTables;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $user_id
 * @property string $table_id
 * @property array<array-key, mixed> $columns
 * @property array<array-key, mixed> $selected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Core\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Support\DataTables\SelectedColumns whereUserId($value)
 * @mixin \Eloquent
 */
class SelectedColumns extends Model
{
    public $timestamps = true;

    protected $table = 'datatables_columns_selected';

    protected $primaryKey = 'id';

    protected $fillable = array(
        'user_id',
        'table_id',
        'columns',
        'selected',
    );

    protected $casts = array(
        'columns' => 'array',
        'selected' => 'array',
    );

    public static function findColumn(string $datatable_id)
    {
        return self::where('user_id', auth()->user()->id)->where('table_id', $datatable_id)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
