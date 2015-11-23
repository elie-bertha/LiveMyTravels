<?php 
	$connection = mysql_connect('localhost', '.','.') or die(mysql_error()); //Connect to server
	// /!\ DEPRECATED /!\
	mysql_select_db("LiveMyTravels") or die(mysql_error()); //Connect to database
?>
