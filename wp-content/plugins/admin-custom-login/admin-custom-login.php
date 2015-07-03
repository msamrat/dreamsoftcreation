<?php
/**
 * Plugin Name: Admin Costum Login
 * Version: 1.0
 * Responsive Login Form Allow You Setting Of login Form.
 * Author: weblizar
 * Author URI: http://www.weblizar.com
 * Plugin URI: http://weblizar.com/plugins/admin-custom-login
 */

define("WEBLIZAR_NALF_PLUGIN_URL", plugin_dir_url(__FILE__));
define("WEBLIZAR_ACL", "WEBLIZAR_ACL" );

add_action('plugins_loaded', 'ACL_GetReadyTranslation');
function ACL_GetReadyTranslation() {
	load_plugin_textdomain(WEBLIZAR_ACL, FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

/**
 * Admin Costume Login installation script
 */
register_activation_hook( __FILE__, 'ACL_WeblizarDoInstallation' );
function ACL_WeblizarDoInstallation() {
    require_once('installation.php');
}

/**
 * Admin Costume Login menu
 */
require_once("login-form-screen.php");
add_action('admin_menu','acl_weblizar_admin_custom_login_menu');
function acl_weblizar_admin_custom_login_menu() {
    //plugin menu name for Admin Costume Login
    $acl_menu = add_menu_page('Admin custom Login', 'Admin custom Login','administrator', 'admin_custom_login','acl_admin_custom_login_content');
    
    //add hook to add styles and scripts for Admin Costume Login admin page
    add_action( 'admin_print_styles-' . $acl_menu, 'acl_admin_custom_login_js_css' );
}

function acl_admin_custom_login_js_css() {
    //enqueue scripts page for Admin Costume Login plugin admin panel
    wp_enqueue_script('theme-preview');
	wp_enqueue_style('dashboard');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('thickbox');
	wp_enqueue_style('acl-bootstrap-css', WEBLIZAR_NALF_PLUGIN_URL.'css/bootstrap.css');
	wp_enqueue_style('acl-smartech-css', WEBLIZAR_NALF_PLUGIN_URL.'css/smartech.css');
	wp_enqueue_style('acl-jquery-ui-css', WEBLIZAR_NALF_PLUGIN_URL.'css/jquery-ui.css');
	wp_enqueue_style('acl-font-awesome_min', WEBLIZAR_NALF_PLUGIN_URL.'font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('acl-font-animate', WEBLIZAR_NALF_PLUGIN_URL.'css/animate.css');
	wp_enqueue_style('acl-fontawesome-iconpicker', WEBLIZAR_NALF_PLUGIN_URL.'css/fontawesome-iconpicker.css');

	wp_enqueue_style('acl-dialog', WEBLIZAR_NALF_PLUGIN_URL.'css/dialog/dialog.css');
	wp_enqueue_style('acl-dialog-box-style', WEBLIZAR_NALF_PLUGIN_URL.'css/dialog/dialog-box-style.css');
	wp_enqueue_style('acl-dialog-jamie', WEBLIZAR_NALF_PLUGIN_URL.'css/dialog/dialog-jamie.css');

	wp_enqueue_script('jquery');

	wp_enqueue_script('acl-media-uploads',WEBLIZAR_NALF_PLUGIN_URL.'js/acl-media-upload-script.js',array('media-upload','thickbox','jquery'));    
	wp_enqueue_script('acl-color-picker-script', WEBLIZAR_NALF_PLUGIN_URL.'js/acl-color-picker-script.js', array( 'wp-color-picker' ), false, true );

	wp_enqueue_script('acl-bootstrap-min-js',WEBLIZAR_NALF_PLUGIN_URL.'js/bootstrap.min.js');
	wp_enqueue_script('acl-metisMenu',WEBLIZAR_NALF_PLUGIN_URL.'js/plugins/metisMenu/metisMenu.min.js');	
	wp_enqueue_script('aclsmartech',WEBLIZAR_NALF_PLUGIN_URL.'js/smartech.js',array('jquery'));
	wp_enqueue_script('acl-nalf-sidebar-nav',WEBLIZAR_NALF_PLUGIN_URL.'js/nalf_sidebar_nav.js');
	wp_enqueue_script('acl-media-upload-script-2-js',WEBLIZAR_NALF_PLUGIN_URL.'js/acl-media-upload-script-2.js');
	wp_enqueue_script('acl-font-icon-picker-js',WEBLIZAR_NALF_PLUGIN_URL.'js/fontawesome-iconpicker.js');
	
	wp_enqueue_script('acl-snap-svg-min',WEBLIZAR_NALF_PLUGIN_URL.'js/dialog/snap.svg-min.js');
	wp_enqueue_script('acl-modernizr-custom',WEBLIZAR_NALF_PLUGIN_URL.'js/dialog/modernizr.custom.js');
	wp_enqueue_script('acl-classie',WEBLIZAR_NALF_PLUGIN_URL.'js/dialog/classie.js');
	wp_enqueue_script('acl-dialogFx',WEBLIZAR_NALF_PLUGIN_URL.'js/dialog/dialogFx.js'); 
}

function acl_advanced_login_form_plugin() {
	wp_enqueue_script('jquery');	
	$dashboard_page = unserialize(get_option('Admin_custome_login_dashboard'));	
	$top_page = unserialize(get_option('Admin_custome_login_top'));
	if ($top_page['top_bg_type'] == "slider-background" && $dashboard_page['dashboard_status'] == "enable"){
		wp_enqueue_script('modernizr',WEBLIZAR_NALF_PLUGIN_URL.'js/modernizr.custom.86080.js');
		wp_enqueue_style('demo', WEBLIZAR_NALF_PLUGIN_URL.'css/demo.css');
	}
	wp_enqueue_style('font-awesome_min', WEBLIZAR_NALF_PLUGIN_URL.'font-awesome/css/font-awesome.min.css');
}
add_action('login_enqueue_scripts', 'acl_advanced_login_form_plugin');

function acl_footer_func() {
	$text_and_color_page = unserialize(get_option('Admin_custome_login_text'));
	$user_input_icon = $text_and_color_page['user_input_icon'];
	$password_input_icon = $text_and_color_page['password_input_icon'];
	$enable_inputbox_icon = $text_and_color_page['enable_inputbox_icon'];
	$heading_font_color = $text_and_color_page['heading_font_color'];
	$heading_font_size = $text_and_color_page['heading_font_size'];
	$input_font_size = $text_and_color_page['input_font_size'];
	$top_page = unserialize(get_option('Admin_custome_login_top'));
	$Social_page = unserialize(get_option('Admin_custome_login_Social'));
	?>
	<script>
	jQuery(document).ready(function(){

		jQuery('html body').attr('id', 'screen');
		jQuery('#loginform label[for="user_login"]').attr('id', 'log_input_lable');
		jQuery('#loginform label[for="user_pass"]').attr('id', 'pwd_input_lable');

		<?php if($enable_inputbox_icon=='yes'){?>
		document.getElementById("log_input_lable").innerHTML="User Name<div class='input-container'> <div class='icon-ph'><i class='fa <?php echo $user_input_icon; ?>'></i></div> <input id='user_login' name='log' class='input' type='text' placeholder='User Name'></div>";
		document.getElementById("pwd_input_lable").innerHTML="Password<div class='input-container'> <div class='icon-ph'><i class='fa <?php echo $password_input_icon; ?>'></i></div> <input id='user_pass' name='pwd' class='input' type='password' placeholder='Password'></div>";
		jQuery('body.login div#login form .input, .login input[type="text"]').css('padding','5px 5px 5px 45px');
		<?php } else { ?>
		jQuery('#loginform #user_login').attr('placeholder', 'User Name');
		jQuery('#loginform #user_pass').attr('placeholder', 'Password');
		jQuery('body.login div#login form .input, .login input[type="text"]').css('padding','5px 5px 5px 5px');
		<?php }?>
		<?php if ($top_page['top_bg_type'] == "slider-background"){ ?>
		 jQuery('#screen').prepend('<ul class="cb-slideshow"> <li><span>Image 01</span></li> <li><span>Image 02</span></li> <li><span>Image 03</span></li>  <li><span>Image 04</span></li>  <li><span>Image 05</span></li> <li><span>Image 06</span></li>  </ul>')
		<?php } ?>
		
		//enable Social Icon In inner login form 
		<?php if($Social_page['enable_social_icon'] == "inner" || $Social_page['enable_social_icon'] == "both") {?>
		jQuery( ".forgetmenot" ).append('<div style="padding-top:10px"><div style="color:<?php echo $heading_font_color; ?>; font-size:<?php echo $heading_font_size;?>px; ">Connect Us :</div><div style="padding-top:5px"><?php if($Social_page['social_twitter_link']!=''){ ?><a href="<?php echo $Social_page['social_twitter_link'];?>" class="icon-button twitter"><i class="fa fa-twitter"></i><span></span></a><?php } if($Social_page['social_facebook_link']!=''){ ?> <a href="<?php echo $Social_page['social_facebook_link'];?>" class="icon-button facebook"><i class="fa fa-facebook"></i><span></span></a> <?php } if($Social_page['social_google_plus_link']!=''){ ?> <a href="<?php echo $Social_page['social_google_plus_link'];?>" class="icon-button google-plus"><i class="fa fa-google-plus"></i><span></span></a><?php } if($Social_page['social_linkedin_link']!=''){ ?> <a href="<?php echo $Social_page['social_linkedin_link'];?>" class="icon-button linkedin"> <i class="fa fa-linkedin"> </i> <span></span> </a> <?php } if($Social_page['social_pinterest_link']!=''){ ?><a href="<?php echo $Social_page['social_pinterest_link'];?>" class="icon-button pinterest"><i class="fa fa-pinterest"></i><span></span></a><?php } ?><div></div>' );
		<?php } ?>
		//enable Social Icon In outer login form 
		<?php if($Social_page['enable_social_icon'] == "outer" || $Social_page['enable_social_icon'] == "both") {?>
		jQuery( "#backtoblog" ).append('<div class="divsocial"><?php if($Social_page['social_twitter_link']!=''){?> <a href="<?php echo $Social_page['social_twitter_link']; ?>" class="icon-button twitter"><i class="fa fa-twitter"></i><span></span></a><?php } if($Social_page['social_facebook_link']!=''){?><a href="<?php echo $Social_page['social_facebook_link']; ?>" class="icon-button facebook"><i class="fa fa-facebook"></i><span></span></a> <?php } if($Social_page['social_google_plus_link']!=''){?><a href="<?php echo $Social_page['social_google_plus_link']; ?>" class="icon-button google-plus"><i class="fa fa-google-plus"></i><span></span></a><?php } if($Social_page['social_linkedin_link']!=''){?><a href="<?php echo $Social_page['social_linkedin_link']; ?>" class="icon-button linkedin"><i class="fa fa-linkedin"></i><span></span></a><?php } if($Social_page['social_pinterest_link']!=''){?><a href="<?php echo $Social_page['social_pinterest_link']; ?>" class="icon-button pinterest"><i class="fa fa-pinterest"></i><span></span></a><?php } ?></div>');
		<?php } ?>
	})
	</script>
	<?php
}
$dashboard_page = unserialize(get_option('Admin_custome_login_dashboard'));
if($dashboard_page['dashboard_status'] == "enable") {
	add_action('login_head', 'acl_footer_func');
}
	
function acl_admin_custom_login_content() {
	require_once('includes/content.php');
}
?>