<?php
// Veritabanı bağlantısı için gerekli ayarları burada yapabilirsiniz
$servername = "localhost";
$username = "Sude";
$password = "1234";
$dbname = "deneme";


// Veritabanı bağlantısı oluşturmak için gerekli kod
$baglan = mysqli_connect($servername, $username, $password, $dbname);
$baglan->set_charset("utf8");

// Bağlantı hatası kontrolü
if (!$baglan) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}
?>
