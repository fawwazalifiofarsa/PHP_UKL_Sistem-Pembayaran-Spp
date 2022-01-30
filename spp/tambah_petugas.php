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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Tambah Petugas</title>
</head>
<body>
    <h3 class="h3">Tambah Petugas</h3>
    <form action="" method="POST">
        <div class="form">
            <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                <tr>
                    <td>Username :</td>
                    <td><input type="text" name="user" class="form-control"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="text" name="pass" class="form-control"></td>
                </tr>
                <tr>
                    <td>Nama :</td>
                    <td><input type="text" name="nama" class="form-control"></td>
                </tr>
            </table>
            <div class="submit">
                <input type="submit" name="simpan" class="button" value="Submit" class="submit"><br>
            </div>
        </div>
    </form>
</body>
</html>
<?php
// Proses Simpan
if(isset($_POST['simpan'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $simpan = mysqli_query($conn, "INSERT INTO petugas VALUES(NULL, '$user', '$pass', '$nama', 'Petugas')");
        if($simpan){
            header("location: petugas.php");
        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }
}
?>