<?php
// Oturumu başlat
session_start();
// Eğer username adlı oturum değişkeni yok ise
// giris sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoş Geldiniz</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Merhaba <?php echo $_SESSION['username']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">Hoş geldiniz</h5>
                <p class="card-text">Sistemde yapabileceğiniz işlemler:</p>
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item">
                        <a href="bitki_ekle.php" class="btn btn-primary">Sisteme bitki eklemek için tıklayın</a>
                    </li>
                    <li class="list-group-item">
                        <a href="bitki_listele.php" class="btn btn-primary">Sistemdeki bitkileri listelemek için tıklayın</a>
   </li>
                   
                    <li class="list-group-item">
                        <a href="personel_ekle.php" class="btn btn-primary">Sisteme yeni personel eklemek için tıklayın</a>
                    </li>
                    <li class="list-group-item">
                        <a href="personel_listele.php" class="btn btn-primary">Sistemdeki tüm personelleri listelemek için tıklayın</a>
                    </li>
                   
                </ul>
                <a href="cikisyap.php" class="btn btn-danger">Oturumu Kapat</a>
            </div>
        </div>
    </div>
</body>
</html>
