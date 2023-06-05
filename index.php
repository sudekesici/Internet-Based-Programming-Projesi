

<?php
session_start();
include("yonetim/ayar.php");

?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Yazılım Şirketi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" integrity="sha384-PJsj/BTMqILvmcej7ulplguok8ag4xFTPryRq8xevL7eBYSmpXKcbNVuy+P0RMgq" crossorigin="anonymous">
 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    -->

        <script src="https://kit.fontawesome.com/1be5415e3d.js" crossorigin="anonymous"></script>
    </head>
    <body>

      <header>
          <a href="javascript:void(0);" onclick="ac();" id="acdgm">☰</a>
          <a href="javascript:void(0);" onclick="kapat();" id="kapatdgm">☰</a>
      </header>

      <aside id="menu">
        <h1>MENÜ</h1>
        <ul>
          <li><a href="#anasayfa"><i class="fa-solid fa-house" style="color: #ffffff;"></i> Ana Sayfa</a></li>
          <li><a href="#hakkimizda"><i class="fa-solid fa-address-card" style="color: #ffffff;"></i> Hakkımızda</a></li>
          <li><a href="#duyurular"><i class="fa-solid fa-bullhorn" style="color: #ffffff;"></i> Duyurular</a></li>
          <li><a href="#iletisim"><i class="fa-solid fa-phone" style="color: #ffffff;"></i> İletişim</a></li>
          <li><a href="#projekayit"><i class="fa-solid fa-list" style="color: #ffffff;"></i> Proje Listesi</a></li>
          <li><a href="#kullanicikayit"><i class="fa-solid fa-user" style="color: #ffffff;"></i> Kullanıcı Listesi</a></li>
          <li><a href="yonetim/sifreguncelle.php" target="_blank"><i class="fa-solid fa-key" style="color: #ffffff;"></i> Şifre Değiştir</a></li>
          <li><a href="yonetim/gelenmesajlar.php" target="_blank"><i class="fa-solid fa-envelope" style="color: #ffffff;"></i> Gelen Mesajlar</a></li>

        </ul> 
      </aside>

      <main id="icerik">
        <section id="anasayfa">
          <h1>Yazılım Şirketi</h1>
          <br><br>
          <h2>Portfolyo</h2>
          <hr>
          <div class="temizle"></div>
          <div class="galeri">
           <a href="img/resim1.jpg" class="resimler"  title="Galeri"></a><img src="img/resim1.jpg" alt="galeri"></a>
          </div>
          <div class="galeri">
            <a href="img/resim2.jpg" class="resimler"  title="Galeri"><img src="img/resim2.jpg" alt="galeri"></a>
          </div>
          <div class="galeri">
            <a href="img/resim3.jpg" class="resimler"  title="Galeri"><img src="img/resim3.jpg" alt="galeri"></a>
          </div>
          <div class="galeri">
            <a href="img/resim4.jpg" class="resimler"  title="Galeri"><img src="img/resim4.jpg" alt="galeri"></a>
          </div>
          <div class="temizle"></div>
        </section>
        
        <section id="hakkimizda">
          <h2>Hakkımızda</h2>
          <hr>
          <div class="temizle"></div>
          <?php
            $sorgu = $baglan->query("select * from hakkimizda");
            $satir = $sorgu->fetch_object();
            echo $satir->aciklama;
          ?>
        </section>

        <section id="duyurular">
          <h2>Duyurular</h2>
          <hr>
          <div class="temizle"></div>
          <?php
            $sorgu = $baglan->query("select * from duyurular");
            $satir = $sorgu->fetch_object();
            echo $satir->aciklama;
          ?>
        </section>

        

        <section id="projekayit">
          <h2>Proje Listesi</h2>
          <hr>
          <div class="temizle"></div>
          <?php
            $sorgu = $baglan->query("select * from projekayit");
            while($satir = $sorgu->fetch_object()) {
              echo $satir->projeadi;echo " ";
              echo $satir->aciklama;echo "<br><br> ";

            }
           
          ?>
        </section>

        <h2>Proje Ara</h2>
        <hr>
          <div class="temizle"></div>
    <form method="GET" action="">
        <label for="ara2">Proje Adı ile ara:</label>
        <input type="text" name="ara2"autocomplete="off" required>
        <input type="submit" value="Ara" autocomplete="off">
    </form>

    <?php
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
        echo "<section id='projeler'>";
        echo "<br><br>";
        echo "<h2> Aranan Proje </h2>";
        echo "<hr>";
        echo "<div class='temizle'></div>";
        echo "<table>";
        echo "<tr><th>Proje Adı</th><th>İçerik</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["projeadi"] . "</td>";
            echo "<td>" . $row["aciklama"] . "</td>";
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

        <section id="kullanicikayit">
        <a name="kullanicikayit"></a>
          <h2> Kullanıcı Listesi</h2>
          <hr>
          <div class="temizle"></div>
          <?php
            
            $sorgu = $baglan->query("select * from standartkullanici");
            while ($satir = $sorgu->fetch_object()) {
                echo $satir->email;echo " "; 
                echo $satir->sifre;echo "<br><br>";
                
            }
            
          ?>


    <h2>Kullanıcı Ara</h2>
    <hr>
          <div class="temizle"></div>
    <form method="GET" action="">
        <label for="ara">Email veya Şifre ile ara:</label>
        <input type="text" name="ara" autocomplete="off" required>
        <input type="submit" value="Ara" autocomplete="off">
    </form>


    <?php
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

    // Arama işlemi
    if (isset($_GET['ara'])) {
        $aranan = $_GET['ara'];
        
        // Kullanıcıları filtrelemek için veritabanı sorgusunu güncelleme
        $sql = "SELECT id, email, sifre FROM standartkullanici WHERE email LIKE '%$aranan%' OR sifre LIKE '%$aranan%'";
    } else {
        // Arama yapılmadığında tüm kullanıcıları listeleme
        $sql = "SELECT id, email, sifre FROM standartkullanici";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<section id='kullanicilar'>";
        echo "<br><br>";
        echo "<h2>Aranan Kullanıcı</h2>"; 
        echo "<hr>";
        echo "<div class='temizle'></div>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Email</th><th>Şifre</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["sifre"] . "</td>";
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
      
        <section id="iletisim">
          <h2>İletişim</h2>
          <hr>
          <div class="temizle"></div>
          <form method="post" action="index.php">
            <label for="adsoyad">Ad Soyad</label>
            <input type="text" name="isim" id="isim" autocomplete="off" required>

            <label for="telefon">Telefon</label>
            <input type="tel" name="tel" id="tel"autocomplete="off" >

            <label for="eposta">E-posta</label>
            <input type="email" name="mail" id="mail" autocomplete="off">

            <label for="mesaj">Mesaj</label>
            <textarea name="mesaj" id="mesaj"></textarea>

            <button type="submit">Mesaj Gönder</button>
          </form>
        </section>


 <?php

include("yonetim/ayar.php");

if(isset($_POST["isim"],$_POST["tel"],$_POST["mail"],$_POST["mesaj"]))
{
   
   $adsoyad=$_POST["isim"];
   $telefon=$_POST["tel"];
   $email=$_POST["mail"];
   $mesaj=$_POST["mesaj"];

   $ekle="INSERT INTO iletisim(isim,tel,mail,mesaj) VALUES 
   ('".$adsoyad."','".$telefon."','".$email."','".$mesaj."')";

    if($baglan->query($ekle) === TRUE)
    
   {
    
    echo "<script>alert('Mesajınız başarı ile gönderilmiştir.')</script>";
   }

} 



?>
      </main>

      <script src="js/jquery-1.4.3.min.js"></script>
      <script src="js/jquery.fancybox-1.3.4.js"></script>
    <script>
        $("a.resimler").fancybox();

        function ac() {
            document.getElementById("menu").style.display = "block";
            document.getElementById("icerik").style.paddingLeft = "350px";
            document.getElementById("acdgm").style.display = "none";
            document.getElementById("kapatdgm").style.display = "block";
        }

        function kapat() {
            document.getElementById("menu").style.display = "none";
            document.getElementById("icerik").style.paddingLeft = "50px";
            document.getElementById("acdgm").style.display = "block";
            document.getElementById("kapatdgm").style.display = "none";
        }
    </script>  

    </body>
</html>