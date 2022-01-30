<?php
include "require.php";
if($_SESSION['level']!='admin'){
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}
$id = $_GET['id'];
$petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='".$id."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Edit Data Petugas</title>
</head>
<body>
    <h3 class="h3">Edit Data Petugas</h3>
<?php
while($row = mysqli_fetch_assoc($petugas)){?>
    <form action="" method="POST">
        <div class="form">
                <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                <input type="hidden" name="id" value="<?= $row['id_petugas']; ?>">
                <tr>
                    <td>Username :</td>
                    <td><input type="text" name="user" value="<?= $row['username']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="text" name="pass" value="<?= $row['password']; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Nama Petugas :</td>
                    <td><input type="text" name="nama" value="<?= $row['nama_petugas']; ?>" class="form-control"></td>
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
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $update = mysqli_query($conn, "UPDATE petugas SET username='".$user."',
                                 password='".$pass."', nama_petugas='".$nama."'
                                 WHERE petugas.id_petugas='$id'");
        if($update){
            header("location: petugas.php");
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>