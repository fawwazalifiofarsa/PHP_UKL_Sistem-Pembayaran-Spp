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
    <title>CRUD Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Data Siswa</title>
</head>
<body> 
    <?php include "header.php"; ?>
    <h3 class="h3">Siswa</h3>
    <p class="p"><a href="tambah_siswa.php" style="text-decoration: none; color: #fff;">Tambah Data</a></p><br>
    <table class="table table-bordered" style="background-color:#fff; color:#000;width: 70%;margin: 0 auto;text-align:center; font-family: 'Poppins', sans-serif; ">
        <thead style="background:#FF6363; color:#fff; ">
        <tr>
            <td>No.</td>
            <td>NISN</td>
            <td>NIS</td>
            <td>Nama Siswa</td>
            <td>Kelas</td>
            <td>Alamat</td>
            <td>No. Telp</td>
            <td>Aksi</td>
        </tr>
        </thead>
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas");
        $no = 1;
        while($r = mysqli_fetch_array($sql)){ ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $r['nisn']; ?></td>
                <td><?= $r['nis']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td><?= $r['id_kelas']; ?></td>
                <td><?= $r['alamat']; ?></td>
                <td><?= $r['no_tlp']; ?></td>
                <td><a href="?hapus&nisn=<?= $r['nisn']; ?>">Hapus</a> | 
                    <a href="edit_siswa.php?nisn=<?= $r['nisn'];?>">Edit</a></td>
            </tr>
        <?php $no++; } ?>
    </table>
    <br><br>
</body>
<?php include "footer.html"; ?>
</html>
<?php
if(isset($_GET['hapus'])){
    $nisn = $_GET['nisn'];
    $hapus = mysqli_query($conn, "DELETE FROM siswa WHERE nisn = '".$nisn."'");
    if($hapus){
        header("location: siswa.php");
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>