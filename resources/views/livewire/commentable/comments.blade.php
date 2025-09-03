<div>
    <div class="commentable">
        @foreach($this->subject->comments as $comment)
            <div class="comment{{ $comment->isMine() ? ' my-comment' : '' }}" wire:key="{{ str()->random(50) }}">
                <div class="comment-group" wire:transition.opacity.duration.1000ms >
                    <a href="{{ $comment->author->routeShow() }}" target="_blank" class="commentable-avatar" data-tippy-content="{{ $comment->author->name }}">{!! $comment->author->getAvatarView(30, 30) !!}</a>
                    <div class="commentable-item">
                        <div class="commentable-header">
                            <a class="commentable-author" href="{{ $comment->author->routeShow() }}" target="_blank">{{ $comment->author->name }}</a>
                            @if($comment->isMine())
                                <a class="icon-btn ms-auto" wire:confirm="Na pewno?" wire:click="delete({{ $comment->id }})" data-tippy-content="{{ __('buttons.delete') }}"><i class="bi-trash3-fill"></i></a>
                            @endif
                            @if(!$comment->private)
                                <a class="icon-btn ms-1 commentable-quote" href="javascript:void(0);" data-tippy-content="{{ __('buttons.quote') }}"><i class="bi-quote"></i></a>
                            @endif
                        </div>
                        <div class="commentable-content">
                            {!! $comment->content !!}
                        </div>
                        <div class="commentable-footer">
                            @if($comment->private)
                                <div class="badge bg-warning">{{ __('globals.privately') }}</div>
                            @endif
                            <div class="commentable-timestamp" data-tippy-content="{{ $comment->created_at->format(config('app.datetime_format')) }}">{{ $comment->created_at->diffForHumans() }}</div>
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
        <button class="btn btn-outline-primary d-flex align-items-center" id="add_private_btn">{{ __('globals.privately') }}<i class="bi bi-lock ms-2"></i></button>
        <button class="btn btn-primary d-flex align-items-center ms-2" id="add_btn">{{ __('buttons.send') }}<i class="bi bi-send ms-2"></i></button>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    const quote_authored = '{{ __('fields.quote_authored') }}';
    const quote_at = '{{ __('fields.quote_at') }}';

    var current_quill = null;

    function initializeQuill(log = false) {
        $('#comment_container').empty();
        $('#comment_container').append('<div id="comment_editor" wire:ignore></div>');
        quill = new Quill('#comment_editor', $.quillSimpleOptions);
        quill.keyboard.addBinding({
            key: 'Enter'
            }, function(range, context) {
                console.log('enter');
        });
        quill.keyboard.addBinding({
            key: '13'
            }, function(range, context) {
                console.log('enter2');
        });
        current_quill = quill;
        $.buildVendor();
        if(log) {
            console.log('quill initialized');
        }
    }

    $('#add_private_btn').on('click', function() {
        submit_comment(true);
    });

    $('#add_btn').on('click', function() {
        submit_comment();
    });

    function submit_comment(private = false) {
        if(current_quill) {
            let content = current_quill.root.innerHTML;
            Livewire.dispatch('commentable.submit', { content: content, private: private });
        }
    }

    document.addEventListener('livewire:init', () => {
        initializeQuill();

        Livewire.on('commentable.initialize.quill', (event) => {
            initializeQuill(true);
        });
    });

    $(document).on('click', '.commentable .commentable-quote', function() {
        var commentable_item = $(this).parents('.commentable-item').first();
        if(commentable_item) {
            quote(commentable_item);
        } else {
            console.error('commentable item not found');
        }
    });

    function quote(commentable_item) {
        var author = $(commentable_item).find('.commentable-author').text();
        var content = $(commentable_item).find('.commentable-content').text();
        var at = $(commentable_item).find('.commentable-timestamp').attr('data-tippy-content');

        if(current_quill) {
            if(content && content.length > 0) {
                const added_content = '<blockquote><em>--- @' + author + quote_authored + ' ' + quote_at + ' ' + at + ':</em></blockquote><blockquote>' + content + ' ---</blockquote>';
                current_quill.focus();
                var caretPosition = current_quill.getSelection(true);
                current_quill.clipboard.dangerouslyPasteHTML(caretPosition.index, added_content);
            }
        } else {
            console.error('quill object not found');
        }
    }

</script>

@endpush
