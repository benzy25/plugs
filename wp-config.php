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
define('DB_NAME', 'benz');
# define('DB_NAME', 'redsdesi_wordpress170');

/** MySQL database username */
define('DB_USER', 'root');
# define('DB_USER', 'redsdesi_word170');

/** MySQL database password */
define('DB_PASSWORD', 'root');
# define('DB_PASSWORD', 'c8Dh389%##dhjf0@!4h');

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
define('AUTH_KEY',         'z6M.00MsY.m&c/8q@R{HBmdR8G@xW}sS+U546htNKmG#~-jEi|C(;#wxCm9w%3O^');
define('SECURE_AUTH_KEY',  '.JZAmqP!2*c;-D4VTz2,^.jW|LSPf<aBq|_Y_-F1wnk]:)rZ+YuD%+mSDPxzto*}');
define('LOGGED_IN_KEY',    'lgn!<?w#ZF?wa^!7l=i&?O`EhL4Z[8N!vDQO[i0_be8-kRbAKjM@IEiVixOH-nyY');
define('NONCE_KEY',        '/^1c85lUt]1}-$A[[/fU!*;zzLjM;?8!cB-zf=+c|j!;?kb=vjyK~h^hD)Nq]:Gg');
define('AUTH_SALT',        ',$A*Lu*Y)atADa_aVYzyX#0JM2KH-E2L[xfKhl5u]X!,/Icqrdt-:=fR&+jUkH2`');
define('SECURE_AUTH_SALT', 'UT-||/ajr<8aCv`1^`FiYKP;gbzNdsWjw&NqEnlp;1m|VB5=A</4EX{R]Di&h}d#');
define('LOGGED_IN_SALT',   'YD1M*9U{h:,z0Q9jjT`1kz+k__rp>V|V_KbKC))5Na!kl|s_shHzfxiz#$dK}F%H');
define('NONCE_SALT',       '`u+4Or2zddP`nLx8j=|=y%HXZ=`u!cw8Wyz20-mQ -PYDPR,Gyl`z+m6~b(yJ^uL');

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

// debugging error log display in browser
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);
