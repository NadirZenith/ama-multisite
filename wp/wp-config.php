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
define('DB_NAME', getenv('MYSQL_DATABASE'));

/** MySQL database username */
define('DB_USER', getenv('MYSQL_USER'));
//define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', getenv('MYSQL_PASSWORD'));
//define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', getenv('MYSQL_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

// custom config
#define( 'UPLOADS', '../uploads' );
define( 'WP_POST_REVISIONS', 4 );

// multisite install (enables the Network Setup item in your Tools menu)
define( 'WP_ALLOW_MULTISITE', true );

# multisite activation (after previous install)
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', getenv('DOMAIN_CURRENT_SITE'));
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('ADMIN_COOKIE_PATH', '/');
define('COOKIEPATH', '');
define('SITECOOKIEPATH', '');
define('COOKIE_DOMAIN', $_SERVER[ 'HTTP_HOST' ]);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_gp9hwO00y37/3<47jDX!%U8f[;3TzjP~)0)m9Y{(+O#j(AB8r6A!g&Im7~6=Ajx');
define('SECURE_AUTH_KEY',  'qH}5G344+Pe @E-J.ax>BX(gP5*|WD3?3/1sC/Y+&X@r&L91.Cdo6<&A`uakU9?}');
define('LOGGED_IN_KEY',    'B4?)i>=zY6/GwU*j-)diTqkwnC/p$ch9G}eW|(+{X8D:n?o4yyHXvj-6q;.B>g!@');
define('NONCE_KEY',        '6IYpKklBc#,M]&++MtL/Bq5CAsSbSK|33BOL,LKnVUbO[0dQ?#71|<g$c?*[2c2!');
define('AUTH_SALT',        '@f;*)X_ny|f(Zv52-<!%(QwIqB,gt%y]N)|aT$I2Pv9~XWih8g?nl7A%k1UK ?e_');
define('SECURE_AUTH_SALT', 'jgB_#u7Pm7S-;Re/Q?U%ditm CU@@f:5y?#K43qfyHmg8cQ]no{Zq*pV&UD?!%.$');
define('LOGGED_IN_SALT',   'Z>> 8bNXW-Ln_U.hQpIJxJu)G;<FAlSK(`^i#3GbaP3+*t:uf.m/96@bjTZ6P{7N');
define('NONCE_SALT',       'r(W22(2-`ymV9rH+lULBO?1r5yUi-dPAz=p`O->~L#,q|66d MhkXnG]0s#`G0#/');
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
//Disable File Edits
define('DISALLOW_FILE_EDIT', false);
