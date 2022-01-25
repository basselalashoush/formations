-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2022 at 01:35 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE IF NOT EXISTS `classroom` (
  `teacher_id` int NOT NULL,
  `period_id` int NOT NULL,
  `training_id` int NOT NULL,
  PRIMARY KEY (`teacher_id`,`period_id`,`training_id`),
  UNIQUE KEY `classroom_periods0_FK` (`period_id`,`teacher_id`) USING BTREE,
  KEY `classroom_trainings_FK` (`training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`teacher_id`, `period_id`, `training_id`) VALUES
(3, 2, 1),
(4, 3, 1),
(1, 4, 2),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachs`
--

DROP TABLE IF EXISTS `teachs`;
CREATE TABLE IF NOT EXISTS `teachs` (
  `training_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  PRIMARY KEY (`training_id`,`teacher_id`),
  KEY `teachs_teachers0_FK` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachs`
--

INSERT INTO `teachs` (`training_id`, `teacher_id`) VALUES
(2, 1),
(2, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `salle` varchar(50) NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `nom`, `salle`) VALUES
(1, 'Dupont', '101'),
(2, 'Martin', '102'),
(3, 'Durand', '201'),
(4, 'Duval', '202');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `training_id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `dateDebutFormation` date DEFAULT NULL,
  `dateFinFormation` date DEFAULT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`training_id`, `libelle`, `lieu`, `commentaire`, `dateDebutFormation`, `dateFinFormation`) VALUES
(1, 'cda', 'LYON', 'concepteur développeur d&#39;applications', '2019-12-05', '2019-12-25'),
(2, 'web', 'villeurbanne', 'développeur web et applications mobiles', '2020-06-01', '2020-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

DROP TABLE IF EXISTS `periods`;
CREATE TABLE IF NOT EXISTS `periods` (
  `period_id` int NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`period_id`, `date_debut`, `date_fin`) VALUES
(1, '2020-10-19', '2021-03-26'),
(2, '2020-08-17', '2021-02-19'),
(3, '2020-08-21', '2020-10-21'),
(4, '2020-08-26', '2020-10-16'),
(5, '2020-10-05', '2020-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

DROP TABLE IF EXISTS `presences`;
CREATE TABLE IF NOT EXISTS `presences` (
  `student_id` int NOT NULL,
  `period_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`period_id`),
  KEY `presences_periods0_FK` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `presences`
--

INSERT INTO `presences` (`student_id`, `period_id`) VALUES
(5, 1),
(1, 2),
(4, 2),
(13, 2),
(2, 3),
(3, 3),
(4, 3),
(13, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nationnalite` varchar(50) NOT NULL,
  `training_id` int NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `training_id` (`training_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `nom`, `prenom`, `nationnalite`, `training_id`) VALUES
(1, 'Becker', 'Josefine', 'Allemande ', 1),
(2, 'Dupont', 'Robert', 'Française ', 1),
(3, 'Monfils', 'Boby', 'Française', 1),
(4, 'Murray', 'Bill', 'Française ', 1),
(5, 'Sharapova', 'Nadia', 'Française ', 2),
(13, 'Jaurès', 'Jean', 'Française ', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_teachers_FK` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `classroom_trainings_FK` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`),
  ADD CONSTRAINT `classroom_periods0_FK` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`);

--
-- Constraints for table `teachs`
--
ALTER TABLE `teachs`
  ADD CONSTRAINT `teachs_teachers0_FK` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `teachs_trainings_FK` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`);

--
-- Constraints for table `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_periods0_FK` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`),
  ADD CONSTRAINT `presences_students_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
