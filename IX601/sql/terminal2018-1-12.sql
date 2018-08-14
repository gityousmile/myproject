-- MySQL dump 10.13  Distrib 5.6.32-78.0, for Linux (x86_64)
--
-- Host: localhost    Database: terminal
-- ------------------------------------------------------
-- Server version	5.6.32-78.0-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `password` varchar(64) DEFAULT NULL,
  `group_name` varchar(64) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES ('admin','8b991036beb8c9032618bb118bfb02c8','超级用户');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_group`
--

DROP TABLE IF EXISTS `device_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_group` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) CHARACTER SET gbk DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_group`
--

LOCK TABLES `device_group` WRITE;
/*!40000 ALTER TABLE `device_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `device_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devicetab`
--

DROP TABLE IF EXISTS `devicetab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devicetab` (
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
  `curr_pos` varchar(64) DEFAULT NULL,
  `curid` varchar(64) DEFAULT NULL,
  `valid_start` datetime DEFAULT NULL,
  `valid_end` datetime DEFAULT NULL,
  `net` int(10) DEFAULT NULL,
  `count` int(10) DEFAULT NULL,
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devicetab`
--

LOCK TABLES `devicetab` WRITE;
/*!40000 ALTER TABLE `devicetab` DISABLE KEYS */;
/*!40000 ALTER TABLE `devicetab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registered_device`
--

DROP TABLE IF EXISTS `registered_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registered_device` (
  `deviceid` varchar(64) NOT NULL DEFAULT '',
  `alias` varchar(64) DEFAULT NULL,
  `register_time` date DEFAULT NULL,
  `current_list_num` int(10) NOT NULL DEFAULT '0',
  `group_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_device`
--

LOCK TABLES `registered_device` WRITE;
/*!40000 ALTER TABLE `registered_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `registered_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_movie_list`
--

DROP TABLE IF EXISTS `saved_movie_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_movie_list` (
  `list_name` varchar(64) DEFAULT NULL,
  `id` varchar(64) DEFAULT NULL,
  `file_name` varchar(64) NOT NULL,
  `class` int(10) NOT NULL,
  `valid` int(10) NOT NULL,
  `play_start` date NOT NULL,
  `play_end` date NOT NULL,
  `create_time` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_movie_list`
--

LOCK TABLES `saved_movie_list` WRITE;
/*!40000 ALTER TABLE `saved_movie_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `saved_movie_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_info`
--

DROP TABLE IF EXISTS `server_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_info` (
  `version_id` varchar(64) NOT NULL,
  `cinema_name` varchar(64) NOT NULL,
  `yun_ip` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_info`
--

LOCK TABLES `server_info` WRITE;
/*!40000 ALTER TABLE `server_info` DISABLE KEYS */;
INSERT INTO `server_info` VALUES ('V0.0.1.0','中科影院','192.168.1.190');
/*!40000 ALTER TABLE `server_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_opera_log`
--

DROP TABLE IF EXISTS `server_opera_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_opera_log` (
  `username` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `oprera_id` varchar(64) NOT NULL,
  `oprera_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `time` varchar(64) NOT NULL,
  `upload_status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_opera_log`
--

LOCK TABLES `server_opera_log` WRITE;
/*!40000 ALTER TABLE `server_opera_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `server_opera_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitedlist`
--

DROP TABLE IF EXISTS `submitedlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submitedlist` (
  `deviceid` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `id` varchar(64) NOT NULL,
  `list_name` varchar(64) NOT NULL,
  `down_status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitedlist`
--

LOCK TABLES `submitedlist` WRITE;
/*!40000 ALTER TABLE `submitedlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `submitedlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terminal_play_log`
--

DROP TABLE IF EXISTS `terminal_play_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terminal_play_log` (
  `deviceid` varchar(64) NOT NULL,
  `id` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `play_start` varchar(64) DEFAULT NULL,
  `play_end` varchar(64) DEFAULT NULL,
  `time` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `video_type` varchar(64) DEFAULT NULL,
  `device_name` varchar(64) DEFAULT NULL,
  `upload_status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminal_play_log`
--

LOCK TABLES `terminal_play_log` WRITE;
/*!40000 ALTER TABLE `terminal_play_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `terminal_play_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videolist`
--

DROP TABLE IF EXISTS `videolist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videolist` (
  `id` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `file_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `down_time` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `release_date` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `play_type` int(11) DEFAULT NULL,
  `play_times` int(11) DEFAULT NULL,
  `time` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `down_status` int(11) DEFAULT NULL,
  `file_path` varchar(64) DEFAULT NULL,
  `save_name` varchar(64) DEFAULT NULL,
  `size` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videolist`
--

LOCK TABLES `videolist` WRITE;
/*!40000 ALTER TABLE `videolist` DISABLE KEYS */;
/*!40000 ALTER TABLE `videolist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-22 15:58:30
