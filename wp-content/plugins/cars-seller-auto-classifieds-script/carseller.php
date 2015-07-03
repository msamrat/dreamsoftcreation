<?php
/**
 * Plugin Name: carseller
 * Plugin URI: 
 * Description: carsellers plugin use this shortcode to show latest cars <strong>'[latest_cars number_of_cars_to_show]'</strong>
 * Version: 1.1.0
 * Author: Arun Kushwaha
 * Author URI:
 * License: GPL2
 */

include 'carseller-install.php';
include 'carseller-type.php';
include 'luxury-carseller.php';
include 'image_attachments.php';
include 'check_availability.php';
include 'carseller_setting.php';
include 'carseller_request_list.php';
include 'ajax_site_url.php';
include 'send_request_availability.php';
include 'get_carseller_page_template.php';
include 'category-list-widget.php';
// include 'admin-carsellers.php';
include 'nav-carsellers.php';



register_activation_hook( __FILE__, 'carsellers_install' );
register_activation_hook( __FILE__, 'carsellers_install_data' );

