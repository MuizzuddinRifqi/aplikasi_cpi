<?php

    include("../koneksi.php");

    $id = $_POST["id"]; 

    $result = mysqli_query($koneksi, "SELECT * FROM guru WHERE guru.id_guru = '$id'");
    $user_data = mysqli_fetch_assoc($result);
    $array = array("jk" => $user_data["jenkel"], "alamat" => $user_data["alamat"]);
    echo json_encode($array);


?>

