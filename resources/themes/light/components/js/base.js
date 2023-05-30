$(document).ready(function() {
    $('.select').select2({
        placeholder: "Wybierz...",
        language: "pl",
        theme: "default",
    });

    $('.select-multiple').select2({
        placeholder: "Wybierz...",
        language: "pl",
        theme: "default",
        multiple: true,
    });
});

$(".course-card").click(function (){
    var url = $(this).attr('data-url');
    if(url){
        window.location.href = url;
    }
});