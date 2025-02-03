-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galleryy`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery_album`
--

CREATE TABLE `gallery_album` (
  `AlbumID` int(11) NOT NULL,
  `NamaAlbum` varchar(255) NOT NULL,
  `Deskripsi` text DEFAULT NULL,
  `TanggalDibuat` date NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_album`
--

INSERT INTO `gallery_album` (`AlbumID`, `NamaAlbum`, `Deskripsi`, `TanggalDibuat`, `UserID`) VALUES
(1, 'Album Gunung', 'Foto-foto Gunung', '2025-01-01', 1),
(2, 'Album Sunset dan Senja', 'Foto-foto Sunset dan Senja', '2025-02-14', 2),
(3, 'Album Banda Neira', 'Foto Banda Neira', '2025-03-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_foto`
--

CREATE TABLE `gallery_foto` (
  `FotoID` int(11) NOT NULL,
  `JudulFoto` varchar(255) DEFAULT NULL,
  `DeskripsiFoto` text DEFAULT NULL,
  `TanggalUnggah` date NOT NULL,
  `LokasiFile` varchar(255) NOT NULL,
  `AlbumID` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_foto`
--

INSERT INTO `gallery_foto` (`FotoID`, `JudulFoto`, `DeskripsiFoto`, `TanggalUnggah`, `LokasiFile`, `AlbumID`, `UserID`) VALUES
(1, 'Gunung', 'Pemandangan Gunung', '2025-01-02', 'GUNUNG.jpg', 1, 1),
(2, 'Sunset dan Senja', 'Foto Sunset dan Senja', '2025-02-15', 'sunset.jpg', 2, 2),
(3, 'Banda Neira', 'Banda Neira', '2025-03-12', 'banda-neira-island.jpg', 3, 3),
(4, 'Langit', 'Langit', '2025-07-01', 'langit9.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_komentarfoto`
--

CREATE TABLE `gallery_komentarfoto` (
  `KomentarID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IsiKomentar` text NOT NULL,
  `TanggalKomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_komentarfoto`
--

INSERT INTO `gallery_komentarfoto` (`KomentarID`, `FotoID`, `UserID`, `IsiKomentar`, `TanggalKomentar`) VALUES
(1, 1, 2, 'Wow indah sekali pemandagannya!', '2025-01-03'),
(2, 2, 1, 'Cantik sekali pemandangan alamnya', '2025-02-16'),
(3, 3, 2, 'Pemandangan yang sangat luar biasa', '2025-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_likefoto`
--

CREATE TABLE `gallery_likefoto` (
  `LikeID` int(11) NOT NULL,
  `FotoID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TanggalLike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_user`
--

CREATE TABLE `gallery_user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery_user`
--

INSERT INTO `gallery_user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`) VALUES
(1, 'john_doe', 'password123', 'john@example.com', 'John Doe', 'Jl. Contoh No. 123, Jakarta'),
(2, 'jane_doe', 'password456', 'jane@example.com', 'Jane Doe', 'Jl. Contoh No. 456, Jakarta'),
(3, 'alice_smith', 'password789', 'alice@example.com', 'Alice Smith', 'Jl. Alam Raya No. 789, Jakarta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD PRIMARY KEY (`FotoID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD PRIMARY KEY (`KomentarID`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `FotoID` (`FotoID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `gallery_user`
--
ALTER TABLE `gallery_user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  MODIFY `FotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  MODIFY `KomentarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_user`
--
ALTER TABLE `gallery_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD CONSTRAINT `gallery_album_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery_foto`
--
ALTER TABLE `gallery_foto`
  ADD CONSTRAINT `gallery_foto_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `gallery_album` (`AlbumID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_foto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery_komentarfoto`
--
ALTER TABLE `gallery_komentarfoto`
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_komentarfoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery_likefoto`
--
ALTER TABLE `gallery_likefoto`
  ADD CONSTRAINT `gallery_likefoto_ibfk_1` FOREIGN KEY (`FotoID`) REFERENCES `gallery_foto` (`FotoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_likefoto_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `gallery_user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
