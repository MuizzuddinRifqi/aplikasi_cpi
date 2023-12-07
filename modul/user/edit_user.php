<?php  
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$_GET[id_user]'");
$row = mysqli_fetch_assoc($query);
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Edit User</li>
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
				$id_user		= $_POST['id_user'];
				$username		= $_POST['username'];
				$nama			= $_POST['nama'];
				$password		= md5($_POST['password']);
				
				
				$update = mysqli_query($koneksi, "UPDATE user SET username='$username',  
																				nama='$nama', 
																				password='$password'
																				WHERE id_user='$id_user'") or die(mysqli_error($koneksi));
				if($update){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data User Berhasil Di Update.</div>';
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
							<input type="hidden" name="id" value="<?php echo $row['id'];?>">
							<div class="card-body">
								<div class="form-group">
								<label class="col-sm-3 control-label">ID User</label>
								<div class="col-sm-12">
									<input type="text" name="nama" value="<?php echo $row['id_user'];?>" class="form-control" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Lengkap</label>
								<div class="col-sm-12">
									<input type="text" name="nama" value="<?php echo $row['nama'];?>" class="form-control" placeholder="Nama Lengkap" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label>
								<div class="col-sm-12">
									<input type="text" name="username" value="<?php echo $row['username'];?>" class="form-control" placeholder="Username" required>
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
									<input type="submit" name="ubah" class="btn btn-sm btn-primary" value="simpan">
									<a href="?module=data_user" class="btn btn-sm btn-danger">Batal</a>
								</div>
							</div>
						</div>
						</form>
					</div>	
			</div>
		</div>
	</div>
</section>