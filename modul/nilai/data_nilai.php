<?php
	if(isset($_GET['aksi']) == 'delete'){
		$id_nilai = $_GET['id_kinerja'];
		$cek = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kinerja='$id_kinerja'");
		if(mysqli_num_rows($cek) == 0){
			echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data tidak ditemukan.</div>';
		}else{
			$delete = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_kinerja='$id_kinerja'");
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
        <h1 class="m-0 text-dark">Data Nilai Guru</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Data Nilai</li>
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
              <h3 class="card-title"> <a href="?module=input_nilai">Tambah Data</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
					<th>No</th>
					<th>Periode</th>
					<th>Nama Guru</th>
					<th>Kriteria</th>
					<th>Jenis Kriteria</th>
					<th>Nilai</th>
					<th>aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql =  mysqli_query($koneksi, "SELECT nilai.id_kriteria AS id_kriteria, nilai.id_kinerja AS id_kinerja, kinerja.Periode AS periode, guru.nm_guru AS nm_guru, kriteria.nm_kriteria AS nm_kriteria, nilai.nilai AS nilai, kriteria.tren AS tren FROM guru, kinerja, nilai, kriteria WHERE guru.id_guru=kinerja.id_guru AND kinerja.id_kinerja=nilai.id_kinerja AND nilai.id_kriteria=kriteria.id_kriteria");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
						
						<tr>
							
							<td><?php echo $no ?></td>
							<td><?php echo $row['periode'];?></td>
							<td><?php echo $row['nm_guru'];?></td>
							<td><?php echo $row['nm_kriteria'];?></td>
							<td><?php echo $row['tren'];?></td>
							<td><?php echo $row['nilai'];?></td>
							<td>
								<a href="?module=edit_nilai&id_kinerja=<?php echo $row['id_kinerja']; ?>&id_kriteria=<?php echo $row['id_kriteria']; ?>" title="Edit Data" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-edit"></i></a>
								
								
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

	