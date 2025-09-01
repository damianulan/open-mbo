<div wire:poll.10000ms>
    <div class="commentable">
        @foreach($this->subject->comments as $comment)
           <div class="comment{{ $comment->isMine() ? ' my-comment' : '' }}">
                <div class="comment-group">
                    <a href="{{ $comment->author->routeShow() }}" target="_blank" class="commentable-avatar" data-tippy-content="{{ $comment->author->name }}">{!! $comment->author->getAvatarView(30, 30) !!}</a>
                    <div class="commentable-item">
                        <div class="commentable-toolbox">
                            <a class="commentable-author" href="{{ $comment->author->routeShow() }}" target="_blank">{{ $comment->author->name }}</a>
                            <a class="icon-btn ms-auto" data-tippy-content="{{ __('buttons.edit') }}"><i class="bi-pencil-fill"></i></a>
                            <a class="icon-btn" wire:confirm="Na pewno?" wire:click="delete" data-tippy-content="{{ __('buttons.delete') }}"><i class="bi-trash3-fill"></i></a>
                        </div>
                        <div class="commentable-content">
                            {!! $comment->content !!}
                        </div>
                        <div class="commentable-footer">
                            <a href="#" class="fs-7"><i class="bi-hand-thumbs-up-fill"></i></a>
                            <a href="javascript:void" class="fw-600 ms-2">Odpowiedz</a>
                            <div class="commentable-timestamp">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <div class="w-100" id="comment_container" wire:ignore>
        <div id="comment_editor">

        </div>

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
        $('#comment_container').append('<div id="comment_editor"></div>');
        quill = new Quill('#comment_editor', $.quillSimpleOptions);
        if(log) {
            console.log('quill initialized');
        }
        quill.on('text-change', function(delta, oldDelta, source) {
            console.log(quill.root.innerHTML);
        });
    }

    $('#add_btn').on('click', function() {
        if(quill) {
            let content = quill.root.innerHTML;
            Livewire.dispatch('commentable.submit', { content: content });
        }
    });

    document.addEventListener('livewire:init', () => {
        initializeQuill();

        Livewire.directive('confirm', ({ el, directive, component, cleanup }) => {
            let content =  directive.expression

            // The "directive" object gives you access to the parsed directive.
            // For example, here are its values for: wire:click.prevent="deletePost(1)"
            //
            // directive.raw = wire:click.prevent
            // directive.value = "click"
            // directive.modifiers = ['prevent']
            // directive.expression = "deletePost(1)"

            console.log(content);
            let onClick = e => {
                if (! $.confirm(content)) {
                    e.preventDefault()
                    e.stopImmediatePropagation()
                }
            }

            el.addEventListener('click', onClick, { capture: true })

            // Register any cleanup code inside `cleanup()` in the case
            // where a Livewire component is removed from the DOM while
            // the page is still active.
            cleanup(() => {
                el.removeEventListener('click', onClick)
            })
        });

        Livewire.on('commentable.initialize.quill', () => {
            initializeQuill(true);
        });
    });


</script>

@endpush
