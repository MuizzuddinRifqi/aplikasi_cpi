<?php
	if(isset($_GET['aksi']) == 'delete'){
		$id_guru = $_GET['id_guru'];
		$cek = mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru='$id_guru'");
		if(mysqli_num_rows($cek) == 0){
			echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data tidak ditemukan.</div>';
		}else{
			$delete = mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id_guru'");
			if($delete){
				echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>';
			}else{
				echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>';
			}
		}
	}
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
<!-- /.content-header -->
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> <a href="?module=input_guru">Tambah Data</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
					<th>No</th>
					<th>ID Guru</th>
					<th>Nama Guru</th>
					<th>Jenis Kelamin</th>
					<th>Alamat</th>
					<th>aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql =  mysqli_query($koneksi, "SELECT * FROM guru");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
						
						<tr>
							
							<td><?php echo $no ?></td>
							<td><?php echo $row['id_guru'];?></td>
							<td><?php echo $row['nm_guru'];?></td>
							<td><?php echo $row['jenkel'];?></td>
							<td><?php echo $row['alamat'];?></td>
							<td>
								<a href="?module=edit_guru&id_guru=<?php echo $row['id_guru']; ?>" title="Edit Data" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-edit"></i></a>
								
								<a href="?module=data_guru&aksi=delete&id_guru=<?php echo $row['id_guru']; ?>" title="Hapus Data" onclick="return confirm('Anda yakin akan menghapus data <?php echo $row['nm_guru']; ?>?')" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
							</td>
						</tr>
						
						<?php
						$no++;
					
				}
				?>
				</tbody>
				<!--
				<tfoot>
					<tr>
						<th>No</th>
						<th>Nama Alternatif</th>
						<th>aksi</th>
					</tr>
				</tfoot>
			-->
				</table>
				</div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content --

	