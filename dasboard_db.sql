-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Feb 2025 pada 08.38
-- Versi server: 10.6.20-MariaDB-cll-lve
-- Versi PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spillbyd_dasboard_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `title`, `link`, `created_at`) VALUES
(1, 'SKINCARE', '', '2024-12-22 16:30:27'),
(3, 'MOM & BABY', '', '2024-12-22 16:31:16'),
(8, 'RUMAH TANGGA', '', '2024-12-23 16:56:56'),
(9, 'MAKANAN & MINUMAN', '', '2024-12-23 16:58:34'),
(10, 'PRODUK DIGITAL', '', '2024-12-23 17:01:50'),
(12, 'TIKTOK', 'https://www.tiktok.com/@dilanq09', '2024-12-24 08:01:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenus`
--

CREATE TABLE `submenus` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `submenus`
--

INSERT INTO `submenus` (`id`, `menu_id`, `title`, `link`) VALUES
(54, 3, '3. Susu UHT Bayi', 'https://s.shopee.co.id/5KvMZBRFkn'),
(55, 3, '2. Sufor 1 Tahun', 'https://s.shopee.co.id/3VTiNu9sYS'),
(56, 3, '1. Popok Bayi Super Lembut', 'https://s.shopee.co.id/3AqrzRPFTy'),
(57, 8, '4. Ekonomi Sabun Cuci Piring', 'https://s.shopee.co.id/6AUTmAUMmU'),
(58, 8, '3. Pasta Gigi Pepsodent', 'https://s.shopee.co.id/2fubbtQ6mA'),
(59, 8, '2. Close Up Pasta Gigi', 'https://s.shopee.co.id/50IWOIfHG6'),
(60, 8, '1. Shampoo 2in Conditioner', 'https://s.shopee.co.id/10mNdOra76'),
(64, 10, '6. EDIT WAJAH JADI KARIKATUR TEMA ALA KOREA', 'https://s.shopee.co.id/2VbH52bMVH'),
(65, 10, '5. EDIT WAJAH JADI KARIKATUR TEMA NATAL', 'https://s.shopee.co.id/5KvSSITlP5'),
(66, 10, '4. EDIT WAJAH JADI KARIKATUR TEMA LIBURAN DULU', 'https://s.shopee.co.id/9f4RcHdoMQ'),
(67, 10, '3. EDIT WAJAH JADI KARIKATUR TEMA KANTORAN', 'https://s.shopee.co.id/50Ic3jCDop'),
(68, 10, '2. EDIT WAJAH JADI KARIKATUR TEMA ULTAH ANAK', 'https://s.shopee.co.id/50Ic3kL1uO'),
(69, 10, '1. EDIT WAJAH JADI KARIKATUR TEMA ROMANTIS', 'https://s.shopee.co.id/4VMLSqVGBI'),
(74, 9, '3. Sambal ABC', 'https://s.shopee.co.id/4VMFo24YGQ'),
(75, 9, '2. Minuman Energy', 'https://s.shopee.co.id/5AbwZkLyQZ'),
(76, 9, '1. Kaldu Sedaap', 'https://s.shopee.co.id/9pNm8gmWvI'),
(106, 1, '28. Deodorant Men 10ribuan', 'https://s.shopee.co.id/7fJHFS6Fl9'),
(107, 1, '27. Skincare 1 paket', 'https://s.shopee.co.id/1ViduDIdxb'),
(108, 1, '26. Hair Tonic Spray', 'https://s.shopee.co.id/LWgTSmRhA'),
(109, 1, '25. New Launch! Foaming Wash', 'https://s.shopee.co.id/9zhBzKrHto'),
(110, 1, '24. Hair Powder', 'https://s.shopee.co.id/4pz5q2sqm2'),
(111, 1, '23. Sunscreen Body Serum', 'https://s.shopee.co.id/5KvMR5IZby'),
(112, 1, '22. Blackhead Mask', 'https://s.shopee.co.id/703aQKPeuU'),
(113, 1, '21. Deodorant Serum', 'https://s.shopee.co.id/8fBoPTcwuB'),
(114, 1, '20. Deodorant Serum Roll On', 'https://s.shopee.co.id/1g244gK89x'),
(115, 1, '19. Face Wash Men', 'https://s.shopee.co.id/3VTiGO4bEm'),
(116, 1, '18. Deodorant Men', 'https://s.shopee.co.id/2LHksKWwF0'),
(117, 1, '17. Sunscreen Bottle', 'https://s.shopee.co.id/2AyKg5jdc4'),
(118, 1, '16. Minyak Aromatheraphy', 'https://s.shopee.co.id/5VEmeGZedD'),
(119, 1, '15. Facial Foam', 'https://s.shopee.co.id/50IW3QMtAm'),
(120, 1, '14. Nail Care', 'https://s.shopee.co.id/8pVEcYF0TQ'),
(121, 1, '13. Micellar Water', 'https://s.shopee.co.id/1B5nUZS1qP'),
(122, 1, '12. Facial Foam Men', 'https://s.shopee.co.id/4pz5rNYevT'),
(123, 1, '11. Miracle Water', 'https://s.shopee.co.id/7AN0doUOG5'),
(124, 1, ' 10. Serum Pine Clear', 'https://s.shopee.co.id/9pNlopUbsd'),
(125, 1, '9. Moisturizer Viral', 'https://s.shopee.co.id/2AyKgowBoa'),
(126, 1, '8. Serum Sunscreen', 'https://s.shopee.co.id/6AUTSG5L8i'),
(127, 1, '7. LipCream Matte', 'https://s.shopee.co.id/20euUgEN17'),
(128, 1, '6. Sunscreen Wardah', 'https://s.shopee.co.id/3q6Yg8NS2P'),
(129, 1, '5. Moisturizer Wajah Acne', 'https://s.shopee.co.id/8AFXq95oN2'),
(130, 1, '4. Sunscreen 30ribuan', 'https://s.shopee.co.id/4VMFTVQ0aD'),
(131, 1, '3. Facial wash 50ribuan dapat 2', 'https://s.shopee.co.id/2fubIT2ZiW'),
(132, 1, '2. Ampoule Viralll', 'https://s.shopee.co.id/4AjP5XOSMw'),
(133, 1, '1. Sunscreen ter ðŸ‘', 'https://s.shopee.co.id/3LAI6HgD6U');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `submenus`
--
ALTER TABLE `submenus`
  ADD CONSTRAINT `submenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
