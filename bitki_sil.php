<?php
// Oturumu başlat
session_start();

// Kullanıcının giriş yapıp yapmadığını kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// sqlbaglanti.php dosyasını dahil et
require('sqlbaglanti.php');

// Eğer POST isteği ile bitki ID'si gelmemişse ana sayfaya yönlendir
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['bitki_id'])) {
    header("Location: bitki_listele.php");
    exit();
}

// Bitki ID'sini güvenli bir şekilde al
$bitki_id = intval($_POST['bitki_id']);

// Veritabanından bitkiyi silme sorgusu
$sql = "DELETE FROM bitkiler WHERE bitki_id = ?";
$stmt = mysqli_prepare($baglanti, $sql);
mysqli_stmt_bind_param($stmt, 'i', $bitki_id);
$sonuc = mysqli_stmt_execute($stmt);

if ($sonuc) {
    $mesaj = "Bitki başarıyla silindi.";
} else {
    $mesaj = "Hata: Bitki silinemedi. " . mysqli_error($baglanti);
}

// Veritabanı bağlantısını kapat
mysqli_stmt_close($stmt);
mysqli_close($baglanti);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitki Sil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info">
            <?php echo htmlspecialchars($mesaj); ?>
        </div>
        <a href="bitki_listele.php" class="btn btn-primary">Bitki Listesine Dön</a>
    </div>
</body>
</html>
