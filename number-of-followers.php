<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://number-of-followers.com/author
 * @since             1.0.0
 * @package           Number_Of_Followers
 *
 * @wordpress-plugin
 * Plugin Name:       Number of followers
 * Plugin URI:        https://number-of-followers.com
 * Description:       Number of followers shows number of your profil followers.
 * Version:           1.0.0
 * Author:            Breakout Studio
 * Author URI:        https://number-of-followers.com/author
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       number-of-followers
 * Domain Path:       /languages
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
define( 'NUMBER_OF_FOLLOWERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-number-of-followers-activator.php
 */
function activate_number_of_followers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-number-of-followers-activator.php';
	Number_Of_Followers_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-number-of-followers-deactivator.php
 */
function deactivate_number_of_followers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-number-of-followers-deactivator.php';
	Number_Of_Followers_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_number_of_followers' );
register_deactivation_hook( __FILE__, 'deactivate_number_of_followers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-number-of-followers.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_number_of_followers() {

	$plugin = new Number_Of_Followers();
	$plugin->run();

}
run_number_of_followers();
