-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2015 at 08:35 PM
-- Server version: 10.0.16-MariaDB-log
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thunderw_e-kaunseling`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `appointment_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_id` int(5) NOT NULL COMMENT 'student',
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_message` text NOT NULL,
  `appointment_reply` text NOT NULL COMMENT 'message from counsleor',
  `appointment_status` int(5) NOT NULL DEFAULT '0' COMMENT '0 - in progress, 1 - approve, 2 - rejected, 3 - passed',
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `student_id`, `appointment_date`, `appointment_time`, `appointment_message`, `appointment_reply`, `appointment_status`) VALUES
(1, 1, '2015-01-21', '03:30:00', '<p>\r\n	sya xad hal mustahak nk bice dengan <strong>tuan/puan</strong></p>\r\n', '', 1),
(3, 1, '2015-02-02', '00:00:03', '<p>\r\n	vfvfvf sdfsdfsd dfrtyrty</p>\r\n', '<p>\r\n	sya bizi</p>\r\n', 2),
(4, 1, '2015-02-16', '00:00:09', '<p>\n	fyp xsiap</p>\n', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(5) NOT NULL AUTO_INCREMENT,
  `chat_parent_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `chat_from` int(5) NOT NULL,
  `chat_to` varchar(50) NOT NULL,
  `chat_message` text NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_parent_id`, `student_id`, `chat_from`, `chat_to`, `chat_message`) VALUES
(55, 15, 3, 3, 'counselor', 'hi'),
(56, 15, 3, 0, 'counselor', 'bkpo'),
(57, 15, 3, 3, 'counselor', 'dk wat gpo tu'),
(58, 15, 3, 0, 'counselor', 'dk sajo jah'),
(59, 15, 3, 3, 'counselor', 'pahtu??'),
(60, 16, 1, 1, 'counselor', 'hyiii'),
(61, 16, 1, 0, 'counselor', 'guano tu'),
(66, 16, 1, 1, 'counselor', 'hhhh'),
(67, 16, 1, 1, 'counselor', 'dddd'),
(68, 16, 1, 0, 'counselor', 'hhhh'),
(69, 16, 1, 1, 'counselor', 'ggg'),
(70, 17, 1, 1, 'counselor', 'ggg'),
(71, 18, 3, 3, 'counselor', 'kkk'),
(72, 19, 1, 1, 'counselor', ''),
(73, 20, 1, 1, 'counselor', 'ju'),
(74, 20, 1, 0, 'counselor', 'wei\n'),
(75, 20, 1, 1, 'counselor', 'kkk'),
(76, 20, 1, 0, 'counselor', 'ppp\n'),
(77, 20, 1, 1, 'counselor', 'sdfsdf'),
(78, 20, 1, 0, 'counselor', 'asdxas\n'),
(79, 21, 1, 1, 'counselor', 'Aaa'),
(80, 21, 1, 1, 'counselor', ''),
(81, 20, 1, 0, 'counselor', 'Senah'),
(82, 21, 1, 0, 'counselor', 'Bedah'),
(83, 22, 1, 1, 'counselor', 'uuuuuuuuuuuuuuuuuii'),
(84, 22, 1, 1, 'counselor', ''),
(85, 22, 1, 0, 'counselor', 'msj sapa\n'),
(86, 22, 1, 0, 'counselor', 'demo demo demo ko ni?'),
(87, 22, 1, 1, 'counselor', 'haha\nhola\n'),
(88, 22, 1, 1, 'counselor', 'tra la cam plok\n'),
(89, 22, 1, 1, 'counselor', ''),
(90, 22, 1, 1, 'counselor', '');

-- --------------------------------------------------------

--
-- Table structure for table `chat_parent`
--

