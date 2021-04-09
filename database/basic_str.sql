-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `att`;
CREATE TABLE `att` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `month` text NOT NULL,
  `days` int(11) NOT NULL,
  `class` text NOT NULL,
  `attendence` longtext NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `bus_str`;
CREATE TABLE `bus_str` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `stop` text NOT NULL,
  `fee` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `class_str`;
CREATE TABLE `class_str` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `class` text NOT NULL,
  `fee` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `exam_def`;
CREATE TABLE `exam_def` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `exam_code` text NOT NULL,
  `class_code` text NOT NULL,
  `sub_code` longtext NOT NULL,
  `stu` longtext NOT NULL,
  `name` longtext NOT NULL,
  `max_marks` int(11) NOT NULL,
  `pass_marks` int(11) NOT NULL,
  `date` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `fee`;
CREATE TABLE `fee` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `date` text NOT NULL,
  `fee_date` text NOT NULL,
  `class_fee` int(11) NOT NULL,
  `bus_fee` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remarks` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `type` text NOT NULL,
  `date` date NOT NULL,
  `auth` text NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `login` (`Index`, `username`, `password`, `type`, `date`, `auth`) VALUES
(3,	'zara',	'5f4dcc3b5aa765d61d8327deb882cf99',	'user',	'2017-10-01',	'cd758e8f59dfdf06a852adad277986ca');

DROP TABLE IF EXISTS `nos`;
CREATE TABLE `nos` (
  `nos` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `result`;
CREATE TABLE `result` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `exam_code` longtext NOT NULL,
  `result` longtext NOT NULL,
  `total` int(11) NOT NULL,
  `p_class` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pname` text NOT NULL,
  `adm` text NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `addr` longtext NOT NULL,
  `dob` text NOT NULL,
  `class` text NOT NULL,
  `session` int(11) NOT NULL,
  `bus` text NOT NULL,
  `photo` text NOT NULL,
  `remarks` longtext NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`Index`),
  UNIQUE KEY `adm` (`adm`(1000))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sub_def`;
CREATE TABLE `sub_def` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `code` text NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `Index` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pname` text NOT NULL,
  `addr` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` text NOT NULL,
  `dob` text NOT NULL,
  `qual` text NOT NULL,
  `alma` text NOT NULL,
  `spzl` text NOT NULL,
  `salary` int(11) NOT NULL,
  `photo` text NOT NULL,
  `join` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`Index`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 2021-04-08 10:44:47
