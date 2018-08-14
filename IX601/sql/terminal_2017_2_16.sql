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
INSERT INTO `saved_movie_list` VALUES ('测试2','34','万万没想到',0,0,'1970-01-01','1970-01-01'),('测试7','2','变形金刚系列-绝地反击',0,0,'1970-01-01','1970-01-01'),('测试7','34','万万没想到',0,0,'1970-01-01','1970-01-01'),('测试7','44','师父',0,0,'1970-01-01','1970-01-01'),('测试7','46','小门神',0,0,'1970-01-01','1970-01-01'),('测试7','38','唐人街探案',0,0,'1970-01-01','1970-01-01'),('测试7','51','四大名捕',0,0,'1970-01-01','1970-01-01'),('测试7','64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('测试7','57','恐龙当家',0,0,'1970-01-01','1970-01-01'),('测试7','41','寻龙诀',0,0,'1970-01-01','1970-01-01'),('测试7','62','碟中谍5',0,0,'1970-01-01','1970-01-01'),('测试7','70','锅盖头',0,0,'1970-01-01','1970-01-01'),('测试7','68','恶棍天使',0,0,'1970-01-01','1970-01-01'),('测试7','71','小黄人大眼萌',0,0,'1970-01-01','1970-01-01'),('测试7','78','地心营救',0,0,'1970-01-01','1970-01-01'),('测试7','33','万箭穿心',0,0,'1970-01-01','1970-01-01'),('测试7','36','一念天堂',0,0,'1970-01-01','1970-01-01'),('测试7','42','帝国秘符',0,0,'1970-01-01','1970-01-01'),('测试7','43','末日迷踪',0,0,'1970-01-01','1970-01-01'),('测试7','50','变形金刚系列-月黑之时',0,0,'1970-01-01','1970-01-01'),('测试7','59','蚁人',0,0,'1970-01-01','1970-01-01'),('测试6','64','丛林大反攻4',0,0,'1970-01-01','1970-01-01'),('测试6','41','寻龙诀',0,0,'1970-01-01','1970-01-01'),('测试6','62','碟中谍5',0,0,'1970-01-01','1970-01-01'),('测试6','59','蚁人',0,0,'1970-01-01','1970-01-01');
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
INSERT INTO `videolist` VALUES ('2','变形金刚系列-绝地反击','1472150102','2014',1,0,'9907',2,'/2016/0408/','04b0bf3d5bbd75a3d3e0a990045811d8.ts','24415914004'),('33','万箭穿心','1471845225','2012',1,0,'6258',2,'/2016/0413/','dd8a8462246997956e9f7107390897d9.ts','8026216320'),('34','万万没想到','1472100602','2015',1,0,'5744',2,'/2016/0413/','86d7c2aff5c7a190cec4fae19fc9ab09.ts','4275500700'),('36','一念天堂','1471845225','2015',1,0,'5836',2,'/2016/0413/','e5620ec652f58919a55ba61b8695d01a.ts','7351474168'),('38','唐人街探案','1472068803','2015',1,0,'8142',2,'/2016/0413/','4ba25dab035af4905e0df25b7149d160.ts','10402341176'),('41','寻龙诀','1471985702','2015',1,0,'7492',2,'/2016/0413/','9c7ebdc1453389359a7775e71cf22179.ts','9631077004'),('42','帝国秘符','1471845225','2013',1,0,'5633',2,'/2016/0413/','df141f9e899c95777c918a086789f115.ts','7277388444'),('43','末日迷踪','1471845225','2014',1,0,'6189',2,'/2016/0413/','ff5283ac05d468c422cf37a6f14af8f6.ts','14589141972'),('44','师父','1472097902','2015',1,0,'6563',2,'/2016/0413/','643d1a4e39a5f71360ff45f1055cbe30.ts','12924758796'),('46','小门神','1472072402','2016-01-01',1,0,'6573',2,'/2016/0413/','9f82ec2a56092e833fd1638bb8cddb41.ts','4113984448'),('50','变形金刚系列-月黑之时','1471845225','2011',1,0,'9261',2,'/2016/0418/','71684a87efbcc84b91cf5f302feaf12d.ts','23136023916'),('51','四大名捕','1472058002','2012-07-12',1,0,'6805',2,'/2016/0418/','a861721eec2196c55e5a41aec5677b72.ts','8700660492'),('57','恐龙当家','1471997403','2015',1,0,'5026',2,'/2016/0419/','7c4e8028a6d31988a14cbacd69b14a96.ts','12361303056'),('59','蚁人','1471845225','2015-07-17',1,0,'7026',2,'/2016/0419/','0cb63ec4dd931b6dd10ca026c3bf25be.ts','17478012952'),('62','碟中谍5','1471981502','2015',1,0,'7893',2,'/2016/0420/','c3838878de43ebfab1387314f5ef189e.ts','19731008524'),('63','床下有人3','1471845225','2016-03-11',1,0,'5265',2,'/2016/0419/','d9ee133e6d1b0dc768355934589155ad.ts','6657080000'),('64','丛林大反攻4','1472051102','2015',1,0,'5085',2,'/2016/0420/','70ca334d0610dad9f090ff9b07725c4f.ts','12750590144'),('68','恶棍天使','1471937702','2015-12-24',1,0,'7460',2,'/2016/0422/','5c07ca6142ae265252ffaa7a40312a2c.ts','5992929392'),('70','锅盖头','1471963503','2016',1,0,'5339',2,'/2016/0422/','ad802431683f4cf02c45575f8dbdcfd2.ts','13283725244'),('71','小黄人大眼萌','1471924502','2015-07-10',1,0,'5458',2,'/2016/0422/','f47acf05b38ec37edb3e91cacb902dfd.ts','13659561120'),('78','地心营救','1471900802','2015-08-06',1,0,'7630',2,'/2016/0427/','78847f094819f978a4d4835bac172db0.ts','18373942556'),('80','神探夏洛克','1471845225','2016-01-01',1,0,'5585',2,'/2016/0427/','544bf20dab47918e6cc8e7251689a10c.ts','13814722972'),('82','星际迷航：暗黑无界','1471845225','2013-05-17',1,0,'7925',2,'/2016/0427/','5d03deffa0da1d88adcf2fc22106a6d1.ts','19157645560'),('83','特殊身份','1471845225','2013-10-18',1,0,'5980',2,'/2016/0428/','7b4f0ba2381b20e598eac6accb24f8d3.ts','14807576164');
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

-- Dump completed on 2017-02-16 10:31:45
