<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\DataTables\UsersDataTable;
use App\Forms\Users\UserEditForm;
use App\Facades\Logger\Activity;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index', [

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.edit', [
            'form' => UserEditForm::boot()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserEditForm $form)
    {
        $request->validate($form::validation());
        $user = User::fillFromRequest($request);
        // TODO add roles also
        $supervisors_ids = $request->input('supervisors_ids') ?? array();

        if($user->save()){
            if(!$user->syncSupervisors($supervisors_ids)){

            }
            return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.create'));
        }
        return redirect()->back()->with('error', __('alerts.users.error.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.users.show', [
            'user' => User::findOrFail($id),
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
        $model = User::findOrFail($id);
        return view('pages.users.edit', [
            'user' => $model,
            'form' => UserEditForm::boot($model)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UserEditForm $form)
    {
        $request->validate($form::validation());
        $user = User::fillFromRequest($request, $id);
        $supervisors_ids = $request->input('supervisors_ids') ?? array();

        if($user->update()){
            if(!$user->syncSupervisors($supervisors_ids)){

            }
            return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.edit', ['name' => $user->name()]));
        }
        return redirect()->back()->with('error', __('alerts.users.error.edit', ['name' => $user->name()]));
    }

    public function delete($id)
    {
        //
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        if($user){
            $user->block();
        }
        if($user->blocked()){
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function impersonate(User $user)
    {
        auth()->user()->impersonate($user);

        return redirect()->back();
    }

    public function impersonateLeave()
    {
        auth()->user()->leaveImpersonation();

        return redirect()->back();
    }

}
