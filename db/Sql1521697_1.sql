-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: 89.46.111.126
-- Generation Time: Feb 20, 2021 at 04:50 AM
-- Server version: 5.7.32-35-log
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Sql1521697_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `anagrafica`
--

DROP TABLE IF EXISTS `anagrafica`;
CREATE TABLE IF NOT EXISTS `anagrafica` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attivo` int(11) DEFAULT '0',
  `HASH` varchar(100) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `categoria` varchar(15) DEFAULT NULL,
  `rag_soc` varchar(100) DEFAULT NULL,
  `indirizzo` varchar(100) DEFAULT NULL,
  `citta` varchar(100) DEFAULT NULL,
  `nazione` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `piva` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cognome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `privacy` tinyint(4) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inserimento` int(10) unsigned DEFAULT NULL,
  `chiave` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `anagrafica`
--

INSERT INTO `anagrafica` (`id`, `attivo`, `HASH`, `tipo`, `categoria`, `rag_soc`, `indirizzo`, `citta`, `nazione`, `provincia`, `piva`, `telefono`, `web`, `nome`, `cognome`, `email`, `password`, `privacy`, `timestamp`, `inserimento`, `chiave`) VALUES
(1, 1, NULL, 'cliente', 'produttore', 'Codementor', 'New York, USA', 'New York', '', 'US', '', '123456789', 'http://localhost', 'Super', 'Rich', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2021-02-11 16:07:17', 1613040669, NULL),
(3, 1, NULL, 'cliente', 'raccoglitore', 'company', 'street', 'city', 'coutnry', 'province', 'vat', '123456789', 'http://localhost', 'name', 'surname', 'andaniel2029@gmail.com', '90a2cf9cf4cb23c0f6d7fb317bdb2624', 1, '2021-02-11 16:07:20', 1613041367, NULL),
(4, 1, NULL, 'cliente', 'produttore', 'C.G.R. srl', '', '', '', '', '', '', '', 'Alberto', 'Rimini', 'a.rimini@cgr-riciclodelpet.it', '14e526398975f8679c0dde8dddf5a687', 1, '2021-02-14 10:30:48', 1613147900, NULL),
(5, 1, NULL, 'cliente', 'produttore', 'Juliana de Almeida', '', 'Milano', '', '', '', '', '', 'Juliana', 'de Almeida', 'juliana_almeida@hotmail.com', '40d61f7fdc6f5d3e06ec13189c823847', 1, '2021-02-19 18:27:28', 1613762820, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attivazioni`
--

DROP TABLE IF EXISTS `attivazioni`;
CREATE TABLE IF NOT EXISTS `attivazioni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stringa` varchar(100) DEFAULT NULL,
  `anagrafica_id` int(10) unsigned DEFAULT NULL,
  `data` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attivazioni`
--

INSERT INTO `attivazioni` (`id`, `stringa`, `anagrafica_id`, `data`) VALUES
(5, '738ad57b157245d220777e816dfcf5f7', 5, 1613762820);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `inserzione_id` int(10) unsigned DEFAULT NULL,
  `anagrafica_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `file_offerta`
--

DROP TABLE IF EXISTS `file_offerta`;
CREATE TABLE IF NOT EXISTS `file_offerta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `inserzione_id` int(10) unsigned DEFAULT NULL,
  `anagrafica_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `file_offerta`
--

INSERT INTO `file_offerta` (`id`, `url`, `thumb`, `inserzione_id`, `anagrafica_id`) VALUES
(1, 'BC_ADRIAPLAST_9.PDF', NULL, 2, 4),
(2, 'PETSxxTPC01_IT_r2.pdf', NULL, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `file_offerte_clienti`
--

DROP TABLE IF EXISTS `file_offerte_clienti`;
CREATE TABLE IF NOT EXISTS `file_offerte_clienti` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offerta_id` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

--
-- Dumping data for table `file_offerte_clienti`
--

INSERT INTO `file_offerte_clienti` (`id`, `offerta_id`, `url`, `nome`) VALUES
(1, '73', 'Crux_Language_Specification.docx', 'Crux_Language_Specification'),
(2, '67', 'Project1.docx', 'Project1'),
(3, '67', 'Project2.docx', 'Project2');

-- --------------------------------------------------------

--
-- Table structure for table `file_upload_temp`
--

DROP TABLE IF EXISTS `file_upload_temp`;
CREATE TABLE IF NOT EXISTS `file_upload_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `sessione_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `inserzione_id` int(10) unsigned DEFAULT NULL,
  `anagrafica_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=8 ;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `url`, `thumb`, `inserzione_id`, `anagrafica_id`) VALUES
(1, 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg', 1, 0),
(2, 'AFG.jpg', 'AFG_thumb.jpg', 2, 4),
(3, 'DLB.jpg', 'DLB_thumb.jpg', 2, 4),
(4, 'PETSN1TPC01_low_resolution.jpg', 'PETSN1TPC01_low_resolution_thumb.jpg', 3, 4),
(5, 'Foto_sacconi_low_resolution.jpg', 'Foto_sacconi_low_resolution_thumb.jpg', 3, 4),
(6, 'PETSN1TPC01_low_resolution1.jpg', 'PETSN1TPC01_low_resolution1_thumb.jpg', 4, 4),
(7, 'Foto_sacconi_low_resolution1.jpg', 'Foto_sacconi_low_resolution1_thumb.jpg', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `foto_offerte_clienti`
--

DROP TABLE IF EXISTS `foto_offerte_clienti`;
CREATE TABLE IF NOT EXISTS `foto_offerte_clienti` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offerta_id` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=59 ;

--
-- Dumping data for table `foto_offerte_clienti`
--

INSERT INTO `foto_offerte_clienti` (`id`, `offerta_id`, `foto`, `thumb`) VALUES
(16, '47', 'AFG.jpg', 'AFG_thumb.jpg'),
(17, '47', 'DLB.jpg', 'DLB_thumb.jpg'),
(25, '51', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(26, '51', 'Foto_sacconi_low_resolution.jpg', 'Foto_sacconi_low_resolution_thumb.jpg'),
(34, '56', 'AFG.jpg', 'AFG_thumb.jpg'),
(35, '56', 'DLB.jpg', 'DLB_thumb.jpg'),
(37, '58', 'PETSN1TPC01_low_resolution1.jpg', 'PETSN1TPC01_low_resolution1_thumb.jpg'),
(38, '58', 'Foto_sacconi_low_resolution1.jpg', 'Foto_sacconi_low_resolution1_thumb.jpg'),
(47, '63', 'PETSN1TPC01_low_resolution1.jpg', 'PETSN1TPC01_low_resolution1_thumb.jpg'),
(48, '63', 'Foto_sacconi_low_resolution1.jpg', 'Foto_sacconi_low_resolution1_thumb.jpg'),
(49, '64', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(50, '65', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(51, '66', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(52, '67', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(53, '68', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(54, '69', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(55, '70', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(56, '71', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(57, '72', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg'),
(58, '73', 'PETSA1TPC01-LowResolution.jpg', 'PETSA1TPC01-LowResolution_thumb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `foto_upload_temp`
--

DROP TABLE IF EXISTS `foto_upload_temp`;
CREATE TABLE IF NOT EXISTS `foto_upload_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `sessione_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(500) DEFAULT NULL,
  `thumb` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `url`, `thumb`, `timestamp`) VALUES
(3, 'DLB.jpg', 'DLB_thumb.jpg', '2021-02-12 17:22:28'),
(4, 'AFG.jpg', 'AFG_thumb.jpg', '2021-02-12 17:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `inserzione`
--

DROP TABLE IF EXISTS `inserzione`;
CREATE TABLE IF NOT EXISTS `inserzione` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `polimero` varchar(100) DEFAULT NULL,
  `quantita` varchar(100) DEFAULT NULL,
  `prezzo` float(8,2) DEFAULT '0.00',
  `descrizione` mediumblob,
  `inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scadenza` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) DEFAULT NULL,
  `descrizione` mediumblob,
  `attivo` smallint(6) DEFAULT '1',
  `inserimento` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `titolo`, `descrizione`, `attivo`, `inserimento`, `timestamp`) VALUES
(3, 'NEW Post Consumer PET Washing Plant', 0x3c703e5374617274696e6720696e20323031382c20432e472e522e2069732070726f647563696e672068696768207175616c6974792050455420626f74746c657320666c616b6573207374617274696e672066726f6d20434f5245504c412f434f52495045542050455420626f74746c65732e3c2f703e0a0a3c703e266e6273703b3c2f703e0a0a203c703e3c696d6720616c743d2222207372633d22687474703a2f2f7777772e6367722d72696369636c6f64656c7065742e69742f75706c6f6164732f4146472e6a70672220202f3e3c696d6720616c743d2222207372633d22687474703a2f2f7777772e6367722d72696369636c6f64656c7065742e69742f75706c6f6164732f444c422e6a70672220202f3e3c2f703e0a, 1, 1613151041, '2021-02-12 17:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `offerte`
--

DROP TABLE IF EXISTS `offerte`;
CREATE TABLE IF NOT EXISTS `offerte` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `polimero` varchar(100) DEFAULT NULL,
  `quantita` varchar(100) DEFAULT NULL,
  `prezzo` varchar(100) DEFAULT NULL,
  `descrizione` mediumblob,
  `utente_email` varchar(500) DEFAULT NULL,
  `utente_id` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inserimento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Dumping data for table `offerte`
--

INSERT INTO `offerte` (`id`, `nome`, `polimero`, `quantita`, `prezzo`, `descrizione`, `utente_email`, `utente_id`, `timestamp`, `inserimento`) VALUES
(1, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 'Amministratore', 0, '2021-02-12 16:26:03', 1613147163),
(2, 'Foto Impianto', 'PET', '', '', 0x50726f7661, 'Amministratore', 0, '2021-02-12 17:34:19', 1613151259),
(4, 'Clear PET Flakes', 'R-PET', '24.000 Kg', 'To be asked', 0x436c6561722050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c206973206d616465206f66206d696e696d756d20393525206f6620426576657261676520626f74746c6573, 'Amministratore', 0, '2021-02-12 22:08:46', 1613167726);

-- --------------------------------------------------------

--
-- Table structure for table `offerte_per_cliente`
--

DROP TABLE IF EXISTS `offerte_per_cliente`;
CREATE TABLE IF NOT EXISTS `offerte_per_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `polimero` varchar(100) DEFAULT NULL,
  `quantita` varchar(100) DEFAULT NULL,
  `prezzo` varchar(100) DEFAULT NULL,
  `resa` varchar(100) DEFAULT NULL,
  `imballo` varchar(100) DEFAULT NULL,
  `peso` varchar(100) DEFAULT NULL,
  `mezzo` varchar(100) DEFAULT NULL,
  `cer` varchar(100) DEFAULT NULL,
  `rifiuto` varchar(3) DEFAULT NULL,
  `descrizione` mediumblob,
  `codice` int(10) unsigned zerofill DEFAULT NULL,
  `scadenza` int(10) unsigned DEFAULT NULL,
  `id_offerta_originale` int(10) unsigned DEFAULT NULL,
  `attivo` int(10) unsigned DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inserimento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=74 ;

--
-- Dumping data for table `offerte_per_cliente`
--

INSERT INTO `offerte_per_cliente` (`id`, `nome`, `polimero`, `quantita`, `prezzo`, `resa`, `imballo`, `peso`, `mezzo`, `cer`, `rifiuto`, `descrizione`, `codice`, `scadenza`, `id_offerta_originale`, `attivo`, `timestamp`, `inserimento`) VALUES
(47, 'Foto Impianto', 'PET', '', '', '', '', '', '', '', 'no', 0x50726f7661, 0000000020, 1613948400, 2, 0, '2021-02-12 18:12:01', NULL),
(51, 'Light Blue PET flakes', 'R-PET', '22000 kg', 'To be asked', 'Ex-Works Villata', 'See picture', '22.000 kg', 'Truck', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000022, 1624485600, 1, 1, '2021-02-17 17:43:24', NULL),
(56, 'Foto Impianto', 'PET', '22000 kg', '0,78 Eur/kg', '', '', '22000 kg', '', '', 'no', 0x50726f7661, 0000000027, 1614121200, 2, 1, '2021-02-19 23:25:21', NULL),
(58, 'Clear PET Flakes', 'R-PET', '24.000 Kg', 'To be asked', 'ex Works', 'See picture', '24.000 Kg', 'Truck', '', 'no', 0x436c6561722050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c206973206d616465206f66206d696e696d756d20393525206f6620426576657261676520626f74746c6573, 0000000028, 1614380400, 4, 1, '2021-02-17 17:45:12', NULL),
(63, 'Clear PET Flakes', 'R-PET', '24.000 Kg', 'To be asked', '', '', '22000 kg', '', '', 'no', 0x436c6561722050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c206973206d616465206f66206d696e696d756d20393525206f6620426576657261676520626f74746c6573, 0000000029, 1614553200, 4, 1, '2021-02-19 22:20:45', NULL),
(64, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '22000 kg', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000030, 1614553200, 1, 1, '2021-02-19 22:21:31', NULL),
(65, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000031, 1614553200, 1, 1, '2021-02-19 22:21:57', NULL),
(66, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000032, 1614553200, 1, 1, '2021-02-19 22:22:15', NULL),
(67, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '22000 kg', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000033, 1614553200, 1, 1, '2021-02-19 22:36:34', NULL),
(68, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000034, 1614639600, 1, 1, '2021-02-19 23:17:48', NULL),
(69, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000035, 1614639600, 1, 1, '2021-02-19 23:26:16', NULL),
(70, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000036, 1614639600, 1, 1, '2021-02-19 23:26:54', NULL),
(71, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000037, 1614639600, 1, 1, '2021-02-19 23:37:01', NULL),
(72, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000038, 1614639600, 1, 1, '2021-02-19 23:37:57', NULL),
(73, 'Light Blue PET flakes', 'R-PET', '22000 kg', '0,78 Eur/kg', '', '', '', '', '', 'no', 0x4c696768742050455420666c616b657320636f6d696e672066726f6d204575726f7065616e205045542062616c65732e204163636f7264696e6720746f204546534120726567756c6174696f6e2c2074686520696e707574206d6174657269616c65206973206d616465206f66206d696e696d756d20383525206f6620426576657261676520626f74746c6573, 0000000039, 1614639600, 1, 1, '2021-02-19 23:44:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `off_cli`
--

DROP TABLE IF EXISTS `off_cli`;
CREATE TABLE IF NOT EXISTS `off_cli` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `offerte_per_cliente_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=64 ;

--
-- Dumping data for table `off_cli`
--

INSERT INTO `off_cli` (`id`, `cliente_id`, `offerte_per_cliente_id`) VALUES
(37, 4, 51),
(46, 4, 47),
(49, 3, 63),
(50, 3, 64),
(51, 3, 65),
(52, 3, 66),
(54, 3, 68),
(55, 3, 56),
(56, 3, 69),
(57, 3, 70),
(58, 3, 58),
(59, 3, 71),
(60, 4, 72),
(61, 3, 73),
(63, 3, 67);

-- --------------------------------------------------------

--
-- Table structure for table `statiche`
--

DROP TABLE IF EXISTS `statiche`;
CREATE TABLE IF NOT EXISTS `statiche` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `home` mediumblob,
  `clienti` mediumblob,
  `fornitori` mediumblob,
  `produzione` mediumblob,
  `contatti` mediumblob,
  `home_en` mediumblob,
  `clienti_en` mediumblob,
  `fornitori_en` mediumblob,
  `produzione_en` mediumblob,
  `contatti_en` mediumblob,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `statiche`
--

INSERT INTO `statiche` (`id`, `home`, `clienti`, `fornitori`, `produzione`, `contatti`, `home_en`, `clienti_en`, `fornitori_en`, `produzione_en`, `contatti_en`) VALUES
(1, 0x31, 0x33, 0x35, 0x37, 0x39, 0x32, 0x34, 0x36, 0x38, 0x3130);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
