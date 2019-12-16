/**
 * [timenow].
 *
 * @version 1.0.0
 * @since   1.0.0
 */

jQuery( document ).ready( function() {
	function startTime() {
		var time = new Date();
		jQuery( ".awesome-shortcode-timenow" ).each( function() {
			jQuery( this ).html(
				( "0" + time.getHours()   ).slice( -2 ) + ":" +
				( "0" + time.getMinutes() ).slice( -2 ) + ":" +
				( "0" + time.getSeconds() ).slice( -2 ) );
		} );
		setTimeout( function() {
			startTime()
		}, 1000 );
	}
	startTime();
} );
