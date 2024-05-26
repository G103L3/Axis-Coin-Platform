//  Preloader
jQuery(window).on("load", function () {
    $('#main-wrapper').addClass('show');
    $('#preloader').fadeOut(2000);
});


(function ($) {

    "use strict"
    $('.duration-option a')
        .on('click', function () {
            $(".duration-option a.active")
                .removeClass("active");
            $(this)
                .addClass('active');
        });

    // File Upload 
    $(".file-upload-wrapper").on("change", ".file-upload-field", function () {
        $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
    });


    //to keep the current page active
    $(function () {
        for (var nk = window.location,
            o = $(".menu a").filter(function () {
                return this.href == nk;
            })
                .addClass("active")
                .parent()
                .addClass("active"); ;) {
            // console.log(o)
            if (!o.is("li")) break;
            o = o.parent()
                .addClass("show")
                .parent()
                .addClass("active");
        }

    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.sidebar-right-trigger').on('click', function () {
        $('.sidebar-right').toggleClass('show');
    });






})(jQuery);

last_page = "";
$(function () {
    var includes = $('[data-include]')
    $.each(includes, function () {
        var file = '' + $(this).data('include') + '.php'
        $(this).load(file)
    })
    $('#preloader').fadeOut(2000);
    NProgress.start();
    NProgress.set(0.0);
    NProgress.set(0.4);
    var re = /\#\!\/(([A-Za-z]|\-)+)/g;
    var s = window.location.href;
    var m;
    m = re.exec(s);
    let meta = "dashboard";
    if(m != null){
        meta = m[1].toString();
    }
    $("#master_page_container").append('<div id="page_container_' + meta + '"></div>');

    $( "#page_container_" + meta).load( meta + ".php", function() {
        NProgress.set(1);
        NProgress.done();
    });

    last_page = meta;

    NProgress.set(0.6);

})

function nav_click(element){
    let state = true;
    NProgress.start();
    NProgress.set(0.1);
    NProgress.set(0.3);
    if($( "#page_container_" + element).length > 0){
        $( "#page_container_" + element).show();
        state = false;
        NProgress.set(0.6);
        $( "#page_container_" + last_page ).hide();
        last_page = element;
    }else{
        $("#master_page_container").append('<div id="page_container_' + element + '"></div>');
        $( "#page_container_" + element).load( "" + element + ".php", function() {
            NProgress.set(1);
            NProgress.done();
            $( "#page_container_" + last_page ).hide();
            last_page = element;
        });
    }

    location.hash = '#!/' + element;

    if(state){
        NProgress.set(0.6);
    }else{
        NProgress.set(1);
        NProgress.done();
    }

    return false;
}









