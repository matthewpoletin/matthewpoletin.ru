<?php
$host="localhost";
$db_name="h5162_swopabook";
$db_login="h5162_root";
$db_pass="root";

$db=mysql_connect("$host","$db_login","$db_pass"); 
if (!$db)
{
	exit(mysql_error());
}
else
{
	mysql_query("SET NAMES 'utf8';"); 
	mysql_query("SET CHARACTER SET 'utf8';"); 
	mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
	mysql_select_db("$db_name",$db);
	$db_connection="online";
}
?>