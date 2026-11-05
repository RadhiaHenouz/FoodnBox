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
define('DB_NAME', 'foodnboxbmfnb972');

/** MySQL database username */
define('DB_USER', 'foodnboxbmfnb972');

/** MySQL database password */
define('DB_PASSWORD', 'RomaneBaptiste05');

/** MySQL hostname */
define('DB_HOST', 'foodnboxbmfnb972.mysql.db:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
    define(‘ALLOW_UNFILTERED_UPLOADS’, true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iS59Lh0m/VTOzZLS1sDdVk/xZlMs/LXsBeQISU6TeL+YraybO17v2eR/EpWJ');
define('SECURE_AUTH_KEY',  'gn7VYvP3Vssw2Stc4CK2jQRqHNS5IIWj6LagQodMUFzFrX+aBxmnQ5joz4Q6');
define('LOGGED_IN_KEY',    'fEqX40jQcbgirT+QXw75cwq9b6bfxNHtW5uCbR2oUPgYPaq5g+RcpY4XtRoq');
define('NONCE_KEY',        'aGRzMJ0ybQU5nQbYGkBuEcDQuLH7b2m8zRvuanXc7uPTE8fyyPKseCNQ8+4Z');
define('AUTH_SALT',        'YWp2PecpAsm5EmJvgK+w7UIJaFtt0M4MdJ/u0G/PrdwmSCsgYHdmVHSg4CR8');
define('SECURE_AUTH_SALT', 'Y5QdclupY1+b7fDmRhYtqVXIQ8gXV+MMkeQufVfYvqDjRR2WLAq7ajFomy3A');
define('LOGGED_IN_SALT',   '0TMaEP582vpRV5zO76U3ylsjzTR+ehqsU98jEsyRqL4tULVV9TqpmXQOz1Pd');
define('NONCE_SALT',       'Tuo/6ULDIPu5vLmwpcN1fuDhJZCE+mkbV8UFCkg+NDK9XNu2U9S9I+lmu7yW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wor2899_';

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

/* Fixes "Add media button not working", see http://www.carnfieldwebdesign.co.uk/blog/wordpress-fix-add-media-button-not-working/ */
define('CONCATENATE_SCRIPTS', false );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
