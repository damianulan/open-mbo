<a class="user-details{{ $data->blocked() ? ' inactive':'' }}" href="{{ route('users.show', ['user' => $data->uuid]) }}">
    {!! $data->getAvatarView('xs') !!}
    <span class="{{ auth()->user()->id === $data->id ? 'text-highlight':'' }}">{{ $data->name }}</span>
</a>
