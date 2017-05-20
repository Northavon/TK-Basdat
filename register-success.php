<?php
    include('config.php');
    session_start();
     if(isset($_SESSION['username'])){
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SIRIMA - Masuk ke SIRIMA</title>
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="sticky-footer-navbar.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <!--Core Style CSS-->
        <link href="assets/css/style.css" rel="stylesheet">
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="index.php">Sistem Informasi Penerimaan Mahasiswa</a> </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
					<li> <a href="login.php">Sign In</a> </li>
                    <li class="active"> <a href="register.php">Sign Up</a> </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
        <div class="container">
         	<div class="regist-success-group">
				<h1>Registrasi sukses dilakukan</h1>
				<h2>Klik di <a href="login.php">sini</a> untuk melanjutkan</h2>
			</div>
        </div>
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/validation.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>