-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2022 at 04:39 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicita`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `doc_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `dieseas` text NOT NULL,
  `appointment_type` enum('Physical','Telemedicine','','') NOT NULL,
  `charge` int NOT NULL,
  `prescription` text,
  `appointment_time` datetime NOT NULL,
  `appointment_end_time` datetime NOT NULL,
  `status` enum('Upcoming','Inprogress','Completed','Canceled','Resheduled') NOT NULL DEFAULT 'Upcoming',
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `doc_id`, `patient_id`, `dieseas`, `appointment_type`, `charge`, `prescription`, `appointment_time`, `appointment_end_time`, `status`) VALUES
(1, 15, 17, 'Pain in Knee', 'Telemedicine', 300, 'Take above medicine\nPainkiller - 2 Tab', '2022-03-29 11:00:00', '2022-03-29 11:30:00', 'Inprogress'),
(2, 19, 24, 'Pain in foot', 'Physical', 400, 'Take above medicine\nPainkiller - 1 Tab', '2022-03-22 12:30:00', '2022-03-22 13:00:00', 'Completed'),
(3, 15, 17, 'Pain in Hand.', 'Telemedicine', 350, NULL, '2022-03-24 12:30:00', '2022-03-24 13:00:00', 'Canceled'),
(4, 19, 17, 'Pain in back after lifting heavy weight.', 'Physical', 400, NULL, '2022-03-25 16:15:00', '2022-03-25 16:45:00', 'Upcoming'),
(5, 15, 24, 'Chest Pain', 'Physical', 300, NULL, '2022-04-06 10:00:00', '2022-04-05 10:30:00', 'Resheduled'),
(6, 19, 43, 'Cholera', 'Telemedicine', 450, NULL, '2022-03-24 14:45:00', '2022-03-24 15:15:00', 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_basic_profile`
--

DROP TABLE IF EXISTS `assistant_basic_profile`;
CREATE TABLE IF NOT EXISTS `assistant_basic_profile` (
  `assistant_basic_profile_id` int NOT NULL AUTO_INCREMENT,
  `assistant_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `education` text,
  `salary` double DEFAULT NULL,
  PRIMARY KEY (`assistant_basic_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assistant_basic_profile`
--

INSERT INTO `assistant_basic_profile` (`assistant_basic_profile_id`, `assistant_id`, `doc_id`, `education`, `salary`) VALUES
(3, 18, 15, 'MBBS', 2000),
(7, 22, 19, 'ctdtrd', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `doc_basic_profile`
--

DROP TABLE IF EXISTS `doc_basic_profile`;
CREATE TABLE IF NOT EXISTS `doc_basic_profile` (
  `doc_basic_profile_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `education` text,
  `award` text,
  `speciality_id` int DEFAULT NULL,
  `physical_service_charge` int DEFAULT NULL,
  `telemedicine_service_charge` int DEFAULT NULL,
  `sub_type` enum('fix','percentage','','') NOT NULL,
  `sub_prize` double NOT NULL,
  PRIMARY KEY (`doc_basic_profile_id`),
  KEY `user_id` (`user_id`),
  KEY `speciality_id` (`speciality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_basic_profile`
--

INSERT INTO `doc_basic_profile` (`doc_basic_profile_id`, `user_id`, `education`, `award`, `speciality_id`, `physical_service_charge`, `telemedicine_service_charge`, `sub_type`, `sub_prize`) VALUES
(25, 15, 'Ph.D.', 'Experience of 7 years in these field.', 10, 300, 350, 'fix', 0),
(26, 19, 'M.S (General Surgery)', '20 years of rich experience in his field', 13, 400, 450, 'percentage', 0),
(27, 17, 'MS - Obstetrics & Gynecology', 'experience of 7 years in these field.', 19, 300, 350, 'fix', 0),
(28, 40, 'BDS (Bachelor of Dental Surgery)', '8 yrs Experience in this field.', 14, 500, 400, 'fix', 0),
(29, 41, 'DM (Gastroenterology)', '3 yrs experience in this field.', 18, 200, 300, 'fix', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doc_speciality`
--

DROP TABLE IF EXISTS `doc_speciality`;
CREATE TABLE IF NOT EXISTS `doc_speciality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_speciality`
--

INSERT INTO `doc_speciality` (`id`, `name`) VALUES
(10, 'Physician'),
(12, 'Neurosurgeon'),
(13, 'Spinesurgeon'),
(14, 'Dentist'),
(15, 'Paediatrician'),
(16, 'Orthopaedic surgeon'),
(17, 'Radiologist'),
(18, 'Gastroenterologists'),
(19, 'Gynaecologist');

-- --------------------------------------------------------

--
-- Table structure for table `doc_venue`
--

DROP TABLE IF EXISTS `doc_venue`;
CREATE TABLE IF NOT EXISTS `doc_venue` (
  `venue_id` int NOT NULL AUTO_INCREMENT,
  `doc_id` int NOT NULL,
  `venue_1_name` varchar(255) NOT NULL,
  `venue_1_address` text NOT NULL,
  `venue_1_image` varchar(255) NOT NULL,
  `venue_1_start_time` time NOT NULL,
  `venue_1_end_time` time NOT NULL,
  PRIMARY KEY (`venue_id`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_venue`
--

INSERT INTO `doc_venue` (`venue_id`, `doc_id`, `venue_1_name`, `venue_1_address`, `venue_1_image`, `venue_1_start_time`, `venue_1_end_time`) VALUES
(3, 15, 'JP Clinic', '2nd Floor, Ved Arcade, S.P. Ring Road, Vastral, 382418', '594675img4.jpg', '10:00:00', '13:00:00'),
(4, 19, 'New Spine Hub', '3rd Floor, Shyam Shikar Complex, L.D. Road, Bapunagar, 380024', '4222331.png', '15:00:00', '19:00:00'),
(5, 40, 'SP Dental Clinic', '509, Sahjanand Complex, Satellite', '7982617.jpg', '08:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_basic_profile`
--

DROP TABLE IF EXISTS `patient_basic_profile`;
CREATE TABLE IF NOT EXISTS `patient_basic_profile` (
  `patient_basic_profile_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `health_issue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`patient_basic_profile_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_basic_profile`
--

INSERT INTO `patient_basic_profile` (`patient_basic_profile_id`, `user_id`, `health_issue`) VALUES
(3, 17, 'Pain in Knee'),
(4, 24, '');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `appointment_id` int NOT NULL,
  `rating` int NOT NULL,
  `review` text NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `patient_id`, `doc_id`, `appointment_id`, `rating`, `review`) VALUES
(1, 17, 15, 1, 4, 'The Doctor is very kind.'),
(2, 24, 19, 2, 3, 'Good Experience with Doctor.');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `doc_id` int NOT NULL,
  `appointment_id` int NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `report_description` text NOT NULL,
  `is_patient_share` tinyint(1) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `patient_id`, `doc_id`, `appointment_id`, `file`, `report_description`, `is_patient_share`) VALUES
(1, 17, 15, 1, '99126report.jpeg', '', 0),
(2, 17, 15, 1, '274080report.jpeg', 'Blood Report', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('fix','percentage') NOT NULL,
  `prize` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `type`, `prize`) VALUES
(1, 'fix', 500),
(2, 'percentage', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` enum('Admin','Doctor','Patient','Assistant') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` bigint NOT NULL,
  `gender` enum('Male','Female','Other','') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `profile_photo` varchar(150) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `address` text,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` int DEFAULT NULL,
  `status` enum('Pending','Rejected','Approved','') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `mobile_number`, `gender`, `birth_date`, `otp`, `profile_photo`, `bio`, `address`, `state`, `city`, `zip_code`, `status`) VALUES
(1, 'Admin', 'admin', 'admin', 'medicitaa@gmail.com', 'admin', 6354303790, 'Male', NULL, NULL, NULL, NULL, '', '', '', 0, 'Pending'),
(15, 'Doctor', 'Jay', 'Patel', 'jaypatel@gmail.com', 'jay@doctor', 6354303790, 'Male', '2003-01-04', 6146, '823608emoji-face-mask-memoji-characters-neue-emojis-ios-14-glasses-accessories-accessory-head-transparent-png-2931271.png', 'I am Physician.', 'C- 301, Casanova Flats, Vastrapur', 'Gujarat', 'Ahmedabad', 380052, 'Approved'),
(17, 'Patient', 'Ketan', 'Patel', 'ketanpatel@gmail.com', 'ketan@patient', 9825014581, 'Male', '2002-06-27', NULL, '806873PicsArt_04-17-12.55.08.jpg', 'I am a Patient.', 'Palash Pearl, M.G. Road, Nikol', 'Gujarat', 'Ahmedabad', 382350, 'Pending'),
(18, 'Assistant', 'Deep', 'Patel', 'deeppatel@gmail.com', 'deep@assistant', 8160011795, 'Male', '2002-07-20', NULL, '2905661.jpg', 'I am Assistant', 'Danev Park, Jivanvadi Road, Nikol Gam', 'Gujarat', 'Ahmedabad', 382350, 'Pending'),
(19, 'Doctor', 'Sumit', 'Panchal', 'sumitpanchal@gmail.com', 'sumit@doctor', 9737629943, 'Male', '2003-03-29', NULL, '5024958.jpg', 'I am a Spinesurgeon.', 'Madhav Avenue, Bapunagar', 'Gujarat', 'Ahmedabad', 380024, 'Approved'),
(22, 'Assistant', 'Parth', 'Patel', 'parthpatel@gmail.com', 'parth@assistant', 9016814132, 'Male', '2004-11-25', NULL, '5024958.jpg', 'I am Assistant', 'C- 301, Casanova Flats, Vastrapur', 'Gujarat', 'Ahmedabad', 380052, 'Pending'),
(24, 'Patient', 'Yash', 'Patil', 'yashpatil@gmail.com', 'yash@patient', 9016511390, 'Male', '1998-06-20', NULL, '696585.jpg', 'I am Patient', 'Madhav Avenue, Bapunaga', 'Gujarat', 'Ahmedabad', 380024, 'Pending'),
(40, 'Doctor', 'Shakti', 'Patel', 'shaktipatel@gmail.com', 'shakti@doctor', 6354039894, 'Female', '1990-03-29', NULL, '957418pic1.jpg', 'I am Dentist.', 'Akshar Hieghts, Y. P. Road, Navrangpura', 'Gujarat', 'Ahmedabad', 380009, 'Approved'),
(41, 'Doctor', 'Kaushal', 'Panchal', 'panchalkaushal@gmial.com', 'kaushal@doctor', 9016511380, 'Male', '2000-09-19', NULL, '598777pic9.jpg', 'I am Doctor', 'Labhghart, vastral,ahmedabad', 'Guajarat', 'Ahmedabad', 382418, 'Pending'),
(42, 'Doctor', 'Dhruvil', 'parmar', 'dhruvilparmar@gmail.com', 'dhruvil@doctor', 9016511398, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rejected'),
(43, 'Patient', 'harsh', 'shah', 'harshshah@gmail.com', 'harsh@patient', 646516587, 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userip` varchar(111) DEFAULT NULL,
  `datee` date DEFAULT NULL,
  `timee` varchar(111) DEFAULT NULL,
  `browser` varchar(555) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `userip`, `datee`, `timee`, `browser`) VALUES
(1, '::1', '2022-03-25', '11:30:31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doc_venue`
--
ALTER TABLE `doc_venue`
  ADD CONSTRAINT `doc_id` FOREIGN KEY (`doc_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_basic_profile`
--
ALTER TABLE `patient_basic_profile`
  ADD CONSTRAINT `patient_basic_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
