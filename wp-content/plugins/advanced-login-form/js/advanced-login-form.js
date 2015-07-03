jQuery(document).ready(function(){

	// For Login form place holder text
    jQuery('#loginform #user_login').attr('placeholder', 'Username');
    jQuery('#loginform #user_pass').attr('placeholder', 'Password');
    jQuery('#registerform #user_login').attr('placeholder', 'Username');
    jQuery('#registerform #user_email').attr('placeholder', 'Email');
    jQuery('#lostpasswordform #user_login').attr('placeholder', 'Username or Email');
	
	// For Login form input icon
	jQuery('#loginform label[for="user_login"]').addClass('fa fa-envelope');
	jQuery('#loginform label[for="user_pass"]').addClass('fa fa-key');
	jQuery('#registerform label[for="user_login"]').addClass('fa fa-user');
	jQuery('#registerform label[for="user_email"]').addClass('fa fa-envelope');
	jQuery('#lostpasswordform label[for="user_login"]').addClass('fa fa-rocket');
	jQuery('body.login div#login h1').addClass('fa fa-wordpress fa-spin fa-5x');
	
	// For Login form label hide
	jQuery('#loginform label[for="user_login"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	jQuery('#loginform label[for="user_pass"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	jQuery('#registerform label[for="user_login"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	jQuery('#registerform label[for="user_email"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	jQuery('#lostpasswordform label[for="user_login"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	
});