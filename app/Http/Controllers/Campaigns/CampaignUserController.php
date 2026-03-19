<?php

namespace App\Http\Controllers\Campaigns;

use App\Forms\MBO\Campaign\CampaignEditUserForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use App\Services\Campaigns\BulkAssignUsers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class CampaignUserController extends AppController
{
    public function show(Request $request, UserCampaign $userCampaign): View
    {
        if ($request->user()->cannot('view', $userCampaign)) {
            unauthorized();
        }

        $userCampaign->loadMissing('user_objectives');

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

    public function update(Request $request, Campaign $campaign, CampaignEditUserForm $form): JsonResponse
    {
        $response = ['status' => 'error'];

        try {
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

        return response()->json($response);
    }

    public function toggleManual(int|string $id): RedirectResponse
    {
        $userCampaign = UserCampaign::findOrFail($id);
        $userCampaign->toggleManual();
        $message = __('mbo.info.manual_off');

        if ($userCampaign->manual) {
            $message = __('mbo.info.manual_on');
        }

        return redirect()->back()->with('success', $message);
    }

    public function moveStageUp(int|string $id): RedirectResponse
    {
        $userCampaign = UserCampaign::findOrFail($id);
        $userCampaign->nextStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $userCampaign->stageDescription()]);

        return redirect()->back()->with('success', $message);
    }

    public function moveStageDown(int|string $id): RedirectResponse
    {
        $userCampaign = UserCampaign::findOrFail($id);
        $userCampaign->previousStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $userCampaign->stageDescription()]);

        return redirect()->back()->with('success', $message);
    }

    public function delete(int|string $id): JsonResponse
    {
        $userCampaign = UserCampaign::findOrFail($id);

        if ($userCampaign->delete()) {
            return ajax()->ok(__('alerts.campaigns.success.users_deleted'));
        }

        return ajax()->error(__('alerts.campaigns.error.users_deleted'));
    }

    public function addUsers(Request $request, int|string|null $id): View
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
