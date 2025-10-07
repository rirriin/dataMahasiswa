-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2025 pada 13.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `ttl` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `nis` varchar(20) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `kelamin` enum('L','P') DEFAULT NULL COMMENT 'Jenis kelamin (L/P)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `ttl`, `alamat`, `nis`, `prodi`, `kelamin`, `created_at`, `updated_at`) VALUES
(17, 'Aiswatun Kholifah', '2008-07-06', 'Pesawahan', '237627', 'Informatika', 'P', '2025-10-07 10:36:29', '2025-10-07 10:36:29'),
(18, 'Aldyaz Budi Pratama', '2008-06-14', 'Bakalan', '237629', 'Kehutanan', 'L', '2025-10-07 10:36:59', '2025-10-07 10:36:59'),
(19, 'Alfiah Nur Aini', '2008-01-26', 'Wonosegoro', '237630', 'Multimedia', 'P', '2025-10-07 10:37:33', '2025-10-07 10:37:33'),
(20, 'Alzhar Chandraditya Dewandra', '2008-08-03', 'Batang', '237631', 'Informatika', 'L', '2025-10-07 10:38:19', '2025-10-07 10:38:19'),
(21, 'Anggita Dewi Lestari', '2008-03-01', 'Bawang', '237632', 'Farmasi', 'P', '2025-10-07 10:39:03', '2025-10-07 10:39:03'),
(22, 'Anggreini Hidayatul Febriningtyas', '2008-02-25', 'Kaliongkek', '237633', 'Psikologi', 'P', '2025-10-07 10:39:47', '2025-10-07 10:39:47'),
(23, 'Ani Ghoniyyah Khairunnisa', '2008-04-29', 'Bleder', '237634', 'Kewirausahaan', 'P', '2025-10-07 10:40:31', '2025-10-07 10:40:31'),
(24, 'Apsha Arfianah', '2008-06-20', 'Sumur', '237635', 'Keperawatan', 'P', '2025-10-07 10:41:09', '2025-10-07 10:41:09'),
(25, 'Aryasatya Fitradhia Attaya', '2007-10-17', 'Petodanan Baru', '237636', 'Kehutanan', 'L', '2025-10-07 10:41:56', '2025-10-07 10:41:56'),
(26, 'Azrina Elfaradita', '2007-12-26', 'Gondangan', '237637', 'Kewirausahaan', 'P', '2025-10-07 10:42:36', '2025-10-07 10:42:36'),
(27, 'Bayu Suryadinata', '2008-07-14', 'Batang', '237638', 'Kewirausahaan', 'L', '2025-10-07 10:43:16', '2025-10-07 10:43:16'),
(28, 'Cindy Fadilah', '2008-04-08', 'Johosari', '237639', 'Sosiologi', 'P', '2025-10-07 10:44:04', '2025-10-07 10:44:04'),
(29, 'Dicky Widya Pergodi', '2008-04-11', 'Depok', '237640', 'Informatika', 'L', '2025-10-07 10:44:33', '2025-10-07 10:44:33'),
(30, 'Diva Ayu Ramadhany', '2008-09-28', 'Sengon', '237641', 'Sosiologi', 'P', '2025-10-07 10:45:08', '2025-10-07 10:45:08'),
(31, 'Elta Prawira Ayu Lestari', '2008-02-06', 'Karanggeneng', '237642', 'Keperawatan', 'P', '2025-10-07 10:45:42', '2025-10-07 10:45:42'),
(32, 'erzha fadilah pradista', '2007-11-04', 'Jrakahpayung', '237643', 'Manajemen', 'L', '2025-10-07 10:46:17', '2025-10-07 10:46:17'),
(33, 'ezar fausta gadang praptama', '2008-05-12', 'Watesalit', '237644', 'Multimedia', 'L', '2025-10-07 10:46:52', '2025-10-07 10:46:52'),
(34, 'fifian aqila salmadina', '2008-04-25', 'batang', '237645', 'Keperawatan', 'P', '2025-10-07 10:47:33', '2025-10-07 10:47:33'),
(35, 'geluh anggit mutmainah', '2008-11-20', 'kalibalik', '237646', 'Sosiologi', 'P', '2025-10-07 10:48:02', '2025-10-07 10:48:02'),
(36, 'keysha navi\'azkiya', '2008-06-24', 'banyuputih', '237647', 'Keperawatan', 'P', '2025-10-07 10:48:39', '2025-10-07 10:48:39'),
(37, 'khoirunnisa aulia ramadhani', '2007-10-07', 'ngepung', '237648', 'Farmasi', 'P', '2025-10-07 10:49:11', '2025-10-07 10:49:11'),
(38, 'lufi cahyanti', '2008-08-01', 'Sumur', '237649', 'Hukum', 'P', '2025-10-07 10:49:40', '2025-10-07 10:49:40'),
(39, 'meilian ririn anggani', '2008-05-10', 'Pesalakan', '237650', 'Informatika', 'P', '2025-10-07 10:50:10', '2025-10-07 11:00:07'),
(40, 'muhammad fakhri bintang pratama', '2008-04-17', 'Gondangan', '237651', 'Kehutanan', 'L', '2025-10-07 10:50:42', '2025-10-07 10:50:42'),
(41, 'muhammad naufal allaam', '2007-12-11', 'Dracik', '237652', 'Informatika', 'L', '2025-10-07 10:51:15', '2025-10-07 10:51:15'),
(42, 'muhammad syarif hidayat', '2007-11-05', 'Kalimanggis', '237653', 'Informatika', 'L', '2025-10-07 10:51:47', '2025-10-07 10:51:47'),
(43, 'najwa karima', '2008-03-25', 'Tegalsari', '237654', 'Akuntansi', 'P', '2025-10-07 10:52:15', '2025-10-07 10:52:15'),
(44, 'najwa raya qizzani', '2008-04-07', 'Lengkong', '237655', 'Farmasi', 'P', '2025-10-07 10:52:52', '2025-10-07 10:52:52'),
(45, 'nurhayati', '2008-04-14', 'Ujungnegoro', '237656', 'Manajemen', 'P', '2025-10-07 10:53:18', '2025-10-07 10:53:18'),
(46, 'Rejo Wiranata', '2006-11-11', 'Ujungnegoro', '237657', 'Kehutanan', 'L', '2025-10-07 10:53:45', '2025-10-07 10:53:45'),
(47, 'Suryo Saputro', '2007-09-20', 'Temanggal', '237658', 'Informatika', 'L', '2025-10-07 10:54:00', '2025-10-07 10:54:00'),
(48, 'weni puspita sari', '2008-03-29', 'Kaliongkek', '237659', 'Psikologi', 'P', '2025-10-07 10:54:31', '2025-10-07 10:54:31'),
(49, 'widiana agustiani', '2008-08-05', 'Karanggeneng', '237660', 'Manajemen', 'P', '2025-10-07 10:55:03', '2025-10-07 10:55:03'),
(50, 'zaffa zidni elma', '2008-09-25', 'petamanan', '237661', 'Akuntansi', 'P', '2025-10-07 10:55:29', '2025-10-07 10:55:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(5, 'Suryo Saputro', 'suryos265', 'suryos265@gmail.com', '$2y$10$XgWtjZzh1L1WC0tRQHwlzume0HAwYYTRuI3qfMWoPt0KuV9kRb5HW', '1759837647_nth.png', '2025-10-01 04:08:46', '2025-10-07 11:47:27'),
(6, 'Suryo Saputro', 'MRS', 'mrs@gmail.com', '$2y$10$6L3S6m.r26TS1ykoc8EfueaBSI6nCe6wkcyWLUoq0Q3l1vPsbiYqC', NULL, '2025-10-05 16:29:12', '2025-10-05 16:29:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
