$('.module-card').on("click", function (){
    var card = $(this);
    var active = 1;
    if(card.hasClass("active")){
        active = 0;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: SITEURL + '/settings/modules/updatestatus',
        data: {
            id: $(this).attr('data-uuid'),
            active: active,
        },
        dataType: 'json',
        success: function (data){
            if(active === 1){
                card.addClass("active");
            } else {
                card.removeClass("active");
            }
        },
        error: function (data){
            console.log(data);
        }
    });
});

$('#debuggingOptionSwitch').on("change", function (){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: SITEURL + '/settings/server/debugging',
        data: {
            check: this.checked,
        },
        dataType: 'json',
    });
});