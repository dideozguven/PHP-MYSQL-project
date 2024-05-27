<?php
// oturumu başlat
session_start();
// eğer username adlı oturum değişkeni yok ise
// login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// sqlbaglanti.php dosyasını dahil et
require('sqlbaglanti.php');

// form gönderildiyse
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST verilerini al
    $personel_adisoyadi = $_POST['personel_adisoyadi'];
    $personel_yas = $_POST['personel_yas'];
    $personel_iletisim =$_POST['personel_iletisim'];

    // veritabanına ekleme sorgusu
    $sql = "INSERT INTO personeller (personel_adisoyadi, personel_yas,personel_iletisim) VALUES ('$personel_adisoyadi', '$personel_yas','$personel_iletisim')";
    
    // sorguyu çalıştır
    if (mysqli_query($baglanti, $sql)) {
        $mesaj = "Yeni personel başarıyla eklendi.";
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
    <title>Personel Ekle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Personel Ekle
            </div>
            <div class="card-body">
                <?php if (isset($mesaj)) { echo '<div class="alert alert-info" role="alert">' . $mesaj . '</div>'; } ?>
                <form method="post" action="personel_ekle.php">
                    <div class="mb-3">
                        <label for="personel_adisoyadi" class="form-label">Personel Adı Soyadı:</label>
                        <input type="text" class="form-control" id="personel_adisoyadi" name="personel_adisoyadi" required>
                    </div>
                    <div class="mb-3">
                        <label for="personel_yas" class="form-label">Personel Yaşı:</label>
                        <input type="text" class="form-control" id="personel_yas" name="personel_yas" required>
                    </div>
                    <div class ="mb-3">
                        <label for="personel_iletisim" class="form-label">Personel İletişim Numarası:</label>
                        <input type="text" class="form-control" id="personel_iletisim" name="personel_iletisim" required>
</div>
                    <button type="submit" class="btn btn-primary">Personel Ekle</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
