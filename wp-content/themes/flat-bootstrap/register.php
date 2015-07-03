<?php  
/* 
Template Name: Login Page
*/

get_header(); ?>

<?php get_template_part( 'content', 'header' ); ?>

<div class="container">
<div id="main-grid" class="row">

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">
	
	<?php
	$err = '';
	$success = '';

	global $wpdb, $PasswordHash, $current_user, $user_ID;

	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

		
		$pwd1 = $wpdb->escape(trim($_POST['pwd1']));
		$pwd2 = $wpdb->escape(trim($_POST['pwd2']));
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name = $wpdb->escape(trim($_POST['last_name']));
		$email = $wpdb->escape(trim($_POST['email']));
		$username = $wpdb->escape(trim($_POST['username']));
		
		if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
			$err = 'Please don\'t leave the required fields.';
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = 'Invalid email address.';
		} else if(email_exists($email) ) {
			$err = 'Email already exist.';
		} else if($pwd1 <> $pwd2 ){
			$err = 'Password do not match.';		
		} else {

			$user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
			if( is_wp_error($user_id) ) {
				$err = 'Error on user creation.';
			} else {
				do_action('user_register', $user_id);
				
				$success = 'You\'re successfully register';
			}
			
		}
		
	}
	?>

        <!--display error/success message-->
	<div id="message">
		<?php 
			if(! empty($err) ) :
				echo '<p class="error">'.$err.'';
			endif;
		?>
		
		<?php 
			if(! empty($success) ) :
				echo '<p class="error">'.$success.'';
			endif;
		?>
	</div>
<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
	


		</main><!-- #main -->
	</div><!-- #primary -->

	<?php //get_sidebar(); ?>
		
</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
