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
					'max_posts' => array(
						'default'  => '10',
						'desc'     => __( 'Max posts to return number.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'output_format' => array(
						'default'  => '%title%',
						'desc'     => __( 'Output format.', 'awesome-shortcodes' ) . ' ' . sprintf( __( 'Replaced values: %s.', 'awesome-shortcodes' ),
							'<code>' . implode( '</code>, <code>', array( '%title%', '%link%' ) ) . '</code>' ),
						'required' => false,
					),
					'post_type' => array(
						'default'  => 'post',
						'desc'     => sprintf( __( 'Post type. Can be custom type, e.g.: %s.', 'awesome-shortcodes' ), '<code>product</code>' ),
						'required' => false,
					),
					'post_status' => array(
						'default'  => 'any',
						'desc'     => sprintf( __( 'Post status, e.g.: %s.', 'awesome-shortcodes' ), '<code>publish</code>' ),
						'required' => false,
					),
					'orderby' => array(
						'default'  => 'title',
						'desc'     => sprintf( __( 'Order by parameter, e.g.: %s.', 'awesome-shortcodes' ), '<code>date</code>' ),
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
						'desc'    => __( 'Display five recently published products as list:', 'awesome-shortcodes' ),
						'atts'    => array(
							'max_posts'     => '5',
							'post_type'     => 'product',
							'post_status'   => 'publish',
							'orderby'       => 'date',
							'order'         => 'desc',
							'before'        => '<h3>' . __( 'Recent products', 'awesome-shortcodes' ) . '</h3><ul><li>',
							'sep'           => '</li><li>',
							'after'         => '</li></ul>',
							'output_format' => '<a href=\'%link%\'>%title%</a>',
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
	 * @version 1.0.1
	 * @since   1.0.0
	 * @todo    more params (check WP_Query page), e.g. `meta_key`
	 * @todo    more `output_format` replace values
	 */
	function posts( $atts, $content, $tag ) {
		$args = array(
			'post_type'      => $atts['post_type'],
			'post_status'    => $atts['post_status'],
			'posts_per_page' => $atts['max_posts'],
			'orderby'        => $atts['orderby'],
			'order'          => $atts['order'],
			'fields'         => 'ids',
		);
		$loop = new WP_Query( $args );
		$posts = array();
		if ( $loop->have_posts() ) {
			foreach ( $loop->posts as $post_id ) {
				$replace = array(
					'%title%' => get_the_title( $post_id ),
					'%link%'  => get_permalink( $post_id ),
				);
				$posts[ $post_id ] = str_replace( array_keys( $replace ), array_values( $replace ), $atts['output_format'] );
			}
		}
		return implode( $atts['sep'], $posts );
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
