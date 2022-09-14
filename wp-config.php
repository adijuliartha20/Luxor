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
define('DB_NAME', 'luxorbali_db');

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
define('AUTH_KEY',         'D-TSxa$5V1-i=z]5[^RZv_tuGKM}1J.A8|fZhGKV^JZ)G8I#n~~`@CAT9,BU&Xj1');
define('SECURE_AUTH_KEY',  '2D+uI$2+d8BIEMPi~G O%cNY8epo$un1 <Z)kk!/kPK/no$ uC51|71ga-Epz&kr');
define('LOGGED_IN_KEY',    'DEbe[xd4u(fP/ByO3B)I}dvR52Xn~{18k+Ujb#u3+lcf`m;Lt.ZrB]!s7MG75]u_');
define('NONCE_KEY',        'n_42?vhqsX`*QX-W~XZ~)(0H{(-Yeb(v&_1/.DiBlyl1szd/RUzGS/8EXw1w[x$w');
define('AUTH_SALT',        'vWyLTb/I]v@+9833bIXZ2B, +D^,mKApgCJ5ZljoQI(M,4~]{qje=<GeU}@Tl~S]');
define('SECURE_AUTH_SALT', 'MVZ8,)|Yt+qk0(da/NU|W)m}apOEmJf^)IZSP?c$e+2$+]Yv}M@:R#&]1dDX ]MZ');
define('LOGGED_IN_SALT',   'xoKNaVd:z+%+h#e@eOf#*UWkWE=Ae#K(eVJmZ]CH&N5aF0in+F_7&~Lp05T$NMp(');
define('NONCE_SALT',       '%Pd}p,O(w}f&?kba*UkYeO[z:)474rFoO^Z/gDBQ2a7)L7Xt5j3hz`;#3l:x#we,');

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
