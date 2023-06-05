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

// Kullanıcı güncelleme
if (isset($_POST['guncelle'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    
    // Veritabanındaki kullanıcıyı güncelleme
    $sql = "UPDATE standartkullanici SET email='$email', sifre='$sifre' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla güncellendi.";
    } else {
        echo "Güncelleme işlemi başarısız oldu: " . $conn->error;
    }
}

// Kullanıcı düzenleme için verileri çekme
if (isset($_GET['duzenle'])) {
    $id = $_GET['duzenle'];

    // Veritabanından kullanıcıyı seçme
    $sql = "SELECT id, email, sifre FROM standartkullanici WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "Sorgu hatası: " . $conn->error;
    } elseif ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $sifre = $row["sifre"];
    } else {
        echo "Kullanıcı bulunamadı.";
    }
}

$result = $conn->query("SELECT id, email,sifre FROM standartkullanici");

if ($result === FALSE) {
    echo "Sorgu hatası: " . $conn->error;
} elseif ($result->num_rows > 0) {
    echo "<section id='sifreguncelle'>";
    echo "<h2>Kullanıcı Listesi</h2>";
    echo "<hr>";
    echo "<div class='temizle'></div>";
    echo "<table>";
    echo "<tr><th>Email</th><th>Şifreniz</th><th>Güncelle</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["sifre"] . "</td>";
        echo "<td><a href='sifreguncelle.php?duzenle=" . $row["id"] . "'>Düzenle</a></td>";
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
<title>Şifre Değiştirme</title>
</head>
<body>
<h2>Şifre Değiştir</h2>
<form method="POST" action="sifreguncelle.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"autocomplete="off" >
<label for="email">Email:</label>
<input type="text" name="email" autocomplete="off" value="<?php echo isset($email) ? $email : ''; ?>" required><br><br>

<label for="sifre">Şifre:</label>
<input type="text" name="sifre" autocomplete="off" value="<?php echo isset($sifre) ? $sifre : ''; ?>" required><br><br>

<input type="submit" name="guncelle" autocomplete="off" value="Güncelle">
</form>
</body>
</html>
