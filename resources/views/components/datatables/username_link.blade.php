<a class="user-details" href="{{ route('users.show', $data->id) }}">
    <img src="{{ $data->getAvatar() }}">
    <span>{{ $data->name() }}</span>
</a>
