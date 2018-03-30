-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: CDL
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

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
-- Table structure for table `Build`
--

DROP TABLE IF EXISTS `Build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Build` (
  `BuildID` int(11) NOT NULL AUTO_INCREMENT,
  `Build` decimal(2,2) NOT NULL,
  `BuildType` varchar(12) NOT NULL,
  `Changes` varchar(255) NOT NULL,
  PRIMARY KEY (`BuildID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Build`
--

LOCK TABLES `Build` WRITE;
/*!40000 ALTER TABLE `Build` DISABLE KEYS */;
/*!40000 ALTER TABLE `Build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CDL`
--

DROP TABLE IF EXISTS `CDL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CDL` (
  `DefID` int(11) NOT NULL AUTO_INCREMENT,
  `OldID` varchar(24) DEFAULT NULL,
  `Location` int(11) NOT NULL,
  `SpecLoc` varchar(55) NOT NULL,
  `Severity` int(11) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Spec` int(11) DEFAULT NULL,
  `DateCreated` date NOT NULL,
  `Status` int(11) NOT NULL,
  `IdentifiedBy` varchar(24) NOT NULL,
  `SystemAffected` int(11) NOT NULL,
  `GroupToResolve` int(11) NOT NULL,
  `ActionOwner` varchar(55) DEFAULT NULL,
  `EvidenceType` int(11) DEFAULT NULL,
  `EvidenceLink` varchar(255) DEFAULT NULL,
  `DateClosed` date DEFAULT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Comments` varchar(1000) DEFAULT NULL,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Created_by` varchar(25) DEFAULT NULL,
  `SafetyCert` int(11) NOT NULL,
  `RequiredBy` int(11) NOT NULL,
  `DueDate` date DEFAULT NULL,
  `ClosureComments` varchar(1000) DEFAULT NULL,
  `Pics` int(11) DEFAULT NULL,
  `Repo` int(11) NOT NULL,
  PRIMARY KEY (`DefID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CDL`
--

LOCK TABLES `CDL` WRITE;
/*!40000 ALTER TABLE `CDL` DISABLE KEYS */;
INSERT INTO `CDL` VALUES (1,'',3,'gfig',2,'ljhgljhglkjhg',0,'2018-03-22',1,'hjkgjhg',10,14,'',0,'',NULL,'2018-03-22 15:51:38','',NULL,'rburns',0,1,'2018-03-22','',NULL,0);
/*!40000 ALTER TABLE `CDL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EvidenceType`
--

DROP TABLE IF EXISTS `EvidenceType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EvidenceType` (
  `EviTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `EviType` varchar(25) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`EviTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EvidenceType`
--

LOCK TABLES `EvidenceType` WRITE;
/*!40000 ALTER TABLE `EvidenceType` DISABLE KEYS */;
INSERT INTO `EvidenceType` VALUES (1,'Duplicate Item','2018-03-05 19:25:46','rburns'),(2,'Photograph','2018-03-05 19:26:12','rburns'),(3,'Test Results','2018-03-05 19:26:26','rburns'),(4,'Letter','2018-03-05 19:26:14','rburns'),(5,'Request For Information','2018-03-06 16:41:13','rburns'),(6,'Clarification in Comments','2018-03-05 19:26:17','rburns'),(8,'Change Request','2018-03-06 01:17:47','rburns');
/*!40000 ALTER TABLE `EvidenceType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(255) NOT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (1,'Milpitas Station','2018-03-05 04:43:36','rburns'),(2,'Berryessa Station','2018-03-14 00:44:28','rburns'),(3,'Project Test Center','2018-03-05 04:43:08','rburns'),(5,'SWA','2018-03-06 20:22:49','rburns'),(6,'SKR','2018-03-06 20:22:56','rburns'),(7,'SRR','2018-03-06 20:23:03','rburns'),(8,'SME','2018-03-06 20:23:11','rburns'),(9,'SHO','2018-03-06 20:23:17','rburns'),(10,'SXL','2018-03-06 20:23:24','rburns'),(11,'SBE','2018-03-06 20:23:29','rburns'),(12,'SSL','2018-03-06 20:23:38','rburns');
/*!40000 ALTER TABLE `Location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pictures`
--

DROP TABLE IF EXISTS `Pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pictures` (
  `PicID` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DefID` int(11) NOT NULL,
  `DateUploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PicID`),
  UNIQUE KEY `filename` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pictures`
--

LOCK TABLES `Pictures` WRITE;
/*!40000 ALTER TABLE `Pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Repo`
--

DROP TABLE IF EXISTS `Repo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Repo` (
  `RepoID` int(11) NOT NULL AUTO_INCREMENT,
  `Repo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`RepoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Repo`
--

LOCK TABLES `Repo` WRITE;
/*!40000 ALTER TABLE `Repo` DISABLE KEYS */;
INSERT INTO `Repo` VALUES (1,'SharePoint'),(2,'Aconex');
/*!40000 ALTER TABLE `Repo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RequiredBy`
--

DROP TABLE IF EXISTS `RequiredBy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RequiredBy` (
  `ReqByID` int(11) NOT NULL AUTO_INCREMENT,
  `RequiredBy` varchar(25) NOT NULL,
  PRIMARY KEY (`ReqByID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RequiredBy`
--

LOCK TABLES `RequiredBy` WRITE;
/*!40000 ALTER TABLE `RequiredBy` DISABLE KEYS */;
INSERT INTO `RequiredBy` VALUES (1,'SIT1'),(2,'SIT2'),(3,'SIT3'),(4,'FIT1'),(5,'FIT2'),(6,'FFT1'),(7,'FFT2'),(8,'Revenue Service');
/*!40000 ALTER TABLE `RequiredBy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Severity`
--

DROP TABLE IF EXISTS `Severity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Severity` (
  `SeverityID` int(11) NOT NULL AUTO_INCREMENT,
  `SeverityName` varchar(12) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Prority` int(11) NOT NULL,
  PRIMARY KEY (`SeverityID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Severity`
--

LOCK TABLES `Severity` WRITE;
/*!40000 ALTER TABLE `Severity` DISABLE KEYS */;
INSERT INTO `Severity` VALUES (1,'Critical','A deficiency that allows an unsafe situation to remain, or that prohibits the progress of 2 or more other systems, or that has a significant effect on cost and/or schedule.','2018-03-06 16:44:34','rburns',0),(2,'Major','A deficiency that prohibits the system or equipment from functionally operating as designed or intended.','2018-03-05 18:40:27','rburns',0),(3,'Minor','A deficiency that does not affect the designed or intended operation of a piece of equipment.  Normally used for cosmetic damage, or some labeling issues where there is no safety issue.','2018-03-06 03:28:45','rburns',0),(4,'Blocker','The project cannot move forward while this deficiency is unresolved.','2018-03-06 17:06:12','rburns',0);
/*!40000 ALTER TABLE `Severity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Specs`
--

DROP TABLE IF EXISTS `Specs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Specs` (
  `SpecID` int(11) NOT NULL AUTO_INCREMENT,
  `SpecCode` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`SpecID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Specs`
--

LOCK TABLES `Specs` WRITE;
/*!40000 ALTER TABLE `Specs` DISABLE KEYS */;
/*!40000 ALTER TABLE `Specs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Status`
--

DROP TABLE IF EXISTS `Status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Status` (
  `StatusID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(10) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Status`
--

LOCK TABLES `Status` WRITE;
/*!40000 ALTER TABLE `Status` DISABLE KEYS */;
INSERT INTO `Status` VALUES (1,'Open','2018-03-05 03:57:05','rburns'),(2,'Closed','2018-03-05 04:43:55','rburns'),(3,'Deleted','2018-03-06 20:55:41','rburns');
/*!40000 ALTER TABLE `Status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `System`
--

DROP TABLE IF EXISTS `System`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `System` (
  `SystemID` int(11) NOT NULL AUTO_INCREMENT,
  `System` varchar(25) NOT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Lead` int(11) NOT NULL,
  PRIMARY KEY (`SystemID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `System`
--

LOCK TABLES `System` WRITE;
/*!40000 ALTER TABLE `System` DISABLE KEYS */;
INSERT INTO `System` VALUES (1,'Electrical','2018-03-06 01:33:08','rburns',0),(2,'Mechanical','2018-03-06 01:33:12','rburns',0),(3,'SCADA','2018-03-06 01:33:16','rburns',0),(4,'Fire Protection','2018-03-06 01:33:10','rburns',0),(5,'Architectural','2018-03-06 01:33:01','rburns',0),(6,'Civil','2018-03-06 01:33:04','rburns',0),(7,'Structural','2018-03-06 01:33:18','rburns',0),(8,'Communications','2018-03-06 01:33:06','rburns',0),(9,'Public Address','2018-03-06 01:33:14','rburns',0),(10,'Conveying','2018-03-06 16:55:30','rburns',0),(11,'Construction','2018-03-06 16:57:24','rburns',0),(12,'HVAC','2018-03-06 16:59:08','rburns',0),(13,'Plumbing','2018-03-06 16:59:14','rburns',0),(14,'Traction Power','2018-03-13 16:05:26','rburns',0),(15,'Train Control','2018-03-13 16:05:41','rburns',0),(16,'Signalling','2018-03-13 21:37:27','rburns',0);
/*!40000 ALTER TABLE `System` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `YesNo`
--

DROP TABLE IF EXISTS `YesNo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `YesNo` (
  `YesNoID` int(11) NOT NULL AUTO_INCREMENT,
  `YesNo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`YesNoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `YesNo`
--

LOCK TABLES `YesNo` WRITE;
/*!40000 ALTER TABLE `YesNo` DISABLE KEYS */;
INSERT INTO `YesNo` VALUES (1,'Yes'),(2,'No');
/*!40000 ALTER TABLE `YesNo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recoveryemails_enc`
--

DROP TABLE IF EXISTS `recoveryemails_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recoveryemails_enc` (
  `ID` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `UserID` bigint(20) NOT NULL,
  `Key` varchar(32) NOT NULL,
  `expDate` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recoveryemails_enc`
--

LOCK TABLES `recoveryemails_enc` WRITE;
/*!40000 ALTER TABLE `recoveryemails_enc` DISABLE KEYS */;
INSERT INTO `recoveryemails_enc` VALUES (00000000000000000001,0,'39d874148d62f9a22faeb6d976deeca9','2018-03-11 04:26:07'),(00000000000000000002,0,'9227aa1f2eca49f6e33260365c259989','2018-03-08 05:47:02'),(00000000000000000003,0,'8f89c43ba2e215d2690a1fda66037570','2018-03-08 05:48:36'),(00000000000000000004,1,'c30d72b58909f662b72e61c6e76bb320','2018-03-08 05:53:16'),(00000000000000000005,14,'af2d3c1bdc7294bdca02dac1fc919f88','2018-03-12 07:10:57'),(00000000000000000006,14,'3bf51666a4e9321e77550d584e2f847f','2018-03-12 07:21:38'),(00000000000000000007,14,'d6442026d44ce216d2563715851bc529','2018-03-12 07:23:35'),(00000000000000000008,14,'c13a5ff5dc2757468fe935e2811afb37','2018-03-12 07:43:27'),(00000000000000000009,14,'f156725ef694b3eb70d8c83d20ab435a','2018-03-12 07:45:31'),(00000000000000000010,14,'e526ba77dad15467e56182ffef666b34','2018-03-12 07:56:50'),(00000000000000000011,14,'3081c385a963205cca540ba9567fadb1','2018-03-12 07:57:54'),(00000000000000000012,14,'af9e438b3bbf40a391bd323a640593d7','2018-03-12 07:59:59'),(00000000000000000013,14,'7c01383d64207a028e42505001339092','2018-03-12 08:01:59'),(00000000000000000014,14,'0abc6a19f1ea0c17c8e51bd04cb49cf8','2018-03-12 08:05:07'),(00000000000000000015,14,'72ff455c14422e44716f7908c2553fdb','2018-03-12 08:14:34'),(00000000000000000016,14,'7e32d295373d37e785cf0668b9f2e538','2018-03-12 08:17:50'),(00000000000000000017,14,'6516bf0e012c19596cfbc690ddf1d44a','2018-03-12 08:18:21'),(00000000000000000018,14,'9a9473e49466abbf78aee17c64f21feb','2018-03-12 08:19:20'),(00000000000000000019,14,'c0d126be4cd0ceadf49d778878d8d32d','2018-03-12 08:20:09'),(00000000000000000020,14,'0aafe58aa6a703b635a2d68514bad40c','2018-03-12 08:21:28'),(00000000000000000021,14,'39ff1cb5d15abf72bc9903be618af997','2018-03-12 16:54:56'),(00000000000000000022,14,'77cfb405085539d1a5cb1af879f90c13','2018-03-13 22:50:02');
/*!40000 ALTER TABLE `recoveryemails_enc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secQ`
--

DROP TABLE IF EXISTS `secQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secQ` (
  `SecQID` int(11) NOT NULL AUTO_INCREMENT,
  `secQ` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SecQID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secQ`
--

LOCK TABLES `secQ` WRITE;
/*!40000 ALTER TABLE `secQ` DISABLE KEYS */;
INSERT INTO `secQ` VALUES (1,'What is your mother\'s maiden name?'),(2,'What city were you born in?'),(3,'What is your favorite color?'),(4,'Which year did you graduate from High School?'),(5,'What was the name of your first boyfriend/girlfriend?'),(6,'What was your first make of car?');
/*!40000 ALTER TABLE `secQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_enc`
--

DROP TABLE IF EXISTS `users_enc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_enc` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(25) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Created_by` varchar(25) DEFAULT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `secQ` tinyint(4) NOT NULL DEFAULT '0',
  `secA` varchar(32) NOT NULL,
  `Salt` varchar(255) NOT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Company` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_enc`
--

LOCK TABLES `users_enc` WRITE;
/*!40000 ALTER TABLE `users_enc` DISABLE KEYS */;
INSERT INTO `users_enc` VALUES (1,'rburns','S','$2y$10$ZWVlMGM3NWUyZmUxZWVmZOLNRoZkKU4h4P3aoRuWWcgOVr7.a5EPq','Robert','Burns','2018-03-26 22:19:54','rburns','2018-03-09 19:48:51','rburns1','robert.burns@vta.org',6,'metro','','2018-03-26 22:19:54',''),(2,'Admin','V','$2y$10$ZKJsg9w9RHzM2CzgiA0LL.3RB9WtRw0caBH1xnT.GO95/NwLxuc.a','Admin','Admin','2018-03-26 22:57:45','Admin','2018-03-26 20:20:05','rburns','admin@admin.com',1,'Admin','','2018-03-26 22:57:25','Admin');
/*!40000 ALTER TABLE `users_enc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-26 23:24:39
