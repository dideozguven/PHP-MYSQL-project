<?php
// oturumu başlat
session_start();
// eğer username adlı oturum değişkeni yok ise
// giris sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// sqlbaglanti.php dosyasını dahil et
require('sqlbaglanti.php');

// form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST verilerini al
    $bitki_adi = $_POST['bitki_adi'];
    $bitki_turu = $_POST['bitki_turu'];

    // veritabanına ekleme sorgusu
    $sql = "INSERT INTO bitkiler (bitki_adi, bitki_turu) VALUES ('$bitki_adi', '$bitki_turu')";
    
    // sorguyu çalıştır
    if (mysqli_query($baglanti, $sql)) {
        $mesaj = "Bitki başarıyla eklendi.";
    } else {
        $mesaj = "Hata: " . mysqli_error($baglanti);
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitki Ekle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Bitki Ekle
            </div>
            <div class="card-body">
                <?php if (isset($mesaj)) { echo '<div class="alert alert-info" role="alert">' . $mesaj . '</div>'; } ?>
                <form method="post" action="bitki_ekle.php">
                    <div class="mb-3">
                        <label for="bitki_adi" class="form-label">Bitki Adı:</label>
                        <input type="text" class="form-control" id="bitki_adi" name="bitki_adi" required>
                    </div>
                    <div class="mb-3">
                        <label for="bitki_turu" class="form-label">Bitki Türü:</label>
                        <input type="text" class="form-control" id="bitki_turu" name="bitki_turu" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Bitki Ekle</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
