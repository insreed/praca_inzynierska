-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2023, 00:33
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
-- Baza danych: `projekt_dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasa`
--

CREATE TABLE `klasa` (
  `id_klasy` int(11) UNSIGNED NOT NULL,
  `nazwa` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `klasa`
--

INSERT INTO `klasa` (`id_klasy`, `nazwa`) VALUES
(1, '3AT'),
(2, '2BI'),
(3, '5AT');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id_oceny` int(11) UNSIGNED NOT NULL,
  `id_nauczyciela` int(11) UNSIGNED NOT NULL,
  `id_przedmiotu` int(11) UNSIGNED NOT NULL,
  `id_ucznia` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`id_oceny`, `id_nauczyciela`, `id_przedmiotu`, `id_ucznia`) VALUES
(1, 31, 1, 1),
(2, 32, 2, 1),
(3, 33, 3, 1),
(4, 31, 1, 2),
(5, 32, 2, 2),
(6, 33, 3, 2),
(7, 31, 1, 3),
(8, 32, 2, 3),
(9, 33, 3, 3),
(10, 34, 1, 4),
(11, 35, 2, 4),
(12, 36, 3, 4),
(13, 34, 1, 5),
(14, 35, 2, 5),
(15, 36, 3, 5),
(16, 34, 1, 6),
(17, 35, 2, 6),
(18, 36, 3, 6),
(19, 34, 1, 7),
(20, 35, 2, 7),
(21, 36, 3, 7),
(22, 34, 1, 8),
(23, 35, 2, 8),
(24, 36, 3, 8),
(25, 34, 1, 9),
(26, 35, 2, 9),
(27, 36, 3, 9),
(28, 34, 1, 10),
(29, 35, 2, 10),
(30, 36, 3, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmioty`
--

CREATE TABLE `przedmioty` (
  `id_przedmiotu` int(11) UNSIGNED NOT NULL,
  `nazwa_przedmiotu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `przedmioty`
--

INSERT INTO `przedmioty` (`id_przedmiotu`, `nazwa_przedmiotu`) VALUES
(1, 'Matematyka'),
(2, 'Język angielski'),
(3, 'Historia'),
(4, 'Biologia'),
(5, 'Fizyka'),
(6, 'Chemia'),
(7, 'Geografia'),
(8, 'Informatyka'),
(9, 'Wychowanie fizyczne'),
(10, 'Muzyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przydział_klasy`
--

CREATE TABLE `przydział_klasy` (
  `id_przydzial` int(11) UNSIGNED NOT NULL,
  `id_uzytkownika` int(11) UNSIGNED NOT NULL,
  `id_klasy` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `przydział_klasy`
--

INSERT INTO `przydział_klasy` (`id_przydzial`, `id_uzytkownika`, `id_klasy`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(18, 18, 2),
(19, 19, 2),
(20, 20, 2),
(21, 21, 3),
(22, 22, 3),
(23, 23, 3),
(24, 24, 3),
(25, 25, 3),
(26, 26, 3),
(27, 27, 3),
(28, 28, 3),
(29, 29, 3),
(30, 30, 3),
(31, 31, 2),
(32, 32, 3),
(33, 33, 1),
(34, 34, 2),
(35, 35, 3),
(36, 36, 1),
(37, 37, 2),
(38, 38, 3),
(39, 39, 1),
(40, 40, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przydział_nauczyciel`
--

CREATE TABLE `przydział_nauczyciel` (
  `id_przydzialu` int(11) UNSIGNED NOT NULL,
  `id_nauczyciela` int(11) UNSIGNED NOT NULL,
  `id_przedmiotu` int(11) UNSIGNED NOT NULL,
  `id_klasy` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `przydział_nauczyciel`
--

INSERT INTO `przydział_nauczyciel` (`id_przydzialu`, `id_nauczyciela`, `id_przedmiotu`, `id_klasy`) VALUES
(1, 30, 1, 1),
(2, 31, 2, 2),
(3, 32, 3, 3),
(4, 33, 1, 1),
(5, 34, 2, 2),
(6, 35, 3, 3),
(7, 36, 1, 1),
(8, 37, 2, 2),
(9, 38, 3, 3),
(10, 39, 1, 1),
(11, 40, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `role` enum('student','nauczyciel','administrator','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'student'),
(2, 'nauczyciel'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `additional_email` varchar(60) DEFAULT NULL,
  `role_id` tinyint(4) UNSIGNED NOT NULL DEFAULT 1,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `avatar` varchar(60) NOT NULL DEFAULT 'default.png',
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `additional_email`, `role_id`, `firstName`, `lastName`, `birthday`, `avatar`, `password`, `created_at`) VALUES
(1, 'jan.kowalski@example.com', 'jan.kowalski@example.com', 1, 'Jan', 'Kowalski', '1990-01-01', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(2, 'anna.nowak@example.com', 'anna.nowak@example.com', 1, 'Anna', 'Nowak', '1991-02-02', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(3, 'adam.wisniewski@example.com', 'adam.wisniewski@example.com', 1, 'Adam', 'Wiśniewski', '1992-03-03', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(4, 'maria.wojcik@example.com', 'maria.wojcik@example.com', 1, 'Maria', 'Wójcik', '1993-04-04', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(5, 'andrzej.kowalczyk@example.com', 'andrzej.kowalczyk@example.com', 1, 'Andrzej', 'Kowalczyk', '1994-05-05', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(6, 'krystyna.lewandowska@example.com', 'krystyna.lewandowska@example.com', 1, 'Krystyna', 'Lewandowska', '1995-06-06', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(7, 'piotr.zielinski@example.com', 'piotr.zielinski@example.com', 1, 'Piotr', 'Zieliński', '1996-07-07', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(8, 'malgorzata.szymanska@example.com', 'malgorzata.szymanska@example.com', 1, 'Małgorzata', 'Szymańska', '1997-08-08', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(9, 'tomasz.dabrowski@example.com', 'tomasz.dabrowski@example.com', 1, 'Tomasz', 'Dąbrowski', '1998-09-09', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(10, 'katarzyna.kaminska@example.com', 'katarzyna.kaminska@example.com', 1, 'Katarzyna', 'Kamińska', '1999-10-10', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(11, 'piotr.kowalski@example.com', 'piotr.kowalski@example.com', 1, 'Piotr', 'Kowalski', '2000-11-11', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(12, 'agata.nowakowska@example.com', 'agata.nowakowska@example.com', 1, 'Agata', 'Nowakowska', '2001-12-12', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(13, 'krzysztof.bednarek@example.com', 'krzysztof.bednarek@example.com', 1, 'Krzysztof', 'Bednarek', '2002-01-13', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(14, 'ewa.kaczmarek@example.com', 'ewa.kaczmarek@example.com', 1, 'Ewa', 'Kaczmarek', '2003-02-14', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(15, 'pawel.wisniewski@example.com', 'pawel.wisniewski@example.com', 1, 'Paweł', 'Wiśniewski', '2004-03-15', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(16, 'magdalena.krajewska@example.com', 'magdalena.krajewska@example.com', 1, 'Magdalena', 'Krajewska', '2005-04-16', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(17, 'jakub.kozlowski@example.com', 'jakub.kozlowski@example.com', 1, 'Jakub', 'Kozłowski', '2006-05-17', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(18, 'natalia.wisniewska@example.com', 'natalia.wisniewska@example.com', 1, 'Natalia', 'Wiśniewska', '2007-06-18', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(19, 'wojciech.kaminski@example.com', 'wojciech.kaminski@example.com', 1, 'Wojciech', 'Kamiński', '2008-07-19', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(20, 'katarzyna.wozniak@example.com', 'katarzyna.wozniak@example.com', 1, 'Katarzyna', 'Woźniak', '2009-08-20', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(21, 'krystian.kowalczyk@example.com', 'krystian.kowalczyk@example.com', 1, 'Krystian', 'Kowalczyk', '2010-09-21', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(22, 'patrycja.wojcik@example.com', 'patrycja.wojcik@example.com', 1, 'Patrycja', 'Wójcik', '2011-10-22', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(23, 'damian.wozniak@example.com', 'damian.wozniak@example.com', 1, 'Damian', 'Woźniak', '2012-11-23', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(24, 'angelika.nowak@example.com', 'angelika.nowak@example.com', 1, 'Angelika', 'Nowak', '2013-12-24', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(25, 'maciej.jankowski@example.com', 'maciej.jankowski@example.com', 1, 'Maciej', 'Jankowski', '2014-01-25', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(26, 'julia.mazur@example.com', 'julia.mazur@example.com', 1, 'Julia', 'Mazur', '2015-02-26', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(27, 'michal.wisniewski@example.com', 'michal.wisniewski@example.com', 1, 'Michał', 'Wiśniewski', '2016-03-27', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(28, 'emilia.kwiatkowska@example.com', 'emilia.kwiatkowska@example.com', 1, 'Emilia', 'Kwiatkowska', '2017-04-28', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(29, 'robert.kaczmarek@example.com', 'robert.kaczmarek@example.com', 1, 'Robert', 'Kaczmarek', '2018-05-29', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(30, 'agnieszka.kowalska@example.com', 'agnieszka.kowalska@example.com', 1, 'Agnieszka', 'Kowalska', '2019-06-30', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(31, 'piotr.majewski@example.com', 'piotr.majewski@example.com', 2, 'Piotr', 'Majewski', '1980-01-01', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(32, 'elżbieta.nowacka@example.com', 'elżbieta.nowacka@example.com', 2, 'Elżbieta', 'Nowacka', '1981-02-02', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(33, 'tomasz.kowalski@example.com', 'tomasz.kowalski@example.com', 2, 'Tomasz', 'Kowalski', '1982-03-03', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(34, 'agata.wójcik@example.com', 'agata.wojcik@example.com', 2, 'Agata', 'Wójcik', '1983-04-04', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(35, 'adam.kowalczyk@example.com', 'adam.kowalczyk@example.com', 2, 'Adam', 'Kowalczyk', '1984-05-05', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(36, 'barbara.lewandowska@example.com', 'barbara.lewandowska@example.com', 2, 'Barbara', 'Lewandowska', '1985-06-06', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(37, 'grzegorz.zieliński@example.com', 'grzegorz.zielinski@example.com', 2, 'Grzegorz', 'Zieliński', '1986-07-07', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(38, 'anna.szymańska@example.com', 'anna.szymanska@example.com', 2, 'Anna', 'Szymańska', '1987-08-08', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(39, 'michał.dąbrowski@example.com', 'michal.dabrowski@example.com', 2, 'Michał', 'Dąbrowski', '1988-09-09', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(40, 'iwona.kamińska@example.com', 'iwona.kaminska@example.com', 2, 'Iwona', 'Kamińska', '1989-10-10', 'woman.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(41, 'admin1@example.com', 'admin1@example.com', 3, 'Admin', 'Jedynka', '1980-01-01', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(42, 'admin2@example.com', 'admin2@example.com', 3, 'Admin', 'Dwójka', '1981-02-02', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(43, 'admin3@example.com', 'admin3@example.com', 3, 'Admin', 'Trójka', '1982-03-03', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(44, 'admin4@example.com', 'admin4@example.com', 3, 'Admin', 'Czwórka', '1983-04-04', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58'),
(45, 'admin5@example.com', 'admin5@example.com', 3, 'Admin', 'Piątka', '1984-05-05', 'man.png', '$argon2id$v=19$m=65536,t=4,p=1$S3hVQkpHZWt2UlBWWkw3Ug$xyQ9HtGaPXnxeSZUSOvmQ2SsO70mAgb97yO0Eq9xgmo', '2023-06-14 00:25:58');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wpisy`
--

CREATE TABLE `wpisy` (
  `id_wpisu` int(11) UNSIGNED NOT NULL,
  `id_oceny` int(11) UNSIGNED NOT NULL,
  `wartosc` int(3) UNSIGNED NOT NULL,
  `data_wpisu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `wpisy`
--

INSERT INTO `wpisy` (`id_wpisu`, `id_oceny`, `wartosc`, `data_wpisu`) VALUES
(1, 1, 4, '2023-06-01 10:15:00'),
(2, 2, 3, '2023-06-02 11:30:00'),
(3, 3, 5, '2023-06-03 09:45:00'),
(4, 4, 2, '2023-06-04 14:20:00'),
(5, 5, 4, '2023-06-05 13:10:00'),
(6, 6, 3, '2023-06-06 12:05:00'),
(7, 7, 5, '2023-06-07 10:50:00'),
(8, 8, 2, '2023-06-08 11:25:00'),
(9, 9, 4, '2023-06-09 13:45:00'),
(10, 10, 3, '2023-06-10 12:30:00'),
(11, 11, 4, '2023-06-11 09:15:00'),
(12, 12, 3, '2023-06-12 10:30:00'),
(13, 13, 5, '2023-06-13 11:45:00'),
(14, 14, 2, '2023-06-14 14:20:00'),
(15, 15, 4, '2023-06-15 13:10:00'),
(16, 16, 3, '2023-06-16 12:05:00'),
(17, 17, 5, '2023-06-17 10:50:00'),
(18, 18, 2, '2023-06-18 11:25:00'),
(19, 19, 4, '2023-06-19 13:45:00'),
(20, 20, 3, '2023-06-20 12:30:00'),
(21, 21, 4, '2023-06-21 09:15:00'),
(22, 22, 3, '2023-06-22 10:30:00'),
(23, 23, 5, '2023-06-23 11:45:00'),
(24, 24, 2, '2023-06-24 14:20:00'),
(25, 25, 4, '2023-06-25 13:10:00'),
(26, 26, 3, '2023-06-26 12:05:00'),
(27, 27, 5, '2023-06-27 10:50:00'),
(28, 28, 2, '2023-06-28 11:25:00'),
(29, 29, 4, '2023-06-29 13:45:00'),
(30, 30, 3, '2023-06-30 12:30:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`id_klasy`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id_oceny`),
  ADD KEY `id_nauczyciela` (`id_nauczyciela`),
  ADD KEY `id_ucznia` (`id_ucznia`),
  ADD KEY `id_przedmiotu` (`id_przedmiotu`);

--
-- Indeksy dla tabeli `przedmioty`
--
ALTER TABLE `przedmioty`
  ADD PRIMARY KEY (`id_przedmiotu`);

--
-- Indeksy dla tabeli `przydział_klasy`
--
ALTER TABLE `przydział_klasy`
  ADD PRIMARY KEY (`id_przydzial`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`,`id_klasy`),
  ADD KEY `id_klasy` (`id_klasy`);

--
-- Indeksy dla tabeli `przydział_nauczyciel`
--
ALTER TABLE `przydział_nauczyciel`
  ADD PRIMARY KEY (`id_przydzialu`),
  ADD KEY `id_przedmiotu` (`id_przedmiotu`),
  ADD KEY `id_nauczyciela` (`id_nauczyciela`),
  ADD KEY `id_klasy` (`id_klasy`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `wpisy`
--
ALTER TABLE `wpisy`
  ADD PRIMARY KEY (`id_wpisu`),
  ADD KEY `id_oceny` (`id_oceny`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klasa`
--
ALTER TABLE `klasa`
  MODIFY `id_klasy` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id_oceny` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `przedmioty`
--
ALTER TABLE `przedmioty`
  MODIFY `id_przedmiotu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `przydział_klasy`
--
ALTER TABLE `przydział_klasy`
  MODIFY `id_przydzial` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `przydział_nauczyciel`
--
ALTER TABLE `przydział_nauczyciel`
  MODIFY `id_przydzialu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `wpisy`
--
ALTER TABLE `wpisy`
  MODIFY `id_wpisu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`id_nauczyciela`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`id_ucznia`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmioty` (`id_przedmiotu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przydział_klasy`
--
ALTER TABLE `przydział_klasy`
  ADD CONSTRAINT `przydział_klasy_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_klasy_ibfk_2` FOREIGN KEY (`id_klasy`) REFERENCES `klasa` (`id_klasy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przydział_nauczyciel`
--
ALTER TABLE `przydział_nauczyciel`
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_1` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmioty` (`id_przedmiotu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_2` FOREIGN KEY (`id_nauczyciela`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_3` FOREIGN KEY (`id_klasy`) REFERENCES `klasa` (`id_klasy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wpisy`
--
ALTER TABLE `wpisy`
  ADD CONSTRAINT `wpisy_ibfk_1` FOREIGN KEY (`id_oceny`) REFERENCES `oceny` (`id_oceny`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
