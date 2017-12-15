-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2017 at 02:25 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `berteman`
--

CREATE TABLE `berteman` (
  `EMAIL` varchar(64) COLLATE utf8_bin NOT NULL,
  `PEN_EMAIL` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `berteman`
--

INSERT INTO `berteman` (`EMAIL`, `PEN_EMAIL`) VALUES
('wahiid.ari@gmail.com', 'admin@gmail.com'),
('wahiid.ari@gmail.com', 'farid@gmail.com'),
('wahiid.ari@gmail.com', 'rizki@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `USERNAME` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `FULLNAME` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `ADDRESS` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL` varchar(64) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `PHONE` varchar(12) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Menyimpan Informasi Dari Pengguna';

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`USERNAME`, `FULLNAME`, `ADDRESS`, `EMAIL`, `PASSWORD`, `PHONE`) VALUES
('admin', 'Admin ', 'Bangkalan', 'admin@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '087850866665'),
('dian', 'Watsiqatut Dianah', 'Bangkalan', 'dian@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '085203987358'),
('farid', 'Faridul Umam', 'Bangkalan', 'farid@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '081234567891'),
('rizki', 'Rizki Aditya', 'Bangkalan', 'rizki@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '085334904504'),
('wahidari', 'Wahid Arinanto Nugroho', 'Bangkalan', 'wahiid.ari@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '087850866665');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID_STATUS` int(11) NOT NULL,
  `EMAIL` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `ISI_STATUS` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `TANGGAL_STATUS` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabel Yang Menyimpan Status Dari User';

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID_STATUS`, `EMAIL`, `ISI_STATUS`, `TANGGAL_STATUS`) VALUES
(1, 'admin@gmail.com', '\"Hidup itu sangat sederhana, tapi kita yang membuat hidup menjadi rumit.\"\r\n~ Confucius', '2017-12-06 12:27:12'),
(2, 'wahiid.ari@gmail.com', '\"Pertama, mereka mengabaikan anda. Kemudian, mereka tertawa pada anda. Berikutnya, mereka melawan anda. Lalu, anda menang.\"\r\n\r\n~ Mahatma Gandhi', '2017-12-06 14:17:00'),
(3, 'farid@gmail.com', 'Jika kamu dilempar batu oleh seseorang, janganlah membalasnya melempar balik dengan batu, tapi balaslah dengan melempar bunga kepadanya. Tapi usahakan potnya ikut juga.', '2017-12-08 21:04:01'),
(4, 'wahiid.ari@gmail.com', 'â€œKepuasan membuat orang-orang miskin menjadi kaya; ketidakpuasan membuat orang-orang kaya menjadi miskin.â€\r\n\r\n~ Benyamin Franklin', '2017-12-06 14:29:00'),
(5, 'wahiid.ari@gmail.com', 'â€œBekerjalah seperti Anda tidak membutuhkan uang. Mencintailah seperti Anda tidak pernah tersakiti. Menarilah seolah olah tidak ada yang melihat.â€\r\n\r\n~ Satchel Paige', '2017-12-08 20:42:16'),
(6, 'rizki@gmail.com', 'Hidup ini memang keras, penuh perjuangan. Tetapi kamu harus lebih keras, kamu harus lebih kuat untuk menaklukkannya.', '2017-12-08 20:59:22'),
(7, 'farid@gmail.com', 'Orang yang tulus dalam menyayangi dan mencintaimu adalah orang yang terakhir kali kamu lihat masih setia menemanimu di saat kamu terpuruk.', '2017-12-08 21:05:11'),
(8, 'dian@gmail.com', 'Kamu tidak akan pernah mencapai sebuah kesuksesan sejati, kecuali kamu mencintai apa yang kamu kerjakan.', '2017-12-08 21:02:23'),
(9, 'admin@gmail.com', '\"Orang sukses akan mengambil keuntungan dari kesalahan dan mencoba lagi dengan cara yang berbeda.\"\r\n~ Dale Carnegie', '2017-12-06 13:17:00'),
(10, 'rizki@gmail.com', 'Ubahlah hidup anda hari ini, jangan pernah bertaruh untuk masa depan. Bersaksilah sekarang, tanpa menunda-nunda â€“ simone de beauvoir', '2017-12-08 21:00:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berteman`
--
ALTER TABLE `berteman`
  ADD PRIMARY KEY (`EMAIL`,`PEN_EMAIL`),
  ADD KEY `FK_BERTEMAN2` (`PEN_EMAIL`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STATUS`),
  ADD KEY `FK_MEMBUAT` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `berteman`
--
ALTER TABLE `berteman`
  ADD CONSTRAINT `FK_BERTEMAN` FOREIGN KEY (`EMAIL`) REFERENCES `pengguna` (`EMAIL`),
  ADD CONSTRAINT `FK_BERTEMAN2` FOREIGN KEY (`PEN_EMAIL`) REFERENCES `pengguna` (`EMAIL`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `FK_MEMBUAT` FOREIGN KEY (`EMAIL`) REFERENCES `pengguna` (`EMAIL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
