<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Http\Controllers\AppController;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Models\MBO\UserCampaign;
use App\Services\Campaigns\CampaignService;

class CampaignUserController extends AppController
{

    public function update(Request $request, $id, CampaignEditUserForm $form)
    {
        $campaign = Campaign::findOrFail($id);

        $request = $form::reformatRequest($request);
        $response = $form::validateJson($request, $id);
        if ($response['status'] === 'ok') {

            $service = CampaignService::boot($request, $campaign)->bulkAssignUsers();
            if ($service->check()) {
                $response['message'] = __('alerts.campaigns.success.users_added');
                return response()->json($response);
            }
        }
        return response()->json($response);
    }

    public function toggleManual(Request $request, $id)
    {
        $uc = UserCampaign::findOrFail($id);
        $uc->toggleManual();
        $message = __('mbo.info.manual_off');
        if ($uc->manual) {
            $message = __('mbo.info.manual_on');
        }
        return redirect()->back()->with('success', $message);
    }

    public function moveStageUp(Request $request, $id)
    {
        $uc = UserCampaign::findOrFail($id);
        $uc->nextStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $uc->stageDescription()]);
        return redirect()->back()->with('success', $message);
    }

    public function moveStageDown(Request $request, $id)
    {
        $uc = UserCampaign::findOrFail($id);
        $uc->previousStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $uc->stageDescription()]);
        return redirect()->back()->with('success', $message);
    }

    public function delete(Request $request, $id)
    {
        $uc = UserCampaign::findOrFail($id);
        if ($uc->delete()) {
            return ajax()->ok(__('alerts.campaigns.success.users_deleted'));
        }
        return ajax()->error(__('alerts.campaigns.error.users_deleted'));
    }

}