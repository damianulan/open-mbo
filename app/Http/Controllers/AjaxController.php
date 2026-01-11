<?php

namespace App\Http\Controllers;

use App\Models\MBO\ObjectiveTemplate;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getModelInstance(Request $request)
    {
        $model = $request->input('model') ?? null;
        $id = $request->input('id') ?? null;
        $status = 'error';
        $instance = null;

        switch ($model) {
            case 'objective_template':
                $instance = ObjectiveTemplate::find($id);
                break;

            default:
                // code...
                break;
        }

        if ($instance) {
            $status = 'ok';
        }

        return response()->json(array(
            'status' => $status,
            'instance' => $instance,
        ));
    }
}
