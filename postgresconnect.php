<?php 
	$db =  pg_connect("host = localhost port = 5432 
				dbname = postgres 
				user = postgres 
				password=12345678")
			or die ('Could not connect: ' . pg_last_error());
	return $db;
?>