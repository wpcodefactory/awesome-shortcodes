=== Awesome Shortcodes ===
Contributors: wpcodefactory, algoritmika, anbinder
Tags: shortcode, shortcodes, awesome
Tested up to: 6.7
Stable tag: 1.7.3
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Awesome shortcodes.

== Description ==

[Awesome Shortcodes](https://awesomeshortcodes.com/) is an awesome collection of shortcodes.

Currently included shortcode packs:

* General shortcodes.
* Text shortcodes.
* Posts shortcodes.
* Users shortcodes.
* WooCommerce shortcodes.

### &#9989; General Shortcodes ###

* `[copyright]` - Shortcode displays copyright symbol.
* `[countdown]` - Creates a countdown timer. Updated every second.
* `[dashicon]` - Shortcode displays WordPress dash icon.
* `[date]` - Displays current date.
* `[font_awesome]` - Shortcode displays Font Awesome icons.
* `[google_map]` - Shortcode displays Google Map for selected coordinates.
* `[hide]` - Hides content. Useful for commenting.
* `[login_url]` - Shortcode displays your WordPress site login URL.
* `[meter]` - Shortcode is used to measure data within a given range (a gauge). Uses HTML `<meter>` [tag](https://www.w3schools.com/TAGs/tag_meter.asp).
* `[number_counter]` - Creates an animated number counter.
* `[option]` - Shortcode displays WordPress option value. Uses WordPress `get_option()` [function](https://developer.wordpress.org/reference/functions/get_option/).
* `[progress]` - Shortcode displays the progress of a task. Uses HTML `<progress>` [tag](https://www.w3schools.com/TAGs/tag_progress.asp).
* `[table]` - Displays HTML table.
* `[timenow]` - Shows current time in `HH:MM:SS` format. Updated every second.
* `[total_categories]` - Shortcode displays total categories count on your site.
* `[total_tags]` - Shortcode displays total tags count on your site.
* `[total_taxonomy]` - Shortcode displays total taxonomy terms count on your site.
* `[youtube]` - Shortcode displays embedded YouTube video.

### &#9989; Text Shortcodes ###

* `[code]` - Wrap contents in `<code>` tag. Useful for displaying a piece of computer code.
* `[details]` - Creates an interactive widget that user can open and close. Uses HTML `<details>` [tag](https://www.w3schools.com/tags/tag_details.asp).
* `[flash]` - Creates flashing text effect with CSS.
* `[is_user_logged_in]` - Hides text from users who are not logged in.
* `[is_user_role]` - Shows text by user role.
* `[strikeout]` - Strikeouts content.
* `[text3d]` - Creates 3D text with CSS.

### &#9989; Posts Shortcodes ###

* `[post_id]` - Displays current post ID.
* `[post_meta]` - Displays post meta field value.
* `[posts]` - Displays posts. Check [WP_Query page](https://developer.wordpress.org/reference/classes/wp_query/) for more info on params.
* `[total_posts]` - Displays total number of posts in your site.

### &#9989; Users Shortcodes ###

* `[total_users]` - Shortcode displays the count of users having each role, or the count of all users.
* `[user_display_name]` - Displays current user display name. If user is not logged, nothing is displayed.
* `[user_email]` - Displays current user email. If user is not logged, nothing is displayed.
* `[user_first_name]` - Displays current user first name. If user is not logged, nothing is displayed.
* `[user_id]` - Displays current user ID. If user is not logged, nothing is displayed.
* `[user_ip]` - Displays current user IP.
* `[user_last_name]` - Displays current user last name. If user is not logged, nothing is displayed.
* `[user_location]` - Displays current user location (i.e., country).
* `[user_login]` - Displays current user login (i.e., username). If user is not logged, nothing is displayed.
* `[user_property]` - Displays current user selected property. If user is not logged, nothing is displayed.

### &#9989; WooCommerce Shortcodes ###

* `[wc_current_currency_code]` - Shortcode displays current WooCommerce currency code. Useful for multi-currency sites.
* `[wc_current_currency_symbol]` - Shortcode displays current WooCommerce currency symbol. Useful for multi-currency sites.
* `[wc_login_form]` - Displays WooCommerce login form for not logged in users. If user is already logged in, nothing is displayed.
* `[wc_product_dimensions]` - Displays WooCommerce product dimensions.
* `[wc_product_id]` - Shortcode displays current WooCommerce product ID.
* `[wc_product_price_html]` - Shortcode displays WooCommerce product full price with currency symbol.

### &#9989; More ###

* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!
* If you wish to contribute, join in on our [GitHub repository](https://github.com/wpcodefactory/awesome-shortcodes).
* [Visit plugin site](https://awesomeshortcodes.com/).

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Start by visiting plugin settings at "Settings > Awesome Shortcodes".

== Changelog ==

= 1.7.3 - 09/03/2025 =
* Fix - Cross-Site Scripting (XSS) vulnerability.
* Tested up to: 6.7.

= 1.7.2 - 27/03/2024 =
* Dev - `[total_posts]` - `categories` attribute added.
* Dev - `[total_users]` - Code refactoring.
* Dev - `[total_users]` - `customer` example updated.

= 1.7.1 - 07/03/2024 =
* Dev - `[total_taxonomy]`, `[total_categories]` - `parent` attribute can now be set to `current`.
* Dev - Admin - Shortcode descriptions updated.
* Tested up to: 6.4.

= 1.7.0 - 28/11/2022 =
* Dev - Localisation - The `load_plugin_textdomain()` function moved to the `init` action.
* Dev - The plugin is initialized on the `plugins_loaded` action now.
* Dev - Code refactoring.
* Tested up to: 6.1.
* Readme.txt updated.
* Deploy script added.

= 1.6.0 - 16/12/2019 =
* Dev - `[is_user_role]` shortcode added.
* Dev - `[is_user_logged_in]` shortcode added.
* Dev - Admin settings - All user input is sanitized now.
* Dev - Code refactoring.
* Tested up to: 5.3.

= 1.5.8 - 05/12/2017 =
* Dev - readme.txt updated.

= 1.5.7 - 05/12/2017 =
* Dev - readme.txt updated.

= 1.5.6 - 04/12/2017 =
* Dev - readme.txt updated.

= 1.5.5 - 26/11/2017 =
* Dev - POT file updated.

= 1.5.4 - 16/11/2017 =
* Dev - `[copyright]` shortcode added.

= 1.5.3 - 16/11/2017 =
* Dev - readme.txt updated.

= 1.5.2 - 15/11/2017 =
* Dev - `[font_awesome]` shortcode added.
* Dev - `[dashicon]` - Removed cutting `dashicons-` in `icon` attribute.
* Dev - `Alg_Abstract_Awesome_Shortcodes_Pack` - PHP 7 compatibility - "Function name must be a string..." message fixed.

= 1.5.1 - 18/10/2017 =
* Dev - `[wc_current_currency_symbol]` shortcode added.
* Dev - `[wc_current_currency_code]` shortcode added.
* Fix - `count_terms()` - Checking for `is_wp_error()` (returned for non existing taxonomies).
* Dev - Examples - `on_zero` attribute added to `[total_taxonomy]`, `[total_tags]` and `[total_categories]` examples.

= 1.5.0 - 15/10/2017 =
* Dev - `[login_url]` shortcode added.
* Dev - `[total_taxonomy]` shortcode added.
* Dev - `[total_tags]` shortcode added.
* Dev - `[total_categories]` shortcode added.
* Dev - `[youtube]` shortcode added.
* Dev - Admin - More options (`before` and `after`) added to examples.

= 1.4.1 - 13/10/2017 =
* Fix - `[google_map]` - Attributes was wrongly marked as required.
* Dev - Admin - Enabled shortcodes count added in sub-menu.

= 1.4.0 - 12/10/2017 =
* Dev - `[dashicon]` shortcode added.
* Dev - `[google_map]` shortcode added.
* Dev - `[meter]` shortcode added.
* Dev - `[progress]` shortcode added.
* Dev - `[wc_product_price_html]` shortcode added.
* Dev - `[wc_product_id]` shortcode added.
* Dev - Admin - `type` address argument replaced with `pack`.

= 1.3.1 - 03/10/2017 =
* Dev - `[total_users]` shortcode added.
* Dev - `[option]` shortcode added.
* Dev - `strip_tags` common attribute added.
* Dev - `Alg_Abstract_Awesome_Shortcodes_Pack` - `func` rewritten, so now it's possible to call global functions.

= 1.3.0 - 02/10/2017 =
* Dev - `[wc_product_dimensions]` shortcode added.
* Dev - `[wc_login_form]` shortcode added.
* Dev - `[user_location]` shortcode added.
* Dev - `[user_ip]` shortcode added.
* Dev - `[details]` shortcode added.
* Dev - `[number_counter]` shortcode added.
* Dev - `[post_meta]` - `array_glue` attribute added.
* Dev - `do_shortcode_atts` and `do_shortcode_content` common attributes added.
* Dev - `lang` and `not_lang` common attributes added.
* Dev - "WooCommerce" shortcodes pack added.
* Dev - Admin - Shortcodes count added in sub-menu.
* Dev - Developers - `awesome_shortcodes_packs` and `awesome_shortcodes_pack_{$pack->id}` filters added.

= 1.2.0 - 29/09/2017 =
* Fix - `[post_id]` - Example fixed.
* Dev - `[user_login]` shortcode added.
* Dev - `[user_email]` shortcode added.
* Dev - `[user_first_name]` shortcode added.
* Dev - `[user_last_name]` shortcode added.
* Dev - `[user_display_name]` shortcode added.
* Dev - `[user_id]` shortcode added.
* Dev - `[user_property]` shortcode added.
* Dev - `[total_posts]` shortcode added.
* Dev - `[posts]` - Example added.
* Dev - `on_zero` common attribute added.
* Dev - "Users" shortcodes pack added.

= 1.1.0 - 28/09/2017 =
* Dev - `[posts]` - `sep`, `max_posts`, `output_format`, `post_type`, `post_status`, `orderby`, `order` attributes added.
* Dev - `[post_id]` shortcode added.
* Dev - `[post_meta]` shortcode added.
* Dev - "Posts" shortcodes pack added (and `[posts]` shortcode moved from "General" pack).
* Dev - Admin - Shortcodes settings restyling, documentation link (https://awesomeshortcodes.com) added etc.

= 1.0.0 - 26/09/2017 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
