<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		<!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
			<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->	
		
			<!-- respond.js -->
		<!--[if lt IE 9]>
		          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<![endif]-->	
	</head>
	
	<body  id="mainbody">

		<div class="mainbody" id="mainbody">

		<div class="headerRibbon" id="headerRibbon">
		
		
				
				<div class="container">
				<div class="row">
				<div class="col-sm-12">
          		
					<div class="navbar-header">
						<button type="button" class="navbar-toggle btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="./" id="homeButton" class="brand"><span>BreweryDB.com</span></a>
						
					</div>

					<div class="collapse navbar-collapse navbar-responsive-collapse">
					<ul id="authNav" class="nav pull-right">
                                                                                    <li class="spacer"><i class="icon icon-user"></i></li>
                                            <li><a href="/signin" class="stay">Sign in to BreweryDB</a></li>
                                            <li class="spacer">: :</li>
                                            <li><a href="/auth/signup" class="stay">Sign Up Now</a></li>
                                                                                </ul>
						<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>

						<?php //if(of_get_option('search_bar', '1')) {?>
						<form action="/search" method="GET" id="headerSearch" class="form-search navbar-search pull-right">
                                            <div class="input-append">
                                                <input type="text" class="search-query" value="" name="q" id="topSearchBox">
                                                <button class="btn btn-inverse" type="submit">Go</button>
                                            </div>
                                        </form>
						<?php //} ?>
					</div>

				</div>
				</div>		
				
			
		
		
		
		
