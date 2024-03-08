<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Users
 *
 * @version 1.7.2
 * @since   1.2.0
 *
 * @author  Algoritmika Ltd.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_Users' ) ) :

class Alg_Awesome_Shortcodes_Pack_Users extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * current_user.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 *
	 * @todo    add `is_user_logged_in` property (`is_user_logged_in()`)?
	 */
	private $current_user;

	/**
	 * Constructor.
	 *
	 * @version 1.7.2
	 * @since   1.2.0
	 */
	function __construct() {
		$this->id         = 'users';
		$this->title      = __( 'Users', 'awesome-shortcodes' );
		$this->desc       = __( 'Users shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'total_users' => array(
				'desc'             => __( 'Shortcode displays the count of users having each role, or the count of all users.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'role' => array(
						'default'  => '',
						'desc'     => __( 'User role to count users for. If empty - total count of all users is displayed.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'before'   => sprintf( __( 'Total users: %s', 'awesome-shortcodes' ), '' ),
						),
					),
					array(
						'atts'    => array(
							'role'     => 'customer',
							'before'   => sprintf( __( 'Total customers: %s', 'awesome-shortcodes' ), '' ),
							'on_zero'  => __( 'No customers.', 'awesome-shortcodes' ),
						),
					),
				),
			),
			'user_ip' => array(
				'desc'             => __( 'Displays current user IP.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'before'   => sprintf( __( 'Your IP: %s', 'awesome-shortcodes' ), '' ),
						),
					),
				),
			),
			'user_location' => array(
				'desc'             => __( 'Displays current user location (i.e., country).', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'before'   => sprintf( __( 'Your country: %s', 'awesome-shortcodes' ), '' ),
						),
					),
				),
			),
			'user_login' => array(
				'desc'             => __( 'Displays current user login (i.e., username). If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
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
				'desc'             => __( 'Displays current user email. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
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
			'user_first_name' => array(
				'desc'             => __( 'Displays current user first name. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
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
			'user_last_name' => array(
				'desc'             => __( 'Displays current user last name. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => __( 'Howdy, Mr. Stranger!', 'awesome-shortcodes' ),
							'before'   => sprintf( __( 'Howdy, Mr. %s', 'awesome-shortcodes' ), '' ),
							'after'    => '!',
						),
					),
				),
			),
			'user_display_name' => array(
				'desc'             => __( 'Displays current user display name. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
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
			'user_id' => array(
				'desc'             => __( 'Displays current user ID. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts'    => array(
							'on_empty' => sprintf( __( 'You are not logged, please <a href=\'%s\'>login</a>.', 'awesome-shortcodes' ), '/wp-login.php' ),
							'before'   => sprintf( __( 'Your ID: %s', 'awesome-shortcodes' ), '' ),
							'after'    => __( '.', 'awesome-shortcodes' ),
						),
					),
				),
			),
			'user_property' => array(
				'desc'             => __( 'Displays current user selected property. If user is not logged, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'property' => array(
						'default'  => '',
						'desc'     => __( 'Property to display.', 'awesome-shortcodes' ),
						'required' => true,
					),
					'array_glue' => array(
						'default'  => ', ',
						'desc'     => sprintf( __( 'If resulting property is an array, it\'s "glued" with PHP <code>implode()</code> function (%s). You can set function\'s <code>glue</code> argument here.', 'awesome-shortcodes' ),
							'<a target="_blank" href="http://php.net/manual/en/function.implode.php">http://php.net/manual/en/function.implode.php</a>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'property'   => 'roles',
							'on_empty'   => sprintf( __( 'You are not logged, please <a href=\'%s\'>login</a>.', 'awesome-shortcodes' ), '/wp-login.php' ),
							'before'     => sprintf( __( 'Your role(s): %s', 'awesome-shortcodes' ), '' ),
							'after'      => __( '.', 'awesome-shortcodes' ),
							'array_glue' => '; ',
						),
					),
				),
			),
		);
		parent::__construct();
	}

	/**
	 * total_users.
	 *
	 * @version 1.7.2
	 * @since   1.3.1
	 *
	 * @todo    (maybe) check `get_user_count()` (https://codex.wordpress.org/Function_Reference/get_user_count)
	 */
	function total_users( $atts, $content, $tag ) {
		$result = count_users();
		return ( '' === $atts['role'] ? $result['total_users'] : ( $result['avail_roles'][ $atts['role'] ] ?? 0 ) );
	}

	/**
	 * user_location.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 *
	 * @todo    add external method alternatives to `geoplugin.net` (e.g.: `hostip.info`)
	 * @todo    add internal method, e.g.: MaxMind
	 * @todo    add "return selection" attribute, e.g.: country name, country flag etc.
	 */
	function user_location( $atts, $content, $tag ) {
		$xml = simplexml_load_file( 'http://www.geoplugin.net/xml.gp?ip=' . $_SERVER['REMOTE_ADDR'] );
		return ( '' != $xml->geoplugin_countryName ? $xml->geoplugin_countryName : '' );
	}

	/**
	 * user_ip.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 * @todo    get "real" ip (and save it as private property to be used in other functions, e.g.: `user_location()`)
	 */
	function user_ip( $atts, $content, $tag ) {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * user_login.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 * @todo    (maybe) add `username` alias
	 */
	function user_login( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_login : '' );
	}

	/**
	 * user_email.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_email( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_email : '' );
	}

	/**
	 * user_first_name.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_first_name( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_firstname : '' );
	}

	/**
	 * user_last_name.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_last_name( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->user_lastname : '' );
	}

	/**
	 * user_display_name.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_display_name( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->display_name : '' );
	}

	/**
	 * user_id.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_id( $atts, $content, $tag ) {
		$current_user = $this->get_current_user();
		return ( 0 != $current_user->ID ? $current_user->ID : '' );
	}

	/**
	 * user_property.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
	 */
	function user_property( $atts, $content, $tag ) {
		if ( '' === $atts['property'] ) {
			return '';
		}
		$current_user = $this->get_current_user();
		if ( 0 == $current_user->ID ) {
			return '';
		}
		$property = $current_user->{$atts['property']};
		return ( is_array( $property ) ? implode( $atts['array_glue'], $property ) : $property );
	}

	/**
	 * get_current_user.
	 *
	 * @version 1.2.0
	 * @since   1.2.0
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
