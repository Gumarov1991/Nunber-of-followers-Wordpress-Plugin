<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://number-of-followers.com/author
 * @since      1.0.0
 *
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Number_Of_Followers
 * @subpackage Number_Of_Followers/includes
 * @author     Breakout Studio <gumarov2017@yandex.ru>
 */
class Number_Of_Followers_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'number-of-followers',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
