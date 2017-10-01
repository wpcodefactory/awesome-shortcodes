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
	 * product.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 */
	private $product;

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
			'wc_product_dimensions' => array(
				'desc'             => __( 'Displays WooCommerce product dimensions.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts' => array(
							'on_empty' => __( 'No dimensions set.', 'awesome-shortcodes' ),
						),
					),
				),
			),
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
	 * wc_product_dimensions.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 * @todo    variable
	 * @todo    (maybe) check if WC version below 3.0.0
	 */
	function wc_product_dimensions( $atts, $content, $tag ) {
		if ( false != ( $product = $this->get_product() ) ) {
			return ( $product->has_dimensions() ? wc_format_dimensions( $product->get_dimensions( false ) ) : '' );
		} else {
			return '';
		}
	}

	/**
	 * wc_login_form.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 */
	function wc_login_form( $atts, $content, $tag ) {
		if ( function_exists( 'woocommerce_login_form' ) ) {
			ob_start();
			woocommerce_login_form();
			return ob_get_clean();
		} else {
			return '';
		}
	}

	/**
	 * get_product.
	 *
	 * @version 1.2.1
	 * @since   1.2.1
	 * @todo    add optional `product_id` attribute
	 */
	private function get_product() {
		if ( ! isset( $this->product ) ) {
			$this->product = ( function_exists( 'wc_get_product' ) ? wc_get_product() : false );
		}
		return $this->product;
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_WooCommerce();
