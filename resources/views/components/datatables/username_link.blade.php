<a class="user-details{{ $data->blocked() ? ' inactive':'' }}" href="{{ route('users.show', $data->id) }}">
    {!! $data->getAvatarView('xs') !!}
    <span class="{{ auth()->user()->id === $data->id ? 'text-highlight':'' }}">{{ $data->name }}</span>
</a>
