<?php

    include("../koneksi.php");

    $id_kinerja = $_POST["id_kinerja"]; 
    $periode = $_POST["periode"];
    $resNosk = mysqli_query($koneksi, "SELECT * FROM sk ORDER BY no_sk DESC");
    $dataNoSK = mysqli_fetch_assoc($resNosk);
    $jumlah_data = mysqli_num_rows($resNosk);
    $nom_sk = $jumlah_data +1;
    $tanggal = date("Y-m-d");

    if($jumlah_data === 0){
        $no_sk = "SK/01/".$id_kinerja."/".date("m")."/".$periode;
    }else{
        $no_sk = "SK/0". $nom_sk ."/".$id_kinerja."/".date("m")."/".$periode;
    }

    $result = mysqli_query($koneksi, "INSERT INTO `sk`(`no_sk`, `tgl_sk`, `periode`, `id_kinerja`) VALUES ('$no_sk','$tanggal','$periode','$id_kinerja')");
    if($result){
        $array = array("message" => "success", "no_sk"=> $no_sk);
        echo json_encode($array);
    }else{
        $array = array("message" => "failed");
        echo json_encode($array);
    }


?>

