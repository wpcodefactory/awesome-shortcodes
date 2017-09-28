<?php
/**
 * Awesome Shortcodes - Functions
 *
 * @version 1.0.1
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'alg_awesome_shortcodes_get_posts' ) ) {
	/**
	 * alg_awesome_shortcodes_get_posts.
	 *
	 * @version 1.0.1
	 * @since   1.0.0
	 * @todo    (maybe) move to `posts` shortcodes
	 */
	function alg_awesome_shortcodes_get_posts( $posts = array(), $post_type = 'post', $post_status = 'any', $block_size = 256, $orderby = 'title', $order = 'ASC' ) {
		$offset = 0;
		while( true ) {
			$args = array(
				'post_type'      => $post_type,
				'post_status'    => $post_status,
				'posts_per_page' => $block_size,
				'offset'         => $offset,
				'orderby'        => $orderby,
				'order'          => $order,
				'fields'         => 'ids',
			);
			$loop = new WP_Query( $args );
			if ( ! $loop->have_posts() ) {
				break;
			}
			foreach ( $loop->posts as $post_id ) {
				$posts[ $post_id ] = get_the_title( $post_id );
			}
			$offset += $block_size;
		}
		return $posts;
	}
}

if ( ! function_exists( 'alg_awesome_shortcodes_get_table_html' ) ) {
	/**
	 * alg_awesome_shortcodes_get_table_html.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    (maybe) move to `general` shortcodes
	 */
	function alg_awesome_shortcodes_get_table_html( $data, $args = array() ) {
		$defaults = array(
			'table_class'        => '',
			'table_style'        => '',
			'row_styles'         => '',
			'table_heading_type' => 'horizontal',
			'columns_classes'    => array(),
			'columns_styles'     => array(),
		);
		$args = array_merge( $defaults, $args );
		extract( $args );
		$table_class = ( '' == $table_class ? '' : ' class="' . $table_class . '"' );
		$table_style = ( '' == $table_style ? '' : ' style="' . $table_style . '"' );
		$row_styles  = ( '' == $row_styles  ? '' : ' style="' . $row_styles  . '"' );
		$html = '';
		$html .= '<table' . $table_class . $table_style . '>';
		$html .= '<tbody>';
		foreach( $data as $row_number => $row ) {
			$html .= '<tr' . $row_styles . '>';
			foreach( $row as $column_number => $value ) {
				$th_or_td     = ( ( 0 === $row_number && 'horizontal' === $table_heading_type ) || ( 0 === $column_number && 'vertical' === $table_heading_type ) ? 'th' : 'td' );
				$column_class = ( ! empty( $columns_classes ) && isset( $columns_classes[ $column_number ] ) ? ' class="' . $columns_classes[ $column_number ] . '"' : '' );
				$column_style = ( ! empty( $columns_styles )  && isset( $columns_styles[ $column_number ] )  ? ' style="' . $columns_styles[ $column_number ]  . '"' : '' );
				$html .= '<' . $th_or_td . $column_class . $column_style . '>';
				$html .= $value;
				$html .= '</' . $th_or_td . '>';
			}
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}
}
