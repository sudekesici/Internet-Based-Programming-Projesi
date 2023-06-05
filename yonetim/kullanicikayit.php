<?php
session_start();
include("ayar.php");



// Veritabanı bağlantısı için gereken bilgiler
$servername = "localhost";
$username = "Sude";
$password = "1234";
$dbname = "deneme";

// Veritabanı bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Kullanıcı kaydı
if (isset($_POST['kaydet'])) {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    
    // Veritabanına kullanıcıyı ekleme
    $sql = "INSERT INTO standartkullanici (email, sifre) VALUES ('$email','$sifre')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla kaydedildi.";
    } else {
        echo "Kayıt işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı güncelleme
if (isset($_POST['guncelle'])) {
    $id = $_POST['id'];
    $id = intval($id);
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    
    // Veritabanındaki kullanıcıyı güncelleme
    $sql = "UPDATE standartkullanici SET email='$email', sifre='$sifre' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla güncellendi.";
    } else {
        echo "Güncelleme işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı silme
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    
    // Veritabanından kullanıcıyı silme
    $sql = "DELETE FROM standartkullanici WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla silindi.";
    } else {
        echo "Silme işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı düzenleme için verileri çekme
if (isset($_GET['duzenle'])) {
    $id = $_GET['duzenle'];

    // Veritabanından kullanıcıyı seçme
    $sql = "SELECT id, email, sifre FROM standartkullanici WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $email = $row["email"];
        $sifre = $row["sifre"];
    } else {
        echo "Proje bulunamadı.";
    }
}

// Arama işlemi
if (isset($_GET['ara'])) {
    $   = $_GET['ara'];
    
    // Kullanıcıları filtrelemek için veritabanı sorgusunu güncelleme
    $sql = "SELECT id, email, sifre FROM standartkullanici WHERE email LIKE '%$aranan%' OR sifre LIKE '%$aranan%'";
} else {
    // Arama yapılmadığında tüm kullanıcıları listeleme
    $sql = "SELECT id, email, sifre FROM standartkullanici";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="duyurular.php">DUYURULAR</a> - <a href="kullanicikayit.php">KULLANICI KAYDETME</a> - <a href="projekayit.php">PROJE  KAYDETME</a> - <a href="cikis.php" onclick="if (!confirm(\'Çıkış Yapmak İstediğinize Emin misiniz?\')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>';
    echo '<section id="kullanicikayit">';
    echo '<h2>Kullanıcı Listesi</h2>';
    echo '<hr>';
    echo '<div class="temizle"></div>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Email</th><th>İşlemler</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td><a href="kullanicikayit.php?sil=' . $row["id"] . '">Sil</a> | 
            <a href="kullanicikayit.php?duzenle=' . $row["id"] . '">Düzenle</a></td>';
        echo '</tr>';
    }

    echo "</table>";
    echo "</section>";
} else {
    echo "Hiç kullanıcı bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Kayıt</title>
</head>
<body>

    <h1>Kullanıcı Kayıt</h1>
    <form method="POST" action="kullanicikayit.php">
        <label for="email">Email:</label>
        <input type="email" name="email" autocomplete="off" required><br><br>
        
        <label for="sifre">Şifre:</label>
        <input type="password" name="sifre" autocomplete="off" required><br><br>

        <input type="submit" name="kaydet" value="Kaydet" autocomplete="off" >
    </form>

    <h2>Kullanıcı Düzenle</h2>
    <form method="POST" action="kullanicikayit.php">
        <input type="hidden" name="id" autocomplete="off" value="<?php echo $id; ?>">

        <label for="email">Email:</label>
        <input type="text" name="email" autocomplete="off" value="<?php echo isset($email) ? $email : ''; ?>" required><br><br>

        <label for="sifre">Şifre:</label>
        <input type="text" name="sifre" autocomplete="off" value="<?php echo isset($sifre) ? $sifre : ''; ?>" required><br><br>

        <input type="submit" name="guncelle" value="Güncelle" autocomplete="off" >
    </form>

    <h2>Kullanıcı Ara</h2>
    <form method="GET" action="kullanicikayit.php">
        <label for="ara">Email veya Şifre ile ara:</label>
        <input type="text" name="ara" autocomplete="off" required>
        <input type="submit" value="Ara" autocomplete="off">
    </form>
    
</body>
</html>

