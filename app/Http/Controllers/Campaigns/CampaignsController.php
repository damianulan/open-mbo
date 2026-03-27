<?php

namespace App\Http\Controllers\Campaigns;

use App\Filters\Collections\CampaignsListFilters;
use App\Forms\Mbo\Campaign\CampaignEditForm;
use App\Http\Controllers\AppController;
use App\Models\Mbo\Campaign;
use App\Services\Campaigns\CreateOrUpdate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class CampaignsController extends AppController
{
    public function index(Request $request, CampaignsListFilters $filters): Renderable
    {
        if ($request->user()->cannot('viewAny', Campaign::class)) {
            unauthorized();
        }
        $this->logView('Wyświetlono listę kampanii pomiarowych');

        $campaigns = Campaign::orderByStatus()->registerFilters($filters)->paginate(30);

        return view('pages.mbo.campaigns.index', [
            'campaigns' => $campaigns,
            'filters' => $filters->getForm(),
        ]);
    }

    public function create(Request $request, CampaignEditForm $form): Renderable
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }

        return view('pages.mbo.campaigns.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CampaignEditForm $form): RedirectResponse
    {
        $this->authorize('create', Campaign::class);

        $redirect = null;
        $service = null;
        try {
            $form->validate();
            $service = CreateOrUpdate::boot(request: $request)->execute();

            if ($service->passed()) {
                $campaign = $service->campaign;

                $redirect = redirect()->route('campaigns.show', $campaign->id)->with('success', __('alerts.campaigns.success.create', ['name' => $campaign->name]));
            }
        } catch (Throwable $e) {
            $this->e = $e;
        }

        $message = $this->getServiceErrors($service?->getErrors());

        return $this->returnResponseRedirect($redirect, $message ?? __('alerts.campaigns.error.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign): Renderable
    {
        $this->authorize('view', $campaign);

        $this->logShow($campaign);
        $this->setPagetitle("{$campaign->name} [{$campaign->period}]");

        return view('pages.mbo.campaigns.show', [
            'campaign' => $campaign,
        ]);
    }

    public function edit(Campaign $campaign, CampaignEditForm $form): Renderable
    {
        $this->authorize('update', $campaign);

        return view('pages.mbo.campaigns.edit', [
            'campaign' => $campaign,
            'form' => $form->setModel($campaign)->getDefinition(),
        ]);
    }

    public function update(Request $request, Campaign $campaign, CampaignEditForm $form): RedirectResponse
    {
        $this->authorize('update', $campaign);

        $redirect = null;
        $service = null;
        try {
            $form->validate();

            $service = CreateOrUpdate::boot(request: $request, campaign: $campaign)->execute();

            if ($service->passed()) {
                $campaign = $service->getResult();

                $redirect = redirect()->route('campaigns.show', $campaign)->with('info_alert', __('alerts.campaigns.success.edit', ['name' => $campaign->name]));
            }
        } catch (Throwable $e) {
            $this->e = $e;
        }

        $message = $this->getServiceErrors($service?->getErrors());

        return $this->returnResponseRedirect($redirect, $message ?? __('alerts.campaigns.error.edit', ['name' => $campaign->name]));
    }

    public function terminate(int|string $id): JsonResponse
    {
        $campaign = Campaign::findOrFail($id);

        if ($this->allows('terminate', $campaign)) {
            if ($campaign->terminate()) {
                return ajax()->ok(__('alerts.campaigns.success.terminate'));
            }
        }

        return ajax()->error(__('alerts.campaigns.error.terminate'));
    }

    public function resume(int|string $id): JsonResponse
    {
        $campaign = Campaign::findOrFail($id);

        if ($campaign->resume()) {
            return ajax()->ok(__('alerts.campaigns.success.resume'));
        }

        return ajax()->error(__('alerts.campaigns.error.resume'));
    }

    public function cancel(int|string $id): JsonResponse
    {
        $campaign = Campaign::findOrFail($id);

        if ($campaign->cancel()) {
            foreach ($campaign->user_campaigns as $uc) {
                $uc->cancel();
            }

            return ajax()->ok(__('alerts.campaigns.success.cancel'));
        }

        return ajax()->error(__('alerts.campaigns.error.cancel'));
    }

    private function getServiceErrors(array|string|null $errors): ?string
    {
        if (is_array($errors)) {
            return implode(' | ', $errors);
        }

        return $errors;
    }
}
