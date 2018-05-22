<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'tiger');
define('DB_DATABASE', 'ebooks');

define('PAGINATION_COUNT', '20');

define('LOGIN_TABLE', 'user_table');
define('COUNTRY', 'countries');
define('STATE','states');
define('ADDRESS','address');
define('USER_LOG', 'user_log');
define('BOOK','book_table');
define('AUTHOR','author_table ');
define('PUBLISHER', 'pub_info');
define('BOOK_CAT','book_cat');
define('BOOK_LOG','book_table_log');
define('CAT_LOG','book_cat_log');
define('AUTHOR_LOG','author_table_log');
define('PUB_LOG','pub_table_log');
define('CART','book_cart');
define('WISHLIST','book_wish');

define('MAIL_FROM_ADDRESS', 'no-reply@gmail.com');
define('MAIL_FROM_NAME', 'Book Services');
define('GUSER', 'pustakalaya.ebook@gmail.com'); 
define('GPWD', '509154Rup@'); 


/* Paypal payment module config info */
define('ENCRYPT_KEY', 'ebook-data(en/de)crypt');
define('TAXPER', '5');
define('DISCOUNTPER', '2');

define('EMAIL_TEMPLATE_HEADER','<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style="width:100%;background:#F2F2F2;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#404D5E;overflow:hidden;line-height:18px;">
<div style="width:570px;margin:15px 15px;background:#fff;padding:15px;border:solid 1px #EDEDED;overflow:hidden;">
<div style="overflow:hidden;border-bottom:solid 1px #E0E0E0;padding-bottom:15px;margin-bottom:15px;">
<div style="width:50%;float:left;overflow:hidden;">
<img src="https://i.pinimg.com/originals/c4/fc/3d/c4fc3d8aaf399bdfcd7eb9c8deb319dd.jpg" width="50" height="50"  /></div>
<div style="width:50%;float:left;overflow:hidden;">
</div>
</div>');
define('EMAIL_TEMPLATE_FOOTER','<br>
<p style="color:#828282;margin:0;"><i><br>This notification was automatically generated. Please do not reply to this mail.</i></p>
</div>
</div>
</div>
</body>
</html>');

error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 0);// 1 = Display Error
ini_set('memory_limit', '-1');
?>
