-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 sep 2024 om 14:40
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thomas_annexbios`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserved_chairs`
--

CREATE TABLE `reserved_chairs` (
  `id` int(11) NOT NULL,
  `chair_number` int(11) NOT NULL,
  `chair_row` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `movie_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reserved_chairs`
--

INSERT INTO `reserved_chairs` (`id`, `chair_number`, `chair_row`, `type`, `movie_name`) VALUES
(1, 0, 1, 'normal', 'Alien: Romulus'),
(2, 1, 1, 'normal', 'Alien: Romulus'),
(3, 2, 1, 'normal', 'Alien: Romulus'),
(4, 4, 1, 'normal', 'Alien: Romulus'),
(5, 0, 1, 'normal', 'Longlegs');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `temporary_reserved_chairs`
--

CREATE TABLE `temporary_reserved_chairs` (
  `id` int(11) NOT NULL,
  `chair_number` int(11) NOT NULL,
  `chair_row` int(11) NOT NULL,
  `date_chair_reserved` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `movie_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `reserved_chairs`
--
ALTER TABLE `reserved_chairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `temporary_reserved_chairs`
--
ALTER TABLE `temporary_reserved_chairs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `reserved_chairs`
--
ALTER TABLE `reserved_chairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `temporary_reserved_chairs`
--
ALTER TABLE `temporary_reserved_chairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
