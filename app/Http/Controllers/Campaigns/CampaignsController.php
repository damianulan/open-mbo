<?php

namespace App\Http\Controllers\Campaigns;

use App\Events\MBO\Campaigns\CampaignViewed;
use App\Forms\MBO\Campaign\CampaignEditForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Campaign;
use App\Services\Campaigns\CreateOrUpdate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class CampaignsController extends AppController
{
    public function index(Request $request): View
    {
        if ($request->user()->cannot('viewAny', Campaign::class)) {
            unauthorized();
        }
        $this->logView('Wyświetlono listę kampanii pomiarowych');

        $campaigns = Campaign::orderByStatus()->paginate(30);

        return view('pages.mbo.campaigns.index', array(
            'campaigns' => $campaigns,
        ));
    }

    public function create(Request $request, CampaignEditForm $form): View
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }

        return view('pages.mbo.campaigns.edit', array(
            'form' => $form->getDefinition(),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, CampaignEditForm $form): RedirectResponse
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }
        $redirect = null;
        try {
            $form->validate($request);
            $service = CreateOrUpdate::boot(request: $request)->execute();

            if ($service->passed()) {
                $campaign = $service->campaign;

                $redirect = redirect()->route('campaigns.show', $campaign->id)->with('success', __('alerts.campaigns.success.create', array('name' => $campaign->name)));
            }
        } catch (Throwable $e) {
            $this->e = $e;
        }

        return $this->returnResponseRedirect($redirect, $service->getErrors() ?? __('alerts.campaigns.error.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, Campaign $campaign): View
    {
        if ($request->user()->cannot('view', $campaign)) {
            unauthorized();
        }

        // CampaignViewed::dispatch($campaign);
        $this->logShow($campaign);
        $header = $campaign->name . ' [' . $campaign->period . ']';

        return view('pages.mbo.campaigns.show', array(
            'campaign' => $campaign,
            'pagetitle' => $header,
        ));
    }

    public function edit(Request $request, Campaign $campaign, CampaignEditForm $form): View
    {
        if ($request->user()->cannot('mbo-campaign-update', $campaign)) {
            unauthorized();
        }


        return view('pages.mbo.campaigns.edit', array(
            'campaign' => $campaign,
            'form' => $form->setModel($campaign)->getDefinition(),
        ));
    }

    public function update(Request $request, $id, CampaignEditForm $form): RedirectResponse
    {
        $campaign = Campaign::findOrFail($id);
        if ($request->user()->cannot('mbo-campaign-update', $campaign)) {
            unauthorized();
        }
        $redirect = null;
        try {
            $form->validate();

            $service = CreateOrUpdate::boot(request: $request, campaign: $campaign)->execute();

            if ($service->passed()) {
                $campaign = $service->getResult();

                $redirect = redirect()->route('campaigns.show', $id)->with('success', __('alerts.campaigns.success.edit', array('name' => $campaign->name)));
            }
        } catch (Throwable $e) {
            $this->e = $e;
        }

        return $this->returnResponseRedirect($redirect, 'error' ?? __('alerts.campaigns.error.edit', array('name' => $campaign->name)));
    }

    public function terminate(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        if ($campaign->terminate()) {
            return ajax()->ok(__('alerts.campaigns.success.terminate'));
        }

        return ajax()->error(__('alerts.campaigns.error.terminate'));
    }

    public function resume(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        if ($campaign->resume()) {
            return ajax()->ok(__('alerts.campaigns.success.resume'));
        }

        return ajax()->error(__('alerts.campaigns.error.resume'));
    }

    public function cancel(Request $request, $id)
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
}
