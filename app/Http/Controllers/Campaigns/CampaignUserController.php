<?php

namespace App\Http\Controllers\Campaigns;

use App\Contracts\Repositories\CampaignRepositoryContract;
use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Forms\Mbo\Campaign\CampaignEditUserForm;
use App\Http\Controllers\AppController;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\UserCampaign;
use App\Services\Campaigns\BulkAssignUsers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class CampaignUserController extends AppController
{
    public function show(Request $request, UserCampaign $userCampaign, UserCampaignRepositoryContract $userCampaignRepository): View
    {
        if ($request->user()->cannot('view', $userCampaign)) {
            unauthorized();
        }

        $userCampaign = $userCampaignRepository->findForShow($userCampaign->id);

        $this->logShow($userCampaign);
        $header = "{$userCampaign->campaign->name} [{$userCampaign->campaign->period}]";
        $this->setPagetitle($header);

        return view('pages.mbo.campaigns.user', [
            'campaign' => $userCampaign->campaign,
            'userCampaign' => $userCampaign,
            'user' => $userCampaign->user,
            'chartCompletion' => $userCampaign->chart('user_campaign_completion'),
        ]);
    }

    public function update(Request $request, Campaign $campaign, CampaignEditUserForm $form): JsonResponse
    {
        $response = ['status' => 'error'];

        try {
            $response = $form->validateJson();

            if ($response['status'] === 'ok') {
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

    public function toggleManual(int|string $id, UserCampaignRepositoryContract $userCampaignRepository): RedirectResponse
    {
        $userCampaign = $userCampaignRepository->findOrFail($id, ['campaign']);
        $userCampaign->toggleManual();
        $message = __('mbo.info.manual_off');

        if ($userCampaign->manual) {
            $message = __('mbo.info.manual_on');
        }

        return redirect()->back()->with('success', $message);
    }

    public function moveStageUp(int|string $id, UserCampaignRepositoryContract $userCampaignRepository): RedirectResponse
    {
        $userCampaign = $userCampaignRepository->findOrFail($id, ['campaign']);
        $userCampaign->nextStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $userCampaign->stageDescription()]);

        return redirect()->back()->with('success', $message);
    }

    public function moveStageDown(int|string $id, UserCampaignRepositoryContract $userCampaignRepository): RedirectResponse
    {
        $userCampaign = $userCampaignRepository->findOrFail($id, ['campaign']);
        $userCampaign->previousStage();
        $message = __('mbo.info.campaign_stage_changed', ['stage' => $userCampaign->stageDescription()]);

        return redirect()->back()->with('success', $message);
    }

    public function delete(int|string $id, UserCampaignRepositoryContract $userCampaignRepository): JsonResponse
    {
        $userCampaign = $userCampaignRepository->findOrFail($id);

        if ($userCampaign->delete()) {
            return ajax()->ok(__('alerts.campaigns.success.users_deleted'));
        }

        return ajax()->error(__('alerts.campaigns.error.users_deleted'));
    }

    public function addUsers(Request $request, int|string|null $id, CampaignRepositoryContract $campaignRepository): View
    {
        $params = [];

        if ($id) {
            $campaign = $campaignRepository->find($id);

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
