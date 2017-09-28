/**
 * [countdown].
 *
 * @version 1.0.0
 * @since   1.0.0
 */
jQuery(document).ready(function() {
	var x = setInterval(function() {
		jQuery(".awesome-shortcode-countdown").each( function () {
			var countdown = new Date(jQuery(this).attr("date-to")).getTime();
			var now       = new Date().getTime();
			var distance  = countdown - now;
			var days      = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours     = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes   = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds   = Math.floor((distance % (1000 * 60)) / 1000);
			jQuery(this).html( days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
			if (distance < 0) {
				jQuery(this).html('');
			}
		});
	}, 1000);
});
