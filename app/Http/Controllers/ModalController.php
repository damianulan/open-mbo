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
        $target = $request->get('target', null);
        $datas = $request->get('datas', []);
        $message = 'error';
        $view = null;
        $status = false;

        try {
            if ($target) {
                $partials = explode('@', $target);
                if (2 === count($partials)) {
                    $controller = $partials[0];
                    $method = $partials[1];

                    $object = new $controller();
                    $id = $datas['id'] ?? null;
                    if (is_array($datas) && count($datas)) {
                        foreach ($datas as $key => $value) {
                            $request->request->add([$key => $value]);
                        }
                    }
                    $view = $object->{$method}(
                        request: $request,
                        id: $id
                    );
                    if ($view instanceof View) {
                        $view = $view->render();
                        $status = true;
                    } else {
                        throw new Exception('Modal method must return a Illuminate\View\View instance.');
                    }
                } else {
                    throw new Exception('Modal target must be in format "controller@method".');
                }
            } else {
                throw new Exception('Modal target is missing.');
            }
        } catch (Throwable $e) {
            $this->e = $e;
        }

        return $this->responseJson($status, $message, [
            'view' => $view,
        ]);
    }
}
