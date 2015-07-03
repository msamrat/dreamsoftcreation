<?php
/*
 Plugin Name: Advanced Login Form
 Plugin URI: http://wordpress.org/plugins/advanced-login-form
 Description: It is a more customize wordpress login form plugin.
 Version: 1.0
 Author: Dipto Paul
 Author URI: http://webprojectbd.blogspot.com
 License: GPL2 or later
 */
 

/*===========================================
			Files Call
===========================================**/

function advanced_login_form_plugin() {

	wp_enqueue_script( 'advanced_login_js', plugins_url( '/js/advanced-login-form.js', __FILE__ ), array('jquery'));
	wp_enqueue_style( 'advanced_font_css', plugins_url( '/css/font-awesome.min.css', __FILE__ ));
	wp_enqueue_style( 'advanced_login_css', plugins_url( '/css/advanced-login-form.css', __FILE__ ));
}
add_action('login_head', 'advanced_login_form_plugin');

/*===========================================
			Logo URL
===========================================**/

function advanced_login_form_logo_url() {

	return get_home_url( '/' );
}
add_action('login_headerurl', 'advanced_login_form_logo_url');

/*===========================================
			Header Title
===========================================**/

function advanced_login_form_header_title() {

	return 'Wordpress';
}
add_filter( 'login_headertitle', 'advanced_login_form_header_title' );

/*===========================================
			Remember Me Checked
===========================================**/

function advanced_login_checked_remember() {

	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'advanced_login_checked_remember' );

function rememberme_checked() {

echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

/*===========================================
			Redirect URL
===========================================**/

function advanced_login_form_redirect( $redirect_to, $request, $user )
	{
	global $user;
	if( isset( $user->roles ) && is_array( $user->roles ) ) {
	if( in_array( "administrator", $user->roles ) ) {
	return $redirect_to;
	} else {
	return home_url( '/' );
	}
	}
	else
	{
	return $redirect_to;
	}
	}
add_filter("login_redirect", "advanced_login_form_redirect", 10, 3);

?>