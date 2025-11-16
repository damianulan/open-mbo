<div class="user-details">
    {!! $data->getAvatarView('xs') !!}
    <span class="ms-2{{ auth()->user()->id === $data->id ? ' text-highlight':'' }}">{{ $data->name }}</span>
</div>
