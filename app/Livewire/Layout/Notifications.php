<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class Notifications extends Component
{

    public Collection $notifications;
    public int $notifications_count = 0;
    public bool $shown = false;

    public function mount() {}

    public function toggleShown()
    {
        $this->shown = !$this->shown;
    }

    public function render()
    {
        $notifications = Auth::user()->notifications()->where('data', '!=', '[]');
        $notifications_count = $notifications->count();
        $notifications_tmp = $notifications->take(15)->get();
        $collection = new Collection();

        if ($notifications_count) {
            foreach ($notifications_tmp as $notification) {
                $collection->put($notification->id, $notification);
            }
        }

        if ($this->notifications_count) {
            if ($this->notifications_count != $notifications_count) {
                foreach ($collection->keys()->all() as $key) {
                    if (!$this->notifications->keyBy($key)) {
                        $n = $collection->keyBy($key);
                        $this->dispatch("new-notification", title: $n->data['message']);
                    }
                }
            }
        }

        $this->notifications_count = $notifications_count;
        $this->notifications = $collection;

        return view('livewire.layout.notifications');
    }
}
