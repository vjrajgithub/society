<?php
define('CURRENCY', '$');
define('WEB_URL', 'http://localhost/society/');
define('ROOT_PATH', 'C:\xampp\htdocs\society/');


define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ams_final');
$link = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die(mysql_error());mysql_select_db(DB_DATABASE, $link) or die(mysql_error());?>