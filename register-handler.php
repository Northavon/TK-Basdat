<?php
	include('config.php');
	session_start();
	if(isset($_SESSION['username'])){
		header("Location:index.php");
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$id_num = $_POST['no-id'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];
	$address = $_POST['address'];
	$email = $_POST['email'];

	$data_pelamar = [
		"username" => $username,
		"nama_lengkap" => $name,
		"alamat" => $address,
		"jenis_kelamin" => $gender,
		"tanggal_lahir" => $birthdate,
		"no_ktp" => $id_num,
		"email" => $email
	];
	$res_akun = pg_query($link, "INSERT INTO AKUN (username,role,password) VALUES ('$username','FALSE','$password');");
		
	if (!$res_akun) {
		echo "failed to insert to akun";
	}

	$res_pelamar = pg_query($link, "INSERT INTO PELAMAR (username,nama_lengkap,alamat,jenis_kelamin,tanggal_lahir,no_ktp,email) VALUES ('$username','$name','$address','$gender','$birthdate','$id_num','$email');");

	if (!res_pelamar) {
		echo "failed to insert to pelamar";
	} else {
		header("Location:register-success.php");
	}
?>