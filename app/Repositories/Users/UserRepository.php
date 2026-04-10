<?php

namespace App\Repositories\Users;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\Business\Position;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryContract
{
    public function queryForDataTable(int|string|null $excludedUserId = null): Builder
    {
        $query = User::query()
            ->with([
                'employment.position',
                'roles',
            ])
            ->addSelect([
                'position' => $this->positionNameSubquery(),
            ]);

        if ($excludedUserId) {
            $query->whereNotIn('users.id', [$excludedUserId]);
        }

        return $query;
    }

    public function loadForShow(User $user): User
    {
        $user->loadMissing([
            'profile',
            'roles',
            'employment.company',
            'employment.department',
            'employment.position',
            'employment.contract',
        ]);

        return $user;
    }

    public function loadForEdit(User $user): User
    {
        $user->loadMissing([
            'profile',
            'roles',
            'supervisors',
            'employments.company',
            'employments.department',
            'employments.position',
            'employments.contract',
        ]);

        return $user;
    }

    public function loadForBanner(User $user): User
    {
        $user->loadMissing([
            'profile',
            'roles',
        ]);

        return $user;
    }

    public function emailExistsForAnotherUser(string $email, int|string|null $ignoredUserId = null): bool
    {
        return User::query()
            ->where('email', $email)
            ->when($ignoredUserId, fn (Builder $query) => $query->where('id', '!=', $ignoredUserId))
            ->exists();
    }

    private function positionNameSubquery(): Builder
    {
        return Position::query()
            ->select('name')
            ->where('positions.id', '=', UserEmployment::query()
                ->select('position_id')
                ->whereColumn('user_employments.user_id', 'users.id')
                ->active()
                ->limit(1))
            ->limit(1);
    }
}
