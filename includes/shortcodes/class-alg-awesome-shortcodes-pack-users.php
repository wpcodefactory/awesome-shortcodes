<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Users
 *
 * @version 1.1.1
 * @since   1.1.1
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_Users' ) ) :

class Alg_Awesome_Shortcodes_Pack_Users extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * current_user.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	private $current_user;

	/**
	 * Constructor.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	function __construct() {
		$this->id         = 'users';
		$this->title      = __( 'Users', 'awesome-shortcodes' );
		$this->desc       = __( 'Users shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'user_login' => array(
				'desc'             => __( 'Displays logged user login (i.e. username). If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => sprintf( __( 'You are not logged, please <a href=\'%s\'>login</a>.', 'awesome-shortcodes' ), '/wp-login.php' ),
							'before'   => sprintf( __( 'Logged as %s', 'awesome-shortcodes' ), '' ),
							'after'    => '.',
						),
					),
				),
			),
			'user_email' => array(
				'desc'             => __( 'Displays logged user email. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => sprintf( __( 'You are not logged, please <a href=\'%s\'>login</a>.', 'awesome-shortcodes' ), '/wp-login.php' ),
							'before'   => sprintf( __( 'Your email is %s', 'awesome-shortcodes' ), '' ),
							'after'    => __( '.', 'awesome-shortcodes' ),
						),
					),
				),
			),
			'user_firstname' => array(
				'desc'             => __( 'Displays logged user name. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => __( 'Howdy, Stranger!', 'awesome-shortcodes' ),
							'before'   => sprintf( __( 'Howdy, %s', 'awesome-shortcodes' ), '' ),
							'after'    => '!',
						),
					),
				),
			),
		);
		parent::__construct();
	}

	/**
	 * user_login.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 * @todo    (maybe) add `username` alias
	 */
	function user_login( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_login : '' );
	}

	/**
	 * user_email.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	function user_email( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_email : '' );
	}

	/**
	 * user_firstname.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	function user_firstname( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_firstname : '' );
	}

	/**
	 * get_current_user.
	 *
	 * @version 1.1.1
	 * @since   1.1.1
	 */
	private function get_current_user() {
		if ( ! isset( $this->current_user ) ) {
			$this->current_user = wp_get_current_user();
		}
		return $this->current_user;
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_Users();
