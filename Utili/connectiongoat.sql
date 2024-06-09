-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 04, 2023 alle 10:36
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectiongoat`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto`
--

CREATE TABLE `progetto` (
  `IdProgetto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descrizione` varchar(3000) NOT NULL,
  `data` date NOT NULL,
  `IdUtente` int(11) NOT NULL,
  `src_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`IdProgetto`, `nome`, `descrizione`, `data`, `IdUtente`, `src_image`) VALUES
(1, 'Security Breach', 'HII literally wrote “the book” on federal cyber security standards. Our experts assisted the National Institute of Standards and Technology (NIST) in developing security protocols and frameworks, and applying practices to help mitigate cyber attacks.', '2023-04-10', 9, '../assets/projects/security.jpg'),
(2, 'Satellite broadcast', 'The Satellite Instructional Television Experiment (SITE) was a major NASA applications satellite program for educational TV in India. The project involved the use of NASA’s Application Technology Satellite-6 (ATS-6) to broadcast educational programs directly to television sets placed in different rural clusters. The agreement for SITE was signed between NASA and India’s Department of Atomic Energy (DAE) in 1969. The project was executed from August 1975 to July 1976 and received a great deal of media attention in the country. It was touted as a massive experiment in social engineering and was hailed by some enthusiasts as the world’s largest sociological experiment.', '2023-04-19', 6, 'https://www.ansa.it/webimages/ch_620x438/2022/9/8/f249bf5db20a2f10a486a329e9645f5f.jpg'),
(3, 'Extreme Programming', 'If the term extreme programming is bringing up mental images of the X games and action sports, you’re not too far off. Extreme programming (XP) is, in fact, a pretty extreme way of programming. Similar to other Agile software development methods, XP uses adaptable, test-driven development for software engineering. But unlike other methods, extreme programming has strict rules and guiding values that govern how the work gets done. ', '2023-03-15', 6, 'https://www.tabnine.com/blog/wp-content/uploads/2022/03/graph_2-5.png'),
(4, 'Fermat Theorem inspiration', 'The study on number theory, mainly about the elementary number theory, is composed of two parts, basic theories and enquiry studies. The first part, basic theories include: Pythagoras equation; congruence theory; unitary congruence equation; quadratic congruence equation and primary root and so on. And the latter part, Enquiry Study contains：a concrete explanation of Fermat conjecture; the primality test for Fermat numberFn; the expression of prime numbers; the assumption of encryption; related distribution of prime numbers; pairs of prime numbers of even numbers; the fundamental problems of transfinite numbers.', '2023-03-07', 6, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Teorema_di_Fermat.svg/2560px-Teorema_di_Fermat.svg.png'),
(5, 'A.I Future', 'The productivity of artificial intelligence may boost our workplaces, which will benefit people by enabling them to do more work. As the future of AI replaces tedious or dangerous tasks, the human workforce is liberated to focus on tasks for which they are more equipped, such as those requiring creativity and empathy.', '2023-02-14', 6, 'https://vitolavecchia.altervista.org/wp-content/uploads/2020/12/Differenza-tra-robot-e-intelligenza-artificiale-IA.jpg'),
(6, 'ead', 'aed', '2023-04-09', 6, 'a');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `IdUtente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`IdUtente`, `nome`, `cognome`, `email`, `password`) VALUES
(3, 'mattwe', 'ginbitti', 'matteogianve@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(4, 'tttttt', 'ttttttttt', 'ttttttttttt@ttttttt.bom', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(5, 'cccc', 'ccccc', 'cccccc@sjcs.csc', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(6, 'mamma', 'mamma', 'mamma@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(7, 'sgrfg', 'wrgrefrf', 'll@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(8, 'sss', 'ss', 'sfasf@jfjf.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(9, 'dcsd', 'dscdc', 'cdd@dhdd.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(10, 'wfrf', 'wr', 'wfwrfwrf@rfwrfwf.tr', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(11, 'dfvdfv', 'fdvfv', 'fddfvdfv@gbjidgb.it', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(12, 'eaafe', 'aefaef', 'aeffae@efaefea.tr', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(13, 'dsv', 'sdsdv', 'sdvvdsvds@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(14, 'adae', 'aadda', 'mammea@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(15, 'prova', 'venti', 'provaventi@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7'),
(16, 'dddss', 'dddss', 'donato2@gmail.com', '5171329b39eb756d3b7f82a920299a0fbd11f6c3e5ecf9b8b85f7003fe9865b7');

-- --------------------------------------------------------

--
-- Struttura della tabella `votazione`
--

CREATE TABLE `votazione` (
  `IdUtente` int(11) NOT NULL,
  `IdProgetto` int(11) NOT NULL,
  `voto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `votazione`
--

INSERT INTO `votazione` (`IdUtente`, `IdProgetto`, `voto`) VALUES
(6, 1, 1),
(6, 2, 1),
(6, 3, -1),
(6, 4, 1),
(6, 5, -1),
(8, 1, 1),
(9, 1, 1),
(11, 1, -1),
(11, 2, -1),
(11, 3, -1),
(11, 4, -1),
(11, 5, -1),
(12, 1, 1),
(12, 2, 1),
(12, 3, -1),
(12, 4, -1),
(12, 5, -1),
(15, 1, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `progetto`
--
ALTER TABLE `progetto`
  ADD PRIMARY KEY (`IdProgetto`),
  ADD KEY `IdUtente` (`IdUtente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IdUtente`,`email`);

--
-- Indici per le tabelle `votazione`
--
ALTER TABLE `votazione`
  ADD PRIMARY KEY (`IdUtente`,`IdProgetto`),
  ADD KEY `VotoProgetto` (`IdProgetto`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `progetto`
--
ALTER TABLE `progetto`
  MODIFY `IdProgetto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IdUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `progetto`
--
ALTER TABLE `progetto`
  ADD CONSTRAINT `IdUtente` FOREIGN KEY (`IdUtente`) REFERENCES `utente` (`IdUtente`);

--
-- Limiti per la tabella `votazione`
--
ALTER TABLE `votazione`
  ADD CONSTRAINT `VotoProgetto` FOREIGN KEY (`IdProgetto`) REFERENCES `progetto` (`IdProgetto`),
  ADD CONSTRAINT `VotoUtente` FOREIGN KEY (`IdUtente`) REFERENCES `utente` (`IdUtente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
