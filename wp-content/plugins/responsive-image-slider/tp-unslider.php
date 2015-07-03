<?php
/*
Plugin Name: Responsive Image Slider
Plugin URI: http://www.trickspanda.com
Description: Responsive Image Slider is the most simple & amazing responsive image slider ever.
Author: Hardeep Asrani
Version: 1.6
Author URI: http://www.hardeepasrani.com
*/

add_action('wp_enqueue_scripts', 'tp_unslider_assets');

function tp_unslider_assets()
{

wp_register_script('unslider', plugins_url('assets/unslider.js', __FILE__));
wp_enqueue_style('unslider-css', plugins_url('assets/unslider.css', __FILE__));
wp_enqueue_script('jquery');
wp_enqueue_script('unslider');
};

function tp_unslider_jquery()
{
$unspeed = get_option('unsoption_speed');
$undelay = get_option('unsoption_delay');
$unkeys = get_option('unsoption_keys');
$undots = get_option('unsoption_dots');
$unfluid = get_option('unsoption_fluid');
?>
<script type="text/javascript">
jQuery('.unslider').unslider({
<?php
if( !empty($unspeed) ) {
    echo '    speed: '.$unspeed.',               //  The speed to animate each slide (in milliseconds) '."\r\n";
}
else {
    echo '    speed: 500,               //  The speed to animate each slide (in milliseconds) '."\r\n";
}

if( !empty($undelay) ) {
    echo '    delay: '.$undelay.',               //  The delay between slide animations (in milliseconds) '."\r\n";
}
else {
    echo '    delay: 3000,               //  The delay between slide animations (in milliseconds) '."\r\n";
}
if( !empty($unkeys) ) {
    echo '    keys: '.$unkeys.',               //  Enable keyboard (left, right) arrow shortcuts '."\r\n";
}
else {
    echo '    keys: true,               //  Enable keyboard (left, right) arrow shortcuts '."\r\n";
}
if( !empty($undots) ) {
    echo '    dots: '.$undots.',               //  Display dot navigation '."\r\n";
}
else {
    echo '    dots: true,               //  Display dot navigation '."\r\n";
}
if( !empty($unfluid) ) {
    echo '    fluid: '.$unfluid.'             //  Support responsive design. May break non-responsive designs '."\r\n";
}
else {
    echo '    fluid: true              //  Support responsive design. May break non-responsive designs '."\r\n";
}
?>
});
</script>
<?php
}

add_action('wp_footer', 'tp_unslider_jquery');
add_filter('widget_text', 'do_shortcode');

include( plugin_dir_path( __FILE__ ) . 'plugin-options.php');
include( plugin_dir_path( __FILE__ ) . 'shortcode.php');
include( plugin_dir_path( __FILE__ ) . 'post-type.php');

function tp_action_init()
{
// Localization
load_plugin_textdomain('tp_unslider', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
}

// Add actions
add_action('init', 'tp_action_init');
?>