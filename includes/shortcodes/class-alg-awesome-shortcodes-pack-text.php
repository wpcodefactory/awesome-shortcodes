<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Text
 *
 * @version 1.2.1
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
	 * @version 1.2.1
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id         = 'text';
		$this->title      = __( 'Text', 'awesome-shortcodes' );
		$this->desc       = __( 'Text shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'details' => array(
				'desc'             => sprintf( __( 'Creates an interactive widget that user can open and close. Uses HTML %s tag (%s).', 'awesome-shortcodes' ),
					'<code>&lt;details&gt;</code>', '<a target="_blank" href="https://www.w3schools.com/tags/tag_details.asp">https://www.w3schools.com/tags/tag_details.asp</a>' ),
				'type'             => 'enclosing',
				'atts'             => array(
					'summary' => array(
						'default'  => '',
						'desc'     => __( 'Visible heading. The heading can be clicked to view/hide the details.', 'awesome-shortcodes' ),
						'required' => true,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'summary' => __( 'Show Text', 'awesome-shortcodes' ) ),
						'content' => '<p>' . __( 'This text will be hidden, until the user clicks on summary.', 'awesome-shortcodes' ) . '</p>',
					),
				),
			),
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
	 * details.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 */
	function details( $atts, $content, $tag ) {
		return ( '' === $atts['summary'] ? '' : '<details>' . '<summary>' . $atts['summary'] . '</summary>' . $content . '</details>' );
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
