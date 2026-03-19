<?php

namespace App\Http\Controllers;

use App\DataTables\Settings\MyLogsDataTable;
use App\Forms\Users\ProfileEditForm;
use App\Forms\Users\ProfilePreferencesForm;
use App\Models\Core\UserPreference;
use App\Models\Core\UserProfile;
use App\Support\UI\Page\Navigation\Contracts\HasPageNavigation;
use App\Support\UI\Page\Navigation\MenuItem;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends AppController
{
    use HasPageNavigation;

    public function index(Request $request, ProfileEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.profile.index', [
            'form' => $form->setModel($request->user())->getDefinition(),
        ]);
    }

    public function update(Request $request, ProfileEditForm $form): RedirectResponse
    {
        $user = $request->user();

        $form->validate();

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');

        $profile = $user->profile ?? new UserProfile();
        $profile->user_id = $user->id;
        $profile->birthday = $request->input('birthday');

        $avatar = $request->file('avatar');

        if ($avatar) {
            $filename = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $location = Storage::disk('uploads')->putFileAs('avatars', $avatar, $filename);

            if ($location) {
                $profile->avatar = 'uploads/' . $location;
            }
        }

        if ($user->save() && $profile->save()) {
            return redirect()->route('profile.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->route('profile.index')->with('error', __('alerts.error.operation'));
    }

    public function preferences(Request $request, ProfilePreferencesForm $form): View
    {
        $this->addPageNav();
        $this->setPagetitle(__('menus.preferences'));

        return view('pages.profile.preferences', [
            'form' => $form->setModel($request->user())->getDefinition(),
        ]);
    }

    public function updatePreferences(Request $request, ProfilePreferencesForm $form): RedirectResponse
    {
        $form->validate();

        $user = $request->user();
        $preferences = UserPreference::query()->withTrashed()->firstOrNew([
            'user_id' => $user->id,
        ]);

        if ($preferences->exists && $preferences->trashed()) {
            $preferences->restore();
        }

        $preferences->lang = $request->input('lang', 'auto');
        $preferences->theme = $request->input('theme', 'auto');
        $preferences->mail_notifications = $request->boolean('mail_notifications');
        $preferences->app_notifications = $request->boolean('app_notifications');
        $preferences->extended_notifications = $request->boolean('extended_notifications');
        $preferences->system_notifications = $request->boolean('system_notifications');

        if ($preferences->save()) {
            return redirect()->route('preferences.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->route('preferences.index')->with('error', __('alerts.error.operation'));
    }

    public function myLogs(MyLogsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();
        $this->setPagetitle(__('menus.activity'));

        return $dataTable->render('pages.profile.my_logs', [
            'table' => $dataTable,
        ]);
    }

    public function addPageNav(): void
    {
        $this->setPageNav('profile', [
            MenuItem::make('edit')
                ->setTitle(__('menus.profile.edit'))
                ->setRoute('profile.index'),
            MenuItem::make('preferences')
                ->setTitle(__('menus.preferences'))
                ->setRoute('preferences.index'),
            MenuItem::make('activity')
                ->setTitle(__('menus.profile.logs'))
                ->setRoute('activity.index'),
        ]);
    }
}
