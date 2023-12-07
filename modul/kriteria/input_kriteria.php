<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Kriteria</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Data Kriteria</li>
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
				$id_kriteria	= $_POST['id_kriteria'];
				$nama_kriteria	= $_POST['nama_kriteria'];
				$tren			= $_POST['tren'];
				$bobot			= $_POST['bobot'];
				
					$insert = mysqli_query($koneksi, "INSERT INTO kriteria(id_kriteria, nm_kriteria, tren, bobot)VALUES('$id_kriteria','$nama_kriteria','$tren','$bobot')") or die(mysqli_error($koneksi));
					if($insert){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Kriteria Berhasil Di Simpan.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Kriteria Gagal Di simpan ! </div>';
					}	
			}
			$kode= mysqli_query($koneksi, "select max(id_kriteria) as kode from kriteria");
			$kode2 = mysqli_fetch_assoc($kode);
			$kode3 = substr($kode2['kode'],2,4);
			$tambah=$kode3+1;
			if ($tambah<10){
				$kode_kriteria = "KR0".$tambah;
			} else {
				$kode_kriteria = "KR".$tambah;
			}
			?>
			<div class="card card-secondary">
						<form class="form-horizontal" action="" method="post">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID Kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="id_kriteria" class="form-control" value="<?php echo $kode_kriteria; ?>" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="nama_kriteria" class="form-control" placeholder="Nama Kriteria" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Trend Kriteria</label>
								<div class="col-sm-12">
									<select name="tren" class="form-control" required>
										<option value="">Pilih</option>
										<option value="Positif">Positif</option>
										<option value="Negatif">Negatif</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Bobot kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="bobot" class="form-control" placeholder="%" required>
								</div>
							</div>							
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="add" class="btn btn-sm btn-primary" value="simpan">
									<a href="?module=data_kriteria_salinan_putusan" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>

						</form>
						
					</div>	
			</div>
		</div>
	</div>
</section>