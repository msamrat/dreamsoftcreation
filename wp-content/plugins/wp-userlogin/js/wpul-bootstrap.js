jQuery(document).ready(function($){
    $('ul.wpul_menu').css({
        'padding': 0,
        'margin' : 0,
        'min-width' : '180px'
    });
    $('ul.wpul_menu li #welcome').css({
        'display':'block'
    });
    $('ul.wpul_menu li img').addClass('img-circle pull-right').css({'width':'32px','height':'auto'});
    $('a[data-toggle=collapse]').css({
        'width':'100% !important',
        'cursor':'pointer !important'
    });

});