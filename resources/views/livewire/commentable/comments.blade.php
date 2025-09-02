<div>
    <div class="commentable" wire:poll.10000ms>
        @foreach($this->subject->comments_direct as $comment)
            <div class="comment{{ $comment->isMine() ? ' my-comment' : '' }}" wire:key="{{ str()->random(50) }}">
                <div class="comment-group" wire:transition.opacity.duration.1000ms >
                    <a href="{{ $comment->author->routeShow() }}" target="_blank" class="commentable-avatar" data-tippy-content="{{ $comment->author->name }}">{!! $comment->author->getAvatarView(30, 30) !!}</a>
                    <div class="commentable-item">
                        <div class="commentable-toolbox">
                            <a class="commentable-author" href="{{ $comment->author->routeShow() }}" target="_blank">{{ $comment->author->name }}</a>
                            @if($comment->isMine())
                                <a class="icon-btn ms-auto" wire:confirm="Na pewno?" wire:click="delete({{ $comment->id }})" data-tippy-content="{{ __('buttons.delete') }}"><i class="bi-trash3-fill"></i></a>
                            @endif
                        </div>
                        <div class="commentable-content">
                            {!! $comment->content !!}
                        </div>
                        <div class="commentable-footer">
                            @if(!$comment->isMine())
                                <a href="javascript:void" class="fw-600">Odpowiedz</a>
                            @endif
                            <div class="commentable-timestamp" data-tippy-content="{{ $comment->created_at->format('d.m.Y H:i') }}">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-100" id="comment_container" wire:ignore>
        <div id="comment_editor" wire:ignore></div>
    </div>
    <div class="d-flex mt-2 justify-content-end">
        <button class="btn btn-primary d-flex align-items-center" id="add_btn">Wyślij<i class="bi bi-send ms-2"></i></button>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    let quill = null;

    $('#add_btn').on('click', function() {
        console.log(quill.root.innerHTML);
    });

    function initializeQuill(log = false) {
        $('#comment_container').empty();
        $('#comment_container').append('<div id="comment_editor" wire:ignore></div>');
        quill = new Quill('#comment_editor', $.quillSimpleOptions);
        if(log) {
            console.log('quill initialized');
        }
    }

    $('#add_btn').on('click', function() {
        if(quill) {
            let content = quill.root.innerHTML;
            Livewire.dispatch('commentable.submit', { content: content });
        }
    });

    document.addEventListener('livewire:init', () => {
        initializeQuill();

        Livewire.on('commentable.initialize.quill', (event) => {
            initializeQuill(true);
        });
    });

</script>

@endpush
