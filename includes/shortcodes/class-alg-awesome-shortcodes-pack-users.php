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
			'user_firstname' => array(
				'desc'             => __( 'Displays logged user name. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => __( 'Howdy, Stranger!', 'awesome-shortcodes' ),
							'before'   => __( 'Howdy, ', 'awesome-shortcodes' ),
							'after'    => __( '!', 'awesome-shortcodes' ),
						),
					),
				),
			),
		);
		parent::__construct();
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
