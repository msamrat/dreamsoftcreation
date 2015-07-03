<?php

/*
Plugin Name: WP-UserLogin
Plugin URI: http://wayofthegeek.org/downloads/wp-userlogin/
Description: Adds a UserLogin Widget to display login form or dashboard links depending on user role.
Version: 14.12
Author: Jerry Stephens
Author URI: http://wayofthegeek.org/
License: LGPLv3
License URI: http://www.gnu.org/licenses/lgpl.txt
*/

$donate = '<div id="pay" title="Help keep me doing what I do for free"><span class="zocial-bitcoin"></span> Donate<i class="dashicons dashicons-arrow-down"></i></div>
<form target="_blank" class="bitpay-donate hidden" action="https://bitpay.com/checkout" method="post" onsubmit="return checkRequiredFields(this);">
    <input name="action" type="hidden" value="checkout">
    <fieldset>
      <ul>        
        <li class="bitpay-donate-field">
          <label>Email:</label>
          <input class="bitpay-donate-field-email" name="orderID" type="email" placeholder="Email address (optional)" maxlength=50 autocapitalize=off autocorrect=off><br>
        </li>
        <li class="bitpay-donate-field">
          <label>Amount:</label>
          <input class="bitpay-donate-field-price" name="price" type="number" value="10.00" placeholder="Amount" maxlength="10" min="0.000006" step="0.000001"/>
          <select class="bitpay-donate-field-currency" name="currency" value="">
            <option selected="selected" value="USD">USD</option>
            <option value="BTC">BTC</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="AUD">AUD</option>
            <option value="BGN">BGN</option>
            <option value="BRL">BRL</option>
            <option value="CAD">CAD</option>
            <option value="CHF">CHF</option>
            <option value="CNY">CNY</option>
            <option value="CZK">CZK</option>
            <option value="DKK">DKK</option>
            <option value="HKD">HKD</option>
            <option value="HRK">HRK</option>
            <option value="HUF">HUF</option>
            <option value="IDR">IDR</option>
            <option value="ILS">ILS</option>
            <option value="INR">INR</option>
            <option value="JPY">JPY</option>
            <option value="KRW">KRW</option>
            <option value="LTL">LTL</option>
            <option value="LVL">LVL</option>
            <option value="MXN">MXN</option>
            <option value="MYR">MYR</option>
            <option value="NOK">NOK</option>
            <option value="NZD">NZD</option>
            <option value="PHP">PHP</option>
            <option value="PLN">PLN</option>
            <option value="RON">RON</option>
            <option value="RUB">RUB</option>
            <option value="SEK">SEK</option>
            <option value="SGD">SGD</option>
            <option value="THB">THB</option>
            <option value="TRY">TRY</option>
            <option value="ZAR">ZAR</option>
          </select>
        </li>
      </ul>
      <input type="hidden" name="data" value="pdU9SYiiWVggVZmLpE2MxeGhU2FuaA5LvGym+w6l9GAiFvjrdwyhVtpWYTfSoJb2CaFUkVOnLMYWxGt6TfrnVWOpn8tj0uE7uwkb2yyuRZKX8JA094Mz38lj67b97EMbX18j5AbvKfI46EJhDp3WZt4zoVF9wetSK7CcdCyW6h+w/HG1SiqdF6nQk05z4inY"> 
      <div class="bitpay-donate-button-wrapper">
<!--        <input class="bitpay-donate-button" name="submit" src="https://bitpay.com/img/donate-button.svg" onerror="this.onerror=null; this.src=\'https://bitpay.com/img/donate-button-md.png\'" width="126" height="48" type="image" alt="BitPay, the easy way to pay with bitcoins." border="0"> -->
<input type="submit" value="Donate" class="bitpay-donate-button button-primary">
      </div>
    </fieldset>
  </form>
  <hr>';
  global $donate;
	
