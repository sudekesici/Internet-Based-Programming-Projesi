<?php
session_start();
include("ayar.php");

if(isset($_SESSION['kullanici'])){
    header("Location: anasayfa.php");
    exit();
}

if(isset($_SESSION['email'])){
    header("Location: anasayfa.php");
    exit();
}

$email = isset($_POST['email']) ? $_POST['email'] : '';

if(isset($_POST['submit'])){
    $kullanici = $_POST['kullanici'];
    $sifre = $_POST['sifre'];

    $kullanici_tablo = 'kullanici';
    $standartkullanici_tablo = 'standartkullanici';

    $admin_sql = "SELECT * FROM $kullanici_tablo WHERE kullanici='$kullanici' AND sifre='$sifre'";
    $admin_result = $baglan->query($admin_sql);

    if ($admin_result->num_rows > 0) {
        $_SESSION['kullanici'] = $kullanici;
        header("Location: anasayfa.php");
        exit();
    }

    $standart_sql = "SELECT * FROM $standartkullanici_tablo WHERE email='$email' AND sifre='$sifre'";
    $standart_result = $baglan->query($standart_sql);

    if ($standart_result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("Location: anasayfa.php ");
        exit();
    }

   

    $baglan->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Giriş Sayfası</title>
    
</head>
<body>
    <div style="text-align:center;">
    <h1>Admin Giriş Sayfası</h1>
    <form method="POST" action="">
        <label for="kullanici">Kullanıcı Adı:</label>
        <input type="text" name="kullanici" autocomplete="off" required><br><br>
        <label for="sifre">Şifre:</label>
        <input type="password" name="sifre" autocomplete="off" required><br><br>
        <input type="submit" name="submit" autocomplete="off" value="Giriş">
    </form>

    <h1>Kullanıcı Giriş Sayfası</h1>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="text" name="email" autocomplete="off" required><br><br>
        <label for="sifre">Şifre:</label>
        <input type="password" name="sifre" autocomplete="off" required><br><br>
        <input type="submit" name="submit" autocomplete="off" value="Giriş">
    </form>
    </div>
</body>
</html>
