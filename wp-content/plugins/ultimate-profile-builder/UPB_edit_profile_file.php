<?php 

	$path =  plugin_dir_url(__FILE__); // define path to link and scripts

	$pageURL = get_permalink();

	$sign = strpos($pageURL,'?')?'&':'?';

	global $wpdb;

	$upb_fields =$wpdb->prefix."upb_fields";

	

/*Controls login page options based on user state*/

	extract($_REQUEST);

	

	if(isset($login1)) /*Shows registration form*/

	{

		include 'UPB_register_file.php';

	}

	else if(isset($login2)) /*Shows login box*/

	{

		include 'UPB_login_file.php';

	}

	else if(isset($login3))/*Shows password recovery form*/

	{

		include 'UPB_recover_password_file.php';

	}

	else if(isset($login4))/*Shows options immediately after logging in*/

	{

		include 'UPB_view_profile_file.php';

	}

	else /*Shows edit profile view*/

	{



?>

<?php include 'UPB_theme.php'; ?>

<?php

		if ( is_user_logged_in() )

		{

			$current_user = wp_get_current_user();

			$current_ID = $current_user->ID;

			$user_info = get_userdata($current_ID);

			$user_login = $user_info->user_login;

			$user_firstname = $user_info->user_firstname;

			$user_lastname = $user_info->user_lastname;

			$nickname = $user_info->nickname;

			$display_name = $user_info->display_name;

			$user_e_mail = $user_info->user_email;

			$user_url = $user_info->user_url;

			$user_description = $user_info->user_description;

			$key = 'avtar_image';

			$single = true;

			$avtar_image = get_user_meta( $current_ID, $key, $single );

			

			if(isset($_REQUEST['EPSubmit']))

			$EPSubmit = $_REQUEST['EPSubmit'];



			if(isset($EPSubmit))/*Saves profile after editing on front end*/

			{

				$current_user = wp_get_current_user();

				$current_ID = $current_user->ID;



				if(isset($_POST['current_ID']))

				$current_ID = $_POST['current_ID'];



				if(isset($_POST['first_name']))

				$first_name = $_POST['first_name'];



				if(isset($first_name))

				$first_name = ucfirst(strtolower($first_name));



				if(isset($_POST['last_name']))

				$last_name = $_POST['last_name'];



				if(isset($last_name))

				$last_name = ucfirst(strtolower($last_name));



				if(isset($_POST['nickname']))

				$nickname = $_POST['nickname'];



				if(isset($_POST['display_name']))

				$display_name = $_POST['display_name'];



				if(isset($display_name))

				$display_name = ucfirst(strtolower($display_name));



				if(isset($_POST['email']))

				$user_email = $_POST['email'];



				if(isset($_POST['user_url']))

				$user_url = $_POST['user_url'];



				if(isset($_POST['aim']))

				$aim = $_POST['aim'];



				if(isset($_POST['yim']))

				$yim = $_POST['yim'];



				if(isset($_POST['jabber']))

				$jabber = $_POST['jabber'];



				if(isset($_POST['description']))

				$description = $_POST['description'];



				if(isset($_POST['inputPassword']))

				$pass1 = $_POST['inputPassword'];



				if(isset($_POST['pass2']))

				$pass2 = $_POST['pass2'];





				if(isset($_FILES['avtar_image']))

				$avtar_image = $_FILES['avtar_image'];



				if (isset($user_email) && !empty($user_email))/*Controls email box in profile edit view. Do not edit*/

				{

					$args = array(

					'ID'         => $current_ID,

					'user_email' => $user_email

					);



					wp_update_user( $args );

				}



					wp_update_user( array ('ID' => $current_ID, 'first_name' => $first_name) ) ;



					wp_update_user( array ('ID' => $current_ID, 'last_name' => $last_name) ) ;



					wp_update_user( array ('ID' => $current_ID, 'nickname' => $nickname) ) ;



					wp_update_user( array ('ID' => $current_ID, 'display_name' => $display_name) ) ;				



					wp_update_user( array ('ID' => $current_ID, 'user_url' => $user_url) ) ;



					if(!isset($prev_value))

					{



						$prev_value = '';



					}



					add_user_meta( $current_ID, 'aim', $aim, true );



					update_user_meta( $current_ID, 'aim', $aim, $prev_value );



					add_user_meta( $current_ID, 'yim', $yim, true );



					update_user_meta( $current_ID, 'yim', $yim, $prev_value );



					add_user_meta( $current_ID, 'jabber', $jabber, true );



					update_user_meta( $current_ID, 'jabber', $jabber, $prev_value );



					wp_update_user( array ('ID' => $current_ID, 'description' => $description) ) ;

					

				if (!empty($pass1))

				{



					wp_set_password( $pass1, $current_ID );



				}

/*Saves custom fields after user finishes profile editing*/

				$current_user_role = $current_user->roles[0];

				

				$qry1 = "select * from $upb_fields where user_group like '%".$current_user_role."%' order by ordering asc";



				$reg1=$wpdb->get_results($qry1);

				

				if(!empty($reg1))

				{

					 foreach($reg1 as $row1)

					 {

						$Customfield = str_replace(" ","_",$row1->Name);



						add_user_meta( $current_ID, $Customfield, $_POST[$Customfield], true );	



						update_user_meta( $current_ID, $Customfield, $_POST[$Customfield], $prev_value );

					 }

				}

/*Saves avatar after user finishes profile editing*/

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

<!--Shows user options immediately after submitting changes to profile-->

<div id="upb-form" align="center" >

<div class="profile-updated-succ"> Your profile has been updated successfully.</div>

<div id="main-upb-form">

  <div align="center"  class="updated-successfully-upb-device" >

    <div class="all-log-device margin-left2 updated-successfully"><a href="javascript:void(0);" onclick="javascript:history.back();">

      <div class="UltimatePB-Button"> Go back to edit-profile </div>

      </a> &nbsp; <a href="<?php echo $pageURL.$sign; ?>login4=1" title="Home-Page">

      <div class="UltimatePB-Button"> Go back to site </div>

      </a> </div>

  </div>

</div>

<?php

			}

			else /*Start edit profile view on the front end*/

			{

?>

<div id="upb-form" class="wrap edit-profile-top-area-device">

  <h2> Edit Profile </h2>

  <div class="edit-info">

    <div class="upb-name"> Basic Information </div>

    <div class="upb-button"> <a href="javascript:void(0);" onclick="javascript:history.back();"> Cancel and go back </a> </div>

  </div>

  <script type="text/javascript">

    function ValidateFileUpload() {

        var fuData = document.getElementById('avtar_image');

        var FileUploadPath = fuData.value;

//To check if the user uploaded a file

        if (FileUploadPath == '') {

        } else {



            var Extension = FileUploadPath.substring(

                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



//Confirms if the file uploaded is a valid image file

if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {

// Displays the uploaded image 

                if (fuData.files && fuData.files[0]) {



                    var reader = new FileReader();



                    reader.onload = function(e) {



                        $('#blah').attr('src', e.target.result);

                    }

                    reader.readAsDataURL(fuData.files[0]);

                }

            } 

//Warns user if the file upload is NOT a valid image file

else {



                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

				return false;

            }

        }

    }

</script> 

  <script language="javascript" type="text/javascript">

  /*Controls validations for profile fields*/



	function validateyour_profile()

	{

        var fuData = document.getElementById('avtar_image');



        var FileUploadPath = fuData.value;



        if (FileUploadPath == '') {



        } else {



            var Extension = FileUploadPath.substring(



                   FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



if (Extension == "gif" || Extension == "png" || Extension == "bmp"|| Extension == "jpeg" || Extension == "jpg") {



                if (fuData.files && fuData.files[0]) {



                    var reader = new FileReader();



                    reader.onload = function(e) {



                        $('#blah').attr('src', e.target.result);



                    }



                    reader.readAsDataURL(fuData.files[0]);



                }



            } 



else {



                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");



				return false;



            }



        }



		



		jQuery('.custom_error').html('');



		jQuery('.custom_error').hide();



		jQuery('.customupberror').html('');



		//Checks if the repeated password matches 



		var inputPassword = document.getElementById('inputPassword').value;



		var user_confirm_password = document.getElementById('user_confirm_password').value;



		if(inputPassword != user_confirm_password)



		{



			jQuery('.upbconfirm_pass').children('.custom_error').html('Password and confirm password do not match.');



			jQuery('.upbconfirm_pass').children('.custom_error').show();	



		}



		//Custom fields validation start



		//email validation start for custom field	



		  var email_val="";



		  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;



		  jQuery('.upb_email').each(function(index, element) {



			  var email = jQuery(this).children('input').val();



			  var isemail =  regex.test(email);



			if(isemail==false && email!="")

		  {



			 jQuery(this).children('.custom_error').html('Please enter a valid e-mail address.');



			 jQuery(this).children('.custom_error').show();  



		  }



		});

		/*Validations for numeric fields*/

		jQuery('.upb_number').each(function(index, element) {

			  var number = jQuery(this).children('input').val();

		  var isnumber =  jQuery.isNumeric(number);

			if(isnumber==false && number!="")

		  {



			jQuery(this).children('.custom_error').html('Please enter a valid number');



			jQuery(this).children('.custom_error').show();  



		  }

		});



		var b ='';



		b=jQuery('.custom_error').each(function() {



			var a = jQuery(this).html();



			b = a + b;



			jQuery('.customupberror').html(b);

		});

		

		var error = jQuery('.customupberror').html();

		

		if(error !='')

		{

			return false;

		}

						//Custom fields validations end

          return true;

    }

</script>

  <div id="main-upb-form">

  <form method="post" action="" id="your-profile" enctype="multipart/form-data" onsubmit="javascript: return validateyour_profile();">

    <div class="formtable">

      <div  class="lable-text">

        <label for="user_login">Username <br/>

          <span class="edit-info">This field cannot be edited</span></label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" disabled="disabled" value="<?php echo $user_login; ?>" id="user_login" name="user_login">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="email">E-mail<br/>

          <span class="edit-info">This field cannot be edited</span></label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" disabled="disabled" value="<?php echo $user_e_mail; ?>" id="email" name="email">

      </div>

    </div>

    <div class="formtable">

      <div class="lable-text">

        <label for="user_password">Password<br>

        </label>

      </div>

      <div class="input-box">

        <input id="inputPassword" name="inputPassword" type="password" onfocus="javascript:document.getElementById('user_confirm_password').value = '';" />

        <div id="complexity" class="default" style="display:none;"></div>

        <div id="password_info" class="password-pro" s >At least 7 characters please!</div>

      </div>

    </div>

    <div class="formtable">

      <div class="lable-text">

        <label for="user_confirm_password">Confirm Password<br>

        </label>

      </div>

      <div class="input-box upbconfirm_pass">

        <input id="user_confirm_password" name="pass2" type="password"/>

        <div class="reg_frontErr custom_error" style="display: none;"></div>

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="first_name">First Name</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo $user_firstname; ?>" id="first_name" name="first_name">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="last_name">Last Name</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo $user_lastname; ?>" id="last_name" name="last_name">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="nickname">Nickname</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo $nickname; ?>" id="nickname" name="nickname">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="url">Website</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text code" value="<?php echo $user_url; ?>" id="user_url" name="user_url">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="aim">AIM</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo get_user_meta($current_ID, 'aim', true); ?>" id="aim" name="aim">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="yim">Yahoo IM</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo get_user_meta($current_ID, 'yim', true); ?>" id="yim" name="yim">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="jabber">Jabber / Google Talk</label>

      </div>

      <div class="input-box">

        <input type="text" class="regular-text" value="<?php echo get_user_meta($current_ID,'jabber', true); ?>" id="jabber" name="jabber">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="avtar_image">Display picture publicly as</label>

      </div>

      <div class="input-box">

        <input type="file" onChange="return ValidateFileUpload()" class="regular-text" value="" id="avtar_image" name="avtar_image">

      </div>

    </div>

    <div class="formtable">

      <div  class="lable-text">

        <label for="description">About Me</label>

      </div>

      <div class="input-box">

        <textarea cols="30" rows="5" id="description" name="description"><?php echo $user_description; ?></textarea>

      </div>

    </div>

    <?php 

	/*HTML for Showing custom fields on front end*/

						$current_user_role = $current_user->roles[0];



						$qry1 = "select * from $upb_fields  where user_group like '%".$current_user_role."%' order by ordering asc";

						$reg1 = $wpdb->get_results($qry1);

						if(!empty($reg1)):

							?>

    <div class="upb-name UPB-Additional-Information"> Additional Information </div>

    <div class="main-edit-profile edit-profile-device">

      <?php 

							 foreach($reg1 as $row1)

							 {

								$key = str_replace(" ","_",$row1->Name);



								 $value = get_user_meta($current_ID, $key, true);
								  if($value=="")
								  {
									   $value = $row1->Value;	
								  }



								 if($row1->Type=='text')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key; ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <input type="text" class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Lenght;?>"  value="<?php echo $value;?>" id="<?php echo $key;  ?>" name="<?php echo $key;  ?>" <?php if($row1->Readonly==1)echo 'readonly';?> <?php if($row1->Require==1)echo 'required';?>>

        </div>

      </div>

      <?php }



		 if($row1->Type=='heading')

		 {?>

      <div class="formtable upb_heading">

        <h1 name="<?php echo $key;?>" class="<?php echo $row1->Class;?>"><?php echo $row1->Value;?></h1>

      </div>

      <?php }



if($row1->Type=='paragraph')

		 {?>

      <div class="formtable upb_paragraph">

        <p name="<?php echo $key;?>" class="<?php echo $row1->Class;?>"><?php echo $row1->Value;?></p>

      </div>

      <?php }



if($row1->Type=='DatePicker')

		 {?>

      <div class="formtable">

        <div class="lable-text">

          <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <input type="text" class="MyDate regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Lenght;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?> <?php if($row1->Require==1)echo 'required';?>>

        </div>

      </div>

      <?php }



if($row1->Type=='email')

		 {?>

      <div class="formtable">

        <div class="lable-text">

          <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box upb_email">

          <input type="text" class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Lenght;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?> <?php if($row1->Require==1)echo 'required';?>>

          <div class="reg_frontErr custom_error" style="display:none;"></div>

        </div>

      </div>

      <?php }

	  

if($row1->Type=='number')

		 {?>

      <div class="formtable">

        <div class="lable-text">

          <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box upb_number">

          <input type="text" class="upb_number regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Lenght;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?> <?php if($row1->Require==1)echo 'required';?>>

          <div class="reg_frontErr custom_error" style="display:none;"></div>

        </div>

      </div>

      <?php }

								  if($row1->Type=='textarea')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key;  ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <textarea  class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" cols="<?php echo $row1->Cols;  ?>" rows="<?php echo $row1->Rows;  ?>" id="<?php echo $key;  ?>" name="<?php echo $key;  ?>" <?php if($row1->Readonly==1)echo 'readonly';?> <?php if($row1->Require==1)echo 'required';?>><?php echo $value; ?></textarea>

        </div>

      </div>

      <?php }

								 if($row1->Type=='radio')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key;  ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <?php 

									$arr_radio = explode(',',$row1->Option_Value);

									foreach($arr_radio as $radio)

									{?>

          <div class="radio_option"><?php echo $radio; ?></div>

          <input type="radio" class="regular-text <?php echo $row1->Class;?>" value="<?php echo $radio;?>" id="<?php echo $key;  ?>" style="width:50px;" name="<?php echo $key;  ?>" <?php if($value == $radio)echo 'checked' ?> <?php if($row1->Readonly==1)echo 'disabled';?> >

          <?php }?>

        </div>

      </div>

      <?php }

								  if($row1->Type=='checkbox')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key;  ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <?php 

									$arr_radio = explode(',',$row1->Option_Value);

									$radio_count = 1;

									foreach($arr_radio as $radio)

									{?> 

          <div style="float:left;"><?php echo $radio; ?> </div>

          <input type="checkbox" class="regular-text <?php echo $row1->Class;?>" value="<?php echo $radio;?>" id="<?php echo $key;  ?>" name="<?php echo $row1->Name.'[]';?>" 

										<?php if($value!=""){if(in_array($radio,$value))echo 'checked';} ?> 

										<?php if($row1->Readonly==1)echo 'disabled';?>>

          <?php $radio_count++; }?>

        </div>

      </div>

      <?php }

								 if($row1->Type=='file')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key;  ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <input type="file" class="regular-text <?php echo $row1->Class;?>" value="" id="<?php echo $key;  ?>" name="<?php echo $key;  ?>">

        </div>

      </div>

      <?php }

								 if($row1->Type=='select')

								 {?>

      <div class="formtable">

        <div  class="lable-text">

          <label for="<?php echo $key;  ?>"><?php echo $row1->Name;?></label>

        </div>

        <div class="input-box">

          <select class="regular-text <?php echo $row1->Class;?>" id="<?php echo $key;  ?>" name="<?php echo $key;  ?>" <?php if($row1->Readonly==1)echo 'disabled';?> <?php if($row1->Require==1)echo 'required';?>>

            <?php

									$arr = explode(',',$row1->Option_Value);

									foreach($arr as $ar)

									{

										?>

            <option value="<?php echo $ar;?>" <?php if($ar==$value)echo 'selected';?>><?php echo $ar;?></option>

            <?php	

									}

									?>

          </select>

        </div>

      </div>

      <?php }

							 }



	?>

    </div>

    <?php 

	endif; 

	/*HTML for custom fields ends */

	?>

    <div class="customupberror" style="display:none"></div>

    <div class="UltimatePB-Button-inp" align="center">

      <input type="hidden" name="current_ID" id="current_ID" value="<?php echo $current_ID; ?>" />

      <input type="submit" value="Save" class="UltimatePB-Button" id="EPSubmit" name="EPSubmit">

    </div>

    </div>

  </form>

</div>

<?php

		}

}

else

{

?>

<!--Shows options when user tries to access a restricted page without logging in-->

<div class="main-edit-profile" align="center"> You need to login to view this page. <br />

  <br />

  <div align="center" style="width:430px;">

    <div class="UltimatePB-Button"> <a href="<?php echo site_url(); ?>"> Go back to Home-Page </a> </div>

    &nbsp;

    <div class="UltimatePB-Button"> <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Login"> Go back to Login </a> </div>

  </div>

</div>

<?php

		}

	}

?>

<script>

$("#EPSubmit").click(function () {

if (!$('#avtar_image').hasExtension(['.jpg', '.png', '.gif'])) {

	alert("Invalid Image Extensions");

	return false;

}

else

{

	return true;	

}



});

</script> 

<script>

jQuery(document).ready(function() {

	//Function for date custom field calendar pop up

    jQuery('.MyDate').datepicker({

        dateFormat : 'yy-mm-dd'

    });	

});

</script> 