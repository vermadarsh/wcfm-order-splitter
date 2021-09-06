<?php
/**
 * The file that defines the public plugin class.
 *
 * A class definition that holds all the hooks regarding all the functionalities that happen in the public.
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
 * A class definition that holds all the hooks regarding all the functionalities that happen in the public.
 *
 * @since      1.0.0
 * @package    WCFMOS_Order_Splitter
 * @author     Adarsh Verma <adarsh@cmsminds.com>
 */
class WCFMOS_Order_Splitter_Public {
	/**
	 * Load all the public hooks here.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'wcfmos_wp_enqueue_scripts_callback' ) );
		add_action( 'wp', array( $this, 'wcfmos_wp_callback' ) );
	}

	/**
	 * Enqueue scripts for public end.
	 */
	public function wcfmos_wp_enqueue_scripts_callback() {
		// Custom public style.
		wp_enqueue_style(
			'wcfmos-public-style',
			WCFMOS_PLUGIN_URL . 'assets/public/css/wcfmos-public.css',
			array(),
			filemtime( WCFMOS_PLUGIN_PATH . 'assets/public/css/wcfmos-public.css' ),
		);

		// Custom public script.
		wp_enqueue_script(
			'wcfmos-public-script',
			WCFMOS_PLUGIN_URL . 'assets/public/js/wcfmos-public.js',
			array( 'jquery' ),
			filemtime( WCFMOS_PLUGIN_PATH . 'assets/public/js/wcfmos-public.js' ),
			true
		);

		// Localize public script.
		wp_localize_script(
			'wcfmos-public-script',
			'WCFMOS_Public_JS_Vars',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Split the orders as soon they're placed.
	 */
	public function wcfmos_wp_callback() {
		wcfmos_split_order( 11 );
	}
}
