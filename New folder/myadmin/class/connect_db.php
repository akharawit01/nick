<?php
	$host="localhost";
	$username="root";
	$password="";
	$db="nick";
	$link=mysql_connect($host,$username,$password);
	if(!$link) {
		die('Not connected : '.mysql_error());
	}
	mysql_select_db($db) or die(mysql_error());
	mysql_query("SET NAMES UTF8");
?>