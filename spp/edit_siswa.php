<?php
include "require.php";
if($_SESSION['level']!='admin'){
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}
$nisnSiswa = $_GET['nisn'];
$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '".$nisnSiswa."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Edit Data Siswa</title>
</head>
<body>
    <h3 class="h3">Edit Data Siswa</h3>
    <?php 
    while($row = mysqli_fetch_assoc($siswa)){ ?>    
    <form action="" method="POST">
        <div class="form">
            <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                <input type="hidden" name="nisn" value="<?= $row['nisn']; ?>">
                <tr>
                    <td>Nama :</td>
                    <td><input type="text" name="nama" value="<?= $row['nama']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Kelas :</td>
                    <td><select name="kelas" class="form-control">
                    <?php 
                    $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                    while($r = mysqli_fetch_array($kelas)){ ?>
                        <option value="<?= $r['id_kelas']; ?>">
                            <?= $r['nama_kelas'] . " | " . $r['jurusan']; ?>
                        </option>
                        <?php } ?>
                    </select></td>
                </tr>
                <tr>
                    <td>Alamat :</td>
                    <td><input type="text" name="alamat" value="<?= $row['alamat']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>No. Telp :</td>
                    <td><input type="text" name="no_tlp" value="<?= $row['no_tlp']; ?>" class="form-control"></td>
                </tr>
            </table>
            <div class="submit">
                <input type="submit" name="simpan" class="button" value="Submit"><br>
            </div>
        </div>
    </form>
    <?php } ?>
</body>
</html>
<?php
if(isset($_POST['simpan'])){
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no_tlp'];
    $simpan = mysqli_query($conn,   "UPDATE siswa SET nama = '".$nama."', id_kelas = '".$kelas."', 
                                    alamat = '".$alamat."', no_tlp = '".$no."' 
                                    WHERE siswa.nisn='".$nisn."'");
    if($simpan){
        header("location: siswa.php");
    }else{
        echo "<script>alert('Data sudah ada')</script>";
    }
}
?>