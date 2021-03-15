<?php
define('WP_AUTO_UPDATE_CORE', 'minor');
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gosh6652_wp' );

/** MySQL database username */
define( 'DB_USER', 'gosh6652_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', '7526-3p)5S' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'nxhy6zahwf2fjugmdu8vhdukabftguu5k3hntu18rfokfav1h1uxqq4vz64td4hr' );
define( 'SECURE_AUTH_KEY',  '593irxpsach2wiap8ac2xnd5lutoxvoadcaowqncxjjchj4o2jtpbkmf5xjrb0s7' );
define( 'LOGGED_IN_KEY',    'r3d2u3uc1zafccjn6gyabzymxybikquceuqwkhvcfcczpjoylwabgtajw08nm3mb' );
define( 'NONCE_KEY',        'y3xf5keemodxw5kebrfzzofeclkxhinvvsxp8xp2foqpe2z678jnx0cn9ytqlgf8' );
define( 'AUTH_SALT',        'jiv0skfzbya3wey0ncwmabr5xhnl5elylfyzh58ypnf2acps7fkeazcuncksht9j' );
define( 'SECURE_AUTH_SALT', 'pn6n5abjpqftqcjhkpsrlaypmp7v3ge7gacx03oejwnko90vherjur2qwynhyvjb' );
define( 'LOGGED_IN_SALT',   'tjhsbjiftticck4kuovhekpmqzxtuwezxzqyps9ub3smgkmrqowrpjdvopxktqzy' );
define( 'NONCE_SALT',       '8a5it64t7kz5eyfsm1smhkglejya9xzubq7gkl0gzxssi3its6kqfmdt5jrvhn4q' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
