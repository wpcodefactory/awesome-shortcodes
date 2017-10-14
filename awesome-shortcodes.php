<?php
/*
Plugin Name: Awesome Shortcodes
Plugin URI: https://awesomeshortcodes.com/
Description: Awesome shortcodes.
Version: 1.4.2-dev
Author: Algoritmika Ltd
Author URI: http://algoritmika.com
Text Domain: awesome-shortcodes
Domain Path: /langs
Copyright: © 2017 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_Awesome_Shortcodes' ) ) :

/**
 * Main Alg_Awesome_Shortcodes Class
 *
 * @class   Alg_Awesome_Shortcodes
 * @version 1.0.0
 * @since   1.0.0
 */
final class Alg_Awesome_Shortcodes {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	public $version = '1.4.2-dev-201710141758';

	/**
	 * @var   Alg_Awesome_Shortcodes The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_Awesome_Shortcodes Instance
	 *
	 * Ensures only one instance of Alg_Awesome_Shortcodes is loaded or can be loaded.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @static
	 * @return  Alg_Awesome_Shortcodes - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_Awesome_Shortcodes Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @access  public
	 */
	function __construct() {

		// Save version
		if ( is_admin() && get_option( 'alg_awesome_shortcodes_version', '' ) !== $this->version ) {
			update_option( 'alg_awesome_shortcodes_version', $this->version );
		}

		// Set up localisation
		load_plugin_textdomain( 'awesome-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

		// Core
		$this->core = require_once( 'includes/class-alg-awesome-shortcodes-core.php' );

		// Action Links
		if ( is_admin() ) {
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}

	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array( '<a href="' . admin_url( 'options-general.php?page=awesome-shortcodes' ) . '">' .
			__( 'Settings', 'awesome-shortcodes' ) . '</a>' );
		return array_merge( $custom_links, $links );
	}

	/**
	 * Get the plugin url.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the plugin file.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function plugin_file() {
		return __FILE__;
	}

}

endif;

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
