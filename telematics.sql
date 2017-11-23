-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5173
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table telematics.devices
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(50) DEFAULT NULL,
  `device_label` varchar(200) DEFAULT NULL,
  `last_reported_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table telematics.devices: ~12 rows (approximately)
DELETE FROM `devices`;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` (`id`, `device_id`, `device_label`, `last_reported_date`) VALUES
	(1, '001', 'Lexus Gen V navigation system', '2017-11-23 03:14:07'),
	(3, '002', 'Pictor Telematics', '2017-11-22 03:14:07'),
	(4, '003', 'GPS TRACKER GPS104', '2017-11-23 03:14:07'),
	(5, '004', 'WIRELESS TRACKER', '2001-11-11 01:50:00'),
	(6, '005', 'Lex Gen VI Nav', '2017-11-23 03:14:07'),
	(7, '006', 'adas', '2017-11-23 03:14:06'),
	(8, '007', 'sdsd', '2001-11-11 01:50:00'),
	(12, '009', 'GPS TRACKER GPS106', '2017-11-23 03:14:07'),
	(13, '010', 'GPS TRACKER GPS107', '2017-11-23 03:14:07'),
	(14, '011', 'GPS TRACKER GPS107', '2017-11-23 03:14:07'),
	(16, '011', 'GPS TRACKER GPS107', '2017-11-23 03:14:07');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
