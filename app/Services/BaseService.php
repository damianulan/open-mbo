<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class BaseService
 *
 * Abstract base class to standardize business logic encapsulation using the Service Design Pattern.
 * Designed to be extended by concrete service classes that implement create/update and delete operations
 * for specific Eloquent models in a transactional and controlled manner.
 *
 * ### Responsibilities:
 * - Encapsulates application logic (Service Layer).
 * - Manages input (`Request`) and optional model identifier (`$id`).
 * - Offers lifecycle control with success, error, and transactional handling.
 * - Supports optional exception throwing for error reporting flexibility.
 * - Enforces authorization checks before executing service logic.
 *
 * ### Usage:
 * Extend this class and implement `createOrUpdate()` and `destroy()` methods to handle model logic.
 * Use the static `boot()` method to instantiate the service, typically from a controller or another layer.
 *
 * ### Example Controller usage:
 * $userService = UserService::boot($request)->createOrUpdate();
 * if (!$userService->check()) {
 *     return response()->json($userService->getResponse(), 400);
 * }
 *
 * @abstract
 */
abstract class BaseService
{

    /**
     * Form request
     *
     * @var \Illuminate\Http\Request
     */
    protected Request $request;

    protected ?Model $model = null;

    protected ?Throwable $exception = null;

    protected $nest_instance = 0;

    /**
     * Service constructor. This is the only working way to create a service.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Database\Eloquent\Model|null $model
     * @return static
     */
    public static function boot(Request $request, ?Model $model = null): static
    {
        $instance = new static();
        $instance->model = $model;
        $instance->request = $request;

        if (!$instance->authorize()) {
            unauthorized();
        }
        $instance->handleException();

        return $instance;
    }


    /**
     * If you need you can set up conditions, that user must meet to use this service.
     * When returning false, service will throw unauthorized exception.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    public function handleException()
    {
        if ($this->exception) {
            report($this->exception);
        }
    }

    /**
     * Begin secure transaction that executes your callback. If callback throws exception, transaction will be rolled back.
     *
     * @param mixed $callback
     * @return mixed
     */
    protected function transaction($callback): mixed
    {
        $result = false;

        try {
            $this->nest_instance++;
            $result = DB::transaction($callback);
        } catch (\Throwable $th) {
            if ($this->nest_instance > 1) {
                throw $th;
            } else {
                $this->exception = $th;
            }
        }

        return $result;
    }

    /**
     * Ensures that service was executed successfully.
     *
     * @return bool
     */
    public function check(): bool
    {
        return is_null($this->exception);
    }


    public function getException(): ?Throwable
    {
        return $this->exception;
    }

    public function getMessage(): ?string
    {
        if ($this->exception) {
            return $this->exception->getMessage();
        }
        return null;
    }

    /**
     * Get model instance,
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getModel(): ?Model
    {
        return $this->model;
    }
}
