<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/wandacoth/site/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'wandacothdb' );
/** MySQL database username */
define( 'DB_USER', 'wandacothusr' );
/** MySQL database password */
define( 'DB_PASSWORD', '2d432ac2-dc32-4d28-bfa3-a0166c125ced' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost:6306' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8_unicode_520_ci' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'U&$ P:u?bp!xr>jArwdQ_REcsD[/%Cm{xfTi66+;D $L I.2pwxeikB6L3L>}PDt' );
define( 'SECURE_AUTH_KEY',   '>{f[y$-9(:nf]Bhp$PSN>Odt%2U+9K~f-AF3eS.o2E%@+1+pu9aYv[2lI/,t+ yG' );
define( 'LOGGED_IN_KEY',     'J+DB^C<aNcag?E|tQ6@M)Y1]Kw|[6|x:4/jgSluj)X7*sdJeE$AQyy,=p)Y<ir_c' );
define( 'NONCE_KEY',         'osr4T2-2&=n5;T|V#0Hv}]A=g=G@Tn DV>:Sz/X%dp&LI)Zn/5GXE-.q%EDV=!*n' );
define( 'AUTH_SALT',         'K`_Ozv6JY$oid59>yom!BE=`LRKS<.UVZ&5|9!]#0.pL]M#-B3 $=05(;2i!/&2Q' );
define( 'SECURE_AUTH_SALT',  'VX];# )q7SudM,>{{{i2Q%58q.YW/dtiBz_qX^l62X^y}[=hg8tp.xY+wh;-b@qq' );
define( 'LOGGED_IN_SALT',    ']>!mz~*tFCe32SeVBQ@`]rxLsA,!et9sp`|WA%{Q/(iK)[hf4<sRmO*rGI#%<<@,' );
define( 'NONCE_SALT',        ')ID}4PTH/>]m)>RNF=PyTsso1PM(7Ae*sbRn~Vad>.SMg$,y)f*Qp.y*#)d1;~U:' );
define( 'WP_CACHE_KEY_SALT', 'J98v#`DUI^V}e?8rEMMAhPc/o:D}|<}X$H<qsSD1=lR*_!iJCJ W$:V/yA32qRcE' );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