#// BEGIN add textdomain for localization
$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'wp-userlogin', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );
#// END add textdomain for localization

#// BEGIN Add option pages
add_action('admin_menu','wpul_option_page');
add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
$class = str_replace("class='avatar", "class='thumbnail  ", $class) ;
return $class;
}

function wpul_option_page(){
	add_menu_page(__('UserLogin', 'wp-userlogin'),__('UserLogin', 'wp-userlogin'),'manage_options','wpul_options','wpul_userlogin_options_page');	
	add_submenu_page('wpul_options','','','manage_options','wpul_options','wpul_userlogin_options_page'); // Remove needless extra UserLogin submenu page
	add_submenu_page('wpul_options',__('CSS Editor', 'wp-userlogin'),__('CSS Editor', 'wp-userlogin'),'manage_options','wpul_style_options','wpul_style_editor');	
	add_submenu_page('wpul_options',__('Help File', 'wp-userlogin'),__('Help File', 'wp-userlogin'),'manage_options','wpul_help','wpul_help_file');	
}
#// END Add option pages
 
#// BEGIN sanitize Login Panel Name field
function wpul_sanitize($string) { 
        $sanitize= strip_tags(addslashes($string));
        $string = $sanitize;
        
        return $string;

}
#// END sanitize Login Panel Name field

#// BEGIN register settings
function wpul_init() {
    register_setting('wpul_text','wpul_settings');
}
#// END register settings

#// BEGIN work-around for update notification
add_action('admin_init','wpul_init');
function wpul_notify(){
    echo '<div id="message" class="updated below-h2">Options Saved.</div>';
}
#// END work-around for update notification

