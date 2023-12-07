<?php
    include("../../koneksi.php");

    $no_sk = $_GET["no_sk"];

    $querysk = mysqli_query($koneksi, "SELECT * FROM sk INNER JOIN kinerja ON sk.id_kinerja = kinerja.id_kinerja INNER JOIN guru ON kinerja.id_guru = guru.id_guru WHERE kinerja.id_guru=guru.id_guru AND sk.no_sk = '$no_sk'");
    $datask = mysqli_fetch_assoc($querysk);
?>
<script>
window.print();
</script>
<!DOCTYPE html>
<html>
    <head>
        <title>Cetak Hasil Surat Keputusan</title>
        <style>
            *{
                padding: 0px;
            }
            .header {
                width: 100%;
                text-align: center;
            }
            .title2 {
                font-size: 35px;
                width: 100%;
                margin-bottom: 6px;
            }
            .garis{
                width: 100%;
                height: 2px;
                margin-top: 30px;
                background: #000;
            }
            .content{
                width: 100%;
                padding: 10px 0px;
            }
        </style>
    </head>
    <body>
        <div class="header" >
            <p class="title2">SMP ABC-XYZ</p>
            <span>Jalan A, Kota B, Provinsi C, telepon 12345</span>
            <div class="garis"></div>
        </div>
        <hr>
        <div class="content">
        <center>
            <h3 style="margin-top: 30px">SURAT KEPUTUSAN PENILAIAN KINERJA GURU TERBAIK</h3>
            <p>No.SK : <?php echo $datask["no_sk"];?></p>
            </center>
            <p style="margin-top: 50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Berdasarkan perhitungan hasil kinerja guru yang telah dilakukan oleh tim penilai dan dengan pertimbangan oleh kepala sekolah maka guru yang data sebagai berikut :</p>
            
            <table style="width: 100%; margin-left: 40px; margin-top: 30px">
                <tr>
                    <td style="width: 15%">ID Guru</td>
                    <td > : &nbsp;&nbsp;<?php echo $datask["id_guru"];?></td>
                </tr>
                <tr>
                    <td >Nama Guru</td>
                    <td > : &nbsp;&nbsp;<?php echo $datask["nm_guru"];?></td>
                </tr>
                <tr>
                    <td >Alamat</td>
                    <td > : &nbsp;&nbsp;<?php echo $datask["alamat"];?></td>
                </tr>
                <tr>
                    <td >Nilai</td>
                    <td > : &nbsp;&nbsp;<?php echo $datask["nil_akhir"];?></td>
                </tr>
            </table>
            <p style="margin-top: 30px">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Telah terpilih sebagai Guru Dengan Kinerja Terbaik pada periode tahun <?php echo $datask["periode"];?> di SMP ABC-XYZ. 
            </p>
            <div style="float: right; margin-right: 30px; text-align: center;">
                kota, <?php echo date("d-m-Y");?>


                <p style="margin-top: 100px">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
            </div>
        </div>
    </body>
</html>
