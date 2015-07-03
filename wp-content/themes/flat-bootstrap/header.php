<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package flat-bootstrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ewd-feup-register-form').validate({
       rules:
               {
                 First_Name:{required:true, pattern:'[a-zA-Z ]+'},
		 Last_Name:{pattern:/^[a-zA-Z ]+$/},
		 DBA:{pattern:/^[a-zA-Z ]+$/},
  		 Dealer_Name:{pattern:/^[a-zA-Z ]+$/},
		 State:{required:true, pattern:/^[a-zA-Z]+$/},
		 City:{required:true, pattern:/^[a-zA-Z]+$/},
                 Full_contact_address:{required:true, pattern:/^[a-zA-Z0-9 ]+$/},
                 Email:{required:true, pattern:/^([a-zA-Z0-9-._])+@([[a-zA-Z0-9-._])+\.([a-zA-Z])/},
                 Mobile_No:{required:true,pattern: /^[0-9 ]+$/,minlength:10,maxlength:10},
		User_Password: {required: true,minlength: 8,pattern:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/},
	        Confirm_User_Password: {required: true,minlength: 8,equalTo: "#User_Password"},
		Pin_Code: {pattern:/^\d{6}$/},
		Dealer_Website: {pattern:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/},
		facebook_link: {pattern:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/},
		twiterlink: {pattern:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/},
		linked: {pattern:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/},
		googleplus: {pattern:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/}
               },
        messages:
                {
                 First_Name:{required:'Enter Your First Name',pattern:'Only Characters are allowed in this field '},
		 Last_Name:{pattern:'Only Characters are allowed in this field '},
		State:{required:'Enter Your state',pattern:'Only Characters are allowed in this field '},
		City:{required:'Enter Your City',pattern:'Only Characters are allowed in this field '},
                 Full_contact_address:{required:'Enter Your Full Contacts Address',pattern:'Only Characters and numbers are allowed in this field'}, 
                 Email:{required:'Enter Your Email id',pattern:'Enter a valid email id'},
                 Mobile_No:{required:'Enter Your Mobile numbers',pattern:'Only Numbers are allowed in Phone number',minlength:'phone number should be 10 digits',maxlength:'phone number should be 10 digits'},
		User_Password: {required: "Enter Your password",minlength: "Your password must be at least 5 characters long",pattern: "Your password must be min 8 characters, must include one capital letter and one number"},
        	Confirm_User_Password: {required: "Please provide a Confirmpassword",minlength: "Your password must be at least 5 characters long",	equalTo: "Please enter the same password as above"},
Pin_Code: {pattern:'The US zipcode must contain 6 digits'},
Dealer_Website: {pattern:'Enter valid website'},
facebook_link: {pattern:'Enter valid facebook link'},
twiterlink: {pattern:'Enter valid twiter link link'},
linked: {pattern:'Enter valid link'},
googleplus: {pattern:'Enter valid link'},
Dealer_Name: {pattern:'Only Characters are allowed in this field'},
DBA: {pattern:'Only Characters are allowed in this field'}

               },
          errorPlacement:function(error,element)
          {
		 error.insertAfter(element);
              
          },
    });
  });

</script>
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site greyshadowbar">

	<?php do_action( 'before' ); ?>
<?php if( is_home () || is_front_page() || is_page('forgotpassword')) :?>
<div class="homebg">
<?php else:?>
<div class="innerbg">
<?php endif;?>
	
	<header id="masthead" class="site-header" role="banner">

		<?php
		/**
		  * CUSTOM HEADER IMAGE DISPLAYS HERE FOR THIS THEME, BUT CHILD THEMES MAY DISPLAY
		  * IT BELOW THE NAV BAR (VIA CONTENT-HEADER.PHP)
		  */
		global $xsbf_theme_options;
		$custom_header_location = isset ( $xsbf_theme_options['custom_header_location'] ) ? $xsbf_theme_options['custom_header_location'] : 'content-header';
		if ( $custom_header_location == 'header' ) :
		?>
		<div class="headerlinks container">
<div class="col-sm-8 headerlinks">
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/request_icon.png"><a class="greylink" href="#">Request Quote</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/search_icon.png"><a class="greylink" href="#">Search</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/schedule_icon.png"><a class="greylink" href="#">Schedule Delivery</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/forms_icon.png"><a class="greylink" href="#">Forms</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/faq_icon.png"><a class="greylink" href="#">FAQ</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/email_icon.png"><a class="greylink" href="#">Email</a></h5>
</div>
<div class="links">		
<h5><img width="28" height="18" alt="Request Quote" src="<?php echo get_template_directory_uri(); ?>/images/login_icon.png"><a class="greylink" href="#">Login</a></h5>
</div>
</div>
</div>


