<script>
	function perhitungan(){
		var periode = $("#periode").val();
		document.location = "/aplikasi_cpi/dashboard.php?module=cpi&periode="+periode;
	}
</script>
<script>
	function hitungData(){
		var periode = $("#periode").val();
		$.ajax({
			url: 'http://localhost/aplikasi_cpi/modul/apiupdatenilai.php',
			type: "POST",
			dataType: "json",
			data: {
				periode: periode
			},
			success: function(hasil){
				if(hasil.message === "success"){
					document.location = "/aplikasi_cpi/dashboard.php?module=cpi&periode="+periode;
				}
			}
		})
	}
</script>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Proses Perhitungan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Perhitungan</li>
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
										<!-- <option value=""></option> -->
										<option value="2023">2023</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<input type="button" onclick="hitungData()" name="cetak_rank" class="btn btn-primary" value="Hitung">
									<input type="button" onClick="perhitungan()" name="cetak_rank" class="btn btn-primary" value="Tampil">
								</div>
							</div>
					</div>	
			</div>
		</div>
	</div>
</section>