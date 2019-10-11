(function ($) {
    'use strict';

    function checkwpadminBar () {
        if($('#wpadminbar').length > 0) {
            
        }
    }
    
    function custom_wl(){
        $('.preloader-wrap').fadeOut(3000, function () {
            $('this').remove();
        });
    }    
    function custom(){
        $('.site_preloader').fadeOut(4000, function () {
            $('this').remove();
        });
        $('#primary-menu').slicknav({
            prependTo: '.menu_col',
            allowParentLinks: true
        });
    }
    
    $(document).ready(function () {
        custom();
    });
    $(window).load(function () {
        custom_wl();
    });

    
})(jQuery);