/**
 * [number_counter].
 *
 * @version 1.3.0
 * @since   1.3.0
 * @see     https://codepen.io/shivasurya/pen/FatiB
 */

jQuery( document ).ready( function() {
	jQuery( '.awesome-shortcode-count' ).each( function() {
		var number_from = parseInt( jQuery( this ).attr( 'number-from' ) );
		var number_to   = parseInt( jQuery( this ).attr( 'number-to' ) );
		var _duration   = parseInt( jQuery( this ).attr( 'duration' ) );
		var _easing     = jQuery( this ).attr( 'easing' );
		jQuery( this ).prop( 'counter', number_from ).animate(
			{
				counter: number_to
			}, {
				duration: _duration,
				easing: _easing,
				step: function( now ) {
					jQuery( this ).text( Math.ceil( now ) );
				}
			}
		);
	} );
} );
