<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Plugin Name: Car Dealer Inventory - WP1Stop
Plugin URI: http://www.wp1stop.com
Description: Allows you to add a Car Dealer Inventory to your Wordpress site
Version: 1.0
Author: PohlMedia
Author URI: http://www.pohlmedia.com
/* ----------------------------------------------*/

$new_meta_boxes =
array(
"thumbnail" => array( "name" => "thumbnail", "std" => "", "title" => "Thumbnail", "description" => "Using the \"<em>Add an Image</em>\" button, upload an image and paste the URL here."),
"year" => array( "name" => "year", "std" => "", "title" => "Year", "description" => "Enter the year of the vehicle"),
"color" => array( "name" => "color", "std" => "", "title" => "Color", "description" => "Color of the vehicle"),
"doors" => array( "name" => "doors", "std" => "", "title" => "Doors", "description" => "Amount of Doors"),
"drivetrain" => array( "name" => "drivetrain", "std" => "", "title" => "Drivetrain", "description" => "Drivetrain of the vehicle"),
"engine" => array( "name" => "engine", "std" => "", "title" => "Engine", "description" => "Size of engine of the vehicle"),
"features" => array( "name" => "features", "std" => "", "title" => "Features", "description" => "List Features"),
"mileage" => array( "name" => "mileage", "std" => "", "title" => "Mileage", "description" => "Amount of miles of the vehicle"),
"price" => array( "name" => "price", "std" => "", "title" => "Price", "description" => "Price for Sale"),
"stock" => array( "name" => "stock", "std" => "", "title" => "Stock", "description" => "Stock # of the vehicle"),
"transmission" => array( "name" => "transmission", "std" => "", "title" => "Transmission", "description" => "Type of Transmission"),
"vin" => array( "name" => "vin", "std" => "", "title" => "Vin", "description" => "Enter the vin # of the vehicle")


);




function new_meta_boxes() {
global $post, $new_meta_boxes;

foreach($new_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

if($meta_box_value == "")
$meta_box_value = $meta_box['std'];

echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

echo'<h2>'.$meta_box['title'].'</h2>';

echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';

echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';

}


}




function create_meta_box() {
global $theme_name;
if ( function_exists('add_meta_box') ) {
add_meta_box( 'new-meta-boxes', 'Car Dealer Post Settings', 'new_meta_boxes', 'post', 'normal', 'high' );
}
}




function save_postdata( $post_id ) {
global $post, $new_meta_boxes;

foreach($new_meta_boxes as $meta_box) {
// Verify
if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
return $post_id;
}

if ( 'page' == $_POST['post_type'] ) {
if ( !current_user_can( 'edit_page', $post_id ))
return $post_id;
} else {
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
}

$data = $_POST[$meta_box['name'].'_value'];

if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
update_post_meta($post_id, $meta_box['name'].'_value', $data);
elseif($data == "")
delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
}



add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');





// This just echoes the chosen line, we'll position it later
function filter_cardealer($content) {
    $mydealergrid = "[cardealer]";
	
	$price = c2c_get_custom('price_value');
	$year = c2c_get_custom('year_value');
	$miles = c2c_get_custom('mileage_value');
	$drive = c2c_get_custom('drivetrain_value');
	$engine = c2c_get_custom('engine_value');
	$stock = c2c_get_custom('stock_value');
	$vin = c2c_get_custom('vin_value');
	$transmission = c2c_get_custom('transmission_value');
$color = c2c_get_custom('color_value');
$doors = c2c_get_custom('doors_value');	

$thumbnail =  c2c_get_custom('thumbnail_value');;

	
	
	
	
	 $cardealgrid = " 	
	 
	 <a class=\"shutter\" href=\"$thumbnail\" rel=\"bookmark\"><img style=\"margin-top:10px; \" src=\"$thumbnail\" width=\"300\"  hspace=\"15\" title=\"\" /></a><br />
	 
	 <div id=\"dealer\" style=\"width=600px;\">
				
				  <strong> Price:</strong> $price <br>
                  <strong>Year:</strong>  $year
				
				  <br />
                  <strong>Mileage</strong>: $miles<br>
                  <strong>Color</strong>:  $color
			
				  <strong><br />
				  Drivetrain</strong>:  $drive<strong> <br />
				  Engine:</strong>  $engine
			
				  <strong><br />
				  Doors</strong>:  $door  
				  <br />
				  <strong>Stock:</strong>  $stock
				
				  <strong><br />
				  VIN:</strong> $vin <br />

				  <strong>Transmission:</strong>  $transmission</div>
	 
	 
	 
	 ";
	
    $content=str_ireplace($mydealergrid,$cardealgrid,$content);
    return $content;
}
// Now we set that function up to execute when the admin_footer action is called

add_filter ( 'the_content', 'filter_cardealer' );



?>