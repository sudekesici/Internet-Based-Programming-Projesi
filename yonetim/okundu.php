<?php
// Veritabanı bağlantısını ayar.php dosyasından alalım
require_once 'ayar.php';

// POST verisini alalım
$mesaj_id = $_POST['mesaj_id'];

// Okundu olarak işaretleme işlemini gerçekleştirelim
$sql = "UPDATE iletisim SET okundu = 1 WHERE id = '$mesaj_id'";

if (mysqli_query($baglan, $sql)) {
    echo "Mesaj okundu olarak işaretlendi!";
} else {
    echo "Okundu olarak işaretleme işlemi başarısız oldu: " . mysqli_error($conn);
}

// Veritabanı bağlantısını kapatma
mysqli_close($baglan);
?>
