import { Tooltip } from "bootstrap"
require("chosen-js");
const moment = require("moment");
const Swal = require('sweetalert2');
const CustomSwal = Swal.mixin({
    customClass: {
        cancelButton: 'btn btn-outline-primary',
        confirmButton: 'btn btn-primary me-2',
    },
    buttonsStyling: false,
    backdrop: `rgba(22,71,85, 0.20)`,
});

const flatpickr = require("flatpickr");
const flatpickr_pl = require("flatpickr/dist/l10n/pl.js").default.pl;

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl));

$(document).ready(function() {
    $("select").chosen({
        disable_search_threshold: 5,
        placeholder_text: choose,
        no_results_text: no_results,
    });

    $(".datetimepicker").flatpickr({
        "locale": flatpickr_pl,
        allowInput: true,
        dateFormat: datetime_format,
        enableTime: true,
        time_24hr: true,
    });

    $(".timepicker").flatpickr({
        "locale": flatpickr_pl,
        altInput: true,
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        dateFormat: time_format,
        time_24hr: true,
    });

    $(".datepicker").flatpickr({
        "locale": flatpickr_pl,
        allowInput: true,
        dateFormat: date_format,
    });

    $(".datepicker-range").flatpickr({
        "locale": flatpickr_pl,
        dateFormat: date_format,
        allowInput: true,
        mode: "range"
    });
});

$("body").on("click", ".card-url", function (){
    var url = $(this).attr('data-url');
    if(url){
        window.location.href = url;
    }
});

$("body").on('click', '.swal-confirm', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var title = 'Czy na pewno?';
    var title_input = $(this).attr('data-swal-title');
    if(title_input){
        title = title_input;
    }
    var text = $(this).attr('data-swal-text');

    CustomSwal.fire({
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Anuluj',
    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = url;
        }
    });
})


$("input[type=password]").on("focus", function() {
    $(this).val('');
})
