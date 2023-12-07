<?php

    include("../koneksi.php");

    $id_kinerja = $_POST["id_kinerja"]; 
    $tgl_kinerja = date("Y-m-d"); 
    $periode = $_POST["periode"]; 
    $nilai_akhir = $_POST["nil_akhir"]; 
    $id_guru = $_POST["id_guru"]; 
    $id_user = $_POST["id_user"]; 

    $result = mysqli_query($koneksi, "INSERT INTO `kinerja`(`id_kinerja`, `tgl_kinerja`, `periode`, `nil_akhir`, `id_guru`, `id_user`) VALUES ('$id_kinerja','$tgl_kinerja','$periode','$nilai_akhir','$id_guru','$id_user')");
    if($result){
        $array = array("message" => "success");
        echo json_encode($array);
    }else{
        $array = array("message" => "failed");
        echo json_encode($array);
    }


?>

