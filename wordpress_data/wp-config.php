<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

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

define( 'DB_PASSWORD', 'password' );


/** Database hostname */

define( 'DB_HOST', 'mariadb:3306' );


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

define( 'AUTH_KEY',         '3[#^TwOg((W6YK,Y415&qGKmV/<)#3:z_os4d;dkD%*l Nqx%;l|k$]ykL)94hqc' );

define( 'SECURE_AUTH_KEY',  'M}`6m*,jEf^u+,e85C$eZX50]@o<Au#o+?K^|^JrFZdU;>l<_~j28eHp#)6z8SF2' );

define( 'LOGGED_IN_KEY',    'TYE0S$-5(cV) jtJnD;`1ExD_|^mk;a8]rC<EGf7CxH.4qmO ~~`C7Dy:hATNiQ)' );

define( 'NONCE_KEY',        'y&1y`mvDl+J>K(#7m7T@:+h|;ge4y@`V&/O]l{Y:?Ejhv0+dvsYlplY8ySp#@m{x' );

define( 'AUTH_SALT',        'IPR`^%z@(E5wj2Fogt3g,E00vR{|GZjIx06k-_-Mkf/=Mv.Q7FYiEoDc;{Y8Dwe2' );

define( 'SECURE_AUTH_SALT', '[Utk$=<pXD27/I]=ijZcZnrfdg~Zk)&8CzXXaE(][k5K~h+JF>.!*7;9wU[Q{FII' );

define( 'LOGGED_IN_SALT',   '&70XftyWZV_-A~ZrIGAwP-N2`HbYug&slk_4+3c1PRllQLIehfv1_G{C-rVKaN!<' );

define( 'NONCE_SALT',       'X}UB;Fi^DKX$ADi6gNlc(C/An1|*l]dFhuZ9~f6v}}#~zHQODm*uG3BH:UwU 20l' );


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
define( 'WP_AUTO_UPDATE_CORE', false );
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
