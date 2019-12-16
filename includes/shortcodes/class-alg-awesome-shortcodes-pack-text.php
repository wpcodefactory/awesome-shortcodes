<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Text
 *
 * @version 1.6.0
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
	 * @version 1.6.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id         = 'text';
		$this->title      = __( 'Text', 'awesome-shortcodes' );
		$this->desc       = __( 'Text shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'is_user_role' => array(
				'desc'             => __( 'Shows text by user role.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'atts'             => array(
					'roles' => array(
						'default'  => '',
						'desc'     => __( 'User roles (comma separated).', 'awesome-shortcodes' ),
						'required' => true,
					),
					'fallback' => array(
						'default'  => '',
						'desc'     => __( 'Text visible to other user roles.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'roles' => 'customer', 'fallback' => __( 'This text is visible to other users.', 'awesome-shortcodes' ) ),
						'content' => __( 'This text is visible to customers.', 'awesome-shortcodes' ),
					),
				),
			),
			'is_user_logged_in' => array(
				'desc'             => __( 'Hides text from users who are not logged in.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'atts'             => array(
					'guest' => array(
						'default'  => '',
						'desc'     => __( 'Text visible to guest (i.e. not logged in) users.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'guest' => __( 'This text is visible to guests.', 'awesome-shortcodes' ) ),
						'content' => __( 'This text is visible to logged in users.', 'awesome-shortcodes' ),
					),
				),
			),
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
				'desc'             => sprintf( __( 'Wrap contents in %s tag. Useful for displaying a piece of computer code.', 'awesome-shortcodes' ), '<code>&lt;code&gt;</code>' ),
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
	 * is_user_role.
	 *
	 * @version 1.6.0
	 * @since   1.6.0
	 * @todo    [dev] (maybe) replace `super_admin` with `administrator`
	 * @todo    [dev] (maybe) empty value with `guest`
	 */
	function is_user_role( $atts, $content, $tag ) {
		if ( '' === $atts['roles'] ) {
			return '';
		}
		if ( ! function_exists( 'is_user_logged_in' ) || ! function_exists( 'wp_get_current_user' ) ) {
			return $atts['fallback'];
		}
		$roles     = array_map( 'trim', explode( ',', $atts['roles'] ) );
		$user      = wp_get_current_user();
		$intersect = array_intersect( $roles, $user->roles );
		return ( empty( $intersect ) ? $atts['fallback'] : $content );
	}

	/**
	 * is_user_logged_in.
	 *
	 * @version 1.6.0
	 * @since   1.6.0
	 */
	function is_user_logged_in( $atts, $content, $tag ) {
		return ( ! function_exists( 'is_user_logged_in' ) || ! function_exists( 'wp_get_current_user' ) || ! is_user_logged_in() ? $atts['guest'] : $content );
	}

	/**
	 * details.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 * @todo    [dev] (maybe) move to "Text Formatting" pack
	 */
	function details( $atts, $content, $tag ) {
		return ( '' === $atts['summary'] ? '' : '<details>' . '<summary>' . $atts['summary'] . '</summary>' . $content . '</details>' );
	}

	/**
	 * flash.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    [dev] (maybe) more atts
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
	 * @todo    [dev] (maybe) more atts
	 * @todo    [dev] (maybe) `style` instead of `font_size`
	 */
	function text3d( $atts, $content, $tag ) {
		$style = ( '' != $atts['font_size'] ? ' style="font-size:' . $atts['font_size'] . ';"' : '' );
		return '<span class="awesome-shortcode-text3d"' . $style . '>' . $content . '</span>';
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_Text();
