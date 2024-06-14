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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '9!~<+bdKGOOs&Rj8R4}%`Z lZVm@q<iK2kwJJDCJPTauo>3&5={!EE~/YO9y;O/t' );
define( 'SECURE_AUTH_KEY',   ')]d?yyWNT+r`t84XmnC2gP~Q$O _49>g`1t^yaV)d_xxMackg`qQs?Q 6lHp6l};' );
define( 'LOGGED_IN_KEY',     '9[ZXhd6`V48aVxdu):QU-k?f*UiHs~68uR{EuCOl.HWhj%uJ$*.z_YQVKQ7-`DuR' );
define( 'NONCE_KEY',         '|Ce{f(^ct~`s73EPy8y{aKjWsI0 g2.SYs8o?>mkiYpL,:] 7JAmXM]:m}D*s#:x' );
define( 'AUTH_SALT',         '<XO6Km;kl.% u0I%v(C$-G9<jah0hUX!|AdOWscN}q]T7$D==92x(@oI;p$Lg>y)' );
define( 'SECURE_AUTH_SALT',  'FxRXzakcz7]jq!D&d0VM;gq,8ghzgPo~=0.N_M{<^$2L*VEUxVxqi9L~*]7];!42' );
define( 'LOGGED_IN_SALT',    'Li&4~Um;9]8]1oI$+2BzhlST0w5$%4e(pzur_1 `D:]{>6]mw4|L=k+n.JzQ[I1`' );
define( 'NONCE_SALT',        '(!(*GK@:^Enp}Ktf=pfTEN[SCUV}qcCT,RW;=8bCe=a=abVw[~Hm8OqNcN|u&Otj' );
define( 'WP_CACHE_KEY_SALT', 'm{;?^tH`rGg[=qv|Q<v$4vBBftw<U>[7Q9JVUp0v|EXbjje]{zcWG|{Sv,m{bgR1' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
