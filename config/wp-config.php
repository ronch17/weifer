<?php

foreach ($_ENV as $key => $value) {
	$capitalized = strtoupper($key);
	if (!defined($capitalized)) {
		define($capitalized, $value);
	}
}
if (!defined('WP_SITEURL')) {
    define( 'WP_SITEURL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" );
}
define( 'WP_HOME', WP_SITEURL );


define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'q+NF6_6rXTxM@?UJ' );

/** MySQL hostname */
define( 'DB_HOST', 'db:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'YY}-PTzXJITd+IP`qan#[5+}va<V=|77|-&BD`I&Rj|h:KSRsyZ45;bpOz-3S)O~' );
define( 'SECURE_AUTH_KEY', 'zl29<+? oX:^Aw.DVky{qo#/z.;H!(De0nx2+zCX#+4bZ)Y@<2bE@N&)`%|~+R%=' );
define( 'LOGGED_IN_KEY', '?~^25V,K.X@X*;Q<ar-F%[`Z%9E7o6d6eMSp$);l^w@cgzjSM0uBrSvz/Pd%{L*J' );
define( 'NONCE_KEY', '`ICp{6nz[Y:=FzBNb%tR/!X|@`DE0-a-dR@jHo.I#[X*W8*>3r4h{S*39^Uk)r?K' );
define( 'AUTH_SALT', '*&nT+(%,HT+o$}Y+BRCBZFVp@~>;bBGW2/a{+nHkj7| l_I[ 8ZZ@IhvQ0!$vJ*M' );
define( 'SECURE_AUTH_SALT', 'rmY`sa#SYh2-Pnc|d^T!0F#s+zd|Qew[zhCIKI,+7@BG>kYjNthlYQ*>jQA%K93+' );
define( 'LOGGED_IN_SALT', '0u4Rj_a0+9%)ER0PlNiKx{2QA_{GWbKRg1j]7y5|$evEXea*)7<N+8N!{0#9|(h}' );
define( 'NONCE_SALT', 'FI5zypxPgD_j@iTbdVgix805[[l~4fzJBj>.5^`C3@.j34amz8*7_SSN)|LftXr3' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
if ( isset( $_GET['dbg'] ) ) {
	error_reporting( E_ALL );
	define( 'WP_DEBUG', true );
	ini_set( "display_errors", 1 );
} else {
	error_reporting( 0 );
	define( 'WP_DEBUG', false );
	ini_set( "display_errors", 0 );
}

define('WP_CACHE', false);

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/**
 * Custom Settings
 */
define( 'DISABLE_WP_CRON', false );
define( 'DISALLOW_FILE_EDIT', true );
/**
 *  ContactForm7 - Controlling Behavior by Setting Constants
 */
define( 'WPCF7_AUTOP', false );
define( 'WPCF7_LOAD_CSS', false );
define( 'WPCF7_USE_PIPE', false );

define( 'FS_METHOD', 'direct' );

/** Polylang - Disable cache*/
define( 'PLL_CACHE_HOME_URL', false );

/** Disable automatic core updates */
define( 'wp_auto_update_core', false );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
