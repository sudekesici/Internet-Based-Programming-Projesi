<?php
// Veritabanı bağlantısını ayar.php dosyasından alalım
include("ayar.php");
// İletişim mesajlarını çekmek için SQL sorgusu
$sql = "SELECT * FROM iletisim";

// Sorguyu çalıştırma ve sonuçları almak
$result = mysqli_query($baglan, $sql);

// Sonuçları işleme
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $isim = $row['isim'];
        $tel = $row['tel'];
        $mail = $row['mail'];
        $mesaj = $row['mesaj'];
        $okundu = $row['okundu'];

        // İletişim mesajının bilgilerini burada kullanabilirsin
        // Örneğin, ekrana yazdırmak için:
        echo "Mesaj ID: " . $id . "<br>";
        echo "İsim: " . $isim . "<br>";
        echo "Telefon: " . $tel . "<br>";
        echo "E-posta: " . $mail . "<br>";
        echo "Mesaj: " . $mesaj . "<br>";
        echo "Okundu Durumu: " . ($okundu ? 'Okundu' : 'Okunmadı') . "<br>";

        // Cevaplama veya okundu olarak işaretlemek için formlar ekle
        echo '<form method="post" action="cevapla.php">';
        echo '<input type="hidden" name="mesaj_id" autocomplete="off" value="' . $id . '">';
        echo '<textarea name="cevap"></textarea>';
        echo '<input type="submit" autocomplete="off" value="Cevapla">';
        echo '</form>';

        echo '<form method="post" action="okundu.php">';
        echo '<input type="hidden" autocomplete="off" name="mesaj_id" value="' . $id . '">';
        echo '<input type="submit" autocomplete="off" value="Okundu Olarak İşaretle">';
        echo '</form>';

        echo "<hr>";
    }
} else {
    echo "Hiç iletişim mesajı bulunamadı.";
}

// Veritabanı bağlantısını kapatma
mysqli_close($baglan);
?>

