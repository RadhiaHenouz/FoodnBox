<?php
if ( ! defined( 'ABSPATH' ) ) { 
	exit; // restict for direct access
}

/*
 * Plugin Name:       Addify Private Shop
 * Plugin URI:        http://www.addifypro.com
 * Description:       Ability to set password on whole store,specfic categories or products.
 * Version:           2.0.0
 * Author:            Addify
 * Developed By:  	  Addify
 * Author URI:        http://www.addifypro.com
 * Support:		  	  http://www.addifypro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * Text Domain:       addify_ps
 */


/**
 * Check if WooCommerce is installed and active.
 **/


if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    
    function my_admin_notice() {

        // Deactivate the plugin
           deactivate_plugins(__FILE__);
            
          echo '<div id="message" class="error">
            <p><strong>Addify - Private Shop is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';

}
add_action( 'admin_notices', 'my_admin_notice' );
}


if ( !class_exists( 'Addify_Private_Shop' ) ) {

	class Addify_Private_Shop {
		function __construct() {

			//register_activation_hook( __FILE__, array( $this, 'install_settings' ) );

			//register_deactivation_hook( __FILE__, array( $this, 'uninstall_settings' ));

			add_action( 'wp_loaded', array( $this, 'main_init' ) );
			$this->constant_vars();

			if ( is_admin() ) {
				require(addify_ps_plugindir.'admin_class.php');
			} else {
				require(addify_ps_plugindir.'front_class.php');
			}
		}


		function main_init() {
	        if ( function_exists( 'load_plugin_textdomain' ) )
	            load_plugin_textdomain( 'addify_ps', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	   	}
		
		function constant_vars() {


            if ( !defined( 'addify_ps_url' ) )
                define( 'addify_ps_url', plugin_dir_url( __FILE__ ) );

            if ( !defined( 'addify_ps_basename' ) )
                define( 'addify_ps_basename', plugin_basename( __FILE__ ) );

            if ( ! defined( 'addify_ps_plugindir' ) )
                define( 'addify_ps_plugindir', plugin_dir_path( __FILE__ ) );
        }

        

        

		




	}

	new Addify_Private_Shop();

}