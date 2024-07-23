<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use App\DataTables\Users\UsersDataTable;
use App\Forms\Users\UserEditForm;
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
            'table' => $dataTable,
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
        $user->generatePassword();
        $supervisors_ids = $request->input('supervisors_ids') ?? array();
        $roles_ids = $request->input('roles_ids') ?? array();

        if($user->save()){
            $profile = UserProfile::fillFromRequest($request);
            $profile->user_id = $user->id;

            if($profile->save() && $user->syncSupervisors($supervisors_ids) && $user->refreshRole($roles_ids)){
                return redirect()->route('users.show', $user->id)->with('success', __('alerts.users.success.create'));
            }
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
        $roles_ids = $request->input('roles_ids') ?? array();

        if($user->update()){
            $profile_id = $user->profile->id;
            $profile = UserProfile::fillFromRequest($request, $profile_id);
            if($profile){
                if($profile->update() && $user->syncSupervisors($supervisors_ids) && $user->refreshRole($roles_ids)){
                    return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.edit', ['name' => $user->name()]));
                }
            }
        }
        return redirect()->back()->with('error', __('alerts.users.error.edit', ['name' => $user->name()]));
    }

    /**
     * Delete User instance.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        if($user->delete()){
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', ['name' => $user->name()]));
        }
        return redirect()->back()->with('error', __('alerts.users.error.delete', ['name' => $user->name()]));
    }

    /**
     * Toggles User blocking if was nat blocked and unlocking otherwise.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $user = User::findOrFail($id);
        if($user){
            $user->toggleLock();
        }
        if($user->blocked()){
            return redirect()->back()->with('info', __('alerts.users.success.blocked', ['name' => $user->name()]));
        }
        return redirect()->back()->with('info', __('alerts.users.success.unblocked', ['name' => $user->name()]));
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
