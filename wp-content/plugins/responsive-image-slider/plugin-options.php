<?php
function unsoption_register_settings() {
    add_option( 'unsoption_speed', '500');
    add_option( 'unsoption_delay', '3000');
    add_option( 'unsoption_keys');
    add_option( 'unsoption_dots');
    add_option( 'unsoption_fluid');
    register_setting( 'unslider_table', 'unsoption_speed' ); 
    register_setting( 'unslider_table', 'unsoption_delay' ); 
    register_setting( 'unslider_table', 'unsoption_keys' ); 
    register_setting( 'unslider_table', 'unsoption_dots' ); 
    register_setting( 'unslider_table', 'unsoption_fluid' ); 
} 
add_action( 'admin_init', 'unsoption_register_settings' );
 
function unsoption_register_options_page() {
	add_options_page('Responsive Image Slider', 'Responsive Image Slider', 'manage_options', 'unsoption-options', 'unsoption_options_page');
}
add_action('admin_menu', 'unsoption_register_options_page');
 
function unsoption_options_page() {
	?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('Responsive Image Slider', 'tp_unslider'); ?></h2>
	<form method="post" action="options.php"> 
		<?php settings_fields( 'unslider_table' ); ?>
			<table class="form-table">
    			<tr valign="top">
					<th scope="row"><label for="unsoption_speed"><?php _e('Slider Speed', 'tp_unslider'); ?>:</label></th>
					<td><input type="text" id="unsoption_speed" name="unsoption_speed" value="<?php echo get_option('unsoption_speed'); ?>" /></td>
				</tr>
    			<tr valign="top">
					<th scope="row"><label for="unsoption_delay"><?php _e('Delay In Slides', 'tp_unslider'); ?>:</label></th>
					<td><input type="text" id="unsoption_delay" name="unsoption_delay" value="<?php echo get_option('unsoption_delay'); ?>" /></td>
				</tr>
                <tr valign="top">
    				<th scope="row"><label for="unsoption_keys"><?php _e('Keyboard Navigation', 'tp_unslider'); ?>:</label></th>
					<td><select id="unsoption_keys" name="unsoption_keys" value="<?php
	echo get_option('unsoption_keys'); ?>">
					    <option value="true" <?php
	if (get_option('unsoption_keys') == 'true') echo 'selected="selected"'; ?>><?php _e('Yes', 'tp_unslider'); ?></option>
					    <option value="false" <?php
	if (get_option('unsoption_keys') == 'false') echo 'selected="selected"'; ?>><?php _e('No', 'tp_unslider'); ?></option>
					  </select></td>
				</tr>
                <tr valign="top">
    				<th scope="row"><label for="unsoption_dots"><?php _e('Display Navigation', 'tp_unslider'); ?>:</label></th>
					<td><select id="unsoption_dots" name="unsoption_dots" value="<?php
	echo get_option('unsoption_dots'); ?>">
					    <option value="true" <?php
	if (get_option('unsoption_dots') == 'true') echo 'selected="selected"'; ?>><?php _e('Yes', 'tp_unslider'); ?></option>
					    <option value="false" <?php
	if (get_option('unsoption_dots') == 'false') echo 'selected="selected"'; ?>><?php _e('No', 'tp_unslider'); ?></option>
					  </select></td>
				</tr>
                <tr valign="top">
    				<th scope="row"><label for="unsoption_fluid"><?php _e('Responsive Design', 'tp_unslider'); ?>:</label></th>
					<td><select id="unsoption_fluid" name="unsoption_fluid" value="<?php
	echo get_option('unsoption_fluid'); ?>">
					    <option value="true" <?php
	if (get_option('unsoption_fluid') == 'true') echo 'selected="selected"'; ?>><?php _e('Yes', 'tp_unslider'); ?></option>
					    <option value="false" <?php
	if (get_option('unsoption_fluid') == 'false') echo 'selected="selected"'; ?>><?php _e('No', 'tp_unslider'); ?></option>
					  </select></td>
				</tr>
			</table>
		<?php submit_button(); ?>
	</form>
</div>
<?php
}
?>