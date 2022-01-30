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
    <title>Tambah Data Transaksi</title>
</head>
<body>
    <h3 class="h3">Tambah data transaksi</h3>
    <form action="" method="POST">
        <div class="form">
            <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                <tr>
                    <td>Petugas :</td>
                    <td><select name="petugas" class="form-control">
                        <option value="">-</option>
                        <?php
                        $petugas = mysqli_query($conn, "SELECT * FROM petugas");
                        while($r = mysqli_fetch_assoc($petugas)){ ?>
                                                <option value="<?= $r['id_petugas']; ?>"><?= $r['nama_petugas']; ?></option>
                        <?php } ?>          </select>
                    </td>
                </tr>
            <tr>
                <td>Nama siswa :</td>
                <td><select name="siswa" class="form-control">
                    <option value="">-</option>
                    <?php
                    // Sekarang kita ambil NISN Siswa 
                    $siswa = mysqli_query($conn, "SELECT * FROM siswa");
                    while($r = mysqli_fetch_assoc($siswa)){ ?>
                                            <option value="<?= $r['nisn']; ?>"><?= $r['nama']; ?></option>
                    <?php } ?>          </select>
                </td>
            </tr>   
            <tr>
                <td>Tgl. / Bulan / Tahun bayar :</td>
                <td><input type="text" name="tgl" size="5" placeholder="Tanggal." class="form-control">
                    <input type="text" name="bulan" size="10" placeholder="Bulan." class="form-control">
                    <input type="text" name="tahun" size="5" placeholder="Tahun." class="form-control"></td>
            </tr>
            <tr>
                <td>SPP / Nominal yang harus dibayar :</td>
                <td><select name="spp" class="form-control">
                    <option value="">-</option>
                    <?php
                    $spp = mysqli_query($conn, "SELECT * FROM spp");
                    while($r = mysqli_fetch_assoc($spp)){ ?>
                                            <option value="<?= $r['id_spp']; ?>">
                                            <?= $r['tahun'] . " | " . $r['nominal']; ?></option>
                    <?php } ?>          </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah bayar :</td>
                <td><input type="text" name="jumlah" placeholder="1000000" class="form-control"></tdd>
            </tr>
            <div class="submit">
                <input type="submit" name="simpan" class="button" value="Submit"><br>
            </div>
        </div>
    </form>
</body>
</html>
<?php
// Kita simpan proses simpan datanya disini
if(isset($_POST['simpan'])){
    $petugas = $_POST['petugas'];
    $nisn = $_POST['siswa'];
    $tgl_bayar = $_POST['tgl']; 
    $bulan_spp = $_POST['bulan']; 
    $tahun_spp = $_POST['tahun'];
    $spp = $_POST['spp'];
    $jumlah = $_POST['jumlah'];
    $cek = mysqli_query($conn, "SELECT * FROM pembayaran WHERE nisn='".$nisn."'");
    $ambil = mysqli_fetch_array($cek);
    if($spp == $ambil['id_spp']){
        echo "<script>alert('Tahun spp tersebut sudah ada pada siswa');</script>";
    }else{
    $s = mysqli_query($conn,"INSERT INTO pembayaran VALUES
                (NULL, '$petugas', '$nisn', '$tgl_bayar', '$bulan_spp', '$tahun_spp', '$spp','$jumlah')");
    // Arahkan ke menu transaksi
    if($s){
        header("location: transaksi.php"); 
    }else{
        echo "<script>alert('gagal');</script>";
    }}}
}else{
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}?>