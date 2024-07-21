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
    ];

    protected $casts = [
        'columns' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
