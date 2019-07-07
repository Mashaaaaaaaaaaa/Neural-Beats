-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2019 at 04:29 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neuralbeats`
--

-- --------------------------------------------------------

--
-- Table structure for table `blokiranje`
--

DROP TABLE IF EXISTS `blokiranje`;
CREATE TABLE IF NOT EXISTS `blokiranje` (
  `Blokirao` int(11) NOT NULL,
  `Blokiran` int(11) NOT NULL,
  PRIMARY KEY (`Blokirao`,`Blokiran`),
  KEY `blokiran_idx` (`Blokiran`),
  KEY `blokirao_idx` (`Blokirao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `zaMuziku` int(11) NOT NULL,
  `idKomentara` int(11) NOT NULL,
  PRIMARY KEY (`idKomentara`),
  KEY `zaMuziku_idx` (`zaMuziku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `idKorinika` int(11) NOT NULL AUTO_INCREMENT,
  `Password` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Administrator` bit(1) DEFAULT NULL,
  `Opis` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idKorinika`),
  UNIQUE KEY `username_UNIQUE` (`Username`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorinika`, `Password`, `Username`, `Email`, `Administrator`, `Opis`) VALUES
(1, 'janko123', 'janko', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `licna_poruka`
--

DROP TABLE IF EXISTS `licna_poruka`;
CREATE TABLE IF NOT EXISTS `licna_poruka` (
  `Primalac` int(11) NOT NULL,
  `idLicne_Poruke` int(11) NOT NULL,
  PRIMARY KEY (`idLicne_Poruke`),
  KEY `primalac_idx` (`Primalac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `muzika`
--

DROP TABLE IF EXISTS `muzika`;
CREATE TABLE IF NOT EXISTS `muzika` (
  `idMuzike` int(11) NOT NULL AUTO_INCREMENT,
  `Autor` int(11) NOT NULL,
  `Naslov` varchar(100) NOT NULL,
  `Opis` varchar(1000) DEFAULT NULL,
  `Vreme` timestamp NOT NULL,
  PRIMARY KEY (`idMuzike`),
  KEY `autor_idx` (`Autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

DROP TABLE IF EXISTS `poruka`;
CREATE TABLE IF NOT EXISTS `poruka` (
  `idPoruke` int(11) NOT NULL AUTO_INCREMENT,
  `Posiljalac` int(11) NOT NULL,
  `Sadrzaj` varchar(1000) DEFAULT NULL,
  `Vreme` timestamp NOT NULL,
  PRIMARY KEY (`idPoruke`),
  KEY `posiljalac_idx` (`Posiljalac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prati`
--

DROP TABLE IF EXISTS `prati`;
CREATE TABLE IF NOT EXISTS `prati` (
  `Prati` int(11) NOT NULL,
  `Pracen` int(11) NOT NULL,
  PRIMARY KEY (`Prati`,`Pracen`),
  KEY `Pracen_idx` (`Pracen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blokiranje`
--
ALTER TABLE `blokiranje`
  ADD CONSTRAINT `blokiran` FOREIGN KEY (`Blokiran`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blokirao` FOREIGN KEY (`Blokirao`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `idKomentara` FOREIGN KEY (`idKomentara`) REFERENCES `poruka` (`idPoruke`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zaMuziku` FOREIGN KEY (`zaMuziku`) REFERENCES `muzika` (`idMuzike`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `licna_poruka`
--
ALTER TABLE `licna_poruka`
  ADD CONSTRAINT `idLicnePoruke` FOREIGN KEY (`idLicne_Poruke`) REFERENCES `poruka` (`idPoruke`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `primalac` FOREIGN KEY (`Primalac`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `muzika`
--
ALTER TABLE `muzika`
  ADD CONSTRAINT `autor` FOREIGN KEY (`Autor`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poruka`
--
ALTER TABLE `poruka`
  ADD CONSTRAINT `posiljalac` FOREIGN KEY (`Posiljalac`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prati`
--
ALTER TABLE `prati`
  ADD CONSTRAINT `Pracen` FOREIGN KEY (`Pracen`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Prati` FOREIGN KEY (`Prati`) REFERENCES `korisnik` (`idKorinika`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
