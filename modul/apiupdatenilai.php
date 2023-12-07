<?php

    include("../koneksi.php");

   
    $periode = $_POST["periode"];
    $nilaiAkhir = 0;

    $query=mysqli_query($koneksi, "SELECT * FROM kriteria");
	while($data=mysqli_fetch_array($query)){
    $stmtx = mysqli_query($koneksi, "select * from kinerja INNER JOIN guru ON kinerja.id_guru =guru.id_guru WHERE kinerja.periode = '$periode'");
    $noxx = 1;
    while($rowx = mysqli_fetch_array($stmtx)){
        $stmt3x = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$data[id_kriteria]'"); 
        while($row3x = mysqli_fetch_array($stmt3x)){
            $max=0;
            
            $sql=mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria='$row3x[id_kriteria]'");
            while($r=mysqli_fetch_array($sql)){
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
            $stmt4x = mysqli_query($koneksi, "select * from nilai where id_kriteria='".$row3x['id_kriteria']."' and id_kinerja='".$rowx['id_kinerja']."'");
            while($row4x = mysqli_fetch_array($stmt4x)){
                
                if($row3x["tren"]=="Positif"){
                    $nilai=$row4x["nilai"]/$min *100;
                }elseif($row3x["tren"]=="Negatif"){
                    $nilai=$min/$row4x["nilai"] *100;
                }
                mysqli_query($koneksi, "UPDATE `nilai` SET `nil_hitung`= '$nilai' WHERE id_nilai = '$row4x[id_nilai]'");
                
            }
        }
    }
}
    
    $queryNilAkhir = mysqli_query($koneksi, "SELECT * FROM kinerja INNER JOIN guru on kinerja.id_guru = guru.id_guru WHERE kinerja.periode = '$periode'");
    while($resDataNil = mysqli_fetch_assoc($queryNilAkhir)){

        $cpi = 0;
        $querynilai = mysqli_query($koneksi, "SELECT * FROM nilai INNER JOIN kriteria ON kriteria.id_kriteria = nilai.id_kriteria WHERE id_kinerja = '$resDataNil[id_kinerja]'");
        while($datas = mysqli_fetch_assoc($querynilai)){
        $cpi=$cpi + ($datas["nil_hitung"]*($datas["bobot"]/100));
        
    
        }
        mysqli_query($koneksi, "UPDATE `kinerja` SET `nil_akhir`= '$cpi' WHERE id_kinerja = '$resDataNil[id_kinerja]'");
    }
        
    $array = array("message" => "success");
    echo json_encode($array);
   

?>

