-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-02 03:39:12
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `terminal`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `administrator`
--

INSERT INTO `administrator` (`username`, `password`) VALUES
('1', '1'),
('admin', '123456'),
('frank', '12');

-- --------------------------------------------------------

--
-- 表的结构 `devicetab`
--

CREATE TABLE IF NOT EXISTS `devicetab` (
  `deviceid` varchar(64) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `version` varchar(64) NOT NULL,
  `type` varchar(64) DEFAULT NULL,
  `total_size` varchar(64) DEFAULT NULL,
  `left_size` varchar(64) DEFAULT NULL,
  `system_time` datetime DEFAULT NULL,
  `online` int(10) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `record_time` datetime NOT NULL,
  `curmovie` varchar(64) NOT NULL,
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `devicetab`
--

INSERT INTO `devicetab` (`deviceid`, `ip`, `version`, `type`, `total_size`, `left_size`, `system_time`, `online`, `status`, `record_time`, `curmovie`) VALUES
('0040ca99a271', '192.168.1.91', 'V0.0.9.S', 'IX801EX', '465GB', '240GB', '2016-10-18 16:35:55', 1, '3', '2016-10-18 16:35:29', ''),
('0040ca99a272', '192.168.1.62', 'V0.0.6.S', 'IX801ES', '465GB', '388GB', '2016-09-21 14:15:29', 1, '3', '2016-09-28 13:26:22', ''),
('0040ca99a275', '192.168.1.69', 'V0.0.6.S', 'IX801ES', '465GB', '432GB', '2016-09-11 09:53:01', 0, '3', '2016-09-28 14:34:18', '');

-- --------------------------------------------------------

--
-- 表的结构 `registered_device`
--

CREATE TABLE IF NOT EXISTS `registered_device` (
  `deviceid` varchar(64) NOT NULL DEFAULT '',
  `alias` varchar(64) DEFAULT NULL,
  `register_time` date DEFAULT NULL,
  `current_list_num` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `registered_device`
--

INSERT INTO `registered_device` (`deviceid`, `alias`, `register_time`, `current_list_num`) VALUES
('0040ca99a271', '中科271', '2016-11-02', 0),
('0040ca99a272', '中科272', '2016-11-02', 0),
('0040ca99a273', '中科智网测试机2', '2016-10-12', 0);

-- --------------------------------------------------------

--
-- 表的结构 `saved_movie_list`
--

CREATE TABLE IF NOT EXISTS `saved_movie_list` (
  `deviceid` varchar(64) CHARACTER SET utf8 NOT NULL,
  `list_num` int(10) NOT NULL,
  `id` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `file_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `class` int(10) NOT NULL,
  `valid` int(10) NOT NULL,
  `play_start` date NOT NULL,
  `play_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `saved_movie_list`
--

INSERT INTO `saved_movie_list` (`deviceid`, `list_num`, `id`, `file_name`, `class`, `valid`, `play_start`, `play_end`) VALUES
('0040ca99a271', 1, '46', '小门神', 0, 0, '0000-00-00', '0000-00-00'),
('0040ca99a271', 1, '38', '唐人街探案', 0, 0, '0000-00-00', '0000-00-00'),
('0040ca99a271', 2, '2', '变形金刚系列-绝地反击', 0, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- 表的结构 `submitedlist`
--

CREATE TABLE IF NOT EXISTS `submitedlist` (
  `deviceid` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `submitedlist`
--

INSERT INTO `submitedlist` (`deviceid`, `file_name`, `id`) VALUES
('0040ca99a272', '变形金刚系列-绝地反击', '2'),
('0040ca99a272', '万万没想到', '34'),
('0040ca99a271', '四大名捕', '51'),
('0040ca99a271', '丛林大反攻4', '64');

-- --------------------------------------------------------

--
-- 表的结构 `videolist`
--

CREATE TABLE IF NOT EXISTS `videolist` (
  `id` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `down_time` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `release_date` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `play_type` int(11) DEFAULT NULL,
  `play_times` int(11) DEFAULT NULL,
  `time` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `videolist`
--

INSERT INTO `videolist` (`id`, `file_name`, `down_time`, `release_date`, `play_type`, `play_times`, `time`) VALUES
('2', '变形金刚系列-绝地反击', '1472150102', '2014', 1, 0, '9907'),
('33', '万箭穿心', '1471845225', '2012', 1, 0, '6258'),
('34', '万万没想到', '1472100602', '2015', 1, 0, '5744'),
('38', '唐人街探案', '1472068803', '2015', 1, 0, '8142'),
('41', '寻龙诀', '1471985702', '2015', 1, 0, '7492'),
('44', '师父', '1472097902', '2015', 1, 0, '6563'),
('46', '小门神', '1472072402', '2016-01-01', 1, 0, '6573'),
('51', '四大名捕', '1472058002', '2012-07-12', 1, 0, '6805'),
('57', '恐龙当家', '1471997403', '2015', 1, 0, '5026'),
('62', '碟中谍5', '1471981502', '2015', 1, 0, '7893'),
('64', '丛林大反攻4', '1472051102', '2015', 1, 0, '5085'),
('68', '恶棍天使', '1471937702', '2015-12-24', 1, 0, '7460'),
('70', '锅盖头', '1471963503', '2016', 1, 0, '5339'),
('71', '小黄人大眼萌', '1471924502', '2015-07-10', 1, 0, '5458'),
('78', '地心营救', '1471900802', '2015-08-06', 1, 0, '7630');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
