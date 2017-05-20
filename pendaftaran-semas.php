<?php
	session_start();
	
	if(!isset($_SESSION['username'])){
        header("Location:login.php");
	}
	
    if (isset($_SESSION['id_pendaftaran'])) {
        header('location: pembayaran.php');
    }

    if($_POST['jenjang'] == 'S1') {
		header('location: pendaftaran-semas-s1.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>SIRIMA - Pendaftaran Semas</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <!--Core Style CSS-->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
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
                    <li class="active"> <a href="pendaftaran-semas.php">Membuat Pendaftaran</a> </li>
                    <li> <a href="logout.php">Log out</a> </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
	
    <!-- Begin page content -->
    <div class="container register-group">
        <div class="page-header">
            <center><h1>FORM PEMILIHAN JENJANG UNTUK PENDAFTARAN</h1> </div></center>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form role="form" method="post">
                <div class="form-group">
                    <label class="control-label" for="formInput163">Jenjang</label>
                    <select name="jenjang" class="form-control">
                        <option>S1</option>
                        <option>S2</option>
                        <option>S3</option>
                    </select>
                </div>
                <div class="form-group"> </div>
                <div class="form-group"> </div>
                <div class="form-group"> </div>
                <div class="checkbox"> </div>
				<div class="form-group">
                	<button type="submit" class="btn btn-primary">PILIH</button>
				</div>
            </form>
        </div>
        <div class="col-md-3"></div>
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

</html>