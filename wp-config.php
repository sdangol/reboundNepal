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
define('DB_NAME', 'reboundNepal');

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
define('AUTH_KEY',         'U*5Ayinyf%MBX[;O5. deTKIeRo]83XBqGIE[d.fYzNO!CdcpD`j%4Ov8Me|7,Gu');
define('SECURE_AUTH_KEY',  'FL9?UJN}W:+a% 6;wO/3K8 ,$>_ej<-O8g<<,1M0|Pi?6PuF*^_A W>i+[_aFRu5');
define('LOGGED_IN_KEY',    'j6>ef/l>XA9Lee2xU*!<P/7{GOx/k4d92pmIc$~E%Q#/]8&6L!fxPT9+@)z?dS<G');
define('NONCE_KEY',        'u0Nsvn=jbv4#M1KD*^PNz(`lb@nWksXw2]iwq}a>)Mi.sG+dY*NsrCsW{W ]4zyv');
define('AUTH_SALT',        '2eHM>$QJ0N.M-T8-1N5kaw.0?8gaLM3&xJ=mer-;*DX=b?cjqsFW6KU#5e0E99,f');
define('SECURE_AUTH_SALT', 'D2#Z~e2MLg9R0~XZ(%)1q*IG=r(h}B/=E%e/X1/{dKjXLymvq+FC)4+SNgy>GPdG');
define('LOGGED_IN_SALT',   'ECOQ7z1tlh]~c:@0^9QV!tMb8lGM6|C,$pmaF^?:U98ee7JVa~)?=PqPsfh,G$ds');
define('NONCE_SALT',       'v6_Lz;yx{<rK1l`U| f%h%6mr_eF*k:KVWIx/udfwj{esR`5mn^@Ia!<^P0`!{d6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rbnd_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
