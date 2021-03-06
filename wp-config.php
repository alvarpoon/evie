<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

switch ($_SERVER['SERVER_NAME']) {

	case "local.evie.com":
		define('DB_NAME', 'evie');
		define('WP_SITEURL',  'http://local.evie.com' );
    	define('WP_HOME', 'http://local.evie.com' );
		define('DB_USER', 'root');
		define('DB_PASSWORD', 'root');
		define('DB_HOST', 'localhost');

	case "evie.nowwhat.hk":
		define('DB_NAME', 'nowwhat_evie');
		define('WP_SITEURL',  'http://evie.nowwhat.hk' );
    	define('WP_HOME', 'http://evie.nowwhat.hk' );
		define('DB_USER', 'nowwhat');
		define('DB_PASSWORD', '20273214');
		define('DB_HOST', 'localhost');

	case "www.eviebeaute.com":
		define('DB_NAME', 'evi10000_evie');
		define('WP_SITEURL',  'http://www.eviebeaute.com' );
    	define('WP_HOME', 'http://www.eviebeaute.com' );
		define('DB_USER', 'evi10000_evie');
		define('DB_PASSWORD', 'a7itwkpgwk');
		define('DB_HOST', 'localhost');

	case "local.evie-test.com":
		define('DB_NAME', 'evie_test');
		define('WP_SITEURL',  'http://local.evie-test.com' );
    	define('WP_HOME', 'http://local.evie-test.com' );
		define('DB_USER', 'root');
		define('DB_PASSWORD', 'root');
		define('DB_HOST', 'localhost');
}

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
define('AUTH_KEY',         '&,WcF6T;Ne4+NQ$,W4|+ZI5-{Bg0W0x)wXw+B.y  CM*h.nob4tc#s>17/+.&Y1w');
define('SECURE_AUTH_KEY',  '=b)Lx|`/_)Sk?}Abz*qE+*-jz<SsoW*HrEQE6A>=7i&KoyB(oI1,TUUs/.WrJNm;');
define('LOGGED_IN_KEY',    'Zm:-mP!z 0nL2ede<.D@lVAMZ+ROzWW%Z%T22K)jZ=PTbFiMnWL+=mFp_$i&D3=Y');
define('NONCE_KEY',        '8%:33D`Bum| 2-/r|c;W DxZuAGv*$JEGTRI}nl*~A<I`/Zv?b12Y3U^*%8J]^+w');
define('AUTH_SALT',        'e_Y]>aTj~J%?[te~s,?65T,y-DU[Dc:ZVu|(2CP:/a?=,@l]TXGp7m*ZPhnXXZ o');
define('SECURE_AUTH_SALT', '.JVt`<48hpU7[MLl27Q3UTtuyDx{t2i!uOv6As0b+6|t-URZEsqoT|${.u&yuAqZ');
define('LOGGED_IN_SALT',   'jT6tt(<_82|b0oz:cqJikDV}.8#$@1Y:>ik0=Y.Z|:d0g;Zo+g79JY|N#cX}9,O0');
define('NONCE_SALT',       '2eb2Mfzwa0bgDNmilWr}d>rngpZU][.F(71y.|0q)I9p*r+o=T.bDG5&@d5v?J_G');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'evie_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
/*ini_set('log_errors','On');
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);*/

define('WP_ENV', 'development');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
