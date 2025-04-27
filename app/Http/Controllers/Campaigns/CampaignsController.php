<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Enums\MBO\CampaignStage;
use App\Forms\MBO\Campaign\CampaignEditForm;
use App\Http\Controllers\Controller;
use App\Models\Core\User;

class CampaignsController extends Controller
{
    public function index()
    {
        return view('pages.mbo.campaigns.index', [
            'campaigns' => Campaign::paginate(30),
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
            abort(403);
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
            abort(403);
        }
        $request = $form::reformatRequest($request);
        $request->validate($form::validation($request));
        $campaign = Campaign::fillFromRequest($request);
        $user_ids = $request->input('user_ids');

        if ($campaign->save()) {
            $campaign->refreshCoordinators($user_ids);
            return redirect()->route('campaigns.show', $campaign->id)->with('success', __('alerts.campaigns.success.create', ['name' => $campaign->name]));
        }
        return redirect()->back()->with('error', __('alerts.campaigns.error.create', ['name' => $campaign->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campaign $campaign)
    {
        if ($request->user()->cannot('mbo-campaign-view', $campaign)) {
            abort(403);
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
            abort(403);
        }
        return view('pages.mbo.campaigns.edit', [
            'campaign' => $campaign,
            'form' => CampaignEditForm::definition($request, $campaign),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, CampaignEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $request->validate($form::validation($request, $id));
        $campaign = Campaign::fillFromRequest($request, $id);
        if ($request->user()->cannot('mbo-campaign-update', $campaign)) {
            abort(403);
        }
        $user_ids = $request->input('user_ids');

        if ($campaign->update()) {
            $campaign->refreshCoordinators($user_ids);
            return redirect()->route('campaigns.show', $id)->with('success', __('alerts.campaigns.success.edit', ['name' => $campaign->name]));
        }
        return redirect()->back()->with('error', __('alerts.campaigns.error.edit', ['name' => $campaign->name]));
    }
}
