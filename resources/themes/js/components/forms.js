require("chosen-js");

import Trix from "trix";
window.Trix = Trix;
export default Trix;

const flatpickr = require("flatpickr");
const flatpickr_locale = require("flatpickr/dist/l10n/" + globalLocale + ".js")
    .default.pl; // TODO

$.buildFlatpickr = function () {
    $(".datetimepicker").flatpickr({
        locale: flatpickr_locale,
        allowInput: true,
        altFormat: datetime_format,
        dateFormat: "Y-m-d H:i:s",
        enableTime: true,
        time_24hr: true,
        altInput: true,
    });

    $(".timepicker").flatpickr({
        locale: flatpickr_locale,
        altInput: true,
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        altFormat: time_format,
        dateFormat: "H:i:s",
        time_24hr: true,
    });

    $(".datepicker").flatpickr({
        locale: flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: "Y-m-d",
    });

    $(".birthdatepicker").flatpickr({
        locale: flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: "Y-m-d",
        defaultDate: new Date().setFullYear(new Date().getFullYear() - 18),
        monthSelectorType: "dropdown",
    });
};

$.buildChosen = function () {
    $("select").chosen({
        disable_search_threshold: 5,
        placeholder_text: choose,
        no_results_text: no_results,
        width: "100%",
    });
};

$("input[type=password]").on("focus", function () {
    $(this).val("");
});

$('input[data-numeric="decimal"]').on("focusout", function () {
    var val = $(this).val();
    if (val != "" && !val.includes(".") && !val.includes(",")) {
        $(this).val(val + ".00");
    }
});

$('input[data-numeric="decimal"]').on("focusout", function () {
    var val = $(this).val();
    if (!val.includes(".") && !val.includes(",")) {
        $(this).val(val + ".00");
    }
});
