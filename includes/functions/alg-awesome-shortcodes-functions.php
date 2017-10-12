<?php
/**
 * Awesome Shortcodes - Functions
 *
 * @version 1.4.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'alg_awesome_shortcodes_get_atts_html' ) ) {
	/**
	 * alg_awesome_shortcodes_get_atts_html.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 */
	function alg_awesome_shortcodes_get_atts_html( $atts ) {
		$html = '';
		foreach ( $atts as $att_key => $att_value ) {
			$html .= ' ' . str_replace( '_', '-', $att_key ) . '="' . $att_value . '"';
		}
		return $html;
	}
}

if ( ! function_exists( 'alg_awesome_shortcodes_get_table_html' ) ) {
	/**
	 * alg_awesome_shortcodes_get_table_html.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
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
