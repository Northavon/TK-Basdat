<?php
	include('config.php');
	session_start();
	$username = $_POST['username'];
	$query = pg_query("SELECT * FROM AKUN WHERE username = '$username'");
	$result = pg_fetch_row($query);
	if(empty($result)) {
		echo true;
	} else {
		echo false;
}
?>