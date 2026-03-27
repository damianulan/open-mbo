<?php

namespace App\Forms\Settings;

use App\Providers\NotificationServiceProvider;
use App\Support\Notifications\Models\Notification;
use Closure;
use FormForge\Base\Form;
use FormForge\Base\FormComponent;
use FormForge\Components\Dictionary;
use FormForge\FormBuilder;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use JsonException;

class NotificationEditForm extends Form
{
    public function definition(FormBuilder $builder): FormBuilder
    {
        $route = route('settings.notifications.store');
        $method = 'POST';

        if (null !== $this->model) {
            $method = 'PUT';
            $route = route('settings.notifications.update', $this->model->id);
        }

        return $builder->setId(null === $this->model ? 'notification_create' : 'notification_edit')
            ->setMethod($method)
            ->setAction($route)
            ->class('notifications-edit-form')
            ->add(FormComponent::text('key', $this->model)->label(__('notifications.table.key'))->required())
            ->add(FormComponent::switch('system', $this->model)->label(__('notifications.table.system')))
            ->add(FormComponent::switch('email', $this->model)->label(__('notifications.table.email')))
            ->add(FormComponent::select('event', $this->model, Dictionary::fromAssocArray($this->eventOptions()->all()))
                ->label(__('notifications.table.event')))
            ->add(FormComponent::text('schedule', $this->model)->label(__('notifications.table.schedule')))
            ->add(FormComponent::textarea('conditions', $this->conditionsValue())
                ->label(__('notifications.table.conditions')))
            ->add(FormComponent::text('subject', $this->subjectValue())
                ->label(__('notifications.form.subject'))
                ->required(fn (): bool => (bool) $this->email))
            ->add(FormComponent::container('system_contents', $this->systemContentsValue())
                ->label(__('notifications.form.system_contents'))
                ->class('quill-default')
                ->purifyValue()
                ->required(fn (): bool => (bool) $this->system))
            ->add(FormComponent::container('email_contents', $this->emailContentsValue())
                ->label(__('notifications.form.email_contents'))
                ->class('quill-default')
                ->purifyValue()
                ->required(fn (): bool => (bool) $this->email))
            ->addSubmit();
    }

    public function validation(): array
    {
        $rules = [
            'key' => [
                'required',
                'string',
                'max:255',
                Rule::unique('notifications', 'key')->ignore($this->model?->id),
            ],
            'system' => ['boolean'],
            'email' => ['boolean'],
            'event' => [
                'nullable',
                'string',
                'max:255',
                Rule::in($this->eventOptions()->keys()->all()),
            ],
            'schedule' => ['nullable', 'string', 'max:255'],
            'conditions' => [
                'nullable',
                'json',
                function (string $attribute, mixed $value, Closure $fail): void {
                    if (blank($value)) {
                        return;
                    }

                    try {
                        $decoded = json_decode((string) $value, true, 512, JSON_THROW_ON_ERROR);
                    } catch (JsonException) {
                        $fail('The conditions field must be a valid JSON object or array.');

                        return;
                    }

                    if ( ! is_array($decoded)) {
                        $fail('The conditions field must be a valid JSON object or array.');
                    }
                },
            ],
            'subject' => ['nullable', 'string', 'max:255'],
            'system_contents' => ['nullable', 'string'],
            'email_contents' => ['nullable', 'string'],
        ];

        if ($this->email) {
            array_unshift($rules['subject'], 'required');
            array_unshift($rules['email_contents'], 'required');
        }

        if ($this->system) {
            array_unshift($rules['system_contents'], 'required');
        }

        return $rules;
    }

    protected function eventOptions(): Collection
    {
        return collect(NotificationServiceProvider::getNotifiableEventClasses())
            ->mapWithKeys(static fn (string $eventClass): array => [$eventClass => $eventClass::description()])
            ->sort();
    }

    protected function conditionsValue(): ?string
    {
        if ( ! ($this->model instanceof Notification) || empty($this->model->conditions)) {
            return null;
        }

        return json_encode($this->model->conditions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    protected function subjectValue(): ?string
    {
        return $this->model?->contents?->subject;
    }

    protected function systemContentsValue(): ?string
    {
        return $this->model?->contents?->system_contents;
    }

    protected function emailContentsValue(): ?string
    {
        return $this->model?->contents?->email_contents;
    }
}
