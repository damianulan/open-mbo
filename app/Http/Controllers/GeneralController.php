<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Forms\MBO\Campaign\CampaignEditObjective;
use App\Models\MBO\Campaign;

class GeneralController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getModal(Request $request)
    {
        $type = $request->input('type') ?? null;
        $id = $request->input('id') ?? null;
        $status = 'error';
        $view = null;
        $form = null;
        $params = array();

        switch ($type) {
            case 'campaigns.add_objectives':
                    $params = [
                        'form' => CampaignEditObjective::boot(),
                    ];
                break;

            default:
                # code...
                break;
        }

        $view = view('components.modals.'.$type, $params)->render();

        return response()->json([
            'status' => $status,
            'view' => $view,
        ]);
    }
}
