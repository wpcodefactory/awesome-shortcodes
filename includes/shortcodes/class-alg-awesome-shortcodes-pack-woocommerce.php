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

		);
		parent::__construct();
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_WooCommerce();
