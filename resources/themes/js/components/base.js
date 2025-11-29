import { Tooltip } from "bootstrap";
import Toastify from "toastify-js";

const moment = require("moment");
const Swal = require("sweetalert2");
const CustomSwal = Swal.mixin({
    customClass: {
        cancelButton: "btn btn-outline-primary",
        confirmButton: "btn btn-primary me-2",
    },
    confirmButtonText: "OK",
    cancelButtonText: "Anuluj",
    buttonsStyling: false,
    backdrop: `rgba(22,71,85, 0.20)`,
});
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new Tooltip(tooltipTriggerEl)
);

const modal_initialized = new Event("modal-initialized");

$.buildVendor = function () {
    $.rebuildVendors();
    $.quillBuild();
}

$("body").on("click", ".swal-confirm", function (e) {
    e.preventDefault();
    var url = $(this).attr("href");

    swal_confirm(
        $(this).attr("data-swal-text"),
        $(this).attr("data-swal-title"),
        function () {
            window.location.href = url;
        }
    );
});

$("body").on("click", "*:not(.modal) button[type=submit]", function () {
    $.overlay('show');
});

$(".table-container").on("xhr.dt", function (e, settings, json, xhr) {
    $.buildVendor();
});

$.overlay = function (state) {
    if (state === "show") {
        $("body").append(
            '<div class="loader-overlay"><div class="mbo-loader"></div></div>'
        );
    } else if (state === "hide") {
        var overlays = $("body").find(".loader-overlay");
        overlays.remove();
    }
};

function swal_confirm(text, title_input = null, _callback = null) {
    var title = "Czy na pewno?";
    if (title_input) {
        title = title_input;
    }

    CustomSwal.fire({
        title: title,
        text: text,
        icon: "question",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            if (_callback) {
                _callback();
            }
        }
        return result.isConfirmed;
    });
}

function swal_alert(text, title, _callback = null, icon = null) {
    CustomSwal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
    }).then((result) => {
        if (result.isConfirmed) {
            if (_callback) {
                _callback();
            }
        }
    });
}

$.confirm = swal_confirm;

$.success = function (text, title_input = null, _callback = null) {
    var title = alert_success;
    if (title_input) {
        title = title_input;
    }

    swal_alert(text, title, _callback, "success");
};
$.error = function (text, title_input = null, _callback = null) {
    var title = alert_error;
    if (title_input) {
        title = title_input;
    }

    swal_alert(text, title, _callback, "error");
};
$.warning = function (text, title_input = null, _callback = null) {
    var title = alert_warning;
    if (title_input) {
        title = title_input;
    }

    swal_alert(text, title, _callback, "warning");
};
$.notice = function (text, title_input = null, _callback = null) {
    var title = alert_success;
    if (title_input) {
        title = title_input;
    }

    swal_alert(text, title, _callback);
};

function toast_alert(text, type = "info", _callback = function () {}) {
    Toastify({
        text: text,
        duration: 8000,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        className: type,
        callback: _callback,
        escapeMarkup: false,
    }).showToast();
}

$.notify = toast_alert;

$.showOverlay = function () {
    $.overlay("show");
};
$.hideOverlay = function () {
    $.overlay("hide");
};

jQuery.fn.extend({
    showLoader: function () {
        this.append(
            '<div class="row jsloader-row"><div class="col-md-12 text-center"><div class="mbo-loader"></div></div></div>'
        );
    },

    hideLoader: function () {
        this.find(".jsloader-row").remove();
    },
});

$.getModal = function (target, datas = {}, _callback = null) {
    if (target && target != "") {
        $.ajax({
            cache: false,
            url: getModalUrl,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-Token": csrf,
            },
            data: {
                target: target,
                datas: datas,
            },
        })
            .done(function (data) {
                if (data.status === "ok") {
                    $("body").find("#modal-container").children().remove();
                    $("body").find("#modal-container").append(data.view);
                    $("body").find("#modal-input").trigger("click");
                    $(document).trigger(modal_initialized);
                    if (_callback) {
                        _callback(data);
                    }
                } else {
                    if (data.status === "warning") {
                        $.warning(data.message);
                    } else if (data.status === "notice") {
                        $.notice(data.message);
                    } else {
                        $.error(data.message);
                    }
                }
            })
            .fail(function (jqXHR, textStatus) {
                console.error("get_modal footer function failed.", textStatus);
            });
    }
};

