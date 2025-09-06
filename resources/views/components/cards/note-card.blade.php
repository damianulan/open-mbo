<div class="content-card{{ $minimized ? ' minimized' : '' }}">
    <div class="content-card-top">
        <div class="content-card-header">
            <i class="bi-chat-left-quote me-2"></i>
            <span>{{ $title }}</span>
        </div>
        <div class="content-card-icons ms-auto">
            <i class="minimize"></i>
        </div>
    </div>
    <div class="content-card-body">
        <livewire:commentable :subject="$subject" key="str()->random(50)" />
    </div>
</div>
