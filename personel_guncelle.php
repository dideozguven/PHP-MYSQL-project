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

// Eğer POST isteği ile gerekli veriler gelmemişse ana sayfaya yönlendir
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['personel_id'], $_POST['personel_adisoyadi'], $_POST['personel_yas'],$_POST['personel_iletisim'])) {
    header("Location: personel_listele.php");
    exit();
}


$personel_id = intval($_POST['personel_id']);
$personel_adisoyadi = mysqli_real_escape_string($baglanti, $_POST['personel_adisoyadi']);
$personel_yas= mysqli_real_escape_string($baglanti, $_POST['personel_yas']);
$personel_iletisim=mysqli_real_escape_string($baglanti,$_POST['personel_iletisim']);
// Veritabanında personel bilgisini güncelleme sorgusu
$sql = "UPDATE personeller SET personel_adisoyadi = ?, personel_yas = ?,personel_iletisim = ? WHERE personel_id = ?";
$stmt = mysqli_prepare($baglanti, $sql);
mysqli_stmt_bind_param($stmt, 'sssi', $personel_adisoyadi, $personel_yas , $personel_iletisim , $personel_id);
$sonuc = mysqli_stmt_execute($stmt);

if ($sonuc) {
    $mesaj = "Personel bilgisi başarıyla güncellendi.";
} else {
    $mesaj = "Hata: Personel bilgisi güncellenemedi. " . mysqli_error($baglanti);
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
    <title>Bilgi Güncelle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info">
            <?php echo htmlspecialchars($mesaj); ?>
        </div>
        <a href="personel_listele.php" class="btn btn-primary">Personel Listesine Dön</a>
    </div>
</body>
</html>
