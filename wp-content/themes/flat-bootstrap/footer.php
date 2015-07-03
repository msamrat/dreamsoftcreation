<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package flat-bootstrap
 */
?>
	</div><!-- #content -->

	<?php // Page bottom (before footer) widget area 
	get_sidebar( 'pagebottom' ); 
	?>

	<?php // Start the footer area ?>
	<footer id="colophon" class="site-footer greybg" role="contentinfo">
		
	<?php // Footer "sidebar" widget area (1 to 4 columns supported)
	get_sidebar( 'footer' );
	?>

	<?php // Check for footer navbar (optional)
	global $xsbf_theme_options; 
	$nav_menu = null; 
	if ( function_exists('has_nav_menu') AND has_nav_menu( 'footer' ) ) {
		$nav_menu = wp_nav_menu( 
			array( 'theme_location' => 'footer',
			'container_div' 		=> 'div', //'nav' or 'div'
			'container_class' 		=> '', //class for <nav> or <div>
			'menu_class' 			=> 'list-inline dividers', //class for <ul>
			'walker' 				=> new wp_bootstrap_navwalker(),
			'fallback_cb'			=> '',
			'echo'					=> false, // we'll output the menu later
			'depth'					=> 1,
			) 
		);
		
	// If not, default one
	}  //endif has_nav_menu()
?>

	<?php // Check for site credits (can be overriden in a child theme)
	$theme = wp_get_theme();
	$site_credits = sprintf( __( 'Copyright&copy; %1$s %2$s. Releus Auto Sales & Leasing %3$s.', 'flat-bootstrap' ), 
		date ( 'Y' ),
		'<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"></a>',
		'<a href="' . $theme->get( 'ThemeURI' ) . '" rel="profile" target="_blank"></a>'
	);
	$site_credits = apply_filters( 'xsbf_credits', $site_credits );
 	?>

	<?php // If either footer nav or site credits, display them
	if ( $nav_menu OR $site_credits ) : ?>
	<div class="col-sm-12 footer-custom">
	<div class="col-sm-3">
<div class=col-sm-12>	
<h5 class="impactfontlightgrey">RELEUS AUTO LEASING &amp; SALES</h5><div class="whitebg">
<img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div><br>
<h4 class="whitetext">David Releus</h4>
<div class="whitebg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div>
<h6>
<span class="whitetext" >1280 Wall Street West, Suite 308<br>
Lyndhurst<br>
NJ  07071<br>
646-583-6000</span><br>
<a class="whitelink" href="mailto:info@releus.com">info@releus.com</a></h6><br>

<h5 class="impactfontlightgrey">CONNECT WITH</h5>
<div class="whitebg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div>
<div class="col-sm-12 sociel-links">
<a class="sociel" href="#"><img width="33" height="33" border="0" alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/facebook.png"></a>
<a class="sociel" href="#"><img width="33" height="33" border="0" alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/twitter.png"></a>
<a class="sociel" href="#"><img width="33" height="33" border="0" alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/linked.png"></a>
<a class="sociel" href="#"><img width="33" height="33" border="0" alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/youtube.png"></a>
<a class="sociel" href="#"><img width="33" height="33" border="0" alt="Facebook" src="<?php echo get_template_directory_uri(); ?>/images/google.png"></a> <
</div></div>
	</div>

<div class="col-sm-6">
<div class="col-sm-4">
<h5 class="impactfontlightgrey">LEASE SPECIALS</h5>
<div class="whitebg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div>
<h6><a class="whitelink" href="#">2014 Acura ILX</a><br>
                  <a class="whitelink" href="#">2014 Acura TL</a><br>
                  <a class="whitelink" href="#">2014 Audi A4</a><br>
                  <a class="whitelink" href="#">2014 BMW 528i</a><br>
                  <a class="whitelink" href="#">2014 Honda Civic</a><br>
                  <a class="whitelink" href="#">2014 Honda Accord</a><br>
                  <a class="whitelink" href="#">2014 Honda Odyssey</a><br>
                  <a class="whitelink" href="#">2014 Kia Optima</a><br>
                  <a class="whitelink" href="#">2014 Nissan Altima</a><br>
                  <a class="whitelink" href="#">2014 Nissan Maxima</a><br>
                  <a class="whitelink" href="#">2014 Infiniti Q50</a><br>
                  <a class="whitelink" href="#">2014 Toyota Camry</a></h6></div>
<div class="col-sm-4">
<h5 class="impactfontlightgrey">LOCATIONS</h5>
<div class="whitebg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div>
<h6><a class="whitelink" href="#">New York </a><br>
                  <a class="whitelink" href="#">Manhattan</a><br>
                  <a class="whitelink" href="#">Long Island</a><br>
                  <a class="whitelink" href="#">New Jersey</a><br>
  <a class="whitelink" href="#">Baltimore</a><br>
  <a class="whitelink" href="#">Boston</a><br>
  <a class="whitelink" href="#">Charlotte</a><br>
  <a class="whitelink" href="#">Hartford</a><br>
  <a class="whitetext" href="#">Miami</a><br>
  <a class="whitelink" href="#">Philladelphi</a>a</h6></div>
<div class="col-sm-4">
<h5 class="impactfontlightgrey">RESOURCES</h5>
<div class="whitebg"><img width="1" height="1" alt="Releus" src="<?php echo get_template_directory_uri(); ?>/images/white_bg.png"></div>
<h6><a class="whitelink" href="#">Edmunds</a><br>
                  <a class="whitelink" href="#">Kelley Blue Book</a><br>
                  <a class="whitelink" href="#">Auto Week</a><br>
                  <a class="whitelink" href="#">Fuel Economy</a><br>
                  <a class="whitelink" href="#">FRB - Keys to Lea</a>sing<br>
                  <a class="whitelink" href="#">Lease Tutor</a><br>
                  <a class="whitelink" href="#">Leasing Terms</a></h6></div>
</div>
	<div class="col-sm-3 lastdiv"><div class="whitetext">
<?php echo $site_credits; ?><br></div>
<h6><a class="lightgreylink" href="#">Contact RELEUS</a><span class="whitetext"> |  </span><a class="lightgreylink" href="#">Blog</a><br>
              <a class="lightgreylink" href="#">Disclaimer</a><span class="whitetext"> | </span><a class="lightgreylink" href="#">Privacy Statement</a></h6>

</div>
</div>	
<div class="greybg">
	<div class="container">

		<?php // Footer nav menu
		if ( $nav_menu ) : ?>
			<div class="footer-nav-menu pull-left">
			<nav id="footer-navigation" class="secondary-navigation" role="navigation">
				<h1 class="menu-toggle sr-only"><?php _e( 'Footer Menu', 'flat-bootstrap' ); ?></h1>
				<?php echo $nav_menu; ?>
			</nav>
			</div><!-- .footer-nav-menu -->
		<?php endif; ?>

		<?php // Footer site credits
		if ( $site_credits AND $nav_menu ) : ?>
			<div id="site-credits" class="site-credits pull-right">
			<?php echo $site_credits; ?>
			</div><!-- .site-credits -->
		<?php elseif ( $site_credits ) : ?>
			<div id="site-credits" class="site-credits pull-left">
			<?php //echo $site_credits; ?>
			</div><!-- .site-credits -->
		<?php endif; ?>

	</div><!-- .container -->
	</div><!-- .after-footer -->
	<?php endif; ?>
		
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
