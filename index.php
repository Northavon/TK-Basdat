<?php
    include('config.php');
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
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
    </head>
    <body>
        <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" href="index.php">Sistem Informasi Penerimaan Mahasiswa</a> </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                        if(!isset($_SESSION["username"])){ 
                            echo '<li class="active"> <a href="login.php">Sign In</a></li>';
                        } else {
                            echo '<li> <a href="logout.php">Logout</a></li>';
                        }
                    ?>
                    <?php
                    if(!isset($_SESSION["username"])){ ?>
                    <li> <a href="#contact">Sign Up</a> </li>
                     <?php 
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
	
        <div class="container">
            <?php 
                if(!isset($_SESSION['username'])) { ?>
            <div class="no-login-group">
                <h1>Selamat datang di SIRIMA</h1>
                <h3>Silahkan login <a href="login.php">disini</a></h3>
            </div>
            <?php    
                } else {
                    if($_SESSION['role'] == 'f') { ?>
					<div class="login-index-group">
						<h1>Selamat datang, <b><?php echo $_SESSION["username"]; ?></b></h1>
						<div class="menu-group">
							<h1>Daftar Menu</h1>
							<a href="pendaftaran-semas.php">Membuat Pendaftaran</a><br>
						</div>
					</div>
                    <?php 
                    } else { ?>
						<div class="login-index-group">
							<h1>Selamat datang <?php echo $_SESSION["username"]; ?></h1>
							<div class="menu-group">
								<h1>Daftar Menu</h1>
								<a href="rekappendaftaran.php">Rekap Pendaftaran</a><br>
								<a href="pelamarditerima.php">Daftar Pelamar Diterima</a><br>
							</div>
						</div>
                    <?php
                    }
                }
            ?>
            
        </div>
		<footer class="footer">
			<div class="col-md-12">
				<h1>Copyright © 2016 Kelompok C06 Basis Data Genap 2017</h1>
			</div>
		</footer>
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>