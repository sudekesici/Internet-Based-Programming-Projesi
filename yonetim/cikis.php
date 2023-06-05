
<?php
session_start();

// Oturumu sonlandırmak için kullanılan kodlar burada yer alır

// Örneğin, aşağıdaki kod oturumu sonlandırır ve kullanıcıyı giriş sayfasına yönlendirir
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
