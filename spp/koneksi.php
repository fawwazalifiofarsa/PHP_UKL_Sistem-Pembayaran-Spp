<?php
$conn = mysqli_connect('127.0.0.1','root','','latihan_ukk');
if(mysqli_connect_error()){
    printf('Connection failed: '.mysqli_connect_error());
    exit();
}