<?php

namespace App\Services\Objectives;

use Lucent\Services\Service;
use App\Models\MBO\Objective;
use App\Models\MBO\UserObjective;
use App\Enums\MBO\UserObjectiveStatus;

class BulkAssignUsers extends Service
{
    /**
     * Handle the service main logic.
     *
     * @return mixed
     */
    protected function handle(): Objective
    {
        $current = UserObjective::where('objective_id', $this->objective->id)->get();
        $current_ids = $current->pluck('user_id')->flip();

        if ($this->request()->input('user_ids')) {
            foreach ($this->request()->input('user_ids') as $user_id) {
                if (!$current_ids->has($user_id)) {
                    $this->assignUser($user_id);
                } else {
                    $current_ids->forget($user_id);
                }
            }

            foreach ($current_ids as $user_id => $key) {
                $this->unassignUser($user_id);
            }
        }

        return $this->objective;
    }

    public function assignUser($user_id): bool
    {
        $exists = $this->objective->user_assignments()->where('user_id', $user_id)->exists();
        $result = false;
        if (!$exists) {
            $result = $this->objective->user_assignments()->create([
                'user_id' => $user_id,
                'status' => UserObjectiveStatus::PROGRESS,
            ]);
        }

        return $result ? true : false;
    }

    public function unassignUser($user_id): bool
    {
        $result = false;
        $record = $this->objective->user_assignments()->where('user_id', $user_id)->first();
        if ($record) {
            $result = $record->delete();
        }

        return $result ? true : false;
    }
}
