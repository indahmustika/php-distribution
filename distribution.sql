-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Nov 2021 pada 00.40
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distribution`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `CartId` int(11) NOT NULL,
  `UserInternalId` varchar(50) NOT NULL,
  `InvInternalId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `OrderId` int(11) NOT NULL,
  `UserInternalId` varchar(50) NOT NULL,
  `InvInternalId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`OrderId`, `UserInternalId`, `InvInternalId`, `Quantity`, `Status`) VALUES
(2, 'diahayu', 1, 3, 'Shipped'),
(3, 'indahmustika', 7, 2, 'Shipped');

-- --------------------------------------------------------

--
-- Struktur dari tabel `container`
--

CREATE TABLE `container` (
  `ContainerId` int(11) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `Volume` varchar(50) NOT NULL,
  `Remarks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `container`
--

INSERT INTO `container` (`ContainerId`, `Code`, `Volume`, `Remarks`) VALUES
(1, 'Cargo 20 Foot 18600', '5.932 m x 2.350 m x 2.410 m', 'Shipped'),
(2, 'Cargo 40 Foot 27340', '12.043 m x 2.336 m x 2.379 m', 'Empty'),
(3, 'Cargo 20 Foot 18161', '5.918 m x 2.337 m x 2.146 m', 'Empty');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory`
--

CREATE TABLE `inventory` (
  `InventoryId` int(11) NOT NULL,
  `InventoryName` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Volume` varchar(50) NOT NULL,
  `BuyPrice` int(11) NOT NULL,
  `SellPrice` int(11) DEFAULT NULL,
  `Unit` varchar(10) NOT NULL,
  `Weight` int(11) NOT NULL,
  `UserCreated` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`InventoryId`, `InventoryName`, `Image`, `Volume`, `BuyPrice`, `SellPrice`, `Unit`, `Weight`, `UserCreated`) VALUES
(1, 'Pira Metropolis Alba BL 80', '1.jpeg', '79.9 cm x 38 cm x 120 cm', 520000, 571000, 'Kilograms', 29, 'kartiani'),
(2, 'Pira Metropolis Alba RSG 4', '2.jpeg', '42 cm x 40 cm x 120 cm', 315000, NULL, 'Kilograms', 22, 'kartiani'),
(3, 'Pira Metropolis Alba 2MN ', '3.jpeg', '79.9 cm x 43 cm x 182 cm', 825000, NULL, 'Kilograms', 48, 'kartiani'),
(4, 'Pira Metropolis Taco MK', '5.jpeg', '120 cm x 51 cm x 95 cm', 615000, NULL, 'Kilograms', 29, 'kartiani'),
(5, 'Pira Metropolis Clarisa NS', '6.jpeg', '29.6 cm x 23.6 cm x 48 cm', 110000, NULL, 'Kilograms', 5, 'kartiani'),
(6, 'Pira Metropolis Isaak DC', '7.jpeg', '120 cm x 48 cm x 75.5 cm', 420000, NULL, 'Kilograms', 17, 'kartiani'),
(7, 'Pira Kids Boho BC60', '8.jpeg', '61 cm x 29.6 cm x 80.5 cm', 425000, 483000, 'Kilograms', 6, 'kartiani'),
(8, 'Pira Kids Woody BC40', '9.jpeg', '39.8 cm x 29.8 cm x 106.5 cm', 320000, NULL, 'Kilograms', 11, 'kartiani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping`
--

CREATE TABLE `shipping` (
  `ShippingId` int(11) NOT NULL,
  `ContainerInternalId` int(11) NOT NULL,
  `OrderInternalId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shipping`
--

INSERT INTO `shipping` (`ShippingId`, `ContainerInternalId`, `OrderInternalId`) VALUES
(11, 1, 2),
(12, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `Username` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`Username`, `Name`, `Email`, `Phone`, `Role`, `Password`) VALUES
('diahayu', 'Diah Ayu Mustika', 'diahayu12@gmail.com', '085856388211', 'Buyer', '12345'),
('indahmustika', 'Indah Mustika', 'indahmustika@gmail.com', '081443221112', 'Buyer', '12345'),
('kartiani', 'Kartiani Ningrum', 'kartiani@outlook.com', '081443221112', 'Seller', '12345'),
('mustofa', 'Mustofa', 'mustofa@gmail.com', '087123112223', 'Admin', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartId`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`OrderId`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`ContainerId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`InventoryId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ShippingId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `ContainerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `InventoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ShippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
