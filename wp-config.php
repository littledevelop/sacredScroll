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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sacredscrolls_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'KF,:3@(FdL %Nd#|Xzt-+1WvosdTi$/Rp,*`^(QQ =1YUv~DW-0Al%VSi0BNL-ZY' );
define( 'SECURE_AUTH_KEY',  ',sPc>I@@EDFQ?*f09L!{-:e>-KMYH%%(PPBH*qOWG(fSCsyO5(3#wcD[SF}hhdZ8' );
define( 'LOGGED_IN_KEY',    'KJqN7lACeq-&rC&lJ9n*Z[)Hq=tmqNzB#$ (@iFZT_^1jF5n]a_rA`>WrvD:vkA)' );
define( 'NONCE_KEY',        'Ay{e/F&L}jp=X[BjX!S7OH#vu+A#.*=c?Y<%+n,3WB>PK^y*n0 [9,vDEGR_a2p5' );
define( 'AUTH_SALT',        '*>S!Y2lf.?)$Svj^=(]JTB=!Hsg.~}Tj-UJk&v;yvd-.g+>/7NJF)$ji1o)iBj*m' );
define( 'SECURE_AUTH_SALT', 'O85t:IYK~U=P]))bAVk=ceoeO.kvw[7^PTp{>17b=cy(=VH58V90K5M=euBk>-A>' );
define( 'LOGGED_IN_SALT',   't,0&{XFAZ[H+*:u8N[J6&d!`U&;&k;tJBODaO^Q;9t Y9da<z?p]S1j]%kGL,6lq' );
define( 'NONCE_SALT',       'ePB/5v27r.;{,;*NexZyQ*M687sTyLt_SLtzR2W,+*a|P%IO@^b[p4WzzB`Q=KH9' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
