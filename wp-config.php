<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'articlesv2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '@d0bku!}L^~j4A[J &[av]rB%qB{y{R*_+H=S9z,JRvzv@)Pjf6IO88MnyqKS>$9');
define('SECURE_AUTH_KEY',  ')8Hv2e.ASI)8b?*7Oj(y{sd4?u791Z{q@^k,irXdxEkN6zT,z^^>PA^m[ik9*Gp(');
define('LOGGED_IN_KEY',    '%>f:R3m@ht ;*YF3:]f-6c0r1TqbgN:Y+wT%Ud W-XybQIvl5A 3px9 G0>*K0hI');
define('NONCE_KEY',        '*0FD2.y ^eHKx_,]W#Rzk?K9#G:vCZ>dP]J.#&OWs8k?IITtAV*(51;288j{/_7r');
define('AUTH_SALT',        'V{C|Bm-Q>.m^V,yM/M>OU!#M_isHO${H@!(h^i0~AD%2_2l^<(.cU@.<I=,3D0*J');
define('SECURE_AUTH_SALT', 'v,z-#N=+gkm?:*J2gB.A2_.^}>a<5.~o&*C{f;u2&YR1x&PD3n2nQAEMx(UfkezJ');
define('LOGGED_IN_SALT',   '}G;;ZOI+S`?t_JvGXK knqfiF?8wvrV,84{kV^g4qnwT}mnNX{[d]X_M*C5-$8d/');
define('NONCE_SALT',       '`fouRSPan.N<,UC :-jaBO/AG23WL4fD|n.~t %4+l;+v:#B#!JC%3I5H7]~]H7c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
