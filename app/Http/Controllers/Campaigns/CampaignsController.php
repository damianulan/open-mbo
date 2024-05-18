<?php

namespace App\Http\Controllers\Campaigns;

use Illuminate\Http\Request;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Enums\CampaignStage;
use App\Forms\MBO\Campaign\CampaignEditForm;
use App\Http\Controllers\Controller;

class CampaignsController extends Controller
{
    public function index()
    {
        return view('pages.campaigns.index', [
            'campaigns' => Campaign::all(),
        ]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.campaigns.edit', [
            'form' => CampaignEditForm::boot(),
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
        $request = $form::reformatRequest($request);
        $request->validate($form::validation());
        $campaign = Campaign::fillFromRequest($request);

        if($campaign->save()){
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
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('pages.campaigns.show', [
            'campaign' => $campaign,
            'pagetitle' => $campaign->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Campaign::findOrFail($id);
        return view('pages.campaigns.edit', [
            'campaign' => $model,
            'form' => CampaignEditForm::boot($model),
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
        $request->validate($form::validation($id));
        $campaign = Campaign::fillFromRequest($request, $id);

        if($campaign->update()){
            return redirect()->route('campaigns.show', $id)->with('success', __('alerts.campaigns.success.edit', ['name' => $campaign->name]));
        }
        return redirect()->back()->with('error', __('alerts.campaigns.error.edit', ['name' => $campaign->name]));
    }

}