CREATE TABLE IF NOT EXISTS `chat_parent` (
  `chat_parent_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_id` int(5) NOT NULL,
  `chat_parent_date` date NOT NULL,
  `chat_parent_time` time NOT NULL,
  PRIMARY KEY (`chat_parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `chat_parent`
--

INSERT INTO `chat_parent` (`chat_parent_id`, `student_id`, `chat_parent_date`, `chat_parent_time`) VALUES
(20, 1, '2015-02-03', '04:04:37'),
(21, 1, '2015-02-15', '05:47:57'),
(22, 1, '2015-02-18', '01:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `counselors`
--

CREATE TABLE IF NOT EXISTS `counselors` (
  `counselor_id` int(5) NOT NULL AUTO_INCREMENT,
  `counselor_no` varchar(20) NOT NULL,
  `counselor_password` varchar(20) NOT NULL,
  `counselor_email` varchar(30) NOT NULL,
  `counselor_name` varchar(100) NOT NULL,
  `counselor_ic` varchar(20) NOT NULL,
  PRIMARY KEY (`counselor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `counselors`
--

INSERT INTO `counselors` (`counselor_id`, `counselor_no`, `counselor_password`, `counselor_email`, `counselor_name`, `counselor_ic`) VALUES
(1, 'q', '1', 'mnnnn@gmailo.com1', 'vvvv1', '1'),
(2, '2', '02', 'joyah@yahoo.com', 'mek joyah', '123');

-- --------------------------------------------------------

--
-- Table structure for table `forum_answers`
--

CREATE TABLE IF NOT EXISTS `forum_answers` (
  `forum_answer_id` int(5) NOT NULL AUTO_INCREMENT,
  `forum_topic_id` int(5) NOT NULL COMMENT 'forum_topic',
  `forum_category_id` int(5) NOT NULL COMMENT 'forum_categories',
  `forum_answer_from` int(5) NOT NULL COMMENT 'students',
  `forum_answer_text` text NOT NULL,
  `forum_answer_date` date NOT NULL,
  PRIMARY KEY (`forum_answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `forum_answers`
--

INSERT INTO `forum_answers` (`forum_answer_id`, `forum_topic_id`, `forum_category_id`, `forum_answer_from`, `forum_answer_text`, `forum_answer_date`) VALUES
(4, 4, 4, 3, '<p>\r\n	jkljkl</p>\r\n', '2015-01-17'),
(6, 18, 1, 1, 'mnjk', '2015-01-30'),
(7, 19, 1, 1, 'iii', '2015-01-30'),
(20, 18, 1, 1, '<p>\r\n	jujujuju</p>\r\n', '0000-00-00'),
(21, 18, 1, 1, '<p>\r\n	opopopop</p>\r\n', '2015-01-30'),
(22, 18, 1, 1, '<p>\r\n	ujujuj</p>\r\n', '2015-01-30'),
(23, 18, 1, 1, '<p>\r\n	nhnhnhnhnhn</p>\r\n', '2015-01-30'),
(24, 18, 1, 3, '<p>\r\n	huhuhuhu</p>\r\n', '2015-01-30'),
(25, 4, 4, 1, '<blockquote>\n	<p>\n		&nbsp;</p>\n</blockquote>\n', '2015-02-02'),
(26, 4, 4, 1, '<blockquote>\n	<p>\n		&nbsp;</p>\n</blockquote>\n', '2015-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `forum_category_id` int(5) NOT NULL AUTO_INCREMENT,
  `forum_category_name` varchar(150) NOT NULL,
  `forum_category_no` int(5) NOT NULL,
  PRIMARY KEY (`forum_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`forum_category_id`, `forum_category_name`, `forum_category_no`) VALUES
(1, 'Educations', 0),
(4, 'Sports', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `forum_topic_id` int(5) NOT NULL AUTO_INCREMENT,
  `forum_category_id` int(5) NOT NULL COMMENT 'from forum_category table',
  `forum_topic_title` varchar(150) NOT NULL,
  `forum_topic_date_created` date NOT NULL,
  `forum_topic_post_no` int(5) NOT NULL DEFAULT '1' COMMENT 'number of discuss',
  `forum_topic_create_by` int(5) NOT NULL COMMENT 'students',
  PRIMARY KEY (`forum_topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`forum_topic_id`, `forum_category_id`, `forum_topic_title`, `forum_topic_date_created`, `forum_topic_post_no`, `forum_topic_create_by`) VALUES
(4, 4, 'pppp', '2015-01-08', 3, 3),
(18, 1, 'ert', '2015-01-30', 6, 1),
(19, 1, 'ttt', '2015-01-30', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_no` varchar(20) NOT NULL,
  `student_ic` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_no`, `student_ic`, `student_name`) VALUES
(1, 'b', '1', 'adfadsf1'),
(3, 'm', '5', 'ggg1');

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

CREATE TABLE IF NOT EXISTS `system_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(160) COLLATE utf8_bin DEFAULT NULL,
  `salt` varchar(160) COLLATE utf8_bin DEFAULT NULL,
  `user_role_id` int(10) DEFAULT NULL,
  `last_login` datetime DEFAULT '0000-00-00 00:00:00',
  `last_login_ip` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `reset_request_code` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `reset_request_time` datetime DEFAULT NULL,
  `reset_request_ip` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `verification_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `system_users`
--

INSERT INTO `system_users` (`id`, `email`, `password`, `salt`, `user_role_id`, `last_login`, `last_login_ip`, `reset_request_code`, `reset_request_time`, `reset_request_ip`, `verification_status`, `status`) VALUES
(1, 'admin@admin.com', '8e666f12a66c17a952a1d5e273428e478e02d943', '4f6cdddc4979b8.51434094', 1, '2015-01-31 15:28:52', '::1', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_map`
--

CREATE TABLE IF NOT EXISTS `user_access_map` (
  `user_role_id` int(10) NOT NULL,
  `controller` varchar(255) COLLATE utf8_bin NOT NULL,
  `permission` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_role_id`,`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_access_map`
--

INSERT INTO `user_access_map` (`user_role_id`, `controller`, `permission`) VALUES
(1, 'admin/welcome', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `user_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `default_access` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`, `default_access`) VALUES
(1, 'Admin', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `video_chat`
--

CREATE TABLE IF NOT EXISTS `video_chat` (
  `video_chat_id` int(5) NOT NULL AUTO_INCREMENT,
  `student_id` int(5) NOT NULL,
  `student_no` varchar(20) NOT NULL,
  `video_chat_name` varchar(150) NOT NULL,
  PRIMARY KEY (`video_chat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `video_chat`
--

INSERT INTO `video_chat` (`video_chat_id`, `student_id`, `student_no`, `video_chat_name`) VALUES
(1, 1, 'b', 'zfMmVWZJjA'),
(2, 1, 'b', 'tLCEPPofip'),
(3, 1, 'b', '9Euzb2zNGA'),
(7, 1, 'b', 'QDddwgHAtm'),
(8, 1, 'b', 'KJzePPcrTp'),
(9, 1, 'b', 'td49N3WtDA'),
(10, 1, 'b', 'e14Mv9guus'),
(11, 1, 'b', 'I0Lzzi8Cg2'),
(12, 1, 'b', '0xW7eGFl0G');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