<div class="greybg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/grey_bg.png"></div>			
			<div id="site-branding" class="site-branding">
		
			<?php
			// Get custom header image and determine its size
			if ( get_header_image() ) {
			?>
<div class="container">
<div class="col-sm-4"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">				
<div class="custom-header-image" style="background-image: url('<?php echo header_image() ?>'); width: <?php echo get_custom_header()->width; ?>px; height: <?php echo get_custom_header()->height ?>px;">
</div>				
                <?php //if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
				
				</div></a>
<div class="col-sm-5 mid-image"><img width="593" height="106" src="<?php echo get_template_directory_uri(); ?>/images/header_image.png"></div>
<div class="col-sm-3 contact"><img width="250" height="75" alt="855 660 2100" src="<?php echo get_template_directory_uri(); ?>/images/header_number.png"></div>
</div>
			<?php

			// If no custom header, then just display the site title and tagline
			} else {
			?>
				<div class="container">
                <?php //if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img width="352" height="138" border="0" alt="RELEUS" src="images/logo.png"></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</div>
			<?php
			} //endif get_header_image()
			?>
			</div><!-- .site-branding -->
		<?php			
		endif; // $custom_header_location
		?>			

		<?php
		/**
		  * ALWAYS DISPLAY THE NAV BAR
		  */
 		?>	<div class="navbg">
		<nav id="site-navigation" class="main-navigation" role="navigation">

			<h1 class="menu-toggle sr-only screen-reader-text"><?php _e( 'Primary Menu', 'flat-bootstrap' ); ?></h1>
			<div class="skip-link"><a class="screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'flat-bootstrap' ); ?></a>
</div>
<div class="menu-text col-sm-4"><img width="417" height="40" src="<?php echo get_template_directory_uri(); ?>/images/auto_leases_sale.png"></div>
		<?php
		// Collapsed navbar menu toggle
		global $xsbf_theme_options;
		$navbar = '<div class="navbar">'
			.'<div class="container">'
        	.'<div class="navbar-header">'
          	.'<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
          	.'</button>';

		// Site title (Bootstrap "brand") in navbar. Hidden by default. Customizer will
		// display it if user turns of the main site title and tagline.
		$navbar .= '<a class="navbar-brand" href="'
			.esc_url( home_url( '/' ) )
			.'" rel="home">'
			.get_bloginfo( 'name' )
			.'</a>';
		
        $navbar .= '</div><!-- navbar-header -->';
		
		// Display the desktop navbar
		$navbar .= wp_nav_menu( 
			array(  'theme_location' => 'primary',
			'container_class' => 'navbar-collapse collapse col-sm-8', //<nav> or <div> class
			'menu_class' => 'nav navbar-nav', //<ul> class
			'walker' => new wp_bootstrap_navwalker(),
			'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
			'echo'	=> false
			) 
		);
		echo apply_filters( 'xsbf_navbar', $navbar );
		?>
		
		</div><!-- .container -->
		</div><!-- .navbar -->
		</nav><!-- #site-navigation -->
<?php if( is_home () || is_front_page() || is_page('forgotpassword')) :?>
<div class="col-sm-12 header-image">
<div class="col-sm-6 halfheader"><div class="col-sm-12"><h2 class="impactfontwhite col-sm-10">Toyota Camry XLE</h2><h3 class="whitetext textshadow col-sm-2">FULLY LOADED</h3></div>
<div class="col-sm-12">
<div class="whitebg"><img width="490" height="2" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/header_divider.png"></div>
</div>
<div class="col-sm-12">
<h3 class="whitetext textshadow">with Navigation for $349 mo, 36 month lease,<br>
                      12,000 miles per year.</h3>
</div>
<div class="col-sm-12">
<div class="whitebg"><img width="490" height="2" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/header_divider.png"></div>
</div>
<div class="col-sm-12">
<h4 class="whitetext textshadow">Valid through 9/2/2014</h4>
</div>
<div class="col-sm-6">
<a href="#"><img width="225" height="55" border="0" alt="VIEW DETAILS" src="<?php echo get_template_directory_uri(); ?>/images/view_details_button.png"></a>
</div>
<div class="col-sm-6">
<a href="#"><img width="189" height="55" border="0" alt="BUY NOW" src="<?php echo get_template_directory_uri(); ?>/images/buy_now_button.png"></a>
</div>
</div>

<div class="headerslider col-sm-6"> <?php echo do_shortcode('[sp_responsiveslider limit="-1"]'); ?></div></div>
</header><!-- #masthead -->
	</div>
<?php else:?>
	</header><!-- #masthead -->
	</div>
<?php endif;?>
	
	<?php // Set up the content area (but don't put it in a container) ?>
	<?php if( is_home () || is_front_page() || is_page('forgotpassword')) :?>
<div id="content" class="site-content">
<?php else:?>
<div id="content" class="site-content greyshadowbar">
<?php endif;?>
	
