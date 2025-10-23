<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'kXf/y2PFKPx5J1Dzd)Y6=Re[;<1v[K7#<H#z2@z;, C%WmV|#(D^~d^HY+Uy,s&1' );
define( 'SECURE_AUTH_KEY',  'FzVznL7o^D[qkvx(kV&N AZf2.xKUm$b<w4f[595r4?(FZXJUl!IQ$XRy}:4?(AM' );
define( 'LOGGED_IN_KEY',    '@fES:.lOdKVeajqvL*[?@aRJlPw)6^RiZ@fh[H0$R5L9ek#n/c e1NzcW-{nmC:R' );
define( 'NONCE_KEY',        '6Q[I9MN]1U.}u43E1g>Cvbb[r5r1W`ggVwVaY|o&(u(Hg;DiFAP>Dcy8g7)S8Ofb' );
define( 'AUTH_SALT',        '*N$d]ep`[_t*!y@[&$e?Q>1Fvhf?<RbEgu)_*<Xap$+o1?9h6wTlDA/pkHk-bUea' );
define( 'SECURE_AUTH_SALT', 'KER{G_FJ-.hWSFelfuU&XVR%pV$6C~&e@Z1fd4V_;jwFc#e$~#MIQ;v{k;g<[9vM' );
define( 'LOGGED_IN_SALT',   '#[~eMZ(:fJf@Gjlxy;:][-w+:BHZxtyf-*MpSYCnyn6G9T4UNRWyfOt@Hq$qYXce' );
define( 'NONCE_SALT',       'Zs=$QW@+1v? !UJ{9&E`_o>) l^L69#]t6G@LL&7mGB)ayeW4p4Y]^17-N2aF}qT' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
