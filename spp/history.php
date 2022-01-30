<?php
include "require.php";
if($_SESSION['level']=='petugas' || $_SESSION['level']=='admin'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>History Pembayaran</title>
</head>
<body>
<?php include "header.php"; ?>
    <?php
    // Kita lakukan proses pencariannya disini
    if(isset($_POST['cari'])){
        $nisn = $_POST['nisn'];
        // Kita panggil table siswa
        $biodataSiswa = mysqli_query($conn, "SELECT * FROM siswa 
                        JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
                        WHERE nisn='".$nisn."'");
        // Table pembayaran wajib kita panggil
        $historyPembayaran = mysqli_query($conn, "SELECT * FROM pembayaran
                            JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas
                            JOIN spp ON pembayaran.id_spp=spp.id_spp
                            WHERE nisn='".$nisn."'
                            ORDER BY tgl_bayar");
        $r_siswa = mysqli_fetch_array($biodataSiswa);
        if(mysqli_num_rows($biodataSiswa)>0){
            
    ?>
    <!-- Kita tampilkan Biodata Siswa -->
        <h3 class="h3">Biodata Siswa</h3>
        <div class="form">
            <table cellpadding="10" style="text-align:left; margin:0 auto; background:#FF6363; color:#fff; border-radius: 15px;">
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td><?= $r_siswa['nisn']; ?></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><?= $r_siswa['nis']; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $r_siswa['nama']; ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?= $r_siswa['nama_kelas'] . " | " . $r_siswa['jurusan']; ?></td>
                </tr>
            </table>
        </div>
        <br>
        <h3 class="h3" style="margin-top:-80px;">History Transaksi</h3>
        <!-- Sekarang kita tampilkan history pembayarannya -->
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
                while($r_trx = mysqli_fetch_array($historyPembayaran)){ ?>
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
        <?php }else{
            echo "<script>alert('Data tidak ditemukan');location.href='history.php';</script>";
        }} ?>
        <h3 class="h3">History Pembayaran Siswa</h3>
        <form action="" method="POST" autocomplete="off">
            <div class="form">
                <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                    <tr>
                        <td>Cari Siswa</td>
                        <td><input type="text" name="nisn" class="form-control" placeholder="Cari berdasarkan NISN" autofocus></td>
                    </tr>
                </table>
                <div class="submit">
                    <input type="submit" name="cari" class="p" value="Cari Siswa" class="submit"><br>
                </div>
            </div>
        </body>
        <br>
    <?php 
    include "footer.html"; 
    }else{
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
    }?>
</html>
