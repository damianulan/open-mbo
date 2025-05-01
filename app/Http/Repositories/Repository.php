<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class Repository
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

    abstract public function upsert(): static;

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

    public function check(): bool
    {
        return $this->success;
    }

    public function getResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message
        ];
    }

    public function getStatus(): string
    {
        return $this->status;
    }

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

    public function throwable(): static
    {
        $this->throws_exception = true;
        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }
}