$.hideModal = function () {
    $("body").find("#modal-input").trigger("click");
};

$.jsonAjax = function (
    url,
    datas,
    _success_callback = function (response) {},
    _error_callback = function (response) {},
    method = "GET",
    overlay = true,
    cache = false
) {
    if (overlay) {
        $.showOverlay();
    }
    $.ajax({
        cache: cache,
        url: url,
        dataType: "json",
        type: method,
        headers: {
            "X-CSRF-Token": csrf,
        },
        data: datas,
    })
        .done(function (response) {
            if (response.status === "ok") {
                _success_callback(response);
            } else {
                _error_callback(response);
            }
            if (overlay) {
                $.hideOverlay();
            }
        })
        .fail(function (jqXHR, textStatus) {
            if (overlay) {
                $.hideOverlay();
            }
            $.error(alert_ajax_error);
            console.error("json ajax request failed.", textStatus);
        });
};

$.ajaxForm = function (
    url,
    form_id,
    _success_callback = function (response) {},
    _error_callback = function (response) {},
    overlay = true,
    cache = false
) {
    if (overlay) {
        $.showOverlay();
    }
    var datas = $(document)
        .find("#" + form_id)
        .find("input,select,textarea")
        .serializeArray();
    $.clearErrorsForm(form_id);
    if (datas) {
        $.ajax({
            cache: cache,
            url: url,
            dataType: "json",
            type: "POST",
            headers: {
                "X-CSRF-Token": csrf,
            },
            data: datas,
        })
            .done(function (response) {
                if (response.status === "ok") {
                    _success_callback(response);
                } else {
                    $.makeErrorsForm(form_id, response);
                    _error_callback(response);
                }
                if (overlay) {
                    $.hideOverlay();
                }
            })
            .fail(function (jqXHR, textStatus) {
                if (overlay) {
                    $.hideOverlay();
                }
                $.error(alert_ajax_error);
                console.error("json ajax form request failed.", textStatus);
            });
    } else {
        console.error("json ajax form request failed. inputs are empty.");
    }
};

$.makeErrorsForm = function (form_id, response) {
    if(response.messages && response.messages.length > 0) {
        Object.keys(response.messages).forEach((key) => {
            var input = $(document)
                .find("#" + form_id)
                .find('[name="' + key + '"]');
            if (!input || input.length == 0) {
                input = $(document)
                    .find("#" + form_id)
                    .find('[name="' + key + '[]"]');
            }
            if (input) {
                input.each(function () {
                    var element = $(this);
                    var element_id = element.attr("id");
                    var is_chosenjs = $(document).find(
                        "#" + element_id + "_chosen"
                    );
                    element.addClass("is-invalid");
                    response.messages[key].forEach((message) => {
                        var feedback =
                            '<div class="invalid-feedback">' + message + "</div>";
                        element.parent().closest("div").append(feedback);
                    });
                    if (is_chosenjs) {
                        element.trigger("chosen:updated");
                    }
                });
            }
        });
    }
};

$.clearErrorsForm = function (form_id) {
    $(document)
        .find("#" + form_id)
        .find(".invalid-feedback")
        .remove();
    $(document)
        .find("#" + form_id)
        .find(".is-invalid")
        .removeClass("is-invalid");
};

// GLOBAL FUNCTIONS
$.setCookie = function (name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
};

$.getCookie = function (name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
};

$.eraseCookie = function (name, path, domain) {
    if ($.getCookie(name)) {
        document.cookie = name + "=; Max-Age=-99999999;";
    }
};

$("i.minimize").on("click", function () {
    var card = $(this).closest(".content-card");
    if (card.hasClass("minimized")) {
        card.removeClass("minimized");
    } else {
        card.addClass("minimized");
    }
});
