const chosen = require("chosen-js");

const flatpickr = require("flatpickr");
const flatpickr_pl = require("flatpickr/dist/l10n/pl.js").default.pl;

$(document).ready(function() {
    $("select").chosen({

    });

    $(".datetimepicker").flatpickr({
        "locale": flatpickr_pl,
        dateFormat: "d-m-Y H:i",
        enableTime: true,
    });

    $(".timepicker").flatpickr({
        "locale": flatpickr_pl,
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });

    $(".datepicker").flatpickr({
        "locale": flatpickr_pl,
        dateFormat: "d-m-Y",
    });

    $(".datepicker-range").flatpickr({
        "locale": flatpickr_pl,
        dateFormat: "d-m-Y",
        mode: "range"
    });
});

$(".course-card").click(function (){
    var url = $(this).attr('data-url');
    if(url){
        window.location.href = url;
    }
});