<?php
$server = 'localhost';
$user = 'dbusr21360859046';
$password = '0o0dyFjlOVXh';
$database = 'dbstorage21360859046';
$baglanti = mysqli_connect($server,$user,$password,$database);
if (!$baglanti) {
echo "MySQL sunucu ile baglanti kurulamadi! </br>";
echo "HATA: " . mysqli_connect_error();
exit;
}
?>