<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Text
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_Text' ) ) :

class Alg_Awesome_Shortcodes_Pack_Text extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id         = 'text';
		$this->desc       = __( 'Text', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'strikeout' => array(
				'desc'             => __( 'Strikeouts content.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'aliases'          => array( 'strikethrough', 'linethrough' ),
				'examples'         => array(
					array(
						'content' => __( 'This text will be striked out.', 'awesome-shortcodes' ),
					),
				),
			),
			'code' => array(
				'desc'             => sprintf( __( 'Wrap contents in %s tag. Useful for displaying a piece of computer code.', 'awesome-shortcodes' ), '&lt;code&gt;' ),
				'type'             => 'enclosing',
				'examples'         => array(
					array(
						'content' => 'echo "Hello world!";',
					),
				),
			),
			'text3d' => array(
				'desc'             => __( 'Creates 3D text with CSS.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'enqueue_styles'   => array( array( 'src' => 'css/text3d.css' ) ),
				'atts'             => array(
					'font_size' => array(
						'default'  => '',
						'desc'     => __( 'Font size.', 'awesome-shortcodes' ),
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'font_size' => '60px'
						),
						'content' => __( 'Text in 3D', 'awesome-shortcodes' ),
					),
				),
			),
			'flash' => array(
				'desc'             => __( 'Creates flashing text effect with CSS.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'enqueue_styles'   => array( array( 'src' => 'css/flash.css' ) ),
				'examples'         => array(
					array(
						'content' => __( 'Attention', 'awesome-shortcodes' ),
					),
				),
			),
		);
		parent::__construct();
	}

	/**
	 * flash.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) more atts
	 */
	function flash( $atts, $content, $tag ) {
		return '<div class="awesome-shortcode-flash">' . $content . '</div>';
	}

	/**
	 * strikeout.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function strikeout( $atts, $content, $tag ) {
		return '<span style="text-decoration:line-through;">' . $content . '</span>';
	}

	/**
	 * code.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function code( $atts, $content, $tag ) {
		return '<code>' . $content . '</code>';
	}

	/**
	 * text3d.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) more atts
	 * @todo    (maybe) `style` instead of `font_size`
	 */
	function text3d( $atts, $content, $tag ) {
		$style = ( '' != $atts['font_size'] ? ' style="font-size:' . $atts['font_size'] . ';"' : '' );
		return '<span class="awesome-shortcode-text3d"' . $style . '>' . $content . '</span>';
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_Text();
