<?php
// Oturumu başlat
session_start();
// Eğer username adlı oturum değişkeni yok ise
// giris sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// sqlbaglanti.php dosyasını dahil et
require('sqlbaglanti.php');

// Veritabanından bitkileri çekme sorgusu
$sql = "SELECT * FROM bitkiler";
$cevap = mysqli_query($baglanti, $sql);

if (!$cevap) {
    echo '<br>Hata:' . mysqli_error($baglanti);
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitki Listesi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Bitki Listesi
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bitki Adı</th>
                            <th>Bitki Türü</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($cevap)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['bitki_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['bitki_adi']); ?></td>
                                <td><?php echo htmlspecialchars($row['bitki_turu']); ?></td>
                                <td>
                                    <form method="POST" action="bitki_sil.php" style="display:inline;">
                                        <input type="hidden" name="bitki_id" value="<?php echo $row['bitki_id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Bitkiyi Sil</button>
                                    </form>
                                    <a href="bitki_duzenle.php?bitki_id=<?php echo $row['bitki_id']; ?>" class="btn btn-warning btn-sm">Bitkiyi Düzenle</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>
