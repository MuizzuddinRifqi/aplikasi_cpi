<?php  
$query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$_GET[id_kriteria]'");
$row = mysqli_fetch_assoc($query);
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ubah Data Kriteria</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Ubah Data Kriteria</li>
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
			if(isset($_POST['ubah'])){
				$id_kriteria				= $_POST['id_kriteria'];
				$nama_kriteria				= $_POST['nama_kriteria'];
				$bobot						= $_POST['bobot'];
				$tren						= $_POST['tren'];
				
				
				$update = mysqli_query($koneksi, "UPDATE kriteria SET id_kriteria='$id_kriteria',  
																				nm_kriteria='$nama_kriteria', 
																				bobot='$bobot', 
																				tren='$tren'
																				WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
				if($update){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Kriteria Berhasil Di Update.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Pemohon salinan Gagal Di Upadate ! </div>';
				}	
				
				
			}
			?>

			<div class="card card-secondary">
              	<div class="card-header">
                	<h3 class="card-title">&nbsp;</h3>
              			</div>
						<form class="form-horizontal" action="" method="post">
							<div class="card-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="id_kriteria" value="<?php echo $row['id_kriteria'];?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="nama_kriteria" value="<?php echo $row['nm_kriteria'];?>" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jenis Kriteria</label>
								<div class="col-sm-12">
									<select name="tren" class="form-control" required>
										<option value="<?php echo $row['tren'];?>"><?php echo $row['tren'];?></option>
										<option value="Positif">Positif</option>
										<option value="Negatif">Negatif</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Bobot kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="bobot" value="<?php echo $row['bobot'];?>" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="ubah" class="btn btn-sm btn-primary" value="simpan">
									<a href="?module=data_kriteria" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>
						</div>
						</form>
					</div>	
			</div>
		</div>
	</div>
</section>