<?php
/**
 * Copyright © Lyra Network and contributors.
 * This file is part of Systempay plugin for WooCommerce. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @author    Geoffrey Crofte, Alsacréations (https://www.alsacreations.fr/)
 * @copyright Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * Plugin Name: WooCommerce Systempay Payment
 * Description: This plugin links your WordPress WooCommerce shop to the payment gateway.
 * Author: Lyra Network
 * Contributors: Alsacréations (Geoffrey Crofte http://alsacreations.fr/a-propos#geoffrey)
 * Version: 1.8.9
 * Author URI: https://www.lyra.com/
 * License: GPLv2 or later
 * Requires at least: 3.5
 * Tested up to: 5.6
 * WC requires at least: 2.0
 * WC tested up to: 4.8
 *
 * Text Domain: woo-systempay-payment
 * Domain Path: /languages/
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('WC_SYSTEMPAY_PLUGIN_URL', plugin_dir_url(__FILE__));

/* A global var to easily enable/disable features. */
global $systempay_plugin_features;

$systempay_plugin_features = array(
    'qualif' => false,
    'prodfaq' => true,
    'restrictmulti' => false,
    'shatwo' => true,
    'embedded' => true,
    'subscr' => false,

    'multi' => true,
    'choozeo' => true,
    'klarna' => false
);

