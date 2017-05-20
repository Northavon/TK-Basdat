<?php
include('config.php');
session_start();

if(!isset($_SESSION['username'])){
        header("Location:login.php");
}

if($_SESSION['role'] == 'f') {
	 header("Location:index.php");
}


function getTable(){
	$periode 	= $_SESSION['periode1'];
	$prodi 		= explode("_",$_SESSION['prodi']);
	$jenjang 	= $prodi[0];
	$nama 		= $prodi[1];
	$jenis_kelas= $prodi[2];

	$sql = "select pp.id_pendaftaran, pl.nama_lengkap, pl.alamat, pl.jenis_kelamin, pl.tanggal_lahir, pl.no_ktp, pl.email
			from sirima.pelamar pl, sirima.pendaftaran pd, sirima.pendaftaran_prodi pp,sirima.program_studi ps
			where pl.username = pd.pelamar AND pd.id = pp.id_pendaftaran AND pp.kode_prodi=ps.kode AND pp.status_lulus=TRUE AND pd.nomor_periode='".$periode."' AND ps.jenjang='".$jenjang."' AND ps.nama='".$nama."' AND ps.jenis_kelas='".$jenis_kelas."'";

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
						<h2>Pelamar Yang Diterima</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="form-group">
				<form id="rpform" action="pelamarditerima.php" method="post">
					<div class="col-md-4">
						<select name="periode1" class="form-control">
							<option disabled selected>Periode:</option>
							<option value="1">1-2015</option>
							<option value="2">2-2016</option>
							<option value="3">3-2017</option>
						</select>
					</div>
					<div class="col-md-4">
						<select name="prodi" class="form-control">
							<option disabled selected>Prodi:</option>

							<?php
								$sqls = "select jenjang, nama, jenis_kelas
										 from sirima.program_studi";
								$res  = pg_query($sqls);

								while ($r = pg_fetch_row($res)) {
									echo "<option value='".$r[0]."_".$r[1]."_".$r[2]."'>".$r[0]." ".$r[1]." ".$r[2]."</option>";
								}
							?>
						</select>
					</div>
					<div class="col-md-2"><button type="submit" class="btn btn-primary">Lihat</button></div>
				</form>
			</div>
		</div>


		<?php
			if(isset($_POST['periode1']) && isset($_POST['prodi']))
			{
				$_SESSION["periode1"] = $_POST['periode1'];
				$_SESSION["prodi"] = $_POST['prodi'];
			}
			if(isset($_SESSION["periode1"]) && $_SESSION["prodi"])
			{
				echo "<div class='container'>
						<h4>Prodi : ".$_SESSION['prodi']."</h4>
						<table class='table table-condensed'>
							<thead>
								<th>Id Pendaftaran</th>
								<th>Nama Lengkap</th>
								<th>Alamat</th>
								<th>Jenis Kelamin</th>
								<th>Tanggal Lahir</th>
								<th>No KTP</th>
								<th>Email</th>
							</thead>
							<tbody>";

				$data = getTable();


				$halaman = 10;
				$page = isset($_GET["halaman"])?(int)$_GET["halaman"] : 1;
				$mulai = ($page > 1)? ($page * $halaman) - $halaman : 0;
				$result = pg_query($data);
				$total = pg_num_rows($result);
				$pages = ceil($total/$halaman);

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
							<td>".$row[6]."</td>
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
			if(isset($_SESSION['periode1']) && isset($_SESSION['prodi']))
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

