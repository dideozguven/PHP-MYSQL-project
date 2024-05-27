CREATE DATABASE `dbstorage21360859046` DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci;
USE `dbstorage21360859046`;
CREATE TABLE `kullanicilar` (
`user_id` int(25) NOT NULL AUTO_INCREMENT,
`kullanici_adi` varchar(200) NOT NULL,
`sifre` varchar(200) NOT NULL,
PRIMARY KEY (`user_id`)
);

CREATE TABLE `bitkiler` (
`bitki_id` int(25) NOT NULL AUTO_INCREMENT,
`bitki_adi` varchar(200) NOT NULL,
`bitki_turu` varchar(200) NOT NULL,
PRIMARY KEY (`bitki_id`)
);
CREATE TABLE `personeller` (
`personel_id` int(25) NOT NULL AUTO_INCREMENT,
`personel_adisoyadi` varchar(200) NOT NULL,
`personel_yas` int(10) NOT NULL ,
  `personel_iletisim` varchar(30) NOT NULL,
PRIMARY KEY (`personel_id`)
);

    
