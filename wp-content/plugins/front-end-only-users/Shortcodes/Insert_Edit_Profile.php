<?php 
/* The function that creates the HTML on the front-end, based on the parameters
* supplied in the product-catalog shortcode */
function Insert_Edit_Profile($atts) {
	// Include the required global variables, and create a few new ones
	global $wpdb, $user_message, $feup_success;
	global $ewd_feup_fields_table_name, $ewd_feup_user_table_name, $ewd_feup_user_fields_table_name;
		
	$Custom_CSS = get_option("EWD_FEUP_Custom_CSS");
	
	$CheckCookie = CheckLoginCookie();
	
	$Sql = "SELECT * FROM $ewd_feup_fields_table_name WHERE Field_Show_In_Front_End='Yes'";
	$Fields = $wpdb->get_results($Sql);
	$User = $wpdb->get_row($wpdb->prepare("SELECT * FROM $ewd_feup_user_table_name WHERE Username='%s'", $CheckCookie['Username']));
	$UserData = $wpdb->get_results($wpdb->prepare("SELECT * FROM $ewd_feup_user_fields_table_name WHERE User_ID='%d'", $User->User_ID));
	$query	= "SELECT * FROM $ewd_feup_user_fields_table_name WHERE User_ID='".$User->User_ID."'";
	$temp_url=get_template_directory_uri();
	$data 	=$wpdb->get_results($query);
	$ReturnString = "";
	$username =$User->Username;
	$password==$User->User_Password;
	//$ReturnString .=print_r($User);
	// Get the attributes passed by the shortcode, and store them in new variables for processing
	extract( shortcode_atts( array(
				'redirect_page' => '#',
				'login_page' => '',
				'omit_fields' => '',
				'submit_text' => __('Edit Profile', 'EWD_FEUP')),
			$atts
		)
	);
											
	$ReturnString .= "<style type='text/css'>";
	$ReturnString .= $Custom_CSS;
	$ReturnString .= "</style>";
											
	if ($CheckCookie['Username'] == "") {
		$ReturnString .= __('You must be logged in to access this page.', 'EWD_FEUP');
		$ReturnString .= "<br />" . __('Please', 'EWD_FEUP') . " <a href='" . esc_url( home_url( '/' ) ). "'>" . __('login', 'EWD_FEUP') . "</a> " . __('to continue.', 'EWD_FEUP');
		if ($login_page != "") {$ReturnString .= "<br />" . __('Please', 'EWD_FEUP') . " <a href='" . $login_page . "'>" . __('login', 'EWD_FEUP') . "</a> " . __('to continue.', 'EWD_FEUP');}
		return $ReturnString;
	}
	
	if ($feup_success and $redirect_page != '#') {FEUPRedirect($redirect_page);}
	
	$ReturnString .= "<div id='ewd-feup-edit-profile-form-div'>";
	if (isset($user_message['Message'])) {$ReturnString .= $user_message['Message'];}
	$ReturnString .= "<form action='#' method='post' id='ewd-feup-edit-profile-form' class='pure-form pure-form-aligned' enctype='multipart/form-data'>";
	$ReturnString .= "<input type='hidden' name='ewd-feup-check' value='" . sha1(md5($Time.$Salt)) . "'>";
	$ReturnString .= "<input type='hidden' name='ewd-feup-time' value='" . $Time . "'>";
	$ReturnString .= "<input type='hidden' name='ewd-feup-action' value='edit-profile'>";
	$ReturnString .= "<input type='hidden' name='Omit_Fields' value='" . $omit_fields . "'>";
	
	$Omitted_Fields = explode(",", $omit_fields);

foreach($data as $UserField)
	{
		if($UserField->Field_Name==='Title')
		{
		$title=$UserField->Field_Value;
		}
		if($UserField->Field_Name==='First_Name')
		{
		$First_Name=$UserField->Field_Value;
		}
		if($UserField->Field_Name==='Last_Name')
		{
		$Last_Name=$UserField->Field_Value;
		}
if($UserField->Field_Name==='State')
		{
		$State=$UserField->Field_Value;
		}
if($UserField->Field_Name==='City')
		{
		$City=$UserField->Field_Value;
		}
if($UserField->Field_Name==='Pin_Code')
		{
		$Pin_Code=$UserField->Field_Value;
		}
if($UserField->Field_Name==='Mobile_No')
		{
		$Mobile_No=$UserField->Field_Value;
		}
if($UserField->Field_Name==='Full_contact_address')
		{
		$Full_contact_address=$UserField->Field_Value;
		}

}
	$ReturnString .='<div class="pure-control-group main col-sm-12">
<div class="regi-half col-sm-6">

<div class="pure-control-group col-sm-12">
<h4 class="redtext"><strong>Personal Information :</strong></h4><br>
<label class="ewd-feup-field-label" id="ewd-feup-register-11" for="Title">Title:<span class="redtext">*</span> </label><br>
<input type="text" required="" placeholder="Title" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-11" name="Title" value="'.$title.'"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-12" for="First Name">First Name:<span class="redtext">*</span> </label><br>
<input type="text" required="" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-12" name="First_Name" value="'.$Last_Name.'"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-13" for="Last Name">Last Name: 
</label><br>
<input type="text" value="'.$First_Name.'" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-13" name="Last_Name"><br></div>
<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-username-div" for="Username">Your E-mail ID: </label><br>
<input type="email" value="'.$username.'" name="Username" class="ewd-feup-text-input" placeholder="Email"><br></div>


<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-password-div" for="Password">Password: </label><br>
<input type="password" value="'.$password.'" name="User_Password" id="User_Password" class="ewd-feup-text-input"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-password-confirm-div" for="Repeat Password">Repeat Password: </label><br>
<input type="password" value="" name="Confirm_User_Password" id="Confirm_User_Password" class="ewd-feup-text-input"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-22" for="State">State:<span class="redtext">*</span> </label><br>
<input type="text" required="" value="'.$State.'" placeholder="State" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-22" name="State"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-14" for="City">City:<span class="redtext">*</span> </label><br>
<input type="text" value="'.$City.'" required="" placeholder="City" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-14" name="City"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-15" for="Pin Code">Pin Code: </label><br>
<input type="text" value="'.$Pin_Code.'" placeholder="Pin Code" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-15" name="Pin_Code"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-16" for="Mobile No">Mobile No: </label><br>
<input type="text" value="'.$Mobile_No.'" placeholder="Mobile No" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-16" name="Mobile_No"><br></div></div>




<div class="regi-half col-sm-6">
<div class="pure-control-group col-sm-12">
<h4 class="redtext"><strong>Dearlearship Details :</strong></h4><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-18" for="Dealer Name">Dealer Name: </label><br>
<input type="text" placeholder="Dealer Name" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-18" name="Dealer_Name"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-19" for="DBA">DBA: </label><br>
<input type="text" placeholder="DBA" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-19" name="DBA"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-20" for="Full contact address">Full contact address: </label><br>
<input type="text" value="'.$Full_contact_address.'"  placeholder="Full contact address" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-20" name="Full_contact_address"><br></div>

<div class="pure-control-group col-sm-12">
<label class="ewd-feup-field-label" id="ewd-feup-register-21" for="Dealer Website">Dealer Website: </label><br>
<input type="text" placeholder="Dealer Website" class="ewd-feup-text-input pure-input-1-3" id="ewd-feup-register-input-21" name="Dealer_Website"><br></div>


<div class="pure-control-group col-sm-12">
<h5><strong>Upload your Photograph / Logo</strong></h5>
<img width="65" height="65" src="'.$temp_url.'/images/photo.png">
<input type="file" value="" class="ewd-feup-date-input pure-input-1-3" id="ewd-feup-register-input-28" name="photo"></div>

<div class="pure-control-group col-sm-12">
<input type="checkbox" required="" class="ewd-feup-checkbox" value="I would like to subscribe to the Releus Newsletter." name="I would like to subscribe to the Releus Newsletter.[]">I would like to subscribe to the Releus Newsletter.

</div>';
	
	$ReturnString .= "<div class='pure-control-group'><label for='submit'></label><input type='submit' class='ewd-feup-submit pure-button pure-button-primary' name='Edit_Profile_Submit' value='" . $submit_text . "'></div>";
	$ReturnString .= "</div></div></form>";
	$ReturnString .= "</div>";
	
	return $ReturnString;
}
add_shortcode("edit-profile", "Insert_Edit_Profile");
