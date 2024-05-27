<?php
session_start();
require('sqlbaglanti.php');
if (isset($_POST['username']) and isset($_POST['password'])) {
    extract($_POST);
    $password = hash('sha256', $password);
    $sql = "SELECT * FROM `kullanicilar` WHERE ";
    $sql = $sql . "kullanici_adi='$username' and sifre='$password'";
    $cevap = mysqli_query($baglanti, $sql);
    
    if (!$cevap) {
        echo '<br>Hata:' . mysqli_error($baglanti);
    }
    
    $say = mysqli_num_rows($cevap);
    if ($say == 1) {
        $_SESSION['username'] = $username;
    } else {
        $mesaj = "<h1> Hatalı Kullanıcı adı veya Şifre!</h1>";
    }
}
if (isset($_SESSION['username'])) {
    header("Location: botanik.php");
} else {
    
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Girişi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($mesaj)) echo $mesaj; ?>
        <h2 class="mb-4">Kullanıcı Girişi</h2>
        <form action="<?php $_PHP_SELF ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Giriş</button>
            <a href="kullanicikayit.php" class="btn btn-secondary ms-2">Kayıt Ol</a>
        </form>
    </div>
</body>
</html>

<?php } ?>
