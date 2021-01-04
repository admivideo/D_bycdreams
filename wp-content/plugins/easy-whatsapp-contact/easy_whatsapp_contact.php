<?php
/*
Plugin Name: Easy Contact Chat
Plugin URI: http://wordpress.org/extend/plugins/easy-whatsapp-contact
Description: This plugin displays a WhatsApp contact chat. The perfect solution for your ecommerce or blog.
Author: Squaresfere
Version: 1.5.4
Author URI: http://squaresfere.com
Text Domain: easy-whatsapp-contact
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'ABSPATH not defined' );
define ('WACT_VERSION', '1.5.4');
add_action( 'init', 'wact_contact_textdomain' );
add_action('wp_footer', 'wact_base_code');
add_shortcode('wact_contact', 'wact_shortcode');
add_shortcode('wact_icon', 'wact_shortcode_icon');
wp_enqueue_style('wact-style', plugin_dir_url(__FILE__). 'resources/css/wact-style.css', array(), WACT_VERSION);

if(is_admin()) {
	add_action('admin_menu', 'wact_plugin_setup_menu');
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wact_contact_plugin_links' );
}


function wact_contact_textdomain() {
    load_plugin_textdomain( 'easy-whatsapp-contact', FALSE, plugin_basename(dirname(__FILE__)) . '/languages' );
}


function wact_contact_plugin_links ($links) {
	$settings_link = '<a href="admin.php?page=easy-whatsapp-contact">' . __( 'Settings', 'easy-whatsapp-contact' ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}


function wact_plugin_setup_menu(){
	add_menu_page(
	 'Easy Contact Chat',
	 'Easy Contact Chat',
	 'manage_options',
	 'easy-whatsapp-contact',
	 'wact_admin',
	 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyMy4wLjMsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDIwIDM0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyMCAzNDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxwYXRoIGQ9Ik0xMCw5TDEwLDljLTQuNCwwLTgsMy42LTgsOGMwLDEuOCwwLjYsMy40LDEuNSw0LjdsLTEsM2wzLjEtMUM2LjksMjQuNSw4LjQsMjUsMTAsMjVjNC40LDAsOC0zLjYsOC04UzE0LjQsOSwxMCw5eg0KCQkJIE0xNC43LDIwLjNjLTAuMiwwLjUtMSwxLTEuNiwxLjFjLTAuNCwwLjEtMSwwLjItMi44LTAuNmMtMi40LTEtMy45LTMuNC00LTMuNWMtMC4xLTAuMi0wLjktMS4zLTAuOS0yLjRzMC42LTEuNywwLjgtMS45DQoJCQljMC4yLTAuMiwwLjUtMC4zLDAuOC0wLjNjMC4xLDAsMC4yLDAsMC4zLDBjMC4yLDAsMC40LDAsMC41LDAuNGMwLjIsMC41LDAuNywxLjYsMC43LDEuN2MwLjEsMC4xLDAuMSwwLjMsMCwwLjQNCgkJCWMtMC4xLDAuMi0wLjEsMC4yLTAuMywwLjRTOCwxNS44LDcuOSwxNmMtMC4xLDAuMS0wLjIsMC4zLTAuMSwwLjVjMC4xLDAuMiwwLjYsMSwxLjMsMS42YzAuOSwwLjgsMS42LDEsMS45LDEuMg0KCQkJYzAuMiwwLjEsMC40LDAuMSwwLjYtMC4xYzAuMi0wLjIsMC40LTAuNSwwLjYtMC44YzAuMi0wLjIsMC40LTAuMywwLjYtMC4yYzAuMiwwLjEsMS40LDAuNiwxLjYsMC44YzAuMiwwLjEsMC40LDAuMiwwLjQsMC4zDQoJCQlDMTQuOSwxOS4zLDE0LjksMTkuOCwxNC43LDIwLjN6Ii8+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo='
 	);
}

function wact_admin() {
	include_once plugin_dir_path(__FILE__) . 'includes/wact-admin.php';
}


function wact_base_code(){
	include_once plugin_dir_path(__FILE__) . 'includes/wact-floating-icon.php';
	wact_floating_icon();
}


function wact_shortcode($atts){
 	include_once plugin_dir_path(__FILE__) . 'includes/wact-shortcode.php';
 	return wact_shortcode_button();
}

function wact_shortcode_icon($atts){
 	include_once plugin_dir_path(__FILE__) . 'includes/wact-floating-icon.php';
 	return wact_floating_icon(true);
}


?>