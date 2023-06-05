<?php
    session_start();
    include("ayar.php");


    if ($_POST) {
        $aciklama = $_POST["aciklama"];
        $sorgu = $baglan->query("delete from hakkimizda");
        $sorgu = $baglan->query("insert into hakkimizda (aciklama) values ('$aciklama')");
        echo "<script> window.location.href='hakkimizda.php'; </script>";
    }

    $sorgu = $baglan->query("select * from hakkimizda");
    $satir = $sorgu->fetch_object();

    if ($satir) {
        // $satir değişkeni null değilse, "aciklama" özelliğini kullanabilirsiniz
        $aciklama = $satir->aciklama;
    } else {
        // $satir değişkeni null ise, bir hata durumu oluştuğunu belirtebilir veya gerekli işlemleri yapabilirsiniz
        $aciklama = ""; // Varsayılan bir değer atayabilirsiniz veya istediğiniz şekilde işlemleri yapabilirsiniz
    }
    

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Hakkımızda</title>
</head>
<body style="text-align:center;">

    <div style="text-align:center;">
    <a href="anasayfa.php">ANA SAYFA</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="duyurular.php">DUYURULAR</a> - <a href="kullanicikayit.php">KULLANICI KAYDETME</a> -<a href="projekayit.php">PROJE  KAYDETME</a> - <a href="cikis.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <form action="hakkimizda.php" method="post">
        <b>İçerik:</b><br><br>
        <textarea style="width:80%;height:300px;" name="aciklama"><?php echo $aciklama; ?></textarea><br><br>
        <input type="submit" value="Kaydet" >
    </form>

    

</body>
</html>