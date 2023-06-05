
<?php
session_start();
include("ayar.php");

if (isset($_GET["islem"])) {
    $islem = $_GET["islem"];

    if ($islem == "sil" && isset($_GET["id"])) {
        $id = $_GET["id"];
        $sorgu = $baglan->query("DELETE FROM portfolyo WHERE id='$id'");
        echo "<script>window.location.href='portfolyo.php';</script>";
    }

    if ($islem == "ekle") {
        if (isset($_POST["baslik"]) && isset($_FILES["resim"])) {
            $baslik = $_POST["baslik"];
            $resim = "img/" . $_FILES["resim"]["name"];
            move_uploaded_file($_FILES["resim"]["tmp_name"], $resim);
            $sorgu = $baglan->query("INSERT INTO portfolyo (baslik, resim)VALUES ('$baslik', '$resim')");
            echo "<script>window.location.href='portfolyo.php';</script>";
        }
        }
        }
        ?>
        
        <!doctype html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Yönetim Paneli Portfolyo</title>
        </head>
        <body style="text-align:center;">
        <div style="text-align:center;">
    <a href="anasayfa.php">ANA SAYFA</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="duyurular.php">HİZMETLERİMİZ</a> - <a href="cikis.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
    <br><hr><br><br>
</div>

<table width="100%" border="1">
    <tr align="center">
        <th>S. No</th>
        <th>Başlık</th>
        <th>Sil</th>
    </tr>
    <?php
        $sirano = 0;
        $sorgu = $baglan->query("SELECT * FROM portfolyo");
        while ($satir = $sorgu->fetch_object()) {
            $sirano++;
            echo "<tr align='center'>
            <td>$sirano</td>
            <td>$satir->baslik</td>
            <td><a href='portfolyo.php?islem=sil&id=$satir->id'>Sil</td>
            </tr>";
        }
    ?>
</table>

<br><br>

<form action="portfolyo.php?islem=ekle" enctype="multipart/form-data" method="post">
    <b>Başlık:</b><input type="text" size="20" name="baslik" autocomplete="off"> 
    <b>Resim:</b><input type="file" name="resim" autocomplete="off"> 
    <input type="submit" value="Kaydet" autocomplete="off">
</form>
</body>
</html>