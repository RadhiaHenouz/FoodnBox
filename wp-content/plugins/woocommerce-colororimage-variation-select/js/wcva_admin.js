jQuery(document).ready(function($) {

$(function() {

    $('#wcva_woocommerce_global_activation').on('change',function(){

        if ($(this).prop('checked')) {
             $(this).closest("tr").next().show(200);
        } else {
             $(this).closest("tr").next().hide(200);
        }
    });

    $('#woocommerce_wcva_swatch_tooltip:not(:checked)').closest('tr').next().hide();
    //hide show "disable tooltip on iphone devices checkbox"
    $('#woocommerce_wcva_swatch_tooltip').change(function() {
	
	    var wcvarow = $(this).closest('tr').next();
	
        if( $(this).is(':checked')) {
           wcvarow.show();
        } else {
           wcvarow.hide();
        }
    }); 


    $('#woocommerce_enable_shop_slider:not(:checked)').closest('tr').next().hide();
    //hide show "disable tooltip on iphone devices checkbox"
    $('#woocommerce_enable_shop_slider').change(function() {
    
        var wcvarow2 = $(this).closest('tr').next();
    
        if( $(this).is(':checked')) {
           wcvarow2.show();
        } else {
           wcvarow2.hide();
        }
    });

    
    var next_tr_to_shop_more         = $('#woocommerce_enable_shop_show_more').closest('tr').next();
    
    var second_next_to_shop_more     = $('#woocommerce_enable_shop_show_more').closest('tr').next().next();

    var enable_click_behavior_tr     = $('#wcva_disable_unavailable_options').closest('tr').next();


    next_tr_to_shop_more.hide();

    second_next_to_shop_more.hide();

    enable_click_behavior_tr.hide();
    
    $('#woocommerce_enable_shop_show_more').on('change',function() {
    
        if( $(this).is(':checked')) {
           next_tr_to_shop_more.show();
           second_next_to_shop_more.show();
        } else {
           next_tr_to_shop_more.hide();
           second_next_to_shop_more.hide();
        }
    }); 

    $('#wcva_disable_unavailable_options').on('change',function() {
        var disableval = $(this).val();

        if (disableval == '02') {
            enable_click_behavior_tr.show();
        } else {
            enable_click_behavior_tr.hide();
        }
    });

    $(window).load(function() {

        if( $('#woocommerce_enable_shop_show_more').is(':checked')) {
            next_tr_to_shop_more.show();
            second_next_to_shop_more.show();
        } else {
            next_tr_to_shop_more.hide();
            second_next_to_shop_more.hide();
        }


        var disableval = $('#wcva_disable_unavailable_options').val();

        if (disableval == '02') {
            enable_click_behavior_tr.show();
        } else {
            enable_click_behavior_tr.hide();
        }
    
    });


});


});