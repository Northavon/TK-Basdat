<?php
    include('config.php');
    session_start();
	unset($_SESSION['auth-error']);
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
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 register-group">
                    <div class="panel-heading">
                        <h1>Form Pendaftaran Pelamar</h1>
                    </div>
                    <div class="panel-body">
                        <form action="register-handler.php" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input class="form-control underline-input" type="text" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control underline-input" type="password" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Ulangi Password:</label>
                                <input class="form-control underline-input" type="password" id="confirm-password" name="confirm-password" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Lengkap:</label>
                                <input class="form-control underline-input" type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="no-id">Nomor Identitas:</label>
                                <input class="form-control underline-input" type="text" id="no-id" name="no-id" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin:</label>
                                <select class="form-control form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Salah Satu:</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir:</label>
                                <input class="form-control underline-input" type="date" id="birthdate" name="birthdate" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Alamat:</label>
                                <input class="form-control underline-input" type="text" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Alamat Email:</label>
                                <input class="form-control underline-input" type="text" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Konfirmasi Email:</label>
                                <input class="form-control underline-input" type="text" id="confirm-email" name="confirm-email" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
		
		<footer class="footer">
			<div class="col-md-12">
				<h1>Copyright © 2016 Kelompok C06 Basis Data Genap 2017</h1>
			</div>
		</footer>
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/validation.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>