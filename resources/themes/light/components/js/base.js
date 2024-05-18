import { Tooltip } from "bootstrap"
import Toastify from 'toastify-js'

require("chosen-js");
const moment = require("moment");
const Swal = require('sweetalert2');
const CustomSwal = Swal.mixin({
    customClass: {
        cancelButton: 'btn btn-outline-primary',
        confirmButton: 'btn btn-primary me-2',
    },
    confirmButtonText: 'OK',
    cancelButtonText: 'Anuluj',
    buttonsStyling: false,
    backdrop: `rgba(22,71,85, 0.20)`,
});

const flatpickr = require("flatpickr");
const flatpickr_locale = require("flatpickr/dist/l10n/"+globalLocale+".js").default.pl; // TODO

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl));

$(document).ready(function() {
    buildVendors();
});

$("body").on("click", ".card-url", function (){
    var url = $(this).attr('data-url');
    if(url){
        window.location.href = url;
    }
});

$("body").on('click', '.swal-confirm', function(e){
    e.preventDefault();

    swal_confirm($(this).attr('data-swal-text'), $(this).attr('data-swal-title'), function() {
        window.location.href = url;
    });
});


$("input[type=password]").on("focus", function() {
    $(this).val('');
});

function buildVendors() {
    $("select").chosen({
        disable_search_threshold: 5,
        placeholder_text: choose,
        no_results_text: no_results,
        width: '100%',
    });

    $(".datetimepicker").flatpickr({
        "locale": flatpickr_locale,
        allowInput: true,
        altFormat: datetime_format,
        dateFormat: 'Y-m-d H:i:s',
        enableTime: true,
        time_24hr: true,
        altInput: true,
    });

    $(".timepicker").flatpickr({
        "locale": flatpickr_locale,
        altInput: true,
        allowInput: true,
        enableTime: true,
        noCalendar: true,
        altFormat: time_format,
        dateFormat: 'H:i:s',
        time_24hr: true,
    });

    $(".datepicker").flatpickr({
        "locale": flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: 'Y-m-d',
    });
}

function overlay(state) {
    if(state === 'show') {
        $('body').append('<div class="loader-overlay"><div class="mbo-loader"></div></div>');
    } else if (state === 'hide') {
        var overlays = $('body').find('.loader-overlay');
        overlays.remove();
    }
}

function swal_confirm(text, title_input = null, _callback = null)
{
    var title = 'Czy na pewno?';
    if(title_input){
        title = title_input;
    }

    CustomSwal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            if(_callback){
                _callback();
            }
        }
    });
}

function swal_alert(text, title, _callback = null, icon = null)
{

    CustomSwal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
    }).then((result) => {
        if(result.isConfirmed){
            if(_callback){
                _callback();
            }
        }
    });
}

$.confirm = swal_confirm;

$.success = function(text, title_input = null, _callback = null) {
    var title = 'Operacja zakończona pomyślnie!';
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'success');
}
$.error = function(text, title_input = null, _callback = null) {
    var title = 'Wystąpił błąd!';
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'success');
}
$.warning = function(text, title_input = null, _callback = null) {
    var title = 'Uwaga!';
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'success');
}
$.notice = function(text, title_input = null, _callback = null) {
    var title = 'Operacja zakończona pomyślnie!';
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'success');
}

function toast_alert(text, type = 'info', _callback = function(){} ) {
    Toastify({
        text: text,
        duration: 6000,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        className: type,
        callback: _callback,
      }).showToast();
}

$.notify = toast_alert;

$.rebuildVendors = function() {
    buildVendors();
};

$.showOverlay = function () {
    overlay('show');
}
$.hideOverlay = function () {
    overlay('hide');
}



jQuery.fn.extend({

    showLoader: function() {
        this.append('<div class="row jsloader-row"><div class="col-md-12 text-center"><div class="mbo-loader"></div></div></div>');
    },

    hideLoader: function() {
        this.find('.jsloader-row').remove();
    }


});

$.getModal = function (type) {
    if(type && type != ''){
        $.ajax({
            cache: false,
            url: getModalUrl,
            dataType: 'json',
            data: { type: type }
        }).done(function (data) {
            $('body').find('#modal-container').empty().append(data.view);
            $('body').find('#modal-input').click();
        }).fail(function (jqXHR, textStatus) {
            console.error('get_modal footer function failed.');
        });
    }
}
