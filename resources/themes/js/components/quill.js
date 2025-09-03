import Quill from 'quill';

window.Quill = Quill;

$.quillBuild = function () {
    quill_components();
}
$.quillInstances = [];

$.quillDefaultToolbar = [
    ['bold', 'italic', 'underline', 'blockquote', 'code-block', 'link'],
    [{ 'header': [1, 2, 3, false] }],
    ['clean'],
];

$.quillSimpleToolbar = [
    ['bold', 'italic', 'underline', 'blockquote', 'code-block', 'link'],
];

$.quillSimpleOptions = {
    modules: {
        toolbar: $.quillSimpleToolbar
    },
    theme: 'snow'
};

function quill_components() {
    $('.quill-default').each(function() {
        quill_init(this, $.quillDefaultToolbar);
    });

    $('.quill-simple').each(function() {
        quill_init(this, $.quillSimpleToolbar);
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
    if(input) {
        quill.on('text-change', function(delta, oldDelta, source) {
            input.val(quill.root.innerHTML);
        });
    }
    window.quill = quill;

    $.quillInstances.push(quill);
}
