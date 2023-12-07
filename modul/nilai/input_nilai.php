<?php
	error_reporting(0);
	include("koneksi.php");

	$datauser = mysqli_query($koneksi, "SELECT * FROM user where nama = '$_SESSION[nama]'");
	$resDatauser = mysqli_fetch_assoc($datauser);

	$querynumber = mysqli_query($koneksi, "SELECT * FROM kinerja ORDER BY id_kinerja DESC");
	$arraynumber = mysqli_fetch_assoc($querynumber);
	$numberKinerja = "0";
	$nilaiAkhir = 0;
	if(empty($arraynumber["id_kinerja"])){
		$numberKinerja = "KJ01";
	}else{
		$dataNumber = $arraynumber["id_kinerja"];
		$subst = substr($dataNumber, 3, 1);
		$addnumber = $subst + 1;
		$numberKinerja = "KJ0".$addnumber;
	}

	$periode = $_GET["periode"];
	$guru = $_GET["guru"];

	$dataguru = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru = '$guru'");
	$setguru = mysqli_fetch_assoc($dataguru);
	

	$queryNilAkhir = mysqli_query($koneksi, "SELECT * FROM `nilai` INNER JOIN kriteria ON nilai.id_kriteria = kriteria.id_kriteria WHERE nilai.id_kinerja = '$numberKinerja'");
	while($resDataNil = mysqli_fetch_assoc($queryNilAkhir)){
		$nilaiAkhir += $resDataNil["nil_hitung"] * $resDataNil["bobot"];
	}
	
	$datanilai = "<script>JSON.parse(document.cookie.split('; ').find(row => row.startsWith('nilai')).split('=')[1])</script>";
	echo $datanilai;
?>
<script>
	function getdataKriteria(){
		var id = document.getElementById("kriteria").value;
		$.ajax({
			url: "http://localhost/skripsi_cpi/modul/apikinerja.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id
			},
			success: function(data){
				$("#tren").val(data.tren);
				$("#bobot").bal(data.bobot);
			}
		})
	}

</script>
<script>
	function getDataGuru(){
		var id = document.getElementById("guru").value;
		$.ajax({
			url: "http://localhost/skripsi_cpi/modul/apiguru.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id
			},
			success: function(data){
				$("#jk").val(data.jk);
				$("#alamat").val(data.alamat);
			}
		})
	}
</script>
<script>
	document.cookie = "nilai=[]";
</script>
<script>
	function insertDataNilai () {
		var id_kinerja = $("#id_kinerja").val();
		var id_kriteria = $("#kriteria").val();
		var nilai = $("#nilai").val();
		var tren = $("#tren").val();
		var periode = $("#periode").val();
		var guru = $("#guru").val();
		var nilai_akhir = "0";

		var data_nilai =  [];
		if(!id_kriteria || !nilai){
			alert("Silahkan lengkapi data anda ");
		}else{
			
			$.ajax({
				url: "http://localhost/skripsi_cpi/modul/apiinsertnilai.php",
				type:"POST",
				dataType: "json",
				data: {
					id_kinerja: id_kinerja,
					id_kriteria: id_kriteria,
					nilai: nilai,
					nilai_akhir: 0
				},
				success: function(hasil){
					if(hasil.message === "success"){
						document.location = "http://localhost/skripsi_cpi/dashboard.php?module=input_nilai&periode="+periode+"&guru="+guru;
					}else if(hasil.message = "duplikat"){
						alert("data sudah ada");
					}else{
						alert("data ada yang salah");
					}
				}
			})
		}
	}	
</script>
<script>
	function insertDataKinerja() {
		var id_kinerja = $("#id_kinerja").val();
		var periode = $("#periode").val();
		var nil_akhir = '<?php echo $nilaiAkhir;?>';
		var id_guru = $("#guru").val();
		var id_user = '<?php echo $resDatauser["id_user"];?>';
			$.ajax({
				url: "http://localhost/skripsi_cpi/modul/apiinsertkinerja.php",
				type:"POST",
				dataType: "json",
				data: {
					id_kinerja: id_kinerja,
					periode: periode,
					nil_akhir: nil_akhir,
					id_guru: id_guru,
					id_user: id_user
				},
				success: function(hasil){
					if(hasil.message = "success"){
						document.location = "http://localhost/skripsi_cpi/dashboard.php?module=data_nilai";
					}else{
						alert("data ada yang salah");
					}
				}
			})

	}
