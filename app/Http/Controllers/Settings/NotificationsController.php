<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\NotificationsDataTable;
use App\Forms\Settings\NotificationEditForm;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\NotificationContents;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use JsonException;

class NotificationsController extends SettingsController
{
    public function index(NotificationsDataTable $dataTable): Renderable|JsonResponse
    {
        $this->addPageNav();

        return $dataTable->render('pages.settings.notifications.index', [
            'table' => $dataTable,
        ]);
    }

    public function create(NotificationEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.notifications.edit', [
            'form' => $form->getDefinition(),
        ]);
    }

    public function store(Request $request, NotificationEditForm $form): RedirectResponse
    {
        $form->validate();

        $notification = $this->fillNotification(new Notification, $request);

        if ($notification->save()) {
            return redirect()->route('settings.notifications.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function edit(Notification $notification, NotificationEditForm $form): View
    {
        $this->addPageNav();

        return view('pages.settings.notifications.edit', [
            'notification' => $notification,
            'form' => $form->setModel($notification)->getDefinition(),
        ]);
    }

    public function update(Request $request, Notification $notification, NotificationEditForm $form): RedirectResponse
    {
        $form->setModel($notification)->validate();
        $notification = $this->fillNotification($notification, $request);

        if ($notification->save()) {
            return redirect()->route('settings.notifications.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    public function delete(Notification $notification): RedirectResponse
    {
        if ($notification->delete()) {
            return redirect()->route('settings.notifications.index')->with('success', __('alerts.success.operation'));
        }

        return redirect()->back()->with('error', __('alerts.error.operation'));
    }

    /**
     * @throws JsonException
     */
    protected function fillNotification(Notification $notification, Request $request): Notification
    {
        $notification->fill([
            'key' => Str::upper((string) $request->string('key')),
            'system' => $request->boolean('system'),
            'email' => $request->boolean('email'),
            'event' => $this->nullableString($request->input('event')),
            'schedule' => $this->nullableString($request->input('schedule')),
            'conditions' => $this->decodeConditions($request->input('conditions')),
        ]);

        $notification->contents = NotificationContents::boot(
            $this->nullableString($request->input('system_contents')),
            $this->nullableString($request->input('email_contents')),
            $this->nullableString($request->input('subject')),
        );

        return $notification;
    }

    protected function nullableString(mixed $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        return mb_trim((string) $value);
    }

    /**
     * @throws JsonException
     */
    protected function decodeConditions(mixed $conditions): ?array
    {
        if (blank($conditions)) {
            return null;
        }

        $decoded = json_decode((string) $conditions, true, 512, JSON_THROW_ON_ERROR);

        return is_array($decoded) ? $decoded : null;
    }
}
