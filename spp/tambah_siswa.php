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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Tambah Siswa</title>
</head>
<body>
<h3 class="h3">Tambah Siswa</h3>
    <form action="" method="POST">
    <div class="form">
        <table cellpadding="10" style="text-align:right; margin: 0 auto;">
            <tr>
                <td>NISN :</td>
                <td><input type="text" name="nisn" class="form-control"></td>
                </tr>
                <tr>
                    <td>NIS :</td>
                    <td><input type="text" name="nis" class="form-control"></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><input type="text" name="nama" class="form-control"></td>
                </tr>
                <tr>
                    <td>Kelas :</td>
                    <td><select type="text" name="kelas" class="form-control">
                    <option value="">-</option>
                    <?php 
                    $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                    while($r = mysqli_fetch_array($kelas)){ ?>
                        <option value="<?= $r['id_kelas']; ?>"><?= $r['nama_kelas'] . " | " . $r['jurusan']; ?></option> }
                    <?php } ?>
                    </select></td>
                </tr>
                <tr>
                    <td>Alamat :</td>
                    <td><input type="text" name="alamat" class="form-control"></td>
                </tr>
                <tr>
                    <td>No. Telp :</td>
                    <td><input type="text" name="no_tlp" class="form-control"></td>
                </tr>
            </table>
            <div class="submit">
                <input type="submit" name="simpan" class="button" value="Submit"><br>
            </div>
        </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['simpan'])){
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no_tlp'];
    $simpan = mysqli_query($conn, "INSERT INTO siswa VALUES
    ('".$nisn."','".$nis."','".$nama."','".$kelas."','".$alamat."','".$no."')");
    if($simpan){
        header("location: siswa.php");
    }else{
        echo "<script>alert('Data sudah ada')</script>";
    }
}
?>