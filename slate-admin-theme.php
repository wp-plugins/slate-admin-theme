<?php

/*
Plugin Name: Slate Admin Theme
Plugin URI: http://sevenbold.com/wordpress/
Description: A clean, simplified WordPress Admin theme
Author: Ryan Sommers
Version: 1.1
Author URI: http://sevenbold.com/
*/

function slate_files() {
  wp_enqueue_style( 'slate-admin-theme', plugins_url('css/slate.css', __FILE__), array(), '1.1' );
  wp_enqueue_script( 'slate', plugins_url( "js/slate.js", __FILE__ ), array( 'jquery' ), '1.1', true );
}
add_action( 'admin_enqueue_scripts', 'slate_files' );
add_action( 'login_enqueue_scripts', 'slate_files' );

function slate_add_editor_styles() {
    add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}
add_action( 'after_setup_theme', 'slate_add_editor_styles' );

add_filter('admin_footer_text', 'slate_admin_footer_text_output');
function slate_admin_footer_text_output($text) {
	$text = 'WordPress Admin Theme <a href="http://wordpress.org/plugins/slate-admin-theme/" target="_blank">Slate</a> by <a href="http://sevenbold.com/wordpress/" target="_blank">Seven Bold</a>. Check out <a href="http://sevenbold.com/wordpress/slate-pro/" target="_blank">Slate Pro</a> for extra features + white label.';
  return $text;
}

add_action( 'admin_head', 'slate_colors' );
add_action( 'login_head', 'slate_colors' );
function slate_colors() {
	include( 'css/dynamic.php' );
}
function slate_get_user_admin_color(){
	$user_id = get_current_user_id();
	$user_info = get_userdata($user_id);
	if ( !( $user_info instanceof WP_User ) ) {
		return; 
	}
	$user_admin_color = $user_info->admin_color;
	return $user_admin_color;
}

?>
