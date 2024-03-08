<?php
/*
Plugin Name: Awesome Shortcodes
Plugin URI: https://awesomeshortcodes.com/
Description: Awesome shortcodes.
Version: 1.7.2-dev
Author: WPFactory
Author URI: https://wpfactory.com
Text Domain: awesome-shortcodes
Domain Path: /langs
*/

defined( 'ABSPATH' ) || exit;

defined( 'ALG_AWESOME_SHORTCODES_VERSION' ) || define( 'ALG_AWESOME_SHORTCODES_VERSION', '1.7.2-dev-20240308-1214' );

defined( 'ALG_AWESOME_SHORTCODES_FILE' ) || define( 'ALG_AWESOME_SHORTCODES_FILE', __FILE__ );

require_once( 'includes/class-alg-awesome-shortcodes.php' );

if ( ! function_exists( 'alg_awesome_shortcodes' ) ) {
	/**
	 * Returns the main instance of Alg_Awesome_Shortcodes to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function alg_awesome_shortcodes() {
		return Alg_Awesome_Shortcodes::instance();
	}
}

add_action( 'plugins_loaded', 'alg_awesome_shortcodes' );
