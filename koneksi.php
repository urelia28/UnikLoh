<?php
$koneksi = mysqli_connect("localhost","root","","butik");

if (mysqli_connect_errno()){
    echo "gagal koneksi database: ".mysqli_connect_error();
}
?>