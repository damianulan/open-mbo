<?php

namespace App\Http\Controllers\Campaigns;

use App\Events\MBO\Campaigns\CampaignViewed;
use App\Forms\MBO\Campaign\CampaignEditForm;
use App\Http\Controllers\AppController;
use App\Models\MBO\Campaign;
use App\Services\Campaigns\CreateOrUpdate;
use Illuminate\Http\Request;

class CampaignsController extends AppController
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Campaign::class)) {
            unauthorized();
        }
        $this->logView('Wyświetlono listę kampanii pomiarowych');

        $campaigns = Campaign::checkAccess()->orderByStatus()->paginate(30);

        return view('pages.mbo.campaigns.index', [
            'campaigns' => $campaigns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }

        return view('pages.mbo.campaigns.edit', [
            'form' => CampaignEditForm::definition($request),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CampaignEditForm $form)
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }
        $request = $form::reformatRequest($request);
        $form::validate($request);
        $service = CreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            $campaign = $service->campaign;

            return redirect()->route('campaigns.show', $campaign->id)->with('success', __('alerts.campaigns.success.create', ['name' => $campaign->name]));
        }

        return redirect()->back()->with('error', $service->getErrors() ?? __('alerts.campaigns.error.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campaign $campaign)
    {
        if ($request->user()->cannot('view', $campaign)) {
            unauthorized();
        }

        $campaign->delete();
        CampaignViewed::dispatch($campaign);
        $this->logShow($campaign);
        $header = $campaign->name . ' [' . $campaign->period . ']';

        return view('pages.mbo.campaigns.show', [
            'campaign' => $campaign,
            'pagetitle' => $header,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Campaign $campaign)
    {
        if ($request->user()->cannot('mbo-campaign-update', $campaign)) {
            unauthorized();
        }

        return view('pages.mbo.campaigns.edit', [
            'campaign' => $campaign,
            'form' => CampaignEditForm::definition($request, $campaign),
        ]);
    }

    public function update(Request $request, $id, CampaignEditForm $form)
    {
        $campaign = Campaign::findOrFail($id);
        if ($request->user()->cannot('mbo-campaign-update', $campaign)) {
            unauthorized();
        }

        $request = $form::reformatRequest($request);
        $form::validate($request, $id);
        $service = CreateOrUpdate::boot(request: $request, campaign: $campaign)->execute();

        if ($service->passed()) {
            $campaign = $service->getResult();

            return redirect()->route('campaigns.show', $id)->with('success', __('alerts.campaigns.success.edit', ['name' => $campaign->name]));
        }

        return redirect()->back()->with('error', __('alerts.campaigns.error.edit', ['name' => $campaign->name]));
    }
}
