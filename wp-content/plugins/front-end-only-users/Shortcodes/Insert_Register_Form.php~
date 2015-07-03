<?php 
/* The function that creates the HTML on the front-end, based on the parameters
* supplied in the product-catalog shortcode */
function Insert_Register_Form($atts) {
	// Include the required global variables, and create a few new ones
	global $wpdb, $post, $user_message, $feup_success;
	global $ewd_feup_fields_table_name;
		
	$Custom_CSS = get_option("EWD_FEUP_Custom_CSS");
	$Salt = get_option("EWD_FEUP_Hash_Salt");
	$Username_Is_Email = get_option("EWD_FEUP_Username_Is_Email");
	$Time = time();
	$temp_url=get_template_directory_uri();
	$Sql = "SELECT * FROM $ewd_feup_fields_table_name ";
	$Fields = $wpdb->get_results($Sql);
	$homeurl=esc_url( home_url( '/' ) ); 	
	$ReturnString = "";

	if (isset($_GET['ConfirmEmail'])) {ConfirmUserEmail();}
		
	// Get the attributes passed by the shortcode, and store them in new variables for processing
	extract( shortcode_atts( array(
				'redirect_page' => $homeurl.'specials',
				'redirect_field' => "",
				'redirect_array_string' => "",
				'submit_text' => __('Register', 'EWD_FEUP')),
			$atts
		)
	);
		
	if (isset($_GET['ConfirmEmail'])) {$ConfirmationSuccess = ConfirmUserEmail();
		session_start();
    		if($_POST['captcha'] != $_SESSION['digit']) die("Sorry, the CAPTCHA code entered was incorrect!");
    		session_destroy();}

	if ($feup_success and $redirect_field != "") {$redirect_page = Determine_Redirect_Page($redirect_field, $redirect_array_string, $redirect_page);}
		
	if ($feup_success and $redirect_page != '#') {FEUPRedirect($redirect_page);}
		
	$ReturnString .= "<style type='text/css'>";
	$ReturnString .= $Custom_CSS;
	$ReturnString .= "</style>";
	
	if (!isset($ConfirmationSuccess)) {
			
		$ReturnString .= "<div id='ewd-feup-register-form-div'>";
		if (isset($user_message['Message'])) {$ReturnString .= $user_message['Message'];}
		$ReturnString .= "<form action='#' method='post' id='ewd-feup-register-form' class='pure-form pure-form-aligned' enctype='multipart/form-data'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-check' value='" . sha1(md5($Time.$Salt)) . "'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-time' value='" . $Time . "'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-action' value='register'>";
		$ReturnString .= "<input type='hidden' name='ewd-feup-post-id' value='" . $post->ID . "'>";

$ReturnString .='<div class="pure-control-group main col-sm-12">
<div class="regi-half col-sm-6">

<div class="pure-control-group col-sm-12">
<h4 class="redtext"><strong>Personal Information :</strong></h4><br>
<label class="ewd-feup-field-label" id="ewd-feup-register-11" for="Title">Title:<span class="redtext">*</span> </label><br>
<input type="text" required="" placeholder="Title" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-11" name="Title"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-12" for="First Name">First Name:<span class="redtext">*</span> </label><br>
<input type="text" required="" value="" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-12" name="First_Name"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-13" for="Last Name">Last Name: 
</label><br>
<input type="text" value="" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-13" name="Last Name"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-username-div" for="Username">Your E-mail ID: </label><br>
<input type="email" value="" name="Username" class="ewd-feup-text-input" placeholder="Email"><br></div>


<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-password-div" for="Password">Password: </label><br>
<input type="password" value="" name="User_Password" id="User_Password" class="ewd-feup-text-input"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-password-confirm-div" for="Repeat Password">Repeat Password: </label><br>
<input type="password" value="" name="Confirm_User_Password" id="Confirm_User_Password" class="ewd-feup-text-input"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-22" for="State">State:<span class="redtext">*</span> </label><br>
<input type="text" required="" placeholder="State" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-22" name="State"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-14" for="City">City:<span class="redtext">*</span> </label><br>
<input type="text" required="" placeholder="City" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-14" name="City"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-15" for="Pin Code">Pin Code: </label><br>
<input type="text" placeholder="Pin Code" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-15" name="Pin_Code"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-16" for="Mobile No">Mobile No: </label><br>
<input type="text" placeholder="Mobile No" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-16" name="Mobile_No"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-17" for="Enter the code">Enter the code: </label><br>
<p><img src="'.$temp_url.'/capecha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
<input type="text" required="" placeholder="Enter the code" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-17" name="Enter_the_code"><br></div>
</div>



<div class="regi-half col-sm-6">
<div class="pure-control-group col-sm-12">
<h4 class="redtext"><strong>Dearlearship Details :</strong></h4><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-18" for="Dealer Name">Dealer Name: </label><br>
<input type="text" placeholder="Dealer Name" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-18" name="Dealer Name"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-19" for="DBA">DBA: </label><br>
<input type="text" placeholder="DBA" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-19" name="DBA"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-20" for="Full contact address">Full contact address: </label><br>
<input type="text" placeholder="Full contact address" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-20" name="Full contact address"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-21" for="Dealer Website">Dealer Website: </label><br>
<input type="text" placeholder="Dealer Website" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-21" name="Dealer Website"><br></div>

<div class="pure-control-group col-sm-12">
<h5><strong><em>Your Social Link / URL</em></strong></h5>
<img width="125" height="35" src="'.$temp_url.'/images/facebook_name.png">
<input type="text" placeholder="facebook_link" class="liks col-sm-8" id="ewd-feup-register-input-23" name="facebook_link"></div>
<div class="pure-control-group col-sm-12">
<img width="125" height="35" src="'.$temp_url.'/images/twitter_name.png">
<input type="text" placeholder="twiterlink" class="liks col-sm-8" id="ewd-feup-register-input-24" name="twiterlink"></div>
<div class="pure-control-group col-sm-12">
<img width="125" height="35" src="'.$temp_url.'/images/linked_name.png">
<input type="text" placeholder="linked" class="liks col-sm-8" id="ewd-feup-register-input-25" name="linked"></div>
<div class="pure-control-group col-sm-12">
<img width="125" height="35" src="'.$temp_url.'/images/google_plus_name.png">
<input type="text" placeholder="googleplus" class="liks col-sm-8" id="ewd-feup-register-input-26" name="googleplus"></div>
<div class="pure-control-group col-sm-12">
<img width="125" height="35" src="'.$temp_url.'/images/dealer_rated_name.png">
<input type="text" placeholder="dealerrator" class="liks col-sm-8" id="ewd-feup-register-input-27" name="dealerrator"></div>
<div class="pure-control-group col-sm-12">
<h5><strong>Upload your Photograph / Logo</strong></h5>
<img width="65" height="65" src="'.$temp_url.'/images/photo.png">
<input type="file" value="" class="ewd-feup-date-input pure-input-1-3" id="ewd-feup-register-input-28" name="photo"></div>
<div class="pure-control-group col-sm-12">
<input type="checkbox" required="" class="ewd-feup-checkbox" value="I would like to subscribe to the Releus Newsletter." name="I would like to subscribe to the Releus Newsletter.[]">I would like to subscribe to the Releus Newsletter.

</div>';






	
		$ReturnString .= "<div class='pure-control-group col-sm-4'>
		<label for='submit'></label>";
		//$ReturnString .='<a href=""><img type="submit" width="178" height="44" border="0" src="'.$temp_url.'/images/save_button.png">';
		$ReturnString .="<input type='submit' class='ewd-feup-submit pure-button pure-button-primary save-button' name='Register_Submit' value='" . $submit_text . "'></a>
		</div>";
		$ReturnString .= "</form>";
		$ReturnString .= "</div>";
	}
	else {
		$ReturnString = "<div class='ewd-feup-email-confirmation'>";
		if ($ConfirmationSuccess == "Yes") {$ReturnString .= __("Thanks for confirming your e-mail address!", 'EWD_FEUP');}
		if ($ConfirmationSuccess == "No") {$ReturnString .= __("The confirmation number provided was incorrect. Please contact the site administrator for assistance.", 'EWD_FEUP');}
		$ReturnString .= "</div>";
	}
		
	return $ReturnString;
}
add_shortcode("register", "Insert_Register_Form");
