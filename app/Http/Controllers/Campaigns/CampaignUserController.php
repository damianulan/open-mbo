<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Http\Controllers\Controller;
use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Models\MBO\UserCampaign;

class CampaignUserController extends Controller
{

    public function update(Request $request, $id, CampaignEditUserForm $form)
    {
        $campaign = Campaign::find($id);

        $request = $form::reformatRequest($request);
        $response = $form::validate($request, $id);
        $current = UserCampaign::where('campaign_id', $id)->get();
        $current_ids = $current->pluck('user_id')->flip();
        if ($response['status'] === 'ok') {

            if ($request->input('user_ids')) {
                foreach ($request->input('user_ids') as $user_id) {
                    if (!$current_ids->has($user_id)) {
                        $campaign->assignUser($user_id);
                    } else {
                        $current_ids->forget($user_id);
                    }
                }

                foreach ($current_ids as $user_id => $key) {
                    $campaign->unassignUser($user_id);
                }
            }

            $response['message'] = __('alerts.campaigns.success.users_added');
            return response()->json($response);
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
