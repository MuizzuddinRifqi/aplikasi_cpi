<?php

    include("../koneksi.php");

    $id = $_POST["id"]; 

    $result = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE kriteria.id_kriteria = '$id'");
    $user_data = mysqli_fetch_assoc($result);
    $array = array("tren" => $user_data["tren"], "bobot" => $user_data["bobot"]);
    echo json_encode($array);


?>

