<?php

namespace App\Http\Controllers;

use App\Models\MBO\ObjectiveTemplate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getModelInstance(Request $request): JsonResponse
    {
        $instance = match ($request->input('model')) {
            'objective_template' => ObjectiveTemplate::find($request->input('id')),
            default => null,
        };

        return response()->json([
            'status' => $instance ? 'ok' : 'error',
            'instance' => $instance,
        ]);
    }
}
