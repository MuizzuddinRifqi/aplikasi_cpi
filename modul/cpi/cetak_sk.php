<?php
	error_reporting(0);
	$periode = $_GET["periode"];
?>
<script>
	function getDataSK(){
		var periode = $("#periode").val();
		document.location = 'http://localhost/aplikasi_cpi/dashboard.php?module=cetak_sk&periode='+periode;
	}
</script>

<script>
	function simpan_sk(id_kinerja){
		var periode = '<?php echo $_GET["periode"];?>';

		$.ajax({
				url: "http://localhost/aplikasi_cpi/modul/apiinsertsk.php",
				type:"POST",
				dataType: "json",
				data: {
					id_kinerja: id_kinerja,
					periode: periode
				},
				success: function(hasil){
					if(hasil.message = "success"){
						document.location = "http://localhost/aplikasi_cpi/modul/cpi/print_cetak_sk.php?no_sk="+hasil.no_sk;
					}else{
						alert("data ada yang salah");
					}
				}
			})
	}
</script>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Cetak Hasil Keputusan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Cetak SK</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-12">			
			<div class="card card-secondary">
				<div class="form-group">
					<label class="col-sm-3 control-label">Periode</label>
					<div class="col-sm-12">
						<select name="periode" id="periode" class="form-control" required>
							<option value="">Pilih</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
							
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<input type="button" onClick="getDataSK()" name="" class="btn btn-sm btn-primary" value="Tampil">
					</div>
				</div>
				</div>
				<?php
					if($periode){
				?>
				<div class="card">
            <div class="card-header">
              <h3 class="card-title"> Data Hasil Keputusan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
				<tr>
					<th>No</th>
					<th>Periode</th>
					<th>Nama Guru</th>
					<th>Nilai</th>
					<th>aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql =  mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru ON kinerja.id_guru = guru.id_guru WHERE kinerja.id_guru=guru.id_guru AND kinerja.periode = '$periode' ORDER BY kinerja.nil_akhir DESC");
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
				?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $row['periode'];?></td>
							<td><?php echo $row['nm_guru'];?></td>
							<td><?php echo $row['nil_akhir'];?></td>
							<td>
							<input type="button" name="Add Nilai" class="btn btn-sm btn-primary" onClick="simpan_sk('<?php echo $row[id_kinerja];?>')" style="margin-top: 10px" value="Cetak SK">
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
		  
				
					
			</div>
			<?php } ?>
			</div>
		</div>
	</div>
</section>