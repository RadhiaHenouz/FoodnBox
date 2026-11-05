<?php

// Helpers.
include_once( get_template_directory() . '/functions/helpers/helpers.php');

// Theme setup.
include_once( get_template_directory() . '/functions/theme/theme-setup.php');
include_once( get_template_directory() . '/functions/theme/theme-styles.php');
include_once( get_template_directory() . '/functions/theme/theme-scripts.php');

// Admin setup.
include_once( get_template_directory() . '/functions/admin/admin-setup.php');
include_once( get_template_directory() . '/functions/admin/admin-styles.php');
include_once( get_template_directory() . '/functions/admin/admin-scripts.php');

// Customizer.
include_once( get_template_directory() . '/inc/customizer/read-options.php' );
include_once( get_template_directory() . '/inc/customizer/backend/class/class-fonts.php' );
include_once( get_template_directory() . '/inc/customizer/frontend.php' );
include_once( get_template_directory() . '/inc/customizer/backend.php' );

// WP.
include_once( get_template_directory() . '/functions/wp/header-functions.php');
include_once( get_template_directory() . '/functions/wp/footer-functions.php');
include_once( get_template_directory() . '/functions/wp/actions.php');
include_once( get_template_directory() . '/functions/wp/filters.php');

// WC.
if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wc/actions.php');
	include_once( get_template_directory() . '/functions/plugins/wc/filters.php');
	include_once( get_template_directory() . '/functions/plugins/wc/custom.php');
}

// Germanized & German Market.
if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE || SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/germanized/functions.php');
}

// WPBakery.
if( SHOPKEEPER_WPBAKERY_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wb/functions.php');
}

// YITH Wishlist
if( SHOPKEEPER_WISHLIST_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wishlist/actions.php');
}

// WPML.
include_once( get_template_directory() . '/functions/plugins/wpml/functions.php');

// Load Custom Styles.
include_once( get_template_directory() . '/inc/custom-styles/init.php' );

// Load Post meta template.
include_once( get_template_directory() . '/inc/templates/post-meta.php' );

// Load Template Tags.
include_once( get_template_directory() . '/inc/templates/template-tags.php' );

//Include Metaboxes.
include_once( get_template_directory() . '/inc/metaboxes/page.php' );
include_once( get_template_directory() . '/inc/metaboxes/post.php' );
include_once( get_template_directory() . '/inc/metaboxes/product.php' );

//Quick View.
include_once( get_template_directory() . '/inc/woocommerce/quick_view.php' );

//Product Layout.
include_once( get_template_directory() . '/inc/woocommerce/product-layout.php' );
include_once( get_template_directory() . '/inc/woocommerce/commande_groupe.php' );


function shopkeeper_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'shopkeeper_register_elementor_locations' );

add_action( 'woocommerce_widget_shopping_cart_buttons', function(){
    // Removing Buttons
    echo "removeé";
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

    // Adding customized Buttons
    //add_action( 'woocommerce_widget_shopping_cart_buttons', 'custom_widget_shopping_cart_button_view_cart', 10 );
    //add_action( 'woocommerce_widget_shopping_cart_buttons', 'custom_widget_shopping_cart_proceed_to_checkout', 20 );
}, 1 );

// Custom cart button
function custom_widget_shopping_cart_button_view_cart() {
    $original_link = wc_get_cart_url();
    $custom_link = home_url( '/cart' ); // HERE replacing cart link
    echo '<a href="' . esc_url( $custom_link ) . '" class="button wc-forward">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}

// Custom Checkout button
function custom_widget_shopping_cart_proceed_to_checkout() {
    $original_link = wc_get_checkout_url();
    $custom_link = home_url( '/checkout/?id=1' ); // HERE replacing checkout link
    echo '<a href="' . esc_url( $custom_link ) . '" class="button checkout wc-forward">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}