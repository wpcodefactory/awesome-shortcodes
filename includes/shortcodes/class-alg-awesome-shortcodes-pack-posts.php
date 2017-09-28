<?php
/**
 * Awesome Shortcodes - Shortcode Packs - Posts
 *
 * @version 1.0.1
 * @since   1.0.1
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Pack_Posts' ) ) :

class Alg_Awesome_Shortcodes_Pack_Posts extends Alg_Abstract_Awesome_Shortcodes_Pack {

	/**
	 * Constructor.
	 *
	 * @version 1.0.1
	 * @since   1.0.1
	 */
	function __construct() {
		$this->id         = 'posts';
		$this->desc       = __( 'Posts', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'post_id' => array(
				'desc'             => __( 'Displays current post ID.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array( array(
						'before' => __( 'Current post ID: ', 'awesome-shortcodes' ),
					),
				),
			),
			'post_meta' => array(
				'desc'             => __( 'Displays post meta field value.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'key' => array(
						'default'  => '',
						'desc'     => __( 'Post meta key to retrieve.', 'awesome-shortcodes' ),
						'required' => true,
					),
					'post_id' => array(
						'default'  => '',
						'desc'     => __( 'Post ID. If not set - current post ID is used.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'key' => 'total_sales', 'before' => __( 'Total sales: ', 'awesome-shortcodes' ) ),
					),
				),
			),
			'posts' => array(
				'desc'             => __( 'Displays posts. Check <a target="_blank" href="https://codex.wordpress.org/Class_Reference/WP_Query">WP_Query page</a> for more info on params.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'aliases'          => array( 'wp_query' ),
				'atts'             => array(
					'sep' => array(
						'default'  => '<br>',
						'desc'     => __( 'Separator.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'post_type' => array(
						'default'  => 'post',
						'desc'     => sprintf( __( 'Post type. Can be custom type, e.g.: %s.', 'awesome-shortcodes' ), '<code>product</code>' ),
						'required' => false,
					),
					'post_status' => array(
						'default'  => 'any',
						'desc'     => __( 'Post status.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'orderby' => array(
						'default'  => 'title',
						'desc'     => __( 'Order by.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'order' => array(
						'default'  => 'ASC',
						'desc'     => __( 'Order (<code>ASC</code> or <code>DESC</code>).', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'post_type'   => 'product',
							'post_status' => 'publish',
							'orderby'     => 'date',
							'order'       => 'desc',
							'before'      => '<h3>' . __( 'Recent products', 'awesome-shortcodes' ) . '</h3>',
						),
					),
				),
			),
		);
		parent::__construct();
	}

	/**
	 * posts.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    max posts to return number
	 * @todo    link
	 * @todo    format (not only title)
	 * @todo    more params (check WP_Query page)
	 */
	function posts( $atts, $content, $tag ) {
		return implode( $atts['sep'], alg_awesome_shortcodes_get_posts( array(), $atts['post_type'], $atts['post_status'], 256, $atts['orderby'], $atts['order'] ) );
	}

	/**
	 * post_meta.
	 *
	 * @version 1.0.1
	 * @since   1.0.1
	 * @todo    different example?
	 * @todo    handle case if `array` is returned
	 * @todo    (maybe) move to `posts` pack
	 */
	function post_meta( $atts, $content, $tag ) {
		if ( '' === $atts['key'] ) {
			return '';
		}
		$post_id = ( '' != $atts['post_id'] ? $atts['post_id'] : get_the_ID() );
		return get_post_meta( $post_id, $atts['key'], true );
	}

	/**
	 * post_id.
	 *
	 * @version 1.0.1
	 * @since   1.0.1
	 */
	function post_id( $atts, $content, $tag ) {
		return get_the_ID();
	}

}

endif;

return new Alg_Awesome_Shortcodes_Pack_Posts();
