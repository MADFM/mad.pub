<?php

$user = '';
$password = '';
$host = 'localhost';
$dbase = '';

$link = mysql_connect($host, $user, $password) or die('connection error');
mysql_query("SET NAMES UTF8");
mysql_select_db($dbase) or die('db choosing error');




//mysql_close($link);

?>