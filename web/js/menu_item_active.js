$(function($){
    var url = document.location.href;
    var pos= url.indexOf("#");
    if (pos > 0) {
        url = url.substring(0, pos);
    }

    // Admin
    $.each($('.js_menu_admin a'), function(index, value) {
        if (url.indexOf($(this).attr('href')) + 1) {
            $(this).addClass('item-active').parent();
        }
    });
});
