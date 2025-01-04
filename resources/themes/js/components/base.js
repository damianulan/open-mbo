import { Tooltip } from "bootstrap";
import Toastify from 'toastify-js';
import tippy from 'tippy.js';

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

jQuery(function() {
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
    var url = $(this).attr('href');

    swal_confirm($(this).attr('data-swal-text'), $(this).attr('data-swal-title'), function() {
        window.location.href = url;
    });
});


$("input[type=password]").on("focus", function() {
    $(this).val('');
});

$('input[data-numeric="decimal"]').on('focusout', function() {
    var val = $(this).val();
    if(val != '' && !val.includes('.') && !val.includes(',')){
        $(this).val(val + '.00');
    }
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

    $(".birthdatepicker").flatpickr({
        "locale": flatpickr_locale,
        allowInput: true,
        altInput: true,
        altFormat: date_format,
        dateFormat: 'Y-m-d',
        defaultDate: (new Date()).setFullYear(new Date().getFullYear() - 18),
        monthSelectorType: "dropdown",
    });

    tippy('[data-tippy-content]', {
        allowHTML: true
    });
}
$('.table-container').on('xhr.dt', function (e, settings, json, xhr) {
    $.rebuildVendors();
});

$('input[data-numeric="decimal"]').on('focusout', function() {
    var val = $(this).val();
    if(!val.includes('.') && !val.includes(',')){
        $(this).val(val + '.00');
    }
});

$.overlay = function(state) {
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
    var title = alert_success;
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'success');
}
$.error = function(text, title_input = null, _callback = null) {
    var title = alert_error;
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'error');
}
$.warning = function(text, title_input = null, _callback = null) {
    var title = alert_warning;
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback, 'warning');
}
$.notice = function(text, title_input = null, _callback = null) {
    var title = alert_success;
    if(title_input){
        title = title_input;
    }

    swal_alert(text, title, _callback);
}

function toast_alert(text, type = 'info', _callback = function(){} ) {
    Toastify({
        text: text,
        duration: 8000,
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
    $.overlay('show');
}
$.hideOverlay = function () {
    $.overlay('hide');
}

jQuery.fn.extend({

    showLoader: function() {
        this.append('<div class="row jsloader-row"><div class="col-md-12 text-center"><div class="mbo-loader"></div></div></div>');
    },

    hideLoader: function() {
        this.find('.jsloader-row').remove();
    }


});

$.getModal = function (type, datas = {}) {
    if(type && type != ''){
        datas.type = type;
        $.ajax({
            cache: false,
            url: getModalUrl,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': csrf
            },
            data: datas
        }).done(function (data) {
            if(data.status === 'ok'){
                $('body').find('#modal-container').children().remove()
                $('body').find('#modal-container').append(data.view);
                $('body').find('#modal-input').trigger("click");
            } else {
                if(data.status === 'warning'){
                    $.warning(data.message);
                } else if(data.status === 'notice') {
                    $.notice(data.message);
                } else {
                    $.error(data.message);
                }
            }

        }).fail(function (jqXHR, textStatus) {
            console.error('get_modal footer function failed.', textStatus);
        });
    }
}

$.hideModal = function () {
    $('body').find('#modal-input').trigger("click");
}

$.jsonAjax = function (url, datas, _success_callback = function(response){}, _error_callback = function(response){}, method = 'GET', overlay = true, cache = false) {
    if(overlay){
        $.showOverlay();
    }
    $.ajax({
        cache: cache,
        url: url,
        dataType: 'json',
        type: method,
        headers: {
            'X-CSRF-Token': csrf
        },
        data: datas
    }).done(function (response) {
        if(response.status === 'ok'){
            _success_callback(response);
        } else {
            _error_callback(response);
        }
        if(overlay){
            $.hideOverlay();
        }
    }).fail(function (jqXHR, textStatus) {
        if(overlay){
            $.hideOverlay();
        }
        $.error(alert_ajax_error);
        console.error('json ajax request failed.', textStatus);
    });
}

$.ajaxForm = function (url, form_id, _success_callback = function(response){}, _error_callback = function(response){}, overlay = true, cache = false) {
    if(overlay){
        $.showOverlay();
    }
    var datas = $(document).find('#'+form_id).find('input,select,textarea').serializeArray();
    $.clearErrorsForm(form_id);
    if(datas){
        $.ajax({
            cache: cache,
            url: url,
            dataType: 'json',
            type: 'POST',
            headers: {
                'X-CSRF-Token': csrf
            },
            data: datas
        }).done(function (response) {
            if(response.status === 'ok'){
                _success_callback(response);
            } else {
                $.makeErrorsForm(form_id, response);
                _error_callback(response);
            }
            if(overlay){
                $.hideOverlay();
            }
        }).fail(function (jqXHR, textStatus) {
            if(overlay){
                $.hideOverlay();
            }
            $.error(alert_ajax_error);
            console.error('json ajax form request failed.', textStatus);
        });
    } else {
        console.error('json ajax form request failed. inputs are empty.');
    }

}

$.makeErrorsForm = function (form_id, response) {
    Object.keys(response.messages).forEach(key => {
        var input = $(document).find('#'+form_id).find('[name="'+key+'"]');
        if(!input || input.length == 0){
            input = $(document).find('#'+form_id).find('[name="'+key+'[]"]');
        }
        if(input){
            input.each(function() {
                var element = $(this);
                var element_id = element.attr('id');
                var is_chosenjs = $(document).find('#'+element_id+'_chosen');
                element.addClass('is-invalid');
                response.messages[key].forEach(message => {
                    var feedback = '<div class="invalid-feedback">'+message+'</div>';
                    element.parent().closest('div').append(feedback);
                });
                if(is_chosenjs){
                    element.trigger("chosen:updated");
                }
            });
        }
    });
}

$.clearErrorsForm = function (form_id) {
    $(document).find('#'+form_id).find('.invalid-feedback').remove();
    $(document).find('#'+form_id).find('.is-invalid').removeClass('is-invalid');
}
