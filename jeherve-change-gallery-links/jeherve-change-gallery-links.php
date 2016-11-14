<?php
/**
 * Plugin Name: Change Gallery Links
 * Plugin URI: http://jetpack.com
 * Description: Change the link value for all links in the Gallery using the ID 4.
 * Author: Automattic
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 *
 * @package Jetpack Addons
 */

/**
 * Change the link value for all links in the Gallery using the ID 4.
 */
function jeherve_custom_gallery_four_link() {
?>
<script type="text/javascript">
	jQuery("#gallery-4 a").attr("href", "https://www.houzz.com/pro/hooverarchitecture/");
</script>
<?php
}
add_action( 'wp_footer', 'jeherve_custom_gallery_four_link' );
