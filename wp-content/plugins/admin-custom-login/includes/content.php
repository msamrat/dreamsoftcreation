<?php
require_once('get_value.php');
?>
<style>
	#post-social-5{
		background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?php echo WEBLIZAR_NALF_PLUGIN_URL.'css/img/pattern-1.png'; ?>') left top repeat, url('<?php echo WEBLIZAR_NALF_PLUGIN_URL.'css/img/bg1.jpg'; ?>') center center fixed;
	}
	::-webkit-scrollbar{
		width: 12px;
	}
	::-webkit-scrollbar-track{
		outline: 0px solid slategrey;
		 background: transparent;
		border-radius: 0px;
		border:0px
	}
	::-webkit-scrollbar-thumb{
		border-radius: 0px;
		background: rgba(71,204,232,0.9);
		border:0px;
		outline: 0px solid slategrey;
	}
	a:focus{
		-webkit-box-shadow: none !important;
		box-shadow:none !important;
	}
	.wp-color-result{
		height:24px;
	}
	.wp-color-result:hover{
		text-underline:none;
	}
	#TB_ajaxContent{
		width:100% !important;
	}
	#TB_window {
		height: auto !important;
	}
</style>
<!-- ==============================================
Fonts
=============================================== -->
<link href='http://fonts.googleapis.com/css?family=Dosis:600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Montserrat:400,700' rel='stylesheet' type='text/css'>

<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="sidebar-toggle hidden-xs" href="javascript:void(0);"><i class="fa fa-bars fa-2x"></i></a>
			<a class="navbar-brand coming-soon-admin-title" href="index.html"><?php _e('Admin Custom Login','WEBLIZAR_ACL')?></a>
		</div>

		<!-- /.navbar-header -->
		<ul class="nav navbar-top-links navbar-right coming-soon-top">
			 <!-- Code for prev Login page-->
			<?php add_thickbox(); ?>
			<div id="my-content-id" style="display:none;">
				 <iframe src="<?php echo site_url().'/wp-login.php'; ?> " width="750px" height="700px" style="border:5px solid white"></iframe>
			</div>					
			
			<li class="dropdown">
			<a href="#TB_inline?width=600&height=550&inlineId=my-content-id" style="padding:3px" class="thickbox"><button type="button"  class="btn btn-info btn-lg"><i class="fa fa-desktop fa-fw"style="font-size:20px"></i><?php _e('  Login Preview','WEBLIZAR_ACL')?></button> </a>
			</li>   
			<!-- /.dropdown -->
			<li class="dropdown" style="display:none">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-bell fa-fw"></i> 
				</a>
				<!-- /.dropdown-alerts -->
			</li>
			<!-- /.dropdown -->
			<li class="dropdown" style="display:none">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-info fa-fw"></i> 
				</a>
			</li>
			<!-- /.dropdown -->                 
		   
		</ul>

		<!-- /.navbar-top-links -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav " id="side-menu">
					<li class="sidebar-profile text-center">
						<span class="sidebar-profile-picture">
							<img src="<?php echo WEBLIZAR_NALF_PLUGIN_URL.'css/img/photo.jpg'; ?>" alt="Profile Picture"/>
						</span>
						<p class="sidebar-profile-description">
							<?php _e('Powered By','WEBLIZAR_ACL')?>
						</p>
						<h3 class="sidebar-profile-name"><a href="http://weblizar.com/" target="_blank" style="background-color: #29282f; border-left:0px ; "><?php _e( 'Weblizar', 'WEBLIZAR_ACL' ); ?></a></h3>
					</li>

					<li>
						<a  class="active" href="#"  id="ui-id-1">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-dashboard fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Dashboard','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Application overview','WEBLIZAR_ACL')?></span>
						</a>
					</li>
					<li>
						<a href="#" id="ui-id-6">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Background Design','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Modify Background design here','WEBLIZAR_ACL')?></span>
						</a>
						<!-- /.nav-second-level -->
					</li>
					<li>
						<a href="#" id="ui-id-8">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Login form Setting','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Modify Login design here','WEBLIZAR_ACL')?></span>
						</a>
						<!-- /.nav-second-level -->
					</li>
					<li>
						<a  href="#Text-And-Colour"  id="ui-id-7">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-dashboard fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Font Setting','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Modify Login Form Style here','WEBLIZAR_ACL')?></span>
						</a>
					</li>

					<li>
						<a href="#" id="ui-id-3">
							<span class="sidebar-item-icon fa-stack ">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Logo Settings','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Customize Logo Settings here','WEBLIZAR_ACL')?></span>
						</a>
						
						<!-- /.nav-second-level -->
					</li>
					<li>
						<a href="#"  id="ui-id-9">
							<span class="sidebar-item-icon fa-stack">
								<i class="fa fa-square fa-stack-2x text-primary"></i>
								<i class="fa fa-table fa-stack-1x fa-inverse"></i>
							</span>
							<span class="sidebar-item-title"><?php _e('Social Settings','WEBLIZAR_ACL')?></span>
							<span class="sidebar-item-subtitle"><?php _e('Connect with your social profile','WEBLIZAR_ACL')?></span>
						</a>
					</li>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>

	<div class="page-wrapper ui-tabs-panel active" id="option-ui-id-1">	
	  <?php require_once('dashboard/dashboard.php'); ?>
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-3">
	  <?php require_once('settings/page-settings.php'); ?>
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-6">
	  <?php require_once('design/background.php'); ?>
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-7">
	  <?php require_once('design/text_and_color.php'); ?>
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-8">
	  <?php require_once('Login-form-setting/Login-form-background.php'); ?>
	</div>
	<div class="page-wrapper ui-tabs-panel deactive" id="option-ui-id-9">
	  <?php require_once('social/social.php'); ?>
	</div>
</div>
<!-- /#wrapper -->
<script>
    jQuery(function() {
	jQuery('.icp').iconpicker({
			title: 'Font Awesome Iocns', // Popover title (optional) only if specified in the template
			selected: false, // use this value as the current item and ignore the original
			defaultValue: true, // use this value as the current item if input or element value is empty
			placement: 'topRight', // (has some issues with auto and CSS). auto, top, bottom, left, right
			showFooter: true,
			mustAccept:false,
		});              
    });
</script>