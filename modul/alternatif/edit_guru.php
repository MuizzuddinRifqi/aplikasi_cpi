<?php  
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru='$_GET[id_guru]'");
$row = mysqli_fetch_assoc($query);
?>

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
			if(isset($_POST['ubah'])){
				$id_guru					= $_POST['id_guru'];
				$nm_guru					= $_POST['nama_guru'];
				$jenkel						= $_POST['jenkel'];
				$alamat						= $_POST['alamat'];
				
				$update = mysqli_query($koneksi, "UPDATE guru SET id_guru='$id_guru',  
																				nm_guru='$nm_guru',
																				jenkel='$jenkel',
																				alamat='$alamat'
																				WHERE id_guru='$id_guru'") or die(mysqli_error($koneksi));
				if($update){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Alternatif Berhasil Di Update.</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Pemohon salinan Gagal Di Upadate ! </div>';
				}	
				
				
			}
			?>

			<div class="card card-secondary">
						<form class="form-horizontal" action="" method="post">
							<div class="card-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID Guru</label>
								<div class="col-sm-12">
									<input type="text" name="id_guru" class="form-control" value="<?php echo $row['id_guru'];?>" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Guru</label>
								<div class="col-sm-12">
									<input type="text" name="nama_guru" class="form-control" value="<?php echo $row['nm_guru'];?>">
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
									<textarea name="alamat" class="form-control" rows="5" cols="20" ><?php echo $row['alamat'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="ubah" class="btn btn-sm btn-primary" value="Ubah Data">
									<a href="?module=data_alternatif" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>
						</div>
						</form>
					</div>	
			</div>
		</div>
	</div>
</section>