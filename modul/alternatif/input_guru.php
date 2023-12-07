<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Guru</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Data Guru</li>
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
				$id_guru	= $_POST['id_guru'];
				$nm_guru	= $_POST['nama_guru'];
				$jenkel		= $_POST['jenkel'];
				$alamat		= $_POST['alamat'];
				
				
					$insert = mysqli_query($koneksi, "INSERT INTO guru(id_guru,nm_guru,jenkel,alamat)VALUES('$id_guru','$nm_guru','$jenkel','$alamat')") or die(mysqli_error($koneksi));
					if($insert){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Alternatif Berhasil Di Simpan.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Alternatif Gagal Di simpan ! </div>';
					}	
			}
			$kode= mysqli_query($koneksi, "select max(id_guru) as kode from guru");
			$kode2 = mysqli_fetch_assoc($kode);
			$kode3 = substr($kode2['kode'],1,4);
			$tambah=$kode3+1;
			if ($tambah<10){
				$kode_guru = "G0".$tambah;
			} else {
				$kode_guru = "G".$tambah;
			}
			?>
			<div class="card card-secondary">
              	<div class="card-header">
                	<h3 class="card-title">&nbsp;</h3>
              	</div>
						
						<form class="form-horizontal" action="" method="post">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID Guru</label>
								<div class="col-sm-12">
									<input type="text" name="id_guru" class="form-control" value="<?php echo $kode_guru; ?>" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Guru</label>
								<div class="col-sm-12">
									<input type="text" name="nama_guru" class="form-control" placeholder="Nama Guru" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jenis Kelamin</label>
								<div class="col-sm-12">
									<div class="radio">
  										<label><input type="radio" name="jenkel" value="Laki-laki" >&nbsp;Laki-laki</label>&nbsp;&nbsp;&nbsp;&nbsp;
  										<label><input type="radio" name="jenkel" value="Perempuan" >&nbsp;Perempuan</label>
									</div>
								</div>
							</div><div class="form-group">
								<label class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-12">
									<textarea name="alamat" class="form-control" rows="5" cols="20" placeholder="Alamat" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="add" class="btn btn-sm btn-primary" value="simpan">
									<input type="reset"  class="btn btn-sm btn-danger" value="Batal">
								</div>
							</div>

						</form>
						
					</div>	
			</div>
		</div>
	</div>
</section>