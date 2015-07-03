<?php 
#// BEGIN set display based on selected fields & user permission
class wpul_widget extends WP_Widget {

	function wpul_widget() {
		// Instantiate the parent object
			show_admin_bar(false); // Disable admin bar

		parent::__construct( false, 'WP UserLogin');
	}
function wpul_user_permissions($args){
    wp_enqueue_script('wpul',plugins_url('/js/wpul-bootstrap.js',__FILE__),array('jquery'),null,true);
    wp_enqueue_style('strapfix',plugins_url('/css/strapfix.css',__FILE__),array(),null);
	$wp_url = get_settings('siteurl');
        $check = get_option('wpul_settings');
        $welcome = $check['welcome'];
	$vals = explode(',',$args);
        global $current_user, $user_ID, $wp_admin_bar,$wpdb,$post;
        get_currentuserinfo();
	

        $comments_waiting = $wpdb->get_var($wpdb->prepare("SELECT count(comment_ID) FROM $wpdb->comments WHERE comment_approved = '0'"));
	$core = get_option('_site_transient_update_core');
	$plugins = get_option('_site_transient_update_plugins');
	$updates['plugins'] = $plugins->response;
	$updates['core'] = $core->updates['0']->response;
	$plugin_update = count($updates['plugins']);
	$link[] = ($check['dashboard'] == 'CHECKED' ? '<div class="panel panel-default"><div class="panel-heading" role="tab"><a href="'.admin_url().'" class="panel-title">'.__('Dashboard').'</a></div></div>':'');
	$link[] = ($comments_waiting > 0) ? '<li><a class="btn btn-default " href="'.admin_url('edit-comments.php?comment_status=moderated').'"/">'.pluralize($comments_waiting,__('Comments'),__('Comment')).(' Pending').' <span class="badge badge-important">'.$comments_waiting.'</span></a></li>':'';
        $link[]= current_user_can('edit_posts') && (is_single() || is_page())?'<li><a href="'.get_edit_post_link($post->ID).'" class="btn btn-warning ">Edit This '.ucwords($post->post_type).'</a></li>':'';
        
        $postlabel = '<div class="panel panel-primary"><div class="panel-heading" role="tab"><a class="panel-title" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" data-target="#posts">'.__('Posts').' <b class="caret"></b></a></div>
        <div id="posts" class="panel-body collapse">';
	$new = $check['newpost'] == 'CHECKED' && current_user_can('publish_posts') ? '<a class="btn-link btn-block" href="'.admin_url('post-new.php').'">'.__('New Post').'</a>':'';
        $edit = $check['editpost'] == 'CHECKED' && current_user_can('edit_posts') ? '<a class="btn-link btn-block" href="'.admin_url('edit.php').'">'.__('Edit Posts').'</a>':'';
        $endcollapse = '</div></div>';
        $link[] = $postlabel.$new.$edit.$ethis.$endcollapse ;

	$themes = '<div class="panel panel-primary" role="tab"><div class="panel-heading"  role="tab"><a class="panel-title" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" data-target="#themes">'.__('Appearance').' <b class="caret"></b></a></div><div id="themes" class=" panel-body collapse">';
        $manage =$check['managetheme'] == "CHECKED" && current_user_can('update_themes')? '<a class="btn-link btn-block" href="'.admin_url('themes.php').'">'.__('Manage Themes').'</a>':'';
	$installt = $check['installtheme'] == "CHECKED" && current_user_can('install_themes')? '<a class="btn-link btn-block" href="'.admin_url('theme-install.php').'">'.__('Install Themes').'</a>':'';
	$editt = $check['edittheme'] == "CHECKED" && current_user_can('editthemes')? '<li><a class="btn-link btn-block" href="'.admin_url('theme-install.php').'">'.__('Editor').'</a>':'';
        $link[] = $themes.$manage.$installt.$editt.'</div></div>';
        
	$plugins = '<div class="panel panel-primary"><div class="panel-heading" role="tab"><a class="panel-title" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" data-target="#plugins">'.__('Plugins').' <b class="caret"></b></a></div><div id="plugins" class="panel-body collapse">';
        $update = '<a class="btn-link btn-block" href="'.admin_url('plugins.php').'">'.__('Manage Plugins').'</a>';
	$installp = $check['install_plugins'] == "CHECKED" && current_user_can('install_plugins') ? '<a class="btn-link btn-block" href="'.admin_url('plugins.php').'">'.__('Install Plugins').'</a>':'';
        $link[] = $plugins.$update.$installp.'</div></div>';
                
	$users = '<div class="panel panel-primary"><div class="panel-heading"  role="tab"><a class="panel-title" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" data-target="#users">'.__('Users').' <b class="caret"></b></a></div><div id="users" class="panel-body collapse">';
	$editu = $check['users'] == "CHECKED" &&  current_user_can('edit_users')?'<a href="'.admin_url('users.php').'" class="btn-link btn-block">'.__('All Users').'</a>':'';
	$eprofile = $check['profile'] == "CHECKED" &&  is_user_logged_in()?'<a href="'.admin_url('profile.php').'" class="btn-link btn-block">'.__('Edit Your Profile').'</a>':'';
	$vprofile = '<a href="'.home_url('?author='.$user_ID).'" class="btn-link btn-block">'.__('View Your Profile','wp-userlogin').'</a>';
        $link[] = $users.$editu.$eprofile.$vprofile.'</div></div>';
        
        $link[] = $plugin_update > 0 && current_user_can('update_core') ? '<li><a href="'.admin_url('update-core.php').'" class="btn btn-danger ">'.$plugin_update.__(' Plugin ').pluralize($plugin_update,__('Updates'),__('Update')).__(' Available').'</a>':''; 
	$link[] = $updates['core'] == 'upgrade' && current_user_can('update_core')?'<li><a href="'.admin_url('update-core.php').'" class="btn btn-danger ">'.__('Core Update Available').'</a>':''; 
	$link[] = $check['options'] == "CHECKED" &&  current_user_can('manage_options')?'<div class="panel panel-warning"><div class="panel-heading"  role="tab"><a class="panel-title" href="'.admin_url('options-general.php').'">'.__('Settings').'</a></div></div>':'';
        $link[] = '<div class="panel panel-info"><div class="panel-heading"  role="tab"><a class="panel-title" href="'.admin_url('tools.php').'">'.__('Available Tools').'</a></div></div>';
        $link[] = '<div class="panel panel-success"><div class="panel-heading"  role="tab"><a class="panel-title" href="'.admin_url('admin.php?page=wpul_options').'">'.__('UserLogin').'</a></div></div>';
	$link[] = $check['logout'] == "CHECKED" && is_user_logged_in()?
            $check['redirect_out'] !== ''?'<li><a class="btn btn-danger " href="'.wp_logout_url(get_bloginfo('url').'/'.$check['redirect_out']).'">'.__('Logout').'</a></li>':'<div class="panel panel-danger"><div class="panel-heading"  role="tab"><a class="panel-title" href="'.wp_logout_url($_SERVER['REQUEST_URI']).'" class="btn  btn-danger">'.__('Logout').'</a></div></div>':'';    
    if($check['welcomecheck'] == "CHECKED"){
        $firstname = !empty($current_user->user_firstname)?$current_user->user_firstname:$current_user->display_name;
        $lastname = !empty($current_user->user_lastname)? $current_user->user_lastname:$current_user->display_name;
        $fullname = !empty($current_user->user_firstname) && !empty($current_user->user_lastname)?$current_user->user_firstname.' '.$current_user->user_lastname:$current_user->display_name;

        $look = array(
            'user'=>$current_user->user_nicename,
            'login'=>$current_user->user_login,
            'email'=>$current_user->user_email,
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'fullname'=>$fullname,
            'id'=>$current_user->ID
        );
        $key = '';
        $val = '';
        list($key,$val) = explode('%',$welcome);
            $head = $welcome ? $key. $look[$val]:'';
        }
        $head = '<span id="welcome">'.$head.'</span>';
    $avatar = $check['avatar'] == "CHECKED"?get_avatar( $current_user->ID, '96', '', $look[$val] ):'';
preg_match("/src='(.*?)'/i",$avatar,$match);
    $avatar = '<img src="'.$match[1].'" class="img-circle">';
        $head = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div>'.$avatar.'&nbsp;'.$head. '</div>';
        
 	$foot = wpul_optional_links()."</div>";
$links = implode('',$link);
	return $head.$links.$foot;
}
	function widget( $args, $instance ) {
		// Widget output
		$check = get_option('wpul_settings');
		//~ print_r($check);	
		if(is_user_logged_in()){
			global $current_user;
			get_currentuserinfo();
		$title =$option['set_log'];	
		
            if ( current_user_can('activate_plugins')){
		for($i=0;$i<10;$i++){
			$options[] =$i;
		}
            }
	    if(current_user_can('edit_posts')){
		$options[] = 2;
		$options[] = 0;
	    }
            if(current_user_can('publish_posts')){
		for($i=3;$i<8;$i++){
			$options[] = $i;
		}
		$options[] .= 0;
	    }
            if(current_user_can('read') ){
                    $options[] = 0;
                    $options[] = 6;
                    $options[] = 7;
            }
	    $options = array_unique($options);
	    $options = implode(',',$options);
	    $options = $this->wpul_user_permissions($options);

		}else{
		$title = $option['set_nonlog'];
		if($option['redirect'] !== ''){
			$redir = get_bloginfo('url').'/'.$option['redirect'];
		}else{
			$redir = $_SERVER['REQUEST_URI'];
		}
                $after_widget = '<div class="clearfix"></div>';
			$outargs = array(
        'echo' => true,
        'redirect' => $redir, 
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false );
        echo $_GET['login'] == 'failed' ? '<div class="alert alert-danger">Login failed</div>':'';
			wp_login_form($outargs);
		}
		echo $before_title
		. $title
		. $after_title
		. $options
		.$after_widget;
		
	}



	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
}
?>