<?php
/**
 * Awesome Shortcodes - Shortcode Packs - General
 *
 * @version 1.2.1
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_General' ) ) :

class Alg_Awesome_Shortcodes_Pack_General extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * Constructor.
	 *
	 * @version 1.2.1
	 * @since   1.0.0
	 * @todo    add shortcodes: `total_categories`, `total_tags`, `total_taxonomy` (maybe in "Taxonomies" pack)
	 * @todo    add shortcodes: `progress_bar`
	 * @todo    add shortcodes: `login_url` (`wp_login_url()`)
	 */
	function __construct() {
		$this->id         = 'general';
		$this->title      = __( 'General', 'awesome-shortcodes' );
		$this->desc       = __( 'General shortcodes.', 'awesome-shortcodes' );
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
			'timenow' => array(
				'desc'             => sprintf( __( 'Shows current time in %s format. Updated every second.', 'awesome-shortcodes' ), '<code>HH:MM:SS</code>' ),
				'type'             => 'self-closing',
				'aliases'          => array( 'clock' ),
				'enqueue_scripts'  => array( array( 'src' => 'js/timenow.js', 'deps' => array( 'jquery' ) ) ),
				'examples'         => array( array() ),
			),
			'countdown' => array(
				'desc'             => __( 'Creates a countdown timer. Updated every second.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'aliases'          => array( 'timer' ),
				'enqueue_scripts'  => array( array( 'src' => 'js/countdown.js' ) ),
				'atts'             => array(
					'date_to' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Date we\'re counting down to. E.g.: %s.', 'awesome-shortcodes' ), '<code>2021/01/01 12:00</code>' ),
						'required' => true,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'date_to' => '2021/01/01 12:00' )
					),
				),
			),
			'number_counter' => array(
				'desc'             => __( 'Creates an animated number counter.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'aliases'          => array( 'count' ),
				'enqueue_scripts'  => array( array( 'src' => 'js/number-counter.js' ) ),
				'atts'             => array(
					'number_to' => array(
						'default'  => '',
						'desc'     => __( 'Number we\'re counting to.', 'awesome-shortcodes' ),
						'required' => true,
					),
					'number_from' => array(
						'default'  => 0,
						'desc'     => __( 'Number we\'re counting from.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'duration' => array(
						'default'  => 4000,
						'desc'     => __( 'Duration determining how long the animation will run (in milliseconds).', 'awesome-shortcodes' ),
						'required' => false,
					),
					'easing' => array(
						'default'  => 'swing',
						'desc'     => sprintf( __( 'Easing function to use for the transition. Possible values: %s.', 'awesome-shortcodes' ),
							'<code>swing</code>, <code>linear</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'desc'    => __( 'Count from 1900 to 2000 with <code>linear</code> easing:', 'awesome-shortcodes' ),
						'atts'    => array(
							'number_from' => 1900,
							'number_to'   => 2000,
							'duration'    => 10000,
							'easing'      => 'linear',
						)
					),
					array(
						'desc'    => __( 'Count from 1900 to 2000 with <code>swing</code> easing:', 'awesome-shortcodes' ),
						'atts'    => array(
							'number_from' => 1900,
							'number_to'   => 2000,
							'duration'    => 10000,
							'easing'      => 'swing',
						)
					),
					array(
						'desc'    => __( 'Count from 100 to 0:', 'awesome-shortcodes' ),
						'atts'    => array(
							'number_from' => 100,
							'number_to'   => 0,
							'before'      => '<strong>',
							'after'       => '</strong>',
						)
					),
				),
			),
			'hide' => array(
				'desc'             => __( 'Hides content. Useful for commenting.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'aliases'          => array( 'comment' ),
				'examples'         => array(
					array(
						'content' => __( 'This text will be hidden.', 'awesome-shortcodes' ),
					),
				),
			),
			'table' => array(
				'desc'             => __( 'Displays HTML table.', 'awesome-shortcodes' ),
				'type'             => 'enclosing',
				'examples'         => array(
					array(
						'content' => 'row_1 cell_1,row_1 cell_2|row_2 cell_1,row_2 cell_2',
					)
				),
				'atts'             => array(
					'table_class' => array(
						'default'  => '',
						'desc'     => __( 'Table CSS class.', 'awesome-shortcodes' ),
					),
					'table_heading_type' => array(
						'default'  => 'horizontal',
						'desc'     => sprintf( __( 'Table heading type. Possible values: %s.', 'awesome-shortcodes' ),
							'<code>' . implode( '</code>, <code>', array( 'horizontal', 'vertical', 'none' ) ) . '</code>' ),
					),
				),
			),
			'date' => array(
				'desc'             => __( 'Displays current date.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'date_format' => array(
						'default'  => 'Y-m-d',
						'desc'     => __( 'Date format. As in PHP <code>date</code> function (<a target="_blank" href="http://php.net/manual/en/function.date.php">http://php.net/manual/en/function.date.php</a>).', 'awesome-shortcodes' ),
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'date_format' => 'Y',
							'before'      => '&copy; ',
							'after'       => '. All Rights Reserved.',
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

	/**
	 * number_counter.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function number_counter( $atts, $content, $tag ) {
		return ( '' !== $atts['number_to'] ?
			'<span class="awesome-shortcode-count"' .
				' number-from="' . $atts['number_from'] . '"' .
				' number-to="'   . $atts['number_to']   . '"' .
				' duration="'    . $atts['duration']    . '"' .
				' easing="'      . $atts['easing']      . '"' .
			'>'. '</span>' : '' );
	}

	/**
	 * timenow.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) more atts. E.g.: `time_format`, `update_period`, styling options etc.
	 */
	function timenow( $atts, $content, $tag ) {
		return '<p class="awesome-shortcode-timenow"></p>';
	}

	/**
	 * countdown.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) more atts. E.g.: `countdown_format`, `update_period`, `on_expired`, styling options etc.
	 */
	function countdown( $atts, $content, $tag ) {
		return ( ! empty( $atts['date_to'] ) ? '<p class="awesome-shortcode-countdown" date-to="' . $atts['date_to'] . '"></p>' : '' );
	}

	/**
	 * date.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function date( $atts, $content, $tag ) {
		return date( $atts['date_format'] );
	}

	/**
	 * hide.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function hide( $atts, $content, $tag ) {
		return '';
	}

	/**
	 * table.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) more atts. E.g.: `row_sep`, `cell_sep` etc.
	 */
	function table( $atts, $content, $tag ) {
		$table_data = array();
		$rows       = explode( '|', $content );
		foreach ( $rows as $row ) {
			$table_data[] = explode( ',', $row );
		}
		return alg_awesome_shortcodes_get_table_html( $table_data, array( 'table_class' => $atts['table_class'], 'table_heading_type' => $atts['table_heading_type'] ) );
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_General();
