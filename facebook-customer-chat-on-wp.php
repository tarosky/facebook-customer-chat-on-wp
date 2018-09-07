<?php
/**
 * Plugin Name: Facebook Customer Chat on WP
 * Plugin URI: https://wordpress.org/plugin/facebook-customer-chat-on-wp
 * Description: A WordPress plugin to display customer chat on WordPress.
 * Author: TAROSKY INC
 * Version: 0.1.0
 * Author URI: https://tarosky.co.jp
 * Text Domain: fbchat
 * Domain Path: /languages/
 *
 */

defined( 'ABSPATH' ) || die( 'Do not load directly' );

/**
 * Boostrap plugin
 */
function fbchat_init() {
	load_plugin_textdomain( 'fbchat', false, basename( dirname( __FILE__ ) ) . '/languages' );
	if ( version_compare( phpversion(), '5.4.0', '<' ) ) {
		add_action( 'admin_notices', 'fbchat_version_error' );
	} else {
		$hook_dir = __DIR__ . '/hooks';
		if ( is_dir( $hook_dir ) ) {
			foreach ( scandir( $hook_dir ) as $file ) {
				if ( preg_match( '#^[^._].*\.php$#u', $file ) ) {
					require $hook_dir . '/' . $file;
				}
			}
		}
	}
}
add_action( 'plugins_loaded', 'fbchat_init' );


/**
 * Display error message.
 */
function fbchat_version_error() {
	printf( '<div class="error"><p>%s</p></div>', sprintf( esc_html__( '[FB Chat] Your PHP version is %s and too low. PHP 5.4 and later is required.', 'fbchat' ), phpversion() ) );
}
