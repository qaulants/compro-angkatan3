-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 09:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angkatan3_compro`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `website_name` varchar(50) NOT NULL,
  `website_link` varchar(50) DEFAULT NULL,
  `website_phone` varchar(16) NOT NULL,
  `website_email` varchar(50) NOT NULL,
  `website_address` text NOT NULL,
  `twitter_link` varchar(100) DEFAULT NULL,
  `fb_link` varchar(100) DEFAULT NULL,
  `ig_link` varchar(100) DEFAULT NULL,
  `linkedin_link` varchar(100) DEFAULT NULL,
  `youtube_link` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `website_name`, `website_link`, `website_phone`, `website_email`, `website_address`, `twitter_link`, `fb_link`, `ig_link`, `linkedin_link`, `youtube_link`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'tsaqila1', 'https://web.whatsapp.com/', '081285968650', 'qaulantsaqila75@gmail.com', 'jl. Anggrek Cakra', NULL, NULL, NULL, NULL, NULL, 'kemenag.jpg', '2024-10-24 02:39:35', '2024-10-25 03:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `instruktur`
--

CREATE TABLE `instruktur` (
  `id` int(11) NOT NULL,
  `nama_instruktur` varchar(100) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `fb_ink` varchar(50) DEFAULT NULL,
  `ig_link` varchar(50) DEFAULT NULL,
  `twitter_link` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instruktur`
--

INSERT INTO `instruktur` (`id`, `nama_instruktur`, `nama_jurusan`, `foto`, `fb_ink`, `ig_link`, `twitter_link`, `created_at`, `updated_at`) VALUES
(3, 'Qaulan Tsaqila', 'Computer Science', 'XI4DIZZ7URMA5LUDUSERKVHCIA.jpg', NULL, NULL, NULL, '2024-10-25 04:18:15', '2024-10-25 07:10:01'),
(5, 'Qaulan Tsaqila', 'Computer Science', 'kemenag.jpg', NULL, NULL, NULL, '2024-10-25 07:35:42', '2024-10-25 07:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_profile`
--

CREATE TABLE `kategori_profile` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_profile`
--

INSERT INTO `kategori_profile` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'latar belakang', '2024-10-25 07:40:33', '2024-10-25 07:40:33'),
(2, 'visi misi', '2024-10-25 07:40:33', '2024-10-25 07:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'Qaulan Tsaqila', 'qaulantsaqila75@gmail.com', '12345678', '', '2024-10-23 02:56:47', '2024-10-23 04:45:13'),
(6, 'qaulan', 'admin@gmail.com', '', '', '2024-10-23 04:44:13', '2024-10-23 04:44:13'),
(7, 'Bellingham', 'administrator@gmail.com', '12345678', '', '2024-10-23 04:52:30', '2024-10-23 04:52:30'),
(9, 'Nonama', 'nama@gmail.com', '12345678', 'istockphoto-1443562748-612x612.jpg', '2024-10-23 07:26:25', '2024-10-23 07:26:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_profile`
--
ALTER TABLE `kategori_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_profile`
--
ALTER TABLE `kategori_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
