-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 02, 2025 at 05:15 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt_dziennik`
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
-- Dumping data for table `klasa`
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
-- Dumping data for table `oceny`
--

INSERT INTO `oceny` (`id_oceny`, `id_nauczyciela`, `id_przedmiotu`, `id_ucznia`) VALUES
(240, 31, 2, 11),
(241, 31, 2, 12),
(242, 31, 2, 11),
(243, 31, 2, 13),
(244, 31, 2, 15),
(245, 31, 2, 16),
(246, 31, 2, 17),
(247, 31, 2, 18),
(248, 31, 2, 11),
(249, 31, 2, 12),
(250, 31, 2, 13),
(251, 31, 2, 14),
(252, 31, 2, 15),
(253, 31, 2, 16),
(254, 31, 2, 17),
(255, 31, 2, 18),
(256, 31, 2, 19),
(257, 31, 2, 20),
(258, 31, 2, 11),
(259, 31, 2, 12),
(260, 31, 2, 11),
(261, 31, 2, 12),
(262, 31, 2, 11),
(263, 31, 2, 11),
(264, 31, 2, 12),
(265, 31, 2, 13),
(266, 31, 2, 14),
(267, 31, 2, 15),
(268, 31, 2, 16),
(269, 31, 2, 17),
(270, 31, 2, 18),
(271, 31, 2, 19),
(272, 31, 2, 20),
(273, 31, 2, 11),
(274, 31, 2, 11),
(275, 31, 2, 12),
(276, 31, 2, 13),
(277, 31, 2, 14),
(278, 31, 2, 15),
(279, 31, 2, 16),
(280, 31, 2, 17),
(281, 31, 2, 18),
(282, 31, 2, 19),
(283, 31, 2, 21),
(284, 31, 2, 22),
(285, 31, 2, 24),
(286, 31, 2, 25),
(287, 31, 2, 26),
(288, 31, 2, 27),
(289, 31, 2, 28),
(290, 31, 2, 29),
(291, 31, 2, 30),
(292, 31, 2, 23),
(293, 31, 2, 11),
(294, 31, 2, 12),
(295, 31, 2, 13),
(296, 31, 2, 14),
(297, 31, 2, 11),
(298, 31, 2, 12),
(299, 31, 2, 13),
(300, 31, 2, 14),
(301, 31, 2, 20),
(302, 31, 2, 20),
(303, 31, 2, 19),
(304, 31, 2, 20),
(306, 31, 2, 20),
(307, 31, 2, 20),
(308, 31, 2, 20),
(309, 31, 2, 11),
(310, 31, 2, 12),
(311, 31, 2, 13),
(312, 31, 2, 14),
(313, 31, 2, 15),
(314, 31, 2, 16),
(315, 31, 2, 18),
(316, 31, 2, 19),
(317, 31, 2, 20),
(318, 31, 2, 18),
(319, 31, 2, 20),
(320, 31, 2, 15),
(321, 31, 2, 16),
(322, 31, 2, 11),
(323, 31, 8, 1),
(324, 31, 8, 2),
(325, 31, 8, 3),
(326, 31, 8, 4),
(327, 31, 2, 20),
(328, 31, 2, 20),
(329, 31, 2, 20),
(330, 31, 2, 18),
(331, 31, 2, 19),
(332, 31, 2, 20),
(333, 31, 8, 5),
(334, 31, 8, 6),
(335, 31, 8, 7),
(336, 31, 8, 8),
(337, 31, 8, 9),
(338, 31, 8, 10),
(339, 31, 8, 9),
(340, 31, 8, 1),
(341, 31, 8, 2),
(342, 31, 8, 3),
(343, 31, 8, 4),
(344, 31, 8, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmioty`
--