</script>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Input Nilai Guru</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Nilai</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-12">
			
			<?php
			if(isset($_POST['add'])){
				$id_kriteria		= $_POST['id_kriteria'];
				$id_alternatif		= $_POST['id_alternatif'];
				$nilai		= $_POST['nilai'];
				
					$insert = mysqli_query($koneksi, "INSERT INTO nilai(id_alternatif, id_kriteria, nilai)VALUES('$id_alternatif', '$id_kriteria', '$nilai')") or die(mysqli_error($koneksi));
					if($insert){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Nilai Berhasil Di Simpan.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Nilai Gagal Di simpan ! </div>';
					}	
			}
			
			?>
			
			<form class="form-horizontal" action="" method="post">
			<div class="container col-md-12" style="display: flex; justify-content: center">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">&nbsp;</h3>
					</div>
						<div class="form-group">
								<label class="col-sm-3 control-label">ID Kinerja</label>
								<div class="col-sm-12">
									<input type="text" name="id_kinerja" id="id_kinerja" value="<?php echo $numberKinerja;?>" readonly class="form-control" placeholder="" required>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Periode</label>
							<div class="col-sm-12">
							<select name="periode" id="periode" class="form-control" required>
										<option value="">Pilih</option>
										<option <?php if($periode === "2015") echo "selected" ?> value="2015">2015</option>
										<option <?php if($periode === "2016") echo "selected" ?> value="2016">2016</option>
										<option <?php if($periode === "2017") echo "selected" ?> value="2017">2017</option>
										<option <?php if($periode === "2018") echo "selected" ?> value="2018">2018</option>
										<option <?php if($periode === "2019") echo "selected" ?> value="2019">2019</option>
										<option <?php if($periode === "2020") echo "selected" ?> value="2020">2020</option>
										<option <?php if($periode === "2021") echo "selected" ?> value="2021">2021</option>
										<option <?php if($periode === "2022") echo "selected" ?> value="2022">2022</option>
										<option <?php if($periode === "2023") echo "selected" ?> value="2023">2023</option>
										<option <?php if($periode === "2024") echo "selected" ?> value="2024">2024</option>
										
									</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama Guru</label>
							<div class="col-sm-12">
								<select name="id_guru" id="guru" onchange="getDataGuru()" class="form-control" required>
									<option value="">Pilih</option>
									<?php  
										$sql =  mysqli_query($koneksi, "SELECT * FROM guru");

										while($row = mysqli_fetch_assoc($sql)){
										?>
										<option <?php if($guru === $row["id_guru"]) echo "selected" ?> value="<?php echo $row['id_guru'] ?>"><?php echo $row['nm_guru'] ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-12">
								<input type="text" name="jk" id="jk" value="<?php echo $setguru["jenkel"];?>" readonly class="form-control" placeholder="" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat</label>
							<div class="col-sm-12">
								<input type="text" name="alamat" id="alamat" value="<?php echo $setguru["alamat"];?>" readonly class="form-control" placeholder="" required>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">&nbsp;</h3>
					</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Kriteria</label>
							<div class="col-sm-12">
								<select name="id_kriteria" id="kriteria" onchange="getdataKriteria()" class="form-control" required>
									<option value="">Pilih</option>
									<?php  
										$sql =  mysqli_query($koneksi, "SELECT * FROM kriteria");

										while($row = mysqli_fetch_assoc($sql)){
										?>
										<option value="<?php echo $row['id_kriteria'] ?>"><?php echo $row['nm_kriteria'] ?></option>
										<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tren</label>
							<div class="col-sm-12">
								<input type="text" name="tren" id="tren" readonly class="form-control" placeholder="" required>
								<input type="hidden" name="bobot" id="bobot" class="form-control" placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nilai</label>
							<div class="col-sm-12">
								<input type="text" name="nilai" id="nilai" class="form-control" placeholder="" required>
							</div>
						</div>							
						<div class="form-group">
							<div class="col-sm-12">
								<input type="button" onclick="insertDataNilai()" name="Add Nilai" class="btn btn-sm btn-primary" value="Add Nilai">
								<a href="?module=data_nilai" class="btn btn-sm btn-danger">Batal</a>
							</div>
						</div>

					</div>
				</div>	
			</div>
			<div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Nilai Alternatif <?php echo $numberKinerja ;?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
					<th>No</th>
					<th>Kriteria</th>
					<th>Tren</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql =  mysqli_query($koneksi, "SELECT * FROM `nilai` INNER JOIN kriteria ON nilai.id_kriteria = kriteria.id_kriteria WHERE nilai.id_kinerja = '$numberKinerja'");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
						
						<tr>
							
							<td><?php echo $no ?></td>
							<td><?php echo $row['nm_kriteria'];?></td>
							<td><?php echo $row['tren'];?></td>
							<td><?php echo $row['nilai'];?></td>
							
						</tr>
						
						<?php
						$no++;
					
				}
				?>
				</tbody>
				</table>
				</div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
										
		  <div class="form-group">
				<div class="col-sm-12">
					<input type="button" onclick="insertDataKinerja()" name="Add Nilai" class="btn btn-sm btn-primary" value="simpan">
					<a href="?module=data_nilai" class="btn btn-sm btn-danger">Batal</a>
				</div>
			</div>
			</form>
			</div>
		</div>
	</div>
</section>