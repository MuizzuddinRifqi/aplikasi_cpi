<?php
	if(isset($_GET['aksi']) == 'delete'){
		$id_kriteria = $_GET['id_kriteria'];
		$cek = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
		if(mysqli_num_rows($cek) == 0){
			echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data tidak ditemukan.</div>';
		}else{
			$delete = mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'");
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
<!-- /.content-header -->
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> <a href="?module=input_kriteria">Tambah Data</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
					<th>No</th>
					<th>ID Kriteria</th>
					<th>Nama Kriteria</th>
					<th>Jenis Kriteria</th>
					<th>Bobot Kriteria (%)</th>
					<th>aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql =  mysqli_query($koneksi, "SELECT * FROM kriteria");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
						
						<tr>
							
							<td><?php echo $no ?></td>
							<td><?php echo $row['id_kriteria'];?></td>
							<td><?php echo $row['nm_kriteria'];?></td>
							<td><?php echo $row['tren'];?></td>
							<td><?php echo $row['bobot'];?></td>
							<td>
								<a href="?module=edit_kriteria&id_kriteria=<?php echo $row['id_kriteria']; ?>" title="Edit Data" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-edit"></i></a>
								
								<a href="?module=data_kriteria&aksi=delete&id_kriteria=<?php echo $row['id_kriteria']; ?>" title="Hapus Data" onclick="return confirm('Anda yakin akan menghapus data <?php echo $row['nm_kriteria']; ?>?')" class="btn btn-danger btn-sm"> <i class="nav-icon fas fa-trash"></i></a>
							</td>
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content --

	