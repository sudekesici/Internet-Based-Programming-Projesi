
<?php
session_start();
include("ayar.php");

if (!isset($_SESSION["giris"]) || !isset($_SESSION["email"])) {
    echo "<script> alert('Yetkisiz erişim!'); window.location.href='index.php'; </script>";
    exit();
}

$email = $_SESSION["email"];

// Kullanıcı bilgilerini veritabanından al
$sorgu = $baglan->prepare("SELECT * FROM standartkullanici WHERE email=?");
$sorgu->bind_param("s", $email);
$sorgu->execute();
$sonuc = $sorgu->get_result();

if ($sonuc->num_rows > 0) {
    $kullanici_bilgileri = $sonuc->fetch_assoc();
} else {
    echo "<script> alert('Kullanıcı bulunamadı!'); window.location.href='index.php'; </script>";
    exit();
}

// Şifre güncelleme formuna verileri işle
if ($_POST) {
    $yeni_sifre = $_POST["yeni_sifre"];

    // Yeni şifreyi güncelle
    $sorgu = $baglan->prepare("UPDATE standartkullanici SET sifre=? WHERE email=?");
    $sorgu->bind_param("ss", $yeni_sifre, $email);
    $sorgu->execute();

    echo "<script> alert('Şifre güncellendi!'); window.location.href='kullanici_profil.php'; </script>";
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kullanıcı Profili</title>
</head>
<body style="text-align:center;padding-top:50px;">
    <h1>Kullanıcı Profili</h1>
    <h3>Merhaba, <?php echo $kullanici_bilgileri["email"]; ?></h3>
    
    <h4>Şifre Güncelle</h4>
    <form action="" method="post">
        <b>Yeni Şifre:</b><br>
        <input type="password" name="yeni_sifre" size="30" autocomplete="off" required><br><br>
        <input type="submit" value="Şifre Güncelle" autocomplete="off">
    </form>

    <br><br>
    <a href="cikis.php">Çıkış Yap</a>
</body>
</html>

