-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for form_vault
CREATE DATABASE IF NOT EXISTS `form_vault` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `form_vault`;

-- Dumping structure for table form_vault.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.accounts: ~2 rows (approximately)
DELETE FROM `accounts`;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `email`, `password`, `display_name`, `contact_num`, `type`, `status`) VALUES
	(1, 'sstforms@farmingdaleschools.org', 'Dalers', 'Farmingdale_SST', NULL, 'Administrator', 'Active'),
	(2, 'client1@sample.com', 'helloworld', 'Client One', NULL, 'Client', 'Active'),
	(3, 'client2@sample.com', 'secret', 'Client 2', '211-Jabi Delivery', 'Client', 'Active');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table form_vault.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.categories: ~4 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`) VALUES
	(1, 'Human Resources'),
	(2, 'Transportation'),
	(3, 'General Administration'),
	(4, 'Technology'),
	(5, 'Business Office');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table form_vault.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_name` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `form_index` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `workflow` varchar(255) DEFAULT NULL,
  `form_description` text,
  `link` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.forms: ~0 rows (approximately)
DELETE FROM `forms`;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Dumping structure for table form_vault.form_requests
CREATE TABLE IF NOT EXISTS `form_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `requestor_email` varchar(255) DEFAULT NULL,
  `requestor_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `request_notes` text,
  `request_date` timestamp NULL DEFAULT NULL,
  `last_update_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.form_requests: ~0 rows (approximately)
DELETE FROM `form_requests`;
/*!40000 ALTER TABLE `form_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_requests` ENABLE KEYS */;

-- Dumping structure for table form_vault.form_request_reports
CREATE TABLE IF NOT EXISTS `form_request_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_request_id` int(11) DEFAULT NULL,
  `request_concerns` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table form_vault.form_request_reports: ~0 rows (approximately)
DELETE FROM `form_request_reports`;
/*!40000 ALTER TABLE `form_request_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_request_reports` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
