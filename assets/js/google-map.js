/**
 * [google_map].
 *
 * @version 1.4.0
 * @since   1.4.0
 * @todo    multiple maps (i.e. use `class` instead of `id`)
 */

if(0!=jQuery("#awesome-shortcode-google-map").length) {
	jQuery.getScript("https://maps.googleapis.com/maps/api/js?key="+jQuery("#awesome-shortcode-google-map").attr("api-key")+"&callback=awesome_shortcode_google_map");
	function awesome_shortcode_google_map() {
		var mapCanvas = jQuery("#awesome-shortcode-google-map")[0];
		var mapOptions = {
			center: new google.maps.LatLng(jQuery("#awesome-shortcode-google-map").attr("center-latitude"), jQuery("#awesome-shortcode-google-map").attr("center-longitude")),
			zoom: parseInt(jQuery("#awesome-shortcode-google-map").attr("zoom")),
			mapTypeId: jQuery("#awesome-shortcode-google-map").attr("map-type-id"),
		};
		var map = new google.maps.Map(mapCanvas, mapOptions);
	}
}