CREATE TABLE `przedmioty` (
  `id_przedmiotu` int(11) UNSIGNED NOT NULL,
  `nazwa_przedmiotu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `przedmioty`
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
-- Dumping data for table `przydział_klasy`
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
-- Dumping data for table `przydział_nauczyciel`
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
(11, 40, 2, 2),
(12, 31, 8, 1),
(13, 31, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `role` enum('student','nauczyciel','administrator','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
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
-- Dumping data for table `users`
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
  `opis_oceny` text NOT NULL,
  `czy_widzial` tinyint(1) NOT NULL DEFAULT 0,
  `data_wpisu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wpisy`
--

INSERT INTO `wpisy` (`id_wpisu`, `id_oceny`, `wartosc`, `opis_oceny`, `czy_widzial`, `data_wpisu`) VALUES
(43, 240, 1, '', 0, '2024-12-05 23:06:55'),
(44, 241, 2, '', 0, '2024-12-05 23:06:55'),
(45, 242, 3, '', 0, '2024-12-05 23:07:05'),
(46, 243, 3, '', 0, '2024-12-05 23:07:05'),
(47, 244, 3, '', 0, '2024-12-05 23:07:05'),
(48, 245, 1, '', 0, '2024-12-05 23:07:05'),
(49, 246, 1, '', 0, '2024-12-05 23:07:05'),
(50, 247, 3, '', 0, '2024-12-05 23:07:05'),
(51, 248, 6, '', 0, '2024-12-05 23:07:17'),
(52, 249, 6, '', 0, '2024-12-05 23:07:17'),
(53, 250, 6, '', 0, '2024-12-05 23:07:17'),
(54, 251, 6, '', 0, '2024-12-05 23:07:17'),
(55, 252, 6, '', 0, '2024-12-05 23:07:17'),
(56, 253, 6, '', 0, '2024-12-05 23:07:17'),
(57, 254, 6, '', 0, '2024-12-05 23:07:17'),
(58, 255, 6, '', 0, '2024-12-05 23:07:17'),
(59, 256, 6, '', 0, '2024-12-05 23:07:17'),
(60, 257, 6, '', 0, '2024-12-05 23:07:17'),
(61, 258, 1, '', 0, '2024-12-05 23:16:21'),
(62, 259, 2, '', 0, '2024-12-05 23:16:21'),
(63, 260, 3, '', 0, '2024-12-05 23:16:24'),
(64, 261, 3, '', 0, '2024-12-05 23:16:24'),
(65, 262, 1, '', 0, '2024-12-05 23:22:42'),
(66, 263, 1, '', 0, '2024-12-05 23:22:50'),
(67, 264, 1, '', 0, '2024-12-05 23:22:50'),
(68, 265, 1, '', 0, '2024-12-05 23:22:50'),
(69, 266, 1, '', 0, '2024-12-05 23:22:50'),
(70, 267, 1, '', 0, '2024-12-05 23:22:50'),
(71, 268, 1, '', 0, '2024-12-05 23:22:50'),
(72, 269, 1, '', 0, '2024-12-05 23:22:50'),
(73, 270, 1, '', 0, '2024-12-05 23:22:50'),
(74, 271, 1, '', 0, '2024-12-05 23:22:50'),
(75, 272, 1, '', 0, '2024-12-05 23:22:50'),
(76, 273, 1, '', 0, '2024-12-05 23:25:54'),
(77, 274, 3, '', 0, '2024-12-05 23:26:05'),
(78, 275, 3, '', 0, '2024-12-05 23:26:05'),
(79, 276, 5, '', 0, '2024-12-05 23:26:05'),
(80, 277, 3, '', 0, '2024-12-05 23:26:05'),
(81, 278, 2, '', 0, '2024-12-05 23:26:05'),
(82, 279, 2, '', 0, '2024-12-05 23:26:05'),
(83, 280, 3, '', 0, '2024-12-05 23:26:05'),
(84, 281, 3, '', 0, '2024-12-05 23:26:05'),
(85, 282, 2, '', 0, '2024-12-05 23:26:05'),
(86, 283, 1, '', 0, '2024-12-06 22:45:52'),
(87, 284, 1, '', 0, '2024-12-06 22:45:52'),
(88, 285, 4, '', 0, '2024-12-06 22:46:00'),
(89, 286, 4, '', 0, '2024-12-06 22:46:00'),
(90, 287, 4, '', 0, '2024-12-06 22:46:00'),
(91, 288, 3, '', 0, '2024-12-06 22:46:00'),
(92, 289, 3, '', 0, '2024-12-06 22:46:00'),
(93, 290, 1, '', 0, '2024-12-06 22:46:00'),
(94, 291, 6, '', 0, '2024-12-06 22:46:00'),
(95, 292, 1, '', 0, '2024-12-06 22:46:03'),
(96, 293, 1, '', 0, '2025-01-01 21:03:54'),
(97, 294, 1, '', 0, '2025-01-01 21:05:37'),
(98, 295, 1, '', 0, '2025-01-01 21:05:37'),
(99, 296, 1, '', 0, '2025-01-01 21:05:37'),
(100, 297, 2, '', 0, '2025-01-01 21:05:46'),
(101, 298, 2, '', 0, '2025-01-01 21:05:46'),
(102, 299, 2, '', 0, '2025-01-01 21:05:46'),
(103, 300, 2, '', 0, '2025-01-01 21:05:46'),
(104, 301, 6, '', 0, '2025-01-01 21:05:52'),
(105, 302, 4, '', 0, '2025-01-01 21:05:56'),
(106, 303, 1, '', 0, '2025-01-01 21:05:59'),
(107, 304, 1, '', 0, '2025-01-01 21:05:59'),
(108, 306, 1, 'test', 0, '2025-01-01 21:14:45'),
(109, 307, 1, 'a', 0, '2025-01-01 21:15:00'),
(110, 308, 2, 'sprawdzian asd', 0, '2025-01-01 21:15:44'),
(111, 309, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(112, 310, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(113, 311, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(114, 312, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(115, 313, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(116, 314, 6, 'test oceny kilka na raz', 0, '2025-01-01 21:16:35'),
(117, 315, 1, 'test', 0, '2025-01-01 21:25:32'),
(118, 316, 1, 'test', 0, '2025-01-01 21:25:32'),
(119, 317, 1, 'test', 0, '2025-01-01 21:25:32'),
(120, 318, 6, 'test2', 0, '2025-01-01 21:25:38'),
(121, 319, 6, 'test2', 0, '2025-01-01 21:25:38'),
(122, 320, 2, 'test', 0, '2025-01-01 21:25:50'),
(123, 321, 2, 'test', 0, '2025-01-01 21:25:50'),
(124, 322, 1, '', 0, '2025-01-01 21:44:50'),
(125, 323, 1, 'kolokwium asd', 0, '2025-01-01 21:47:28'),
(126, 324, 1, 'kolokwium asd', 0, '2025-01-01 21:47:28'),
(127, 325, 1, 'kolokwium asd', 0, '2025-01-01 21:47:28'),
(128, 326, 1, 'kolokwium asd', 0, '2025-01-01 21:47:28'),
(129, 327, 1, '', 0, '2025-01-01 22:12:52'),
(130, 328, 3, '', 0, '2025-01-01 22:12:55'),
(131, 329, 1, 'test', 0, '2025-01-01 22:14:57'),
(132, 330, 3, 'test', 0, '2025-01-01 22:15:18'),
(133, 331, 3, 'test', 0, '2025-01-01 22:15:18'),
(134, 332, 3, 'test', 0, '2025-01-01 22:15:18'),
(135, 333, 3, 'final test', 0, '2025-01-01 22:28:26'),
(136, 334, 3, 'final test', 0, '2025-01-01 22:28:26'),
(137, 335, 3, 'final test', 0, '2025-01-01 22:28:26'),
(138, 336, 3, 'final test', 0, '2025-01-01 22:28:26'),
(139, 337, 3, 'final test', 0, '2025-01-01 22:28:26'),
(140, 338, 3, 'final test', 0, '2025-01-01 22:28:26'),
(141, 339, 1, 'bardzo dlugi opis na testa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0, '2025-01-01 22:31:17'),
(142, 340, 2, 'ostateczny test ocen czy dziala :)', 0, '2025-01-01 22:38:56'),
(143, 341, 2, 'ostateczny test ocen czy dziala :)', 0, '2025-01-01 22:38:56'),
(144, 342, 2, 'ostateczny test ocen czy dziala :)', 0, '2025-01-01 22:38:56'),
(145, 343, 2, 'ostateczny test ocen czy dziala :)', 0, '2025-01-01 22:38:56'),
(146, 344, 3, '', 0, '2025-01-01 22:41:05');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `id_klasy` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id_oceny` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;

--
-- AUTO_INCREMENT for table `przedmioty`
--
ALTER TABLE `przedmioty`
  MODIFY `id_przedmiotu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `przydział_klasy`
--
ALTER TABLE `przydział_klasy`
  MODIFY `id_przydzial` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `przydział_nauczyciel`
--
ALTER TABLE `przydział_nauczyciel`
  MODIFY `id_przydzialu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `wpisy`
--
ALTER TABLE `wpisy`
  MODIFY `id_wpisu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`id_nauczyciela`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`id_ucznia`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmioty` (`id_przedmiotu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `przydział_klasy`
--
ALTER TABLE `przydział_klasy`
  ADD CONSTRAINT `przydział_klasy_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_klasy_ibfk_2` FOREIGN KEY (`id_klasy`) REFERENCES `klasa` (`id_klasy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `przydział_nauczyciel`
--
ALTER TABLE `przydział_nauczyciel`
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_1` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmioty` (`id_przedmiotu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_2` FOREIGN KEY (`id_nauczyciela`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `przydział_nauczyciel_ibfk_3` FOREIGN KEY (`id_klasy`) REFERENCES `klasa` (`id_klasy`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wpisy`
--
ALTER TABLE `wpisy`
  ADD CONSTRAINT `wpisy_ibfk_1` FOREIGN KEY (`id_oceny`) REFERENCES `oceny` (`id_oceny`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
