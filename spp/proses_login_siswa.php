<?php
session_start();
require_once("koneksi.php");
// Kita akan membuat proses login nya disini
if(isset($_POST['login'])){
    $nisn = $_POST['nisn'];
    $cari = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $hasil = mysqli_fetch_assoc($cari);
        // Jika data yang dicari kosong
        if(mysqli_num_rows($cari) == 0){
            echo "<script>alert('NISN Belum Terdaftar!');
                window.location.href = 'login_siswa.php';
                </script>";
        }else{
        // Jika nisn siswa sesuai dengan database maka akan redirect ke halaman utama dan akan dibuatkan sesi
            $_SESSION['nisn'] = $_POST['nisn'];
            $_SESSION['login_siswa']=true;
            header("location: index_siswa.php");
        }
}
?>