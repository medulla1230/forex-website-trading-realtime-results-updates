-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2017 at 12:09 AM
-- Server version: 5.0.96-community
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fightfor_fxrpv17`
--

-- --------------------------------------------------------

--
-- Table structure for table `fxrpt_users`
--

CREATE TABLE IF NOT EXISTS `fxrpt_users` (
  `uid` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `addedon` text collate utf8_unicode_ci NOT NULL,
  `ueml` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `status` varchar(10) collate utf8_unicode_ci NOT NULL default 'active',
  `upass` varchar(30) collate utf8_unicode_ci NOT NULL default 'welcome1',
  `cbref` varchar(30) collate utf8_unicode_ci NOT NULL default 'schopade',
  `userstatusrems` text collate utf8_unicode_ci NOT NULL,
  `fname` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'First name',
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `ueml` (`ueml`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User header data';

-- --------------------------------------------------------

--
-- Table structure for table `fxrpt_userstemp`
--

CREATE TABLE IF NOT EXISTS `fxrpt_userstemp` (
  `cnt` bigint(20) NOT NULL auto_increment,
  `uid` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `entrytime` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `code` varchar(10) collate utf8_unicode_ci NOT NULL default '',
  `ueml` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `passw` varchar(30) collate utf8_unicode_ci NOT NULL COMMENT 'Password',
  `fname` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'Name first',
  PRIMARY KEY  (`cnt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Temporary table for registration' AUTO_INCREMENT=7858 ;

-- --------------------------------------------------------

--
-- Table structure for table `fxrp_trades`
--

CREATE TABLE IF NOT EXISTS `fxrp_trades` (
  `uid` varchar(8) NOT NULL default '',
  `uacc` int(7) NOT NULL default '0',
  `ticket` int(9) NOT NULL default '0',
  `status` varchar(6) default NULL,
  `type` varchar(4) default NULL,
  `lot_size` int(6) default NULL,
  `tick_size` decimal(6,5) default NULL,
  `open_time` timestamp NULL default NULL,
  `close_time` timestamp NULL default NULL,
  `symbol` varchar(6) default NULL,
  `magic_number` int(8) default NULL,
  `lots` decimal(4,3) default NULL,
  `open` decimal(20,5) default NULL,
  `close` decimal(20,5) default NULL,
  `stop_loss` decimal(20,5) default NULL,
  `take_profit` decimal(20,5) default NULL,
  `profit` decimal(20,3) default NULL,
  `points_change` int(4) default NULL,
  `swap` decimal(4,3) default NULL,
  `commission` decimal(4,3) default NULL,
  `net_profit` decimal(20,3) default NULL,
  `acc_bal` decimal(20,3) NOT NULL COMMENT 'Account balance',
  `comment` varchar(11) default NULL,
  `curr` varchar(5) NOT NULL,
  `lastupd` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `growth` double NOT NULL default '0' COMMENT 'Percent growth for the trade',
  PRIMARY KEY  (`uid`,`uacc`,`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Trades data';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
