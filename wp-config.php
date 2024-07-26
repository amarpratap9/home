<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'bn_wordpress' );

/** Database password */
define( 'DB_PASSWORD', '1a7b75c7689830b27d39b9fd14cae2b513ea7c560011d802789cac640e11360d' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2%Q42?yO?Ka^Hv4p!LJiOX.}3,FaXvNe]jK (/SJy=X3;=5o3-?#<%ICjYVAR;WS' );
define( 'SECURE_AUTH_KEY',  '=iOb&1/=XIj-=t&sC`CfXd,?Ph*zlk&u0*@Ffo<! .Ce#Y-XK+MKYt,TjN~95;x*' );
define( 'LOGGED_IN_KEY',    '{ZmL5heu1s]mnRUpO{3qbZ6dbf}!DeVNWN#O0Cgke4^27yk=>?`|8~qwLVDj L]g' );
define( 'NONCE_KEY',        '?}<h&G#)TnOLd>t$hV`H|:?&M/$$e|@,utX:Z4Bp+a0E0w;.b/(n3Uzh+}`zh~An' );
define( 'AUTH_SALT',        'Xj>4g,&zVtHm [Q0t6wP]?/{w<2J!plf{#0SBw} 3BybG~;NqQe)vWFb;l2eWL!<' );
define( 'SECURE_AUTH_SALT', 'N8<1BL%uUA#]+,%L3V>cITS]@F*WTYpkRNX[q3R6M=*_v[(DgQZwJ5O.IS(j6q+K' );
define( 'LOGGED_IN_SALT',   '=J*f`^u1V93bLil $1=|=xhxfVN5m#8-5}Q.a_v*+sib<Z(l0kO3yab@?larCsTK' );
define( 'NONCE_SALT',       '0M8?ZQ#XryO5VcjUw;sMupS<%>,}rJnnNV2<:$q2a5<,g?is$v_aWCU1+kx11.ed' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
