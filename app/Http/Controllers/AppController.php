<?php

namespace App\Http\Controllers;

use App\Enums\Core\MessageType;
use App\Exceptions\AppException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected ?Throwable $e = null;

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
                $description = __('logging.description.view', ['model_map' => __('logging.model_mapping.'.$model::class), 'username' => $user->name]);
            } else {
                if (empty($description)) {
                    $description = 'view';
                }
            }
            $activity->log($description);
        }
    }

    protected function returnResponseRedirect(?RedirectResponse $defaultRedirect = null, ?string $errorMessage = null): RedirectResponse|UrlGenerator
    {
        if ($this->e) {
            return $this->catchResponseRedirect($this->e, $errorMessage);
        }

        if (is_null($defaultRedirect)) {
            $defaultRedirect = redirect()->back();
            if (! is_null($errorMessage)) {
                $defaultRedirect->with(MessageType::ERROR, $errorMessage);
            }
        }

        return $defaultRedirect;
    }

    protected function catchResponseRedirect(
        Throwable $exception,
        ?string $message = null,
        UrlGenerator|RedirectResponse|null $redirect = null
    ): RedirectResponse|UrlGenerator {
        if (! $exception instanceof AppException) {
            report($exception);
        }

        if (config('app.debug')) {
            $message = $exception->getMessage();
        }

        if (is_null($message)) {
            $message = __('alerts.error.operation');
        }

        return $redirect ?? redirect()->back()->with(MessageType::ERROR, $message);
    }

    protected function catchResponseJson(
        Throwable $exception,
        ?string $message = null,
        array $datas = []
    ): JsonResponse {
        if (! $exception instanceof AppException) {
            report($exception);
        }

        if (config('app.debug')) {
            $message = $exception->getMessage();
        }

        $message ??= __('alerts.error.operation');

        return $this->responseJsonError($message, $datas);
    }

    protected function responseJson(bool $success = true, ?string $message = null, array $datas = []): JsonResponse
    {
        if ($this->e) {
            return $this->catchResponseJson($this->e, $message, $datas);
        }

        return $this->finalResponseJson($success, $message, $datas);
    }

    private function finalResponseJson(bool $success = true, ?string $message = null, array $datas = []): JsonResponse
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

    protected function responseJsonError(?string $message = null, array $datas = []): JsonResponse
    {
        return $this->finalResponseJson(false, $message, $datas);
    }

    protected function responseJsonSuccess(?string $message = null, array $datas = []): JsonResponse
    {
        return $this->finalResponseJson(true, $message, $datas);
    }
}
