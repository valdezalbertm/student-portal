-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2014 at 04:11 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studentportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash_key` text NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `account_type_id` (`account_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `account_type_id`, `username`, `password`, `hash_key`, `last_login`) VALUES
(1, 1, 'Jenn', '$2y$10$FxFGZDv/ittBADGLB1HS4uib7YWcS44I02yiY4C4nW985lVbc8o3u', '482adb7cad038f014bf906602b347b4c', '2014-03-27 02:03:52'),
(16, 2, 'Jennifer', '$2y$10$yA4MmJdhWr.dIpZEtCVWSOsKCrmxMyW792DrjFvbIkLR/tDsFOTRq', '31a6b5568bbb9c350c1b296d9086acf0', '2014-03-18 11:03:53'),
(17, 2, 'Elaiza', '$2y$10$6JNL0xPgH4BJnvxmxtKjouUgAyYntXTwFepIylpXMawpAmU3szWLW', '', '0000-00-00 00:00:00'),
(20, 3, '201400000', '$2y$10$tE1kV9//fNwwl7Hy6vXt.Opj9r27ncVEPASvjQMvfqi40reAs.3DW', 'da69515fd5a53b94ce79b9925f36b339', '2014-03-18 11:03:29'),
(21, 3, '201400001', '$2y$10$EiaBAtY1N3qf80fsurrDaO4PQBhH3RY4ATdQK0sjIEJaVSTVjM8ee', '', '0000-00-00 00:00:00'),
(22, 3, '201400002', '$2y$10$IlK3dhtEBxsyNS6BBXufieYPiSt0Y5aCcohynA94AkLoAh5A/rJ0e', '', '0000-00-00 00:00:00'),
(23, 3, '201400003', '$2y$10$KpS1PYsIdIjVwo1AU/qW8e3Y5e70SAPMNRhwRI3cnUythutfUTdj.', '', '0000-00-00 00:00:00'),
(24, 3, '201400004', '$2y$10$HRZjyH.hSHLz11cBuvciFumifuWv827drcVEJCFXDw/OjQkFB43fK', '', '0000-00-00 00:00:00'),
(25, 3, '201400005', '$2y$10$EUcszhB3eo1q9LVp/5kVWOdmkF3Hn9W6kFCJt0JHwPCNu8yUcezUC', '2465517595f5ea9f225d52ed73a4d0db', '2014-03-18 10:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`id`, `name`, `description`) VALUES
(1, 'Administrator', 'Administrator'),
(2, 'Professor', 'Professor'),
(3, 'Student', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `subject`, `description`, `create_date`) VALUES
(1, 'Attendance', 'Everybody is required to attend the baccalaureate mass on Sunday.', '2014-03-06 14:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`id`, `first_name`, `last_name`, `middle_name`, `contact`, `email`) VALUES
(17, 'Christian', 'Esperar', 'de Villa', '09153883327', 'christianesperar@gmail.com'),
(18, 'James', 'Lima', 'Sample', '09153883327', 'jameslima@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_scholarship_quiz_answer`
--

CREATE TABLE IF NOT EXISTS `applicant_scholarship_quiz_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_scholarship_quiz_result_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_scholarship_quiz_result_id` (`applicant_scholarship_quiz_result_id`),
  KEY `question_id` (`question_id`),
  KEY `choice_id` (`choice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_scholarship_quiz_result`
--

CREATE TABLE IF NOT EXISTS `applicant_scholarship_quiz_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `scholarship_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_schedule_id` int(11) unsigned NOT NULL,
  `score` decimal(10,0) NOT NULL DEFAULT '0',
  `overall` decimal(10,0) NOT NULL DEFAULT '0',
  `date_started` datetime NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `validation_key` varchar(50) DEFAULT NULL,
  `procedure` enum('register','take','pass') DEFAULT 'register',
  `is_pass` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_id` (`applicant_id`,`scholarship_id`),
  KEY `scholarship_result_ibfk_2` (`scholarship_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `quiz_schedule_id` (`quiz_schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `applicant_scholarship_quiz_result`
--

INSERT INTO `applicant_scholarship_quiz_result` (`id`, `applicant_id`, `scholarship_id`, `quiz_id`, `quiz_schedule_id`, `score`, `overall`, `date_started`, `school_year`, `validation_key`, `procedure`, `is_pass`) VALUES
(18, 18, 4, 11, 12, '0', '0', '0000-00-00 00:00:00', '2013-2014', '82086', 'register', 0);

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE IF NOT EXISTS `choice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `choice`
--

INSERT INTO `choice` (`id`, `content`) VALUES
(19, '<p>-4</p>'),
(20, '<p>4</p>'),
(21, '<p>1/4</p>'),
(22, '<p>10</p>'),
(23, '<p>20</p>'),
(24, '<p>4</p>'),
(25, '<p>0.4</p>'),
(26, '<p>0.04</p>'),
(27, '<p>11</p>'),
(28, '<p>48</p>'),
(29, '<p>-12</p>'),
(30, '<p>22</p>'),
(31, '<p>1,846,000</p>'),
(32, '<p>1,852,000</p>'),
(33, '<p>1,000,000</p>'),
(34, '<p>1,500,000</p>'),
(35, '<p>[&nbsp;-5&nbsp;,&nbsp;+&nbsp;infinity)</p>'),
(36, '<p>[&nbsp;2&nbsp;,&nbsp;+&nbsp;infinity)</p>'),
(37, '<p>(&nbsp;-&nbsp;infinity&nbsp;,&nbsp;2]</p>'),
(38, '<p>(&nbsp;-&nbsp;infinity&nbsp;,&nbsp;0]</p>'),
(39, '<p>Oxygen</p>'),
(40, '<p>Hydrogen&nbsp;sulphide</p>'),
(41, '<p>Carbon&nbsp;dioxide</p>'),
(42, '<p>Carbon&nbsp;dioxide</p>'),
(43, '<p>Phosphorous</p>'),
(44, '<p>Bromine</p>'),
(45, '<p>Chlorine</p>'),
(46, '<p>Chlorine</p>'),
(47, '<p>Copper</p>'),
(48, '<p>Magnesium</p>'),
(49, '<p>Iron</p>'),
(50, '<p>Calcium</p>'),
(51, '<p>Graphite</p>'),
(52, '<p>Silicon</p>'),
(53, '<p>Charcoal</p>'),
(54, '<p>Phosphorous</p>'),
(55, '<p>Tin</p>'),
(56, '<p>Mercury</p>'),
(57, '<p>Lead</p>'),
(58, '<p>Zinc</p>');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `admin_account` int(11) NOT NULL COMMENT 'account type id that will be assigned as admin',
  `school_year` varchar(100) NOT NULL COMMENT 'current schoolyear',
  KEY `admin_account` (`admin_account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`admin_account`, `school_year`) VALUES
(1, '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(4, 'Department of Science'),
(5, 'Department of Filipino'),
(6, 'Department of Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `department_id` (`department_id`),
  KEY `id` (`id`),
  KEY `user_id` (`user_id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `contact`, `email`, `department_id`) VALUES
(9, 16, 'Jennifer Mae', 'Gonzaga', 'Alcedo', '09161234567', 'jen@yahoo.com', 4),
(10, 17, 'Elaiza', 'Abelcruz', 'Abrenica', '09151234567', 'aljur_sweet@yahoo.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_section`
--

CREATE TABLE IF NOT EXISTS `instructor_section` (
  `instructor_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  KEY `instructor_id` (`instructor_id`),
  KEY `section_id` (`section_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor_section`
--

INSERT INTO `instructor_section` (`instructor_id`, `section_id`, `subject_id`, `schedule`, `room`) VALUES
(9, 1, 1, '', ''),
(9, 2, 1, '', ''),
(9, 3, 1, '', ''),
(10, 4, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `question_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_ibfk_2` (`question_type_id`),
  KEY `answer` (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `content`, `question_type_id`) VALUES
(28, '<p>If Logx&nbsp;(1 / 8) = - 3 / 2, then x is equal to?</p>', 3),
(29, '<p>20&nbsp;%&nbsp;of&nbsp;2&nbsp;is&nbsp;equal&nbsp;to?</p>', 3),
(30, '<p>If Log 4 (x) = 12, then log 2 (x / 4) is equal to?</p>', 3),
(32, '<p>The population of a country increased by an average of 2% per year from 2000 to 2003. If the population of this country was 2 000 000 on December 31, 2003, then the population of this country on January 1, 2000, to the nearest thousand would have been?</p>', 3),
(33, '<p>f is a quadratic function whose graph is a parabola opening upward and has a vertex on the x-axis. The graph of the new function g defined by g(x) = 2 - f(x - 5) has a range defined by the interval.</p>', 3),
(34, '<p>Brass gets discoloured in air because of the presence of which of the following gases in air?</p>', 3),
(35, '<p>Which&nbsp;of&nbsp;the&nbsp;following&nbsp;is&nbsp;a&nbsp;non&nbsp;metal&nbsp;that&nbsp;remains&nbsp;liquid&nbsp;at&nbsp;room&nbsp;temperature?</p>', 3),
(36, '<p>Chlorophyll is a naturally occurring chelate compound in which central metal is</p>', 3),
(37, '<p>Which of the following is used in pencils?</p>', 3),
(38, '<p>Which of the following metals forms an amalgam with other metals?</p>', 3),
(39, '<p>The small child does whatever his father&nbsp;was done.</p>', 3),
(41, '123', 3),
(42, '123', 3),
(43, '123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `question_choice`
--

CREATE TABLE IF NOT EXISTS `question_choice` (
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `answer` tinyint(4) DEFAULT '0',
  KEY `question_id` (`question_id`,`choice_id`),
  KEY `question_choice_ibfk_2` (`choice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_choice`
--

INSERT INTO `question_choice` (`question_id`, `choice_id`, `answer`) VALUES
(28, 19, 0),
(28, 20, 1),
(28, 21, 0),
(28, 22, 0),
(29, 23, 0),
(29, 24, 0),
(29, 25, 1),
(29, 26, 0),
(30, 27, 0),
(30, 28, 0),
(30, 29, 0),
(30, 30, 1),
(32, 31, 1),
(32, 32, 0),
(32, 33, 0),
(32, 34, 0),
(33, 35, 0),
(33, 36, 0),
(33, 37, 1),
(33, 38, 0),
(34, 39, 0),
(34, 40, 1),
(34, 41, 0),
(34, 42, 0),
(35, 43, 0),
(35, 44, 1),
(35, 45, 0),
(35, 46, 0),
(36, 47, 0),
(36, 48, 1),
(36, 49, 0),
(36, 50, 0),
(37, 51, 1),
(37, 52, 0),
(37, 53, 0),
(37, 54, 0),
(38, 55, 0),
(38, 56, 1),
(38, 57, 0),
(38, 58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `answer` enum('1','>= 1') DEFAULT NULL,
  `editable` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `name`, `description`, `answer`, `editable`) VALUES
(1, 'Fill In The Blank', 'Fill In The Blank', '1', '1'),
(3, 'Multiple Choice', 'Multiple Choice', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `instruction` text NOT NULL,
  `description` text NOT NULL,
  `time_limit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `title`, `instruction`, `description`, `time_limit`) VALUES
(11, 'Scholarship Examination Set', '<p>Our examinations are presented online. This has the advantage of enabling the Academy to closely monitor your progress and answers. It also provides a result immediately -- on completion of the exam.</p>\r\n<p style="text-align: center;"><br /><strong>EXAM TIME</strong></p>\r\n<p>The exam time for each course is stated in your course completion instruction window for each course. It ranges from 30 minutess to 4 hours. You will be graded either when you click the &ldquo;SUBMIT EXAMINATION&rdquo; button or the time is reached.</p>', '<p>This&nbsp; is a mutliple choice based examination where answer can be 1 or more based on question. You will be credited if you choose on of the correct answer.</p>', 60);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE IF NOT EXISTS `quiz_question` (
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  KEY `quiz_id` (`quiz_id`,`question_id`),
  KEY `quiz_question_ibfk_2` (`question_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`quiz_id`, `question_id`, `subject_id`) VALUES
(11, 28, 3),
(11, 29, 3),
(11, 30, 3),
(11, 32, 3),
(11, 33, 3),
(11, 34, 4),
(11, 35, 4),
(11, 36, 4),
(11, 37, 4),
(11, 38, 4);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_schedule`
--

CREATE TABLE IF NOT EXISTS `quiz_schedule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `slots` int(11) unsigned NOT NULL,
  `registered` int(11) unsigned NOT NULL DEFAULT '0',
  `allow_to_take` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `quiz_schedule`
--

INSERT INTO `quiz_schedule` (`id`, `quiz_id`, `from`, `to`, `slots`, `registered`, `allow_to_take`) VALUES
(12, 11, '2014-03-24 09:00:00', '2014-03-25 12:00:00', 50, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE IF NOT EXISTS `scholarship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`id`, `name`) VALUES
(4, 'Ayong');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_discount`
--

CREATE TABLE IF NOT EXISTS `scholarship_discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL,
  `type` enum('percentage','fix') NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `scholarship_discount`
--

INSERT INTO `scholarship_discount` (`id`, `scholarship_id`, `type`, `value`, `school_year`) VALUES
(4, 4, 'fix', '2000', '2013-2014'),
(5, 4, 'percentage', '25', '2014-2015');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_quiz`
--

CREATE TABLE IF NOT EXISTS `scholarship_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholarship_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarship_quiz_ibfk_2` (`quiz_id`),
  KEY `scholarship_id` (`scholarship_id`,`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `scholarship_quiz`
--

INSERT INTO `scholarship_quiz` (`id`, `scholarship_id`, `quiz_id`, `school_year`) VALUES
(1, 4, 11, '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_quiz_result`
--

CREATE TABLE IF NOT EXISTS `scholarship_quiz_result` (
  `student_id` int(11) NOT NULL,
  `scholarship_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` decimal(10,0) NOT NULL,
  `overall` decimal(10,0) NOT NULL,
  `date_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `school_year` varchar(100) NOT NULL,
  KEY `student_id` (`student_id`,`scholarship_id`),
  KEY `scholarship_result_ibfk_2` (`scholarship_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE IF NOT EXISTS `school_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `name`) VALUES
(4, '2013-2014'),
(5, '2014-2015');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `year_level_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year_level_id` (`year_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `year_level_id`) VALUES
(1, 'Section 1', 1),
(2, 'Section 2', 2),
(3, 'Section 3', 3),
(4, 'Section 4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `section_student`
--

CREATE TABLE IF NOT EXISTS `section_student` (
  `section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  KEY `section_id` (`section_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `year_level_id` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`year_level_id`),
  KEY `student_ibfk_2` (`year_level_id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_number`, `first_name`, `middle_name`, `last_name`, `year_level_id`, `birthdate`, `gender`, `contact`, `email`) VALUES
(20, '201400000', 'Christian', 'De Villa', 'Esperar', 2, '1991-12-31', 'Female', '09161234567', 'albertwap11@yahoo.com'),
(21, '201400001', 'Marlo', 'Ala', 'Corridor', 4, '1991-02-02', '', NULL, NULL),
(22, '201400002', 'Albert', 'Miniano', 'Valdez', 1, '1992-08-12', 'Male', '09181234567', 'albert@yahoo.com'),
(23, '201400003', 'Justin', 'Mercado', 'Beiber', 2, '1991-02-02', 'Female', '09163251377', 'mail@valdez.ph'),
(24, '201400004', 'Albert', 'Gonzaga', 'Alcedo', 1, '1990-01-02', 'Female', '09161234567', 'albertwap11@yahoo.com'),
(25, '201400005', 'Christian De Villa Esperar', 'Miniano', 'Alcedo', 1, '1990-01-01', 'Female', '09161234567', 'albertwap11@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE IF NOT EXISTS `student_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `year_level_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `score` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `year_level_id` (`year_level_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=608 ;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`id`, `student_id`, `year_level_id`, `subject_id`, `school_year`, `score`) VALUES
(416, 20, 1, 1, '1', '80'),
(417, 20, 1, 2, '1', '90'),
(418, 20, 1, 3, '1', '100'),
(419, 20, 1, 4, '1', '70'),
(420, 20, 1, 5, '1', '10'),
(421, 20, 1, 6, '1', '90'),
(422, 20, 1, 7, '1', '80'),
(423, 20, 1, 8, '1', '100'),
(424, 20, 2, 9, '1', ''),
(425, 20, 2, 10, '1', ''),
(426, 20, 2, 11, '1', ''),
(427, 20, 2, 12, '1', ''),
(428, 20, 2, 13, '1', ''),
(429, 20, 2, 14, '1', ''),
(430, 20, 2, 15, '1', ''),
(431, 20, 2, 16, '1', ''),
(432, 20, 3, 17, '1', ''),
(433, 20, 3, 18, '1', ''),
(434, 20, 3, 19, '1', ''),
(435, 20, 3, 20, '1', ''),
(436, 20, 3, 21, '1', ''),
(437, 20, 3, 22, '1', ''),
(438, 20, 3, 23, '1', ''),
(439, 20, 3, 24, '1', ''),
(440, 20, 4, 25, '1', ''),
(441, 20, 4, 26, '1', ''),
(442, 20, 4, 27, '1', ''),
(443, 20, 4, 28, '1', ''),
(444, 20, 4, 29, '1', ''),
(445, 20, 4, 30, '1', ''),
(446, 20, 4, 31, '1', ''),
(447, 20, 4, 32, '1', ''),
(448, 21, 1, 1, '1', ''),
(449, 21, 1, 2, '1', ''),
(450, 21, 1, 3, '1', ''),
(451, 21, 1, 4, '1', ''),
(452, 21, 1, 5, '1', ''),
(453, 21, 1, 6, '1', ''),
(454, 21, 1, 7, '1', ''),
(455, 21, 1, 8, '1', ''),
(456, 21, 2, 9, '1', ''),
(457, 21, 2, 10, '1', ''),
(458, 21, 2, 11, '1', ''),
(459, 21, 2, 12, '1', ''),
(460, 21, 2, 13, '1', ''),
(461, 21, 2, 14, '1', ''),
(462, 21, 2, 15, '1', ''),
(463, 21, 2, 16, '1', ''),
(464, 21, 3, 17, '1', ''),
(465, 21, 3, 18, '1', ''),
(466, 21, 3, 19, '1', ''),
(467, 21, 3, 20, '1', ''),
(468, 21, 3, 21, '1', ''),
(469, 21, 3, 22, '1', ''),
(470, 21, 3, 23, '1', ''),
(471, 21, 3, 24, '1', ''),
(472, 21, 4, 25, '1', ''),
(473, 21, 4, 26, '1', ''),
(474, 21, 4, 27, '1', ''),
(475, 21, 4, 28, '1', ''),
(476, 21, 4, 29, '1', ''),
(477, 21, 4, 30, '1', ''),
(478, 21, 4, 31, '1', ''),
(479, 21, 4, 32, '1', ''),
(480, 22, 1, 1, '1', ''),
(481, 22, 1, 2, '1', ''),
(482, 22, 1, 3, '1', ''),
(483, 22, 1, 4, '1', ''),
(484, 22, 1, 5, '1', ''),
(485, 22, 1, 6, '1', ''),
(486, 22, 1, 7, '1', ''),
(487, 22, 1, 8, '1', ''),
(488, 22, 2, 9, '1', ''),
(489, 22, 2, 10, '1', ''),
(490, 22, 2, 11, '1', ''),
(491, 22, 2, 12, '1', ''),
(492, 22, 2, 13, '1', ''),
(493, 22, 2, 14, '1', ''),
(494, 22, 2, 15, '1', ''),
(495, 22, 2, 16, '1', ''),
(496, 22, 3, 17, '1', ''),
(497, 22, 3, 18, '1', ''),
(498, 22, 3, 19, '1', ''),
(499, 22, 3, 20, '1', ''),
(500, 22, 3, 21, '1', ''),
(501, 22, 3, 22, '1', ''),
(502, 22, 3, 23, '1', ''),
(503, 22, 3, 24, '1', ''),
(504, 22, 4, 25, '1', ''),
(505, 22, 4, 26, '1', ''),
(506, 22, 4, 27, '1', ''),
(507, 22, 4, 28, '1', ''),
(508, 22, 4, 29, '1', ''),
(509, 22, 4, 30, '1', ''),
(510, 22, 4, 31, '1', ''),
(511, 22, 4, 32, '1', ''),
(512, 23, 1, 1, '1', ''),
(513, 23, 1, 2, '1', ''),
(514, 23, 1, 3, '1', ''),
(515, 23, 1, 4, '1', ''),
(516, 23, 1, 5, '1', ''),
(517, 23, 1, 6, '1', ''),
(518, 23, 1, 7, '1', ''),
(519, 23, 1, 8, '1', ''),
(520, 23, 2, 9, '1', ''),
(521, 23, 2, 10, '1', ''),
(522, 23, 2, 11, '1', ''),
(523, 23, 2, 12, '1', ''),
(524, 23, 2, 13, '1', ''),
(525, 23, 2, 14, '1', ''),
(526, 23, 2, 15, '1', ''),
(527, 23, 2, 16, '1', ''),
(528, 23, 3, 17, '1', ''),
(529, 23, 3, 18, '1', ''),
(530, 23, 3, 19, '1', ''),
(531, 23, 3, 20, '1', ''),
(532, 23, 3, 21, '1', ''),
(533, 23, 3, 22, '1', ''),
(534, 23, 3, 23, '1', ''),
(535, 23, 3, 24, '1', ''),
(536, 23, 4, 25, '1', ''),
(537, 23, 4, 26, '1', ''),
(538, 23, 4, 27, '1', ''),
(539, 23, 4, 28, '1', ''),
(540, 23, 4, 29, '1', ''),
(541, 23, 4, 30, '1', ''),
(542, 23, 4, 31, '1', ''),
(543, 23, 4, 32, '1', ''),
(544, 24, 1, 1, '1', ''),
(545, 24, 1, 2, '1', ''),
(546, 24, 1, 3, '1', ''),
(547, 24, 1, 4, '1', ''),
(548, 24, 1, 5, '1', ''),
(549, 24, 1, 6, '1', ''),
(550, 24, 1, 7, '1', ''),
(551, 24, 1, 8, '1', ''),
(552, 24, 2, 9, '1', ''),
(553, 24, 2, 10, '1', ''),
(554, 24, 2, 11, '1', ''),
(555, 24, 2, 12, '1', ''),
(556, 24, 2, 13, '1', ''),
(557, 24, 2, 14, '1', ''),
(558, 24, 2, 15, '1', ''),
(559, 24, 2, 16, '1', ''),
(560, 24, 3, 17, '1', ''),
(561, 24, 3, 18, '1', ''),
(562, 24, 3, 19, '1', ''),
(563, 24, 3, 20, '1', ''),
(564, 24, 3, 21, '1', ''),
(565, 24, 3, 22, '1', ''),
(566, 24, 3, 23, '1', ''),
(567, 24, 3, 24, '1', ''),
(568, 24, 4, 25, '1', ''),
(569, 24, 4, 26, '1', ''),
(570, 24, 4, 27, '1', ''),
(571, 24, 4, 28, '1', ''),
(572, 24, 4, 29, '1', ''),
(573, 24, 4, 30, '1', ''),
(574, 24, 4, 31, '1', ''),
(575, 24, 4, 32, '1', ''),
(576, 25, 1, 1, '1', ''),
(577, 25, 1, 2, '1', ''),
(578, 25, 1, 3, '1', ''),
(579, 25, 1, 4, '1', ''),
(580, 25, 1, 5, '1', ''),
(581, 25, 1, 6, '1', ''),
(582, 25, 1, 7, '1', ''),
(583, 25, 1, 8, '1', ''),
(584, 25, 2, 9, '1', ''),
(585, 25, 2, 10, '1', ''),
(586, 25, 2, 11, '1', ''),
(587, 25, 2, 12, '1', ''),
(588, 25, 2, 13, '1', ''),
(589, 25, 2, 14, '1', ''),
(590, 25, 2, 15, '1', ''),
(591, 25, 2, 16, '1', ''),
(592, 25, 3, 17, '1', ''),
(593, 25, 3, 18, '1', ''),
(594, 25, 3, 19, '1', ''),
(595, 25, 3, 20, '1', ''),
(596, 25, 3, 21, '1', ''),
(597, 25, 3, 22, '1', ''),
(598, 25, 3, 23, '1', ''),
(599, 25, 3, 24, '1', ''),
(600, 25, 4, 25, '1', ''),
(601, 25, 4, 26, '1', ''),
(602, 25, 4, 27, '1', ''),
(603, 25, 4, 28, '1', ''),
(604, 25, 4, 29, '1', ''),
(605, 25, 4, 30, '1', ''),
(606, 25, 4, 31, '1', ''),
(607, 25, 4, 32, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_penalty`
--

CREATE TABLE IF NOT EXISTS `student_penalty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `type` enum('minor','major') NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `recorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_scholarship`
--

CREATE TABLE IF NOT EXISTS `student_scholarship` (
  `student_id` int(11) NOT NULL,
  `scholarship_id` int(11) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  KEY `student_id` (`student_id`),
  KEY `scholarship_id` (`scholarship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_scholarship`
--

INSERT INTO `student_scholarship` (`student_id`, `scholarship_id`, `school_year`) VALUES
(20, 4, '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `student_scholarship_quiz_answer`
--

CREATE TABLE IF NOT EXISTS `student_scholarship_quiz_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_scholarship_quiz_result_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  KEY `choice_id` (`choice_id`),
  KEY `student_scholarship_quiz_answer_ibfk_1` (`student_scholarship_quiz_result_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `student_scholarship_quiz_answer`
--

INSERT INTO `student_scholarship_quiz_answer` (`id`, `student_scholarship_quiz_result_id`, `question_id`, `choice_id`, `correct`) VALUES
(41, 27, 28, 22, 0),
(42, 27, 29, 26, 0),
(43, 27, 30, 30, 0),
(44, 27, 32, 34, 0),
(45, 27, 33, 38, 0),
(46, 27, 34, 42, 0),
(47, 27, 35, 46, 0),
(48, 27, 36, 50, 0),
(49, 27, 37, 54, 0),
(50, 27, 38, 58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_scholarship_quiz_result`
--

CREATE TABLE IF NOT EXISTS `student_scholarship_quiz_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `scholarship_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_schedule_id` int(11) unsigned NOT NULL,
  `score` decimal(10,0) NOT NULL DEFAULT '0',
  `overall` decimal(10,0) NOT NULL DEFAULT '0',
  `date_started` datetime NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `validation_key` varchar(50) NOT NULL,
  `procedure` enum('register','take','pass') DEFAULT 'register',
  `is_pass` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`,`scholarship_id`),
  KEY `scholarship_result_ibfk_2` (`scholarship_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `quiz_schedule_id` (`quiz_schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `student_scholarship_quiz_result`
--

INSERT INTO `student_scholarship_quiz_result` (`id`, `student_id`, `scholarship_id`, `quiz_id`, `quiz_schedule_id`, `score`, `overall`, `date_started`, `school_year`, `validation_key`, `procedure`, `is_pass`) VALUES
(27, 20, 4, 11, 12, '0', '10', '2014-03-16 20:20:50', '2013-2014', '40429', 'pass', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`) VALUES
(1, 'eng1', 'English 1'),
(2, 'fil1', 'Filipino 1'),
(3, 'mat1', 'Mathematics 1'),
(4, 'sci1', 'Science 1'),
(5, 'soc1', 'Social Studies 1'),
(6, 'com1', 'Computer Studies 1'),
(7, 'tle1', 'T. L. E. 1'),
(8, 'map1', 'MAPEH 1'),
(9, 'eng2', 'English 2'),
(10, 'fil2', 'Filipino 2'),
(11, 'mat2', 'Mathematics 2'),
(12, 'sci2', 'Science 2'),
(13, 'soc2', 'Social Studies 2'),
(14, 'com2', 'Computer Studies 2'),
(15, 'tle2', 'T. L. E. 2'),
(16, 'map2', 'MAPEH 2'),
(17, 'eng3', 'English 3'),
(18, 'fil3', 'Filipino 3'),
(19, 'mat3', 'Mathematics 3'),
(20, 'sci3', 'Science 3'),
(21, 'soc3', 'Social Studies 3'),
(22, 'com3', 'Computer Studies 3'),
(23, 'tle3', 'T. L. E. 3'),
(24, 'map3', 'MAPEH 3'),
(25, 'eng4', 'English 4'),
(26, 'fil4', 'Filipino 4'),
(27, 'mat4', 'Mathematics 4'),
(28, 'sci4', 'Science 4'),
(29, 'soc4', 'Social Studies 4'),
(30, 'com4', 'Computer Studies 4'),
(31, 'tle4', 'T. L. E. 4'),
(32, 'map4', 'MAPEH 4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_account_list`
--
CREATE TABLE IF NOT EXISTS `vw_account_list` (
`id` int(11)
,`username` varchar(100)
,`type` varchar(100)
,`hash_key` text
,`last_login` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_administrator_section_list_count`
--
CREATE TABLE IF NOT EXISTS `vw_administrator_section_list_count` (
`id` int(11)
,`section_id` int(11)
,`student` bigint(21)
,`section_name` varchar(100)
,`year_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_professor_list`
--
CREATE TABLE IF NOT EXISTS `vw_professor_list` (
`id` int(11)
,`username` varchar(100)
,`last_name` varchar(100)
,`middle_name` varchar(100)
,`first_name` varchar(100)
,`contact` varchar(20)
,`email` varchar(100)
,`dept_id` int(11)
,`dept_name` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_professor_section_count`
--
CREATE TABLE IF NOT EXISTS `vw_professor_section_count` (
`id` int(11)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`contact` varchar(20)
,`email` varchar(100)
,`department_id` int(11)
,`section_handled` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_professor_section_list`
--
CREATE TABLE IF NOT EXISTS `vw_professor_section_list` (
`id` int(11)
,`user_id` int(11)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`contact` varchar(20)
,`email` varchar(100)
,`department_id` int(11)
,`section_id` int(11)
,`section_name` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_professor_section_list_count`
--
CREATE TABLE IF NOT EXISTS `vw_professor_section_list_count` (
`id` int(11)
,`user_id` int(11)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`contact` varchar(20)
,`email` varchar(100)
,`department_id` int(11)
,`section_id` int(11)
,`section_name` varchar(100)
,`student` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_section_list`
--
CREATE TABLE IF NOT EXISTS `vw_section_list` (
`id` int(11)
,`name` varchar(100)
,`year_id` int(11)
,`year_level` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_section_student`
--
CREATE TABLE IF NOT EXISTS `vw_section_student` (
`id` int(11)
,`section` varchar(100)
,`student_id` int(11)
,`student_number` varchar(100)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`school_year` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_section_student_no`
--
CREATE TABLE IF NOT EXISTS `vw_section_student_no` (
`id` int(11)
,`student_no` bigint(21)
,`name` varchar(100)
,`year_id` int(11)
,`year_level` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_student_list`
--
CREATE TABLE IF NOT EXISTS `vw_student_list` (
`id` int(11)
,`username` varchar(100)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`year_id` int(11)
,`year_name` varchar(100)
,`birthdate` date
,`gender` enum('Male','Female')
,`contact` varchar(100)
,`email` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_student_subject_grade`
--
CREATE TABLE IF NOT EXISTS `vw_student_subject_grade` (
`id` int(11)
,`student_id` int(11)
,`student_number` varchar(100)
,`first_name` varchar(100)
,`middle_name` varchar(100)
,`last_name` varchar(100)
,`year_level_id` int(11)
,`subject_id` int(11)
,`code` varchar(10)
,`name` varchar(100)
,`school_year` varchar(100)
,`score` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `w_administrator_section_list_count`
--
CREATE TABLE IF NOT EXISTS `w_administrator_section_list_count` (
`id` int(11)
,`student_no` bigint(21)
,`section_name` varchar(100)
,`year_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `year_level`
--

CREATE TABLE IF NOT EXISTS `year_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `year_level`
--

INSERT INTO `year_level` (`id`, `name`) VALUES
(1, 'First Year'),
(2, 'Second Year'),
(3, 'Third Year'),
(4, 'Fourth Year'),
(5, 'Fifth Year');

-- --------------------------------------------------------

--
-- Table structure for table `year_level_subject`
--

CREATE TABLE IF NOT EXISTS `year_level_subject` (
  `year_level_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  KEY `year_level_id` (`year_level_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `vw_account_list`
--
DROP TABLE IF EXISTS `vw_account_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_account_list` AS select `t0`.`id` AS `id`,`t0`.`username` AS `username`,`t1`.`name` AS `type`,`t0`.`hash_key` AS `hash_key`,`t0`.`last_login` AS `last_login` from (`account` `t0` left join `account_type` `t1` on((`t0`.`account_type_id` = `t1`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_administrator_section_list_count`
--
DROP TABLE IF EXISTS `vw_administrator_section_list_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_administrator_section_list_count` AS select `t0`.`id` AS `id`,`t0`.`id` AS `section_id`,count(`t2`.`student_id`) AS `student`,`t0`.`name` AS `section_name`,`t0`.`year_level_id` AS `year_id` from (`section` `t0` left join `section_student` `t2` on((`t0`.`id` = `t2`.`section_id`))) group by `t0`.`id`;

-- --------------------------------------------------------

--
-- Structure for view `vw_professor_list`
--
DROP TABLE IF EXISTS `vw_professor_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_professor_list` AS select `t0`.`id` AS `id`,`t0`.`username` AS `username`,`t1`.`last_name` AS `last_name`,`t1`.`middle_name` AS `middle_name`,`t1`.`first_name` AS `first_name`,`t1`.`contact` AS `contact`,`t1`.`email` AS `email`,`t1`.`department_id` AS `dept_id`,`t2`.`name` AS `dept_name` from ((`account` `t0` join `instructor` `t1` on((`t0`.`id` = `t1`.`user_id`))) left join `department` `t2` on((`t1`.`department_id` = `t2`.`id`))) where (`t0`.`account_type_id` = 2);

-- --------------------------------------------------------

--
-- Structure for view `vw_professor_section_count`
--
DROP TABLE IF EXISTS `vw_professor_section_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_professor_section_count` AS select `t0`.`id` AS `id`,`t0`.`first_name` AS `first_name`,`t0`.`middle_name` AS `middle_name`,`t0`.`last_name` AS `last_name`,`t0`.`contact` AS `contact`,`t0`.`email` AS `email`,`t0`.`department_id` AS `department_id`,count(`t1`.`instructor_id`) AS `section_handled` from (`instructor` `t0` left join `instructor_section` `t1` on((`t0`.`id` = `t1`.`instructor_id`))) group by `t0`.`id`;

-- --------------------------------------------------------

--
-- Structure for view `vw_professor_section_list`
--
DROP TABLE IF EXISTS `vw_professor_section_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_professor_section_list` AS select `t0`.`id` AS `id`,`t0`.`user_id` AS `user_id`,`t0`.`first_name` AS `first_name`,`t0`.`middle_name` AS `middle_name`,`t0`.`last_name` AS `last_name`,`t0`.`contact` AS `contact`,`t0`.`email` AS `email`,`t0`.`department_id` AS `department_id`,`t2`.`id` AS `section_id`,`t2`.`name` AS `section_name` from ((`instructor` `t0` join `instructor_section` `t1` on((`t0`.`id` = `t1`.`instructor_id`))) join `section` `t2` on((`t1`.`section_id` = `t2`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_professor_section_list_count`
--
DROP TABLE IF EXISTS `vw_professor_section_list_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_professor_section_list_count` AS select `t0`.`id` AS `id`,`t0`.`user_id` AS `user_id`,`t0`.`first_name` AS `first_name`,`t0`.`middle_name` AS `middle_name`,`t0`.`last_name` AS `last_name`,`t0`.`contact` AS `contact`,`t0`.`email` AS `email`,`t0`.`department_id` AS `department_id`,`t2`.`id` AS `section_id`,`t2`.`name` AS `section_name`,`t3`.`student_no` AS `student` from (((`instructor` `t0` join `instructor_section` `t1` on((`t0`.`id` = `t1`.`instructor_id`))) join `section` `t2` on((`t1`.`section_id` = `t2`.`id`))) left join `vw_section_student_no` `t3` on((`t2`.`id` = `t3`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_section_list`
--
DROP TABLE IF EXISTS `vw_section_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_section_list` AS select `t0`.`id` AS `id`,`t0`.`name` AS `name`,`t0`.`year_level_id` AS `year_id`,`t1`.`name` AS `year_level` from (`section` `t0` left join `year_level` `t1` on((`t0`.`year_level_id` = `t1`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_section_student`
--
DROP TABLE IF EXISTS `vw_section_student`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_section_student` AS select `t0`.`section_id` AS `id`,`t1`.`name` AS `section`,`t0`.`student_id` AS `student_id`,`t2`.`student_number` AS `student_number`,`t2`.`first_name` AS `first_name`,`t2`.`middle_name` AS `middle_name`,`t2`.`last_name` AS `last_name`,`t3`.`name` AS `school_year` from (((`section_student` `t0` left join `section` `t1` on((`t0`.`section_id` = `t1`.`id`))) left join `student` `t2` on((`t0`.`student_id` = `t2`.`id`))) left join `school_year` `t3` on((`t0`.`school_year` = `t3`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `vw_section_student_no`
--
DROP TABLE IF EXISTS `vw_section_student_no`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_section_student_no` AS select `t0`.`id` AS `id`,count(`t2`.`student_id`) AS `student_no`,`t0`.`name` AS `name`,`t0`.`year_level_id` AS `year_id`,`t1`.`name` AS `year_level` from ((`section` `t0` left join `year_level` `t1` on((`t0`.`year_level_id` = `t1`.`id`))) left join `section_student` `t2` on((`t0`.`id` = `t2`.`section_id`))) group by `t0`.`id`;

-- --------------------------------------------------------

--
-- Structure for view `vw_student_list`
--
DROP TABLE IF EXISTS `vw_student_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_student_list` AS select `t0`.`id` AS `id`,`t0`.`username` AS `username`,`t1`.`first_name` AS `first_name`,`t1`.`middle_name` AS `middle_name`,`t1`.`last_name` AS `last_name`,`t1`.`year_level_id` AS `year_id`,`t2`.`name` AS `year_name`,`t1`.`birthdate` AS `birthdate`,`t1`.`gender` AS `gender`,`t1`.`contact` AS `contact`,`t1`.`email` AS `email` from ((`account` `t0` join `student` `t1` on((`t0`.`id` = `t1`.`id`))) left join `year_level` `t2` on((`t1`.`year_level_id` = `t2`.`id`))) where (`t0`.`account_type_id` = '3');

-- --------------------------------------------------------

--
-- Structure for view `vw_student_subject_grade`
--
DROP TABLE IF EXISTS `vw_student_subject_grade`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_student_subject_grade` AS select `t0`.`id` AS `id`,`t1`.`id` AS `student_id`,`t1`.`student_number` AS `student_number`,`t1`.`first_name` AS `first_name`,`t1`.`middle_name` AS `middle_name`,`t1`.`last_name` AS `last_name`,`t1`.`year_level_id` AS `year_level_id`,`t2`.`id` AS `subject_id`,`t2`.`code` AS `code`,`t2`.`name` AS `name`,`t0`.`school_year` AS `school_year`,`t0`.`score` AS `score` from ((`student_grade` `t0` left join `student` `t1` on((`t0`.`student_id` = `t1`.`id`))) left join `subject` `t2` on((`t0`.`subject_id` = `t2`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `w_administrator_section_list_count`
--
DROP TABLE IF EXISTS `w_administrator_section_list_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `w_administrator_section_list_count` AS select `t0`.`id` AS `id`,count(`t2`.`student_id`) AS `student_no`,`t0`.`name` AS `section_name`,`t0`.`year_level_id` AS `year_id` from (`section` `t0` left join `section_student` `t2` on((`t0`.`id` = `t2`.`section_id`))) group by `t0`.`id`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant_scholarship_quiz_answer`
--
ALTER TABLE `applicant_scholarship_quiz_answer`
  ADD CONSTRAINT `applicant_scholarship_quiz_answer_ibfk_1` FOREIGN KEY (`applicant_scholarship_quiz_result_id`) REFERENCES `applicant_scholarship_quiz_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_scholarship_quiz_answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_scholarship_quiz_answer_ibfk_3` FOREIGN KEY (`choice_id`) REFERENCES `choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applicant_scholarship_quiz_result`
--
ALTER TABLE `applicant_scholarship_quiz_result`
  ADD CONSTRAINT `applicant_scholarship_quiz_result_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_scholarship_quiz_result_ibfk_2` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_scholarship_quiz_result_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicant_scholarship_quiz_result_ibfk_4` FOREIGN KEY (`quiz_schedule_id`) REFERENCES `quiz_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`admin_account`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructor_section`
--
ALTER TABLE `instructor_section`
  ADD CONSTRAINT `instructor_section_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_section_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructor_section_ibfk_4` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_choice`
--
ALTER TABLE `question_choice`
  ADD CONSTRAINT `question_choice_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_choice_ibfk_2` FOREIGN KEY (`choice_id`) REFERENCES `choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `quiz_question_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_question_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_schedule`
--
ALTER TABLE `quiz_schedule`
  ADD CONSTRAINT `quiz_schedule_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship_discount`
--
ALTER TABLE `scholarship_discount`
  ADD CONSTRAINT `scholarship_discount_ibfk_1` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship_quiz`
--
ALTER TABLE `scholarship_quiz`
  ADD CONSTRAINT `scholarship_quiz_ibfk_1` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scholarship_quiz_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarship_quiz_result`
--
ALTER TABLE `scholarship_quiz_result`
  ADD CONSTRAINT `scholarship_quiz_result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scholarship_quiz_result_ibfk_2` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scholarship_quiz_result_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`year_level_id`) REFERENCES `year_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section_student`
--
ALTER TABLE `section_student`
  ADD CONSTRAINT `section_student_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `section_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`year_level_id`) REFERENCES `year_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_grade`
--
ALTER TABLE `student_grade`
  ADD CONSTRAINT `student_grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_grade_ibfk_2` FOREIGN KEY (`year_level_id`) REFERENCES `year_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_grade_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_penalty`
--
ALTER TABLE `student_penalty`
  ADD CONSTRAINT `student_penalty_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_scholarship`
--
ALTER TABLE `student_scholarship`
  ADD CONSTRAINT `student_scholarship_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_ibfk_2` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_scholarship_quiz_answer`
--
ALTER TABLE `student_scholarship_quiz_answer`
  ADD CONSTRAINT `student_scholarship_quiz_answer_ibfk_1` FOREIGN KEY (`student_scholarship_quiz_result_id`) REFERENCES `student_scholarship_quiz_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_quiz_answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_quiz_answer_ibfk_3` FOREIGN KEY (`choice_id`) REFERENCES `choice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_scholarship_quiz_result`
--
ALTER TABLE `student_scholarship_quiz_result`
  ADD CONSTRAINT `student_scholarship_quiz_result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_quiz_result_ibfk_2` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_quiz_result_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_scholarship_quiz_result_ibfk_4` FOREIGN KEY (`quiz_schedule_id`) REFERENCES `quiz_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `year_level_subject`
--
ALTER TABLE `year_level_subject`
  ADD CONSTRAINT `year_level_subject_ibfk_1` FOREIGN KEY (`year_level_id`) REFERENCES `year_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `year_level_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
