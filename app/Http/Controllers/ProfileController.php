<?php

namespace App\Http\Controllers;

use App\Forms\Users\ProfileEditForm;
use App\Forms\Users\ProfilePreferencesForm;
use App\Models\Core\UserPreference;
use App\Models\Core\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request, ProfileEditForm $form)
    {
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

    public function preferences(Request $request, ProfilePreferencesForm $form)
    {
        return view('pages.profile.preferences', [
            'form' => $form->setModel($request->user())->getDefinition(),
        ]);
    }

    public function updatePreferences(Request $request, ProfilePreferencesForm $form): RedirectResponse
    {
        $form->validate();
        $user = $request->user();
        $preferences = UserPreference::query()
            ->withTrashed()
            ->where('user_id', $user->id)
            ->latest('id')
            ->first();

        if (is_null($preferences)) {
            $preferences = new UserPreference();
            $preferences->user_id = $user->id;
        }

        if ($preferences->trashed()) {
            $preferences->restore();
        }

        $preferences->lang = $request->input('lang', 'auto');
        $preferences->theme = $request->input('theme', 'auto');
        $preferences->mail_notifications = $request->boolean('mail_notifications');
        $preferences->app_notifications = $request->boolean('app_notifications');
        $preferences->extended_notifications = $request->boolean('extended_notifications');
        $preferences->system_notifications = $request->boolean('system_notifications');

        if ($preferences->save()) {
            return redirect()->route('profile.preferences')->with('success', __('alerts.success.operation'));
        }

        return redirect()->route('profile.preferences')->with('error', __('alerts.error.operation'));
    }
}
