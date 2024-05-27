<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Kayıt Formu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="https://github.com/dideozguven/PHP-MYSQL-project">Github Linki</a>
    <div class="container">
        <?php
        require('sqlbaglanti.php');
        if (isset($_POST['username']) && isset($_POST['password'])){
            extract($_POST);
            
            $password = hash('sha256', $password);
            $sql="INSERT INTO `kullanicilar` (kullanici_adi, sifre)";
            $sql = $sql . "VALUES ('$username', '$password')";
            $cevap = mysqli_query($baglanti, $sql);
            if ($cevap){
                $mesaj = "<h1 class='mt-5'>Kullanıcı oluşturuldu.</h1>";
            } else {
                $mesaj = "<h1 class='mt-5'>Kullanıcı oluşturulamadı!</h1>";
            }
        }
        ?>
        
        <?php if (isset($mesaj)) echo $mesaj; ?>
        <h2 class="mt-5">Kayıt Formu</h2>
        <form class="mt-4" action="<?php $_PHP_SELF ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifre:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="giris.php" class="btn btn-secondary">Kullanıcı Girişi</a>
        </form>
    </div>
   
</body>
</html>
