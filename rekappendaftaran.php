<?php
include('config.php');
session_start();

if(!isset($_SESSION['username'])){
        header("Location:login.php");
}

if($_SESSION['role'] == 'f') {
	 header("Location:index.php");
}
//$conn_string = "host=localhost port=5454 dbname=c209 user=postgres password=mgarnanda";


function getTable(){
	$periode = $_SESSION['periode'];
	$jenjang = $_SESSION['jenjang'];

	$sql = "select ps.nama, ps.jenis_kelas, ps.nama_fakultas, pp.kuota, pp.jumlah_pelamar, pp.jumlah_diterima
	 		from sirima.program_studi as ps, sirima.penerimaan_prodi pp
	 		where ps.kode = pp.kode_prodi AND ps.jenjang='".$jenjang."' AND nomor_periode=".$periode;

	return $sql;
}

?>
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
	<div id="heading-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h2>Rekap Pendaftaran</h2>
				</div>
			</div>
		</div>
	</div>
		
	<div class="container">
		<div class="form-group">
			<form id="rpform" action="rekappendaftaran.php" method="post">
				<div class="row">
					<div class="col-md-4">
						<select id="periode" name="periode" class="form-control">
							<option disabled selected>Pilih periode pendaftaran:</option>
							<option value="1">1-2015</option>
							<option value="2">2-2016</option>
							<option value="3">3-2017</option>
						</select>
					</div>
					<div class="col-md-4 ">
						<select id="jenjang" name="jenjang" class="form-control">
							<option disabled selected>Pilih jenjang pendaftaran:</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
						</select>
					</div>
					<div class="col-md-2"><button id="lihatbutton" type="submit" class="btn btn-primary">Lihat</button></div>
					<div class="col-md-2"></div>
				</div>
			</form>
		</div>
	</div>

		<?php
			if(isset($_POST['periode']) && isset($_POST['jenjang']))
			{
				$_SESSION["periode"] = $_POST['periode'];
				$_SESSION["jenjang"] = $_POST['jenjang'];
			}
			if(isset($_SESSION["periode"]) && $_SESSION["jenjang"])
			{
				echo "<div class='container'>
						<h4>Jenjang : ".$_SESSION['jenjang']."</h4>
						<table class='table table-condensed'>
							<thead>
								<th>Nama Prodi</th>
								<th>Jenis Kelas</th>
								<th>Nama Fakultas</th>
								<th>Kuota</th>
								<th>Jumlah Pelamar</th>
								<th>Jumlah Diterima</th>
							</thead>
							<tbody>";

				$data = getTable();

				$halaman = 5;
				$page = isset($_GET["halaman"])?(int)$_GET["halaman"] : 1;
				$mulai = ($page > 1)? ($page * $halaman) - $halaman : 0;
				$result = pg_query($data);
				$total = pg_num_rows($result);
				$pages = ceil($total/$halaman);
				$OFFSET = 0;

				$datalimit = getTable() . " LIMIT ".$halaman." OFFSET ".$mulai;
				$query = pg_query($datalimit);
				$no = $mulai+1;


				while($row = pg_fetch_row($query)){
					echo
						"<tr>
							<td>".$row[0]."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
							<td>".$row[5]."</td>
						</tr>";
				}

				echo
					"</tbody>
						</table>
					</div>";
			}
		?>

		<div class="container" style="margin-bottom: 200px;margin-top:50px;margin-right: 170px;">
			<?php
			if(isset($_SESSION['periode']) && isset($_SESSION['jenjang']))
			{
				for($i=1;$i<=$pages;$i++){?>
					<a class="btn btn-info" href="?halaman=<?php echo $i;?>"><?php echo $i;?></a>
					<?php
				}
			}?>
		</div>
	</div>
</body>
<footer class="footer">
	<div class="col-md-12">
		<h1>Copyright © 2016 Kelompok C06 Basis Data Genap 2017</h1>
	</div>
</footer>