<?php
// Veritabanı bağlantısını ayar.php dosyasından alalım
require_once 'ayar.php';

// POST verilerini alalım
$mesaj_id = $_POST['mesaj_id'];
$cevap = $_POST['cevap'];

// Cevapla işlemini gerçekleştirelim
$sql = "UPDATE iletisim SET cevap = '$cevap' WHERE id = '$mesaj_id'";

if (mysqli_query($baglan, $sql)) {
    echo "Mesaja cevap verildi!";
} else {
    echo "Cevap verme işlemi başarısız oldu: " . mysqli_error($conn);
}

// Veritabanı bağlantısını kapatma
mysqli_close($baglan);
?>