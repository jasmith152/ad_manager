-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2014 at 08:58 PM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccba_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad`
--

CREATE TABLE IF NOT EXISTS `tbl_ad` (
  `id` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL default '',
  `owner` varchar(255) NOT NULL default '',
  `s_date` date NOT NULL default '0000-00-00',
  `e_date` date NOT NULL default '0000-00-00',
  `src_code` text,
  `src` varchar(255) default NULL,
  `alt` varchar(255) default NULL,
  `href` varchar(255) default NULL,
  `hits` int(10) default '0',
  `hits_1` int(10) default '0',
  `hits_2` int(10) default '0',
  `hits_3` int(10) default '0',
  `hits_4` int(10) default '0',
  `hits_5` int(10) default '0',
  `hits_6` int(10) default '0',
  `hits_7` int(10) default '0',
  `hits_8` int(10) default '0',
  `hits_9` int(10) default '0',
  `hits_10` int(10) default '0',
  `hits_11` int(10) default '0',
  `hits_12` int(10) default '0',
  `reset` date default '0000-00-00',
  `clicks` int(10) default '0',
  `clicks_1` int(10) default '0',
  `clicks_2` int(10) default '0',
  `clicks_3` int(10) default '0',
  `clicks_4` int(10) default '0',
  `clicks_5` int(10) default '0',
  `clicks_6` int(10) default '0',
  `clicks_7` int(10) default '0',
  `clicks_8` int(10) default '0',
  `clicks_9` int(10) default '0',
  `clicks_10` int(10) default '0',
  `clicks_11` int(10) default '0',
  `clicks_12` int(10) default '0',
  `active` enum('T','F') NOT NULL default 'T',
  `post` enum('T','F') NOT NULL default 'F',
  `zone` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adclient`
--

CREATE TABLE IF NOT EXISTS `tbl_adclient` (
  `id` int(8) NOT NULL auto_increment,
  `c_name` varchar(255) NOT NULL default '',
  `c_phone` varchar(255) NOT NULL default '',
  `c_email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_directory`
--

CREATE TABLE IF NOT EXISTS `tbl_directory` (
  `id` int(8) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `address1` varchar(50) default NULL,
  `address2` varchar(50) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `zip` varchar(10) default NULL,
  `phone1` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `email` varchar(100) default NULL,
  `web_url` varchar(100) default NULL,
  `contact_fname` varchar(50) default NULL,
  `contact_lname` varchar(50) default NULL,
  `category` varchar(50) default NULL,
  `svc_lvl` varchar(50) default 'Standard',
  `descr` text,
  `logo` varchar(255) default NULL,
  `member_type` varchar(50) default NULL,
  `license` varchar(50) default NULL,
  `green_builder` char(1) default 'N',
  `active_member` char(1) default 'Y',
  `lead_cert` char(1) default 'N',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1013 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_zone`
--

CREATE TABLE IF NOT EXISTS `tbl_zone` (
  `id` varchar(16) NOT NULL default '',
  `z_name` varchar(255) default NULL,
  `descr` text,
  `type` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
