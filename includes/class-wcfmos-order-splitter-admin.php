<?php
/**
 * The file that defines the admin plugin class.
 *
 * A class definition that holds all the hooks regarding all the functionalities that happen in the admin.
 *
 * @link       https://github.com/vermadarsh/
 * @since      1.0.0
 *
 * @package    WCFMOS_Order_Splitter
 * @subpackage WCFMOS_Order_Splitter/includes
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * The core plugin class.
 *
 * A class definition that holds all the hooks regarding all the functionalities that happen in the admin.
 *
 * @since      1.0.0
 * @package    WCFMOS_Order_Splitter
 * @author     Adarsh Verma <adarsh@cmsminds.com>
 */
class WCFMOS_Order_Splitter_Admin {
	/**
	 * Load all the admin hooks here.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'wcfmos_admin_enqueue_scripts_callback' ) );
	}

	/**
	 * Enqueue scripts for admin end.
	 */
	public function wcfmos_admin_enqueue_scripts_callback() {
		// Custom admin style.
		wp_enqueue_style(
			'wcfmos-admin-style',
			WCFMOS_PLUGIN_URL . 'assets/admin/css/wcfmos-admin.css',
			array(),
			filemtime( WCFMOS_PLUGIN_PATH . 'assets/admin/css/wcfmos-admin.css' ),
		);

		// Custom admin script.
		wp_enqueue_script(
			'wcfmos-admin-script',
			WCFMOS_PLUGIN_URL . 'assets/admin/js/wcfmos-admin.js',
			array( 'jquery' ),
			filemtime( WCFMOS_PLUGIN_PATH . 'assets/admin/js/wcfmos-admin.js' ),
			true
		);

		// Localize admin script.
		wp_localize_script(
			'wcfmos-admin-script',
			'WCFMOS_Admin_JS_Vars',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}
