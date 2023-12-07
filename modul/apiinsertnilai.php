<?php

    include("../koneksi.php");

    $id_kinerja = $_POST["id_kinerja"]; 
    $id_kriteria = $_POST["id_kriteria"]; 
    $nilai = $_POST["nilai"]; 
    $nilai_akhir = $_POST["nilai_akhir"]; 

    $queryvalidation = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_kinerja = '$id_kinerja' AND id_kriteria = '$id_kriteria'");
    $jumlah = mysqli_num_rows($queryvalidation);

    if($jumlah > 0){
        $array = array("message" => "duplikat");
        echo json_encode($array);
    }else{
        $result = mysqli_query($koneksi, "INSERT INTO `nilai`(`id_kriteria`, `id_kinerja`, `nilai`, `nil_hitung`) VALUES ('$id_kriteria','$id_kinerja','$nilai','$nilai_akhir')");
        if($result){
            $array = array("message" => "success");
            echo json_encode($array);
        }else{
            $array = array("message" => "failed");
            echo json_encode($array);
        }
    }

    


?>

