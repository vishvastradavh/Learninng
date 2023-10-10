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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpbtq_scmyuga' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'zouacixevkerdysglxuoztec7trc9jdnw1rniyluhogkjpot6l1zeikoxdeak9dh' );
define( 'SECURE_AUTH_KEY',  'rzbcqvgcxlwq7iyf9rqok8t5tlorv5tswcpbnko93uknjfnqcxxdvqxbygylku1m' );
define( 'LOGGED_IN_KEY',    'xyopohppu1cuxeyjmipvj1n4ds3zpso3its29xjp6c3rmsxojw3wncnjvo6xrqct' );
define( 'NONCE_KEY',        'f6npyiiger6evaotpebjgri43x7uhqenh9lkp9qto1rdxplhmm1gfg5testzynyf' );
define( 'AUTH_SALT',        'eyfimnsambrdlrhv3k0a8b3z2nkoamxh7xnqbe2ew6aweha3djbu5kifb1o0vppm' );
define( 'SECURE_AUTH_SALT', 'clkhmzn9xxdruso1adizd9nwgcz3n55r7fcztmotsefo7wkisa41yktv6w6z81yu' );
define( 'LOGGED_IN_SALT',   'wrlenau7fli0rqkp1ebo8fyhsn2aty6li5nvgdr8x2d2ysczvlaiqvbwggh0myis' );
define( 'NONCE_SALT',       'pg1lj9gcjmuetl5nssl49cwtz1ioud1krr8t7ormyavllnj48ndrytxotoir4jx9' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sy_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
