<?php
/**
 * Awesome Shortcodes - Shortcode Packs - WooCommerce
 *
 * @version 1.2.1
 * @since   1.2.1
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_WooCommerce' ) ) :

class Alg_Awesome_Shortcodes_Pack_WooCommerce extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * Constructor.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 */
	function __construct() {
		$this->id         = 'woocommerce';
		$this->title      = __( 'WooCommerce', 'awesome-shortcodes' );
		$this->desc       = __( 'WooCommerce shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'wc_login_form' => array(
				'desc'             => __( 'Displays WooCommerce login form for not logged in users. If user is already logged in, nothing is displayed.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts' => array(
							'on_empty' => __( 'You are already logged in.', 'awesome-shortcodes' ),
						),
					),
				),
			),
		);
		parent::__construct();
	}

	/**
	 * wc_login_form.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 * @todo    move to WooCommerce pack
	 */
	function wc_login_form( $atts, $content, $tag ) {
		ob_start();
		woocommerce_login_form();
		return ob_get_clean();
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_WooCommerce();
