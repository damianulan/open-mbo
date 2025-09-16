<a class="user-banner" href="{{ route('users.show', $user->id) }}">
    <div class="profile-picture">
        {!! $user->getAvatarView() !!}
    </div>
    <div class="mx-2">
        <div class="fw-bold fs-5">{{ $user->name }}</div>
        <div class="">{{ $user->email }}</div>
        <div class="text-muted">{{ $user->getRolesNames()->implode(' | ') }}</div>
    </div>
</a>
