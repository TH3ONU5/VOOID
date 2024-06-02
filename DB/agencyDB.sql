-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 02. Jun 2024 um 04:21
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `agencyDB`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `sessionID` varchar(355) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `pin`, `sessionID`) VALUES
(1, 'TH3ONU5', '$2y$10$NxlWJ70O5c4ogkbfmaXvfOY9teWVmCklWou.jXM5WqjszykXJ1lS.', '2007115', 'f899e3ff1545455140eb3703442b933708a139129540a9b4ee0d546faecf01d1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `send` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `paid` varchar(50) NOT NULL DEFAULT 'red',
  `starter` varchar(50) NOT NULL DEFAULT '.',
  `premium` varchar(50) NOT NULL DEFAULT '.',
  `vip` varchar(50) NOT NULL DEFAULT '.',
  `contact` varchar(50) NOT NULL DEFAULT '.',
  `admin` varchar(50) DEFAULT '.',
  `display` varchar(20) NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `lastname`, `company`, `phone`, `email`, `message`, `send`, `status`, `paid`, `starter`, `premium`, `vip`, `contact`, `admin`, `display`) VALUES
(186, 'Peter', 'Schmidt', 'Brauerei Schmidt', '01234567890', 'peter@gmail.com', 'Hallo ich bin Petter!!!', '2024-06-02 03:29:47', 'New', 'red', '.', '.', '.', '.', '.', 'show'),
(187, 'Max', 'Maximilian', 'Clean up', '01234567890', 'max@gmail.com', 'Hallo ich bin Max!!!', '2024-06-02 03:31:11', 'New', 'red', 'yes', '.', '.', '.', '.', 'show'),
(188, 'Daniel', 'Braunschweig', 'Kein', '01234567890', 'daniel@gmail.com', 'Hallo ich bin Daniel!!!', '2024-06-02 03:31:59', 'New', 'red', '.', 'yes', '.', '.', '.', 'show'),
(189, 'Elon', 'Musk', 'Tesla, SpaceX', '01234567890', 'elon@gmail.com', 'Hallo ich bin Elon Musk!!!', '2024-06-02 03:34:33', 'New', 'red', '.', '.', 'yes', '.', '.', 'show'),
(190, 'Mark', 'Zuckerberg', 'Meta', '01234567890', 'mark@gmail.com', 'Hallo ich bin Mark Zuckerberg!!!', '2024-06-02 03:41:36', 'New', 'red', '.', '.', '.', '.', 'yes', 'show');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `submission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `form_submissions`
--

INSERT INTO `form_submissions` (`id`, `ip_address`, `submission_date`) VALUES
(103, '::1', '2024-06-02'),
(104, '::1', '2024-06-02'),
(106, '::1', '2024-06-02');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT für Tabelle `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
