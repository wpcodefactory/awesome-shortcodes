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

		);
		parent::__construct();
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_Users();
