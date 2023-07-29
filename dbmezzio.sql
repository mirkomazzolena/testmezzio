-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 28, 2023 alle 18:02
-- Versione del server: 5.7.17
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmezzio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `Param1` float NOT NULL,
  `Param2` float NOT NULL,
  `Param3` float DEFAULT NULL,
  `Operator` varchar(3) NOT NULL,
  `Risultato` float NOT NULL,
  `DataOra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`id`, `Param1`, `Param2`, `Param3`, `Operator`, `Risultato`, `DataOra`) VALUES
(7, 2, 3, NULL, 'div', 0.666667, '2023-07-28 09:45:37'),
(8, 2, 3, NULL, 'div', 0.666667, '2023-07-28 09:45:44'),
(9, 2, 3, NULL, 'div', 0.666667, '2023-07-28 09:45:56'),
(10, 2, 3, NULL, 'div', 0.666667, '2023-07-28 15:13:57'),
(11, 5, 3, NULL, 'div', 1.66667, '2023-07-28 15:14:02'),
(12, 2, 3, NULL, 'div', 0.666667, '2023-07-28 15:28:31'),
(13, 2, 3, NULL, 'div', 0.666667, '2023-07-28 15:57:04'),
(14, 2, 3, NULL, 'add', 5, '2023-07-28 15:57:07'),
(15, 2, 3, NULL, 'add', 5, '2023-07-28 16:00:25');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
