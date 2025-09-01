import Quill from 'quill';

$.quillBuild = function () {
    quill_default();
}

$.quillInstances = [];

function quill_default() {
    $('.quill-default').each(function() {

        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'blockquote', 'link'],
            ['clean'],
        ];

        quill_init(this, toolbarOptions);

    });
}

function quill_init(element, toolbarOptions) {
    const parent = $(element).parent().first();
    const input = parent.find('input[type="hidden"]');
    const quill = new Quill(element, {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        input.val(quill.root.innerHTML);
    });

    $.quillInstances.push(quill);
}
