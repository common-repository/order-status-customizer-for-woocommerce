<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.novarumsoftware.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_Status_Customizer
 * @subpackage Woocommerce_Order_Status_Customizer/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Order_Status_Customizer
 * @subpackage Woocommerce_Order_Status_Customizer/includes
 * @author     Novarum <team@novarumsoftware.com>
 */
class Woocommerce_Order_Status_Customizer_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-order-status-customizer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
