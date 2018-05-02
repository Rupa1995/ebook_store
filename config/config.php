<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'tiger');
define('DB_DATABASE', 'ebooks');

define('LOGIN_TABLE', 'user_table');
define('COUNTRY', 'countries');
define('STATE','states');
define('ADDRESS','address');
define('USER_LOG', 'user_log');

define('MAIL_FROM_ADDRESS', 'no-reply@gmail.com');
define('MAIL_FROM_NAME', 'Book Services');
define('GUSER', 'pustakalaya.ebook@gmail.com'); // Mail username
define('GPWD', '509154Rup@'); 

error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 0);// 1 = Display Error
ini_set('memory_limit', '-1');
?>
