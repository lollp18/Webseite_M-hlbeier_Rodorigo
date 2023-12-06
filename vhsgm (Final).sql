-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Dez 2023 um 17:58
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
-- Datenbank: `vhsgm`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gebucht`
--

CREATE TABLE `gebucht` (
  `Buchungs_ID` int(11) NOT NULL,
  `Datum` varchar(255) NOT NULL,
  `Kurs_ID` int(11) NOT NULL,
  `Schüler_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `gebucht`
--

INSERT INTO `gebucht` (`Buchungs_ID`, `Datum`, `Kurs_ID`, `Schüler_ID`) VALUES
(12, '1.12.2023', 5, 4),
(13, '5.12.2023', 6, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurse`
--

CREATE TABLE `kurse` (
  `Kurs_ID` int(11) NOT NULL,
  `Kurs_Lehrer` varchar(255) NOT NULL,
  `Kurs_Raum` varchar(255) NOT NULL,
  `Preis` varchar(255) NOT NULL,
  `Thema` varchar(255) NOT NULL,
  `Anzahl_Platz` int(11) NOT NULL,
  `Anzahl_Frei` int(11) NOT NULL,
  `Datum` varchar(255) NOT NULL,
  `Beginn` varchar(255) NOT NULL,
  `Dauer` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `kurse`
--

INSERT INTO `kurse` (`Kurs_ID`, `Kurs_Lehrer`, `Kurs_Raum`, `Preis`, `Thema`, `Anzahl_Platz`, `Anzahl_Frei`, `Datum`, `Beginn`, `Dauer`) VALUES
(5, 'Müller', '309', '50', 'Mathe', 50, 14, 'Donnerstag, 23. November 2023', '11:25', '120'),
(6, 'Schmidt', '313', '60', 'Deutsch', 70, 22, 'Samstag, 25. November 2023', '14:15', '120'),
(8, 'Seebaum', '310', '85', 'Wirtschaftslehre', 30, 5, 'Montag, 27. November 2023', '15:15', '120'),
(9, 'Martens', '208', '35', 'Englisch', 50, 10, 'Mittwoch, 29. November 2023', '18:15', '60'),
(10, 'Schulz', '305', '45', 'Geschichte', 40, 8, 'Dienstag, 21. November 2023', '09:45', '90'),
(11, 'Becker', '312', '75', 'Physik', 25, 5, 'Freitag, 24. November 2023', '13:30', '90'),
(12, 'Koch', '307', '55', 'Informatik', 60, 12, 'Sonntag, 26. November 2023', '16:45', '90'),
(13, 'Fischer', '301', '70', 'Chemie', 45, 15, 'Montag, 27. November 2023', '10:30', '120'),
(14, 'Weber', '315', '80', 'Biologie', 35, 7, 'Mittwoch, 29. November 2023', '14:00', '120'),
(15, 'Lehmann', '304', '65', 'Musik', 55, 25, 'Donnerstag, 30. November 2023', '17:30', '60'),
(16, 'Zimmermann', '311', '40', 'Sport', 80, 30, 'Samstag, 2. Dezember 2023', '12:15', '60'),
(17, 'Martens', '309', '75', 'Computertechnik', 50, 0, 'Dienstag, 5. Dezember 2023', '13:15', '120');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lehrer`
--

CREATE TABLE `lehrer` (
  `Lehrer_ID` int(11) NOT NULL,
  `Nachname` varchar(255) NOT NULL,
  `Vorname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `lehrer`
--

INSERT INTO `lehrer` (`Lehrer_ID`, `Nachname`, `Vorname`) VALUES
(1, 'Müller', 'Hans'),
(2, 'Schmidt', 'Peter'),
(3, 'Seebaum', 'Patrick'),
(4, 'Martens', 'Michael');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `räume`
--

CREATE TABLE `räume` (
  `Raum_ID` int(11) NOT NULL,
  `Raum_Nummer` varchar(255) NOT NULL,
  `Raum_Typ` varchar(255) NOT NULL,
  `Raum_Plätze` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `räume`
--

INSERT INTO `räume` (`Raum_ID`, `Raum_Nummer`, `Raum_Typ`, `Raum_Plätze`) VALUES
(1, '309', 'Computerraum', 50),
(2, '313', 'Computerraum', 70),
(3, '310', 'Klassenraum', 30),
(4, '312', 'Klassenraum', 35),
(5, '208', 'Klassenraum', 50),
(6, '308', 'Computerraum', 45),
(7, 'Online', 'Online', 999);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schüler`
--

CREATE TABLE `schüler` (
  `Schüler_ID` int(11) NOT NULL,
  `Nachname` varchar(255) NOT NULL,
  `Vorname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Passwort` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `schüler`
--

INSERT INTO `schüler` (`Schüler_ID`, `Nachname`, `Vorname`, `Email`, `Passwort`) VALUES
(3, 'Rodorigo', 'Lorenzo', 'lorenzo123696@gmail.com', '$2y$10$MP6f9pBZgcYACcJGnWxa/ewN.LDkZTjsobqLlb5C8OMwQL8JBRix.'),
(4, 'test', 'test', 'test@test.de', '$2y$10$Bq1eexxpXaWFAIB4n8ZeIer8abqD6K9OHqgAarLvSyuKAOQ9rN2uu'),
(5, 'Martens', 'Michael', 'martensmichael@test.de', '$2y$10$Y5QW/k6AmFpHXF8Q47UlJegRKlTKuqmOOHEH0DhhS2EkicemIWfIa');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `gebucht`
--
ALTER TABLE `gebucht`
  ADD PRIMARY KEY (`Buchungs_ID`);

--
-- Indizes für die Tabelle `kurse`
--
ALTER TABLE `kurse`
  ADD PRIMARY KEY (`Kurs_ID`);

--
-- Indizes für die Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  ADD PRIMARY KEY (`Lehrer_ID`);

--
-- Indizes für die Tabelle `räume`
--
ALTER TABLE `räume`
  ADD PRIMARY KEY (`Raum_ID`);

--
-- Indizes für die Tabelle `schüler`
--
ALTER TABLE `schüler`
  ADD PRIMARY KEY (`Schüler_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `gebucht`
--
ALTER TABLE `gebucht`
  MODIFY `Buchungs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `kurse`
--
ALTER TABLE `kurse`
  MODIFY `Kurs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `lehrer`
--
ALTER TABLE `lehrer`
  MODIFY `Lehrer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `räume`
--
ALTER TABLE `räume`
  MODIFY `Raum_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `schüler`
--
ALTER TABLE `schüler`
  MODIFY `Schüler_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