/* Check requirements. */
function woocommerce_systempay_activation()
{
    $all_active_plugins = get_option('active_plugins');
    if (is_multisite()) {
        $all_active_plugins = array_merge($all_active_plugins, wp_get_active_network_plugins());
    }

    $all_active_plugins = apply_filters('active_plugins', $all_active_plugins);

    if (! stripos(implode($all_active_plugins), '/woocommerce.php')) {
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate ourself.

        // Load translation files.
        load_plugin_textdomain('woo-systempay-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

        $message = sprintf(__('Sorry ! In order to use WooCommerce %s Payment plugin, you need to install and activate the WooCommerce plugin.', 'woo-systempay-payment'), 'Systempay');
        wp_die($message, 'WooCommerce Systempay Payment', array('back_link' => true));
    }
}
register_activation_hook(__FILE__, 'woocommerce_systempay_activation');

/* Delete all data when uninstalling plugin. */
function woocommerce_systempay_uninstallation()
{
    delete_option('woocommerce_systempay_settings');
    delete_option('woocommerce_systempaystd_settings');
    delete_option('woocommerce_systempaymulti_settings');
    delete_option('woocommerce_systempaychoozeo_settings');
    delete_option('woocommerce_systempayklarna_settings');
    delete_option('woocommerce_systempayregroupedother_settings');
    delete_option('woocommerce_systempaysubscription_settings');
}
register_uninstall_hook(__FILE__, 'woocommerce_systempay_uninstallation');

/* Include gateway classes. */
function woocommerce_systempay_init()
{
    global $systempay_plugin_features;

    // Load translation files.
    load_plugin_textdomain('woo-systempay-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

    if (! class_exists('Systempay_Subscriptions_Loader')) { // Load subscriptions processing mecanism.
        require_once 'includes/subscriptions/systempay-subscriptions-loader.php';
    }

    if (! class_exists('WC_Gateway_Systempay')) {
        require_once 'class-wc-gateway-systempay.php';
    }

    if (! class_exists('WC_Gateway_SystempayStd')) {
        require_once 'class-wc-gateway-systempaystd.php';
    }

    if ($systempay_plugin_features['multi'] && ! class_exists('WC_Gateway_SystempayMulti')) {
        require_once 'class-wc-gateway-systempaymulti.php';
    }

    if ($systempay_plugin_features['choozeo'] && ! class_exists('WC_Gateway_SystempayChoozeo')) {
        require_once 'class-wc-gateway-systempaychoozeo.php';
    }

    if ($systempay_plugin_features['klarna'] && ! class_exists('WC_Gateway_SystempayKlarna')) {
        require_once 'class-wc-gateway-systempayklarna.php';
    }

    if (! class_exists('WC_Gateway_SystempayRegroupedOther')) {
        require_once 'class-wc-gateway-systempayregroupedother.php';
    }

    if (! class_exists('WC_Gateway_SystempayOther')) {
        require_once 'class-wc-gateway-systempayother.php';
    }

    if ($systempay_plugin_features['subscr'] && ! class_exists('WC_Gateway_SystempaySubscription')) {
        require_once 'class-wc-gateway-systempaysubscription.php';
    }

    require_once 'includes/SystempayRequest.php';
    require_once 'includes/SystempayResponse.php';
    require_once 'includes/SystempayRest.php';
    require_once 'includes/SystempayRestTools.php';
}
add_action('woocommerce_init', 'woocommerce_systempay_init');

/* Add our payment methods to woocommerce methods. */
function woocommerce_systempay_add_method($methods)
{
    global $systempay_plugin_features, $woocommerce;

    $methods[] = 'WC_Gateway_Systempay';
    $methods[] = 'WC_Gateway_SystempayStd';

    if ($systempay_plugin_features['multi']) {
        $methods[] = 'WC_Gateway_SystempayMulti';
    }

    if ($systempay_plugin_features['choozeo']) {
        $methods[] = 'WC_Gateway_SystempayChoozeo';
    }

    if ($systempay_plugin_features['klarna']) {
        $methods[] = 'WC_Gateway_SystempayKlarna';
    }

    $methods[] = 'WC_Gateway_SystempayRegroupedOther';

    // Since 2.3.0, we can display other payment means as submodules.
    if (version_compare($woocommerce->version, '2.3.0', '>=') && $woocommerce->cart) {
        $regrouped_other_payments = new WC_Gateway_SystempayRegroupedOther();

        if (! $regrouped_other_payments->regroup_other_payment_means()) {
            $payment_means = $regrouped_other_payments->get_available_options();
            if (is_array($payment_means) && ! empty($payment_means)) {
                foreach ($payment_means as $option) {
                    $methods[] = new WC_Gateway_SystempayOther($option['payment_mean'], $option['label']);
                }
            }
        }
    }

    if ($systempay_plugin_features['subscr']) {
        $methods[] = 'WC_Gateway_SystempaySubscription';
    }

    return $methods;
}
add_filter('woocommerce_payment_gateways', 'woocommerce_systempay_add_method');

/* Add a link to plugin settings page from plugins list. */
function woocommerce_systempay_add_link($links, $file)
{
    global $systempay_plugin_features;

    $links[] = '<a href="' . systempay_admin_url('Systempay') . '">' . __('General configuration', 'woo-systempay-payment') . '</a>';
    $links[] = '<a href="' . systempay_admin_url('SystempayStd') . '">' . __('Standard payment', 'woo-systempay-payment') . '</a>';

    if ($systempay_plugin_features['multi']) {
        $links[] = '<a href="' . systempay_admin_url('SystempayMulti') . '">' . __('Payment in installments', 'woo-systempay-payment')
            . '</a>';
    }

    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'woocommerce_systempay_add_link', 10, 2);

function systempay_admin_url($id)
{
    global $woocommerce;

    $base_url = 'admin.php?page=wc-settings&tab=checkout&section=';
    $section = strtolower($id); // Method id in lower case.

    // Backward compatibility.
    if (version_compare($woocommerce->version, '2.1.0', '<')) {
        $base_url = 'admin.php?page=woocommerce_settings&tab=payment_gateways&section=';
        $section = 'WC_Gateway_' . $id; // Class name as it is.
    } elseif (version_compare($woocommerce->version, '2.6.2', '<')) {
        $section = 'wc_gateway_' . $section; // Class name in lower case.
    }

    return admin_url($base_url . $section);
}

function woocommerce_systempay_order_payment_gateways($available_gateways)
{
    global $woocommerce;
    $index_other_not_grouped_gateways_ids = array();
    $index_other_grouped_gateway_id = null;
    $gateways_ids = array();
    $index_gateways_ids = 0;
    foreach ($woocommerce->payment_gateways()->payment_gateways as $gateway) {
        if ($gateway->id === 'systempayregroupedother') {
            $index_other_grouped_gateway_id = $index_gateways_ids;
        } elseif (strpos($gateway->id, 'systempayother_') === 0) {
            $index_other_not_grouped_gateways_ids[] = $index_gateways_ids;
        }

        $gateways_ids[] = $gateway->id;
        $index_gateways_ids ++;
    }

    // User created systempay not grouped other payment means lets reorder payment gatways as they appear in woocommerce backend.
    // And if only they are not already in last position.
    if (! empty($index_other_not_grouped_gateways_ids) && ($index_other_grouped_gateway_id !== reset($index_other_not_grouped_gateways_ids) - 1)) {
        $ordered_gateways_ids = array();
        for ($i = 0; $i < $index_other_grouped_gateway_id; $i++) {
            $ordered_gateways_ids[] = $gateways_ids[$i];
        }

        foreach ($index_other_not_grouped_gateways_ids as $index_not_grouped_other_id) {
            $ordered_gateways_ids[] = $gateways_ids[$index_not_grouped_other_id];
        }

        for ($i = $index_other_grouped_gateway_id + 1; $i < count($gateways_ids); $i++) {
            if (! in_array($i, $index_other_not_grouped_gateways_ids)) {
                $ordered_gateways_ids[] = $gateways_ids[$i];
            }
        }

        $ordered_gateways = array();
        foreach ($ordered_gateways_ids as $gateway_id) {
            if (isset($available_gateways[$gateway_id])) {
                $ordered_gateways[$gateway_id] = $available_gateways[$gateway_id];
            }
        }

        return $ordered_gateways;
    }

    return $available_gateways;
}
add_filter('woocommerce_available_payment_gateways', 'woocommerce_systempay_order_payment_gateways');

/* Retrieve blog_id from post when this is an IPN URL call. */
if (is_multisite() && key_exists('vads_hash', $_POST) && $_POST['vads_hash']
    && key_exists('vads_order_info', $_POST) && $_POST['vads_order_info']) {
    global $wpdb, $current_blog, $current_site;

    // Parse order_info parameter.
    $parts = explode('&', $_POST['vads_order_info']);

    $blog = substr($parts[1], strlen('blog_id='));
    switch_to_blog((int)$blog);

    // Set current_blog global var.
    $current_blog = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $wpdb->blogs WHERE blog_id = %s", $blog)
    );

    // Set current_site global var.
    $network_fnc = function_exists('get_network') ? 'get_network' : 'wp_get_network';
    $current_site = $network_fnc($current_blog->site_id);
    $current_site->blog_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT blog_id FROM $wpdb->blogs WHERE domain = %s AND path = %s",
            $current_site->domain,
            $current_site->path
        )
    );

    $current_site->site_name = get_site_option('site_name');
    if (! $current_site->site_name) {
        $current_site->site_name = ucfirst($current_site->domain);
    }
}
