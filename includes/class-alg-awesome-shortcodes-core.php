<?php
/**
 * Awesome Shortcodes - Shortcodes - Core
 *
 * @version 1.3.2
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Core' ) ) :

class Alg_Awesome_Shortcodes_Core {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) auto-generate readme description
	 */
	function __construct() {

		// Include required files
		$this->includes();

		// Load options
		$this->plugin_enabled     = ( 'yes' === get_option( 'alg_awesome_shortcodes_enabled', 'yes' ) );
		$this->prefix             = get_option( 'alg_awesome_shortcodes_prefix', '' );
		$this->shortcodes_options = get_option( 'alg_awesome_shortcodes_options', array() );

		// Shortcodes in text widgets
		if ( $this->plugin_enabled && 'yes' === get_option( 'alg_awesome_shortcodes_text_widgets_enabled', 'no' ) ) {
			add_filter( 'widget_text', 'do_shortcode' );
		}

		// Scripts and Styles
		if ( $this->plugin_enabled ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ) );
		}

		// Include packs
		add_action( 'init', array( $this, 'load_shortcode_packs' ), PHP_INT_MAX );
	}

	/**
	 * load_shortcode_packs.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 */
	function load_shortcode_packs() {
		$this->shortcode_packs[] = require_once( 'shortcodes/class-alg-awesome-shortcodes-pack-general.php' );
		$this->shortcode_packs[] = require_once( 'shortcodes/class-alg-awesome-shortcodes-pack-text.php' );
		$this->shortcode_packs[] = require_once( 'shortcodes/class-alg-awesome-shortcodes-pack-posts.php' );
		$this->shortcode_packs[] = require_once( 'shortcodes/class-alg-awesome-shortcodes-pack-users.php' );
		$this->shortcode_packs[] = require_once( 'shortcodes/class-alg-awesome-shortcodes-pack-woocommerce.php' );
		$this->shortcode_packs = apply_filters( 'awesome_shortcodes_packs', $this->shortcode_packs );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function includes() {
		// Abstracts
		require_once( 'abstracts/abstract-alg-awesome-shortcodes-pack.php' );
		// Functions
		require_once( 'functions/alg-awesome-shortcodes-functions.php' );
		// Admin
		require_once( 'admin/class-alg-awesome-shortcodes-admin-settings.php' );

	}

	/**
	 * enqueue_scripts_and_styles.
	 *
	 * @version 1.3.2
	 * @since   1.0.0
	 */
	function enqueue_scripts_and_styles() {
		foreach ( $this->shortcode_packs as $shortcode_pack ) {
			foreach ( $shortcode_pack->shortcodes as $shortcode_tag => $shortcode ) {
				if ( ! isset( $this->shortcodes_options[ $shortcode_tag ] ) || false === $this->shortcodes_options[ $shortcode_tag ] ) {
					continue;
				}
				if ( isset( $shortcode['enqueue_styles'] ) ) {
					foreach ( $shortcode['enqueue_styles'] as $enqueue_style ) {
						wp_enqueue_style(
							( isset( $enqueue_style['handle'] )  ? $enqueue_style['handle']  : 'alg-awesome-shortcodes-' . $shortcode_tag ),
							( isset( $enqueue_style['src'] )     ? alg_awesome_shortcodes()->plugin_url() . '/assets/' . $enqueue_style['src'] : '' ),
							( isset( $enqueue_style['deps'] )    ? $enqueue_style['deps']    : array() ),
							( isset( $enqueue_style['version'] ) ? $enqueue_style['version'] : alg_awesome_shortcodes()->version ),
							( isset( $enqueue_style['media'] )   ? $enqueue_style['media']   : 'all' )
						);
					}
				}
				if ( isset( $shortcode['enqueue_scripts'] ) ) {
					foreach ( $shortcode['enqueue_scripts'] as $enqueue_script ) {
						wp_enqueue_script(
							( isset( $enqueue_script['handle'] )    ? $enqueue_script['handle']    : 'alg-awesome-shortcodes-' . $shortcode_tag . '-script' ),
							( isset( $enqueue_script['src'] )       ? alg_awesome_shortcodes()->plugin_url() . '/assets/' . $enqueue_script['src'] : '' ),
							( isset( $enqueue_script['deps'] )      ? $enqueue_script['deps']      : array() ),
							( isset( $enqueue_script['version'] )   ? $enqueue_script['version']   : alg_awesome_shortcodes()->version ),
							( isset( $enqueue_script['in_footer'] ) ? $enqueue_script['in_footer'] : true )
						);
					}
				}
			}
		}
	}

}

endif;

return new Alg_Awesome_Shortcodes_Core();
