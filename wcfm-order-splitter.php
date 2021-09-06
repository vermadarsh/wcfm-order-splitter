<?php
/**
 * The plugin bootstrap file.
 *
 * @link              https://github.com/vermadarsh/
 * @since             1.0.0
 * @package           WCFM_Order_Splitter
 *
 * @wordpress-plugin
 * Plugin Name:       WCFM Order Splitter
 * Plugin URI:        https://github.com/vermadarsh/
 * Description:       This plugin is responsible for splitting orders from from multiple vendors.
 * Version:           1.0.0
 * Author:            Adarsh Verma
 * Author URI:        https://github.com/vermadarsh/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wcfm-order-splitter
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCFMOS_PLUGIN_VERSION', '1.0.0' );

// Plugin path.
if ( ! defined( 'WCFMOS_PLUGIN_PATH' ) ) {
	define( 'WCFMOS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

// Plugin URL.
if ( ! defined( 'WCFMOS_PLUGIN_URL' ) ) {
	define( 'WCFMOS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * This code runs during the plugin activation.
 * This code is documented in includes/class-wcfmos-order-splitter-activator.php
 */
function activate_wcfm_order_splitter() {
	require 'includes/class-wcfmos-order-splitter-activator.php';
	WCFMOS_Order_Splitter_Activator::run();
}

register_activation_hook( __FILE__, 'activate_wcfm_order_splitter' );

/**
 * This code runs during the plugin deactivation.
 * This code is documented in includes/class-wcfmos-order-splitter-deactivator.php
 */
function deactivate_wcfm_order_splitter() {
	require 'includes/class-wcfmos-order-splitter-deactivator.php';
	WCFMOS_Order_Splitter_Deactivator::run();
}

register_deactivation_hook( __FILE__, 'deactivate_wcfm_order_splitter' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wcfm_order_splitter() {
	// This file holds all the custom reusable functions.
	require_once 'includes/wcfmos-functions.php';

	// The core plugin class that is used to define internationalization and admin-specific hooks.
	require_once 'includes/class-wcfmos-order-splitter-admin.php';
	new WCFMOS_Order_Splitter_Admin();

	// The core plugin class that is used to define internationalization and public-specific hooks.
	require_once 'includes/class-wcfmos-order-splitter-public.php';
	new WCFMOS_Order_Splitter_Public();
}

/**
 * This initiates the plugin.
 * Checks for the required plugins to be installed and active.
 */
function wcfmos_plugins_loaded_callback() {
	run_wcfm_order_splitter();
}

add_action( 'plugins_loaded', 'wcfmos_plugins_loaded_callback' );
