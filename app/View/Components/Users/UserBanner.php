<?php

namespace App\View\Components\Users;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\Core\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserBanner extends Component
{
    public function __construct(public User $user, UserRepositoryContract $userRepository)
    {
        $this->user = $userRepository->loadForBanner($this->user);
    }

    public function render(): View|Closure|string
    {
        return view('components.users.user-banner');
    }
}
