<?php

namespace App\Http\Controllers\Campaigns;

use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use App\Services\Campaigns\BulkAssignUsers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

class CampaignUserController extends AppController
{
    public function show(Request $request, UserCampaign $userCampaign): View
    {
        if ($request->user()->cannot('view', $userCampaign)) {
            unauthorized();
        }

        $this->logShow($userCampaign);
        $header = $userCampaign->campaign->name . ' [' . $userCampaign->campaign->period . ']';

        return view('pages.mbo.campaigns.user', [
            'campaign' => $userCampaign->campaign,
            'userCampaign' => $userCampaign,
            'user' => $userCampaign->user,
            'chartCompletion' => $userCampaign->chart('user_campaign_completion'),
            'pagetitle' => $header,
        ]);
    }

    public function update(Request $request, $id, CampaignEditUserForm $form)
    {
        try {
            $campaign = Campaign::findOrFail($id);

            $response = $form->validateJson();
            if ('ok' === $response['status']) {

                $service = BulkAssignUsers::boot(request: $request, campaign: $campaign)->execute();
                if ($service->passed()) {
                    $response['message'] = __('alerts.campaigns.success.users_added');
                }
            }
        } catch (Throwable $th) {
            $this->e = $th;
        }

        return $response;
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

    public function addUsers(Request $request, $id): View
    {
        $params = [];
        if ($id) {
            $campaign = Campaign::find($id);
            if ($campaign) {
                $params = [
                    'id' => $id,
                    'form' => CampaignEditUserForm::bootWithModel($campaign)->getDefinition(),
                ];
            }
        }

        return view('components.modals.campaigns.add_users', $params);
    }
}
