<div class="user-details{{ $data->blocked() ? ' inactive':'' }}">
    {!! $data->getAvatarView('xs') !!}
    <span class="{{ auth()->user()->id === $data->id ? ' text-highlight':'' }}">{{ $data->name }}</span>
</div>
