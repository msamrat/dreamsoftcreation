<?php

/*Controls login form behavior in front end*/

	$path =  plugin_dir_url(__FILE__);  // define path to link and scripts

	$pageURL = get_permalink();

	$sign = strpos($pageURL,'?')?'&':'?';

	extract($_REQUEST);

	?>

    <style type="text/css">

                #loginErr

                {

                    display:none;

                }

</style>

    <?php

	if(isset($_POST['submit']))

	$submit = $_POST['submit'];



	if(isset($submit))//Controls behaviour of login button

	{

  

		if(isset($_POST['user_login']))

		$user_login = $_POST['user_login'];

  

		if(isset($_POST['user_pass']))

		$user_pass = $_POST['user_pass'];

  

		if(isset($_POST['rememberme']))

		$rememberme = $_POST['rememberme'];

  

		$creds = array();

  

		if(isset($user_login))

		$creds['user_login'] = trim($user_login);

  

		if(isset($user_pass))

		$creds['user_password'] = trim($user_pass);

  

		if(isset($rememberme))

		$creds['remember'] = $rememberme;

  

		$user = wp_signon($creds,false);

  

		if ( is_wp_error($user) )//Displays error when username or/and password does not matches

		{

			$loginErr= "The password you entered for the username is incorrect";

  

  ?>

  <style type="text/css">

				#loginErr

				{

					display:block;

					width:350px;

				}

			</style>

			<!--HTML for displaying login form-->

  

  <?php

  

		}

		else

		{

			

  ?>

  <!--HTML when user successfully logs in-->

  <style type="text/css">

  #profile-page{ display:none;}

  </style>

  <div id="upb-form">

  <div class="login-success"> Login Success! </div>

  <div class="login-dis"> Please choose your destination. </div>

  <div id="main-upb-form">

  <div class="main-edit-profile" align="center">

  <div class="all-log-device margin-left2" > <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login4=1" title="View Profile">

  <div class="UltimatePB-Button"> View Profile </div>

  </a> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">

  <div class="UltimatePB-Button"> Logout </div>

  </a> </div>

  </div>

  </div>

  </div>

  <?php

		}

	}

			

	if(isset($login1) && is_user_logged_in()==false)

	{

		include 'UPB_register_file.php';

	}

	else if(isset($login3) && is_user_logged_in()==false)

	{

		include 'UPB_recover_password_file.php';

	}

	else if(isset($changeavatar))

	{

		include 'UPB_edit_profile_image.php';

	}

	else if(isset($login4))

	{

		include 'UPB_view_profile_file.php';

	}

	else if(isset($login5))

	{

		include 'UPB_edit_profile_file.php';

	}

	else

	{

		 include 'UPB_theme.php'; 

		if ( is_user_logged_in() )

		{

?>

<!--HTML for page shown when accessing the login form when user is already logged in-->

<div id="upb-form">

  <div id="main-upb-form">

    <div class="main-edit-profile" align="center"> You are already logged-in. <br />

      <br />

      <div  class="all-log-device margin-left2"> <a href="<?php echo site_url(); ?>">

        <div class="UltimatePB-Button"> Go back to site </div>

        </a> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">

        <div class="UltimatePB-Button"> Logout </div>

        </a> </div>

    </div>

  </div>

</div>

<?php

		}

		else

		{

			

		

?>

<div id="profile-page"> 

<script type="text/javascript">

  

function validateLogin()

{

	var user_login = document.getElementById("user_login").value;

	var user_pass = document.getElementById("user_pass").value;



	if (user_login==null || user_login=="")

	{

		document.getElementById('divuser_login').style.display = 'block';

		document.getElementById("user_login").focus();

		return false;

	}



	if(user_pass==null || user_pass=="")

	{

		document.getElementById('divuser_pass').style.display = 'block';

		document.getElementById('divuser_login').style.display = 'none';

		document.getElementById("user_pass").focus();

		return false;

	}

	return true;

}

</script>

  <form method="post" action="" id="loginform" name="loginform" onsubmit="javascript:return validateLogin();">

    <div id="main-upb-form">

      <div class="formtable">

        <div class="lable-text">

          <label for="user_login"> Username </label>

        </div>

        <div class="input-box">

          <input type="text" size="20" value="<?php if(isset($user_login)) echo $user_login; ?>" class="input" id="user_login" name="user_login" >

          <div class="reg_frontErr" id="divuser_login" style="display:none;">Please enter a username.</div>

        </div>

      </div>

      <div class="formtable">

        <div class="lable-text">

          <label for="user_pass"> Password </label>

        </div>

        <div class="input-box">

          <input type="password" size="20" value="" class="input" id="user_pass" name="user_pass" >

          <div class="reg_frontErr" id="divuser_pass" style="display:none;">Please enter a password.</div>

          <div id="loginErr" class="reg_frontErr"> <?php echo $loginErr; ?> </div>

        </div>

      </div>

      <div class="formtable">

        <div class="lable-text">

          <label for="rememberme"> </label>

          &nbsp;</div>

        <div class="input-box">

          <input type="checkbox" value="true" id="rememberme" name="rememberme">

          <span class="remember-me">Remember Me</span></div>

      </div>

    </div>

    <div align="center" class="UltimatePB-Button-area">

      <div class="UltimatePB-Button-inp">

        <input type="submit" value="Log In" class="button button-primary button-large" id="login" name="submit" style="float:none;">

      </div>

      <div class="UltimatePB-forgot-pass"> Forget Password? <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login3=1" title="Lost Password">Click here</a> to resend </div>
	  
      <?php

$qry="SELECT value FROM $upb_option WHERE fieldname='upb_facebook_login'";

$facebook_login = $wpdb->get_var($qry);

if($facebook_login=='yes')

{

	include 'facebook/upb_facebook.php';

	upb_fb_login_validate();

	upb_fb_loginForm();

}

?>
    </div>

  </form>

</div>

<?php

		}

	}

?>