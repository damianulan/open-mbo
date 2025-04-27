require("chosen-js");

import Trix from "trix";
window.Trix = Trix;
export default Trix;

const flatpickr = require("flatpickr");
const flatpickr_locale = require("flatpickr/dist/l10n/" + globalLocale + ".js")
    .default.pl;

$.buildFlatpickr = function () {
    var dateTimePickerOptions = {
        locale: flatpickr_locale,
        allowInput: true,
        altFormat: datetime_format,
        dateFormat: "Y-m-d H:i:s",
        enableTime: true,
        time_24hr: true,
        altInput: true,
    };

    var timePickerOptions = {
        locale: flatpickr_locale,
        altInput: true,
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        altFormat: time_format,
        dateFormat: "H:i:s",
        time_24hr: true,
    };

    var datePickerOptions = {
        locale: flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: "Y-m-d",
    };

    var birthdatePickerOptions = {
        locale: flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: "Y-m-d",
        defaultDate: new Date().setFullYear(new Date().getFullYear() - 18),
        monthSelectorType: "dropdown",
    };

    $(document)
        .find(".datetimepicker")
        .each(function () {
            var minDate = $(this).attr("data-min-date");
            var maxDate = $(this).attr("data-max-date");

            if (minDate) {
                dateTimePickerOptions.minDate = minDate;
            }
            if (maxDate) {
                dateTimePickerOptions.maxDate = maxDate;
            }
            $(this).flatpickr(dateTimePickerOptions);
        });

    $(document)
        .find(".timepicker")
        .each(function () {
            var minDate = $(this).attr("data-min-date");
            var maxDate = $(this).attr("data-max-date");

            if (minDate) {
                timePickerOptions.minDate = minDate;
            }
            if (maxDate) {
                timePickerOptions.maxDate = maxDate;
            }
            $(this).flatpickr(timePickerOptions);
        });

    $(document)
        .find(".datepicker")
        .each(function () {
            var minDate = $(this).attr("data-min-date");
            var maxDate = $(this).attr("data-max-date");

            if (minDate) {
                datePickerOptions.minDate = minDate;
            }
            if (maxDate) {
                datePickerOptions.maxDate = maxDate;
            }
            $(this).flatpickr(datePickerOptions);
        });

    $(document)
        .find(".birthdatepicker")
        .each(function () {
            var minDate = $(this).attr("data-min-date");
            var maxDate = $(this).attr("data-max-date");

            if (minDate) {
                birthdatePickerOptions.minDate = minDate;
            }
            if (maxDate) {
                birthdatePickerOptions.maxDate = maxDate;
            }
            $(this).flatpickr(birthdatePickerOptions);
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
