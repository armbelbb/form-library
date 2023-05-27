-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for form_vault
CREATE DATABASE IF NOT EXISTS `form_vault` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `form_vault`;

-- Dumping structure for table form_vault.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.categories: ~4 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `category_name`) VALUES
	(1, 'Human Resources'),
	(2, 'Transportation'),
	(3, 'General Administration'),
	(4, 'Technology'),
	(5, 'Business Office');

-- Dumping structure for table form_vault.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `form_index` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `form_description` text,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.forms: ~3 rows (approximately)
DELETE FROM `forms`;
INSERT INTO `forms` (`id`, `form_name`, `reference_id`, `form_index`, `category_id`, `attachment`, `form_description`, `link`) VALUES
	(1, 'Personal Day Request', '#1####', 'HR0000555', 1, 'ALTIMAX_BROADCASTING_CO.,_INC._RB-VAS-2023-0001_NEW.pdf.pdf', 'Employees/Staff submit this form when requesting a personal day. Upon submission the information collected here is automatically sent downstream to complete the approval process. See workflow diagram for more details.', 'https://forms.schoolsourcetech.com/res/showFormPreview?EParam=jFMIig1ZP57ktV_iBTGa1e1-2sn1q26p2CO-cxzjbeoqRXKFunGt_ooBL62dyA76XSWqkvcav3w'),
	(2, 'New Student Registrationss', '101111', 'GA01', 3, '', 'Parent/Guardian submit this form when trying to register a new student. Upon submission the information collected here is automatically sent downstream to complete the approval process. See workflow diagram for more details.', 'https://forms.schoolsourcetech.com/res/showFormPreview?EParam=jFMIig1ZP57ktV_iBTGa1fLVdPv3y7Il2CO-cxzjberTokJRs3TM7zoVlwQQIvYPavtJXiKMid0'),
	(3, 'New Employee Form', '##2#', 'GOOGLE12', 1, 'GLOBE_TELECOM,_INC_Letter_Validation-2023-05-03 (1).pdf.pdf', 'sample form sample form', 'https://www.google.com/');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
