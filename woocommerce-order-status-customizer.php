<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.novarumsoftware.com
 * @since             1.0.0
 * @package           Woocommerce_Order_Status_Customizer
 *
 * @wordpress-plugin
 * Plugin Name:       Order Status Customizer for Woocommerce
 * Plugin URI:        https://plugins.novarumsoftware.com/?product=order-status-rules-for-woocommerce
 * Description:       This plugin allows you to define custom order status values and rules for woocommerce
 * Version:           1.1.4
 * Author:            novarum
 * Author URI:        https://www.novarumsoftware.com
 * Developer:         Halil Kabaca
 * Developer URI:     https://halilkabaca.com
 * Text Domain:       woocommerce-order-status-customizer
 * Domain Path:       /languages
 *
 * Woo: 12345:342928dfsfhsf8429842374wdf4234sfd
 * WC requires at least: 2.6.14
 * WC tested up to: 5.4
 *
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 */



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOMMERCE_ORDER_STATUS_CUSTOMIZER_VERSION', '1.1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-order-status-customizer-activator.php
 */
function activate_woocommerce_order_status_customizer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-status-customizer-activator.php';
	Woocommerce_Order_Status_Customizer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-order-status-customizer-deactivator.php
 */
function deactivate_woocommerce_order_status_customizer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-status-customizer-deactivator.php';
	Woocommerce_Order_Status_Customizer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_order_status_customizer' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_order_status_customizer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-order-status-customizer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_order_status_customizer() 
{

/**
 * Check if WooCommerce is active
**/
    
    if ( class_exists( 'WooCommerce' ) || class_exists( 'woocommerce' ) 
        || in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) 
       ) 
    {  
        $plugin = new Woocommerce_Order_Status_Customizer();
	    $plugin->run();
        
    }
}

run_woocommerce_order_status_customizer();
