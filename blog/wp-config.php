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

define( 'DB_NAME', 'u733794648_theiotblogwp' );



/** Database username */

define( 'DB_USER', 'u733794648_iotbloguserr' );



/** Database password */

define( 'DB_PASSWORD', 'iotBlogwordprs@#123' );



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

define('AUTH_KEY',         '=@Q_b8-FF&<Or6cDRti{%a$-GtM-f%-OoLx+L74-JJS)aela9Twbc$4p|y%?M5om');

define('SECURE_AUTH_KEY',  's:-X?NRyN;+ZGWAP&ar9sxj4ec9@tJD+,_rMc-0rI,`$aJsx+SHc0*_eDG|F/b&x');

define('LOGGED_IN_KEY',    'njVo a.Dm`$Ixr,b*#U>H[kfL8qe|v0wM0N67[KmsU)H|rn$;G-O#t?|mL4fHwa,');

define('NONCE_KEY',        'zSNhd.f|9XlA|ci}U3TJETh200S|?H!0co/cQu=]+Y-5OD3?)pPvV>:~x{jT~i~j');

define('AUTH_SALT',        'z+jtlYoOscd-35VRiP4$,/a,_`<w01B)qrD1pjg3_&kBtH5)nwA~sG<suPw[-/vt');

define('SECURE_AUTH_SALT', 'C2ir0HwL6/}G`:8X!^0c++mGuG=,&[dIXt6VwSRx=lOcKN]tKKB._^f~H]lB0nxM');

define('LOGGED_IN_SALT',   'XDnPrmwzEV>{D>hh!nH ,:9|O@hcqV._ywVC6V>%jG~*;ug5_=uY@lR?r>:}Uw+s');

define('NONCE_SALT',       ' 3kAL$|s5__F|bqYty=32A%p!^R#qQ+V?IxZ7x}yW/T^XwD/$,j6kKC| O1;-6nv');



/**#@-*/



/**

* WordPress database table prefix.

*

* You can have multiple installations in one database if you give each

* a unique prefix. Only numbers, letters, and underscores please!

*/

define( 'DISALLOW_FILE_EDIT', false ); // Added by Defender
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

* @link https://wordpress.org/documentation/article/debugging-in-wordpress/

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

