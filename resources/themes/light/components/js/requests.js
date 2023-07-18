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
