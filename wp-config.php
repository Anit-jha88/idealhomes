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
define( 'DB_NAME', 'mkstecfw_idealhomes' );

/** Database username */
define( 'DB_USER', 'mkstecfw_idealhomes' );

/** Database password */
define( 'DB_PASSWORD', '^u5nE6LwaB7z' );

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
define( 'AUTH_KEY',         'G1q(R6P(1GMa%X:;ZA*s)(TQpyG OtTA<iSsz7RBoyZ$,!<|,% g*kdqbNm9TeeY' );
define( 'SECURE_AUTH_KEY',  '/bw65q%^v867z]iuY|}(rVM%o)g@BTf1tsy#(&d{$x]N,acq_Q!J{A.k;/BVmF19' );
define( 'LOGGED_IN_KEY',    '8O$m|$c8&O9exu^{yO_bfA10d8z9{7RH=2kY(R<b;Zb+(ne*`]L]0D=C}JV9Vag@' );
define( 'NONCE_KEY',        'zom7-[dZ?RvTHsvj0s}Qb]P$nDxT]vY=Hs[n5mPu;~-gu*@_=:~GgIjP-)58%;L)' );
define( 'AUTH_SALT',        '4%s,p!8Q}rW1^/Pxs$.Ru[Jvs9^2L,(xj5+v}OrGRln[A4g~mNTSi)sBndYS8x(~' );
define( 'SECURE_AUTH_SALT', 'qRAYGMT{j71b{{cN?faN2bno)MAl:?BR~L`UD]Bs,`o<]~/fw`YKJmzelm:Y+j-$' );
define( 'LOGGED_IN_SALT',   'v[+~(>,rn}!lRIRd,k|Xzo/+xp5*9P5$noIn{j `z}&%^W~?1spzs5gx(T]W4? 0' );
define( 'NONCE_SALT',       '~#p7xp`3%2|HwIT!iHcw4qY(H{;5<f5rV?nEMg_]GO@*K_Q;XcxaJ(dyEfI?[h)R' );

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
$table_prefix = 'ide_';

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
