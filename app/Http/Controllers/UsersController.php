<?php

namespace App\Http\Controllers;

use App\DataTables\Users\UsersDataTable;
use App\Forms\Users\UserEditForm;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends AppController
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
    public function create(Request $request)
    {
        return view('pages.users.edit', [
            'form' => UserEditForm::definition($request),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserEditForm $form)
    {
        $request->validate($form::validation($request));
        $user = User::fillFromRequest($request);
        $user->generatePassword();
        $supervisors_ids = $request->input('supervisors_ids') ?? [];
        $roles_ids = $request->input('roles_ids') ?? [];

        if ($user->save()) {
            $profile = UserProfile::fillFromRequest($request);
            $profile->user_id = $user->id;

            if ($profile->save() && $user->refreshSupervisors($supervisors_ids) && $user->refreshRole($roles_ids)) {
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
        $user = User::findOrFail($id);

        return view('pages.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $model = User::findOrFail($id);

        return view('pages.users.edit', [
            'user' => $model,
            'form' => UserEditForm::definition($request, $model),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UserEditForm $form)
    {
        $request->validate($form::validation($request));
        $user = User::fillFromRequest($request, $id);
        $supervisors_ids = $request->input('supervisors_ids') ?? [];
        $roles_ids = $request->input('roles_ids') ?? [];

        if ($user->update()) {
            $profile_id = $user->profile->id;
            $profile = UserProfile::fillFromRequest($request, $profile_id);
            if ($profile) {
                if ($profile->update() && $user->refreshSupervisors($supervisors_ids) && $user->refreshRole($roles_ids)) {
                    return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.edit', ['name' => $user->name]));
                }
            }
        }

        return redirect()->back()->with('error', __('alerts.users.error.edit', ['name' => $user->name]));
    }

    /**
     * Delete User instance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', ['name' => $user->name]));
        }

        return redirect()->back()->with('error', __('alerts.users.error.delete', ['name' => $user->name]));
    }

    /**
     * Toggles User blocking if was nat blocked and unlocking otherwise.
     *
     * @param  mixed  $id
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->toggleLock();
        }
        if ($user->blocked()) {
            return redirect()->back()->with('info', __('alerts.users.success.blocked', ['name' => $user->name]));
        }

        return redirect()->back()->with('info', __('alerts.users.success.unblocked', ['name' => $user->name]));
    }

    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);

        return redirect()->back();
    }

    public function impersonateLeave()
    {
        Auth::user()->leaveImpersonation();

        return redirect()->back();
    }
}
