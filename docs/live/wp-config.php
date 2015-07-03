<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'releuscars');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'vy0&unrs^!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}tF]z9vbkL|N++V-/v2kXo6kD*F<e;gumv!gC |_R$,GCsJXl]tQ-)$kY6H9+rBE');
define('SECURE_AUTH_KEY',  '}H=K,d|WA(%;zQ*nf-J8kp!ZF[m&Wx)y=:{(G{XS.a{v-JoIxEA%rEVk/&=3d[Mt');
define('LOGGED_IN_KEY',    'x,2@H$b90N(`g(H1hzY>WKO+*|`< Veh[E_s(+=p4lz=_d#2E|;inb<z-BN$Q[q=');
define('NONCE_KEY',        '`wNc?&w$5`Z~OQT}*,1qLYMns-efu9B0OLI4+<@(PIYj|}9F-RAO..{ew N)1<1i');
define('AUTH_SALT',        '|t|t<t-|}4mO-aE%gHTXNp9/bL9ZQk(0_MY;E,HrOXgVyF1/_$Se^mo7[ww)805F');
define('SECURE_AUTH_SALT', 'gzxwPC?Ahxy.q-8GBgT0m`**^&1tGI)Ul-u|/E*fJL?5J7H0,Oo;MVUSgK3x5m )');
define('LOGGED_IN_SALT',   '_cfK9LlrZfUBGkQ@*]@rqo_w-T8lEV4hMukifhMO7E_&rUXgI+KAzr}M-;60oUD&');
define('NONCE_SALT',       '!a&s+DQgl!#,-|UN|@d_dwR]#nfL-8_jP2JK5.]/BU-fHQ_<}&32*tF5=^%F2o3X');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

