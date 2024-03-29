<?php

define( 'POPUP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'POPUP_PLUGIN_DIR_NAME', dirname( plugin_basename( __FILE__ ) ) );

define( 'POPUP_PLUGIN_PREFIX', 'wpp' ); //WordPress Popup Plugin

define( 'POPUP_PLUGIN_POPUP_POST_TYPE', POPUP_PLUGIN_PREFIX . '_popup' );

if ( ! defined( 'POPUP_PLUGIN_LINK_POPUP_SHORTCODE' ) )
	define( 'POPUP_PLUGIN_LINK_POPUP_SHORTCODE', 'link_popup' );

if ( ! defined( 'POPUP_PLUGIN_CAPABILITY' ) )
	define( 'POPUP_PLUGIN_CAPABILITY', 'manage_options' );


define( 'POPUP_PLUGIN_INCLUDE_DIRECTORY_NAME', 'includes' );

define( 'POPUP_PLUGIN_VIEW_DIRECTORY_NAME', 'views' );

define( 'POPUP_PLUGIN_CSS_DIRECTORY_NAME', 'css' );

define( 'POPUP_PLUGIN_JS_DIRECTORY_NAME', 'js' );

define( 'POPUP_PLUGIN_INCLUDE_DIRECTORY', POPUP_PLUGIN_PATH .
									  	POPUP_PLUGIN_INCLUDE_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'POPUP_PLUGIN_VIEW_DIRECTORY', POPUP_PLUGIN_PATH .
									  	POPUP_PLUGIN_VIEW_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'POPUP_PLUGIN_CSS_DIRECTORY', POPUP_PLUGIN_PATH .
									  	POPUP_PLUGIN_CSS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'POPUP_PLUGIN_JS_DIRECTORY', POPUP_PLUGIN_PATH .
									  	POPUP_PLUGIN_JS_DIRECTORY_NAME
							 		  	. DIRECTORY_SEPARATOR );

define( 'POPUP_PLUGIN_MAIN_FILE', POPUP_PLUGIN_PATH . 'wp-popup.php' );

//auto load themes from popup themes directory.
define( 'POPUP_THEME_DIRECTORY', POPUP_PLUGIN_PATH . 'themes' );

define( 'POPUP_CLEAR_CACHE_ON_SAVE', TRUE );

define( 'POPUP_PLUGIN_VERSION', '0.5.23' );