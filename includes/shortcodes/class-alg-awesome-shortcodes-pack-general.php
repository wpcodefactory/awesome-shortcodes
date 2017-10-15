<?php
/**
 * Awesome Shortcodes - Shortcode Packs - General
 *
 * @version 1.5.1
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
	 * @version 1.5.1
	 * @since   1.0.0
	 * @todo    add shortcodes: `progress_bar`
	 */
	function __construct() {
		$this->id         = 'general';
		$this->title      = __( 'General', 'awesome-shortcodes' );
		$this->desc       = __( 'General shortcodes.', 'awesome-shortcodes' );
		$this->shortcodes = array(
			'login_url' => array(
				'desc'             => __( 'Shortcode displays your WordPress site login URL.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'examples'         => array(
					array(
						'before'  => '<a href="',
						'after'   => '">' . __( 'Login', 'awesome-shortcodes' ) . '</a>',
					),
				),
			),
			'total_taxonomy' => array(
				'desc'             => __( 'Shortcode displays total taxonomy terms count on your site.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'taxonomy' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Taxonomy name. E.g.: %s.', 'awesome-shortcodes' ), '<code>product_tag</code>' ),
						'required' => true,
					),
					'parent' => array(
						'default'  => '',
						'desc'     => __( 'Parent taxonomy term ID. Enter zero to count top level terms. Leave empty to count all terms.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'hide_empty' => array(
						'default'  => 'no',
						'desc'     => sprintf( __( 'Set to %s if you want to skip empty terms.', 'awesome-shortcodes' ), '<code>yes</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'before'   => sprintf( __( 'Total product categories: %s', 'awesome-shortcodes' ), '' ),
							'taxonomy' => 'product_cat',
							'on_zero'  => __( 'No product categories.', 'awesome-shortcodes' ),
						)
					),
				),
			),
			'total_tags' => array(
				'desc'             => __( 'Shortcode displays total tags count on your site.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'hide_empty' => array(
						'default'  => 'no',
						'desc'     => sprintf( __( 'Set to %s if you want to skip empty tags.', 'awesome-shortcodes' ), '<code>yes</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'before'  => sprintf( __( 'Total tags: %s', 'awesome-shortcodes' ), '' ),
							'on_zero' => __( 'No tags.', 'awesome-shortcodes' ),
						)
					),
				),
			),
			'total_categories' => array(
				'desc'             => __( 'Shortcode displays total categories count on your site.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'parent' => array(
						'default'  => '',
						'desc'     => __( 'Parent category ID. Enter zero to count top level categories. Leave empty to count all categories.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'hide_empty' => array(
						'default'  => 'no',
						'desc'     => sprintf( __( 'Set to %s if you want to skip empty categories.', 'awesome-shortcodes' ), '<code>yes</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'before'  => sprintf( __( 'Total top level categories: %s', 'awesome-shortcodes' ), '' ),
							'parent'  => 0,
							'on_zero' => __( 'No categories.', 'awesome-shortcodes' ),
						)
					),
				),
			),
			'youtube' => array(
				'desc'             => __( 'Shortcode displays embedded YouTube video.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'video' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Enter the YouTube video code here. E.g.: %s.', 'awesome-shortcodes' ), '<code>Q0CbN8sfihY</code>' ),
						'required' => true,
					),
					'start' => array(
						'default'  => '',
						'desc'     => __( 'If you want to start video from some time code, enter it here.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'width' => array(
						'default'  => '560',
						'desc'     => __( 'Embedded video width.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'height' => array(
						'default'  => '315',
						'desc'     => __( 'Embedded video height.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array(
							'video' => 'Q0CbN8sfihY',
							'start' => '1:26',
						)
					),
				),
			),
			'dashicon' => array(
				'desc'             => __( 'Shortcode displays WordPress dash icon.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'enqueue_styles'   => array( array( 'handle' => 'dashicons', 'version' => false ) ),
				'atts'             => array(
					'icon' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Enter the required icon slug here. You can check the icon slugs at %s.', 'awesome-shortcodes' ),
							'<a target="_blank" href="https://developer.wordpress.org/resource/dashicons/">' .
								'https://developer.wordpress.org/resource/dashicons/</a>' ),
						'required' => true,
					),
				),
				'examples'         => array(
					array(
						'desc'    => sprintf( __( 'Tickets icon:%s', 'awesome-shortcodes' ), '' ),
						'atts'    => array(
							'icon' => 'tickets',
						)
					),
					array(
						'desc'    => sprintf( __( 'Admin home icon:%s', 'awesome-shortcodes' ), '' ),
						'atts'    => array(
							'icon' => 'admin-home',
						)
					),
				),
			),
			'google_map' => array(
				'desc'             => __( 'Shortcode displays Google Map for selected coordinates.', 'awesome-shortcodes' ),
				'type'             => 'self-closing',
				'enqueue_scripts'  => array( array( 'src' => 'js/google-map.js', 'deps' => array( 'jquery' ) ) ),
				'atts'             => array(
					'api_key' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Enter you Google Maps API key here. You can get you free key at %s.', 'awesome-shortcodes' ),
							'<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">' .
								'https://developers.google.com/maps/documentation/javascript/get-api-key</a>' ),
						'required' => true,
					),
					'width' => array(
						'default'  => '400px',
						'desc'     => __( 'Specifies the width the map.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'height' => array(
						'default'  => '400px',
						'desc'     => __( 'Specifies the height the map.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'zoom' => array(
						'default'  => 10,
						'desc'     => __( 'Specifies the zoom level for the map.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'center_latitude' => array(
						'default'  => 51.5,
						'desc'     => __( 'Specifies where to center the map (latitude).', 'awesome-shortcodes' ),
						'required' => false,
					),
					'center_longitude' => array(
						'default'  => -0.2,
						'desc'     => __( 'Specifies where to center the map (longitude).', 'awesome-shortcodes' ),
						'required' => false,
					),
					'map_type_id' => array(
						'default'  => 'roadmap',
						'desc'     => sprintf( __( 'Specifies the type of the map. Possible options are: %s.', 'awesome-shortcodes' ),
							'<code>' . implode( '</code>, <code>', array( 'roadmap', 'satellite', 'hybrid', 'terrain' ) ) . '</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'desc'    => sprintf( __( 'Satellite map centered on Eiffel Tower:%s', 'awesome-shortcodes' ), '' ),
						'atts'    => array(
							'api_key'          => 'AIzaSyB0W2k9RoJ2xZeknr3lOnpYrFhlEJhdXFo',
							'width'            => '100%',
							'height'           => '500px',
							'zoom'             => 15,
							'center_latitude'  => 48.8584,
							'center_longitude' => 2.2945,
							'map_type_id'      => 'satellite',
						)
					),
				),
			),
			'meter' => array(
				'desc'             => sprintf( __( 'Shortcode is used to measure data within a given range (a gauge). Uses HTML %s tag.', 'awesome-shortcodes' ),
					'<a target="_blank" href="https://www.w3schools.com/TAGs/tag_meter.asp"><code>&lt;meter&gt;</code></a>' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'value' => array(
						'default'  => 0,
						'desc'     => __( 'Specifies the current value of the gauge.', 'awesome-shortcodes' ),
						'required' => true,
					),
					'min' => array(
						'default'  => 0,
						'desc'     => __( 'Specifies the minimum value of the range.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'max' => array(
						'default'  => 100,
						'desc'     => __( 'Specifies the maximum value of the range.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'value' => 33 )
					),
				),
			),
			'progress' => array(
				'desc'             => sprintf( __( 'Shortcode displays the progress of a task. Uses HTML %s tag.', 'awesome-shortcodes' ),
					'<a target="_blank" href="https://www.w3schools.com/TAGs/tag_progress.asp"><code>&lt;progress&gt;</code></a>' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'value' => array(
						'default'  => 0,
						'desc'     => __( 'Specifies how much of the task has been completed.', 'awesome-shortcodes' ),
						'required' => true,
					),
					'max' => array(
						'default'  => 100,
						'desc'     => __( 'Specifies how much work the task requires in total.', 'awesome-shortcodes' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'value' => 33 )
					),
				),
			),
			'option' => array(
				'desc'             => sprintf( __( 'Shortcode displays WordPress option value. Uses WordPress %s function.', 'awesome-shortcodes' ),
					'<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_option/"><code>get_option()</code></a>' ),
				'type'             => 'self-closing',
				'atts'             => array(
					'name' => array(
						'default'  => '',
						'desc'     => sprintf( __( 'Name of option to retrieve. E.g.: %s.', 'awesome-shortcodes' ), '<code>blogname</code>' ),
						'required' => true,
					),
					'default' => array(
						'default'  => '',
						'desc'     => __( 'Default value to return if the option does not exist.', 'awesome-shortcodes' ),
						'required' => false,
					),
					'array_glue' => array(
						'default'  => ', ',
						'desc'     => sprintf( __( 'If resulting value is an array, it\'s "glued" with PHP %s function. You can set function\'s %s argument here.', 'awesome-shortcodes' ),
							'<a target="_blank" href="http://php.net/manual/en/function.implode.php"><code>implode()</code></a>', '<code>glue</code>' ),
						'required' => false,
					),
				),
				'examples'         => array(
					array(
						'atts'    => array( 'name' => 'blogdescription' )
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
	 * login_url.
	 *
	 * @version 1.5.0
	 * @since   1.5.0
	 * @todo    add `redirect` attribute (including "redirect to current page")
	 */
	function login_url( $atts, $content, $tag ) {
		return wp_login_url();
	}

	/**
	 * count_terms.
	 *
	 * @version 1.5.1
	 * @since   1.5.0
	 */
	private function count_terms( $taxonomy, $atts ) {
		$args = array(
			'taxonomy'   => $taxonomy,
			'parent'     => ( isset( $atts['parent'] ) ? $atts['parent'] : '' ),
			'hide_empty' => ( 'yes' === $atts['hide_empty'] ? 1 : 0 ),
		);
		$terms = get_terms( $args );
		return ( is_wp_error( $terms ) ? 0 : count( $terms ) );
	}

	/**
	 * total_taxonomy.
	 *
	 * @version 1.5.0
	 * @since   1.5.0
	 */
	function total_taxonomy( $atts, $content, $tag ) {
		return ( '' != $atts['taxonomy'] ? $this->count_terms( $atts['taxonomy'], $atts ) : '' );
	}

	/**
	 * total_tags.
	 *
	 * @version 1.5.0
	 * @since   1.5.0
	 */
	function total_tags( $atts, $content, $tag ) {
		return $this->count_terms( 'post_tag', $atts );
	}

	/**
	 * total_categories.
	 *
	 * @version 1.5.0
	 * @since   1.5.0
	 * @todo    (maybe) move to "Taxonomies" pack
	 * @todo    more atts - check https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
	 */
	function total_categories( $atts, $content, $tag ) {
		return $this->count_terms( 'category', $atts );
	}

	/**
	 * youtube.
	 *
	 * @version 1.5.0
	 * @since   1.5.0
	 * @todo    (maybe) more atts (e.g. `frameborder`, `allowfullscreen`, autostart etc.)
	 */
	function youtube( $atts, $content, $tag ) {
		if ( '' === $atts['video'] ) {
			return '';
		}
		$start = '';
		if ( '' != $atts['start'] ) {
			$sec = 0;
			foreach ( array_reverse( explode( ':', $atts['start'] ) ) as $k => $v ) {
				$sec += pow( 60, $k ) * $v;
			}
			$start = '?start=' . $sec;
		}
		return '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="https://www.youtube.com/embed/' . $atts['video'] . $start . '" frameborder="0" allowfullscreen></iframe>';
	}

	/**
	 * dashicon.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 */
	function dashicon( $atts, $content, $tag ) {
		if ( '' === $atts['icon'] ) {
			return '';
		}
		$prefix = 'dashicons-';
		if ( $prefix === substr( $atts['icon'], 0, strlen( $prefix ) ) ) {
			$atts['icon'] = substr( $atts['icon'], strlen( $prefix ) );
		}
		return '<span class="dashicons dashicons-' . $atts['icon'] . '"></span>';
	}

	/**
	 * google_map.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 * @todo    (maybe) add `address` att (so center could be set without latitude and longitude)
	 * @todo    (maybe) add more atts
	 * @see     https://developers.google.com/maps/documentation/javascript/
	 */
	function google_map( $atts, $content, $tag ) {
		return ( '' === $atts['api_key'] ? '' : '<div id="awesome-shortcode-google-map" style="width:' . $atts['width'] . ';height:' . $atts['height'] . ';"' .
			alg_awesome_shortcodes_get_atts_html( array(
				'api_key'          => $atts['api_key'],
				'zoom'             => $atts['zoom'],
				'center_latitude'  => $atts['center_latitude'],
				'center_longitude' => $atts['center_longitude'],
				'map_type_id'      => $atts['map_type_id'],
			) ) . '>' .
		'</div>' );
	}

	/**
	 * meter.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 * @todo    add more atts, e.g.: `high`, `low`, `optimum` etc.
	 */
	function meter( $atts, $content, $tag ) {
		return '<meter value="' . $atts['value'] . '" min="' . $atts['min'] . '" max="' . $atts['max'] . '"></meter>';
	}

	/**
	 * progress.
	 *
	 * @version 1.4.0
	 * @since   1.4.0
	 */
	function progress( $atts, $content, $tag ) {
		return '<progress value="' . $atts['value'] . '" max="' . $atts['max'] . '"></progress>';
	}

	/**
	 * option.
	 *
	 * @version 1.3.1
	 * @since   1.3.1
	 * @todo    if resulting value is neither array or simple type (e.g. object) - maybe just `print_r()`?
	 */
	function option( $atts, $content, $tag ) {
		if ( '' === $atts['name'] ) {
			return '';
		}
		$output = get_option( $atts['name'], $atts['default'] );
		return ( is_array( $output ) ? implode( $atts['array_glue'], $output ) : $output );
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
