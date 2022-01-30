<?php
include "require.php";
if($_SESSION['level']!='admin'){
    echo "<script>alert('Hak akses tidak benar');location.href='login.php';</script>";
}
$id = $_GET['id'];
$spp = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp='$id'");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <title>Edit data SPP</title>
    </head>
    <body>
        <h3 class="h3">Edit data SPP</h3>
        <?php
        while($row = mysqli_fetch_array($spp)){?>
        <form action="" method="POST">
            <div class="form">
                <table cellpadding="10" style="text-align:right; margin: 0 auto;">
                        <input type="hidden" name="id" value="<?= $row['id_spp']; ?>">
                        <tr>
                            <td>Tahun :</td>
                            <td><input type="text" name="tahun" value="<?= $row['tahun']; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Nominal :</td>
                            <td><input type="text" name="nominal" value="<?= $row['nominal']; ?>" class="form-control"></td>
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
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $update = mysqli_query($conn, "UPDATE spp SET tahun='$tahun', nominal='$nominal'
                                 WHERE spp.id_spp='$id'");
        if($update){
            header("location: spp.php");
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>