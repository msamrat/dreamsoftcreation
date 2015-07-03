<?php
add_option('banner_slidereffect', 'fade' );
add_option('banner_transitiontime', '500' );
add_option('banner_pausetime', '5000' );
add_option('banner_prevnextbtn', 'true' );

add_action( 'admin_menu', 'slide_plugin_menu' );

function slide_plugin_menu() 
{
	add_options_page( 'Slider Options', 'Banner Slider', 'manage_options', 'slide-rnd-01', 'slide_plugin_options' );

// here is the code for creating my option field
	add_action( 'admin_init', 'register_banner_settings' );
}

function register_banner_settings() 
{
  register_setting( 'banner_settings_group', 'banner_slidereffect' );
  register_setting( 'banner_settings_group', 'banner_transitiontime' );
  register_setting( 'banner_settings_group', 'banner_pausetime' );
  register_setting( 'banner_settings_group', 'banner_prevnextbtn' );
}

function slide_plugin_options() 
{
	if ( !current_user_can( 'manage_options' ) )  
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
<form method="post" action="options.php">
<?php 
	settings_fields( 'banner_settings_group' ); 
	do_settings_sections( 'banner_settings_group' );
?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Slider Effect</th>
        <td>
                <select name="banner_slidereffect">
                    <option value="fade" <?php echo (get_option('banner_slidereffect')=='fade') ? 'selected="selected"' : ''; ?>>Fade</option>
                    <option value="slide" <?php echo (get_option('banner_slidereffect')=='slide') ? 'selected="selected"' : ''; ?>>Slide</option>
                </select>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">Transition Time</th>
        <td><input type="text" name="banner_transitiontime" value="<?php echo esc_attr( get_option('banner_transitiontime') ); ?>" style="width:45px;" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Pause Time</th>
        <td><input type="text" name="banner_pausetime" value="<?php echo esc_attr( get_option('banner_pausetime') ); ?>" style="width:45px;" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Previous/Next navigation button ?</th>
        <td>
                <select name="banner_prevnextbtn">
                    <option value="true" <?php echo (get_option('banner_prevnextbtn')=='true') ? 'selected="selected"' : ''; ?>>True</option>
                    <option value="false" <?php echo (get_option('banner_prevnextbtn')=='false') ? 'selected="selected"' : ''; ?>>False</option>
                </select>
        </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
<?php
}
?>