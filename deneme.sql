-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Ağu 2023, 11:54:33
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `deneme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dated_voyage`
--

CREATE TABLE `dated_voyage` (
  `id` int(11) NOT NULL COMMENT 'kayıt numarası',
  `departurePointId` int(11) NOT NULL COMMENT 'Kalkış Noktası Kayıt Numarası',
  `arrivalPointId` int(11) NOT NULL COMMENT 'Varış Noktası Kayıt Numarası',
  `date` date NOT NULL COMMENT 'sefer tarihi',
  `time` time NOT NULL COMMENT 'sefer saati',
  `duration` int(11) NOT NULL COMMENT 'Yolculuk Süresi',
  `ferryId` int(11) NOT NULL COMMENT 'Feribot Kayıt Numarası',
  `quota` int(11) NOT NULL COMMENT 'sefer kontenjanı',
  `adultFee` float NOT NULL COMMENT 'yetişkin ücreti',
  `childFee` float NOT NULL COMMENT 'çocuk ücreti',
  `babyFee` float NOT NULL COMMENT 'bebek ücreti'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `dated_voyage`
--

INSERT INTO `dated_voyage` (`id`, `departurePointId`, `arrivalPointId`, `date`, `time`, `duration`, `ferryId`, `quota`, `adultFee`, `childFee`, `babyFee`) VALUES
(1, 6, 2, '2023-08-01', '09:00:00', 45, 16, 100, 17.5, 8.7, 2.5),
(2, 6, 2, '2023-08-01', '09:00:00', 90, 6, 120, 15, 7.5, 2.5),
(3, 7, 1, '2023-08-01', '08:45:00', 20, 8, 150, 15, 7.5, 2.5),
(4, 8, 1, '2023-08-01', '09:15:00', 30, 9, 100, 16.5, 8.5, 2.5),
(5, 7, 1, '2023-08-01', '09:15:00', 45, 10, 120, 13, 6.5, 2.5),
(6, 8, 1, '2023-08-01', '17:00:00', 30, 11, 100, 16.5, 8.5, 2.5),
(7, 1, 8, '2023-08-01', '18:00:00', 30, 9, 120, 16.5, 8.5, 2.5),
(8, 1, 8, '2023-08-01', '10:20:00', 30, 11, 100, 16.5, 8.5, 2.5),
(9, 1, 8, '2023-08-01', '17:30:00', 45, 10, 120, 13, 6.5, 2.5),
(10, 1, 7, '2023-08-01', '17:30:00', 20, 8, 100, 15, 7.5, 2.5),
(11, 2, 6, '2023-08-01', '18:00:00', 45, 16, 120, 17.5, 8.5, 2.5),
(12, 2, 6, '2023-08-01', '18:00:00', 90, 6, 100, 15, 7.5, 2.5),
(13, 9, 4, '2023-08-01', '09:20:00', 35, 1, 120, 20, 15, 10),
(14, 9, 4, '2023-08-01', '09:20:00', 35, 2, 100, 20, 15, 10),
(15, 9, 4, '2023-08-01', '09:20:00', 25, 3, 120, 22.5, 15, 10),
(16, 9, 4, '2023-08-01', '19:00:00', 35, 4, 100, 20, 15, 10),
(17, 9, 4, '2023-08-01', '19:00:00', 35, 2, 120, 20, 15, 10),
(18, 9, 4, '2023-08-01', '19:00:00', 40, 5, 100, 20, 15, 10),
(19, 4, 9, '2023-08-01', '08:30:00', 35, 4, 120, 20, 15, 10),
(20, 4, 9, '2023-08-01', '18:00:00', 35, 1, 100, 20, 15, 10),
(21, 4, 9, '2023-08-01', '08:00:00', 35, 2, 120, 20, 15, 10),
(22, 4, 9, '2023-08-01', '08:00:00', 40, 5, 100, 20, 15, 10),
(23, 4, 9, '2023-08-01', '18:00:00', 25, 3, 120, 22.5, 15, 10),
(24, 10, 3, '2023-08-01', '08:45:00', 110, 12, 100, 27.5, 22.5, 2.5),
(25, 3, 10, '2023-08-01', '17:00:00', 110, 12, 120, 27.5, 22.5, 2.5),
(46, 11, 5, '2023-08-01', '08:30:00', 45, 13, 100, 20.5, 15.5, 1.5),
(47, 5, 11, '2023-08-01', '18:15:00', 45, 13, 120, 20.5, 15.5, 1.5),
(48, 12, 3, '2023-08-01', '09:15:00', 60, 14, 100, 42.5, 16, 2.5),
(49, 3, 12, '2023-08-01', '17:00:00', 60, 14, 100, 42.5, 16, 2.5),
(50, 12, 3, '2023-08-01', '17:00:00', 60, 14, 100, 42.5, 16, 2.5),
(51, 3, 12, '2023-08-01', '09:00:00', 60, 14, 100, 42.5, 16, 2.5),
(52, 13, 1, '2023-08-01', '09:00:00', 45, 10, 100, 13, 6.5, 2.5),
(53, 1, 13, '2023-08-01', '18:15:00', 45, 10, 100, 13, 6.5, 2.5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ferries`
--

CREATE TABLE `ferries` (
  `id` int(11) NOT NULL COMMENT 'kayıt numarası',
  `name` varchar(50) NOT NULL COMMENT 'feribot adı',
  `ferryCompany` varchar(50) NOT NULL COMMENT 'feribot şirketi adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `ferries`
--

INSERT INTO `ferries` (`id`, `name`, `ferryCompany`) VALUES
(1, 'K.SEVKET IYIDERE', 'Turyol'),
(2, 'F/B SAN NICOLAS', 'Sunrise'),
(3, 'KATAMARAN H/S', 'Ertürk Lines'),
(4, 'ARAÇLI FERİBOT / CHIOS', 'Turyol'),
(5, 'ERTURK - 1', 'Ertürk Lines'),
(6, 'ARAÇLI FERİBOT / LESVOS FOKAIA', 'Turyol'),
(7, 'SEDA JALE (Açık Güverteli)', 'Jalem'),
(8, 'SEA STAR MAKRİ', 'Tilos'),
(9, 'BODRUM EXPRESS', 'Yeşil Marmaris'),
(10, 'Gönül (Açık Güverteli)', 'Dentur'),
(11, 'ASKANIA', 'Yeşil Marmaris'),
(12, 'SEA STAR LİNDOS', 'Tilos'),
(13, 'SEA STAR SAMOS', 'Tilos'),
(14, 'KARTEPE', 'Yeşil Marmaris'),
(16, 'HIZLI KATAMARAN', 'Jalem'),
(17, 'SEA STAR RHODES', 'Tilos');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL COMMENT 'kayıt numarası',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'kullanıcı adı',
  `pass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'şifre',
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'isim',
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'soyad',
  `birthday` date NOT NULL COMMENT 'doğum tarihi',
  `sex` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cinisiyet',
  `email` varchar(255) NOT NULL COMMENT 'e-posta',
  `tel` int(10) NOT NULL COMMENT 'telefon numarası',
  `citizenId` int(11) NOT NULL COMMENT 'Tc kimlik numarası',
  `passportId` varchar(9) NOT NULL COMMENT 'pasaport numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `member`
--

INSERT INTO `member` (`id`, `username`, `pass`, `firstname`, `lastname`, `birthday`, `sex`, `email`, `tel`, `citizenId`, `passportId`) VALUES
(6, 'mcan35', 'e10adc3949ba59abbe56e057f20f883e', 'Mustafa Can', 'Ersen', '1996-08-25', 'Erkek', 'mustafa.can.ersen@babursahturizm.com', 2147483647, 2147483647, 'U354762');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ports`
--

CREATE TABLE `ports` (
  `id` int(11) NOT NULL COMMENT 'Yunanistan liman kayıt numarası',
  `portPoint` varchar(50) NOT NULL COMMENT 'Yunanistan Liman Yeri',
  `portName` varchar(50) NOT NULL COMMENT 'Yunanistan Liman Adı',
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `ports`
--

INSERT INTO `ports` (`id`, `portPoint`, `portName`, `country`) VALUES
(1, 'Kos', 'Kos Port', 'el'),
(2, 'Midilli', 'Midilli Port', 'el'),
(3, 'Rodos', 'Touristiko Port', 'el'),
(4, 'Sakız', 'Chios Port', 'el'),
(5, 'Samos', 'Vathi Port', 'el'),
(6, 'Ayvalık', 'Ayvalık Port', 'tr'),
(7, 'Bodrum', 'Bodrum Kale Port', 'tr'),
(8, 'Bodrum', 'Bodrum Cruise Port', 'tr'),
(9, 'Çeşme', 'Ulusoy Port', 'tr'),
(10, 'Fethiye', 'Fethiye Liman', 'tr'),
(11, 'Kuşadası', 'Büyük Liman', 'tr'),
(12, 'Marmaris', 'Marmaris Cruise Port', 'tr'),
(13, 'Turgutreis', 'D-Marin Port', 'tr');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL COMMENT 'rota kayıt numarası',
  `departurePortId` int(11) NOT NULL COMMENT 'Kalkış Limanı ',
  `arrivalPortId` int(11) NOT NULL COMMENT 'Varış Limanı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `route`
--

INSERT INTO `route` (`id`, `departurePortId`, `arrivalPortId`) VALUES
(9, 6, 2),
(10, 7, 1),
(11, 8, 1),
(12, 9, 4),
(13, 10, 3),
(14, 11, 5),
(15, 12, 3),
(16, 13, 1),
(17, 1, 7),
(18, 1, 8),
(19, 1, 13),
(20, 2, 6),
(21, 3, 10),
(22, 3, 12),
(23, 4, 9),
(24, 5, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL COMMENT 'satış kayıt numarası',
  `datedVoyageId` int(11) NOT NULL COMMENT 'tarihli seferin kayıt numarası',
  `numberOfAdults` int(11) NOT NULL COMMENT 'yetişkin sayısı',
  `numberOfChilderen` int(11) DEFAULT NULL COMMENT 'çocuk sayısı',
  `numberOfBabies` int(11) DEFAULT NULL COMMENT 'bebek sayısı',
  `totalFee` int(11) NOT NULL COMMENT 'toplam ucret',
  `voucher` int(11) NOT NULL COMMENT 'Voucher(sipariş) numarası',
  `token` varchar(255) NOT NULL COMMENT 'Benzersiz satış kodu',
  `memberId` int(11) NOT NULL COMMENT 'üye bilgileri kayıt numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dated_voyage`
--
ALTER TABLE `dated_voyage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ferryId` (`ferryId`),
  ADD KEY `departurePointId` (`departurePointId`,`arrivalPointId`),
  ADD KEY `arrivalPointId` (`arrivalPointId`);

--
-- Tablo için indeksler `ferries`
--
ALTER TABLE `ferries`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turkeyPortId` (`departurePortId`),
  ADD KEY `greecePortId` (`arrivalPortId`);

--
-- Tablo için indeksler `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `voucher` (`voucher`),
  ADD KEY `datedVoyageId` (`datedVoyageId`,`memberId`),
  ADD KEY `memberId` (`memberId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `dated_voyage`
--
ALTER TABLE `dated_voyage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası', AUTO_INCREMENT=54;

--
-- Tablo için AUTO_INCREMENT değeri `ferries`
--
ALTER TABLE `ferries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası', AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası', AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `ports`
--
ALTER TABLE `ports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Yunanistan liman kayıt numarası', AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'rota kayıt numarası', AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'satış kayıt numarası';

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `dated_voyage`
--
ALTER TABLE `dated_voyage`
  ADD CONSTRAINT `dated_voyage_ibfk_1` FOREIGN KEY (`ferryId`) REFERENCES `ferries` (`id`),
  ADD CONSTRAINT `dated_voyage_ibfk_2` FOREIGN KEY (`departurePointId`) REFERENCES `ports` (`id`),
  ADD CONSTRAINT `dated_voyage_ibfk_3` FOREIGN KEY (`arrivalPointId`) REFERENCES `ports` (`id`);

--
-- Tablo kısıtlamaları `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`arrivalPortId`) REFERENCES `ports` (`id`),
  ADD CONSTRAINT `route_ibfk_3` FOREIGN KEY (`departurePortId`) REFERENCES `ports` (`id`);

--
-- Tablo kısıtlamaları `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`memberId`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`datedVoyageId`) REFERENCES `dated_voyage` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
