<?php //顆顆
$link = mysql_connect('localhost','root',''); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

if (!mysql_select_db("account",$link)) { 
	die('Could not connect to DB: ' . mysql_error()); 
} 
mysql_query("SET NAMES 'utf8'",$link);
/*
mysql_query("SET NAMES utf8",$link); 
mysql_query("SET CHARACTER_SET_CLIENT=utf8",$link); 
mysql_query("SET CHARACTER_SET_RESULTS=utf8",$link);  
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");*/
?> 