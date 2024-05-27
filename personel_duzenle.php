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

// Eğer GET isteği ile personel ID'si gelmemişse ana sayfaya yönlendir
if (!isset($_GET['personel_id'])) {
    header("Location: personel_listele.php");
    exit();
}

// Personel ID'sini güvenli bir şekilde al
$personel_id = intval($_GET['personel_id']);

// Veritabanından personelin bilgilerini çekme sorgusu
$sql = "SELECT * FROM personeller WHERE personel_id = ?";
$stmt = mysqli_prepare($baglanti, $sql);
mysqli_stmt_bind_param($stmt, 'i', $personel_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $personel_adisoyadi= $row['personel_adisoyadi'];
    $personel_yas = $row['personel_yas'];
    $personel_iletisim=$row['personel_iletisim'];
} else {
    echo "Hata: Personel bulunamadı.";
    exit();
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
    <title>Personel Düzenle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Personel Düzenle
            </div>
            <div class="card-body">
                <form method="POST" action="personel_guncelle.php">
                    <input type="hidden" name="personel_id" value="<?php echo htmlspecialchars($personel_id); ?>">
                    <div class="mb-3">
                        <label for="personel_adisoyadi" class="form-label">Personel Adı Soyadı</label>
                        <input type="text" class="form-control" id="personel_adisoyadi" name="personel_adisoyadi" value="<?php echo htmlspecialchars($personel_adisoyadi); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="personel_yas" class="form-label">Personel Yaşı</label>
                        <input type="text" class="form-control" id="personel_yas" name="personel_yas" value="<?php echo htmlspecialchars($personel_yas); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="personel_iletisim" class="form-label">Personel İletişim Bilgileri</label>
                        <input type="text" class="form-control" id="personel_iletisim" name="personel_iletisim" value=" <?php echo htmlspecialchars($personel_iletisim); ?>" required>
</div>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
   
</body>
</html>
