<?php
    session_start();
    include("ayar.php");

    

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Ana Sayfa</title>
</head>
<body>

    <div style="text-align:center;">
    <a href="anasayfa.php">ANA SAYFA</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="duyurular.php">DUYURULAR</a> - <a href="kullanicikayit.php">KULLANICI KAYDETME</a> -<a href="projekayit.php">PROJE  KAYDETME</a> -<a href="mesajlar.php">MESAJLAR</a>- <a href="cikis.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <h2 style="text-align:center; color:blue"> Menüden Seçim Yapınız </h2>

    

</body>
</html>