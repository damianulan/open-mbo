import { Tooltip } from "bootstrap"
require("chosen-js");
const moment = require("moment");

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
        mode: "range"
    });
});

$("input[type=password]").on("focus", function() {
    $(this).val('');
})
