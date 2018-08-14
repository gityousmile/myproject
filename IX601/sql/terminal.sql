-- MySQL dump 10.13  Distrib 5.6.24-72.2, for Linux (x86_64)
--
-- Host: localhost    Database: terminal
-- ------------------------------------------------------
-- Server version	5.6.24-72.2-log

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
INSERT INTO `administrator` VALUES ('1','1'),('123456','123456'),('admin','123456'),('frank','12'),('xiaomage','majirui1'),('zhou','zhourf'),('zhou123','zhou123');
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
INSERT INTO `devicetab` VALUES ('0012408e4356','192.168.1.90','V0.0.2.7','IX801EX','465GB','437GB','2016-12-06 11:52:53',0,'3','2016-12-06 11:43:56','','0'),('0040ca99a230','192.168.1.70','V0.0.2.2','IX801EX','465GB','433GB','2016-11-22 11:24:40',0,'1','2016-11-22 11:23:59','四大名捕','4780'),('0040ca99a270','192.168.1.84','V0.0.2.7','IX801EX','465GB','166GB','2016-12-02 19:19:00',0,'3','2016-12-02 19:10:50','','0'),('0040ca99a271','192.168.1.87','V0.0.2.9','IX801EX','465GB','165GB','2016-12-06 11:38:41',0,'3','2016-12-06 11:38:37','','0'),('0040ca99a272','192.168.1.62','V0.0.6.S','IX801ES','465GB','388GB','2016-09-21 14:15:29',0,'3','2016-09-28 13:26:22','','0'),('0040ca99a275','192.168.1.69','V0.0.6.S','IX801ES','465GB','432GB','2016-09-11 09:53:01',0,'3','2016-09-28 14:34:18','','0');
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
INSERT INTO `registered_device` VALUES ('0012408E92AC','影厅2','2016-11-12',0),('0040ca99a270','小周的测试机','2016-11-22',2),('0040ca99a271','影厅a271','2016-11-04',4),('0040ca99a272','中科272','2016-11-02',0);
/*!40000 ALTER TABLE `registered_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saved_movie_list`
--

DROP TABLE IF EXISTS `saved_movie_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saved_movie_list` (
  `deviceid` varchar(64) CHARACTER SET utf8 NOT NULL,
  `list_num` int(10) NOT NULL,
  `id` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `file_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `class` int(10) NOT NULL,
  `valid` int(10) NOT NULL,
  `play_start` date NOT NULL,
  `play_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saved_movie_list`
--

LOCK TABLES `saved_movie_list` WRITE;
/*!40000 ALTER TABLE `saved_movie_list` DISABLE KEYS */;
INSERT INTO `saved_movie_list` VALUES ('0040ca99a271',5,'51','四大名捕',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',5,'64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',5,'57','恐龙当家',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',5,'41','寻龙诀',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',5,'62','碟中谍5',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',1,'44','师父',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',1,'46','小门神',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',1,'38','唐人街探案',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',1,'51','四大名捕',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',1,'64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',2,'64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',2,'57','恐龙当家',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',3,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',3,'34','万万没想到',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',3,'44','师父',0,0,'1970-01-01','1970-01-01'),('0040ca99a230',1,'64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('0040ca99a230',1,'57','恐龙当家',0,0,'1970-01-01','1970-01-01'),('0040ca99a230',1,'41','寻龙诀',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',4,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('0040ca99a271',4,'38','唐人街探案',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',3,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',3,'34','万万没想到',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',3,'44','师父',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',3,'46','小门神',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',4,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',4,'34','万万没想到',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',4,'44','师父',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',4,'46','小门神',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',4,'38','唐人街探案',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',5,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',5,'34','万万没想到',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'38','唐人街探案',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'51','四大名捕',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'57','恐龙当家',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'41','寻龙诀',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',1,'62','碟中谍5',0,0,'1970-01-01','1970-01-01'),('0040ca99a270',2,'2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01');
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
INSERT INTO `submitedlist` VALUES ('0040ca99a230','小门神','46'),('0040ca99a230','唐人街探案','38'),('0040ca99a230','四大名捕','51'),('0040ca99a230','地心营救','78'),('0040ca99a270','四大名捕','51'),('0040ca99a270','丛林大反攻4','64'),('0040ca99a270','恐龙当家','57'),('0040ca99a270','寻龙诀','41'),('0040ca99a270','碟中谍5','62'),('0040ca99a271','锅盖头','70'),('0040ca99a271','恶棍天使','68'),('0040ca99a271','小黄人大眼萌','71'),('0040ca99a271','地心营救','78'),('0040ca99a271','万箭穿心','33');
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
INSERT INTO `videolist` VALUES ('2','变形金刚系列-绝地反击','1472150102','2014',1,0,'9907'),('33','万箭穿心','1471845225','2012',1,0,'6258'),('34','万万没想到','1472100602','2015',1,0,'5744'),('36','一念天堂','1471845225','2015',1,0,'5836'),('38','唐人街探案','1472068803','2015',1,0,'8142'),('41','寻龙诀','1471985702','2015',1,0,'7492'),('42','帝国秘符','1471845225','2013',1,0,'5633'),('428','云下的日子','0','2011',1,0,'5831'),('429','回家过年','0','2013',1,0,'5789'),('43','末日迷踪','1471845225','2014',1,0,'6189'),('44','师父','1472097902','2015',1,0,'6563'),('46','小门神','1472072402','2016-01-01',1,0,'6573'),('50','变形金刚系列-月黑之时','1471845225','2011',1,0,'9261'),('51','四大名捕','1472058002','2012-07-12',1,0,'6805'),('511','天上的菊美','0','2014-05-20',1,0,'6053'),('57','恐龙当家','1471997403','2015',1,0,'5026'),('59','蚁人','1471845225','2015-07-17',1,0,'7026'),('62','碟中谍5','1471981502','2015',1,0,'7893'),('63','床下有人3','1471845225','2016-03-11',1,0,'5265'),('64','丛林大反攻4','1472051102','2015',1,0,'5085'),('68','恶棍天使','1471937702','2015-12-24',1,0,'7460'),('70','锅盖头','1471963503','2016',1,0,'5339'),('71','小黄人大眼萌','1471924502','2015-07-10',1,0,'5458'),('78','地心营救','1471900802','2015-08-06',1,0,'7630'),('80','神探夏洛克','1471845225','2016-01-01',1,0,'5585'),('82','星际迷航：暗黑无界','1471845225','2013-05-17',1,0,'7925'),('8291','边境','0','2014-09-05',1,0,'6176'),('83','特殊身份','1471845225','2013-10-18',1,0,'5980'),('8344','冬日奇缘','0','2014-02-14',1,0,'7085'),('8410','丧尸围城：瞭望塔','0','2015',1,0,'7087'),('8420','非我吉日','0','2014-01-16',1,0,'6617'),('8504','发条城市','0','2016-07-08',1,0,'6862'),('8526','宾虚预告片','0','2016-08-19',1,0,'29'),('8864','八道楼子','0','1976-04-16',1,0,'7113'),('8867','变异编年史','0','2008-08-07',1,0,'6682');
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

-- Dump completed on 2016-12-06 11:47:58
