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
define( 'DB_NAME', 'blossom' );

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
define( 'AUTH_KEY',         'JEGK7)jK68B[EA==f-_0-FKk4nV7-pB^rY#?Iv3T_vnx0lj7$7*/>iU=C8e2?hNs' );
define( 'SECURE_AUTH_KEY',  'q/T> KSlDCZqd(sOhc3$D{+xoc}ZSg3fb&oOFbU@u]HvXM~if?Sb:eu1p mfpChV' );
define( 'LOGGED_IN_KEY',    '=ygW;F71]yvM=1z+h^EEKQzh>B>q{C%&@ow{<txvkKRc*f-63w[a#5c8 a6gxX%K' );
define( 'NONCE_KEY',        ')Ad>*05QZI/Qqoe-m}NE5Yi]U ?w<V*w.6~ja)z@AkT/#Qp6KG2BiepGlWpWYXm-' );
define( 'AUTH_SALT',        '+J@JQm3=YHy_jv&z.,~0.q&XRzBaOqBD[/hWNwM<h[UY2[]mg0MsKeGZ#ilYJCUI' );
define( 'SECURE_AUTH_SALT', '#!ZXV>O)^4#bFkH}r/$O}IR^i_]2$Tf+b[.*NtEdN+T#c3JbL=atVqZf~y<)2k*E' );
define( 'LOGGED_IN_SALT',   '7P/ZX^/?z-,.{%{z?^Ymd,~[_MogE_Dc~Mm5O_X[k4CKaNB50CQV}E}t~AQg_%~M' );
define( 'NONCE_SALT',       'MwTGk)tfu~o$tZ)8&6(>72T(t|zxMd/ Bor@?@2zy/[y}UHW<EsNob=gDnMv6{h{' );

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
