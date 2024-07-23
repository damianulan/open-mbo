<?php

namespace App\Facades\DataTables;

use Illuminate\Database\Eloquent\Model;
use App\Models\Core\User;

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
