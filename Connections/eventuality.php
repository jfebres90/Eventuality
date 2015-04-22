<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_eventuality = "localhost";
$database_eventuality = "eventuality";
$username_eventuality = "root";
$password_eventuality = "password";
$eventuality = mysql_connect($hostname_eventuality, $username_eventuality, $password_eventuality) or trigger_error(mysql_error(),E_USER_ERROR); 
?>