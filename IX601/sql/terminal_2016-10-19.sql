-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: terminal
-- ------------------------------------------------------
-- Server version	5.6.17

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
INSERT INTO `administrator` VALUES ('1','1'),('admin','123456');
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
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devicetab`
--

LOCK TABLES `devicetab` WRITE;
/*!40000 ALTER TABLE `devicetab` DISABLE KEYS */;
INSERT INTO `devicetab` VALUES ('0040ca99a271','192.168.1.57','V0.0.9.S','IX801EX','465GB','240GB','2016-10-18 16:35:55',1,'3','2016-10-18 16:35:29',''),('0040ca99a272','192.168.1.62','V0.0.6.S','IX801ES','465GB','388GB','2016-09-21 14:15:29',1,'3','2016-09-28 13:26:22',''),('0040ca99a273','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:33:51',''),('0040ca99a274','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:06',''),('0040ca99a275','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:18',''),('0040ca99a276','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:23',''),('0040ca99a277','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:26',''),('0040ca99a278','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:30',''),('0040ca99a279','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:34',''),('0040ca99a280','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:38',''),('0040ca99a281','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:35:12',''),('0040ca99a291','192.168.1.81','V0.0.6.S','IX801ES','465GB','366GB','2016-10-12 16:40:57',0,'1','2016-10-12 17:16:34','变形金刚系列-绝地反击');
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
  PRIMARY KEY (`deviceid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_device`
--

LOCK TABLES `registered_device` WRITE;
/*!40000 ALTER TABLE `registered_device` DISABLE KEYS */;
INSERT INTO `registered_device` VALUES ('0040ca99a271','frank的设备','2016-10-12'),('0040ca99a272','中科智网测试机1','2016-10-12'),('0040ca99a273','中科智网测试机2','2016-10-12'),('0040ca99a2a1','影厅１','2016-10-16'),('0040ca99a2b3','影厅２','2016-10-16'),('0040ca99a2c4','影厅３','2016-10-16'),('123','123','2016-10-12'),('12345','12345','2016-10-15');
/*!40000 ALTER TABLE `registered_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitedlist`
--

DROP TABLE IF EXISTS `submitedlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submitedlist` (
  `deviceid` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitedlist`
--

LOCK TABLES `submitedlist` WRITE;
/*!40000 ALTER TABLE `submitedlist` DISABLE KEYS */;
INSERT INTO `submitedlist` VALUES ('0040ca99a272','变形金刚系列-绝地反击'),('0040ca99a272','万万没想到'),('0040ca99a271','变形金刚系列-绝地反击'),('0040ca99a271','万万没想到'),('0040ca99a271','师父'),('0040ca99a271','小门神'),('0040ca99a271','唐人街探案'),('0040ca99a271','四大名捕'),('0040ca99a271','丛林大反攻4'),('0040ca99a271','恐龙当家'),('0040ca99a271','寻龙诀'),('0040ca99a271','碟中谍5'),('0040ca99a271','锅盖头'),('0040ca99a271','恶棍天使'),('0040ca99a271','小黄人大眼萌'),('0040ca99a271','地心营救');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videolist`
--

LOCK TABLES `videolist` WRITE;
/*!40000 ALTER TABLE `videolist` DISABLE KEYS */;
INSERT INTO `videolist` VALUES ('2','变形金刚系列-绝地反击','1472150102','2014',1,0,'9907'),('33','万箭穿心','1471845225','2012',1,0,'6258'),('34','万万没想到','1472100602','2015',1,0,'5744'),('38','唐人街探案','1472068803','2015',1,0,'8142'),('41','寻龙诀','1471985702','2015',1,0,'7492'),('44','师父','1472097902','2015',1,0,'6563'),('46','小门神','1472072402','2016-01-01',1,0,'6573'),('51','四大名捕','1472058002','2012-07-12',1,0,'6805'),('57','恐龙当家','1471997403','2015',1,0,'5026'),('62','碟中谍5','1471981502','2015',1,0,'7893'),('64','丛林大反攻4','1472051102','2015',1,0,'5085'),('68','恶棍天使','1471937702','2015-12-24',1,0,'7460'),('70','锅盖头','1471963503','2016',1,0,'5339'),('71','小黄人大眼萌','1471924502','2015-07-10',1,0,'5458'),('78','地心营救','1471900802','2015-08-06',1,0,'7630');
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

-- Dump completed on 2016-10-19  8:35:02
