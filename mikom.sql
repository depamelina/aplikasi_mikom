-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2022 pada 10.08
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mikom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `divisi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id`, `divisi`) VALUES
(2, 'Network Engineering'),
(4, 'Inputer'),
(7, 'Marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jamkerja`
--

CREATE TABLE `jamkerja` (
  `id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_in` varchar(5) NOT NULL,
  `jam_out` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jamkerja`
--

INSERT INTO `jamkerja` (`id`, `hari`, `jam_in`, `jam_out`) VALUES
(2, 'Senin', '08:00', '17:00'),
(3, 'Selasa', '08:00', '17:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'Peserta'),
(3, 'Pembimbing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `username` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `teach`
--

CREATE TABLE `teach` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `id_tele` varchar(20) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `teach`
--

INSERT INTO `teach` (`id`, `nik`, `password`, `nama`, `id_divisi`, `email`, `no_hp`, `id_tele`, `foto`) VALUES
(3, '11111', 'haha', 'Daniel Radcliffe', 4, 'haha@g.com', '8903892', '091931', NULL),
(5, '1343', 'kjkkdksmd', 'Hermione', 2, '787@g.com', '0918913', '011111', 'fotomu'),
(8, '901029', 'jjhjhjhj', 'i love u', 2, 'admin@ad.com', '0982uuw', '98198uw', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `id_level` varchar(15) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_mentor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `id_level`, `id_divisi`, `foto`, `id_mentor`) VALUES
('123', 'jkjk', 'hjhhi', 'user', 2, 'admin.png', 5),
('daniel10', 'daniel', 'kang daniel', 'mentor', 2, 'admin.png', 5),
('depa', 'depa', 'Depa Melina', 'admin', 2, 'foto', 70401),
('jihooni', 'jihoon', 'jihoon', 'mentor', 7, NULL, NULL),
('kk', 'llklklk', 'kk', 'mentor', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_detail`
--

CREATE TABLE `users_detail` (
  `username` varchar(25) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` varchar(10) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `asal_sekolah` varchar(25) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `id_tele` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `surat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_detail`
--

INSERT INTO `users_detail` (`username`, `tgl_lahir`, `jk`, `no_tlp`, `asal_sekolah`, `email`, `id_tele`, `alamat`, `tgl_mulai`, `tgl_akhir`, `surat`) VALUES
('daniel10', '2019-09-09', 'Laki-laki', '09892834', 'hoho', 'kangdan@gmail.com', '980024390', 'alamatttku', '2021-09-09', '2022-09-09', NULL),
('hahay', NULL, '', '08989982', NULL, 'depa@gmail.com', '0898989w2', '', NULL, NULL, NULL),
('jihooni', NULL, '', '0898090', NULL, 'sds@sd.scs', '09898909', '', NULL, NULL, NULL),
('kk', NULL, '', '009090', NULL, 'jisoo@gmail.com', 'i908090', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jamkerja`
--
ALTER TABLE `jamkerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `teach`
--
ALTER TABLE `teach`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jamkerja`
--
ALTER TABLE `jamkerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `username` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `teach`
--
ALTER TABLE `teach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
