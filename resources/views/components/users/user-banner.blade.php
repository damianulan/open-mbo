<a class="user-banner" href="{{ route('users.show', $user->id) }}">
    <div class="profile-picture">
        <img src="{{ $user->getAvatar() }}" height="75px" width="100%">
    </div>
    <div class="mx-2">
        <div class="fw-bold fs-5">{{ $user->name() }}</div>
        <div class="">{{ $user->email }}</div>
    </div>

</a>
