<?php

namespace App\Http\Controllers;

use App\DataTables\Users\UsersDataTable;
use App\Exceptions\Core\UnauthorizedAccess;
use App\Forms\Users\EmploymentEditForm;
use App\Forms\Users\UserEditForm;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use App\Services\Employments\CreateOrUpdate as EmploymentCreateOrUpdate;
use App\Services\Users\CreateOrUpdate as UserCreateOrUpdate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, UsersDataTable $dataTable): Renderable|JsonResponse
    {
        if ($request->user()->cannot('viewList', User::class)) {
            unauthorized();
        }

        return $dataTable->render('pages.users.index', [
            'table' => $dataTable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, UserEditForm $form): View
    {
        if ($request->user()->cannot('create', User::class)) {
            unauthorized();
        }

        return view('pages.users.edit', [
            'form' => $form->getDefinition(),
            'employments' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserEditForm $form): RedirectResponse
    {
        $form->validate();
        $service = UserCreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            $user = $service->user;

            return redirect()->route('users.show', $user->id)->with('success', __('alerts.users.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.users.error.create'));
    }

    public function storeEmployment(Request $request, EmploymentEditForm $form): RedirectResponse
    {
        $form->validate();
        $service = EmploymentCreateOrUpdate::boot(request: $request)->execute();

        if ($service->passed()) {
            return redirect()->back()->with('success', __('alerts.employments.success.create'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user): View
    {
        $view = $request->user()->can('view', $user);
        $preview = $request->user()->can('preview', $user) && ! $view;

        if ( ! $view && ! $preview) {
            unauthorized();
        }

        return view('pages.users.show', [
            'user' => $user,
            'isPreview' => $preview,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user): View
    {
        if ($request->user()->cannot('update', $user)) {
            unauthorized();
        }

        $request->request->add(['user_id' => $user->getKey()]);

        return view('pages.users.edit', [
            'user' => $user,
            'employments' => $this->getEmploymentForms($request, $user),
            'form' => UserEditForm::bootWithModel($user)->getDefinition(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, UserEditForm $form): RedirectResponse
    {
        if ($request->user()->cannot('update', $user)) {
            unauthorized();
        }

        $form->validate();
        $service = UserCreateOrUpdate::boot(request: $request, user: $user)->execute();

        if ($service->passed()) {
            $user = $service->user;

            return redirect()->route('users.show', $user)->with('success', __('alerts.users.success.edit', ['name' => $user->name]));
        }

        return redirect()->back()->with('error', __('alerts.users.error.edit', ['name' => $user->name]));
    }

    public function updateEmployment(Request $request, int|string $id, EmploymentEditForm $form): RedirectResponse
    {
        $employment = UserEmployment::findOrFail($id);

        if ($request->user()->cannot('employment', $employment->user)) {
            unauthorized();
        }

        $form->validate();
        $service = EmploymentCreateOrUpdate::boot(request: $request, employment: $employment)->execute();

        if ($service->passed()) {
            return redirect()->back()->with('success', __('alerts.employments.success.edit'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.edit'));
    }

    /**
     * Delete User instance.
     */
    public function delete(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->cannot('delete', $user)) {
            unauthorized();
        }

        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', __('alerts.users.success.delete', ['name' => $user->name]));
        }

        return redirect()->back()->with('error', __('alerts.users.error.delete', ['name' => $user->name]));
    }

    public function deleteEmployment(Request $request, int|string $id): RedirectResponse
    {
        $employment = UserEmployment::findOrFail($id);

        if ($request->user()->cannot('employment', $employment->user)) {
            unauthorized();
        }

        if ($employment->delete()) {
            return redirect()->back()->with('success', __('alerts.employments.success.delete'));
        }

        return redirect()->back()->with('error', __('alerts.employments.error.delete'));
    }

    /**
     * Toggles User blocking if was nat blocked and unlocking otherwise.
     */
    public function block(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->cannot('delete', $user)) {
            unauthorized();
        }

        $user->toggleLock();

        if ($user->blocked()) {
            return redirect()->back()->with('info', __('alerts.users.success.blocked', ['name' => $user->name]));
        }

        return redirect()->back()->with('info', __('alerts.users.success.unblocked', ['name' => $user->name]));
    }

    public function favourite(Request $request, User $user): RedirectResponse
    {
        $authUser = $request->user();

        if ($authUser->favourite_users->contains($user)) {
            $authUser->favourite_users()->detach($user->id);
        } else {
            $authUser->favourite_users()->attach($user->id);
        }

        return redirect()->back();
    }

    public function impersonate(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->cannot('impersonate', $user)) {
            unauthorized();
        }

        $request->user()->impersonate($user);

        return redirect()->back();
    }

    public function impersonateLeave(Request $request): RedirectResponse
    {
        $request->user()->leaveImpersonation();

        return redirect()->back();
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->cannot('reset', $user)) {
            unauthorized();
        }

        try {
            $password = $user->getNewPassword();
            $user->generatePassword($password);
            $user->force_password_change = 1;

            if ($user->save()) {
                return redirect()->back()->with('success_alert', $password);
            }

            return redirect()->back()->with('success', __('alerts.users.success.reset_password'));
        } catch (UnauthorizedAccess $th) {
            report($th);

            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('error', __('alerts.users.error.reset_password'));
    }

    private function getEmploymentForms(Request $request, ?User $model = null): array
    {
        $employments = [];

        if ($request->user()->can('employments', $model)) {
            $employments[__('forms.employments.add')] = EmploymentEditForm::bootWithAttributes($request->all())->getDefinition();

            if ($model) {
                $i = 0;

                foreach ($model->employments as $employment) {
                    $i++;
                    $langKey = 'forms.employments.header';

                    if ($employment->main) {
                        $langKey = 'forms.employments.header_main';
                    }

                    $employments[__($langKey, ['no' => $i])] = EmploymentEditForm::bootWithModel($employment)->getDefinition();
                }
            }
        }

        return $employments;
    }
}