#// BEGIN build second page (form options)
function wpul_userlogin_options_page(){
    global $donate;
        $theme = wp_get_theme();
        $troot = $theme->theme_root.'/'.$theme->template;
        $head = file_get_contents($troot.'/header.php');
    wp_enqueue_style('bitpay',plugins_url('/css/bitpay.css',__FILE__),array());
    wp_enqueue_script('bitpay',plugins_url('/js/bitpay.js',__FILE__),array());
?>
        <div class="wrap">
		<h2><?php _e('UserLogin Options', 'wp-userlogin');?></h2><?php echo $donate; ?>
<?php if($_GET['updated'] == 'true'):
echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
endif;?>
                <form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

        <?php settings_fields('wpul_text');
        $option = get_option('wpul_settings');
//        print_r($option);
?>
<div style="width: 50%; float: left; margin-right: 20px;">
<div class="postbox">
<h3 style="cursor: auto; margin: 0; padding: 5px;" class="hndle"><?php _e('Form Content Options','wp-userlogin');?></h3>
<div style="padding: 5px;">
<h4 style="margin-bottom: 0;"><?php _e('Login Form Name','wp-userlogin');?></h4>
        <input name="wpul_settings[set_nonlog]" type="text" value="<?php echo $option['set_nonlog'];?>" />
<h4 style="margin-bottom: 0;"><?php _e('Login Redirect Page','wp-userlogin');?></h4>
        <?php bloginfo('url');?>/<input name="wpul_settings[redirect]" size="15" type="text" value="<?php echo $option['redirect'];?>" />
<h4 style="margin-bottom: 0;"><?php _e('Logout Redirect Page','wp-userlogin');?></h4>
        <?php bloginfo('url');?>/<input name="wpul_settings[redirect_out]" type="text" size="15" value="<?php echo $option['redirect_out'];?>" />
        
 </div></div>	
 

<div class="postbox">
<h3 style="cursor: auto; margin: 0; padding: 5px;" class="hndle"><?php _e('Personalization Options','wp-userlogin');?></h3>
<div style="padding: 5px;">
 <h4 style="margin-bottom: 0;"><?php _e('Gravatars','wp-userlogin');?></h4>
                <input type="checkbox" name="wpul_settings[avatar]" value="CHECKED" <?php echo $option['avatar'];?> /> <?php _e('Display Gravatar','wp-userlogin');?><br />
                <?php _e('Uses avatar settings set on the','wp-userlogin');?> <a href="<?php bloginfo('wpurl');?>/wp-admin/options-discussion.php"><?php _e('Discussion Page','wp-userlogin');?></a>.
 
 <h4 style="margin-bottom: 0;"><?php _e('Welcome Message','wp-userlogin');?></h4>
                <input type="text" name="wpul_settings[welcome]" size="25" value="<?php echo $option['welcome'];?>" />

<br />
                <input type="checkbox" name="wpul_settings[welcomecheck]" value="CHECKED" <?php echo $option['welcomecheck'];?> /> <?php _e('Display Welcome Message','wp-userlogin');?><br />

            <br /><strong><small><?php _e('indicate current user with','wp-userlogin');?></small>:</strong>
            <table cellspacing="6" id="msg">
                <tr><td><strong>%user</strong></td><td> <?php _e('Display Name','wp-userlogin');?></td></tr>
                <tr><td><strong>%login</strong></td><td> Username/Login</td></tr>

                <tr><td><strong>%id</strong></td><td> <?php _e('User ID','wp-userlogin');?></td></tr>
                <tr><td><strong>%email</strong></td><td> <?php _e('User Email','wp-userlogin');?></td></tr>
<tr><td colspan="2" id="msg-info"><?php _e('The following options default to <strong>%user</strong> if profile info is blank','wp-userlogin');?></td></tr>
                <tr><td><strong>%firstname</strong></td><td> <?php _e('User First Name','wp-userlogin');?></td></tr>
                <tr><td><strong>%lastname</strong></td><td> <?php _e('User Last Name','wp-userlogin');?></td></tr>
                <tr><td><strong>%fullname</strong></td><td> <?php _e('User Full Name','wp-userlogin');?></td></tr>
            </table>
           </dt>
</td></tr></table>
</div></div>
</div>
<div  style="float: left; width: 360px;">
<div class="postbox">
    <h3 style="cursor: auto; margin: 0; padding: 5px;" class="hndle">Use Bootstrap CSS &amp; Javascript?<br><small><a href="http://getbootstrap.com/" target="blank">What is Bootstrap?</a></small></h3>
    <div style="padding: 5px;">
    <table width="100%"><tr>
    <?php
        $option = get_option('wpul_settings');
        $boot = $option['bootstrap'];
    ?>
        <td><input type="radio" id="boostrap" name="wpul_settings[bootstrap]" value="yes"<?php echo $boot == 'yes'?'CHECKED':'';?>><label for="boostrap"> Yes</label></td>
        <td><input type="radio" id="nostrap" name="wpul_settings[bootstrap]" value="no" <?php echo ($boot == 'no' || empty($boot))?'CHECKED':'';?>><label for="nostrap"> No</label></td>
    </tr></table>
    </div>
</div>
<div class="postbox">
<h3 style="cursor: auto; margin: 0; padding: 5px;" class="hndle"><?php _e('Control Panel Content Options','wp-userlogin');?></h3>
<div style="padding: 5px;">
 <h4 style="margin-bottom: 0;"><?php _e('Control Panel Name','wp-userlogin');?></h4>
        <input name="wpul_settings[set_log]" type="text" value="<?php echo $option['set_log'];?>" />

 <h4 style="margin-bottom: 0;"><?php _e('Control Stylesheet','wp-userlogin');?></h4>
<input type="checkbox" name="wpul_settings[style]" value="CHECKED" <?php echo $option['style'];?> /> <?php _e('Use default stylesheet','wp-userlogin');?><br />

 <h4 style="margin-bottom: 0;"><?php _e('Available Links','wp-userlogin');?>
 <small>(<?php _e('based on user role','wp-userlogin');?>)</small></h4>
 	<input type="checkbox" name="wpul_settings[dashboard]" value="CHECKED" <?php echo $option['dashboard'];?> /> <?php _e('Dashboard','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[newpost]" value="CHECKED" <?php echo $option['newpost'];?> /> <?php _e('New Post','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[editpost]" value="CHECKED" <?php echo $option['editpost'];?> /> <?php _e('Edit Posts','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[managetheme]" value="CHECKED" <?php echo $option['managetheme'];?> /> <?php _e('Manage Themes','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[install_plugins]" value="CHECKED" <?php echo $option['install_plugins'];?> /> <?php _e('Plugins','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[options]" value="CHECKED" <?php echo $option['options'];?> /> <?php _e('Options','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[users]" value="CHECKED" <?php echo $option['users'];?> /> <?php _e('Users','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[profile]" value="CHECKED" <?php echo $option['profile'];?> /> <?php _e('Your Profile','wp-userlogin');?><br />
	<input type="checkbox" name="wpul_settings[logout]" value="CHECKED" <?php echo $option['logout'];?> /> <?php _e('Logout','wp-userlogin');?><br />
</div>
<div style="padding: 5px;">
 <h4 style="margin-bottom: 0;"><?php _e('Extra Optional Links','wp-userlogin');?></h4>
 <span style="float: left; display: block; width: 50%; text-align: center;">URL</span>
 <span style="float: right; display: block; width: 50%; text-align: center;">Name</span>
 <br clear="all" />
<div id="clone">
<?php for($i=0;$i<count($option['link']);$i++){ ?>
    <div class="link-container">
        <input type="text" name="wpul_settings[link][]" value="<?php echo $option['link'][$i];?>" />
        <input type="text" name="wpul_settings[name][]" value="<?php echo $option['name'][$i];?>" />
        <span class="add" title="<?php _e('Add new line','wp-userlogin'); ?>">&plus;</span><span class="subtract" title="<?php _e('Delete this line','wp-userlogin'); ?>">/&minus;</span>
    </div>
<?php } ?>
</div>
<p><input type="checkbox" name="wpul_settings[nofollow]" value="CHECKED" <?php echo $option['nofollow'];?> /> <?php _e('Use <strong>rel="nofollow"</strong> on links?','wp-userlogin');?></p>

</div>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="wpul_settings" />
 <p class="submit" style="clear: both; float: right;">
		<input type="submit" name="submit" value="<?php _e('Save Changes','wp-userlogin')?> " />
	</p>
        </div>
    </form>
        </div>
<?php
}
#// END build second page

#// BEGIN build third page (css editor)
function wpul_style_editor(){
    $changes = $_POST['editor'];

        if(isset($_POST['Submit'])){
            $css = file_put_contents(dirname(__FILE__).'/style.css',$changes);
        }
    global $donate;
    wp_enqueue_style('bitpay',plugins_url('/css/bitpay.css',__FILE__),array());
    wp_enqueue_script('bitpay',plugins_url('/js/bitpay.js',__FILE__),array());
?>
        <div class="wrap">
        <h2><?php _e('Edit WP-Userlogin CSS', 'wp-userlogin');?></h2>
<div class="fileedit-sub"><?php echo $donate; ?>

	<form method="post" action="">
<?php if(isset($_POST['Submit'])):
echo '<div id="message" class="updated fade"><p><strong>' . _e('Stylesheet Updated','wp-userlogin') . '</strong></p></div>';
endif;?>
<?php
        $css = file_get_contents(dirname(__FILE__).'/style.css');
        echo '<textarea name="editor" rows="25" cols="70" style="width: 80%; height: 100%; margin: 0 auto;">'.$css.'</textarea>';
?>
	<p class="submit">
	<?php wp_nonce_field('update-options'); ?>
	<input type="hidden" name="action" value="update" />
		<input type="submit" name="Submit" value="<?php _e('Edit Stylesheet','wp-userlogin');?> " />
        </p>
    </div></div>
<?php
}
#// END build thir page

#// BEGIN database record install
function wpul_initial_db($args){
	$newvalue = "";
	$autoload = "yes";
	$deprecated = " ";
	$boxvalue = array('CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED','CHECKED');
	$option = array('set_nonlog','set_log','redirect','set_checkbox');
	$check = get_option('set_checkbox');
	$redirect = get_option('redirect');
        $redirect_out = get_option('redirect_out');
        $welcome = get_option('welcome');
        $stylesheet = get_option('use_stylesheet');
        $nonlog = get_option('set_nonlog');
        $log = get_option('set_log');
        
$upgrade = array(
                 'set_nonlog'=>$nonlog,
                 'set_log'=>$log,
                 'welcome'=> $welcome,
                 'redirect'=>$redirect,
                 'redirect_out'=>$redirect_out,
                 'dashboard'=>$check[0],
                 'newpost'=>$check[1],
                 'editpost'=>$check[2],
                 'managetheme'=>$check[3],
		 'install_plugins'=>$check[4],
                 'options'=>$check[5],
                 'users'=>$check[6],
                 'profile'=>$check[7],
                 'logout'=>$check[8],
                 'welcomecheck'=>$check[9],
                 'style'=>$check[10],
                 'avatar'=>"",
                 'bootstrap'=>""
                );
$install = array(
                 'set_nonlog'=>"Login",
                 'set_log'=>"Control Panel",
                 'welcome'=>"Hey %user",
                 'redirect'=>"",
                 'redirect_out'=>"",
                 'dashboard'=>"CHECKED",
                 'newpost'=>"CHECKED",
                 'editpost'=>"CHECKED",
                 'managetheme'=>"CHECKED",
		 'install_plugins'=>"CHECKED",
                 'options'=>"CHECKED",
                 'users'=>"CHECKED",
                 'profile'=>"CHECKED",
                 'logout'=>"CHECKED",
                 'welcomecheck'=>"CHECKED",
                 'style'=>"CHECKED",
                 'avatar'=>"CHECKED",
                 'bootstrap'=>""
                );
                
    if($nonlog != ""):
        add_option('wpul_settings',$upgrade);
	delete_option($option[0]);
	delete_option($option[1]);
	delete_option($option[2]);
	delete_option('set_checkbox');
        delete_option('use_stylesheet');

    else:
        add_option('wpul_settings',$install);
    endif;
}
#// END database record install

#// BEGIN initialize sidebar widget
function wpul_widget_userlogin_init() {
	if (!function_exists('register_sidebar_widget')) {
        return;
	}
#// BEGIN set display for links set in backend

function wpul_optional_links() {
    $option = get_option('wpul_settings');
    if($option['nofollow'] == "CHECKED"):
        $follow = ' rel="nofollow"';
    endif;
    $links = '<ul>';
    for($i=0;$i<count($option['link']);$i++):
			$link = $option['link'][$i];
			$name = $option['name'][$i];

			$links .= '<li><a href="'.$link.'"'.$follow.'>'.$name.'</a></li>';
//        array_push($links,$link);
    endfor;
    $links .= '</ul>';
return $links;
}
function pluralize($num, $plural = 's', $single = '') {
    if ($num == 1) return $single; else return $plural;
}
#// END set display for links set in backend

$option = get_option('wpul_settings');

#// Include widget based on user choice
switch($option['bootstrap']){
    case 'yes':
        include(plugin_dir_path(__FILE__).'wpul-bootstrap.php');
    break;
    case 'no':
        include(plugin_dir_path(__FILE__).'wpul-nostrap.php');
    break;
    default:
        include(plugin_dir_path(__FILE__).'wpul-nostrap.php');
    break;
}

function openid_call(){ // Check for OpenID
    	if(function_exists('openid_input')){
        $openid = '<label for="openid">'.__('OpenID', 'wp-userlogin').'<br>'.openid_input().'</label><br>';
	}else{
	$openid = "";
	}
        return $openid;
}
add_filter( 'login_form_middle', 'openid_call' ); // Add OpenID to form if it exists
function myplugin_register_wpul() {
	register_widget( 'wpul_widget' );
}
function wpul_help_file(){
    global $donate;
    wp_enqueue_style('bitpay',plugins_url('/css/bitpay.css',__FILE__),array());
    wp_enqueue_script('bitpay',plugins_url('/js/bitpay.js',__FILE__),array());
    echo '<div class="wrap">
    <h2>WP-UserLogin Help</h2>'.$donate.'
    <h3 style="color: #009; margin: 0;">//-> BEGIN Readme file junk</h3>
    You\'ve probably checked this all out before downloading the plugin
    <dl><strong>What does this plugin do, exactly?</strong>
    <dd>It builds a login form and control panel in the sidebar of your page.</dd>

    <strong>Can I edit the CSS for the form and control panel?</strong>
    <dd>Yes, as of v5.0 a stylesheet editor has been included. If you don\'t like that stylesheet, or you have your own already, you also have the option to use your own stylesheet.</dd>

    <strong>The last version didn\'t support OpenID. What happened?</strong>
    <dd>Most were telling me they weren\'t using it or that it was dead. And from what I had seen, it seemed to be true. However, one user requested it again as that was the reason she chose my plugin. So I obliged.</dd>
    <strong>Does this work with EVERY OpenID plugin?</strong>
    <dd>No, this plugin only works with the plugin named <a href="http://wordpress.org/extend/plugins/openid/" target="_blank">OpenID</a></dd></dl>
    <br><h3 style="color: #900; margin: 0;">//-> BEGIN Stuff that matters</h3>
    <dl><strong>What version of Bootstrap are you using?</strong>
    <dd>Currently, we are using 3.0</dd>
    <strong>How can I insert this into a page template file?</strong>
    <dd>You can call the widget programmatically with the line <strong>&lt;?php the_widget(\'wpul_widget\'); ?&gt;</strong></dd>
    <strong>Help me I have a problem you haven\'t covered! People are dying!</strong>
    <dd>Calm down, if you have something I didn\'t cover here or in the <a href="http://plugins.svn.wordpress.org/wp-userlogin/trunk/readme.txt" target="_blank">Readme file</a> you can ask it on <a href="https://wordpress.org/support/plugin/wp-userlogin" target="_blank">the forum</a>. Your crisis will be resolved, don\'t sweat it.
    </dl>
    </div>';
    
}
add_action( 'widgets_init', 'myplugin_register_wpul' );
#// END build sidebar widget

#// BEGIN register sidebar widget
register_sidebar_widget('User Login','wpul_widget_userlogin');		
#// END register sidebar widget
}
#// END initialize sidebar widget

#// BEGIN set plugin stylesheet & scripts

function wpul_scripts() {
    wp_enqueue_style('bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',array(),null);
    wp_enqueue_script('bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js',array('jquery'),null,true);
}
function no_scripts(){
    wp_enqueue_style('wpul',plugins_url('style.css',__FILE__),null);
}
$option = get_option('wpul_settings');
add_action('wp_enqueue_scripts',$option['bootstrap'] == 'yes'?'wpul_scripts':'no_scripts');
#// END set plugin stylesheet & scripts

#// BEGIN uninstall function
function wpul_uninstall() {
    delete_option('wpul_settings');
}
#// END unsinstall function

add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}

#/> Load db info on plugin activation
register_activation_hook( __FILE__, 'wpul_initial_db' );
#/> Delete DB entry on deactivation
register_deactivation_hook(__FILE__, 'wpul_uninstall');
#/> Load The WP-UserLogin Widget
add_action('plugins_loaded', 'wpul_widget_userlogin_init');


?>