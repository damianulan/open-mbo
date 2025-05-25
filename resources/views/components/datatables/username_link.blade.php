<a class="user-details" href="{{ route('users.show', $data->id) }}">
    {!! $data->getAvatarView(30) !!}
    <span class="ms-2">{{ $data->name() }}</span>
</a>
