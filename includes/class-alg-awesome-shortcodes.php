<?php
/**
 * Awesome Shortcodes - Shortcodes - Main Class
 *
 * @version 1.7.0
 * @since   1.0.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_Awesome_Shortcodes' ) ) :

final class Alg_Awesome_Shortcodes {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	public $version = ALG_AWESOME_SHORTCODES_VERSION;

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
	 *
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
	 * @version 1.7.0
	 * @since   1.0.0
	 *
	 * @access  public
	 */
	function __construct() {

		// Set up localisation
		add_action( 'init', array( $this, 'localize' ) );

		// Include required files
		$this->includes();

		// Admin
		if ( is_admin() ) {
			$this->admin();
		}

	}

	/**
	 * localize.
	 *
	 * @version 1.7.0
	 * @since   1.7.0
	 */
	function localize() {
		load_plugin_textdomain( 'awesome-shortcodes', false, dirname( plugin_basename( ALG_AWESOME_SHORTCODES_FILE ) ) . '/langs/' );
	}

	/**
	 * includes.
	 *
	 * @version 1.7.0
	 * @since   1.7.0
	 */
	function includes() {
		// Core
		$this->core = require_once( 'class-alg-awesome-shortcodes-core.php' );
	}

	/**
	 * admin.
	 *
	 * @version 1.7.0
	 * @since   1.7.0
	 */
	function admin() {
		// Action links
		add_filter( 'plugin_action_links_' . plugin_basename( ALG_AWESOME_SHORTCODES_FILE ), array( $this, 'action_links' ) );
		// Version update
		if ( get_option( 'alg_awesome_shortcodes_version', '' ) !== $this->version ) {
			add_action( 'admin_init', array( $this, 'version_updated' ) );
		}
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 *
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array( '<a href="' . admin_url( 'options-general.php?page=awesome-shortcodes' ) . '">' . __( 'Settings', 'awesome-shortcodes' ) . '</a>' );
		return array_merge( $custom_links, $links );
	}

	/**
	 * version_updated.
	 *
	 * @version 1.7.0
	 * @since   1.7.0
	 */
	function version_updated() {
		update_option( 'alg_awesome_shortcodes_version', $this->version );
	}

	/**
	 * Get the plugin url.
	 *
	 * @version 1.7.0
	 * @since   1.0.0
	 *
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( ALG_AWESOME_SHORTCODES_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @version 1.7.0
	 * @since   1.0.0
	 *
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( ALG_AWESOME_SHORTCODES_FILE ) );
	}

	/**
	 * Get the plugin file.
	 *
	 * @version 1.7.0
	 * @since   1.0.0
	 */
	function plugin_file() {
		return ALG_AWESOME_SHORTCODES_FILE;
	}

}

endif;
