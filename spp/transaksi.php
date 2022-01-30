<?php
include "require.php";
if($_SESSION['level']=='petugas' || $_SESSION['level']=='admin'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Data Transaksi</title>
</head>
<body>
<?php include "header.php"; ?>
    <h3 class="h3">Data Transaksi</h3>
    <p class="p"><a href="tambah_transaksi.php" style="text-decoration: none; color: #fff;">Tambah Data</a></p><br>
    <table class="table table-bordered" style="background-color:#fff; color:#000;width: 80%;margin: 0 auto;text-align:center; font-family: 'Poppins', sans-serif;">
        <thead style="background:#FF6363; color:#fff; ">    
        <tr>
            <td>No. </td>
            <td>Nama Petugas</td>
            <td>Nama Siswa</td>
            <td>Tgl/Bulan/Tahun dibayar</td>
            <td>Tahun / Nominal harus dibayar</td>
            <td>Jumlah yang dibayar</td>
            <td>Status</td>
        </tr>
        </thead>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM pembayaran
        JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
        JOIN siswa ON pembayaran.nisn = siswa.nisn
        JOIN spp ON pembayaran.id_spp = spp.id_spp");
        $no = 1;
        while($r = mysqli_fetch_array($sql)){ ?>
         <tr>
            <td><?= $no ?></td>
            <td><?= $r['nama_petugas']; ?></td>
            <td><?= $r['nama']; ?></td>
            <td><?= $r['tgl_bayar'] . "/" . $r['bulan_dibayar'] . "/" . $r['tahun_dibayar']; ?></td>
            <td><?= $r['tahun'] . "/" . $r['nominal']; ?></td>
            <td><?= $r['jumlah_bayar']; ?></td>
            <td>
                <?php
                if($r['jumlah_bayar'] >= $r['nominal']){ ?> 
                                <font style="color: darkgreen; font-weight: bold;">LUNAS</font>
                <?php }else{ ?> <font style="color: red; font-weight: bold;">BELUM LUNAS</font><?php } ?>
            </td>
        </tr>
        <?php $no++; } ?>
    </table>
    <br><br>
<?php include "footer.html";
}else{
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}?>
</body>
</html>
<?php
// Ada siswa yang ingin membayar sisa pembayaran
if(isset($_GET['lunas'])){
    $id = $_GET['id'];
    $ambilData = mysqli_query($db, "SELECT * FROM pembayaran JOIN spp ON pembayaran.id_spp=spp.id_spp 
                                    WHERE id_pembayaran = '".$id."'");
    $row = mysqli_fetch_assoc($ambilData);
    $sisa = $row['nominal'] - $row['jumlah_bayar'];
    $hasil = $row['jumlah_bayar'] + $sisa;
    $update = mysqli_query($db, "UPDATE pembayaran SET jumlah_bayar='$hasil' WHERE id_pembayaran='".$id."'");
    if($update){
        header("location: transaksi.php");
    }
}?>