<?php
$login_Version = unserialize(get_option('Admin_custome_login_Version'));
$Version = $login_Version['Version'];
if($Version != '1.0' || $Version == ""){
	
	$login_Version= serialize(array(
		'Version' => '1.0'
	));
	add_option("Admin_custome_login_Version", $login_Version);

	$dashboard_page= serialize(array(
		'dashboard_status' => 'disable'
	));
	add_option("Admin_custome_login_dashboard", $dashboard_page);
	$top_page= serialize(array(
		'top_bg_type'=>'static-background-image',
		'top_color' => '#f9fad2',
		'top_image' =>   WEBLIZAR_NALF_PLUGIN_URL.'/images/3d-background.jpg',
		'top_cover' => 'yes',
		'top_repeat' => 'repeat',
		'top_position' => 'left top',
		'top_attachment' => 'fixed',
		'top_slideshow_no' => '6',
		'top_bg_slider_animation' => 'slider-style1',
		'top_video_url' => ''
	));
	add_option("Admin_custome_login_top", $top_page);
	$login_page= serialize(array(
		'login_bg_type'=>'static-background-image',
		'login_form_float' => 'center',
		'login_bg_color' => '#1e73be',
		'login_bg_effect' => 'pattern-1',
		'login_bg_image' => WEBLIZAR_NALF_PLUGIN_URL.'/images/3d-background.jpg',
		'login_form_opacity' => '10',
		'login_form_width' => '520',
		'login_form_radius' => '10',
		'login_border_style' => 'solid',
		'login_border_thikness' => '4',
		'login_border_color' => '#0069A0',
		'login_bg_repeat' => 'repeat',
		'login_bg_position' => 'left top',
		'login_enable_shadow' => 'yes',
		'login_shadow_color' => '#C8C8C8'
	));
	add_option("Admin_custome_login_login", $login_page);
	$text_and_color_page= serialize(array(
		'heading_font_color'=>'#ffffff',
		'input_font_color'=>'#000000',
		'link_color'=>'#ffffff',
		'button_color'=>'#dd3333',
		'heading_font_size'=>'14',
		'input_font_size'=>'18',
		'link_size'=>'14',
		'button_font_size'=>'14',
		'enable_link_shadow'=>'yes',
		'link_shadow_color'=>'#ffffff',
		'heading_font_style'=>'Arial',
		'input_font_style'=>'Arial',
		'link_font_style'=>'Arial',
		'button_font_style'=>'Arial',
		'enable_inputbox_icon'=>'yes',
		'user_input_icon'=>'fa fa-user',
		'password_input_icon'=>'fa fa-key'
	));
	add_option("Admin_custome_login_text", $text_and_color_page);
	$logo_page= serialize(array(
		'logo_image'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/default-logo.png',
		'logo_width'=>'274',
		'logo_height'=>'63',
		'logo_url'=>home_url(),
		'logo_url_title'=>'Your Site Name and Info'
	));
	add_option("Admin_custome_login_logo", $logo_page);

	$Social_page= serialize(array(
		'enable_social_icon'=> 'outer' ,
		'social_icon_size'=> 'mediam' ,
		'social_icon_layout'=> 'rectangle' ,
		'social_icon_color'=> '#ffffff' ,
		'social_icon_color_onhover'=> '#1e73be' ,
		'social_icon_bg'=> '#1e73be',
		'social_icon_bg_onhover'=> '#ffffff' ,
		'social_facebook_link'=> 'http://facebook.com' ,
		'social_twitter_link'=> 'https://twitter.com/minimalmonkey',
		'social_linkedin_link'=> 'https://in.linkedin.com/' ,
		'social_google_plus_link'=> 'http://plus.google.com' ,
		'social_pinterest_link'=> 'https://in.pinterest.com/' 
	));
	add_option("Admin_custome_login_Social", $Social_page);

	$Slidshow_image=serialize(array(
		'Slidshow_image_1'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_2'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_3'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_4'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_5'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_6'=> WEBLIZAR_NALF_PLUGIN_URL.'/images/rpg-default.jpg',
		'Slidshow_image_label_1'=> '' ,
		'Slidshow_image_label_2'=> '' ,
		'Slidshow_image_label_3'=> '' ,
		'Slidshow_image_label_4'=> '' ,
		'Slidshow_image_label_5'=> '' ,
		'Slidshow_image_label_6'=> '' 
	));
	add_option("Admin_custome_login_Slidshow", $Slidshow_image);
}
?>