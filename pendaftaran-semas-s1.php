<?php
	include('config.php');
    session_start();

	if(!isset($_SESSION['username'])){
        header("Location:login.php");
	}

    if (isset($_SESSION['id_pendaftaran'])) {
        header('location: pembayaran.php');
    }

    $result = pg_query($link, "SELECT NOMOR, TAHUN
            FROM SIRIMA.PERIODE_PENERIMAAN
            WHERE STATUS_AKTIF = TRUE
    ");

    $data = pg_fetch_assoc($result);
    $periode = $data['nomor'];
    $tahun = $data['tahun'];

    $result = pg_query($link, "SELECT KODE, NAMA, JENIS_KELAS 
	FROM SIRIMA.PROGRAM_STUDI 
	WHERE JENJANG = 'S1' AND KODE IN (
		SELECT KODE_PRODI
		FROM SIRIMA.PENERIMAAN_PRODI
		WHERE NOMOR_PERIODE IN (
			SELECT NOMOR
			FROM SIRIMA.PERIODE_PENERIMAAN
			WHERE STATUS_AKTIF = TRUE
	))");
    
    $prodi = array();
    while ($data = pg_fetch_assoc($result)) {
        $prodi[] = $data;
    }

    $result = pg_query($link, "
    SELECT KOTA, TEMPAT FROM SIRIMA.LOKASI_JADWAL WHERE NOMOR_PERIODE IN (
        SELECT NOMOR
        FROM SIRIMA.PERIODE_PENERIMAAN
        WHERE STATUS_AKTIF = TRUE
    )
	AND JENJANG = 'S1'
    ");

    $lokasi = array();
    while ($data = pg_fetch_assoc($result)) {
        $lokasi[] = $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $form = $_POST;
        
        //Insert Pendaftaran
        $result = pg_query($link, "
        INSERT INTO PENDAFTARAN (status_lulus, status_verifikasi, pelamar,nomor_periode,tahun_periode) 
        VALUES (NULL, 'TRUE', '$_SESSION[username]', '$periode', '$tahun');
        ");
        
        //Get ID on Pendaftaran
        $result = pg_query($link, "
        SELECT MAX(id) FROM PENDAFTARAN
        ");
        $id = pg_fetch_assoc($result)['max'];
        $_SESSION['id_pendaftaran'] = $id;
        //Insert Pendaftaran Semas
        $result = pg_query($link, "
        INSERT INTO PENDAFTARAN_SEMAS (id_pendaftaran, lokasi_kota, lokasi_tempat, status_hadir, nilai_ujian, no_kartu_ujian) 
        VALUES ('$id', '$form[kota]', '$form[tempat]', NULL, NULL, NULL);
        ");
        
        //Insert Pendaftaran Semas Sarjana
        $result = pg_query($link, "
        INSERT INTO PENDAFTARAN_SEMAS_SARJANA (id_pendaftaran, asal_sekolah, jenis_sma, alamat_sekolah, nisn, tgl_lulus, nilai_uan)
        VALUES ('$id', '$form[sekolah]', '$form[jenis]', '$form[alamat]', '$form[nisn]', '$form[tggl]', '$form[uan]');
        ");
        
        //Insert Pendaftaran Prodi
        for ($i=1; $i <= 3 && $form['prod' .$i] != 'NULL'; $i++) { 
            $prodi = $form['prod' .$i];
            $result = pg_query($link, "
            INSERT INTO PENDAFTARAN_PRODI (id_pendaftaran, kode_prodi, status_lulus) 
            VALUES ('$id', '$prodi', NULL);
            ");
        }
        //header('location: pembayaran.php');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>SIRIMA - Pendaftaran Semas S1</title>
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
                    <li> <a href="index.php">Home</a> </li>
                    <li class="active"> <a href="pendaftaran-semas.php">Membuat Pendaftaran</a> </li>
                    <li> <a href="logout.php">Sign Out</a> </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <!-- Begin page content -->
    <div class="container register-group">
        <div class="page-header">
                <center><h1>FORM PENDAFTARAN SEMAS SARJANA</h1> </div></center>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            
            <form role="form" method="post">
                <div class="form-group">
                    <label class="control-label" for="formInput175">Asal Sekolah*</label>
                    <input name="sekolah" type="text" class="form-control underline-input" id="formInput175" placeholder="Asal Sekolah" required> </div>	
                <div class="form-group">
                    <label class="control-label" for="formInput183">Jenis SMA*</label>
                    <select id="formInput183" class="form-control form-select" name="jenis" required>
                        <option>IPA</option>
                        <option>IPS</option>
                        <option>BAHASA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput203">Alamat Sekolah*</label>
                    <input type="text" class="form-control underline-input" id="formInput203" placeholder="Alamat Sekolah" name="alamat" required> 
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput195">NISN*</label>
                    <input type="number" class="form-control underline-input" id="formInput195" placeholder="NISN" min="9000000000" max="9999999999" name="nisn" required> 
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput195">Tanggal Lulus*</label>
                    <input type="date" class="form-control underline-input" id="formInput195" name="tggl" required> 
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput215">Nilai UAN*</label>
                    <input type="number" min="0" max="60" class="form-control underline-input" id="formInput215" placeholder="Nilai UAN" step=".01" name="uan" required> 
                </div>
				

				<div class="form-group">
                    <label class="control-label" for="formInput209">Prodi Pilihan 1*</label>
                    <select id="prodi-1" class="form-control form-select" onchange="prodi1Changed()" name="prod1" required>
                        <option value="">-Pilih Jurusan-</option>
                        <?php
                            foreach($prodi as $row) {
                                echo "<option id='".$row['kode']."' value='".$row['kode']."'>".$row['nama']." (".$row['jenis_kelas'].")</option>";
                            };
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput245">Prodi Pilihan 2 (tidak wajib)</label>
                    <select id="prodi-2" class="form-control form-select" onchange="prodi2Changed()" style="display: none" name="prod2">
                        <option value='NULL'>-Tidak Memilih-</option>
						<?php
                            foreach($prodi as $row) {
                                echo "<option id='".$row['kode']."' value='".$row['kode']."'>".$row['nama']." (".$row['jenis_kelas'].")</option>";
                            };
                        ?>
                    </select>
                </div>		                
				<div class="form-group">
                    <label class="control-label" for="formInput267">Prodi Pilihan 3 (tidak wajib)</label>
                    <select id="prodi-3" class="form-control form-select" onchange="prodi3Changed()" style="display: none" name="prod3">
						<option value='NULL'>-Tidak Memilih-</option>
                        <?php
                            foreach($prodi as $row) {
                                echo "<option id='".$row['kode']."' value='".$row['kode']."'>".$row['nama']." (".$row['jenis_kelas'].")</option>";
                            };
                        ?>
                    </select>
                </div>
				
				
                <script>
                    var prod1;
                    var prod2;
                    var prod3;
                    
                    function resetProdi1() {
                        if (prod1 != '') {
                            $('#prodi-2 #' + prod1).show();
                            $('#prodi-3 #' + prod1).show();
                        }
                        prod1 = $("#prodi-1").val();
                        if (prod1 != '') {
                            $('#prodi-2 #' + prod1).hide();
                            $('#prodi-3 #' + prod1).hide();
                        }         
                    }

                    function resetProdi2() {
                        if (prod2 != 'NULL') {
                            $('#prodi-1 #' + prod2).show();
                            $('#prodi-3 #' + prod2).show();
                        }
                        prod2 = $("#prodi-2").val();
                        if (prod2 != 'NULL') {
                            $('#prodi-1 #' + prod2).hide();
                            $('#prodi-3 #' + prod2).hide();
                        } 
                    }

                    function resetProdi3() {
                        if (prod3 != 'NULL') {
                            $('#prodi-1 #' + prod3).show();
                            $('#prodi-2 #' + prod3).show();
                        }
                        prod3 = $("#prodi-3").val();
                        if (prod3 != 'NULL') {
                            $('#prodi-1 #' + prod3).hide();
                            $('#prodi-2 #' + prod3).hide();
                        } 
                    }

                    function prodi1Changed() {
                        resetProdi1();
                        if ($("#prodi-1").val() == '') {
                            $('#prodi-2').hide();
                            $('#prodi-3').hide();

                            $('#prodi-2').val('NULL');
                            $('#prodi-3').val('NULL');
                            resetProdi2();
                            resetProdi3();  
                        } else {
                            $('#prodi-2').show();
                        }
                    }

                    function prodi2Changed() {
                        resetProdi2();
                        if ($("#prodi-2").val() == 'NULL') {
                            $('#prodi-3').hide();

                            $('#prodi-3').val('NULL');
                            resetProdi3();
                        } else {
                            $('#prodi-3').show();
                        }
                    }

                    function prodi3Changed() {
                        resetProdi3();
                    }
                </script>




                <div class="form-group">
                    <label class="control-label" for="formInput271">Lokasi Kota Ujian*</label>
                    <select id="lokKota" class="form-control form-select" onchange="kotaChanged()" name="kota" required>
                        <option value=''>-Pilih Kota Ujian-</option>
                        <?php
                            foreach($lokasi as $row) {
                                echo "<option>".$row['kota']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="formInput237">Lokasi Tempat Ujian*</label>
                    <select id="lokTempat" class="form-control form-select" name="tempat" required>
                        <option value="">-Pilih Tempat Ujian-</option>
                        <?php
                            foreach($lokasi as $row) {
                                echo "<option id='".$row['kota']."' style='display: none'>".$row['tempat']."</option>";
                            }
                        ?>
                    </select>
                </div>

                <script>

                    var lastKota = '';
                    function kotaChanged() {
                        if (lastKota == '') 
                        {
                            $('#lokTempat #' + $('#lokKota').val()).show();
                        } else if ($('#lokKota').val() == '') 
                        {
                            $('#lokTempat #' + lastKota).hide();
                            $('#lokTempat').val("");
                        } else {
                            $('#lokTempat #' + $('#lokKota').val()).show();
                            $('#lokTempat #' + lastKota).hide();
                        }
                        lastKota = $('#lokKota').val();
                    }
                </script>

                <p>* Required</p>
				<div class="form-group">
                	<button type="submit" class="btn btn-primary">SIMPAN</button>
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