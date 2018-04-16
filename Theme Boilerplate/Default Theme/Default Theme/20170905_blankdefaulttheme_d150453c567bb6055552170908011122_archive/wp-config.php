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
define('DB_NAME', 'dafault_woo');

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

define('WP_MEMORY_LIMIT', '3000M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~C-Pkz siyy_#0wb$GWvmxE]@PUKjF&&&T+)UdDskxo{Ea^Z*&Z]KXu>WNu9&wtT');
define('SECURE_AUTH_KEY',  'HUEx7;+}d0 cuN KVgp^^X(o`;M|8WjP{cDCqu]&7{wa^1zhxQp*fYCBRW}YfIiD');
define('LOGGED_IN_KEY',    'NKmCS D[FJ};~tS-?4(Mbo!cYY&5)I.zx4/a|tT[d^:Jnj1t(-^<Ys:r;J(4D+8+');
define('NONCE_KEY',        'F.FH9m=%S(f!^n,OJI?e-pExKXwq)pWGeO|W1Vz7:+LH%WyI ,F-Z~dZO5vSe_Z{');
define('AUTH_SALT',        '5;]<aHTpOtN15xLR@)w/nPgO#o/:8>xg)un0[Kpapaq)Eh6|JDmkizZ%BI;zneeJ');
define('SECURE_AUTH_SALT', '>;9!( :yd5V{ >/e2X?[Me$RFT)~Ed+.aiHET])F[biVb9cQ@qJO=<uP<Okh>qJ/');
define('LOGGED_IN_SALT',   '=v3]mxDM}Ryg&H]C6y_joc&H>wXiEKklleVd &M+3IXcy!l3B{!)Sn!+6N#b*73r');
define('NONCE_SALT',       'a5f?-lhjS%8E.Kd]n%av-;oak.-rz!u@zm)NQ*mNIL!GcH+SVVFBc_SE=6^[N[d0');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'df_';

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
