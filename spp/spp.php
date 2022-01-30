<?php
include "require.php";
if($_SESSION['level']!='admin'){
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Data SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Data SPP</title>
</head>
<body>
    <?php include "header.php";?>
    <h3 class="h3">SPP</h3>
    <p class="p"><a href="tambah_spp.php" style="text-decoration: none; color: #fff;">Tambah Data</a></p><br>
    <table class="table table-bordered" style="background-color:#fff; color:#000;width: 70%;margin: 0 auto;text-align:center; font-family: 'Poppins', sans-serif; ">
        <thead style="background:#FF6363; color:#fff; ">
        <tr>
            <td>No. </td>
            <td>Tahun</td>
            <td>Nominal</td>
            <td>Aksi</td>
        </tr>
        </thead> 
        <?php
        // Kita panggil tabel spp
        $sql = mysqli_query($conn, "SELECT * FROM spp ORDER BY tahun");
        $no = 1;
        while($r = mysqli_fetch_assoc($sql)){ ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $r['tahun']; ?></td>
                <td><?= "Rp. " . $r['nominal']; ?></td>
                <td><a href="?hapus&id=<?= $r['id_spp']; ?>">Hapus</a> | 
                    <a href="edit_spp.php?id=<?= $r['id_spp']; ?>">Edit</a</td>
            </tr>
        <?php $no++; } ?>
    </table>
    <br><br>
</body>
<?php include "footer.html"; ?>
</html>
<?php
// Tombol Hapus ditekan
if(isset($_GET['hapus'])){
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM spp WHERE id_spp='$id'");
    if($hapus){
        header("location: spp.php");
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>