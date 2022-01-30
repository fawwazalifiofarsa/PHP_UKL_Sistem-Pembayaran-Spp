<?php
include "require.php";
if($_SESSION['level']!='admin'){
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}
$id = $_GET['id'];
$kelas = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Edit Data Kelas</title>
</head>
<body>
    <h3 class="h3">Edit data Kelas</h3>
<?php
while($row = mysqli_fetch_assoc($kelas)){?>
    <form action="" method="POST">
        <div class="form">
            <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                <input type="hidden" name="id" value="<?= $row['id_kelas']; ?>">
                <tr>
                    <td>Nama Kelas :</td>
                    <td><input type="text" name="nama" value="<?= $row['nama_kelas']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Kompetensi Keahlian :</td>
                    <td><input type="text" name="kk" value="<?= $row['jurusan']; ?>" class="form-control"></td>
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
// Proses update
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kk = $_POST['kk'];
    $update = mysqli_query($conn, "UPDATE kelas SET nama_kelas='$nama', jurusan='$kk'
                                 WHERE kelas.id_kelas='$id'");
        if($update){
            header("location: kelas.php");
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>