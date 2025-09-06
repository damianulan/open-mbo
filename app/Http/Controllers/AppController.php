<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function logShow(?Model $model = null): void
    {
        $this->logView(null, $model);
    }

    protected function logView(?string $description = null, ?Model $model = null): void
    {
        if (Auth::check()) {
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

    protected function catchResponseRedirect(
        Throwable $exception,
        ?string $message = null,
        ?UrlGenerator $redirect = null
    ): RedirectResponse|UrlGenerator {
        if (!$exception instanceof AppException) {
            report($exception);
        }

        $message ??= __('alerts.error.operation');

        if (config('app.debug')) {
            $message = $exception->getMessage();
        }

        return $redirect ?? redirect()->route('index')->with('error', $message);
    }

    protected function catchResponseJson(
        Throwable $exception,
        ?string $message = null,
        array $datas = []
    ): JsonResponse {
        if (!$exception instanceof AppException) {
            report($exception);
        }

        if (config('app.debug')) {
            $message = $exception->getMessage();
        }

        $message ??= __('alerts.error.operation');

        return $this->ajaxResponseError($message, $datas);
    }

    protected function ajaxResponse(bool $success = true, string $message = '', array $datas = []): JsonResponse
    {
        if (empty($message)) {
            $success ? $message = __('alerts.success.operation') : $message = __('alerts.error.operation');
        }

        return response()->json(array_merge(
            [
                'status' => $success ? 'ok' : 'error',
                'message' => $message,
            ],
            $datas
        ));
    }

    protected function ajaxResponseError(string $message = '', array $datas = []): JsonResponse
    {
        return $this->ajaxResponse(false, $message, $datas);
    }

    protected function ajaxResponseSuccess(string $message = '', array $datas = []): JsonResponse
    {
        return $this->ajaxResponse(true, $message, $datas);
    }
}
