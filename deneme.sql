-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 Tem 2023, 14:27:54
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
  `date` date NOT NULL COMMENT 'sefer tarihi',
  `time` time NOT NULL COMMENT 'sefer saati',
  `quota` int(11) NOT NULL COMMENT 'sefer kontenjanı',
  `voyageId` int(11) NOT NULL COMMENT 'Sefer kayıt numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ferries`
--

CREATE TABLE `ferries` (
  `id` int(11) NOT NULL COMMENT 'kayıt numarası',
  `name` int(11) NOT NULL COMMENT 'feribot adı',
  `routeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ferry_companies`
--

CREATE TABLE `ferry_companies` (
  `id` int(11) NOT NULL COMMENT 'kayıt numarası',
  `name` int(11) NOT NULL COMMENT 'firma adı',
  `ferryId` int(11) NOT NULL COMMENT 'feribot kayıt numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `greece_port`
--

CREATE TABLE `greece_port` (
  `id` int(11) NOT NULL COMMENT 'Yunanistan liman kayıt numarası',
  `portPoint` varchar(50) NOT NULL COMMENT 'Yunanistan Liman Yeri',
  `portName` varchar(50) NOT NULL COMMENT 'Yunanistan Liman Adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `greece_port`
--

INSERT INTO `greece_port` (`id`, `portPoint`, `portName`) VALUES
(1, 'Kos', 'Kos Port'),
(2, 'Midilli', 'Midilli Port'),
(3, 'Rodos', 'Touristiko Port'),
(4, 'Sakız', 'Chios Port'),
(5, 'Samos', 'Vathi Port');

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
  `email` int(255) NOT NULL COMMENT 'e-posta',
  `tel` int(10) NOT NULL COMMENT 'telefon numarası',
  `citizenId` int(11) NOT NULL COMMENT 'Tc kimlik numarası',
  `passportId` int(9) NOT NULL COMMENT 'pasaport numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `member`
--

INSERT INTO `member` (`id`, `username`, `pass`, `firstname`, `lastname`, `birthday`, `sex`, `email`, `tel`, `citizenId`, `passportId`) VALUES
(4, 'mcan35', 'e10adc3949ba59abbe56e057f20f883e', 'Mustafa Can', 'Ersen', '1996-08-25', 'Erkek', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL COMMENT 'rota kayıt numarası',
  `tukeyPortId` int(11) NOT NULL,
  `greecePortId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `route`
--

INSERT INTO `route` (`id`, `tukeyPortId`, `greecePortId`) VALUES
(4, 1, 2),
(1, 2, 1),
(2, 3, 1),
(7, 4, 4),
(5, 5, 3),
(8, 6, 5),
(6, 7, 3),
(3, 8, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL COMMENT 'satış kayıt numarası',
  `datedVoyageId` int(11) NOT NULL COMMENT 'tarihli seferin kayıt numarası',
  `numberOfAdults` int(11) NOT NULL COMMENT 'yetişkin sayısı',
  `numberOfChilderen` int(11) NOT NULL COMMENT 'çocuk sayısı',
  `numberOfBabies` int(11) NOT NULL COMMENT 'bebek sayısı',
  `totalFee` int(11) NOT NULL COMMENT 'toplam ucret',
  `voucher` int(11) NOT NULL COMMENT 'Voucher(sipariş) numarası',
  `memberId` int(11) NOT NULL COMMENT 'üye bilgileri kayıt numarası'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `turkey_port`
--

CREATE TABLE `turkey_port` (
  `id` int(11) NOT NULL COMMENT 'Türkiye liman kayıt numarası',
  `portPoint` varchar(50) NOT NULL COMMENT 'Türkiye liman yeri adı',
  `portName` varchar(50) NOT NULL COMMENT 'Türkiye liman adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `turkey_port`
--

INSERT INTO `turkey_port` (`id`, `portPoint`, `portName`) VALUES
(1, 'Ayvalık', 'Ayvalık Port'),
(2, 'Bodrum', 'Bodrum Kale Port'),
(3, 'Bodrum', 'Bodrum Cruise Port'),
(4, 'Çeşme', 'Ulusoy Port'),
(5, 'Fethiye', 'Fethiye Liman'),
(6, 'Kuşadası', 'Büyük Liman'),
(7, 'Marmaris', 'Marmaris Cruise Port'),
(8, 'Turgutreis', 'D-Marin Port');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `voyages`
--

CREATE TABLE `voyages` (
  `id` int(11) NOT NULL COMMENT 'sefer kayıt numarası',
  `departurePoint` varchar(50) NOT NULL COMMENT 'kalkış noktası',
  `destinationPoint` varchar(50) NOT NULL COMMENT 'varış noktası',
  `duration` int(11) NOT NULL COMMENT 'seyahat süresi',
  `ferryId` int(11) NOT NULL COMMENT 'feribot kayıt numarası',
  `adultFee` int(11) NOT NULL COMMENT 'yetişkin sefer ücreti',
  `childFee` int(11) NOT NULL COMMENT 'çocuk ücret',
  `babyFee` int(11) NOT NULL COMMENT 'bebek ücret'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dated_voyage`
--
ALTER TABLE `dated_voyage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voyageId` (`voyageId`);

--
-- Tablo için indeksler `ferries`
--
ALTER TABLE `ferries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routeId` (`routeId`);

--
-- Tablo için indeksler `ferry_companies`
--
ALTER TABLE `ferry_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ferryId` (`ferryId`);

--
-- Tablo için indeksler `greece_port`
--
ALTER TABLE `greece_port`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tukeyPortId` (`tukeyPortId`,`greecePortId`);

--
-- Tablo için indeksler `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `memberId` (`memberId`),
  ADD UNIQUE KEY `datedVoyageId` (`datedVoyageId`);

--
-- Tablo için indeksler `turkey_port`
--
ALTER TABLE `turkey_port`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `voyages`
--
ALTER TABLE `voyages`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `dated_voyage`
--
ALTER TABLE `dated_voyage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası';

--
-- Tablo için AUTO_INCREMENT değeri `ferries`
--
ALTER TABLE `ferries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası';

--
-- Tablo için AUTO_INCREMENT değeri `ferry_companies`
--
ALTER TABLE `ferry_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası';

--
-- Tablo için AUTO_INCREMENT değeri `greece_port`
--
ALTER TABLE `greece_port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Yunanistan liman kayıt numarası', AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'kayıt numarası', AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'rota kayıt numarası', AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'satış kayıt numarası';

--
-- Tablo için AUTO_INCREMENT değeri `turkey_port`
--
ALTER TABLE `turkey_port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Türkiye liman kayıt numarası', AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `voyages`
--
ALTER TABLE `voyages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'sefer kayıt numarası';

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `dated_voyage`
--
ALTER TABLE `dated_voyage`
  ADD CONSTRAINT `dated_voyage_ibfk_1` FOREIGN KEY (`voyageId`) REFERENCES `voyages` (`id`);

--
-- Tablo kısıtlamaları `ferries`
--
ALTER TABLE `ferries`
  ADD CONSTRAINT `ferries_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ferry_companies` (`id`),
  ADD CONSTRAINT `ferries_ibfk_2` FOREIGN KEY (`routeId`) REFERENCES `route` (`id`);

--
-- Tablo kısıtlamaları `ferry_companies`
--
ALTER TABLE `ferry_companies`
  ADD CONSTRAINT `ferry_companies_ibfk_1` FOREIGN KEY (`ferryId`) REFERENCES `ferries` (`id`),
  ADD CONSTRAINT `ferry_companies_ibfk_2` FOREIGN KEY (`id`) REFERENCES `ferries` (`id`);

--
-- Tablo kısıtlamaları `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`tukeyPortId`) REFERENCES `turkey_port` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`greecePortId`) REFERENCES `greece_port` (`id`);

--
-- Tablo kısıtlamaları `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`memberId`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`datedVoyageId`) REFERENCES `dated_voyage` (`id`);

--
-- Tablo kısıtlamaları `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `voyages_ibfk_1` FOREIGN KEY (`ferryId`) REFERENCES `ferries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
