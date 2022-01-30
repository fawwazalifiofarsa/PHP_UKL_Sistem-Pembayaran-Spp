<?php
session_start();
require_once("koneksi.php");
$nisn = $_SESSION['nisn'];
if(!isset($_SESSION['nisn'])){
    header("location: login_siswa.php");
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa 
JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
WHERE nisn='$nisn'");
$result = mysqli_fetch_assoc($siswa);
$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran 
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN spp ON pembayaran.id_spp = spp.id_spp
WHERE nisn='$nisn'
ORDER BY tgl_bayar");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Halaman Utama</title>
</head>
<body>
    <?php include "header_siswa.php"; ?>
    <div class="biodata"><h3 class="h3">Biodata</h3></div>
        <div class="form">
            <table cellpadding="10" style="text-align:left; margin:0 auto; background:#FF6363; color:#fff; border-radius: 15px;">
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td><?= $result['nisn']; ?></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><?= $result['nis']; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $result['nama']; ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?= $result['nama_kelas'] . " | " . $result['jurusan']; ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="history"><h3 class="h3" style="margin-top:-80px;">History Transaksi</h3></div>
        <table class="table table-bordered" style="background-color:#fff; color:#000;width: 70%;margin: 0 auto;text-align:center; font-family: 'Poppins', sans-serif; margin-bottom:-30px;">
        <thead style="background:#FF6363; color:#fff;">
            <tr>
                <td>No. </td>
                <td>Tanggal Pembayaran</td>
                <td>Pembayaran Melalui</td>
                <td>Tahun SPP | Nominal yang harus dibayar</td>
                <td>Jumlah yang sudah dibayar</td>
                <td>Status</td>
            </tr>
        </thead>
                <?php 
                $no=1;
                while($r_trx = mysqli_fetch_array($pembayaran)){ ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $r_trx['tgl_bayar'] . " " . $r_trx['bulan_dibayar'] . " " .
                        $r_trx['tahun_dibayar']; ?></td>
                <td><?= $r_trx['nama_petugas']; ?></td>
                <td><?= $r_trx['tahun'] . " | Rp. " . $r_trx['nominal']; ?></td>
                <td><?= "Rp. " . $r_trx['jumlah_bayar']; ?></td>
                <?php
                if($r_trx['jumlah_bayar'] >= $r_trx['nominal']){ ?>
                    <td><font style="color: darkgreen; font-weight: bold;">LUNAS</font></td>
                <?php }else{ ?> 
                    <td><font style="color: red; font-weight: bold;">BELUM LUNAS</font></td>
                <?php } ?>
            </tr>
            <?php $no++; }?>
        </table>
        <br><br>
        <?php 
        session_unset();
        include "footer.html" ?>