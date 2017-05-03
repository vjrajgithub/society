<?php
define('CURRENCY', '$');
define('WEB_URL', 'http://crosslimits.co.in/society/');
define('ROOT_PATH', '/home/wishzkch/public_html/crosslimits.co.in/society/');


define('DB_HOSTNAME', 'crosslimits.co.in');
define('DB_USERNAME', 'wishzkch_society');
define('DB_PASSWORD', 'Society@123!');
define('DB_DATABASE', 'wishzkch_society');
$link = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD) or die(mysql_error());mysql_select_db(DB_DATABASE, $link) or die(mysql_error());?>