<?php
// Oturumu başlat
session_start();
// Eğer username adlı oturum değişkeni yok ise
// login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

// sqlbaglanti.php dosyasını dahil et
require('sqlbaglanti.php');


$sql = "SELECT * FROM personeller";
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
    <title>Personel Listesi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Personel Listesi
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Personel Adı Soyadı</th>
                            <th>Personel Yaşı</th>
                            <th>Personel İletişim Bilgileri</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($cevap)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['personel_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['personel_adisoyadi']); ?></td>
                                <td><?php echo htmlspecialchars($row['personel_yas']); ?></td>
                                <td><?php echo htmlspecialchars($row['personel_iletisim']); ?></td>
                                <td>
                                    <form method="POST" action="personel_sil.php" style="display:inline;">
                                        <input type="hidden" name="personel_id" value="<?php echo $row['personel_id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Personeli Sil</button>
                                    </form>
                                    <a href="personel_duzenle.php?personel_id=<?php echo $row['personel_id']; ?>" class="btn btn-warning btn-sm">Personel Bilgilerini Düzenle</a>
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
