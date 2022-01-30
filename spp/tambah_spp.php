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
        <title>Tambah SPP</title>
    </head>
    <body>
        <h3 class="h3">Tambah SPP</h3>
        <form action="" method="POST">
            <div class="form">
                <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                    <tr>
                        <td>Tahun :</td>
                        <td><input type="text" name="tahun" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Nominal :</td>
                        <td><input type="text" name="nominal" class="form-control"></td>
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
// Proses Simpan
if(isset($_POST['simpan'])){
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $simpan = mysqli_query($conn, "INSERT INTO spp VALUES(NULL, '$tahun', '$nominal')");
        if($simpan){
            header("location: spp.php");
        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }
}
?>