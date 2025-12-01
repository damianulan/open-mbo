<?php

namespace App\Http\Controllers;

use App\DataTables\Users\UsersDataTable;
use App\Forms\Users\EmploymentEditForm;
use App\Forms\Users\UserEditForm;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use App\Services\Employments\CreateOrUpdate as EmploymentCreateOrUpdate;
use App\Services\Users\CreateOrUpdate as UserCreateOrUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index', array(
            'table' => $dataTable,
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pages.users.edit', array(
            'form' => UserEditForm::definition($request),
            'employments' => array(),
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        $service = UserCreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            $user = $service->user;

            return redirect()->route('users.show', $user->id)->with('success', __('alerts.users.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.users.error.create'));
    }

    public function storeEmployment(Request $request, EmploymentEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        $service = EmploymentCreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            return redirect()->back()->with('success', __('alerts.employments.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.users.show', array(
            'user' => $user,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Request $request, $id)
    {
        $model = User::findOrFail($id);

        $request->request->add(array('user_id' => $id));

        return view('pages.users.edit', array(
            'user' => $model,
            'employments' => $this->getEmploymentFroms($request, $model),
            'form' => UserEditForm::definition($request, $model),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     */
    public function update(Request $request, $id, UserEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        $user = User::findOrFail($id);
        $service = UserCreateOrUpdate::boot(request: $request, user: $user)->execute();

        if ($service->passed()) {
            $user = $service->user;

            return redirect()->route('users.show', $id)->with('success', __('alerts.users.success.edit', array('name' => $user->name)));
        }

        return redirect()->back()->with('error', __('alerts.users.error.edit', array('name' => $user->name)));
    }

    public function updateEmployment(Request $request, $id, EmploymentEditForm $form)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        $employment = UserEmployment::findOrFail($id);
        $service = EmploymentCreateOrUpdate::boot(request: $request, employment: $employment)->execute();

        if ($service->passed()) {
            return redirect()->back()->with('success', __('alerts.employments.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.edit'));
    }

    /**
     * Delete User instance.
     *
     * @param  int  $id
     */
    public function delete(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', array('name' => $user->name)));
        }

        return redirect()->back()->with('error', __('alerts.users.error.delete', array('name' => $user->name)));
    }

    public function deleteEmployment($id)
    {
        $employment = UserEmployment::findOrFail($id);

        if ($employment->delete()) {
            return redirect()->back()->with('success', __('alerts.employments.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.delete'));
    }

    /**
     * Toggles User blocking if was nat blocked and unlocking otherwise.
     */
    public function block(User $user)
    {
        if ($user) {
            $user->toggleLock();
        }
        if ($user->blocked()) {
            return redirect()->back()->with('info', __('alerts.users.success.blocked', array('name' => $user->name)));
        }

        return redirect()->back()->with('info', __('alerts.users.success.unblocked', array('name' => $user->name)));
    }

    public function favourite(User $user)
    {
        $auth = Auth::user();
        if ($auth->favourite_users->contains($user)) {
            $auth->favourite_users()->detach($user->id);
        } else {
            $auth->favourite_users()->attach($user->id);
        }

        return redirect()->back();
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

    private function getEmploymentFroms(Request $request, ?User $model = null): array
    {
        $employments[__('forms.employments.add')] = EmploymentEditForm::definition($request);

        if ($model) {
            $i = 0;
            foreach ($model->employments as $employment) {
                $i++;
                $langKey = 'forms.employments.header';
                if ($employment->main) {
                    $langKey = 'forms.employments.header_main';
                }
                $employments[__($langKey, array('no' => $i))] = EmploymentEditForm::definition($request, $employment);
            }
        }

        return $employments;
    }
}
