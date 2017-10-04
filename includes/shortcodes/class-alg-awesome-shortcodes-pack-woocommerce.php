<?php
/**
 * Awesome Shortcodes - Shortcode Packs - WooCommerce
 *
 * @version 1.3.2
 * @since   1.3.0
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
	 * @version 1.3.0
	 * @since   1.3.0
	 */
	private $product;

	/**
	 * Constructor.
	 *
	 * @version 1.3.2
	 * @since   1.3.0
	 */
	function __construct() {
		$this->id         = 'woocommerce';
		$this->title      = __( 'WooCommerce', 'awesome-shortcodes' );
		$this->desc       = __( 'WooCommerce shortcodes.', 'awesome-shortcodes' );
		$product_atts    = array(
			'product_id' => array(
				'default'  => '',
				'desc'     => __( 'Product ID. If not set - current product ID is used.', 'awesome-shortcodes' ),
				'required' => false,
			),
		);
		$this->shortcodes = array(
			'wc_product_id' => array(
				'desc'             => __( 'Shortcode displays current WooCommerce product ID.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'atts' => array(
							'before' => sprintf( __( 'Product ID: %s', 'awesome-shortcodes' ), '' ),
						),
					),
				),
			),
			'wc_product_dimensions' => array(
				'desc'             => __( 'Displays WooCommerce product dimensions.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => $product_atts,
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
	 * wc_product_id.
	 *
	 * @version 1.3.2
	 * @since   1.3.2
	 */
	function wc_product_id( $atts, $content, $tag ) {
		return ( false != ( $product = $this->get_product() ) ? $product->get_id() : '' );
	}

	/**
	 * wc_product_dimensions.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
	 * @todo    variable
	 * @todo    (maybe) check if WC version below 3.0.0
	 */
	function wc_product_dimensions( $atts, $content, $tag ) {
		if ( false != ( $product = $this->get_product( $atts['product_id'] ) ) ) {
			return ( $product->has_dimensions() ? wc_format_dimensions( $product->get_dimensions( false ) ) : '' );
		} else {
			return '';
		}
	}

	/**
	 * wc_login_form.
	 *
	 * @version 1.3.0
	 * @since   1.3.0
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
	 * @version 1.3.2
	 * @since   1.3.0
	 */
	private function get_product( $product_id = false ) {
		if ( '' === $product_id ) {
			$product_id = false;
		}
		if ( ! isset( $this->product[ $product_id ] ) ) {
			$this->product[ $product_id ] = ( function_exists( 'wc_get_product' ) ? wc_get_product( $product_id ) : false );
		}
		return $this->product[ $product_id ];
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_WooCommerce();
