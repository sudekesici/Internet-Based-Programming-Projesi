<!DOCTYPE html>
<html>
<head>
    <title>İletişim Mesajları</title>
</head>
<body>
    <h1>İletişim Mesajları</h1>

    <?php
    // Veritabanı bağlantısını ayar.php dosyasından alalım
    require_once 'ayar.php';

    // İletişim mesajlarını sorgulayalım
    $sql = "SELECT * FROM iletisim";
    $result = mysqli_query($baglan, $sql);

    // Mesajları listeleyelim
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $mesaj_id = $row['id'];
            $isim = $row['isim'];
            $tel = $row['tel'];
            $mail = $row['mail'];
            $mesaj = $row['mesaj'];
            $cevap = $row['cevap'];
            $okundu = $row['okundu'];

            // Mesajı görüntüleme kodu
            echo "<h3>İsim: $isim</h3>";
            echo "<p>Telefon: $tel</p>";
            echo "<p>Mail: $mail</p>";
            

            // Cevap varsa gösterme kodu
            if (!empty($cevap)) {
                echo "<p>Cevap: $cevap</p>";
            }

            // Okundu durumunu gösterme kodu
            if ($okundu == 1) {
                echo "<p>Okundu: Evet</p>";
            } else {
                echo "<p>Okundu: Hayır</p>";
            }

            echo "<hr>";
        }
    } else {
        echo "<p>Henüz iletişim mesajı bulunmamaktadır.</p>";
    }

    // Veritabanı bağlantısını kapatma
    mysqli_close($baglan);
    ?>
</body>
</html>
