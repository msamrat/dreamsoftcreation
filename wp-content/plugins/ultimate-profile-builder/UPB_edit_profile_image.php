<?php 
	$path =  plugin_dir_url(__FILE__); // define path to link and scripts
	$pageURL = get_permalink();
	$sign = strpos($pageURL,'?')?'&':'?';
	global $wpdb;
	$upb_fields =$wpdb->prefix."upb_fields";
	$current_user = wp_get_current_user();
	$current_ID = $current_user->ID;
	 include 'UPB_theme.php'; 
	if(isset($_POST['avatar_remove']))	
	{
		if(isset($_POST['current_ID']))
		$current_ID = $_POST['current_ID'];
		update_user_meta( $current_ID, 'wp_user_avatar', '' );
		update_user_meta( $current_ID, 'avtar_image', '' );
		?>
        <style>
		.edit-profile-top-area-device{ display:none;}
		</style>
        <!--Shows options immediately after changing image from image hover option-->
        <div id="upb-form" align="center" >
        <div class="profile-updated-succ"> Your profile avatar has been remove successfully.</div>
        <div id="main-upb-form">
          <div align="center"  class="updated-successfully-upb-device" >
            <div class="all-log-device margin-left2"><a href="javascript:void(0);" onclick="javascript:history.back();">
              <div class="UltimatePB-Button"> Go back to edit profile avatar</div>
              </a> &nbsp; <a href="<?php echo $pageURL.$sign; ?>login4=1" title="Home-Page">
              <div class="UltimatePB-Button"> Go back to site </div>
              </a> </div>
          </div>
        </div>
        <?php
	}
	if(isset($EPSubmit))/*Saves new avatar after changing from image hover option*/
			{
				if(isset($_POST['current_ID']))
				$current_ID = $_POST['current_ID'];

				if(isset($_FILES['avtar_image']))
				$avtar_image = $_FILES['avtar_image'];

				if ($_FILES['avtar_image']['error'] === 0)
				{
					if ( ! function_exists( 'wp_handle_upload' ) )
					{
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}

					$upload_overrides = array( 'test_form' => false );
					$movefile = wp_handle_upload( $avtar_image, $upload_overrides );
					$image1 = $movefile['file'];
					$image = wp_get_image_editor( $image1 );

					if ( ! is_wp_error( $image ) )
					{
						$image->resize( 200, 200, true );
						$image->save( $movefile['file'] );
					}
					if ( $movefile )
					{
						$user_id = $current_ID;
						$meta_value = $movefile['url'];
						$meta_key = 'avtar_image';
						$single = true;
						// $filename should be the path to a file in the upload directory.
						$filename = $movefile['file'];
						// The ID of the post this attachment is for.
						$parent_post_id = 0;
						// Check the type of tile. We'll use this as the 'post_mime_type'.
						$filetype = wp_check_filetype( basename( $filename ), null );
						// Get the path to the upload directory.
						$wp_upload_dir = wp_upload_dir();
						// Prepare an array of post data for the attachment.
						$attachment = array(

							'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 

							'post_mime_type' => $filetype['type'],

							'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),

							'post_content'   => '',

							'post_status'    => 'inherit'

						);
						// Insert the attachment.
						$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
						// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
						require_once( ABSPATH . 'wp-admin/includes/image.php' );
						// Generate the metadata for the attachment, and update the database record.
						$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
						wp_update_attachment_metadata( $attach_id, $attach_data );
						update_user_meta( $current_ID, 'wp_user_avatar', $attach_id );
						update_user_meta( $current_ID, $meta_key, $meta_value );
					}
				}
?>
<!--Shows options immediately after changing image from image hover option-->
<div id="upb-form" align="center" >
<div class="profile-updated-succ"> Your profile avatar has been updated successfully.</div>
<div id="main-upb-form">
  <div align="center"  class="updated-successfully-upb-device" >
    <div class="all-log-device margin-left2"><a href="javascript:void(0);" onclick="javascript:history.back();">
      <div class="UltimatePB-Button"> Go back to edit profile avatar</div>
      </a> &nbsp; <a href="<?php echo $pageURL.$sign; ?>login4=1" title="Home-Page">
      <div class="UltimatePB-Button"> Go back to site </div>
      </a> </div>
  </div>
</div>
<?php

			}
			else

			{
?>
<!--HTML to show the avatar changing form box after clicking image hover option-->
<div id="upb-form" class="wrap edit-profile-top-area-device">
  <h2> Edit Profile Image </h2>
  <div class="edit-info">
    <div class="upb-button"> <a href="javascript:void(0);" onclick="javascript:history.back();"> Cancel and go back </a> </div>
  </div>
  <script type="text/javascript">
    function ValidateFileUpload() {
        var fuData = document.getElementById('avtar_image');
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {

        } else {
     var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
/*Checks if the uploaded avatar is a valid image file*/
else {
                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
				return false;
	}
        }
    }

</script>
  <div id="main-upb-form">
    <form method="post" action="" id="your-profile" enctype="multipart/form-data" onsubmit="javascript: return ValidateFileUpload();">
      <div class="formtable edit_profile_image_div">
        <div class="lable-text">
          <label for="avtar_image">Display picture publicly as</label>
        </div>
        <div class="input-box">
          <input type="file" onchange="return ValidateFileUpload()" class="regular-text" value="" id="avtar_image" name="avtar_image">
        </div>
      </div>
      <div class="customupberror" style="display:none"></div>
      <div class="UltimatePB-Button-inp1 change_avatar_button" align="center">
        <input type="hidden" name="current_ID" id="current_ID" value="<?php echo $current_ID;?>">
        <input type="submit" value="Save" class="UltimatePB-Button" id="EPSubmit" name="EPSubmit">
      </div>
    </form>
    
    <form method="post" action="" id="remove_avatar" name="remove_avatar" class="remove_current_avatar">
    <input type="hidden" name="current_ID" id="current_ID" value="<?php echo $current_ID;?>">
    <input type="submit" name="avatar_remove" id="avatar_remove" value="Remove Current Avatar" />
    </form>
    
  </div>
</div>
<!--Form HTML ends-->
<?php } ?>
