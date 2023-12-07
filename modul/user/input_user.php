<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Input Data User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Input Data User</li>
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
				$id_user		= $_POST['id_user'];
				$username		= $_POST['username'];
				$nama			= $_POST['nama'];
				$password		= md5($_POST['password']);
							

				    $insert = mysqli_query($koneksi, "INSERT INTO user(id_user, nama, username, password)VALUES('$id_user','$username','$nama','$password')") or die(mysqli_error($koneksi));
					if($insert){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data User Berhasil Di Simpan.</div>';
					}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, User Gagal Di simpan ! </div>';
					}	
			
				
			}
			$kode= mysqli_query($koneksi, "select max(id_user) as kode from user");
			$kode2 = mysqli_fetch_assoc($kode);
			$kode3 = substr($kode2['kode'],2,4);
			$tambah=$kode3+1;
			if ($tambah<10){
				$kode_user = "US0".$tambah;
			} else {
				$kode_user = "US".$tambah;
			}
			?>
			<div class="card card-secondary">
              	<div class="card-header">
                	<h3 class="card-title">&nbsp;</h3>
              	</div>
						<form class="form-horizontal" action="" method="post">
							<div class="form-group">
								<label class="col-sm-3 control-label">ID User</label>
								<div class="col-sm-12">
									<input type="text" name="id_user" class="form-control" value="<?php echo $kode_user; ?>" readonly="readonly">
								</div>
							</div> 
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-12">
									<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-12">
									<input type="text" name="username" class="form-control" placeholder="Username" required>
								</div>
							</div> 
							<div class="form-group">
								<label class="col-sm-3 control-label">Password</label>
								<div class="col-sm-12">
									<input type="password" name="password" class="form-control" placeholder="Password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<input type="submit" name="add" class="btn btn-sm btn-primary" value="simpan">
									<a href="?module=data_user" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>
						</form>
						
					</div>	
			</div>
		</div>
	</div>
</section>