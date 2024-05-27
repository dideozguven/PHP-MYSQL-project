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

// Eğer GET isteği ile bitki ID'si gelmemişse ana sayfaya yönlendir
if (!isset($_GET['bitki_id'])) {
    header("Location: bitki_listele.php");
    exit();
}

// Bitki ID'sini güvenli bir şekilde al
$bitki_id = intval($_GET['bitki_id']);

// Veritabanından bitkinin bilgilerini çekme sorgusu
$sql = "SELECT * FROM bitkiler WHERE bitki_id = ?";
$stmt = mysqli_prepare($baglanti, $sql);
mysqli_stmt_bind_param($stmt, 'i', $bitki_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $bitki_adi = $row['bitki_adi'];
    $bitki_turu = $row['bitki_turu'];
} else {
    echo "Hata: Bitki bulunamadı.";
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
    <title>Bitki Düzenle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Bitki Düzenle
            </div>
            <div class="card-body">
                <form method="POST" action="bitki_guncelle.php">
                    <input type="hidden" name="bitki_id" value="<?php echo htmlspecialchars($bitki_id); ?>">
                    <div class="mb-3">
                        <label for="bitki_adi" class="form-label">Bitki Adı</label>
                        <input type="text" class="form-control" id="bitki_adi" name="bitki_adi" value="<?php echo htmlspecialchars($bitki_adi); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="bitki_turu" class="form-label">Bitki Türü</label>
                        <input type="text" class="form-control" id="bitki_turu" name="bitki_turu" value="<?php echo htmlspecialchars($bitki_turu); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
   
</body>
</html>
