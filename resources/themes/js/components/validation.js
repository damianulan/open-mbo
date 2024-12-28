$('input[data-validation="numeric"]').on('keypress', function (evt){
    $(this).val($(this).val().replace(/[^0-9\.|\,]/g,''));
    if(evt.which == 44)
    {
    return true;
    }
    if ((evt.which != 46 || $(this).val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57  )) {

        evt.preventDefault();
    }
});
