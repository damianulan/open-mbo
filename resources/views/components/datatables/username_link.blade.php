<a class="user-details" href="{{ route('users.show', $data->id) }}">
    {!! $data->getAvatarView('xs') !!}
    <span class="ms-2">{{ $data->name }}</span>
</a>
