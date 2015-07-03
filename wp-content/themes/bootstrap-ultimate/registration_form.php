<div class="registration-form-wrapper">
	<?php
	/* the captcha result is stored in session */
	session_start();
	
	if( isset( $_POST['svalue'] ) )
	{
		if($_POST['svalue'] != $_SESSION['answer']) {
			$matherror = "Wrong math!";
		}
		else {
			$matherror = " ";
		}
	}
	
	include('arithmetic_captcha.php');
	
	  if(defined('REGISTRATION_ERROR')){
	    foreach(unserialize(REGISTRATION_ERROR) as $error){
	      	echo '<p class="error">'.$error.'</p';
	    }					    
	  } elseif(defined('REGISTERED_A_USER')){
	    	echo '<p class="success">Successful registration, an email has been sent to '.REGISTERED_A_USER .'</p>';
	  }
	  echo '<p class="error">'. $matherror .'</p>';
	?>
	
	<form id="my-registration-form" method="post" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>">
		<ul>
			<li>
				<label for="username">Username</label>
				<input type="text" id="username" name="user" value=""/>
			</li>
			<li>
				<label for="email">E-mail</label>
				<input type="text" id="email" name="email" value="" />
			</li>
			<li>
				What is the result <strong><?php echo $math;?></strong> ? &nbsp; <input type="text" name="svalue" value="" size="7" />
			</li>
			<li>
				<input type="submit" value="Register" />
			</li>
		</ul>
	</form>
</div>