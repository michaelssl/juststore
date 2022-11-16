-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 01:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juststoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `image_category` varchar(255) NOT NULL,
  `date_update_category` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `image_category`, `date_update_category`) VALUES
(1, 'men fashion', 'men_category.png', '2020-11-17 14:16:54'),
(2, 'baby category', 'baby_category.png', '2020-11-17 14:17:43'),
(5, 'sport', '20201117084834sport_category.png', '2020-11-17 14:48:34'),
(6, 'Game', '20201117104759game_category.png', '2020-11-17 16:47:59'),
(7, 'women fashion', '20201117104820women_category.png', '2020-11-17 16:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id_courier` int(11) NOT NULL,
  `name_courier` varchar(255) NOT NULL,
  `price_courier` int(11) NOT NULL,
  `image_courier` varchar(255) NOT NULL,
  `date_update_courier` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id_courier`, `name_courier`, `price_courier`, `image_courier`, `date_update_courier`) VALUES
(1, 'JNE', 9000, 'jne_logo.png', '2020-11-16 22:44:34'),
(3, 'J&T', 10000, 'jnt_logo.jpg', '2020-11-16 22:45:23'),
(7, 'TIKI', 8000, '20201117075135tiki_logo.png', '2020-11-17 13:51:35'),
(8, 'pasta flash', 20000, '20201117080121pasta.jpg', '2020-11-17 14:01:21');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `name_member` varchar(255) NOT NULL,
  `gender_member` varchar(255) NOT NULL,
  `address_member` varchar(255) NOT NULL,
  `phone_member` varchar(20) NOT NULL,
  `email_member` varchar(255) NOT NULL,
  `password_member` varchar(255) NOT NULL,
  `image_member` varchar(255) NOT NULL DEFAULT 'profile_default.png',
  `role_member` varchar(255) NOT NULL DEFAULT 'member',
  `verified` int(11) NOT NULL DEFAULT 0,
  `vkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `name_member`, `gender_member`, `address_member`, `phone_member`, `email_member`, `password_member`, `image_member`, `role_member`, `verified`, `vkey`) VALUES
