-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 Jan 2023 pada 04.52
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset`
--

CREATE TABLE `asset` (
  `id_asset` varchar(3) NOT NULL,
  `name_asset` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asset`
--

INSERT INTO `asset` (`id_asset`, `name_asset`) VALUES
('A01', 'Bergerak'),
('A02', 'Tidak Bergerak'),
('A03', 'Barang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clean_instrument`
--

CREATE TABLE `clean_instrument` (
  `id_clean` varchar(6) NOT NULL,
  `instrument_clean` varchar(50) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `clean_instrument`
--

INSERT INTO `clean_instrument` (`id_clean`, `instrument_clean`, `descript`) VALUES
('ICL001', 'Lantai', 'Lantai bebas debu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cluster`
--

CREATE TABLE `cluster` (
  `id_cluster` varchar(3) NOT NULL,
  `name_cluster` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cluster`
--

INSERT INTO `cluster` (`id_cluster`, `name_cluster`) VALUES
('SRP', 'Sarpras');

-- --------------------------------------------------------

--
-- Struktur dari tabel `complet_instrument`
--

CREATE TABLE `complet_instrument` (
  `id_complet` varchar(6) NOT NULL,
  `instrument_complet` varchar(50) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `complet_instrument`
--

INSERT INTO `complet_instrument` (`id_complet`, `instrument_complet`, `descript`) VALUES
('ICM001', 'Bulpen', 'Keberadaan Bulpen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `depreciation`
--

CREATE TABLE `depreciation` (
  `no_deprec` varchar(7) NOT NULL,
  `no_label` varchar(7) NOT NULL,
  `year_procurement` year(4) NOT NULL,
  `economics_age` int(11) NOT NULL,
  `acquisition_cost` varchar(11) NOT NULL,
  `dep_per_year` varchar(11) NOT NULL,
  `remaining_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `depreciation`
--

INSERT INTO `depreciation` (`no_deprec`, `no_label`, `year_procurement`, `economics_age`, `acquisition_cost`, `dep_per_year`, `remaining_age`) VALUES
('ND00001', 'NL00001', 2000, 20, '3000000', '400000', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `label`
--

CREATE TABLE `label` (
  `no_label` varchar(7) NOT NULL,
  `unit` varchar(2) NOT NULL,
  `cluster` varchar(3) NOT NULL,
  `type` int(11) NOT NULL,
  `object` varchar(3) NOT NULL,
  `serial_number` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `source` varchar(20) NOT NULL,
  `room` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `label`
--

INSERT INTO `label` (`no_label`, `unit`, `cluster`, `type`, `object`, `serial_number`, `year`, `source`, `room`) VALUES
('NL00001', 'YS', 'SRP', 1, '01', 1, '2000', 'BOS', 'R001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `object`
--

CREATE TABLE `object` (
  `id_object` varchar(3) NOT NULL,
  `name_object` varchar(30) NOT NULL,
  `descript` text NOT NULL,
  `asset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `object`
--

INSERT INTO `object` (`id_object`, `name_object`, `descript`, `asset`) VALUES
('01', 'Meja', 'Meja Kayu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_cleaning`
--

CREATE TABLE `qc_cleaning` (
  `no_clean` varchar(8) NOT NULL,
  `date` date NOT NULL,
  `room` varchar(4) NOT NULL,
  `instrument` varchar(8) NOT NULL,
  `clean` varchar(7) NOT NULL,
  `status` int(11) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_completness`
--

CREATE TABLE `qc_completness` (
  `no_complet` int(11) NOT NULL,
  `date` date NOT NULL,
  `room` int(11) NOT NULL,
  `instrument` int(11) NOT NULL,
  `existance` varchar(5) NOT NULL,
  `status` int(11) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_infrastructure`
--

CREATE TABLE `qc_infrastructure` (
  `no_infra` varchar(7) NOT NULL,
  `date` date NOT NULL,
  `label` varchar(7) NOT NULL,
  `status` int(11) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_room_clean`
--

CREATE TABLE `qc_room_clean` (
  `qc_rclean` varchar(8) NOT NULL,
  `room` varchar(4) NOT NULL,
  `instrument` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_room_clean`
--

INSERT INTO `qc_room_clean` (`qc_rclean`, `room`, `instrument`) VALUES
('QRL00001', 'R002', 'ICL001'),
('QRL00002', 'R002', 'ICL001'),
('QRL00003', 'R002', 'ICL001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_room_complet`
--

CREATE TABLE `qc_room_complet` (
  `qc_rcomplet` varchar(8) NOT NULL,
  `room` varchar(4) NOT NULL,
  `instrument` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_room_complet`
--

INSERT INTO `qc_room_complet` (`qc_rcomplet`, `room`, `instrument`) VALUES
('QRM00001', 'R002', 'ICM001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `name_role`) VALUES
(1, 'Admin'),
(2, 'Quality Control'),
(3, 'PIC'),
(4, 'Kabag Sarpras'),
(5, 'Sarpras'),
(6, 'Keuangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room`
--

CREATE TABLE `room` (
  `id_room` varchar(4) NOT NULL,
  `name_room` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `pic` varchar(8) NOT NULL,
  `kind` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `room`
--

INSERT INTO `room` (`id_room`, `name_room`, `location`, `pic`, `kind`) VALUES
('R001', 'Ruang Yayasan', 'Gedung A', '20100292', 'RK01'),
('R002', 'Ruang Staff', 'Gedung A', '20100291', 'RK01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_kind`
--

CREATE TABLE `room_kind` (
  `id_kind` varchar(4) NOT NULL,
  `name_kind` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `room_kind`
--

INSERT INTO `room_kind` (`id_kind`, `name_kind`) VALUES
('RK01', 'Urgent');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `name_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(25) NOT NULL,
  `descript` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `type`
--

INSERT INTO `type` (`id_type`, `name_type`, `descript`) VALUES
(1, 'Meubeler', 'Bahan Kayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `id_unit` varchar(2) NOT NULL,
  `name_unit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`id_unit`, `name_unit`) VALUES
('YS', 'Yayasan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `niy` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `place_birth` varchar(50) NOT NULL,
  `date_birth` date NOT NULL,
  `address` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`niy`, `name`, `place_birth`, `date_birth`, `address`, `password`, `id_role`) VALUES
('20100290', 'RIfky Muzaki', 'Pasuruan', '0000-00-00', 'Pasuruan', 'e807f1fcf82d132f9bb018ca6738a19f', 4),
('20100291', 'Rifky Muzaki', 'Pasuruan', '2021-09-06', 'pasuruan', 'e807f1fcf82d132f9bb018ca6738a19f', 2),
('20100292', 'Rifky Muzaki Nur Salim', 'Pasuruan', '1996-01-26', 'Pasuruan', 'e807f1fcf82d132f9bb018ca6738a19f', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id_asset`);

--
-- Indexes for table `clean_instrument`
--
ALTER TABLE `clean_instrument`
  ADD PRIMARY KEY (`id_clean`);

--
-- Indexes for table `cluster`
--
ALTER TABLE `cluster`
  ADD PRIMARY KEY (`id_cluster`);

--
-- Indexes for table `complet_instrument`
--
ALTER TABLE `complet_instrument`
  ADD PRIMARY KEY (`id_complet`);

--
-- Indexes for table `depreciation`
--
ALTER TABLE `depreciation`
  ADD PRIMARY KEY (`no_deprec`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`no_label`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id_object`);

--
-- Indexes for table `qc_cleaning`
--
ALTER TABLE `qc_cleaning`
  ADD PRIMARY KEY (`no_clean`);

--
-- Indexes for table `qc_completness`
--
ALTER TABLE `qc_completness`
  ADD PRIMARY KEY (`no_complet`);

--
-- Indexes for table `qc_infrastructure`
--
ALTER TABLE `qc_infrastructure`
  ADD PRIMARY KEY (`no_infra`);

--
-- Indexes for table `qc_room_clean`
--
ALTER TABLE `qc_room_clean`
  ADD PRIMARY KEY (`qc_rclean`);

--
-- Indexes for table `qc_room_complet`
--
ALTER TABLE `qc_room_complet`
  ADD PRIMARY KEY (`qc_rcomplet`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `room_kind`
--
ALTER TABLE `room_kind`
  ADD PRIMARY KEY (`id_kind`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`niy`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
