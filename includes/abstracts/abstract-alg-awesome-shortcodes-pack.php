<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Abstract
 *
 * @version 1.5.2
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
	 * @version 1.3.1
	 * @since   1.0.0
	 * @todo    (maybe) check `wpautop` issue
	 */
	function __construct() {
		if ( ! alg_awesome_shortcodes()->core->plugin_enabled  ) {
			return;
		}
		$this->shortcodes = apply_filters( 'awesome_shortcodes_pack_' . $this->id, $this->shortcodes );
		foreach ( $this->shortcodes as $shortcode_tag => $shortcode ) {
			if (
				! isset( alg_awesome_shortcodes()->core->shortcodes_options[ $shortcode_tag ] ) ||
				false === alg_awesome_shortcodes()->core->shortcodes_options[ $shortcode_tag ]
			) {
				continue;
			}
			add_shortcode( alg_awesome_shortcodes()->core->prefix . $shortcode_tag, array( $this, 'awesome_shortcode' ) );
			$this->func[ $shortcode_tag ] = ( isset( $shortcode['func'] ) ? $shortcode['func'] : array( $this, $shortcode_tag ) );
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
	 * @version 1.5.2
	 * @since   1.0.0
	 * @todo    (maybe) location, site_visibility, user_visibility etc.
	 */
	function awesome_shortcode( $atts, $content, $tag, $func = '' ) {
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			if ( isset( $atts['lang'] ) && ! empty( $atts['lang'] ) ) {
				$lang = array_map( 'trim', explode( ',', $atts['lang'] ) );
				if ( ! in_array( ICL_LANGUAGE_CODE, $lang ) ) {
					return '';
				}
			}
			if ( isset( $atts['not_lang'] ) && ! empty( $atts['not_lang'] ) ) {
				$lang = array_map( 'trim', explode( ',', $atts['not_lang'] ) );
				if ( in_array( ICL_LANGUAGE_CODE, $lang ) ) {
					return '';
				}
			}
		}
		if ( isset( $atts['do_shortcode_atts'] ) && ! empty( $atts['do_shortcode_atts'] ) ) {
			$do_shortcode_atts = array_map( 'trim', explode( ',', $atts['do_shortcode_atts'] ) );
			foreach ( $atts as $att_key => $att_value ) {
				if ( in_array( $att_key, $do_shortcode_atts ) ) {
					$atts[ $att_key ] = do_shortcode( str_replace( array( '{', '}' ), array( '[', ']' ), $att_value ) );
				}
			}
		}
		if ( isset( $atts['do_shortcode_content'] ) && 'yes' === $atts['do_shortcode_content'] ) {
			$content = do_shortcode( $content );
		}
		$default_atts = array(
			'before'       => '',
			'after'        => '',
			'on_empty'     => '',
			'on_zero'      => 0,
			'strip_tags'   => 'no',
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
		$output = ( is_array( $func ) ? $func[0]->{$func[1]}( $atts, $content, $original_tag ) : $func( $atts, $content, $original_tag ) );
		if ( 'yes' === $atts['strip_tags'] ) {
			$output = strip_tags( $output );
		}
		switch ( true ) {
			case '' === $output:
				return $atts['on_empty'];
			case 0 === $output:
				return $atts['on_zero'];
			default:
				return $atts['before'] . $output . $atts['after'];
		}
	}

}

endif;