(1, 'admin 1', 'Male', 'jln pahlawan', '089612345678', 'admin1@gmail.com', '0192023a7bbd73250516f069df18b500', 'profile_default.png', 'admin', 1, '0'),
(16, 'michael susilo', 'Male', 'asdasdsadsdasdasd', '085952756623', 'phpsender123@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '5166062f2c769429e130f05eeb48afcf'),
(17, 'staff1', 'Male', 'jln nusantara n5', '085912345678', 'staff1@gmail.com', 'de9bf5643eabf80f4a56fda3bbb84483', '20201116091731headphone.jpg', 'staff', 1, '2fe7c6ba72c306cdef483b5eab769a57'),
(18, 'angels', 'Female', 'jln merpati putih no20', '085912345699', 'angel@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', '20201116143227mac.jpg', 'member', 1, '4124e3238c3b12b15b05f4935d3c9d06'),
(19, 'staff2', 'Female', 'jln hasanudi no70', '089612345679', 'staff2@gmail.com', 'de9bf5643eabf80f4a56fda3bbb84483', 'profile_default.png', 'staff', 1, ''),
(21, 'winata', 'Male', 'jln bunyamin res', '081812345679', 'winata@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '51fe126a547ff6aeb7fd2ed6782458b3'),
(22, 'tono yono', 'Male', 'jln sembarang no2', '085912345679', 'tono@yahoo.com', 'efe6398127928f1b2e9ef3207fb82663', 'profile_default.png', 'staff', 1, ''),
(23, 'donny', 'Male', 'jln pramuka darat', '085912345679', 'donny@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'staff', 1, ''),
(24, 'staff3', 'Female', 'jln lumba lumba', '085912345679', 'staff3@gmail.com', 'de9bf5643eabf80f4a56fda3bbb84483', 'profile_default.png', 'staff', 1, ''),
(25, 'hello', 'Female', 'jln hello world', '085912345678', 'hello@hello.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, 'ad1f2c2edd03eeebd314b306cb8fb97c'),
(26, 'world', 'Male', 'jln world hellow', '085912345679', 'world@world.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, 'eb8841c89153f8bb7edd1404d2033de3'),
(27, 'anto', 'Male', 'jln bunga mawar', '085952756623', 'anto@anto.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, 'bd7fa3a261c5123c1c12821a61bed626'),
(28, 'ana', 'Female', 'jln kura kura', '085912345678', 'ana@ana.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '1d6c8737c69b42b3f6aee37185bf8ea4'),
(29, 'joni', 'Male', 'jn angsara 3', '085912345679', 'joni@joni.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '48f668319c48a7b2790877a0d6e27b09'),
(30, 'mawar', 'Female', 'jln bunga tulip', '085912345678', 'mawar@mawar.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '6608b4f08fa0f7b90b50d5ba2ac2d5b3'),
(31, 'andreas', 'Male', 'jln rumah belakang', '085912345678', 'andre@andre.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 1, '39e947739131b840043ca113fd549a6c'),
(32, 'yuni', 'Female', 'jln kebayoran 4', '085912345678', 'yuni@yuni.com', 'a8f5f167f44f4964e6c998dee827110c', 'profile_default.png', 'member', 0, 'a49509ef25bbec863346e7093d667478');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `description_product` varchar(255) NOT NULL,
  `price_product` int(11) NOT NULL,
  `stock_product` int(11) NOT NULL,
  `image_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_category`, `name_product`, `description_product`, `price_product`, `stock_product`, `image_product`) VALUES
(1, 1, 'jacket', 'jacket kulit terbaru.  nyaman di gunakan                        ', 200000, 5, '20201117115948jacket.jpg'),
(2, 5, 'bola basket', 'bola basket ori.', 150000, 4, 'basket.jpg'),
(3, 2, 'mainan pirate', 'mainkan bersama teman-teman anda.', 100000, 4, 'kidtoy2.jpg'),
(5, 1, 'T-shirt', 'kaos polos nyaman digunakan            ', 75000, 20, '20201118070611tshirt.jpg'),
(6, 5, 'Raket', 'raket original', 200000, 5, '20201118071002raket.jpg'),
(7, 6, 'Assasin creed', 'game ori ps            ', 400000, 9, '20201118071150game.jpg'),
(8, 6, 'Lego ps4', 'Game PS4 , lego', 350000, 4, '20201118173234game2.jpg'),
(9, 2, 'Mainan Anak', 'mainan anak, mantap', 300000, 13, '20201118173321kidtoy.jpg'),
(10, 7, 'dress', 'dress hijau', 250000, 14, '20201118173408dress.jpg'),
(11, 5, 'bola sepak', 'bola sepak ori', 420000, 19, '20201118173441bola.jpg'),
(12, 5, 'baju bola', 'Baju bola timnas brazil. nyaman digunakan', 150000, 11, '20201119112428bajubola1.jpg'),
(13, 5, 'baju bola nike', 'baju bola NIKE', 125000, 14, '20201119112455bajubola2.jpg'),
(14, 7, 'dress wanita', 'dress wanita warna merah', 350000, 8, '20201119112522dress2.jpg'),
(15, 6, 'PUBG ps4', 'game ps4 PUBG ', 199000, 14, '20201119112552game3.jpg'),
(16, 6, 'Spider Man ps4', 'game spider man untuk ps4', 500000, 14, '20201119112620game4.jpg'),
(17, 6, 'mario party switch', 'mario party game untuk nintendo switch', 475000, 9, '20201119112701game5.jpg'),
(18, 6, 'Animal Crossing', 'game animal crossing untuk nitendo switch', 600000, 19, '20201119112736game6.jpg'),
(19, 7, 'High Heels', 'high heel wanita', 370000, 19, '20201119112803highheels.jpg'),
(20, 1, 'jacket biru', 'jacket biru nyaman dan mantap', 250000, 19, '20201119112838jacket3.jpg'),
(21, 1, 'jeans', 'jeans pria, nyaman digunakan', 399000, 19, '20201119112906jeans.jpg'),
(22, 1, 'jeans biru', 'jeans pria warna biru', 399000, 19, '20201119112937jeans2.jpg'),
(23, 2, 'mainan rumah', 'mainan untuk anak anak', 235000, 14, '20201119113013kidtoy3.jpg'),
(24, 1, 'sepatu', 'sepatu nyaman digunakan', 175000, 19, '20201119113038sepatu.jpg'),
(25, 1, 'sepatu merah', 'sepatu merah nyaman digunakan dan mantap', 350000, 14, '20201119113106sepatu2.jpg'),
(26, 1, 'sepatu bagus', 'sepatu bagus dan nyaman digunakan', 300000, 14, '20201119113146sepatu3.jpg'),
(27, 7, 'High Heels hitam', 'high heels hitam untuk wanita', 300000, 19, '20201119113221women shoes.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rating_review` int(11) NOT NULL,
  `isi_review` varchar(255) DEFAULT NULL,
  `date_review` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `id_member`, `id_product`, `rating_review`, `isi_review`, `date_review`) VALUES
(1, 16, 1, 5, 'mantap', '2020-11-18 21:03:38'),
(2, 16, 5, 4, 'bagus', '2020-11-18 21:11:19'),
(3, 16, 6, 2, 'mahal', '2020-11-18 21:56:55'),
(4, 25, 2, 4, 'bola nya bagus', '2020-11-18 23:25:03'),
(5, 25, 6, 3, 'kurang nyaman dipakai', '2020-11-18 23:25:18'),
(6, 25, 5, 5, 'bahan nya bagus, nyaman digunakan\r\n', '2020-11-18 23:25:39'),
(7, 26, 5, 4, 'mantul\r\n', '2020-11-18 23:30:33'),
(8, 26, 3, 4, 'fun ', '2020-11-18 23:30:41'),
(9, 26, 1, 4, 'keren ', '2020-11-18 23:30:49'),
(10, 21, 11, 5, 'mantap', '2020-11-18 23:47:20'),
(11, 27, 18, 5, 'mantap', '2020-11-19 18:31:17'),
(12, 27, 13, 4, 'nyaman digunakan', '2020-11-19 18:31:27'),
(13, 27, 20, 5, 'keren', '2020-11-19 18:31:35'),
(14, 27, 15, 5, 'seru', '2020-11-19 18:31:42'),
(15, 28, 14, 5, 'cantik', '2020-11-19 18:33:19'),
(16, 28, 19, 5, 'mantap', '2020-11-19 18:33:25'),
(17, 28, 10, 3, 'kurang nyaman', '2020-11-19 18:33:34'),
(18, 28, 27, 5, 'mantap aku suka banget', '2020-11-19 18:33:44'),
(19, 29, 21, 5, 'suka banget', '2020-11-19 18:35:43'),
(20, 29, 25, 5, 'keren', '2020-11-19 18:35:54'),
(21, 29, 26, 4, 'nyaman', '2020-11-19 18:36:02'),
(22, 29, 12, 1, 'tidak nyaman digunakan', '2020-11-19 18:36:12'),
(23, 30, 23, 5, 'cantik suka banget', '2020-11-19 18:38:04'),
(24, 30, 14, 5, 'cantik suka bangettt', '2020-11-19 18:38:13'),
(25, 30, 17, 4, 'game seru', '2020-11-19 18:38:22'),
(26, 31, 9, 5, 'mantap', '2020-11-19 18:41:20'),
(27, 31, 7, 4, 'keren', '2020-11-19 18:41:26'),
(28, 31, 8, 2, 'tidak seru', '2020-11-19 18:41:32'),
(29, 31, 24, 5, 'nyaman saya suka', '2020-11-19 18:41:43'),
(30, 31, 22, 5, 'mantap nyaman', '2020-11-19 18:47:17'),
(31, 31, 16, 5, 'keren suka banget', '2020-11-19 18:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `sequence_slider` int(11) NOT NULL,
  `name_slider` varchar(255) NOT NULL,
  `hyperlink_slider` varchar(255) NOT NULL,
  `date_start_slider` datetime NOT NULL,
  `date_end_slider` datetime DEFAULT NULL,
  `image_slider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `sequence_slider`, `name_slider`, `hyperlink_slider`, `date_start_slider`, `date_end_slider`, `image_slider`) VALUES
(1, 5, 'slider youtube', 'https://www.youtube.com/', '2020-11-17 22:24:28', NULL, 'youtube_slider.jpg\r\n'),
(2, 2, 'slider twitter', 'https://twitter.com/', '2020-11-17 22:26:44', NULL, 'twitter_slider.jpg'),
(11, 1, 'instagram', 'https://www.instagram.com/', '2020-11-19 16:25:00', NULL, '20201119102548instagram_slider.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `address_transaction` varchar(255) NOT NULL,
  `phone_transaction` varchar(255) NOT NULL,
  `notes_transaction` varchar(255) NOT NULL,
  `total_transaction` int(11) NOT NULL,
  `date_transaction` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_member`, `id_courier`, `address_transaction`, `phone_transaction`, `notes_transaction`, `total_transaction`, `date_transaction`) VALUES
(3, 1, 8, 'jln manggis', '085952756623', '              ', 370000, '2020-11-18 18:00:48'),
(5, 16, 3, 'jln darat', '085912345678', '              ', 285000, '2020-11-18 18:07:00'),
(6, 16, 7, 'jln mwar', '085912345678', '              ', 608000, '2020-11-18 19:17:23'),
(7, 16, 7, 'jln ok no', '085912345679', 'pengiriman cepat  ', 208000, '2020-11-18 19:18:29'),
(8, 25, 8, 'jln helloworld', '085912345678', 'shirt warna biru', 445000, '2020-11-18 23:24:47'),
(9, 26, 1, 'jln world hellow', '085912345679', '              ', 384000, '2020-11-18 23:28:30'),
(10, 21, 3, 'jln pal 8 jauh', '085912345679', '              ', 430000, '2020-11-18 23:47:06'),
(11, 27, 3, 'jln bunga mawa', '085952756623', 'pengiriman yang cepat', 1184000, '2020-11-19 18:31:08'),
(12, 28, 7, 'jln kura kura no5', '085952756623', '              ', 1278000, '2020-11-19 18:33:11'),
(13, 29, 8, 'jln angsana no90', '085952756623', 'yang cepat kirimnya', 1219000, '2020-11-19 18:35:36'),
(14, 30, 7, 'jln tulip barat', '085912345679', '              ', 1068000, '2020-11-19 18:37:50'),
(15, 31, 7, 'jln ayo maju ', '085912345678', '              ', 1533000, '2020-11-19 18:41:13'),
(16, 31, 7, 'jln kendaran no3', '085912345678', '              ', 907000, '2020-11-19 18:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id_transaction_detail` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id_transaction_detail`, `id_transaction`, `id_product`, `qty_product`) VALUES
(1, 3, 3, 2),
(2, 3, 2, 1),
(6, 5, 1, 1),
(7, 5, 5, 1),
(8, 6, 3, 2),
(9, 6, 7, 1),
(10, 7, 6, 1),
(11, 8, 2, 1),
(12, 8, 6, 1),
(13, 8, 5, 1),
(14, 9, 5, 1),
(15, 9, 3, 1),
(16, 9, 1, 1),
(17, 10, 11, 1),
(18, 11, 18, 1),
(19, 11, 13, 1),
(20, 11, 20, 1),
(21, 11, 15, 1),
(22, 12, 14, 1),
(23, 12, 19, 1),
(24, 12, 10, 1),
(25, 12, 27, 1),
(26, 13, 21, 1),
(27, 13, 25, 1),
(28, 13, 26, 1),
(29, 13, 12, 1),
(30, 14, 23, 1),
(31, 14, 14, 1),
(32, 14, 17, 1),
(33, 15, 9, 2),
(34, 15, 7, 1),
(35, 15, 8, 1),
(36, 15, 24, 1),
(37, 16, 16, 1),
(38, 16, 22, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id_courier`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_courier` (`id_courier`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id_transaction_detail`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id_transaction_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_courier`) REFERENCES `courier` (`id_courier`);

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
