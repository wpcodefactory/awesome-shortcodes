<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Abstract
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Abstract_Awesome_Shortcodes_Pack' ) ) :

class Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) shortcode inside shortcode (content and atts)
	 * @todo    (maybe) check `wpautop` issue
	 */
	function __construct() {
		if ( ! alg_awesome_shortcodes()->core->plugin_enabled  ) {
			return;
		}
		foreach ( $this->shortcodes as $shortcode_tag => $shortcode ) {
			if (
				! isset( alg_awesome_shortcodes()->core->shortcodes_options[ $shortcode_tag ] ) ||
				false === alg_awesome_shortcodes()->core->shortcodes_options[ $shortcode_tag ]
			) {
				continue;
			}
			add_shortcode( alg_awesome_shortcodes()->core->prefix . $shortcode_tag, array( $this, 'awesome_shortcode' ) );
			$this->func[ $shortcode_tag ] = ( isset( $shortcode['func'] ) ? $shortcode['func'] : $shortcode_tag );
			if ( isset( $shortcode['aliases'] ) ) {
				foreach ( $shortcode['aliases'] as $alias ) {
					add_shortcode( alg_awesome_shortcodes()->core->prefix . $alias, array( $this, 'awesome_shortcode' ) );
					$this->func[ $alias ] = $this->func[ $shortcode_tag ];
				}
			}
		}
	}

	/**
	 * awesome_shortcode.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) language, location, site_visibility, user_visibility etc.
	 */
	function awesome_shortcode( $atts, $content, $tag, $func = '' ) {
		$default_atts = array(
			'before'    => '',
			'after'     => '',
			'on_empty'  => '',
		);
		$prefix_len   = strlen( alg_awesome_shortcodes()->core->prefix );
		$original_tag = ( 0 != $prefix_len ? substr( $tag, $prefix_len ) : $tag );
		if ( isset( $this->shortcodes[ $original_tag ]['atts'] ) ) {
			foreach ( $this->shortcodes[ $original_tag ]['atts'] as $att => $att_data ) {
				$default_atts[ $att ] = $att_data['default'];
			}
		}
		$atts   = shortcode_atts( $default_atts, $atts, $original_tag );
		$func   = ( '' == $func ? $this->func[ $original_tag ] : $func );
		$output = $this->$func( $atts, $content, $original_tag );
		return ( '' === $output ? $atts['on_empty'] : $atts['before'] . $output . $atts['after'] );
	}

}

endif;
