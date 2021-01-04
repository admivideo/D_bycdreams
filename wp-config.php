<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
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
define('DB_NAME', 'D_ByC_BBDD');

/** MySQL database username */
define('DB_USER', 'D_userbycwpBBDD');

/** MySQL database password */
define('DB_PASSWORD', 'D_oOIkZpt@SUgTTFY$BBDD');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
define('AUTH_KEY',       'WqM7zy9V4w#GJPO#vGh3oQE&uI*4NyfwU#AQ&^KcdWe(dI%3%8*WalgKRBJ!81KR');
define('SECURE_AUTH_KEY',       'SNUJ#)7vEb6G1PfzaIPunODSc9lZN(ob3R1CUBgGSwq18MKjJ5iIl1JFT5n2xDSO');
define('LOGGED_IN_KEY',       '%j6!0m5O19GEViuDLcPmCRCkZY&suEoj)ePgJae#Y&bALS1e@l6aQaFeYi#6)Z^Z');
define('NONCE_KEY',       'p0pL^TiCxH&k*S4r#lVcldCV1zimWXh9B2e)lc2ZoCjg7Y%)ipHpno7%hTi*(kZt');
define('AUTH_SALT',       'YrmnICaSnShK4JCH8a#JS&RMIyClsRNSR!3SbpV3aBZ33r3%Gy6CsdBAx(Ge!eL9');
define('SECURE_AUTH_SALT',       '^DqUqAFVaB2gVoE((kSfslP*E&fJ@5l(GQER(IHec@LgKdU3KpL*x^1qp!shNA!7');
define('LOGGED_IN_SALT',       'YzGp#dv8!7WbNLmsB0*ljYwVJb4#xUlYb^o26wdO1kWI)a^FZWdjGu&M(9rkfTgG');
define('NONCE_SALT',       'as8dwt2N9HN5prYkmMidIW4NouRRugEfPVmBK8S@08aW&qX!iqIeCDU&l^uVgPV)');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'byc_wp_';

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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
