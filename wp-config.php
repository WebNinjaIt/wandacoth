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


//Using environment variables for DB connection information

// ** Database settings - You can get this info from your web host ** //
$connectstr_dbhost = getenv('DATABASE_HOST');
$connectstr_dbname = getenv('DATABASE_NAME');
$connectstr_dbusername = getenv('DATABASE_USERNAME');
$connectstr_dbpassword = getenv('DATABASE_PASSWORD');

/** The name of the database for WordPress */
define('DB_NAME', $connectstr_dbname);

/** MySQL database username */
define('DB_USER', $connectstr_dbusername);

/** MySQL database password */
define('DB_PASSWORD',$connectstr_dbpassword);

/** MySQL hostname */
define('DB_HOST', $connectstr_dbhost);

define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/site/wwwroot/wp-content/plugins/wp-super-cache/' );

// define( 'DB_NAME', 'wandacothdb' );
/** MySQL database username */
// define( 'DB_USER', 'wemysqlserver' );
/** MySQL database password */
// define( 'DB_PASSWORD', '89080f43-2c20-459d-b6d6-ea92ad115d1a' );
/** MySQL hostname */
// define( 'DB_HOST', 'we-mysql-server.mysql.database.azure.com:3306' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8_unicode_520_ci' );

/** Enabling support for connecting external MYSQL over SSL*/
$mysql_sslconnect = (getenv('DB_SSL_CONNECTION')) ? getenv('DB_SSL_CONNECTION') : 'true';
if (strtolower($mysql_sslconnect) != 'false' && !is_numeric(strpos($connectstr_dbhost, "127.0.0.1")) && !is_numeric(strpos(strtolower($connectstr_dbhost), "localhost"))) {
        define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
}

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

define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy blogging. */
/**https://developer.wordpress.org/reference/functions/is_ssl/ */
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        $_SERVER['HTTPS'] = 'on';

$http_protocol='http://';
if (!preg_match("/^localhost(:[0-9])*/", $_SERVER['HTTP_HOST']) && !preg_match("/^127\.0\.0\.1(:[0-9])*/", $_SERVER['HTTP_HOST'])) {
        $http_protocol='https://';
}

//Relative URLs for swapping across app service deployment slots
define('WP_HOME', $http_protocol . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', $http_protocol . $_SERVER['HTTP_HOST']);
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST']);

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';