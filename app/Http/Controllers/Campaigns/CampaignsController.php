<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Forms\MBO\Campaign\CampaignEditForm;
use App\Http\Controllers\Controller;
use App\Services\Campaigns\CampaignService;
use App\Models\Core\User;

class CampaignsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Campaign::class)) {
            unauthorized();
        }
        return view('pages.mbo.campaigns.index', [
            'campaigns' => Campaign::checkAccess()->paginate(30),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CampaignEditForm $form)
    {
        if ($request->user()->cannot('create', Campaign::class)) {
            unauthorized();
        }
        $request = $form::reformatRequest($request);
        $request->validate($form::validation($request));
        $service = CampaignService::boot($request)->createOrUpdate();

        if ($service->check()) {
            $campaign = $service->getModel();
            return redirect()->route('campaigns.show', $campaign->id)->with('success', __('alerts.campaigns.success.create', ['name' => $campaign->name]));
        }
        return redirect()->back()->with('error', __('alerts.campaigns.error.create'));
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
        $request->validate($form::validation($request, $id));
        $service = CampaignService::boot($request, $campaign)->createOrUpdate();

        if ($service->check()) {
            $campaign = $service->getModel();
            return redirect()->route('campaigns.show', $id)->with('success', __('alerts.campaigns.success.edit', ['name' => $campaign->name]));
        }
        return redirect()->back()->with('error', __('alerts.campaigns.error.edit', ['name' => $campaign->name]));
    }

    public function terminate(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        // dd(vars: $campaign->terminate());
        if ($campaign->terminate()) {
            return ajax()->ok(__('alerts.campaigns.success.terminate'));
        }
        return ajax()->error(('alerts.campaigns.error.terminate'));
    }
}
