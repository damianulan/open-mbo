<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class ModalController extends AppController
{
    public function getModal(Request $request): JsonResponse
    {
        $message = 'error';
        $view = null;
        $status = false;

        try {
            [$status, $view] = $this->resolveModalView($request);
        } catch (Throwable $e) {
            report($e);
            $this->e = $e;
        }

        return $this->responseJson($status, $message, [
            'view' => $view,
        ]);
    }

    /**
     * @return array{0: bool, 1: string}
     */
    private function resolveModalView(Request $request): array
    {
        $target = (string) $request->input('target');

        if (blank($target)) {
            throw new Exception('Modal target is missing.');
        }

        $partials = explode('@', $target);

        if (2 !== count($partials)) {
            throw new Exception('Modal target must be in format "controller@method".');
        }

        [$controller, $method] = $partials;

        if ( ! class_exists($controller)) {
            throw new Exception('Modal controller could not be resolved.');
        }

        $datas = $request->input('datas', []);

        if (is_array($datas) && [] !== $datas) {
            $request->request->add($datas);
        }

        $view = app($controller)->{$method}(
            request: $request,
            id: $datas['id'] ?? null,
        );

        if ( ! $view instanceof View) {
            throw new Exception('Modal method must return a Illuminate\View\View instance.');
        }

        return [true, $view->render()];
    }
}
