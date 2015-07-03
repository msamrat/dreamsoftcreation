<?php  
/* 
Plugin Name: Responsive Banner Slider
Plugin URI: http://www.hpinfosys.com/ 
Description: Responsive Page Banner Slider
Version: 1.0
Author: Hitesh Patel
Author URI: http://hpinfosys.com
*/ 

	$prefix='banner_slider_';

   wp_enqueue_style( 'banner-slider-style',plugins_url('css/flexslider.css', __FILE__));
   wp_enqueue_script( 'banner-slider-script',plugins_url('js/jquery.flexslider.js', __FILE__), array( 'jquery' ), false, true );

	include( plugin_dir_path( __FILE__ ) . 'responsive-banner-slider-post.php');
	include( plugin_dir_path( __FILE__ ) . 'responsive-banner-slider-template.php');
	include( plugin_dir_path( __FILE__ ) . 'responsive-banner-slider-shortcode.php');
	include( plugin_dir_path( __FILE__ ) . 'responsive-banner-slider-options.php');

?>