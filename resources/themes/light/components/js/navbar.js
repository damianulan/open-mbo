function sidebarToggleAll() {
    if($('#sidebar').hasClass('menu-hamburgered')){
        $('#sidebar').removeClass('menu-hamburgered')
    }

    $('#sidebar').toggleClass('menu-collapsed');
    $('#topbar').toggleClass('menu-collapsed');
    $('#main-content').toggleClass('menu-collapsed');
    var menuCollapsed = $('#sidebar').hasClass('menu-collapsed');
    setCookie('menu-collapsed', menuCollapsed, 30);
}

function sidebarHamburger() {
    if($('#sidebar').hasClass('menu-collapsed')){
        $('#sidebar').removeClass('menu-collapsed');
    }

    if(!$('#sidebar').hasClass('menu-hamburgered')){
        $('#sidebar').addClass('menu-hamburgered')
    }
}

    $('#menu-toggle').click(function(){
        sidebarToggleAll();
    });

    $('#hamburger-toggle').click(function (){
        sidebarHamburger();
    });

    $('#hamburger-close').click(function (){
        if($('#sidebar').hasClass('menu-hamburgered')){
            $('#sidebar').removeClass('menu-hamburgered')
        }
    });


$(".pin").on("mouseenter", function () {
    if($(this).hasClass("bi-pin-angle")){
        $(this).removeClass("bi-pin-angle");
        $(this).addClass("bi-pin-angle-fill");
    } else if ($(this).hasClass("bi-pin-angle-fill")) {
        $(this).removeClass("bi-pin-angle-fill");
        $(this).addClass("bi-pin-angle");
    }
});

$(".pin").on("mouseleave", function () {
    if($(this).hasClass("bi-pin-angle")){
        $(this).removeClass("bi-pin-angle");
        $(this).addClass("bi-pin-angle-fill");
    } else if ($(this).hasClass("bi-pin-angle-fill")) {
        $(this).removeClass("bi-pin-angle-fill");
        $(this).addClass("bi-pin-angle");
    }
});

$(".list-menu .section-item .section-item-title").click(function () {
    var link = $(this).attr('data-url');
    if(link){
        document.location.href = link;
    }
});