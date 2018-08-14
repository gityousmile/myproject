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
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES ('frank','123321');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
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
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devicetab`
--

LOCK TABLES `devicetab` WRITE;
/*!40000 ALTER TABLE `devicetab` DISABLE KEYS */;
INSERT INTO `devicetab` VALUES ('0012408e369b','192.168.1.69','V0.0.5.4','IX801EX','465GB','123GB','2017-02-15 18:16:40',0,'3','2017-02-15 18:16:41','','0'),('0040ca99a269','192.168.1.67','V0.0.4.7','IX801EX','465GB','0KB','2017-01-13 14:18:46',0,'1','2017-01-13 14:18:48','小门神','4640'),('0040ca99a270','192.168.1.144','V0.0.4.5','IX801EX','465GB','178GB','2017-01-09 12:59:34',0,'1','2017-01-09 12:59:27','丛林大反攻4','1759');
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
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_device`
--

LOCK TABLES `registered_device` WRITE;
/*!40000 ALTER TABLE `registered_device` DISABLE KEYS */;
INSERT INTO `registered_device` VALUES ('0012408E369B','胡的测试设备','2017-01-10',2),('0040CA99A269','胡影厅','2017-01-04',3),('0040CA99A270','周大胖','2017-01-04',0);
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
  `play_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_movie_list`
--

LOCK TABLES `saved_movie_list` WRITE;
/*!40000 ALTER TABLE `saved_movie_list` DISABLE KEYS */;
INSERT INTO `saved_movie_list` VALUES ('梦想','23','梦想合伙人',0,0,'1970-01-01','1970-01-01'),('X战警','16','X战警：天启',0,0,'1970-01-01','1970-01-01'),('谎言','7','谎言大爆炸',0,0,'1970-01-01','1970-01-01'),('再见','19','再见，在也不见',0,0,'1970-01-01','1970-01-01'),('夜孔雀','18','夜孔雀',0,0,'1970-01-01','1970-01-01'),('谁梦','14','谁的青春不迷茫',0,0,'1970-01-01','1970-01-01'),('谁梦','23','梦想合伙人',0,0,'1970-01-01','1970-01-01'),('夜见','19','再见，在也不见',0,0,'1970-01-01','1970-01-01'),('夜见','18','夜孔雀',0,0,'1970-01-01','1970-01-01');
/*!40000 ALTER TABLE `saved_movie_list` ENABLE KEYS */;
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
  `id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitedlist`
--

LOCK TABLES `submitedlist` WRITE;
/*!40000 ALTER TABLE `submitedlist` DISABLE KEYS */;
INSERT INTO `submitedlist` VALUES ('','四大名捕','51'),('','丛林大反攻4','64'),('0040CA99A270','寻龙诀','41'),('0040CA99A269','四大名捕','51'),('0040CA99A269','丛林大反攻4','64'),('0040CA99A269','恶棍天使','68'),('0012408e369b','变形金刚系列-绝地反击','2'),('0012408e369b','万万没想到','34'),('0012408e369b','师父','44'),('0012408e369b','小门神','46'),('0012408e369b','唐人街探案','38'),('0012408e369b','四大名捕','51'),('0012408e369b','丛林大反攻4','64'),('0012408e369b','恐龙当家','57'),('0012408e369b','寻龙诀','41'),('0012408e369b','碟中谍5','62'),('0012408e369b','锅盖头','70'),('0012408e369b','恶棍天使','68'),('0012408e369b','小黄人大眼萌','71'),('0012408e369b','地心营救','78'),('0012408e369b','万箭穿心','33'),('0012408e369b','一念天堂','36'),('0012408e369b','帝国秘符','42'),('0012408e369b','末日迷踪','43'),('0012408e369b','变形金刚系列-月黑之时','50'),('0012408e369b','蚁人','59');
/*!40000 ALTER TABLE `submitedlist` ENABLE KEYS */;
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
INSERT INTO `videolist` VALUES ('10','马小乐之玩具也疯狂','1487936101','2016-04-30',1,0,'4593',2,'/2016/1028/','fecd8f43c3c20eccdf8b82f719330206.ts','4096971388'),('14','谁的青春不迷茫','1487935802','2016-04-22',1,0,'6495',2,'/2016/1028/','788e7386bde3a1d6171ed690be8eb407.ts','3893359304'),('16','X战警：天启','1487935502','2016-05-09',1,0,'8637',2,'/2016/1028/','bd1c32c506728d45914cdb39c37a6e09.ts','10764298516'),('18','夜孔雀','1487937002','2016-05-20',1,0,'5093',2,'/2016/1028/','59b4c7dd2667f5cfb176a8e67b5b29e5.ts','3719257580'),('19','再见，在也不见','1487938202','2016-05-13',1,0,'6508',2,'/2016/1028/','fbc13d2667486807f50c5d9930c38e55.ts','4723042408'),('21','妖医','1487938802','2016-05-27',1,0,'4789',2,'/2016/1028/','dccd1940dccb683f54041ff0f0cd51b1.ts','6785363116'),('23','梦想合伙人','1487934602','2016-04-29',1,0,'6082',2,'/2016/1028/','2e697578739456062879116dad29c44b.ts','5446609664'),('24','爱丽丝梦游仙境2：镜中奇遇记','1487936702','2016-05-27',1,0,'6799',2,'/2016/1028/','305cd46683843863d0cfa590b39fef1b.ts','5126095796'),('7','谎言大爆炸','1487937902','2016-05-13',1,0,'5051',2,'/2016/1028/','b65140426804e1b0acd821cc73ef89ea.ts','7125749148'),('9','青蛙总动员','1487936402','2016-04-30',1,0,'4352',2,'/2016/1028/','362c9237ee75b387a5994112007d3c8b.ts','3158803636');
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

-- Dump completed on 2017-03-04 15:20:40
