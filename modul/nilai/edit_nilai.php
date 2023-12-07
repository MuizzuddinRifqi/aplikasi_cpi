<?php  
$query = mysqli_query($koneksi, "SELECT nilai.id_kriteria AS id_kriteria, nilai.id_kinerja AS id_kinerja, guru.nm_guru AS nm_guru, kriteria.nm_kriteria AS nm_kriteria, nilai.nilai AS nilai FROM guru, kinerja, nilai, kriteria WHERE guru.id_guru=kinerja.id_guru AND kinerja.id_kinerja=nilai.id_kinerja AND nilai.id_kriteria=kriteria.id_kriteria AND nilai.id_kinerja='$_GET[id_kinerja]' AND nilai.id_kriteria='$_GET[id_kriteria]'");
$row = mysqli_fetch_assoc($query);
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Nilai</h1>
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
			if(isset($_POST['ubah'])){
				$id_kinerja				= $_POST['id_kinerja'];
				$id_kriteria				= $_POST['id_kriteria'];
				$nilai						    = $_POST['nilai'];
				$update = mysqli_query($koneksi, "UPDATE nilai SET   
																				nilai='$nilai' 
																				WHERE id_kinerja='$id_kinerja' AND id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
				if($update){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Nilai Berhasil Di Update.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Nilai Gagal di update.</div>';
				}	
				
				
			}
			?>

			<div class="card card-secondary">
              	<div class="card-header">
                	<h3 class="card-title">&nbsp;</h3>
              			</div>
						<form class="form-horizontal" action="" method="post">
							<input type="hidden" name="id_kinerja" value="<?php echo $row['id_kinerja'];?>">
							<input type="hidden" name="id_kriteria" value="<?php echo $row['id_kriteria'];?>">
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Guru</label>
								<div class="col-sm-12">
									<input type="text" name="nm_guru" value="<?php echo $row['nm_guru'];?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Kriteria</label>
								<div class="col-sm-12">
									<input type="text" name="nm_guru" value="<?php echo $row['nm_kriteria'];?>" class="form-control" readonly="readonly">
								</div>
							</div><div class="form-group">
								<label class="col-sm-3 control-label">Nilai</label>
								<div class="col-sm-12">
									<input type="text" name="nilai" value="<?php echo $row['nilai'];?>" class="form-control" placeholder="Nilai" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="ubah" class="btn btn-sm btn-primary" value="simpan">
									<a href="?module=data_nilai" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>
						</div>
						</form>
					</div>	
			</div>
		</div>
	</div>
</section>