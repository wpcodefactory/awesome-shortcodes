<?php
/*
Plugin Name: Awesome Shortcodes
Plugin URI: https://awesomeshortcodes.com/
Description: Awesome shortcodes.
Version: 1.7.0-dev
Author: WPFactory
Author URI: https://wpfactory.com
Text Domain: awesome-shortcodes
Domain Path: /langs
*/

defined( 'ABSPATH' ) || exit;

require_once( 'includes/class-alg-awesome-shortcodes.php' );

if ( ! function_exists( 'alg_awesome_shortcodes' ) ) {
	/**
	 * Returns the main instance of Alg_Awesome_Shortcodes to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_Awesome_Shortcodes
	 */
	function alg_awesome_shortcodes() {
		return Alg_Awesome_Shortcodes::instance();
	}
}

alg_awesome_shortcodes();
