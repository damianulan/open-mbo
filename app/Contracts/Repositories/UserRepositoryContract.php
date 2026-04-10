<?php

namespace App\Contracts\Repositories;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;

interface UserRepositoryContract
{
    public function queryForDataTable(int|string|null $excludedUserId = null): Builder;

    public function loadForShow(User $user): User;

    public function loadForEdit(User $user): User;

    public function loadForBanner(User $user): User;

    public function emailExistsForAnotherUser(string $email, int|string|null $ignoredUserId = null): bool;
}
