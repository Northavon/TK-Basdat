<?php
    $servername = "localhost";
	$portnum = "5432";
	$dbname = "postgres";
	$username = "postgres";
	$password = "asdf";
	
	$link = pg_connect("host=$servername port=$portnum dbname=$dbname user=$username password=$password");
	pg_query("SET search_path to SIRIMA");
?>