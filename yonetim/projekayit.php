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
    $projeadi = $_POST['projeadi'];
    $aciklama = $_POST['aciklama'];
   
    
    // Veritabanına kullanıcıyı ekleme
    $sql = "INSERT INTO projekayit (projeadi, aciklama) VALUES ('$projeadi', '$aciklama')";
    
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
    $projeadi = $_POST['projeadi'];
    $aciklama = $_POST['aciklama'];
    
    // Veritabanındaki kullanıcıyı güncelleme
    $sql = "UPDATE projekayit SET projeadi='$projeadi', aciklama='$aciklama' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Proje başarıyla güncellendi.";
    } else {
        echo "Güncelleme işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı silme
if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    
    // Veritabanından kullanıcıyı silme
    $sql = "DELETE FROM projekayit WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Proje başarıyla silindi.";
    } else {
        echo "Silme işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı düzenleme için verileri çekme
if (isset($_GET['duzenle'])) {
    $id = $_GET['duzenle'];

    // Veritabanından kullanıcıyı seçme
    $sql = "SELECT id, projeadi, aciklama FROM projekayit WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $projeadi = $row["projeadi"];
        $aciklama = $row["aciklama"];
    } else {
        echo "Proje bulunamadı.";
    }
}

// Arama işlemi
if (isset($_GET['ara2'])) {
    $aranan2 = $_GET['ara2'];
    
    // Kullanıcıları filtrelemek için veritabanı sorgusunu güncelleme
    $sql = "SELECT id, projeadi, aciklama FROM projekayit WHERE projeadi LIKE '%$aranan2%' OR aciklama LIKE '%$aranan2%'";
} else {
    // Arama yapılmadığında tüm kullanıcıları listeleme
    $sql = "SELECT id, projeadi, aciklama FROM projekayit";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="portfolyo.php">PORTFOLYO</a> - <a href="hakkimizda.php">HAKKIMIZDA</a> - <a href="duyurular.php">DUYURULAR</a> - <a href="kullanicikayit.php">KULLANICI KAYDETME</a> - <a href="projekayit.php">PROJE  KAYDETME</a> - <a href="cikis.php" onclick="if (!confirm(\'Çıkış Yapmak İstediğinize Emin misiniz?\')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>';
    echo "<section id='projeler'>";
    echo "<h2>Proje Listesi</h2>";
    echo "<hr>";
    echo "<div class='temizle'></div>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Email</th><th>İşlemler</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["projeadi"] . "</td>";
        echo "<td><a href='projekayit.php?sil=" . $row["id"] . "'>Sil</a> | 
            <a href='projekayit.php?duzenle=" . $row["id"] . "'>Düzenle</a></td>";
        echo "</tr>";
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
    <title>Proje Kayıt</title>
</head>
<body>
    <h1>Proje Kayıt</h1>
    <form method="POST" action="projekayit.php">
        <label for="projeadi"> Proje Adı:</label>
        <input type="text" name="projeadi" autocomplete="off"required><br><br>
        
        <label for="aciklama">Açıklama:</label>
        <input type="text" name="aciklama"autocomplete="off"  required><br><br>
        
        <input type="submit" name="kaydet" value="Kaydet"autocomplete="off" >
    </form>

    <h2>Proje Düzenle</h2>
    <form method="POST" action="projekayit.php">
        <input type="hidden" name="id" autocomplete="off" value="<?php echo $id; ?>">
        <label for="projeadi">Ad:</label>
        <input type="text" name="projeadi" autocomplete="off" value="<?php echo isset($projeadi) ? $projeadi : ''; ?>" required><br><br>
    
        <label for="aciklama">Açıklama:</label>
        <input type="text" name="aciklama" autocomplete="off" value="<?php echo isset($aciklama) ? $aciklama : ''; ?>" required><br><br>

        
    
    <input type="submit" name="guncelle" value="Güncelle" autocomplete="off">
</form>

    <h2>Proje Ara</h2>
      <form method="GET" action="projekayit.php">
        <label for="ara2">Proje Adı ile Ara:</label>
        <input type="text" name="ara2" autocomplete="off" required>
        <input type="submit" value="Ara2" autocomplete="off">
      </form>


</body>
</html>
