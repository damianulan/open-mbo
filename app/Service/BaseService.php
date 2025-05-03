<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    /**
     * Related model id
     *
     * @var mixed
     */
    protected $id;

    private ?Model $model = null;

    /**
     * When true, throws exception on error, otherwise use getResponse() or getMessage() to return error message.
     *
     * @var bool
     */
    protected bool $throws_exception = false;

    private bool $success = false;

    private string $status = 'error';

    private ?string $message = null;

    /**
     * Service constructor. This is the only working way to create a service.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $id - declare model id if needed
     * @return static
     */
    public static function boot(Request $request, $id = null): static
    {
        $instance = new static();
        $instance->request = $request;
        $instance->id = $id;

        if (!$instance->authorize()) {
            unauthorized();
        }

        return $instance;
    }

    /**
     * Use when creating or updating model. Inside this method you can use transaction() method to execute secure transaction.
     *
     * @return static
     */
    abstract public function createOrUpdate(): static;

    /**
     * Use when deleting or destroying model. Inside this method you can use transaction() method to execute secure transaction.
     *
     * @return static
     */
    abstract public function destroy(): static;

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

    private function handleException(\Throwable $th)
    {
        $this->success = false;
        $this->message = $th->getMessage();
        if ($this->throws_exception) {
            throw $th;
        }
    }

    /**
     * Begin secure transaction that executes your callback. If callback throws exception, transaction will be rolled back.
     * In your callback make sure you return model instance.
     *
     * @param mixed $callback
     * @return void
     */
    protected function transaction($callback): void
    {
        DB::beginTransaction();
        try {
            $this->model = $callback();

            DB::commit();
            $this->success = true;
            $this->status = 'ok';
        } catch (\Throwable $th) {
            DB::rollback();
            $this->handleException($th);
        }
    }

    /**
     * Ensures that service was executed successfully.
     *
     * @return bool
     */
    public function check(): bool
    {
        return $this->success;
    }

    /**
     * Get response data, when you want to return data to client with json response.
     *
     * @return array
     */
    public function getResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message
        ];
    }

    /**
     * Get string representation of service status.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get error message, when service was executed unsuccessfully. It includes exception message if service throws one.
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function isUpdating(): bool
    {
        return $this->id ? true : false;
    }

    public function isInserting(): bool
    {
        return $this->id ? false : true;
    }

    /**
     * If you want to throw exception on service error, set this to true.
     *
     * @return static
     */
    public function throwable(): static
    {
        $this->throws_exception = true;
        return $this;
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
