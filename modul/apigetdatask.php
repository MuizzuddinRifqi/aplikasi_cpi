<?php

    include("../koneksi.php");

    $periode = $_POST["periode"]; 

    $result = mysqli_query($koneksi, "SELECT nilai.id_kriteria AS id_kriteria, nilai.id_kinerja AS id_kinerja, kinerja.Periode AS periode, guru.nm_guru AS nm_guru, kriteria.nm_kriteria AS nm_kriteria, nilai.nilai AS nilai, kriteria.tren AS tren FROM guru, kinerja, nilai, kriteria WHERE guru.id_guru=kinerja.id_guru AND kinerja.id_kinerja=nilai.id_kinerja AND nilai.id_kriteria=kriteria.id_kriteria AND kinerja.periode = '$periode'");
    $array = array("data" => $result);
    echo json_encode($array);


?>

