<?php
/**
 * Awesome Shortcodes - Admin Settings Class
 *
 * @version 1.3.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Alg_Awesome_Shortcodes_Admin_Settings' ) ) :

class Alg_Awesome_Shortcodes_Admin_Settings {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    add "All" shortcodes section
	 * @todo    (maybe) replace `get_option( 'alg_awesome_shortcodes_options', array() )` with `alg_awesome_shortcodes()->core->shortcodes_options`
	 * @todo    (maybe) replace `get_option( 'alg_awesome_shortcodes_prefix', '' )` with `alg_awesome_shortcodes()->core->prefix`
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'handle_actions' ) );
	}

	/**
	 * add_admin_menu.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_admin_menu() {
		add_options_page(
			__( 'Awesome Shortcodes', 'awesome-shortcodes' ),
			__( 'Awesome Shortcodes', 'awesome-shortcodes' ),
			'manage_options',
			'awesome-shortcodes',
			array( $this, 'output_admin_settings' )
		);
	}

	/**
	 * get_current_section.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_current_section() {
		return ( isset( $_GET['section'] ) ? sanitize_key( $_GET['section'] ) : 'settings' );
	}

	/**
	 * get_current_type.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_current_type() {
		return ( isset( $_GET['type'] ) ? sanitize_key( $_GET['type'] ) : 'general' );
	}

	/**
	 * handle_actions.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function handle_actions() {
		if ( isset( $_POST['alg_awesome_shortcodes_save_options'] ) ) {
			if ( 'settings' === $this->get_current_section() ) {
				foreach ( $this->get_options() as $option ) {
					if ( isset( $_POST[ $option['id'] ] ) ) {
						update_option( $option['id'], sanitize_key( $_POST[ $option['id'] ] ) );
					}
				}
			} elseif ( 'shortcodes' === $this->get_current_section() ) {
				$shortcode_options = get_option( 'alg_awesome_shortcodes_options', array() );
				foreach ( $_POST['alg_awesome_shortcodes_options'] as $shortcode => $option_value ) {
					$shortcode_options[ $shortcode ] = ( 'yes' === $option_value );
				}
				update_option( 'alg_awesome_shortcodes_options', $shortcode_options );
			}
			add_action( 'admin_notices', array( $this, 'admin_notice_options_saved' ) );
		}
	}

	/**
	 * admin_notice_options_saved.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function admin_notice_options_saved() {
		echo '<div class="notice notice-success is-dismissible">' .
			'<p>' . '<strong>' . __( 'Your settings have been saved.', 'awesome-shortcodes' ) . '</strong>' . '</p>' . '</div>';
	}

	/**
	 * get_options.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 * @todo    (maybe) example output: `shortcode_pack->awesome_shortcode( ( ! empty( $example['atts'] ) ? $example['atts'] : array() ), ( ! empty( $example['content'] ) ? $example['content'] : '' ), $prefix . $shortcode_tag, ( isset( $shortcode['func'] ) ? $shortcode['func'] : $shortcode_tag ) )`
	 * @todo    (maybe) remove `alg_awesome_shortcodes_enabled` completely
	 * @todo    (maybe) shortcode factory (i.e. custom shortcodes)
	 * @todo    (maybe) add "enable/disable all shortcodes" option
	 * @todo    (maybe) add "reset settings" option
	 * @todo    (maybe) use `<details><summary>...` or JS in `atts` and `examples`
	 */
	function get_options() {
		if ( 'settings' === $this->get_current_section() ) {
			return array(
				array(
					'title'    => __( 'Enable', 'awesome-shortcodes' ),
					'desc'     => '<strong>' . __( 'Enable plugin', 'awesome-shortcodes' ) . '</strong>',
					'desc_tip' => '',
					'id'       => 'alg_awesome_shortcodes_enabled',
					'default'  => 'yes',
					'type'     => 'checkbox',
					'class'    => '',
				),
				array(
					'title'    => __( 'Enable shortcodes in text widgets', 'awesome-shortcodes' ),
					'desc'     => __( 'Enable', 'awesome-shortcodes' ),
					'desc_tip' => __( 'Enable all shortcodes (including awesome) in text widgets.', 'awesome-shortcodes' ),
					'id'       => 'alg_awesome_shortcodes_text_widgets_enabled',
					'default'  => 'no',
					'type'     => 'checkbox',
					'class'    => '',
				),
				array(
					'title'    => __( 'Awesome shortcodes prefix', 'awesome-shortcodes' ),
					'desc'     => __( 'Prefix all awesome shortcodes. Setting this is useful if you have compatibility issues with other shortcodes with matching names.', 'awesome-shortcodes' ),
					'id'       => 'alg_awesome_shortcodes_prefix',
					'default'  => '',
					'type'     => 'text',
					'class'    => '',
				),
			);
		} elseif ( 'shortcodes' === $this->get_current_section() ) {
			$prefix  = get_option( 'alg_awesome_shortcodes_prefix', '' );
			$type    = $this->get_current_type();
			$options = array();
			foreach ( alg_awesome_shortcodes()->core->shortcode_packs as $shortcode_pack ) {
				if ( $type != $shortcode_pack->id  ) {
					continue;
				}
				$shortcodes = $shortcode_pack->shortcodes;
				ksort( $shortcodes );
				foreach ( $shortcodes as $shortcode_tag => $shortcode ) {
					$examples = '-';
					if ( isset( $shortcode['examples'] ) ) {
						$examples = '';
						foreach ( $shortcode['examples'] as $example ) {
							$code = '';
							$code .= '[' . $prefix . $shortcode_tag;
							if ( ! empty( $example['atts'] ) ) {
								foreach ( $example['atts'] as $att_name => $att_value ) {
									$code .= ' ' . $att_name . '="' . $att_value . '"';
								}
							}
							$code .= ']';
							if ( isset( $shortcode['type'] ) && 'enclosing' === $shortcode['type'] ) {
								if ( ! empty( $example['content'] ) ) {
									$code .= $example['content'];
								}
								$code .= '[/' . $prefix . $shortcode_tag . ']';
							}
							if ( isset( $example['desc'] ) ) {
								$examples .= '<p>' . '<em>' . $example['desc'] . '</em>' . '</p>';
							}
							$examples .= '<p>' . '<code>' . esc_html( $code ) . '</code>' . '</p>';
						}
					}
					$atts = '-';
					if ( isset( $shortcode['atts'] ) ) {
						$atts = '';
						$atts .= '<dl style="margin-top:0;">';
						foreach ( $shortcode['atts'] as $att_key => $att_data ) {
							$atts .= '<dt><tt><strong>' . $att_key . '</strong></tt></dt>' .
								'<dd>' .
									'(<em>' . ( isset( $att_data['required'] ) && true === $att_data['required'] ?
										__( 'required', 'awesome-shortcodes' ) : __( 'optional', 'awesome-shortcodes' ) ) . '</em>) ' .
									$att_data['desc'] .
									'<dl style="margin-top:0;">' .'<dd>' .
										sprintf( __( 'Default: %s', 'awesome-shortcodes' ), ( '' === $att_data['default'] ?
											'<em>' . __( 'None', 'awesome-shortcodes' ) . '</em>' : '<code>' . esc_html( $att_data['default'] ) . '</code>' ) ) .
									'</dd>' . '</dl>' .
								'</dd>';
						}
						$atts .= '</dl>';
					}
					$options[] = array(
						'title'    => '<code>[' . $prefix . $shortcode_tag . ']</code>',
						'desc'     => $shortcode['desc'] .
							( isset( $shortcode['desc_tip'] ) ? ' ' . '<em>' . $shortcode['desc_tip'] . '</em>' : '' ),
						'aliases'  => ( isset( $shortcode['aliases'] )  ? '<code>[' . implode( ']</code>, <code>[', $shortcode['aliases'] ) . ']</code>' : '-' ),
						'atts'     => $atts,
						'examples' => $examples,
						'id'       => 'alg_awesome_shortcodes_options[' . $shortcode_tag . ']',
						'default'  => 'no',
						'type'     => 'checkbox',
						'tag'      => $shortcode_tag,
						'class'    => '',
					);
				}
			}
			return $options;
		}
	}

	/**
	 * get_shortcodes_options_table.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 * @todo    (maybe) add "Activate" / "Disable" links for each shortcode (like in Plugins)
	 * @todo    (maybe) add "Example > Output". Issue is: Scripts and styles are not loaded for a) admin(`admin_enqueue_scripts`); b) disabled shortcodes (this may be solved by "Enable the shortcode to see the example output")
	 * @todo    (maybe) `screen-reader-text`
	 * @todo    (maybe) remove `plugins` class in table; `plugin-title` and `plugin-description` in td
	 */
	function get_shortcodes_options_table() {
		$desc = '';
		$type = $this->get_current_type();
		foreach ( alg_awesome_shortcodes()->core->shortcode_packs as $shortcode_pack ) {
			if ( $type === $shortcode_pack->id  ) {
				if ( isset( $shortcode_pack->desc ) ) {
					$desc = '<p>' . '<em>' . $shortcode_pack->desc . '</em>' . '</p>';
				}
				break;
			}
		}
		$html = '';
		$html .= $desc;
		$html .= '<table class="wp-list-table widefat plugins">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">' .
			__( 'Select All', 'awesome-shortcodes' ) . '</label><input id="cb-select-all-1" type="checkbox"></td>';
		$html .= '<th scope="col" id="name" class="manage-column column-name column-primary">' . __( 'Shortcode', 'awesome-shortcodes' )   . '</th>';
		$html .= '<th scope="col" id="description" class="manage-column column-description">'  . __( 'Description', 'awesome-shortcodes' ) . '</th>';
		$html .= '<th scope="col" id="atts" class="manage-column column-atts">'                . __( 'Attributes', 'awesome-shortcodes' )  . '</th>';
		$html .= '<th scope="col" id="examples" class="manage-column column-examples">'        . __( 'Examples', 'awesome-shortcodes' )    . '</th>';
		$html .= '<th scope="col" id="aliases" class="manage-column column-aliases">'          . __( 'Aliases', 'awesome-shortcodes' )     . '</th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody id="the-list">';
		$shortcodes_options = get_option( 'alg_awesome_shortcodes_options', array() );
		foreach ( $this->get_options() as $option ) {
			$actions = '';
			$actions .= '<div class="row-actions visible">';
			$actions .= '<span class="activate">';
			$actions .= '<a target="_blank" href="https://awesomeshortcodes.com/' . $option['tag'] . '/" class="edit" aria-label="">' .
				__( 'Documentation', 'awesome-shortcodes' ) . '</a>';
			$actions .= '</span>';
			$actions .= '</div>';
			$value = ( isset( $shortcodes_options[ $option['tag'] ] ) ? ( true === $shortcodes_options[ $option['tag'] ] ? 'yes' : 'no' ) : $option['default'] );
			$html .= '<tr class="' . ( 'yes' === $value ? 'active' : 'inactive' ) . '">';
			$html .= '<th scope="row" class="check-column">' .
				'<input type="hidden" value="no" name="' . $option['id'] . '">' .
				'<input type="checkbox" name="' . $option['id'] . '" value="yes" id="awesome-shortcodes-' . $option['tag'] . '"' . checked( $value, 'yes', false ) . '></th>';
			$html .= '<td class="plugin-title column-primary"><strong>'                        . $option['title'] . '</strong>' . $actions . '</td>';
			$html .= '<td class="column-description desc"><div class="plugin-description"><p>' . $option['desc'] . '</p></div>'            . '</td>';
			$html .= '<td class="column-atts desc"><div class="plugin-description">'           . $option['atts'] . '</div>'                . '</td>';
			$html .= '<td class="column-examples desc"><div class="plugin-description">'       . $option['examples'] . '</div>'            . '</td>';
			$html .= '<td class="column-aliases desc"><div class="plugin-description"><p>'     . $option['aliases'] . '</p></div>'         . '</td>';
			$html .= '</tr>';
		}
		$html .= '<tfoot>';
		$html .= '<tr>';
		$html .= '<td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">' . __( 'Select All', 'awesome-shortcodes' ) .
			'</label><input id="cb-select-all-2" type="checkbox"></td>';
		$html .= '<th scope="col" class="manage-column column-name column-primary">' . __( 'Shortcode', 'awesome-shortcodes' )   . '</th>';
		$html .= '<th scope="col" class="manage-column column-description">'         . __( 'Description', 'awesome-shortcodes' ) . '</th>';
		$html .= '<th scope="col" class="manage-column column-atts">'                . __( 'Attributes', 'awesome-shortcodes' )  . '</th>';
		$html .= '<th scope="col" class="manage-column column-examples">'            . __( 'Examples', 'awesome-shortcodes' )    . '</th>';
		$html .= '<th scope="col" class="manage-column column-aliases">'             . __( 'Aliases', 'awesome-shortcodes' )     . '</th>';
		$html .= '</tr>';
		$html .= '</tfoot>';
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}

	/**
	 * get_settings_table.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_settings_table() {
		$html = '';
		$html .= '<table class="form-table">';
		foreach ( $this->get_options() as $option ) {
			$html .= '<tr valign="top">';
			$html .= '<th scope="row">' . $option['title'] . '</th>';
			$html .= '<td>';
			$value = esc_attr( get_option( $option['id'], $option['default'] ) );
			switch ( $option['type'] ) {
				case 'select':
					$html .= '<select name="' . $option['id'] . '" class="' . $option['class'] . '">';
					foreach ( $option['options'] as $option_id => $option_name ) {
						$html .= '<option value="' . $option_id . '"' . selected( $value, $option_id, false ) . '>';
						$html .= $option_name;
						$html .= '</option>';
					}
					$html .= '</select>';
					break;
				case 'checkbox':
					$html .= '<input type="hidden" value="no" name="' . $option['id'] . '">';
					$html .= '<label for="' . $option['id'] . '">';
					$html .= '<input type="checkbox" value="yes" id="' . $option['id'] . '" name="' . $option['id'] . '" class="' . $option['class'] . '"' .
						checked( $value, 'yes', false ) . '>';
					$html .= ' ' . $option['desc'];
					$html .= '</label>';
					$html .= '<p class="description">' . $option['desc_tip'] . '</p>';
					break;
				default: // e.g. 'text'
					$html .= '<input type="' . $option['type'] . '" value="' . $value . '" name="' . $option['id'] . '" class="' . $option['class'] . '">';
					$html .= '<p class="description">' . $option['desc'] . '</p>';
					break;
			}
			$html .= '</td>';
			$html .= '</tr>';
		}
		$html .= '</table>';
		return $html;
	}

	/**
	 * get_options_table.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_options_table() {
		if ( 'shortcodes' === $this->get_current_section() ) {
			$options_table = $this->get_shortcodes_options_table();
		} else {
			$options_table = $this->get_settings_table();
		}
		return '<form method="post" action="">' .
			$options_table .
			'<p>' . '<input type="submit" name="alg_awesome_shortcodes_save_options" class="button-primary" value="' .
				__( 'Save changes', 'awesome-shortcodes' ) . '">' . '</p>' .
		'</form>';
	}

	/**
	 * get_menu.
	 *
	 * @version 1.3.0
	 * @since   1.0.0
	 */
	function get_menu() {
		$html = '';
		$html .= '<ul class="subsubsub">';
		$html .= '<li class="settings"><a href="' . add_query_arg( 'section', 'settings', remove_query_arg( 'type' ) ) . '" class="' .
			( 'settings' === $this->get_current_section() ? 'current' : '' ) . '">' . __( 'Settings', 'awesome-shortcodes' ) . '</a> |</li>';
		$html .= '<li class="shortcodes"><a href="' . add_query_arg( 'section', 'shortcodes', remove_query_arg( 'type' ) ) . '" class="' .
			( 'shortcodes' === $this->get_current_section() ? 'current' : '' ) . '">' . __( 'Shortcodes', 'awesome-shortcodes' ) . '</a></li>';
		$html .= '</ul>';
		$html .= '<div class="clear"></div>';
		if ( 'shortcodes' === $this->get_current_section() ) {
			$type = $this->get_current_type();
			$html .= '<ul class="subsubsub">';
			$types = array();
			foreach ( alg_awesome_shortcodes()->core->shortcode_packs as $shortcode_pack ) {
				$types[] = '<li class="' . $shortcode_pack->id . '">' .
					'<a href="' . add_query_arg( 'type', $shortcode_pack->id ) . '" class="' . ( $shortcode_pack->id === $type ? 'current' : '' ) . '">' .
						$shortcode_pack->title . ' <span class="count">(' . count( $shortcode_pack->shortcodes ) . ')</span>' .
					'</a>' .
				'</li>';
			}
			$html .= implode( ' | ', $types );
			$html .= '</ul>';
			$html .= '<div class="clear"></div>';
		}
		return $html;
	}

	/**
	 * output_admin_settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function output_admin_settings() {
		$html = '';
		$html .= '<div class="wrap">';
		$html .= '<h1>' . __( 'Awesome Shortcodes', 'awesome-shortcodes' ) . '</h1>';
		$html .= $this->get_menu();
		$html .= '<h2>' . ( 'settings' === $this->get_current_section() ? __( 'Options', 'awesome-shortcodes' ) : __( 'Shortcodes', 'awesome-shortcodes' ) ) . '</h2>';
		$html .= $this->get_options_table();
		$html .= '</div>';
		echo $html;
	}

}

endif;

return new Alg_Awesome_Shortcodes_Admin_Settings();
