-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Lut 2023, 18:00
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `kontakty`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mojekontakty`
--

CREATE TABLE `mojekontakty` (
  `id` int(11) NOT NULL,
  `db_imie` text NOT NULL,
  `db_nazwisko` text NOT NULL,
  `db_numerTelefonu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `mojekontakty`
--

INSERT INTO `mojekontakty` (`id`, `db_imie`, `db_nazwisko`, `db_numerTelefonu`) VALUES
(1, 'Karol', 'Nowak', 887665443),
(2, 'Marcin', 'Kasprzak', 667556445),
(3, 'Karol', 'Brzęczyszczykiewicz', 919929939),
(4, 'Jan', 'Roztropny', 555444333),
(5, 'Bartosz', 'Mazur', 222222222),
(6, 'Karol', 'Majster', 887765467),
(7, 'Kamil', 'Kotulski', 776676000),
(8, 'Michal', 'Dobrodziej', 747383929);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `mojekontakty`
--
ALTER TABLE `mojekontakty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `mojekontakty`
--
ALTER TABLE `mojekontakty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
