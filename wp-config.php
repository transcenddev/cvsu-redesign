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
define( 'DB_NAME', 'cvsu_db' );

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
define( 'AUTH_KEY',         '>#|e=^h35s!wLI|qQ&z%R?4pXTVS(|eDhaih;iQg~4owK?qBvj+K;rL{0-Ejd}#&' );
define( 'SECURE_AUTH_KEY',  '!n-xw~q WHXiaWbPgj}e1IADrJ0lb$^vLLZUpJ`V>m6?ff_SD$);~<$uncSawU&&' );
define( 'LOGGED_IN_KEY',    'V:B03`+Sp>s&LVODkujnbp#r-^#;p4sF+5)*rQww#1}!$IS`WSnh-Jdjqut&`3ih' );
define( 'NONCE_KEY',        '/)B&Eu2=0=Yc(kp}O<aUA k_cEUfj]P$siJ*XiJE(AjBa*h(w~q:)LXrP2D^ft?&' );
define( 'AUTH_SALT',        '7UciB/@n;lp-fKW*xCtta(z^Ovw$F%CBQDRu$KtA(&^jQB%[yRV0|2U,)ANxXX8&' );
define( 'SECURE_AUTH_SALT', '<$v:A5}G<2V[1WK4Hh^?h^Q^R)|zJS:Nwl4w`k:AKS~>PfZ__!r1QM<6eB`EMUV!' );
define( 'LOGGED_IN_SALT',   'r6>(0#K]*c_iCRkp+u.S{yhoR3bke (A3@]&dvc_{P~kjcCO s+jD+00S9K8HJmt' );
define( 'NONCE_SALT',       'A`H~X>^4eACk#^T&y-842%LIEG{h%~+>_IF]Z m=A0^jat`cA}.1<i2Gi;~rqor6' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
