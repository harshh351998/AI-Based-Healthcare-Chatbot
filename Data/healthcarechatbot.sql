-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 25, 2019 at 07:21 AM
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
-- Database: `healthcarechatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `question` text NOT NULL,
  `answer` text,
  PRIMARY KEY (`chat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doc_id` int(50) NOT NULL AUTO_INCREMENT,
  `hsp_id` varchar(250) NOT NULL,
  `doc_name` varchar(250) NOT NULL,
  `doc_mobile` varchar(50) NOT NULL,
  `doc_email` varchar(250) NOT NULL,
  `doc_address` mediumtext NOT NULL,
  `doc_gender` varchar(10) NOT NULL,
  `doc_qualification` varchar(250) NOT NULL,
  `doc_exp` varchar(250) NOT NULL,
  `doc_specialization` varchar(250) NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `hsp_id`, `doc_name`, `doc_mobile`, `doc_email`, `doc_address`, `doc_gender`, `doc_qualification`, `doc_exp`, `doc_specialization`) VALUES
(13, 'Pooja Hospital', 'Mr Anmol', '1234567890', 'anmol@gmail.com', 'Goregaon', 'Male', 'MBBS', '1 year', 'Surgeon'),
(14, 'Suvidha Hospital & Polyclinic', 'Miss Sushmita', '9123456789', 'sushmita@gmail.com', 'Goregaon', 'Male', 'MBBS', '1 year', 'Surgeon');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `hsp_id` int(50) NOT NULL AUTO_INCREMENT,
  `hsp_name` varchar(250) NOT NULL,
  `hsp_contact` varchar(10) NOT NULL,
  `hsp_email` varchar(50) NOT NULL,
  `hsp_address` mediumtext NOT NULL,
  PRIMARY KEY (`hsp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hsp_id`, `hsp_name`, `hsp_contact`, `hsp_email`, `hsp_address`) VALUES
(27, 'Pooja Hospital', '9128791900', 'pooja@gmail.com', 'First Floor, Onyx Building, # 101, SV Rd, Opp. Guru Nanak Petrol Pump, Goregaon West, Mumbai, Maharashtra 400104'),
(26, 'Suvidha Hospital & Polyclinic', '8890785634', 'suvidha@gmail.com', 'Suvidha Hospital & Polyclinic');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `ques_id` int(50) NOT NULL AUTO_INCREMENT,
  `main` varchar(250) NOT NULL,
  `k1` varchar(250) NOT NULL,
  `k2` varchar(250) NOT NULL,
  `k3` varchar(250) NOT NULL,
  `k4` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY (`ques_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ques_id`, `main`, `k1`, `k2`, `k3`, `k4`, `answer`) VALUES
(1, 'hello hi hii hey', 'hello', 'hi', 'hii', 'hey', 'Hey! what would you like to discuss?'),
(2, 'temperature', 'fever', 'chills', 'cold', 'cough', 'I recommended you take a Paracetamol, cetrizine'),
(3, 'dizzy', 'confusion', 'breath', 'fear', 'allergy', 'I recommended you take a MECLIZINE, and take a one cup of cofee.'),
(4, 'headache', 'tension', 'migran', 'vomiting', 'depression', 'I recommended you take a SARIDON and immidiately consult to a Doctor'),
(5, 'body pain', 'fatigue', 'weakness', 'muscle stiffness', 'stress', 'I recommended you take a FLEXON'),
(6, 'thanks', 'you', 'alot ', 'recommendation', 'bye', 'My Pleasure!'),
(8, 'weight', 'loss', 'increase', 'maintain', 'decrease', 'You have to Exercise on Daily basis'),
(9, 'sleep', 'stress', 'exams', 'restless', 'fear', 'I recommeded you to take a CIPCAL'),
(10, 'food poision', 'vomiting', 'stomachache', 'loose-motion', 'dizzy', 'You should take l light food like Dalia.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_contact` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_gender`, `user_password`, `user_contact`) VALUES
(101, 'Test', 'test@gmail.com', 'male', '1234', '1234567890'),
(102, 'Test1', 'test1@gmail.com', 'male', '1234', '1234567890');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
