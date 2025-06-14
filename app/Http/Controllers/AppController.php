<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Core\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function logShow(?Model $model = null): void
    {
        $this->logView(null, $model);
    }

    protected function logView(?string $description = null, ?Model $model = null): void
    {
        $user = Auth::user();
        $activity = activity()->event('viewed');
        if ($model) {
            $activity->performedOn($model);
        }
        if ($user) {
            $activity->causedBy($user);
        }

        if (empty($description) && $model && $user) {
            $description = __('logging.description.view', ['model_map' => __('logging.model_mapping.' . $model::class), 'username' => $user->name]);
        } else {
            if (empty($description)) {
                $description = 'view';
            }
        }
        $activity->log($description);
    }
}
