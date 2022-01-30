<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/header.css">
</head>
<?php 
    if($_SESSION['status_login']!=true){
        header('location: login.php');
    }
?>
<header>
<?php
include "koneksi.php";
$detail = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '".$_SESSION['username']."'");
$data = mysqli_fetch_array($detail);
if($data['level'] == "admin"){ ?>
  <a href="index.php" class="logo">SKOLA</a>
  <ul>
    <li><a href="siswa.php">Data Siswa</a></li>
    <li><a href="petugas.php">Data Petugas</a></li>
    <li><a href="kelas.php">Data Kelas</a></li>
    <li><a href="spp.php">Data SPP</a></li>
    <li><a href="transaksi.php">Transaksi</a></li>
    <li><a href="history.php">History Pembayaran</a></li>
    <li><a href="#" onclick="logout()">Log Out</a></li>
  </ul>
<?php
}else if($data['level'] == "petugas"){ ?>
  <a href="index.php" class="logo">SKOLA</a>
    <ul>
      <li><a href="transaksi.php">Transaksi</a></li>
      <li><a href="history.php">History Pembayaran</a></li>
      <li><a href="#" onclick="logout()">Log Out</a></li>
    </ul>
<?php } ?>
</header>
<script type="text/javascript">
  window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 100);
  })
  function logout(){
    if(confirm("Yakin Ingin Log Out?") == true){
      window.location.href = "login.php";
    }
  }
</script>
<!-- <body>
  <h3>Selamat datang, <?=$_SESSION['username']?></h3>
</body> -->