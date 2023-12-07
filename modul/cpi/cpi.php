<?php  
	error_reporting(0);
//kkosongkan tabel hasil terlebih dahulu
//mysqli_query($koneksi, "DELETE FROM hasil");
	$periode = $_GET["periode"];
	$queryAlert = mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru ON kinerja.id_guru = guru.id_guru WHERE kinerja.periode = '$periode'");
	$jumlhdata = mysqli_num_rows($queryAlert);

	if($jumlhdata === 0){
		echo "<script>alert('data ini tidak ada')</script>";
		echo "<script>document.location='/aplikasi_cpi/dashboard.php?module=perhitungan'</script>";
	}else{
		$querycek = mysqli_query($koneksi, "SELECT * FROM nilai INNER JOIN kinerja ON nilai.id_kinerja = kinerja.id_kinerja WHERE nilai.nil_hitung = '0' AND kinerja.periode = '$periode'");
		$jumdata = mysqli_num_rows($querycek);

		if($jumdata > 0){
			echo "<script>alert('data ini belum di hitung')</script>";
			echo "<script>document.location='/aplikasi_cpi/dashboard.php?module=perhitungan'</script>";
		}
	}
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Perhitungan Metode CPI</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?module=home">Home</a></li>
          <li class="breadcrumb-item active">Perhitungan Metode CPI</li>
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
            <!-- /.card-header -->
            <div class="card-body">
            	<b>Matrik Perbandingan Berpasangan (X)</b>
            	<table id="example" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th width="50">No</th>
						<th>Nama Guru</th>
			            <?php
			            $stmt2x = mysqli_query($koneksi, "select * from kriteria");
			            while($row2x = mysqli_fetch_array($stmt2x)){
			            ?>
						<th><?php echo $row2x['nm_kriteria'] ?></th>
			            <?php
			            }
			            ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>-</td>
						<td>Bobot</td>
			            <?php
			            $stmt2x1 = mysqli_query($koneksi, "select * from kriteria");
			            while($row2x1 = mysqli_fetch_array($stmt2x1)){
			            ?>
						<td><?php echo $row2x1['bobot'] ?> % ( <?php echo $row2x1['tren'] ?> )</td>
			            <?php
			            }
			            ?>
					</tr>
					<?php
					$stmtx = mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru ON kinerja.id_guru = guru.id_guru WHERE kinerja.periode = '$periode'");
					$noxx = 1;
					while($rowx = mysqli_fetch_array($stmtx)){
					?>
					<tr>
						<td><?php echo $noxx++ ?></td>
						<td><?php echo $rowx['nm_guru'] ?></td>
			            <?php
			            $stmt3x = mysqli_query($koneksi, "select * from kriteria");
			            
			            while($row3x = mysqli_fetch_array($stmt3x)){
			            ?>
						<td>
			                <?php
			                $stmt4x = mysqli_query($koneksi, "select * from nilai where id_kriteria='".$row3x['id_kriteria']."' and id_kinerja='".$rowx['id_kinerja']."'");
			                while($row4x = mysqli_fetch_array($stmt4x)){
			                	
			                    echo $row4x['nilai'];
			                    
			                }
			                ?>
			            </td>
			            <?php
			            }
			            ?>
					</tr>
					<?php
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Nilai Min</th>
			            <?php
			            $stmt3x = mysqli_query($koneksi, "select * from kriteria"); 
			            while($row3x = mysqli_fetch_array($stmt3x)){
			            	
			            		$min=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM nilai ORDER BY id_nilai ASC LIMIT 1"));
			            		$sql2=mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$row3x[id_kriteria]'");
			            		while ($r2=mysqli_fetch_array($sql2)) {
			            			
			            			if($min<$r2["nilai"]){
			            				$min=$min;
			            			}else{
			            				$min=$r2["nilai"];
			            			}
			            		}
			            ?>
						<th>
			                <?php echo $min; ?>
			            </th>
			            <?php
			            }
			            ?>
					</tr>
				</tfoot>
				</table>
				</table>

				<br>
				<b>Bobot Kepentingan (P) Dan Tren nya </b>

              <table id="example" class="table table-bordered table-striped">
                <thead>
					<tr>
						
						<th>Kriteria</th>
			            <?php
			            $stmt2x = mysqli_query($koneksi, "select * from kriteria");
			            while($row2x = mysqli_fetch_array($stmt2x)){
			            ?>
						<th><?php echo $row2x['nm_kriteria'] ?></th>
			            <?php
			            }
			            ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						
						<td>Bobot</td>
			            <?php
			            $stmt2x1 = mysqli_query($koneksi, "select * from kriteria");
			            while($row2x1 = mysqli_fetch_array($stmt2x1)){
			            ?>
						<td><?php echo $row2x1['bobot'] ?> %</td>
			            <?php
			            }
			            ?>
					</tr>
					<tr>
						
						<td>Tren</td>
			            <?php
			            $stmt2x1 = mysqli_query($koneksi, "select * from kriteria");
			            while($row2x1 = mysqli_fetch_array($stmt2x1)){
			            ?>
						<td><?php echo $row2x1['tren'] ?></td>
			            <?php
			            }
			            ?>
					</tr>
				</tbody>
				
				</table>

				<br>
				
				<?php  
					//kosongkan tabel hasil perhitungan kriteria
					// mysqli_query($koneksi, "DELETE FROM hasil_perhitungan_kriteria");
					$query=mysqli_query($koneksi, "SELECT * FROM kriteria");
					while($data=mysqli_fetch_array($query)){
						?>
						<h3>Perhitungan Nilai <?php echo $data["nm_kriteria"] ?></h3>
						<table id="example" class="table table-bordered table-striped">
		                <thead>
							<tr>
								<th width="50">No</th>
								<th>Nama Guru</th>
					            <?php
					            $stmt2x = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$data[id_kriteria]'");
					            while($row2x = mysqli_fetch_array($stmt2x)){
					            ?>
								<th colspan="3"><?php echo $row2x['nm_kriteria'] ?></th>
					            <?php
					            }
					            ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>-</td>
								<td></td>
								<td>Nilai N</td>
					            <?php
					            $stmt2x1 = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$data[id_kriteria]'");
					            $row2x1 = mysqli_fetch_array($stmt2x1);
					            ?>
								<td>
									<?php 
										if ($row2x1["tren"]=="Positif") {
											echo "Nilai N/Min";
										}else{
											echo "Min/Nilai N";
										}

									 ?>
							    </td>
					            
					            <?php
					            $stmt2x2 = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$data[id_kriteria]'");
					            $row2x2 = mysqli_fetch_array($stmt2x2)
					            ?>
								<td>
									<?php 
										if ($row2x2["tren"]=="Positif") {
											echo "Nilai N/Min * 100";
										}else{
											echo "Min/Nilai N * 100";
										}

									 ?>
							    </td>
					            
							</tr>

							<?php
							
							$stmtx = mysqli_query($koneksi, "select * from kinerja INNER JOIN guru ON kinerja.id_guru =guru.id_guru WHERE kinerja.periode = '$periode'");
							$noxx = 1;
							while($rowx = mysqli_fetch_array($stmtx)){
							?>
							<tr>
								<td><?php echo $noxx++ ?></td>
								<td><?php echo $rowx['nm_guru'] ?></td>
					            <?php
					            $stmt3x = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$data[id_kriteria]'"); 
					            while($row3x = mysqli_fetch_array($stmt3x)){
					            	$max=0;
					            	
					            	$sql=mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$row3x[id_kriteria]'");
					            	while($r=mysqli_fetch_array($sql)){
					            		$sql2=mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$r[id_kriteria]'");
					            		while ($r2=mysqli_fetch_array($sql2)) {
					            			if($max>$r2["nilai"]){
					            				$max=$max;
					            			}else{
					            				$max=$r2["nilai"];
					            			}
					            		}

					            		$min=mysqli_fetch_array(mysqli_query($koneksi, "SELECT nilai FROM nilai ORDER BY id_nilai ASC LIMIT 1"));
					            		$sql2=mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kriteria='$r[id_kriteria]'");
					            		while ($r2=mysqli_fetch_array($sql2)) {
					            			
					            			if($min<$r2["nilai"]){
					            				$min=$min;
					            			}else{
					            				$min=$r2["nilai"];
					            			}
					            		}
					            	}
					            ?>
								<td>
					                <?php
					                $stmt4x = mysqli_query($koneksi, "select * from nilai where id_kriteria='".$row3x['id_kriteria']."' and id_kinerja='".$rowx['id_kinerja']."'");
					                while($row4x = mysqli_fetch_array($stmt4x)){
					                    echo $row4x["nilai"];
					                }
					                ?>
					            </td>
					            <td>
					                <?php
					                $stmt4x = mysqli_query($koneksi, "select * from nilai where id_kriteria='".$row3x['id_kriteria']."' and id_kinerja='".$rowx['id_kinerja']."'");
					                while($row4x = mysqli_fetch_array($stmt4x)){
					                	
					                	if($row3x["tren"]=="Positif"){
					                		$nilai=$row4x["nilai"]/$min;
					                	}elseif($row3x["tren"]=="Negatif"){
					                		$nilai=$min/$row4x["nilai"];
					                	}
					                    echo $nilai;
					                    
					                }
					                ?>
					            </td>
					            <td>
					                <?php
					                $stmt4x = mysqli_query($koneksi, "select * from nilai where id_kriteria='".$row3x['id_kriteria']."' and id_kinerja='".$rowx['id_kinerja']."'");
					                while($row4x = mysqli_fetch_array($stmt4x)){
					                	
					                	if($row3x["tren"]=="Positif"){
					                		$nilai=$row4x["nilai"]/$min*100;
					                	}elseif($row3x["tren"]=="Negatif"){
					                		$nilai=$min/$row4x["nilai"]*100;
					                	}
					                    echo $nilai;
					                    //isert hasil perhitungan tiap kriteria masing masing alternatif
										//mysqli_query($koneksi, "INSERT INTO hasil_perhitungan_kriteria (id_alternatif, id_kriteria, hasil) VALUES ('$rowx[id_kinerja]', '$row3x[id_kriteria]','$nilai')");
										
					                }
					                ?>
					            </td>
					            <?php
					            }
					            ?>
							</tr>
							<?php

							}
							?>
						</tbody>
						
						</table>
						<br>
						<?php 
					}
				?>
              
			<h3>Perhitungan CPI</h3>
              <table id="example" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th width="50">No</th>
						<th>Nama Guru</th>
			            <th>Perhitungan CPI</th>
			            <th>Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php

					//kosongkan terlebih dahulu tabekl hasil
					//mysqli_query($koneksi, "DELETE FROM hasil");
					$stmtx = mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru on kinerja.id_guru = guru.id_guru WHERE kinerja.periode = '$periode'");
					$noxx = 1;
					while($rowx = mysqli_fetch_array($stmtx)){
						$cpi=0;
					?>
					<tr>
						<td><?php echo $noxx++ ?></td>
						<td><?php echo $rowx['nm_guru'] ?></td>
			            <td>	
			            <?php  
			            $no=1;
			            $r=mysqli_fetch_array(mysqli_query($koneksi,"SELECT count(id_kriteria) AS jumlah FROM kriteria"));
			            $batas=$r["jumlah"]-1;
						$querynilai = mysqli_query($koneksi, "SELECT * FROM nilai INNER JOIN kriteria ON kriteria.id_kriteria = nilai.id_kriteria WHERE id_kinerja = '$rowx[id_kinerja]'");
						while($datas = mysqli_fetch_assoc($querynilai)){
							echo"( ";
							echo $datas["nil_hitung"]." x ".$datas["bobot"]/100;
							echo " )";
							if($no<=$batas)
							{
								echo " + ";
							}
							$cpi=$cpi + ($datas["nil_hitung"]*($datas["bobot"]/100));
							$no++;
					
						}
						//insert ke tabel hasil
						// mysqli_query($koneksi, "INSERT INTO hasil (id_alternatif, hasil) VALUES ('$rowx[id_alternatif]', '$cpi')");
			            ?>
			            
			            </td>
			            <td><?php echo $cpi; ?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
				
				</table>
				<br>
				
				<br>
				<h3>Rangking</h3>
              <table id="example" class="table table-bordered table-striped">
                <thead>
					<tr>
						<th width="50">No</th>
						<th>Nama Guru</th>
			            <th>Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmtx = mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru ON kinerja.id_guru = guru.id_guru WHERE kinerja.periode = '$periode' ORDER BY nil_akhir DESC");
					$noxx = 1;
					while($rowx = mysqli_fetch_array($stmtx)){
					?>
					<tr>
						<td><?php echo $noxx++ ?></td>
						<td><?php echo $rowx['nm_guru'] ?></td>
						<td><?php echo $rowx['nil_akhir'] ?></td>
			            
					</tr>
					<?php } ?>
				</tbody>
				</table>
				<br>
				
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

	