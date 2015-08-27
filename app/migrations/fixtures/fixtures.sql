-- MySQL dump 10.13  Distrib 5.6.21, for osx10.9 (x86_64)
--
-- Host: localhost    Database: accard_fixtures
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `accard_activity`
--

DROP TABLE IF EXISTS `accard_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityDate` date NOT NULL,
  `drugId` int(11) DEFAULT NULL,
  `prototypeId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `diagnosisId` int(11) DEFAULT NULL,
  `regimenId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C69BB645DBA88346` (`drugId`),
  KEY `IDX_C69BB6459B116E9A` (`prototypeId`),
  KEY `IDX_C69BB6458F803478` (`patientId`),
  KEY `IDX_C69BB645D0EA680C` (`diagnosisId`),
  KEY `IDX_C69BB64585CA7E31` (`regimenId`),
  CONSTRAINT `FK_C69BB64585CA7E31` FOREIGN KEY (`regimenId`) REFERENCES `accard_regimen` (`id`),
  CONSTRAINT `FK_C69BB6458F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_C69BB6459B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_activity_prototype` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C69BB645D0EA680C` FOREIGN KEY (`diagnosisId`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_C69BB645DBA88346` FOREIGN KEY (`drugId`) REFERENCES `accard_drug` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity`
--

LOCK TABLES `accard_activity` WRITE;
/*!40000 ALTER TABLE `accard_activity` DISABLE KEYS */;
INSERT INTO `accard_activity` VALUES (1,'2012-04-18',NULL,1,1,NULL,NULL),(2,'2012-06-15',NULL,1,1,1,NULL),(3,'2012-09-30',NULL,2,1,1,NULL),(4,'2012-10-03',NULL,2,1,1,NULL),(5,'2012-10-03',NULL,3,1,1,NULL),(6,'2012-10-14',NULL,3,1,1,NULL),(7,'2012-11-15',NULL,3,1,1,NULL),(8,'2012-11-16',NULL,2,1,1,NULL);
/*!40000 ALTER TABLE `accard_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_activity_proto_fld`
--

DROP TABLE IF EXISTS `accard_activity_proto_fld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity_proto_fld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81052DA55E237E06` (`name`),
  KEY `IDX_81052DA5CE78B7CC` (`optionId`),
  CONSTRAINT `FK_81052DA5CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity_proto_fld`
--

LOCK TABLES `accard_activity_proto_fld` WRITE;
/*!40000 ALTER TABLE `accard_activity_proto_fld` DISABLE KEYS */;
INSERT INTO `accard_activity_proto_fld` VALUES (1,'patient-able-to-perform','Patient Able to Perform','checkbox',0,0,'numeric','a:0:{}',NULL),(2,'duration','Duration','number',0,0,'numeric','a:0:{}',NULL),(3,'stress-method','Stress Method','choice',0,0,'numeric','a:0:{}',10),(4,'stress-result','Stress Result','choice',0,0,'numeric','a:0:{}',11),(5,'comments','Comments','text',0,0,'numeric','a:0:{}',NULL),(6,'surgeon','Surgeon','choice',0,0,'numeric','a:0:{}',12),(7,'procedure','Procedure','choice',0,0,'numeric','a:0:{}',13),(8,'site','Site','choice',0,0,'alphabetical','a:0:{}',5),(9,'method','Method','choice',0,0,'numeric','a:0:{}',14),(10,'radiation-type','Radiation Type','choice',0,0,'alphabetical','a:0:{}',15),(11,'grays','Grays','number',0,0,'numeric','a:0:{}',NULL),(12,'dose','Dose','number',0,0,'numeric','a:0:{}',NULL),(13,'route','Route','choice',0,0,'numeric','a:0:{}',16);
/*!40000 ALTER TABLE `accard_activity_proto_fld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_activity_proto_fld_opt_`
--

DROP TABLE IF EXISTS `accard_activity_proto_fld_opt_`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity_proto_fld_opt_` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_359EDC7181F9A87C` (`optionValueId`),
  KEY `IDX_359EDC71E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_359EDC7181F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_activity_proto_fldval` (`id`),
  CONSTRAINT `FK_359EDC71E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity_proto_fld_opt_`
--

LOCK TABLES `accard_activity_proto_fld_opt_` WRITE;
/*!40000 ALTER TABLE `accard_activity_proto_fld_opt_` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_activity_proto_fld_opt_` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_activity_proto_fldval`
--

DROP TABLE IF EXISTS `accard_activity_proto_fldval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity_proto_fldval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `activityId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_182C8B0F81F9A87C` (`optionValueId`),
  KEY `IDX_182C8B0F1335E2FC` (`activityId`),
  KEY `IDX_182C8B0F5E697A44` (`fieldId`),
  CONSTRAINT `FK_182C8B0F1335E2FC` FOREIGN KEY (`activityId`) REFERENCES `accard_activity` (`id`),
  CONSTRAINT `FK_182C8B0F5E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_activity_proto_fld` (`id`),
  CONSTRAINT `FK_182C8B0F81F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity_proto_fldval`
--

LOCK TABLES `accard_activity_proto_fldval` WRITE;
/*!40000 ALTER TABLE `accard_activity_proto_fldval` DISABLE KEYS */;
INSERT INTO `accard_activity_proto_fldval` VALUES (1,NULL,NULL,1,NULL,1,1),(2,NULL,NULL,6,NULL,1,2),(3,NULL,NULL,NULL,62,1,3),(4,NULL,NULL,NULL,65,1,4),(5,'Patient complained of knee pain, stated he could continue without that issue.',NULL,NULL,NULL,1,5),(6,NULL,NULL,1,NULL,2,1),(7,NULL,NULL,17,NULL,2,2),(8,NULL,NULL,NULL,63,2,3),(9,NULL,NULL,NULL,67,2,4),(10,'Patient very much improved since last test.',NULL,NULL,NULL,2,5),(11,'Complications present near end due to anesthesia.',NULL,NULL,NULL,3,5),(12,NULL,NULL,NULL,69,3,6),(13,NULL,NULL,NULL,72,3,7),(14,NULL,NULL,NULL,40,3,8),(15,NULL,NULL,NULL,76,3,9),(16,'Surgery went very well.',NULL,NULL,NULL,4,5),(17,NULL,NULL,NULL,69,4,6),(18,NULL,NULL,NULL,73,4,7),(19,NULL,NULL,NULL,40,4,8),(20,NULL,NULL,NULL,75,4,9),(21,NULL,NULL,NULL,40,5,8),(22,NULL,NULL,NULL,78,5,10),(23,NULL,NULL,43,NULL,5,11),(24,NULL,NULL,NULL,40,6,8),(25,NULL,NULL,NULL,78,6,10),(26,NULL,NULL,43,NULL,6,11),(27,NULL,NULL,NULL,40,7,8),(28,NULL,NULL,NULL,78,7,10),(29,NULL,NULL,43,NULL,7,11),(30,NULL,NULL,NULL,NULL,8,5),(31,NULL,NULL,NULL,70,8,6),(32,NULL,NULL,NULL,73,8,7),(33,NULL,NULL,NULL,40,8,8),(34,NULL,NULL,NULL,76,8,9);
/*!40000 ALTER TABLE `accard_activity_proto_fldval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_activity_prototype`
--

DROP TABLE IF EXISTS `accard_activity_prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity_prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allowDrug` tinyint(1) DEFAULT NULL,
  `drugGroupId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_703C8C1CA67C4099` (`drugGroupId`),
  CONSTRAINT `FK_703C8C1CA67C4099` FOREIGN KEY (`drugGroupId`) REFERENCES `accard_drug_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity_prototype`
--

LOCK TABLES `accard_activity_prototype` WRITE;
/*!40000 ALTER TABLE `accard_activity_prototype` DISABLE KEYS */;
INSERT INTO `accard_activity_prototype` VALUES (1,'stress-test','Stress Test','field(resource, \'stress-result\') ~ \" under stress result.\"',0,NULL),(2,'generic-surgery','Generic Surgery','field(resource, \'procedure\') ~ \" of the \" ~ field(resource, \'site\') ~ \".\"',0,NULL),(3,'radiation','Radiation','field(resource, \'grays\') ~ \" gray \" ~ lower(field(resource, \'radiation-type\')) ~ \" of the \" ~ field(resource, \'site\') ~ \".\"',0,NULL),(4,'chemotherapy','Chemotherapy','(resource.getDrug() ? resource.getDrug().getPresentation() : \"\") ~ \" (\" ~ field(resource, \'dose\') ~  \"mg)\"',1,1);
/*!40000 ALTER TABLE `accard_activity_prototype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_activity_prototype_map`
--

DROP TABLE IF EXISTS `accard_activity_prototype_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_activity_prototype_map` (
  `prototypeId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`prototypeId`,`subjectId`),
  KEY `IDX_FD0B1419B116E9A` (`prototypeId`),
  KEY `IDX_FD0B1413E0C34EB` (`subjectId`),
  CONSTRAINT `FK_FD0B1413E0C34EB` FOREIGN KEY (`subjectId`) REFERENCES `accard_activity_proto_fld` (`id`),
  CONSTRAINT `FK_FD0B1419B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_activity_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_activity_prototype_map`
--

LOCK TABLES `accard_activity_prototype_map` WRITE;
/*!40000 ALTER TABLE `accard_activity_prototype_map` DISABLE KEYS */;
INSERT INTO `accard_activity_prototype_map` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,5),(2,6),(2,7),(2,8),(2,9),(3,8),(3,10),(3,11),(4,12),(4,13);
/*!40000 ALTER TABLE `accard_activity_prototype_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attr_proto_fld`
--

DROP TABLE IF EXISTS `accard_attr_proto_fld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attr_proto_fld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6C2852165E237E06` (`name`),
  KEY `IDX_6C285216CE78B7CC` (`optionId`),
  CONSTRAINT `FK_6C285216CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attr_proto_fld`
--

LOCK TABLES `accard_attr_proto_fld` WRITE;
/*!40000 ALTER TABLE `accard_attr_proto_fld` DISABLE KEYS */;
INSERT INTO `accard_attr_proto_fld` VALUES (1,'symptom-location','Symptom Location','choice',0,0,'numeric','a:0:{}',5),(2,'symptom-severity','Symptom Severity','choice',0,0,'numeric','a:0:{}',6),(3,'family-member','Family Member','choice',0,0,'numeric','a:0:{}',7),(4,'side-of-family','Side of Family','choice',0,0,'numeric','a:0:{}',8),(5,'diseases','Diseases','choice',1,1,'numeric','a:0:{}',9),(6,'comments','Comments','text',0,0,'numeric','a:0:{}',NULL);
/*!40000 ALTER TABLE `accard_attr_proto_fld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attr_proto_fld_opt_map`
--

DROP TABLE IF EXISTS `accard_attr_proto_fld_opt_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attr_proto_fld_opt_map` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_D58BF8B981F9A87C` (`optionValueId`),
  KEY `IDX_D58BF8B9E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_D58BF8B981F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_attr_proto_fldval` (`id`),
  CONSTRAINT `FK_D58BF8B9E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attr_proto_fld_opt_map`
--

LOCK TABLES `accard_attr_proto_fld_opt_map` WRITE;
/*!40000 ALTER TABLE `accard_attr_proto_fld_opt_map` DISABLE KEYS */;
INSERT INTO `accard_attr_proto_fld_opt_map` VALUES (6,59),(6,61),(10,60);
/*!40000 ALTER TABLE `accard_attr_proto_fld_opt_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attr_proto_fldval`
--

DROP TABLE IF EXISTS `accard_attr_proto_fldval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attr_proto_fldval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `attributeId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_324CF2E781F9A87C` (`optionValueId`),
  KEY `IDX_324CF2E7ED407E17` (`attributeId`),
  KEY `IDX_324CF2E75E697A44` (`fieldId`),
  CONSTRAINT `FK_324CF2E75E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_attr_proto_fld` (`id`),
  CONSTRAINT `FK_324CF2E781F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`),
  CONSTRAINT `FK_324CF2E7ED407E17` FOREIGN KEY (`attributeId`) REFERENCES `accard_attribute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attr_proto_fldval`
--

LOCK TABLES `accard_attr_proto_fldval` WRITE;
/*!40000 ALTER TABLE `accard_attr_proto_fldval` DISABLE KEYS */;
INSERT INTO `accard_attr_proto_fldval` VALUES (2,NULL,NULL,NULL,47,1,2),(3,NULL,NULL,NULL,41,1,1),(4,NULL,NULL,NULL,53,2,3),(5,NULL,NULL,NULL,58,2,4),(6,NULL,NULL,NULL,NULL,2,5),(7,NULL,NULL,NULL,NULL,2,6),(8,NULL,NULL,NULL,55,3,3),(9,NULL,NULL,NULL,57,3,4),(10,NULL,NULL,NULL,NULL,3,5),(11,NULL,NULL,NULL,NULL,3,6);
/*!40000 ALTER TABLE `accard_attr_proto_fldval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attribute`
--

DROP TABLE IF EXISTS `accard_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prototypeId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77180DB19B116E9A` (`prototypeId`),
  KEY `IDX_77180DB18F803478` (`patientId`),
  CONSTRAINT `FK_77180DB18F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_77180DB19B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_attribute_prototype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attribute`
--

LOCK TABLES `accard_attribute` WRITE;
/*!40000 ALTER TABLE `accard_attribute` DISABLE KEYS */;
INSERT INTO `accard_attribute` VALUES (1,1,1),(2,2,1),(3,2,1);
/*!40000 ALTER TABLE `accard_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attribute_prototype`
--

DROP TABLE IF EXISTS `accard_attribute_prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attribute_prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attribute_prototype`
--

LOCK TABLES `accard_attribute_prototype` WRITE;
/*!40000 ALTER TABLE `accard_attribute_prototype` DISABLE KEYS */;
INSERT INTO `accard_attribute_prototype` VALUES (1,'entrance-questionaire','Entrance Questionaire','field(resource, \'symptom-severity\') ~ \" \" ~ field(resource, \'symptom-location\') ~ \" pain.\"'),(2,'family-medical-history','Family Medical History','field(resource, \'side-of-family\') ~ \" \" ~ lower(field(resource, \'family-member\')) ~ \"\'s medical history.\"');
/*!40000 ALTER TABLE `accard_attribute_prototype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_attribute_prototype_map`
--

DROP TABLE IF EXISTS `accard_attribute_prototype_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_attribute_prototype_map` (
  `prototypeId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`prototypeId`,`subjectId`),
  KEY `IDX_B6E609359B116E9A` (`prototypeId`),
  KEY `IDX_B6E609353E0C34EB` (`subjectId`),
  CONSTRAINT `FK_B6E609353E0C34EB` FOREIGN KEY (`subjectId`) REFERENCES `accard_attr_proto_fld` (`id`),
  CONSTRAINT `FK_B6E609359B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_attribute_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_attribute_prototype_map`
--

LOCK TABLES `accard_attribute_prototype_map` WRITE;
/*!40000 ALTER TABLE `accard_attribute_prototype_map` DISABLE KEYS */;
INSERT INTO `accard_attribute_prototype_map` VALUES (1,1),(1,2),(2,3),(2,4),(2,5),(2,6);
/*!40000 ALTER TABLE `accard_attribute_prototype_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_behavior`
--

DROP TABLE IF EXISTS `accard_behavior`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_behavior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `prototypeId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_51441FAF9B116E9A` (`prototypeId`),
  KEY `IDX_51441FAF8F803478` (`patientId`),
  CONSTRAINT `FK_51441FAF8F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_51441FAF9B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_behavior_prototype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_behavior`
--

LOCK TABLES `accard_behavior` WRITE;
/*!40000 ALTER TABLE `accard_behavior` DISABLE KEYS */;
INSERT INTO `accard_behavior` VALUES (1,'1989-02-15 00:00:00','1994-08-12 00:00:00',1,1),(2,'1994-09-22 00:00:00',NULL,1,1),(3,'1994-04-01 00:00:00','1994-09-02 00:00:00',2,1);
/*!40000 ALTER TABLE `accard_behavior` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_behavior_prototype`
--

DROP TABLE IF EXISTS `accard_behavior_prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_behavior_prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_behavior_prototype`
--

LOCK TABLES `accard_behavior_prototype` WRITE;
/*!40000 ALTER TABLE `accard_behavior_prototype` DISABLE KEYS */;
INSERT INTO `accard_behavior_prototype` VALUES (1,'occupation','Occupation','\"Worked in \" ~ resource.getFieldByName(\'industry\').getValue() ~ \" industry.\"'),(2,'drug-use','Drug Use','\"Used drugs \" ~ resource.getFieldByName(\'frequency\').getValue() ~ \".\"');
/*!40000 ALTER TABLE `accard_behavior_prototype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_behavior_prototype_map`
--

DROP TABLE IF EXISTS `accard_behavior_prototype_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_behavior_prototype_map` (
  `prototypeId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`prototypeId`,`subjectId`),
  KEY `IDX_98CC21519B116E9A` (`prototypeId`),
  KEY `IDX_98CC21513E0C34EB` (`subjectId`),
  CONSTRAINT `FK_98CC21513E0C34EB` FOREIGN KEY (`subjectId`) REFERENCES `accard_bhvr_proto_fld` (`id`),
  CONSTRAINT `FK_98CC21519B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_behavior_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_behavior_prototype_map`
--

LOCK TABLES `accard_behavior_prototype_map` WRITE;
/*!40000 ALTER TABLE `accard_behavior_prototype_map` DISABLE KEYS */;
INSERT INTO `accard_behavior_prototype_map` VALUES (1,1),(1,2),(2,3),(2,4);
/*!40000 ALTER TABLE `accard_behavior_prototype_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_bhvr_proto_fld`
--

DROP TABLE IF EXISTS `accard_bhvr_proto_fld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_bhvr_proto_fld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D2CFF6735E237E06` (`name`),
  KEY `IDX_D2CFF673CE78B7CC` (`optionId`),
  CONSTRAINT `FK_D2CFF673CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_bhvr_proto_fld`
--

LOCK TABLES `accard_bhvr_proto_fld` WRITE;
/*!40000 ALTER TABLE `accard_bhvr_proto_fld` DISABLE KEYS */;
INSERT INTO `accard_bhvr_proto_fld` VALUES (1,'industry','Industry','choice',0,0,'numeric','a:0:{}',2),(2,'handled-hazardous-materials','Handled Hazardous Materials','checkbox',0,0,'numeric','a:0:{}',NULL),(3,'drug-type','Drug Type','choice',1,0,'numeric','a:0:{}',3),(4,'frequency','Frequency','choice',0,0,'numeric','a:0:{}',4);
/*!40000 ALTER TABLE `accard_bhvr_proto_fld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_bhvr_proto_fld_opt_map`
--

DROP TABLE IF EXISTS `accard_bhvr_proto_fld_opt_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_bhvr_proto_fld_opt_map` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_5AD23C5481F9A87C` (`optionValueId`),
  KEY `IDX_5AD23C54E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_5AD23C5481F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_bhvr_proto_fldval` (`id`),
  CONSTRAINT `FK_5AD23C54E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_bhvr_proto_fld_opt_map`
--

LOCK TABLES `accard_bhvr_proto_fld_opt_map` WRITE;
/*!40000 ALTER TABLE `accard_bhvr_proto_fld_opt_map` DISABLE KEYS */;
INSERT INTO `accard_bhvr_proto_fld_opt_map` VALUES (5,23),(5,27);
/*!40000 ALTER TABLE `accard_bhvr_proto_fld_opt_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_bhvr_proto_fldval`
--

DROP TABLE IF EXISTS `accard_bhvr_proto_fldval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_bhvr_proto_fldval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `behaviorId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8855F5A481F9A87C` (`optionValueId`),
  KEY `IDX_8855F5A418AE7509` (`behaviorId`),
  KEY `IDX_8855F5A45E697A44` (`fieldId`),
  CONSTRAINT `FK_8855F5A418AE7509` FOREIGN KEY (`behaviorId`) REFERENCES `accard_behavior` (`id`),
  CONSTRAINT `FK_8855F5A45E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_bhvr_proto_fld` (`id`),
  CONSTRAINT `FK_8855F5A481F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_bhvr_proto_fldval`
--

LOCK TABLES `accard_bhvr_proto_fldval` WRITE;
/*!40000 ALTER TABLE `accard_bhvr_proto_fldval` DISABLE KEYS */;
INSERT INTO `accard_bhvr_proto_fldval` VALUES (1,NULL,NULL,NULL,9,1,1),(2,NULL,NULL,1,NULL,1,2),(3,NULL,NULL,NULL,18,2,1),(5,NULL,NULL,NULL,NULL,3,3),(6,NULL,NULL,NULL,36,3,4),(7,NULL,NULL,NULL,NULL,2,2);
/*!40000 ALTER TABLE `accard_bhvr_proto_fldval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis`
--

DROP TABLE IF EXISTS `accard_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `codeId` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `primaryId` int(11) DEFAULT NULL,
  `patientId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F3B3ED77B5FC0459` (`codeId`),
  KEY `IDX_F3B3ED7710EE4CEE` (`parentId`),
  KEY `IDX_F3B3ED777BB601C` (`primaryId`),
  KEY `IDX_F3B3ED778F803478` (`patientId`),
  CONSTRAINT `FK_F3B3ED7710EE4CEE` FOREIGN KEY (`parentId`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_F3B3ED777BB601C` FOREIGN KEY (`primaryId`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_F3B3ED778F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_F3B3ED77B5FC0459` FOREIGN KEY (`codeId`) REFERENCES `accard_diagnosis_code` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis`
--

LOCK TABLES `accard_diagnosis` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis` DISABLE KEYS */;
INSERT INTO `accard_diagnosis` VALUES (1,'2012-04-22 00:00:00','2013-07-18 00:00:00',1,NULL,NULL,1);
/*!40000 ALTER TABLE `accard_diagnosis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_code`
--

DROP TABLE IF EXISTS `accard_diagnosis_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BD5E178E77153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_code`
--

LOCK TABLES `accard_diagnosis_code` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_code` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_code` VALUES (1,'one','Diagnosis One'),(2,'two','Diagnosis Two');
/*!40000 ALTER TABLE `accard_diagnosis_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_code_group`
--

DROP TABLE IF EXISTS `accard_diagnosis_code_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_code_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F7D683B15E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_code_group`
--

LOCK TABLES `accard_diagnosis_code_group` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_code_group` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_code_group` VALUES (1,'main','Main');
/*!40000 ALTER TABLE `accard_diagnosis_code_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_codes_groups`
--

DROP TABLE IF EXISTS `accard_diagnosis_codes_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_codes_groups` (
  `codeId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  PRIMARY KEY (`codeId`,`groupId`),
  KEY `IDX_E9D4D81DB5FC0459` (`codeId`),
  KEY `IDX_E9D4D81DED8188B0` (`groupId`),
  CONSTRAINT `FK_E9D4D81DB5FC0459` FOREIGN KEY (`codeId`) REFERENCES `accard_diagnosis_code` (`id`),
  CONSTRAINT `FK_E9D4D81DED8188B0` FOREIGN KEY (`groupId`) REFERENCES `accard_diagnosis_code_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_codes_groups`
--

LOCK TABLES `accard_diagnosis_codes_groups` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_codes_groups` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_codes_groups` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `accard_diagnosis_codes_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_field`
--

DROP TABLE IF EXISTS `accard_diagnosis_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_AFEBBB2E5E237E06` (`name`),
  KEY `IDX_AFEBBB2ECE78B7CC` (`optionId`),
  CONSTRAINT `FK_AFEBBB2ECE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_field`
--

LOCK TABLES `accard_diagnosis_field` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_field` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_field` VALUES (1,'diagnosed-elsewhere','Diagnosed Elsewhere','checkbox',0,0,'numeric','a:0:{}',NULL);
/*!40000 ALTER TABLE `accard_diagnosis_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_field_value`
--

DROP TABLE IF EXISTS `accard_diagnosis_field_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `diagnosisId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1EA4358F81F9A87C` (`optionValueId`),
  KEY `IDX_1EA4358FD0EA680C` (`diagnosisId`),
  KEY `IDX_1EA4358F5E697A44` (`fieldId`),
  CONSTRAINT `FK_1EA4358F5E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_diagnosis_field` (`id`),
  CONSTRAINT `FK_1EA4358F81F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`),
  CONSTRAINT `FK_1EA4358FD0EA680C` FOREIGN KEY (`diagnosisId`) REFERENCES `accard_diagnosis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_field_value`
--

LOCK TABLES `accard_diagnosis_field_value` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_field_value` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_field_value` VALUES (1,NULL,NULL,1,NULL,1,1);
/*!40000 ALTER TABLE `accard_diagnosis_field_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_fld_opt_map`
--

DROP TABLE IF EXISTS `accard_diagnosis_fld_opt_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_fld_opt_map` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_38CCD87481F9A87C` (`optionValueId`),
  KEY `IDX_38CCD874E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_38CCD87481F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_diagnosis_field_value` (`id`),
  CONSTRAINT `FK_38CCD874E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_fld_opt_map`
--

LOCK TABLES `accard_diagnosis_fld_opt_map` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_fld_opt_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_diagnosis_fld_opt_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_phase`
--

DROP TABLE IF EXISTS `accard_diagnosis_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_phase`
--

LOCK TABLES `accard_diagnosis_phase` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_phase` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_phase` VALUES (1,'discovery','Discovery',1),(2,'diagnosed','Diagnosed',2),(3,'in-treatment','In Treatment',3),(4,'post-treatment','Post Treatment',4),(5,'cured','Cured',5);
/*!40000 ALTER TABLE `accard_diagnosis_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_diagnosis_phase_inst`
--

DROP TABLE IF EXISTS `accard_diagnosis_phase_inst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_diagnosis_phase_inst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F09D7DB9158E0B66` (`target_id`),
  KEY `IDX_F09D7DB999091188` (`phase_id`),
  CONSTRAINT `FK_F09D7DB9158E0B66` FOREIGN KEY (`target_id`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_F09D7DB999091188` FOREIGN KEY (`phase_id`) REFERENCES `accard_diagnosis_phase` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_diagnosis_phase_inst`
--

LOCK TABLES `accard_diagnosis_phase_inst` WRITE;
/*!40000 ALTER TABLE `accard_diagnosis_phase_inst` DISABLE KEYS */;
INSERT INTO `accard_diagnosis_phase_inst` VALUES (1,1,1,'2012-04-06 00:00:00','2012-05-12 00:00:00'),(2,1,3,'2012-04-22 00:00:00','2013-07-14 00:00:00'),(3,1,4,'2013-07-12 00:00:00',NULL);
/*!40000 ALTER TABLE `accard_diagnosis_phase_inst` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_drug`
--

DROP TABLE IF EXISTS `accard_drug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genericId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_89DC2B555E237E06` (`name`),
  KEY `IDX_89DC2B552179D01F` (`genericId`),
  CONSTRAINT `FK_89DC2B552179D01F` FOREIGN KEY (`genericId`) REFERENCES `accard_drug` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_drug`
--

LOCK TABLES `accard_drug` WRITE;
/*!40000 ALTER TABLE `accard_drug` DISABLE KEYS */;
INSERT INTO `accard_drug` VALUES (1,'chemotherapy-1','Chemotherapy 1',NULL),(2,'chemotherapy-2','Chemotherapy 2',NULL),(3,'chemotherapy-3','Chemotherapy 3',NULL);
/*!40000 ALTER TABLE `accard_drug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_drug_group`
--

DROP TABLE IF EXISTS `accard_drug_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_drug_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8FCC09265E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_drug_group`
--

LOCK TABLES `accard_drug_group` WRITE;
/*!40000 ALTER TABLE `accard_drug_group` DISABLE KEYS */;
INSERT INTO `accard_drug_group` VALUES (1,'chemotherapy-drugs','Chemotherapy Drugs');
/*!40000 ALTER TABLE `accard_drug_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_drugs_groups`
--

DROP TABLE IF EXISTS `accard_drugs_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_drugs_groups` (
  `groupId` int(11) NOT NULL,
  `drugId` int(11) NOT NULL,
  PRIMARY KEY (`groupId`,`drugId`),
  KEY `IDX_DAB9D6E4ED8188B0` (`groupId`),
  KEY `IDX_DAB9D6E4DBA88346` (`drugId`),
  CONSTRAINT `FK_DAB9D6E4DBA88346` FOREIGN KEY (`drugId`) REFERENCES `accard_drug` (`id`),
  CONSTRAINT `FK_DAB9D6E4ED8188B0` FOREIGN KEY (`groupId`) REFERENCES `accard_drug_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_drugs_groups`
--

LOCK TABLES `accard_drugs_groups` WRITE;
/*!40000 ALTER TABLE `accard_drugs_groups` DISABLE KEYS */;
INSERT INTO `accard_drugs_groups` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `accard_drugs_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_import`
--

DROP TABLE IF EXISTS `accard_import`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `startTimestamp` decimal(13,3) NOT NULL,
  `endTimestamp` decimal(13,3) NOT NULL,
  `importer` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `criteria` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_import`
--

LOCK TABLES `accard_import` WRITE;
/*!40000 ALTER TABLE `accard_import` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_import` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_import_activity`
--

DROP TABLE IF EXISTS `accard_import_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_import_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityDate` date NOT NULL,
  `descriptions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `status` int(11) NOT NULL,
  `drugId` int(11) DEFAULT NULL,
  `patientId` int(11) NOT NULL,
  `diagnosisId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_81CEBD4EDBA88346` (`drugId`),
  KEY `IDX_81CEBD4E8F803478` (`patientId`),
  KEY `IDX_81CEBD4ED0EA680C` (`diagnosisId`),
  CONSTRAINT `FK_81CEBD4E8F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_81CEBD4ED0EA680C` FOREIGN KEY (`diagnosisId`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_81CEBD4EDBA88346` FOREIGN KEY (`drugId`) REFERENCES `accard_drug` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_import_activity`
--

LOCK TABLES `accard_import_activity` WRITE;
/*!40000 ALTER TABLE `accard_import_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_import_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_import_patient`
--

DROP TABLE IF EXISTS `accard_import_patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_import_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mrn` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfBirth` datetime NOT NULL,
  `dateOfDeath` datetime DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `race` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A2814E1484DD64A` (`mrn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_import_patient`
--

LOCK TABLES `accard_import_patient` WRITE;
/*!40000 ALTER TABLE `accard_import_patient` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_import_patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_import_sample`
--

DROP TABLE IF EXISTS `accard_import_sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_import_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `descriptions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `status` int(11) NOT NULL,
  `sourceId` int(11) DEFAULT NULL,
  `patientId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_173786F4EE155AE0` (`sourceId`),
  KEY `IDX_173786F48F803478` (`patientId`),
  CONSTRAINT `FK_173786F48F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_173786F4EE155AE0` FOREIGN KEY (`sourceId`) REFERENCES `accard_sample_source` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_import_sample`
--

LOCK TABLES `accard_import_sample` WRITE;
/*!40000 ALTER TABLE `accard_import_sample` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_import_sample` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dag_log`
--

DROP TABLE IF EXISTS `dag_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dag_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logDate` datetime NOT NULL,
  `action` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `resourceName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `resourceId` int(11) DEFAULT NULL,
  `route` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uriAttributes` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  `uriQuery` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  `uriRequest` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2AC893464B64DCC` (`userId`),
  CONSTRAINT `FK_2AC893464B64DCC` FOREIGN KEY (`userId`) REFERENCES `dag_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=593 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dag_log`
--

LOCK TABLES `dag_log` WRITE;
/*!40000 ALTER TABLE `dag_log` DISABLE KEYS */;
INSERT INTO `dag_log` VALUES (1,'2015-06-25 08:26:12','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(2,'2015-06-25 08:28:46','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(3,'2015-06-25 08:28:50','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(4,'2015-06-25 08:29:46','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Eye Color\",\"name\":\"eye-color\",\"values\":[{\"value\":\"Black\"},{\"value\":\"Blue\"},{\"value\":\"Brown\"},{\"value\":\"Hazel\"},{\"value\":\"Green\"},{\"value\":\"Other\"}]}}',76165519),(5,'2015-06-25 08:29:46','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"1\"}',NULL,76165519),(6,'2015-06-25 08:29:52','new','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,NULL,76165519),(7,'2015-06-25 08:30:05','new','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,NULL,76165519),(8,'2015-06-25 08:30:18','create','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,'{\"accard_patient_field\":{\"_token\":\"bUVpYbqXl1azK3fwgED-sPWXnCeV3BxhP8rCOp8Frqc\",\"presentation\":\"Eye Color\",\"name\":\"eye-color\",\"type\":\"choice\",\"option\":\"1\"}}',76165519),(9,'2015-06-25 08:30:23','new','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,NULL,76165519),(10,'2015-06-25 08:30:33','create','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,'{\"accard_patient_field\":{\"_token\":\"bUVpYbqXl1azK3fwgED-sPWXnCeV3BxhP8rCOp8Frqc\",\"presentation\":\"Last Contact Date\",\"name\":\"last-contact-date\",\"type\":\"date\",\"option\":\"\"}}',76165519),(11,'2015-06-25 08:30:56','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(12,'2015-06-25 08:31:03','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(13,'2015-06-25 08:31:03','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(14,'2015-06-25 08:35:12','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,NULL,NULL,76165519),(15,'2015-06-25 08:35:15','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(16,'2015-06-25 08:35:26','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Screening\",\"label\":\"screening\",\"order\":\"1\"}}',76165519),(17,'2015-06-25 08:35:27','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"1\"}',NULL,76165519),(18,'2015-06-25 08:35:30','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(19,'2015-06-25 08:35:41','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Consented\",\"label\":\"consented\",\"order\":\"2\"}}',76165519),(20,'2015-06-25 08:35:42','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"2\"}',NULL,76165519),(21,'2015-06-25 08:35:44','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(22,'2015-06-25 08:35:59','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Treatment\",\"label\":\"treatment\",\"order\":\"3\"}}',76165519),(23,'2015-06-25 08:36:00','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"3\"}',NULL,76165519),(24,'2015-06-25 08:36:01','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(25,'2015-06-25 08:36:10','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Post Treatment\",\"label\":\"post-treatment\",\"order\":\"4\"}}',76165519),(26,'2015-06-25 08:36:10','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"4\"}',NULL,76165519),(27,'2015-06-25 08:36:14','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(28,'2015-06-25 08:36:25','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Follow Up\",\"label\":\"follow-up\",\"order\":\"5\"}}',76165519),(29,'2015-06-25 08:36:26','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"5\"}',NULL,76165519),(30,'2015-06-25 08:36:29','new','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,NULL,76165519),(31,'2015-06-25 08:36:36','create','patient_phase',NULL,'accard_backend_patient_phase_create',NULL,NULL,'{\"accard_patient_phase\":{\"_token\":\"sZGNQjHi7J078aAnwj9eyKspYkltceL4PmIPsI0i2po\",\"presentation\":\"Archived\",\"label\":\"archived\",\"order\":\"6\"}}',76165519),(32,'2015-06-25 08:36:36','index','patient_phase',NULL,'accard_backend_patient_phase_index',NULL,'{\"id\":\"6\"}',NULL,76165519),(33,'2015-06-25 08:36:51','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(34,'2015-06-25 08:40:00','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(35,'2015-06-25 08:40:00','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(36,'2015-06-25 08:54:27','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(37,'2015-06-25 08:55:00','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(38,'2015-06-25 08:55:01','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(39,'2015-06-25 08:56:39','new','diagnosis_code_group',NULL,'accard_backend_diagnosis_code_group_create',NULL,NULL,NULL,76165519),(40,'2015-06-25 08:56:51','create','diagnosis_code_group',NULL,'accard_backend_diagnosis_code_group_create',NULL,NULL,'{\"accard_diagnosis_code_group\":{\"_token\":\"XLkoJZXYQQahVxiiG5FkEs39V0-WqqeFLjeqUn16Bxg\",\"name\":\"main\",\"presentation\":\"Main\"}}',76165519),(41,'2015-06-25 08:56:57','new','diagnosis_code',NULL,'accard_backend_diagnosis_code_create',NULL,NULL,NULL,76165519),(42,'2015-06-25 08:57:11','create','diagnosis_code',NULL,'accard_backend_diagnosis_code_create',NULL,NULL,'{\"accard_diagnosis_code\":{\"_token\":\"RUZSuhg1zjj25ls4XH-pxjoRjQMOogfVPwSCwljCZx8\",\"code\":\"pri\",\"description\":\"Primary Diagnosis\"}}',76165519),(43,'2015-06-25 08:57:37','new','diagnosis_code',NULL,'accard_backend_diagnosis_code_create',NULL,NULL,NULL,76165519),(44,'2015-06-25 08:57:47','create','diagnosis_code',NULL,'accard_backend_diagnosis_code_create',NULL,NULL,'{\"accard_diagnosis_code\":{\"_token\":\"RUZSuhg1zjj25ls4XH-pxjoRjQMOogfVPwSCwljCZx8\",\"code\":\"sec\",\"description\":\"Secondary Diagnosis\"}}',76165519),(45,'2015-06-25 09:26:50','new','diagnosis_field',NULL,'accard_backend_diagnosis_field_create',NULL,NULL,NULL,76165519),(46,'2015-06-25 09:26:59','create','diagnosis_field',NULL,'accard_backend_diagnosis_field_create',NULL,NULL,'{\"accard_diagnosis_field\":{\"_token\":\"bhwzUskOS-qHmRBs6heMDlM1v00AlBufX3W9yDt_Kws\",\"presentation\":\"Diagnosed Elsewhere\",\"name\":\"diagnosed-elsewhere\",\"type\":\"checkbox\",\"option\":\"\"}}',76165519),(47,'2015-06-25 09:28:23','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,NULL,NULL,76165519),(48,'2015-06-25 09:28:26','new','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,NULL,76165519),(49,'2015-06-25 09:28:49','create','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,'{\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"discovery\",\"order\":\"1\",\"presentation\":\"Discovery\"}}',76165519),(50,'2015-06-25 09:28:50','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"1\"}',NULL,76165519),(51,'2015-06-25 09:28:52','new','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,NULL,76165519),(52,'2015-06-25 09:29:02','create','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,'{\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"diagnosed\",\"order\":\"2\",\"presentation\":\"Diagnosed\"}}',76165519),(53,'2015-06-25 09:29:03','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"2\"}',NULL,76165519),(54,'2015-06-25 09:29:05','new','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,NULL,76165519),(55,'2015-06-25 09:29:19','create','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,'{\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"In Treatment\",\"order\":\"3\",\"presentation\":\"in-treatment\"}}',76165519),(56,'2015-06-25 09:29:20','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"3\"}',NULL,76165519),(57,'2015-06-25 09:29:27','new','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,NULL,76165519),(58,'2015-06-25 09:29:37','create','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,'{\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"post-treatment\",\"order\":\"4\",\"presentation\":\"Post Treatment\"}}',76165519),(59,'2015-06-25 09:29:37','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"4\"}',NULL,76165519),(60,'2015-06-25 09:29:40','edit','diagnosis_phase',3,'accard_backend_diagnosis_phase_update','{\"id\":\"3\"}',NULL,NULL,76165519),(61,'2015-06-25 09:29:48','update','diagnosis_phase',3,'accard_backend_diagnosis_phase_update','{\"id\":\"3\"}',NULL,'{\"_method\":\"PUT\",\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"in-treatment\",\"order\":\"3\",\"presentation\":\"In Treatment\"}}',76165519),(62,'2015-06-25 09:29:49','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"3\"}',NULL,76165519),(63,'2015-06-25 09:29:54','new','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,NULL,76165519),(64,'2015-06-25 09:30:04','create','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_create',NULL,NULL,'{\"accard_diagnosis_phase\":{\"_token\":\"MBtGq--7sVXrkqsOsUFK5jI39YKUzho2J5oTxTLG6vU\",\"label\":\"cured\",\"order\":\"5\",\"presentation\":\"Cured\"}}',76165519),(65,'2015-06-25 09:30:05','index','diagnosis_phase',NULL,'accard_backend_diagnosis_phase_index',NULL,'{\"id\":\"5\"}',NULL,76165519),(66,'2015-06-25 09:31:03','new','behavior_prototype',NULL,'accard_backend_behavior_prototype_create',NULL,NULL,NULL,76165519),(67,'2015-06-25 09:32:59','create','behavior_prototype',NULL,'accard_backend_behavior_prototype_create',NULL,NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Occupation\",\"name\":\"occupation\",\"description\":\"\\\"Occupation \\\" ~ resource.getStartDate().format(\'m\\/d\\/Y\') ~ \\\" to \\\" ~ (resource.getEndDate() ? resource.getEndDate().format(\'m\\/d\\/Y\') : \\\"current\\\")\"}}',76165519),(68,'2015-06-25 09:33:06','new','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,NULL,76165519),(69,'2015-06-25 09:33:09','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(70,'2015-06-25 09:33:53','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(71,'2015-06-25 09:39:04','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Industry\",\"name\":\"industry\",\"values\":[{\"value\":\"Automotive\"},{\"value\":\"Chemical\"},{\"value\":\"Construction\"},{\"value\":\"Energy\"},{\"value\":\"Financial\"},{\"value\":\"Healthcare\"},{\"value\":\"Industrial\"},{\"value\":\"Infrastructure\"},{\"value\":\"Metal\"},{\"value\":\"Retail\"},{\"value\":\"Technology\"},{\"value\":\"Textile\"},{\"value\":\"Transportation\"},{\"value\":\"Travel\"}]}}',76165519),(72,'2015-06-25 09:39:04','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"2\"}',NULL,76165519),(73,'2015-06-25 09:45:36','new','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,NULL,76165519),(74,'2015-06-25 09:45:56','create','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,'{\"accard_behavior_prototype_field\":{\"_token\":\"psPk9jzBI85ztfRN4g7fxeL1h5WwP3NecCSIEb6OcYc\",\"presentation\":\"Industry\",\"name\":\"industry\",\"type\":\"choice\",\"option\":\"2\"}}',76165519),(75,'2015-06-25 09:46:00','new','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,NULL,76165519),(76,'2015-06-25 09:46:19','create','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,'{\"accard_behavior_prototype_field\":{\"_token\":\"psPk9jzBI85ztfRN4g7fxeL1h5WwP3NecCSIEb6OcYc\",\"presentation\":\"Handled Hazardous Materials\",\"name\":\"handled-hazardous-materials\",\"type\":\"checkbox\",\"option\":\"\"}}',76165519),(77,'2015-06-25 09:46:24','edit','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(78,'2015-06-25 09:46:34','update','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Occupation\",\"name\":\"occupation\",\"description\":\"\\\"Occupation \\\" ~ resource.getStartDate().format(\'m\\/d\\/Y\') ~ \\\" to \\\" ~ (resource.getEndDate() ? resource.getEndDate().format(\'m\\/d\\/Y\') : \\\"current\\\")\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(79,'2015-06-25 09:51:40','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(80,'2015-06-25 09:51:43','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(81,'2015-06-25 09:51:46','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(82,'2015-06-25 09:51:47','edit','option',1,'accard_backend_option_update','{\"id\":\"1\"}',NULL,NULL,76165519),(83,'2015-06-25 09:51:51','update','option',1,'accard_backend_option_update','{\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Eye Colors\",\"name\":\"eye-colors\",\"values\":[{\"value\":\"Black\"},{\"value\":\"Blue\"},{\"value\":\"Brown\"},{\"value\":\"Hazel\"},{\"value\":\"Green\"},{\"value\":\"Other\"}]}}',76165519),(84,'2015-06-25 09:51:52','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"1\"}',NULL,76165519),(85,'2015-06-25 09:51:54','edit','option',2,'accard_backend_option_update','{\"id\":\"2\"}',NULL,NULL,76165519),(86,'2015-06-25 09:52:03','edit','option',2,'accard_backend_option_update','{\"id\":\"2\"}',NULL,NULL,76165519),(87,'2015-06-25 09:52:08','update','option',2,'accard_backend_option_update','{\"id\":\"2\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Industries\",\"name\":\"industries\",\"values\":[{\"value\":\"Automotive\"},{\"value\":\"Chemical\"},{\"value\":\"Construction\"},{\"value\":\"Energy\"},{\"value\":\"Financial\"},{\"value\":\"Healthcare\"},{\"value\":\"Industrial\"},{\"value\":\"Infrastructure\"},{\"value\":\"Metal\"},{\"value\":\"Retail\"},{\"value\":\"Technology\"},{\"value\":\"Textile\"},{\"value\":\"Transportation\"},{\"value\":\"Travel\"}]}}',76165519),(88,'2015-06-25 09:52:08','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"2\"}',NULL,76165519),(89,'2015-06-25 09:52:13','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(90,'2015-06-25 09:53:24','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Drug Types\",\"name\":\"drug-types\",\"values\":[{\"value\":\"Alcohol\"},{\"value\":\"Amphetamines\"},{\"value\":\"Cannabis\"},{\"value\":\"Cocaine\"},{\"value\":\"Crack Cocaine\"},{\"value\":\"Ecstasy\"},{\"value\":\"Heroin\"},{\"value\":\"Inhalants\"},{\"value\":\"Ketamine\"},{\"value\":\"LSD\"},{\"value\":\"Mushrooms\"},{\"value\":\"Methamphetamines\"},{\"value\":\"PCP\"}]}}',76165519),(91,'2015-06-25 09:53:24','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"3\"}',NULL,76165519),(92,'2015-06-25 09:53:26','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(93,'2015-06-25 09:54:27','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Frequencies\",\"name\":\"frequencies\",\"values\":[{\"value\":\"Hourly\"},{\"value\":\"Daily\"},{\"value\":\"Weekly\"},{\"value\":\"Bi-Weekly\"},{\"value\":\"Monthly\"},{\"value\":\"Occasionally\"}]}}',76165519),(94,'2015-06-25 09:54:28','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"4\"}',NULL,76165519),(95,'2015-06-25 09:54:39','new','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,NULL,76165519),(96,'2015-06-25 09:54:58','create','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,'{\"accard_behavior_prototype_field\":{\"_token\":\"psPk9jzBI85ztfRN4g7fxeL1h5WwP3NecCSIEb6OcYc\",\"presentation\":\"Drug Type\",\"name\":\"drug-type\",\"type\":\"choice\",\"option\":\"3\",\"allowMultiple\":\"1\"}}',76165519),(97,'2015-06-25 09:55:04','new','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,NULL,76165519),(98,'2015-06-25 09:55:13','create','behavior_prototype_field',NULL,'accard_backend_behavior_field_create',NULL,NULL,'{\"accard_behavior_prototype_field\":{\"_token\":\"psPk9jzBI85ztfRN4g7fxeL1h5WwP3NecCSIEb6OcYc\",\"presentation\":\"Frequency\",\"name\":\"frequency\",\"type\":\"choice\",\"option\":\"4\"}}',76165519),(99,'2015-06-25 09:55:19','new','behavior_prototype',NULL,'accard_backend_behavior_prototype_create',NULL,NULL,NULL,76165519),(100,'2015-06-25 09:55:46','create','behavior_prototype',NULL,'accard_backend_behavior_prototype_create',NULL,NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Drug Use\",\"name\":\"drug-use\",\"description\":\"\\\"Drug use\\\"\",\"fields\":[\"3\",\"4\"]}}',76165519),(101,'2015-06-25 09:56:12','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(102,'2015-06-25 09:56:13','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(103,'2015-06-25 10:03:25','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"nQ5VqMs7mmF4TQnlC9r6CS2De556_ryn7sLhYU6452Q\",\"mrn\":\"103495102\",\"firstName\":\"John\",\"lastName\":\"Smith\",\"gender\":\"male\",\"race\":\"white\",\"dateOfBirth\":\"1974-05-16\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"3\"},{\"value\":\"2015-04-15\"}],\"phases\":[{\"phase\":\"1\",\"startDate\":\"2012-01-13\",\"endDate\":\"2012-04-22\"},{\"phase\":\"2\",\"startDate\":\"2012-04-20\",\"endDate\":\"\"},{\"phase\":\"3\",\"startDate\":\"2012-04-26\",\"endDate\":\"2013-07-17\"},{\"phase\":\"5\",\"startDate\":\"2013-07-18\",\"endDate\":\"2014-01-01\"},{\"phase\":\"6\",\"startDate\":\"2014-01-01\",\"endDate\":\"\"}]}}',76165519),(104,'2015-06-25 10:03:27','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(105,'2015-06-25 11:06:08','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(106,'2015-06-25 11:06:08','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(107,'2015-06-25 11:06:33','edit','patient',1,'accard_frontend_patient_update','{\"id\":\"1\"}',NULL,NULL,76165519),(108,'2015-06-25 11:06:33','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(109,'2015-06-25 11:06:54','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(110,'2015-06-25 11:07:55','new','diagnosis',NULL,'accard_frontend_diagnosis_create','{\"patient\":\"1\"}',NULL,NULL,76165519),(111,'2015-06-25 11:14:55','create','diagnosis',NULL,'accard_frontend_diagnosis_create','{\"patient\":\"1\"}',NULL,'{\"accard_diagnosis\":{\"_token\":\"ZAOWwPSfRFQt-bgVEWj7i-c534CF3HHrUh-QjqEB2zw\",\"code\":\"1\",\"startDate\":\"2012-04-22\",\"endDate\":\"2013-07-18\",\"fields\":[{\"value\":\"1\"}],\"phases\":{\"0\":{\"phase\":\"1\",\"startDate\":\"2012-04-06\",\"endDate\":\"2012-05-12\"},\"2\":{\"phase\":\"3\",\"startDate\":\"2012-04-22\",\"endDate\":\"2013-07-14\"},\"3\":{\"phase\":\"4\",\"startDate\":\"2013-07-12\",\"endDate\":\"\"}}}}',76165519),(112,'2015-06-25 11:14:57','edit','diagnosis',1,'accard_frontend_diagnosis_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(113,'2015-06-25 11:15:06','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(114,'2015-06-25 11:15:16','edit','diagnosis',1,'accard_frontend_diagnosis_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(115,'2015-06-25 11:16:13','new','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"occupation\"}',NULL,76165519),(116,'2015-06-25 11:18:50','create','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"occupation\"}','{\"accard_behavior\":{\"_token\":\"Z55NS6SXsHdzTyNTEu4PaMHAAi-0_8FyoiB1cB2ybnw\",\"startDate\":\"1989-02-15\",\"endDate\":\"1994-08-12\",\"fields\":[{\"value\":\"13\"},{\"value\":\"1\"}]}}',76165519),(117,'2015-06-25 11:18:51','edit','behavior',1,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(118,'2015-06-25 11:19:33','edit','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(119,'2015-06-25 11:21:15','update','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Occupation\",\"name\":\"occupation\",\"description\":\"\\\"Worked in \\\" ~ resource.getFieldByName(\'industry\').getValue() ~ \\\" industry\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(120,'2015-06-25 11:21:21','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(121,'2015-06-25 11:21:33','edit','behavior',1,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(122,'2015-06-25 11:21:45','update','behavior',1,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_behavior\":{\"_token\":\"Z55NS6SXsHdzTyNTEu4PaMHAAi-0_8FyoiB1cB2ybnw\",\"startDate\":\"1989-02-15\",\"endDate\":\"1994-08-12\",\"fields\":[{\"value\":\"9\"},{\"value\":\"1\"}]}}',76165519),(123,'2015-06-25 11:21:45','edit','behavior',1,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(124,'2015-06-25 11:21:55','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(125,'2015-06-25 11:22:03','edit','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(126,'2015-06-25 11:22:08','update','behavior_prototype',1,'accard_backend_behavior_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Occupation\",\"name\":\"occupation\",\"description\":\"\\\"Worked in \\\" ~ resource.getFieldByName(\'industry\').getValue() ~ \\\" industry.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(127,'2015-06-25 11:23:15','new','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"occupation\"}',NULL,76165519),(128,'2015-06-25 11:23:31','create','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"occupation\"}','{\"accard_behavior\":{\"_token\":\"Z55NS6SXsHdzTyNTEu4PaMHAAi-0_8FyoiB1cB2ybnw\",\"startDate\":\"2994-09-22\",\"endDate\":\"\",\"fields\":[{\"value\":\"18\"}]}}',76165519),(129,'2015-06-25 11:23:32','edit','behavior',2,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(130,'2015-06-25 11:24:11','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(131,'2015-06-25 11:24:47','new','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"drug-use\"}',NULL,76165519),(132,'2015-06-25 11:25:09','create','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"drug-use\"}','{\"accard_behavior\":{\"_token\":\"Z55NS6SXsHdzTyNTEu4PaMHAAi-0_8FyoiB1cB2ybnw\",\"startDate\":\"1994-04-01\",\"endDate\":\"1994-09-02\",\"fields\":[{\"values\":[\"23\",\"27\"]},{\"value\":\"36\"}]}}',76165519),(133,'2015-06-25 11:25:10','edit','behavior',3,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"3\"}',NULL,NULL,76165519),(134,'2015-06-25 11:25:14','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(135,'2015-06-25 11:25:18','edit','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(136,'2015-06-25 11:26:07','update','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Drug Use\",\"name\":\"drug-use\",\"description\":\"\\\"Used drugs \\\" ~ resource.getFieldByName(\'drug-use\').getValue ~ \\\".\\\"\",\"fields\":[\"3\",\"4\"]},\"_method\":\"PUT\"}',76165519),(137,'2015-06-25 11:26:11','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(138,'2015-06-25 11:26:15','edit','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(139,'2015-06-25 11:26:32','edit','behavior',1,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(140,'2015-06-25 11:26:47','update','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Drug Use\",\"name\":\"drug-use\",\"description\":\"\\\"Used drugs \\\" ~ resource.getFieldByName(\'drug-use\').getValue() ~ \\\".\\\"\",\"fields\":[\"3\",\"4\"]},\"_method\":\"PUT\"}',76165519),(141,'2015-06-25 11:26:50','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(142,'2015-06-25 11:26:57','edit','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(143,'2015-06-25 11:27:04','edit','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(144,'2015-06-25 11:27:12','update','behavior_prototype',2,'accard_backend_behavior_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_behavior_prototype\":{\"_token\":\"ExPeXzaebfMwjphMMN4HTRwrLLIX4Q0HMzW0o-Gsswk\",\"presentation\":\"Drug Use\",\"name\":\"drug-use\",\"description\":\"\\\"Used drugs \\\" ~ resource.getFieldByName(\'frequency\').getValue() ~ \\\".\\\"\",\"fields\":[\"3\",\"4\"]},\"_method\":\"PUT\"}',76165519),(145,'2015-06-25 11:27:16','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(146,'2015-06-25 11:27:34','edit','behavior',2,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(147,'2015-06-25 11:27:42','update','behavior',2,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,'{\"_method\":\"PUT\",\"accard_behavior\":{\"_token\":\"Z55NS6SXsHdzTyNTEu4PaMHAAi-0_8FyoiB1cB2ybnw\",\"startDate\":\"1994-09-22\",\"endDate\":\"\",\"fields\":[{\"value\":\"18\"}]}}',76165519),(148,'2015-06-25 11:27:43','edit','behavior',2,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(149,'2015-06-25 11:27:48','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(150,'2015-06-25 11:35:33','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(151,'2015-06-25 11:37:29','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(152,'2015-06-25 11:38:00','new','patient_field',NULL,'accard_backend_patient_field_create',NULL,NULL,NULL,76165519),(153,'2015-06-25 11:38:37','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(154,'2015-06-25 11:38:55','edit','option',1,'accard_backend_option_update','{\"id\":\"1\"}',NULL,NULL,76165519),(155,'2015-06-25 11:39:05','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(156,'2015-06-25 11:39:11','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(157,'2015-06-25 11:39:12','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(158,'2015-06-25 11:39:33','edit','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(159,'2015-06-25 11:39:39','update','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,'{\"accard_patient_field\":{\"_token\":\"bUVpYbqXl1azK3fwgED-sPWXnCeV3BxhP8rCOp8Frqc\",\"presentation\":\"Eye Color\",\"name\":\"eye-color\",\"type\":\"choice\",\"option\":\"1\",\"allowMultiple\":\"1\"},\"_method\":\"PUT\"}',76165519),(160,'2015-06-25 11:39:46','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(161,'2015-06-25 11:39:47','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(162,'2015-06-25 11:41:56','new','attribute_prototype',NULL,'accard_backend_attribute_prototype_create',NULL,NULL,NULL,76165519),(163,'2015-06-25 11:42:52','create','attribute_prototype',NULL,'accard_backend_attribute_prototype_create',NULL,NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"\\\"Questionaire\\\" ~ resource.getId() ~ \\\" for \\\" ~ resource.getPatient().getFullName()\"}}',76165519),(164,'2015-06-25 11:43:03','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(165,'2015-06-25 11:43:23','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"My Field\",\"name\":\"my-field\",\"type\":\"checkbox\",\"option\":\"\"}}',76165519),(166,'2015-06-25 11:43:28','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(167,'2015-06-25 11:43:32','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"\\\"Questionaire\\\" ~ resource.getId() ~ \\\" for \\\" ~ resource.getPatient().getFullName()\",\"fields\":[\"1\"]},\"_method\":\"PUT\"}',76165519),(168,'2015-06-25 11:43:37','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(169,'2015-06-25 11:44:14','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(170,'2015-06-25 11:44:19','new','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"entrance-questionaire\"}',NULL,76165519),(171,'2015-06-25 11:45:55','new','behavior',NULL,'accard_frontend_behavior_create','{\"patient\":\"1\"}','{\"prototype\":\"occupation\"}',NULL,76165519),(172,'2015-06-25 12:44:50','edit','patient',1,'accard_frontend_patient_update','{\"id\":\"1\"}',NULL,NULL,76165519),(173,'2015-06-25 12:45:09','edit','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(174,'2015-06-25 12:45:13','update','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,'{\"accard_patient_field\":{\"_token\":\"bUVpYbqXl1azK3fwgED-sPWXnCeV3BxhP8rCOp8Frqc\",\"presentation\":\"Eye Color\",\"name\":\"eye-color\",\"type\":\"choice\",\"option\":\"1\"},\"_method\":\"PUT\"}',76165519),(175,'2015-06-25 12:45:27','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(176,'2015-06-25 12:45:33','edit','behavior',3,'accard_frontend_behavior_update','{\"patient\":\"1\",\"id\":\"3\"}',NULL,NULL,76165519),(177,'2015-06-25 12:47:04','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(178,'2015-06-25 12:47:34','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(179,'2015-06-25 12:48:06','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(180,'2015-06-25 12:48:54','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(181,'2015-06-25 12:49:09','edit','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(182,'2015-06-25 12:52:58','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(183,'2015-06-25 12:53:01','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(184,'2015-06-25 12:53:31','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Body Locations\",\"name\":\"body-locations\",\"values\":[{\"value\":\"Head\"},{\"value\":\"Neck\"},{\"value\":\"Shoulder\"},{\"value\":\"Chest\"},{\"value\":\"Abdomen\"}]}}',76165519),(185,'2015-06-25 12:53:32','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"5\"}',NULL,76165519),(186,'2015-06-25 12:53:39','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(187,'2015-06-25 12:54:14','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Symptom Severity\",\"name\":\"symptom-severity\",\"values\":[{\"value\":\"Not Severe\"},{\"value\":\"Severe\"},{\"value\":\"Very Severe\"},{\"value\":\"I Don\'t Know\"}]}}',76165519),(188,'2015-06-25 12:54:15','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"6\"}',NULL,76165519),(189,'2015-06-25 12:54:45','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(190,'2015-06-25 12:54:57','edit','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(191,'2015-06-25 12:55:18','update','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Symptom Severity\",\"name\":\"symptom-severity\",\"type\":\"choice\",\"option\":\"6\"},\"_method\":\"PUT\"}',76165519),(192,'2015-06-25 12:55:25','edit','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(193,'2015-06-25 12:55:38','update','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Symptom Location\",\"name\":\"symptom-location\",\"type\":\"choice\",\"option\":\"5\",\"allowMultiple\":\"1\"},\"_method\":\"PUT\"}',76165519),(194,'2015-06-25 12:55:42','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(195,'2015-06-25 12:55:46','edit','option',6,'accard_backend_option_update','{\"id\":\"6\"}',NULL,NULL,76165519),(196,'2015-06-25 12:55:51','update','option',6,'accard_backend_option_update','{\"id\":\"6\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Symptom Severities\",\"name\":\"symptom-severities\",\"values\":[{\"value\":\"Not Severe\"},{\"value\":\"Severe\"},{\"value\":\"Very Severe\"},{\"value\":\"I Don\'t Know\"}]}}',76165519),(197,'2015-06-25 12:55:52','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"6\"}',NULL,76165519),(198,'2015-06-25 12:56:14','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(199,'2015-06-25 12:56:28','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(200,'2015-06-25 12:56:41','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Symptom Severity\",\"name\":\"symptom-severity\",\"type\":\"choice\",\"option\":\"6\"}}',76165519),(201,'2015-06-25 12:56:51','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(202,'2015-06-25 12:56:56','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"\\\"Questionaire\\\" ~ resource.getId() ~ \\\" for \\\" ~ resource.getPatient().getFullName()\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(203,'2015-06-25 13:02:47','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(204,'2015-06-25 13:02:49','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(205,'2015-06-25 13:03:19','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Family Members\",\"name\":\"family-members\",\"values\":[{\"value\":\"Mother\"},{\"value\":\"Father\"},{\"value\":\"Brother\"},{\"value\":\"Sister\"},{\"value\":\"Aunt\"},{\"value\":\"Uncle\"},{\"value\":\"Grandmother\"},{\"value\":\"Grandfather\"}]}}',76165519),(206,'2015-06-25 13:03:20','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"7\"}',NULL,76165519),(207,'2015-06-25 13:03:22','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(208,'2015-06-25 13:03:36','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Family Sides\",\"name\":\"family-sides\",\"values\":[{\"value\":\"Maternal\"},{\"value\":\"Paternal\"}]}}',76165519),(209,'2015-06-25 13:03:37','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"8\"}',NULL,76165519),(210,'2015-06-25 13:03:39','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(211,'2015-06-25 13:04:09','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Relevant Diseases\",\"name\":\"relevant-diseases\",\"values\":[{\"value\":\"Diabetis\"},{\"value\":\"Heart Attack\"},{\"value\":\"High Blood Pressure\"}]}}',76165519),(212,'2015-06-25 13:04:10','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"9\"}',NULL,76165519),(213,'2015-06-25 13:04:29','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(214,'2015-06-25 13:05:14','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Family Member\",\"name\":\"family-member\",\"type\":\"choice\",\"option\":\"7\"}}',76165519),(215,'2015-06-25 13:05:18','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(216,'2015-06-25 13:05:31','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Side of Family\",\"name\":\"side-of-family\",\"type\":\"choice\",\"option\":\"8\"}}',76165519),(217,'2015-06-25 13:05:38','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(218,'2015-06-25 13:05:51','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Disease\",\"name\":\"disease\",\"type\":\"choice\",\"option\":\"9\",\"allowMultiple\":\"1\"}}',76165519),(219,'2015-06-25 13:06:17','new','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,NULL,76165519),(220,'2015-06-25 13:06:25','create','attribute_prototype_field',NULL,'accard_backend_attribute_field_create',NULL,NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Comments\",\"name\":\"comments\",\"type\":\"text\",\"option\":\"\"}}',76165519),(221,'2015-06-25 13:06:31','new','attribute_prototype',NULL,'accard_backend_attribute_prototype_create',NULL,NULL,NULL,76165519),(222,'2015-06-25 13:08:07','create','attribute_prototype',NULL,'accard_backend_attribute_prototype_create',NULL,NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"resource.getFieldByName(\'side of family\') ~ \\\"\'s \\\" ~ resource.getFieldByName(\'family-member\') ~ \\\" medical history.\\\"\",\"fields\":[\"4\",\"3\",\"5\",\"6\"]}}',76165519),(223,'2015-06-25 13:08:12','edit','attribute_prototype_field',5,'accard_backend_attribute_field_update','{\"id\":\"5\"}',NULL,NULL,76165519),(224,'2015-06-25 13:08:22','update','attribute_prototype_field',5,'accard_backend_attribute_field_update','{\"id\":\"5\"}',NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Diseases\",\"name\":\"diseases\",\"type\":\"choice\",\"option\":\"9\",\"allowMultiple\":\"1\"},\"_method\":\"PUT\"}',76165519),(225,'2015-06-25 13:09:10','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(226,'2015-06-25 13:09:17','update','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"resource.getFieldByName(\'side of family\') ~ \\\"\'s \\\" ~ resource.getFieldByName(\'family-member\') ~ \\\" medical history.\\\"\",\"fields\":[\"4\",\"3\",\"5\",\"6\"]},\"_method\":\"PUT\"}',76165519),(227,'2015-06-25 13:09:22','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(228,'2015-06-25 13:09:37','update','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"resource.getFieldByName(\'side of family\') ~ \\\"\'s \\\" ~ resource.getFieldByName(\'family-member\') ~ \\\" medical history.\\\"\"},\"_method\":\"PUT\"}',76165519),(229,'2015-06-25 13:09:39','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(230,'2015-06-25 13:09:52','update','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"resource.getFieldByName(\'side of family\') ~ \\\"\'s \\\" ~ resource.getFieldByName(\'family-member\') ~ \\\" medical history.\\\"\",\"fields\":[\"4\",\"3\",\"5\",\"6\"]},\"_method\":\"PUT\"}',76165519),(231,'2015-06-25 13:10:11','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(232,'2015-06-25 13:10:49','new','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"family-medical-history\"}',NULL,76165519),(233,'2015-06-25 13:11:24','new','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"entrance-questionaire\"}',NULL,76165519),(234,'2015-06-25 13:11:58','create','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"entrance-questionaire\"}','{\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"values\":[\"40\",\"41\"]},{\"value\":\"47\"}]}}',76165519),(235,'2015-06-25 13:11:59','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(236,'2015-06-25 13:12:08','update','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"values\":[\"40\",\"41\"]},{\"value\":\"47\"}]}}',76165519),(237,'2015-06-25 13:12:09','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(238,'2015-06-25 13:12:34','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(239,'2015-06-25 13:13:41','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"resource.getFieldByName(\'symptom-severity\') ~ \\\" \\\" ~ join(resource.getFieldByName(\'symptom-location\').getValues()) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(240,'2015-06-25 13:13:47','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(241,'2015-06-25 13:13:51','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(242,'2015-06-25 13:14:49','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(243,'2015-06-25 13:15:08','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"resource.getFieldByName(\'symptom-severity\') ~ \\\" \\\" ~ join(\', \', resource.getFieldByName(\'symptom-location\').getValues()) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(244,'2015-06-25 13:15:11','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(245,'2015-06-25 13:15:17','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(246,'2015-06-25 13:16:43','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(247,'2015-06-25 13:16:49','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(248,'2015-06-25 13:17:42','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"resource.getFieldByName(\'symptom-severity\') ~ \\\" \\\" ~ join(\', \', field(resource, \'symptom-location\')) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(249,'2015-06-25 13:17:48','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(250,'2015-06-25 13:17:53','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(251,'2015-06-25 13:18:26','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"field(resource, \'symptom-severity\') ~ \\\" \\\" ~ join(\', \', field(resource, \'symptom-location\')) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(252,'2015-06-25 13:18:34','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(253,'2015-06-25 13:18:48','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(254,'2015-06-25 13:19:01','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"upper_first(field(resource, \'symptom-severity\').getValue()) ~ \\\" \\\" ~ join(\', \', field(resource, \'symptom-location\')) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(255,'2015-06-25 13:19:05','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(256,'2015-06-25 13:19:14','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(257,'2015-06-25 13:19:28','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"upper(field(resource, \'symptom-severity\').getValue()) ~ \\\" \\\" ~ join(\', \', field(resource, \'symptom-location\')) ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(258,'2015-06-25 13:19:33','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(259,'2015-06-25 13:20:07','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(260,'2015-06-25 13:22:47','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(261,'2015-06-25 13:22:52','update','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":{\"1\":{\"value\":\"47\"}}}}',76165519),(262,'2015-06-25 13:22:53','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(263,'2015-06-25 13:23:05','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(264,'2015-06-25 13:23:22','edit','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(265,'2015-06-25 13:23:25','update','attribute_prototype_field',1,'accard_backend_attribute_field_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Symptom Location\",\"name\":\"symptom-location\",\"type\":\"choice\",\"option\":\"5\"},\"_method\":\"PUT\"}',76165519),(266,'2015-06-25 13:23:30','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(267,'2015-06-25 13:23:41','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"upper(field(resource, \'symptom-severity\').getValue()) ~ \\\" \\\" ~ field(resource, \'symptom-location\') ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(268,'2015-06-25 13:23:47','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(269,'2015-06-25 13:24:00','update','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"value\":\"47\"},{\"value\":\"41\"}]}}',76165519),(270,'2015-06-25 13:24:01','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(271,'2015-06-25 13:24:05','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(272,'2015-06-25 13:24:11','edit','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(273,'2015-06-25 13:24:29','update','attribute_prototype',1,'accard_backend_attribute_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Entrance Questionaire\",\"name\":\"entrance-questionaire\",\"description\":\"field(resource, \'symptom-severity\') ~ \\\" \\\" ~ field(resource, \'symptom-location\') ~ \\\" pain.\\\"\",\"fields\":[\"1\",\"2\"]},\"_method\":\"PUT\"}',76165519),(274,'2015-06-25 13:24:37','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(275,'2015-06-25 13:25:21','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(276,'2015-06-25 13:25:31','update','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"value\":\"47\"},{\"value\":\"41\"}]}}',76165519),(277,'2015-06-25 13:25:32','edit','attribute',1,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(278,'2015-06-25 13:26:01','new','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"family-medical-history\"}',NULL,76165519),(279,'2015-06-25 13:26:25','create','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"family-medical-history\"}','{\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"value\":\"50\"},{\"value\":\"58\"},{\"values\":[\"59\",\"61\"]},{\"value\":\"\"}]}}',76165519),(280,'2015-06-25 13:26:26','edit','attribute',2,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(281,'2015-06-25 13:26:31','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(282,'2015-06-25 13:26:53','edit','diagnosis',1,'accard_frontend_diagnosis_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(283,'2015-06-25 13:27:03','edit','patient',1,'accard_frontend_patient_update','{\"id\":\"1\"}',NULL,NULL,76165519),(284,'2015-06-25 13:27:31','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(285,'2015-06-25 13:31:02','edit','attribute',2,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(286,'2015-06-25 13:32:37','update','attribute',2,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,'{\"_method\":\"PUT\",\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"value\":\"53\"},{\"value\":\"58\"},{\"values\":[\"59\",\"61\"]},{\"value\":\"\"}]}}',76165519),(287,'2015-06-25 13:32:38','edit','attribute',2,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(288,'2015-06-25 13:32:40','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(289,'2015-06-25 13:33:17','update','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"field(resource, \'side-of-family\') ~ \\\" \\\" ~ lower(field(resource, \'family-member\')) ~ \\\"\'s medical history.\\\"\",\"fields\":[\"3\",\"4\",\"5\",\"6\"]},\"_method\":\"PUT\"}',76165519),(290,'2015-06-25 13:33:21','edit','attribute',2,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(291,'2015-06-25 13:33:39','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(292,'2015-06-25 13:34:02','update','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_attribute_prototype\":{\"_token\":\"O_ppk4gD1h8iA6JUAKCryKtxtyDtB_31NeyzJnoTi0U\",\"presentation\":\"Family Medical History\",\"name\":\"family-medical-history\",\"description\":\"field(resource, \'side-of-family\') ~ \\\" \\\" ~ lower(field(resource, \'family-member\')) ~ \\\"\'s medical history.\\\"\",\"fields\":[\"3\",\"4\",\"5\",\"6\"]},\"_method\":\"PUT\"}',76165519),(293,'2015-06-25 13:34:09','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(294,'2015-06-25 13:34:28','new','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"family-medical-history\"}',NULL,76165519),(295,'2015-06-25 13:34:38','create','attribute',NULL,'accard_frontend_attribute_create','{\"patient\":\"1\"}','{\"prototype\":\"family-medical-history\"}','{\"accard_attribute\":{\"_token\":\"s_NVyGqu8fZU_cHREEjLjbEJRrkFs71cpw6pG3qE7QA\",\"fields\":[{\"value\":\"55\"},{\"value\":\"57\"},{\"values\":[\"60\"]},{\"value\":\"\"}]}}',76165519),(296,'2015-06-25 13:34:39','edit','attribute',3,'accard_frontend_attribute_update','{\"patient\":\"1\",\"id\":\"3\"}',NULL,NULL,76165519),(297,'2015-06-25 13:34:43','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(298,'2015-06-25 13:37:18','new','sample_prototype',NULL,'accard_backend_sample_prototype_create',NULL,NULL,NULL,76165519),(299,'2015-06-25 13:37:31','create','sample_prototype',NULL,'accard_backend_sample_prototype_create',NULL,NULL,'{\"accard_sample_prototype\":{\"_token\":\"F52irlDQDppApv_1hNniZZiug96dFsau1qMZKegts4w\",\"presentation\":\"Whole Blood\",\"name\":\"whole-blood\",\"description\":\"\\\"Whole blood sample\\\"\"}}',76165519),(300,'2015-06-25 13:37:34','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(301,'2015-06-25 13:37:37','new','sample',NULL,'accard_frontend_sample_create','{\"patient\":\"1\"}','{\"prototype\":\"whole-blood\"}',NULL,76165519),(302,'2015-06-25 13:42:15','new','sample',NULL,'accard_frontend_sample_create','{\"patient\":\"1\"}','{\"prototype\":\"whole-blood\"}',NULL,76165519),(303,'2015-06-25 14:15:08','edit','attribute_prototype',2,'accard_backend_attribute_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(304,'2015-06-25 14:15:20','edit','attribute_prototype_field',5,'accard_backend_attribute_field_update','{\"id\":\"5\"}',NULL,NULL,76165519),(305,'2015-06-25 14:15:22','update','attribute_prototype_field',5,'accard_backend_attribute_field_update','{\"id\":\"5\"}',NULL,'{\"accard_attribute_prototype_field\":{\"_token\":\"f_2BxmaSV_VW8a-hisViuZ3OjFWO-t1nUVUme0HinSY\",\"presentation\":\"Diseases\",\"name\":\"diseases\",\"type\":\"choice\",\"option\":\"9\",\"allowMultiple\":\"1\",\"addable\":\"1\"},\"_method\":\"PUT\"}',76165519),(306,'2015-06-25 14:27:51','new','sample',NULL,'accard_frontend_sample_create','{\"patient\":\"1\"}','{\"prototype\":\"whole-blood\"}',NULL,76165519),(307,'2015-06-25 14:48:08','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(308,'2015-06-25 14:48:20','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Patient Able to Perform\",\"name\":\"patient-able-to-perform\",\"type\":\"checkbox\",\"option\":\"\"}}',76165519),(309,'2015-06-25 14:48:27','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(310,'2015-06-25 14:48:37','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Duration\",\"name\":\"duration\",\"type\":\"number\",\"option\":\"\"}}',76165519),(311,'2015-06-25 14:48:40','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(312,'2015-06-25 14:48:43','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(313,'2015-06-25 14:49:27','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Stress Test Methods\",\"name\":\"stress-test-methods\",\"values\":[{\"value\":\"Treadmill\"},{\"value\":\"Stairs\"},{\"value\":\"Jumping Jacks\"}]}}',76165519),(314,'2015-06-25 14:49:27','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"10\"}',NULL,76165519),(315,'2015-06-25 14:49:30','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(316,'2015-06-25 14:50:24','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Poor-Excellent Rating\",\"name\":\"poorexcellent-rating\",\"values\":[{\"value\":\"Poor\"},{\"value\":\"Average\"},{\"value\":\"Good\"},{\"value\":\"Excellent\"}]}}',76165519),(317,'2015-06-25 14:50:25','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"11\"}',NULL,76165519),(318,'2015-06-25 14:50:35','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(319,'2015-06-25 14:50:49','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Stress Test Method\",\"name\":\"stress-test-method\",\"type\":\"choice\",\"option\":\"10\"}}',76165519),(320,'2015-06-25 14:50:56','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(321,'2015-06-25 14:51:17','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Stress Results\",\"name\":\"stress-results\",\"type\":\"choice\",\"option\":\"11\"}}',76165519),(322,'2015-06-25 14:51:23','edit','activity_prototype_field',3,'accard_backend_activity_field_update','{\"id\":\"3\"}',NULL,NULL,76165519),(323,'2015-06-25 14:51:30','update','activity_prototype_field',3,'accard_backend_activity_field_update','{\"id\":\"3\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Stress Method\",\"name\":\"stress-method\",\"type\":\"choice\",\"option\":\"10\"},\"_method\":\"PUT\"}',76165519),(324,'2015-06-25 14:51:36','new','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,NULL,76165519),(325,'2015-06-25 14:54:12','create','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Stress Test\",\"name\":\"stress-test\",\"description\":\"field(resource, \'stress-result\') ~ \\\" under stress result.\\\"\",\"fields\":[\"1\",\"2\",\"3\",\"4\"],\"drugGroup\":\"\"}}',76165519),(326,'2015-06-25 14:54:18','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(327,'2015-06-25 14:54:23','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Comments\",\"name\":\"comments\",\"type\":\"text\",\"option\":\"\"}}',76165519),(328,'2015-06-25 14:54:30','edit','activity_prototype',1,'accard_backend_activity_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(329,'2015-06-25 14:54:34','update','activity_prototype',1,'accard_backend_activity_prototype_update','{\"id\":\"1\"}',NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Stress Test\",\"name\":\"stress-test\",\"description\":\"field(resource, \'stress-result\') ~ \\\" under stress result.\\\"\",\"fields\":[\"1\",\"2\",\"3\",\"4\",\"5\"],\"drugGroup\":\"\"},\"_method\":\"PUT\"}',76165519),(330,'2015-06-25 14:54:44','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(331,'2015-06-25 14:54:47','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"stress-test\"}',NULL,76165519),(332,'2015-06-25 14:55:16','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"stress-test\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2015-06-01\",\"fields\":[{\"value\":\"1\"},{\"value\":\"13\"},{\"value\":\"62\"},{\"value\":\"65\"},{\"value\":\"\"}]}}',76165519),(333,'2015-06-25 14:55:18','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(334,'2015-06-25 14:55:23','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(335,'2015-06-25 14:55:27','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(336,'2015-06-25 14:55:34','edit','activity_prototype',1,'accard_backend_activity_prototype_update','{\"id\":\"1\"}',NULL,NULL,76165519),(337,'2015-06-25 14:55:49','edit','activity_prototype_field',4,'accard_backend_activity_field_update','{\"id\":\"4\"}',NULL,NULL,76165519),(338,'2015-06-25 14:55:55','update','activity_prototype_field',4,'accard_backend_activity_field_update','{\"id\":\"4\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Stress Result\",\"name\":\"stress-result\",\"type\":\"choice\",\"option\":\"11\"},\"_method\":\"PUT\"}',76165519),(339,'2015-06-25 14:55:58','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(340,'2015-06-25 14:56:02','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(341,'2015-06-25 14:56:35','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(342,'2015-06-25 14:57:22','update','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2015-06-01\",\"fields\":[{\"value\":\"1\"},{\"value\":\"13\"},{\"value\":\"62\"},{\"value\":\"65\"},{\"value\":\"Patient complained of knee pain, stated he could continue without that issue.\"}]}}',76165519),(343,'2015-06-25 14:57:23','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(344,'2015-06-25 15:26:53','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(345,'2015-06-25 15:29:46','update','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-04-29\",\"fields\":[{\"value\":\"1\"},{\"value\":\"6\"},{\"value\":\"62\"},{\"value\":\"65\"},{\"value\":\"Patient complained of knee pain, stated he could continue without that issue.\"}]}}',76165519),(346,'2015-06-25 15:29:47','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(347,'2015-06-25 15:29:52','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"stress-test\"}',NULL,76165519),(348,'2015-06-25 15:30:33','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"stress-test\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-06-15\",\"fields\":[{\"value\":\"1\"},{\"value\":\"17\"},{\"value\":\"63\"},{\"value\":\"67\"},{\"value\":\"Patient very much improved since last test.\"}]}}',76165519),(349,'2015-06-25 15:30:34','edit','activity',2,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"2\"}',NULL,NULL,76165519),(350,'2015-06-25 15:30:39','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(351,'2015-06-25 15:42:06','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(352,'2015-06-25 15:42:09','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(353,'2015-06-25 15:42:35','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Surgeons\",\"name\":\"surgeons\",\"values\":[{\"value\":\"Dr. Patel, MD.\"},{\"value\":\"Dr. Schmitt, MD.\"},{\"value\":\"Dr. Constantine, MD.\"}]}}',76165519),(354,'2015-06-25 15:42:36','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"12\"}',NULL,76165519),(355,'2015-06-25 15:42:37','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(356,'2015-06-25 15:43:11','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Surgery Procedures\",\"name\":\"surgery-procedures\",\"values\":[{\"value\":\"Procedure 1\"},{\"value\":\"Procedure 2\"},{\"value\":\"Procedure 3\"}]}}',76165519),(357,'2015-06-25 15:43:12','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"13\"}',NULL,76165519),(358,'2015-06-25 15:43:14','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(359,'2015-06-25 15:45:03','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Surgery Methods\",\"name\":\"surgery-methods\",\"values\":[{\"value\":\"Method 1\"},{\"value\":\"Method 2\"}]}}',76165519),(360,'2015-06-25 15:45:04','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"14\"}',NULL,76165519),(361,'2015-06-25 15:45:16','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(362,'2015-06-25 15:45:26','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Surgeon\",\"name\":\"surgeon\",\"type\":\"choice\",\"option\":\"12\"}}',76165519),(363,'2015-06-25 15:45:29','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(364,'2015-06-25 15:45:40','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Procedure\",\"name\":\"procedure\",\"type\":\"choice\",\"option\":\"13\"}}',76165519),(365,'2015-06-25 15:45:44','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(366,'2015-06-25 15:46:15','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Site of Surgery\",\"name\":\"site-of-surgery\",\"type\":\"choice\",\"option\":\"5\"}}',76165519),(367,'2015-06-25 15:46:25','edit','activity_prototype_field',7,'accard_backend_activity_field_update','{\"id\":\"7\"}',NULL,NULL,76165519),(368,'2015-06-25 15:46:31','update','activity_prototype_field',7,'accard_backend_activity_field_update','{\"id\":\"7\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Procedure\",\"name\":\"surgery-procedure\",\"type\":\"choice\",\"option\":\"13\"},\"_method\":\"PUT\"}',76165519),(369,'2015-06-25 15:46:52','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(370,'2015-06-25 15:47:06','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Surgery Method\",\"name\":\"surgery-method\",\"type\":\"choice\",\"option\":\"14\"}}',76165519),(371,'2015-06-25 15:47:11','new','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,NULL,76165519),(372,'2015-06-25 15:48:40','create','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Generic Surgery\",\"name\":\"generic-surgery\",\"description\":\"field(resource, \'surgery-procedure\') ~ \\\" of the \\\" ~ field(resource, \'site-of-surgery\') ~ \\\".\\\"\",\"fields\":[\"6\",\"7\",\"8\",\"9\",\"5\"],\"drugGroup\":\"\"}}',76165519),(373,'2015-06-25 15:49:25','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(374,'2015-06-25 15:49:34','update','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,'{\"_method\":\"PUT\",\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"\",\"activityDate\":\"2012-04-18\",\"fields\":[{\"value\":\"1\"},{\"value\":\"6\"},{\"value\":\"62\"},{\"value\":\"65\"},{\"value\":\"Patient complained of knee pain, stated he could continue without that issue.\"}]}}',76165519),(375,'2015-06-25 15:49:35','edit','activity',1,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(376,'2015-06-25 15:49:46','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(377,'2015-06-25 15:49:49','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}',NULL,76165519),(378,'2015-06-25 15:51:47','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-09-30\",\"fields\":[{\"value\":\"Complications present near end due to anesthesia.\"},{\"value\":\"69\"},{\"value\":\"72\"},{\"value\":\"40\"},{\"value\":\"76\"}]}}',76165519),(379,'2015-06-25 15:51:48','edit','activity',3,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"3\"}',NULL,NULL,76165519),(380,'2015-06-25 15:51:59','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(381,'2015-06-25 15:52:30','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}',NULL,76165519),(382,'2015-06-25 15:52:59','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-10-03\",\"fields\":[{\"value\":\"Surgery went very well.\"},{\"value\":\"69\"},{\"value\":\"73\"},{\"value\":\"40\"},{\"value\":\"75\"}]}}',76165519),(383,'2015-06-25 15:53:00','edit','activity',4,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"4\"}',NULL,NULL,76165519),(384,'2015-06-25 15:53:09','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(385,'2015-06-25 15:54:00','edit','activity_prototype_field',8,'accard_backend_activity_field_update','{\"id\":\"8\"}',NULL,NULL,76165519),(386,'2015-06-25 15:54:11','update','activity_prototype_field',8,'accard_backend_activity_field_update','{\"id\":\"8\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Site\",\"name\":\"site\",\"type\":\"choice\",\"option\":\"5\"},\"_method\":\"PUT\"}',76165519),(387,'2015-06-25 15:54:15','edit','activity_prototype',2,'accard_backend_activity_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(388,'2015-06-25 15:55:16','update','activity_prototype',2,'accard_backend_activity_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Generic Surgery\",\"name\":\"generic-surgery\",\"description\":\"field(resource, \'surgery-procedure\') ~ \\\" of the \\\" ~ field(resource, \'site\') ~ \\\".\\\"\",\"fields\":[\"5\",\"6\",\"7\",\"8\",\"9\"],\"drugGroup\":\"\"},\"_method\":\"PUT\"}',76165519),(389,'2015-06-25 15:55:20','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(390,'2015-06-25 15:55:23','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(391,'2015-06-25 15:55:33','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Radiation Types\",\"name\":\"radiation-types\",\"values\":[{\"value\":\"Proton\"},{\"value\":\"Photon\"}]}}',76165519),(392,'2015-06-25 15:55:33','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"15\"}',NULL,76165519),(393,'2015-06-25 15:55:53','edit','activity_prototype_field',9,'accard_backend_activity_field_update','{\"id\":\"9\"}',NULL,NULL,76165519),(394,'2015-06-25 15:56:01','update','activity_prototype_field',9,'accard_backend_activity_field_update','{\"id\":\"9\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Method\",\"name\":\"surgery\",\"type\":\"choice\",\"option\":\"14\"},\"_method\":\"PUT\"}',76165519),(395,'2015-06-25 15:56:07','edit','activity_prototype_field',9,'accard_backend_activity_field_update','{\"id\":\"9\"}',NULL,NULL,76165519),(396,'2015-06-25 15:56:11','update','activity_prototype_field',9,'accard_backend_activity_field_update','{\"id\":\"9\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Method\",\"name\":\"method\",\"type\":\"choice\",\"option\":\"14\"},\"_method\":\"PUT\"}',76165519),(397,'2015-06-25 15:56:18','edit','activity_prototype_field',7,'accard_backend_activity_field_update','{\"id\":\"7\"}',NULL,NULL,76165519),(398,'2015-06-25 15:56:22','update','activity_prototype_field',7,'accard_backend_activity_field_update','{\"id\":\"7\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Procedure\",\"name\":\"procedure\",\"type\":\"choice\",\"option\":\"13\"},\"_method\":\"PUT\"}',76165519),(399,'2015-06-25 15:56:27','edit','activity_prototype',2,'accard_backend_activity_prototype_update','{\"id\":\"2\"}',NULL,NULL,76165519),(400,'2015-06-25 15:56:32','update','activity_prototype',2,'accard_backend_activity_prototype_update','{\"id\":\"2\"}',NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Generic Surgery\",\"name\":\"generic-surgery\",\"description\":\"field(resource, \'procedure\') ~ \\\" of the \\\" ~ field(resource, \'site\') ~ \\\".\\\"\",\"fields\":[\"5\",\"6\",\"7\",\"8\",\"9\"],\"drugGroup\":\"\"},\"_method\":\"PUT\"}',76165519),(401,'2015-06-25 15:56:44','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(402,'2015-06-25 15:56:58','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Radiation Type\",\"name\":\"radiation-type\",\"type\":\"choice\",\"option\":\"15\"}}',76165519),(403,'2015-06-25 15:57:03','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(404,'2015-06-25 15:57:15','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Grays\",\"name\":\"grays\",\"type\":\"number\",\"option\":\"\"}}',76165519),(405,'2015-06-25 15:57:19','new','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,NULL,76165519),(406,'2015-06-25 15:58:28','create','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Radiation\",\"name\":\"radiation\",\"description\":\"field(resource, \'radiation-type\') ~ \\\" of the \\\" ~ field(resource, \'site\') ~ \\\".\\\"\",\"fields\":[\"10\",\"8\",\"11\"],\"drugGroup\":\"\"}}',76165519),(407,'2015-06-25 15:59:05','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(408,'2015-06-25 15:59:24','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}',NULL,76165519),(409,'2015-06-25 16:00:47','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-10-03\",\"fields\":[{\"value\":\"40\"},{\"value\":\"78\"},{\"value\":\"43\"}]}}',76165519),(410,'2015-06-25 16:00:49','edit','activity',5,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"5\"}',NULL,NULL,76165519),(411,'2015-06-25 16:00:55','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}',NULL,76165519),(412,'2015-06-25 16:01:16','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-10-14\",\"fields\":[{\"value\":\"40\"},{\"value\":\"78\"},{\"value\":\"43\"}]}}',76165519),(413,'2015-06-25 16:01:18','edit','activity',6,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"6\"}',NULL,NULL,76165519),(414,'2015-06-25 16:01:21','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}',NULL,76165519),(415,'2015-06-25 16:03:36','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-11-15\",\"fields\":[{\"value\":\"40\"},{\"value\":\"78\"},{\"value\":\"43\"}]}}',76165519),(416,'2015-06-25 16:03:37','edit','activity',7,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"7\"}',NULL,NULL,76165519),(417,'2015-06-25 16:03:42','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(418,'2015-06-25 16:11:39','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(419,'2015-06-25 16:11:41','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(420,'2015-06-25 16:11:56','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Routes\",\"name\":\"routes\",\"values\":[{\"value\":\"IV\"},{\"value\":\"Oral\"}]}}',76165519),(421,'2015-06-25 16:11:57','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"16\"}',NULL,76165519),(422,'2015-06-25 16:12:04','new','drug_group',NULL,'accard_backend_drug_group_create',NULL,NULL,NULL,76165519),(423,'2015-06-25 16:12:11','create','drug_group',NULL,'accard_backend_drug_group_create',NULL,NULL,'{\"accard_drug_group\":{\"_token\":\"VDDiietl4yIkb6rCZZAvpfdbxctdpnPPzPDUXMuxwSw\",\"presentation\":\"Chemotherapy Drugs\",\"name\":\"chemotherapy-drugs\"}}',76165519),(424,'2015-06-25 16:12:14','new','drug',NULL,'accard_backend_drug_create',NULL,NULL,NULL,76165519),(425,'2015-06-25 16:12:21','create','drug',NULL,'accard_backend_drug_create',NULL,NULL,'{\"accard_drug\":{\"_token\":\"DUV6wVCzQ6yf9tT9ycaZuP19ZwxbQm8DQmUs0HrPQUs\",\"presentation\":\"Chemotherapy 1\",\"name\":\"chemotherapy-1\",\"generic\":\"\"}}',76165519),(426,'2015-06-25 16:12:24','new','drug',NULL,'accard_backend_drug_create',NULL,NULL,NULL,76165519),(427,'2015-06-25 16:12:29','create','drug',NULL,'accard_backend_drug_create',NULL,NULL,'{\"accard_drug\":{\"_token\":\"DUV6wVCzQ6yf9tT9ycaZuP19ZwxbQm8DQmUs0HrPQUs\",\"presentation\":\"Chemotherapy 2\",\"name\":\"chemotherapy-2\",\"generic\":\"\"}}',76165519),(428,'2015-06-25 16:12:32','new','drug',NULL,'accard_backend_drug_create',NULL,NULL,NULL,76165519),(429,'2015-06-25 16:12:38','create','drug',NULL,'accard_backend_drug_create',NULL,NULL,'{\"accard_drug\":{\"_token\":\"DUV6wVCzQ6yf9tT9ycaZuP19ZwxbQm8DQmUs0HrPQUs\",\"presentation\":\"Chemotherapy 3\",\"name\":\"chemotherapy-3\",\"generic\":\"\"}}',76165519),(430,'2015-06-25 16:12:43','edit','drug_group',1,'accard_backend_drug_group_update','{\"id\":\"1\"}',NULL,NULL,76165519),(431,'2015-06-25 16:12:48','update','drug_group',1,'accard_backend_drug_group_update','{\"id\":\"1\"}',NULL,'{\"accard_drug_group\":{\"_token\":\"VDDiietl4yIkb6rCZZAvpfdbxctdpnPPzPDUXMuxwSw\",\"presentation\":\"Chemotherapy Drugs\",\"name\":\"chemotherapy-drugs\",\"drugs\":[\"1\",\"2\",\"3\"]}}',76165519),(432,'2015-06-25 16:13:59','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(433,'2015-06-25 16:14:12','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Dose\",\"name\":\"dose\",\"type\":\"number\",\"option\":\"\"}}',76165519),(434,'2015-06-25 16:14:17','new','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,NULL,76165519),(435,'2015-06-25 16:14:28','create','activity_prototype_field',NULL,'accard_backend_activity_field_create',NULL,NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"WRjYU2TbKLEWRPU-noqYDLmmZfrx9kNJ5FpaqJGYajg\",\"presentation\":\"Route\",\"name\":\"route\",\"type\":\"choice\",\"option\":\"16\"}}',76165519),(436,'2015-06-25 16:14:34','new','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,NULL,76165519),(437,'2015-06-25 16:16:50','create','activity_prototype',NULL,'accard_backend_activity_prototype_create',NULL,NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Chemotherapy\",\"name\":\"chemotherapy\",\"description\":\"(resource.getDrug() ? resource.getDrug().getPresentation() : \\\"\\\") ~ \\\" (\\\" ~ field(resource, \'dose\') ~  \\\"mg)\\\"\",\"fields\":[\"12\",\"13\"],\"allowDrug\":\"1\",\"drugGroup\":\"1\"}}',76165519),(438,'2015-06-25 16:16:56','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}',NULL,76165519),(439,'2015-06-25 16:16:58','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(440,'2015-06-25 16:17:32','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}',NULL,76165519),(441,'2015-06-25 16:18:12','create','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"generic-surgery\"}','{\"accard_activity\":{\"_token\":\"RuvfQ6QeC0q9Off9DoSez-51OB6WQd735HIvhsQoR0Y\",\"diagnosis\":\"1\",\"activityDate\":\"2012-11-16\",\"fields\":[{\"value\":\"\"},{\"value\":\"70\"},{\"value\":\"73\"},{\"value\":\"40\"},{\"value\":\"76\"}]}}',76165519),(442,'2015-06-25 16:18:13','edit','activity',8,'accard_frontend_activity_update','{\"patient\":\"1\",\"id\":\"8\"}',NULL,NULL,76165519),(443,'2015-06-25 16:18:16','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(444,'2015-06-25 16:18:58','edit','activity_prototype',3,'accard_backend_activity_prototype_update','{\"id\":\"3\"}',NULL,NULL,76165519),(445,'2015-06-25 16:19:36','update','activity_prototype',3,'accard_backend_activity_prototype_update','{\"id\":\"3\"}',NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Radiation\",\"name\":\"radiation\",\"description\":\"field(resource, \'grays\') ~ \\\"gray \\\" ~ lower(field(resource, \'radiation-type\')) ~ \\\" of the \\\" ~ field(resource, \'site\') ~ \\\".\\\"\",\"fields\":[\"8\",\"10\",\"11\"],\"drugGroup\":\"\"},\"_method\":\"PUT\"}',76165519),(446,'2015-06-25 16:19:39','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(447,'2015-06-25 16:19:50','edit','activity_prototype',3,'accard_backend_activity_prototype_update','{\"id\":\"3\"}',NULL,NULL,76165519),(448,'2015-06-25 16:19:53','update','activity_prototype',3,'accard_backend_activity_prototype_update','{\"id\":\"3\"}',NULL,'{\"accard_activity_prototype\":{\"_token\":\"bdFoPUhXYQjzTGoObPIPJZrBcP_n7GjBxjgBpdo437Q\",\"presentation\":\"Radiation\",\"name\":\"radiation\",\"description\":\"field(resource, \'grays\') ~ \\\" gray \\\" ~ lower(field(resource, \'radiation-type\')) ~ \\\" of the \\\" ~ field(resource, \'site\') ~ \\\".\\\"\",\"fields\":[\"8\",\"10\",\"11\"],\"drugGroup\":\"\"},\"_method\":\"PUT\"}',76165519),(449,'2015-06-25 16:19:58','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(450,'2015-06-29 08:23:14','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(451,'2015-06-29 08:23:21','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(452,'2015-06-29 12:06:46','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(453,'2015-06-29 12:06:50','index','option',NULL,'accard_backend_option_index',NULL,'{\"page\":\"2\"}',NULL,76165519),(454,'2015-06-29 12:07:02','index','option',NULL,'accard_backend_option_index',NULL,'{\"page\":\"1\"}',NULL,76165519),(455,'2015-07-01 08:19:54','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(456,'2015-07-01 08:20:19','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(457,'2015-07-01 08:20:35','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(458,'2015-07-01 08:20:49','edit','diagnosis',1,'accard_frontend_diagnosis_update','{\"patient\":\"1\",\"id\":\"1\"}',NULL,NULL,76165519),(459,'2015-07-01 08:36:30','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(460,'2015-07-01 08:36:34','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(461,'2015-07-01 08:37:06','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Overall Effects\",\"name\":\"overall-effects\",\"values\":[{\"value\":\"Patient performed better\"},{\"value\":\"Patient performance stayed the same\"},{\"value\":\"Patient performed worse\"}]}}',76165519),(462,'2015-07-01 08:37:07','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"17\"}',NULL,76165519),(463,'2015-07-01 08:37:09','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(464,'2015-07-01 08:37:42','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Best Responses\",\"name\":\"best-responses\",\"values\":[{\"value\":\"Partial Response (PR)\"},{\"value\":\"Complete Response (CR)\"},{\"value\":\"No Response (NR)\"}]}}',76165519),(465,'2015-07-01 08:37:43','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"18\"}',NULL,76165519),(466,'2015-07-01 08:37:50','new','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,NULL,76165519),(467,'2015-07-01 08:38:02','create','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,'{\"accard_regimen_prototype_field\":{\"_token\":\"J30kJqVKHy3uCCoP9E52jsFaVev8Jsvc1pcfQQ6Zd1E\",\"presentation\":\"Overall Effect\",\"name\":\"overall-effect\",\"type\":\"choice\",\"option\":\"17\"}}',76165519),(468,'2015-07-01 08:38:05','new','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,NULL,76165519),(469,'2015-07-01 08:38:15','create','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,'{\"accard_regimen_prototype_field\":{\"_token\":\"J30kJqVKHy3uCCoP9E52jsFaVev8Jsvc1pcfQQ6Zd1E\",\"presentation\":\"Best Response\",\"name\":\"best-response\",\"type\":\"choice\",\"option\":\"18\"}}',76165519),(470,'2015-07-01 08:38:24','new','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,NULL,76165519),(471,'2015-07-01 08:39:23','create','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,'{\"accard_regimen_prototype\":{\"_token\":\"AP5qd5ci8VrOIeZJwzJGlx-HRZkNLemS-le4liryQ7U\",\"presentation\":\"Stressful Surgery Analysis\",\"name\":\"stressful-surgery-analysis\",\"description\":\"field(resource, \'overall-effect\') ~ \\\"on stress test analysis\\\"\",\"fields\":[\"1\"],\"drugGroup\":\"\",\"activityPrototypes\":[\"1\",\"2\"]}}',76165519),(472,'2015-07-01 08:39:39','new','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,NULL,76165519),(473,'2015-07-01 08:40:37','create','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,'{\"accard_regimen_prototype\":{\"_token\":\"AP5qd5ci8VrOIeZJwzJGlx-HRZkNLemS-le4liryQ7U\",\"presentation\":\"Combination Radiation & Chemotherapy\",\"name\":\"combination-radiation-chemotherapy\",\"description\":\"field(resource, \'best-response\') ~ \\\" to round of treatment\\\"\",\"fields\":[\"2\"],\"drugGroup\":\"\",\"activityPrototypes\":[\"3\",\"4\"]}}',76165519),(474,'2015-07-01 08:46:34','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(475,'2015-07-01 08:46:36','new','option',NULL,'accard_backend_option_create',NULL,NULL,NULL,76165519),(476,'2015-07-01 08:47:50','create','option',NULL,'accard_backend_option_create',NULL,NULL,'{\"accard_option\":{\"_token\":\"Q1SX1ETP019fhzi7r9ZJVoZFRlJ_LD3k3YMFsUO-oDw\",\"presentation\":\"Reasons for Discontinuation\",\"name\":\"reasons-for-discontinuation\",\"values\":[{\"value\":\"Patient completed regimen\"},{\"value\":\"Patient too sick to complete\"},{\"value\":\"Patient refused treatment\"},{\"value\":\"Patient died\"}]}}',76165519),(477,'2015-07-01 08:47:51','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"19\"}',NULL,76165519),(478,'2015-07-01 08:48:01','new','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,NULL,76165519),(479,'2015-07-01 08:48:15','create','regimen_prototype_field',NULL,'accard_backend_regimen_field_create',NULL,NULL,'{\"accard_regimen_prototype_field\":{\"_token\":\"J30kJqVKHy3uCCoP9E52jsFaVev8Jsvc1pcfQQ6Zd1E\",\"presentation\":\"Reason for Discontinuation\",\"name\":\"reason-for-discontinuation\",\"type\":\"choice\",\"option\":\"19\"}}',76165519),(480,'2015-07-01 08:48:20','new','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,NULL,76165519),(481,'2015-07-01 08:50:22','create','regimen_prototype',NULL,'accard_backend_regimen_prototype_create',NULL,NULL,'{\"accard_regimen_prototype\":{\"_token\":\"AP5qd5ci8VrOIeZJwzJGlx-HRZkNLemS-le4liryQ7U\",\"presentation\":\"Chemotherapy Regimen\",\"name\":\"chemotherapy-regimen\",\"description\":\"field(resource, \'best-response\') ~ \\\": \\\" ~ field(resource, \'reason-for-discontinuation\')\",\"fields\":[\"2\",\"3\"],\"allowDrug\":\"1\",\"drugGroup\":\"1\"}}',76165519),(482,'2015-07-01 08:50:28','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(483,'2015-07-01 08:50:36','new','regimen',NULL,'accard_frontend_regimen_create','{\"patient\":\"1\"}','{\"prototype\":\"stressful-surgery-analysis\"}',NULL,76165519),(484,'2015-07-01 08:51:45','new','regimen',NULL,'accard_frontend_regimen_create','{\"patient\":\"1\"}','{\"prototype\":\"stressful-surgery-analysis\"}',NULL,76165519),(485,'2015-07-01 08:52:19','new','regimen',NULL,'accard_frontend_regimen_create','{\"patient\":\"1\"}','{\"prototype\":\"combination-radiation-chemotherapy\"}',NULL,76165519),(486,'2015-07-01 08:53:22','new','regimen',NULL,'accard_frontend_regimen_create','{\"patient\":\"1\"}','{\"prototype\":\"chemotherapy-regimen\"}',NULL,76165519),(487,'2015-07-01 08:55:28','new','activity',NULL,'accard_frontend_activity_create','{\"patient\":\"1\"}','{\"prototype\":\"radiation\"}',NULL,76165519),(488,'2015-07-14 16:27:56','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(489,'2015-07-14 16:28:01','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(490,'2015-07-14 16:29:17','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(491,'2015-07-14 16:29:42','edit','option',4,'accard_backend_option_update','{\"id\":\"4\"}',NULL,NULL,76165519),(492,'2015-07-14 16:29:56','update','option',4,'accard_backend_option_update','{\"id\":\"4\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Frequencies\",\"name\":\"frequencies\",\"values\":[{\"value\":\"Hourly\",\"order\":\"1\"},{\"value\":\"Daily\",\"order\":\"2\"},{\"value\":\"Weekly\",\"order\":\"3\"},{\"value\":\"Bi-Weekly\",\"order\":\"4\"},{\"value\":\"Monthly\",\"order\":\"5\"},{\"value\":\"Occasionally\",\"order\":\"6\"}]}}',76165519),(493,'2015-07-14 16:29:57','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"4\"}',NULL,76165519),(494,'2015-07-14 16:30:16','edit','option',5,'accard_backend_option_update','{\"id\":\"5\"}',NULL,NULL,76165519),(495,'2015-07-14 16:30:30','update','option',5,'accard_backend_option_update','{\"id\":\"5\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Body Locations\",\"name\":\"body-locations\",\"values\":[{\"value\":\"Head\",\"order\":\"1\"},{\"value\":\"Neck\",\"order\":\"2\"},{\"value\":\"Shoulder\",\"order\":\"3\"},{\"value\":\"Chest\",\"order\":\"4\"},{\"value\":\"Abdomen\",\"order\":\"5\"}]}}',76165519),(496,'2015-07-14 16:30:32','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"5\"}',NULL,76165519),(497,'2015-07-14 16:30:38','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"5\",\"page\":\"2\"}',NULL,76165519),(498,'2015-07-14 16:30:48','edit','option',12,'accard_backend_option_update','{\"id\":\"12\"}',NULL,NULL,76165519),(499,'2015-07-14 16:31:04','update','option',12,'accard_backend_option_update','{\"id\":\"12\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Surgeons\",\"name\":\"surgeons\",\"values\":[{\"value\":\"Dr. Patel, MD.\",\"order\":\"3\"},{\"value\":\"Dr. Schmitt, MD.\",\"order\":\"2\"},{\"value\":\"Dr. Constantine, MD.\",\"order\":\"1\"}]}}',76165519),(500,'2015-07-14 16:31:06','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"12\"}',NULL,76165519),(501,'2015-07-14 16:31:27','edit','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,NULL,76165519),(502,'2015-07-14 16:31:34','update','patient_field',1,'accard_backend_patient_field_update','{\"id\":\"1\"}',NULL,'{\"accard_patient_field\":{\"_token\":\"AC3bpny0088rcqUE87qlbOKtpWsBv6OYuqqyjou1zLg\",\"presentation\":\"Eye Color\",\"name\":\"eye-color\",\"type\":\"choice\",\"option\":\"1\",\"order\":\"alphabetical\"},\"_method\":\"PUT\"}',76165519),(503,'2015-07-14 16:31:55','edit','activity_prototype_field',3,'accard_backend_activity_field_update','{\"id\":\"3\"}',NULL,NULL,76165519),(504,'2015-07-14 16:32:01','index','option',NULL,'accard_backend_option_index',NULL,NULL,NULL,76165519),(505,'2015-07-14 16:32:06','index','option',NULL,'accard_backend_option_index',NULL,'{\"page\":\"2\"}',NULL,76165519),(506,'2015-07-14 16:32:14','edit','option',14,'accard_backend_option_update','{\"id\":\"14\"}',NULL,NULL,76165519),(507,'2015-07-14 16:32:20','update','option',14,'accard_backend_option_update','{\"id\":\"14\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Surgery Methods\",\"name\":\"surgery-methods\",\"values\":[{\"value\":\"Method 1\",\"order\":\"1\"},{\"value\":\"Method 2\",\"order\":\"1\"}]}}',76165519),(508,'2015-07-14 16:32:21','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"14\"}',NULL,76165519),(509,'2015-07-14 16:32:34','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"14\",\"page\":\"2\"}',NULL,76165519),(510,'2015-07-14 16:32:50','edit','activity_prototype_field',4,'accard_backend_activity_field_update','{\"id\":\"4\"}',NULL,NULL,76165519),(511,'2015-07-14 16:33:00','edit','option',11,'accard_backend_option_update','{\"id\":\"11\"}',NULL,NULL,76165519),(512,'2015-07-14 16:33:11','update','option',11,'accard_backend_option_update','{\"id\":\"11\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Poor-Excellent Rating\",\"name\":\"poorexcellent-rating\",\"values\":[{\"value\":\"Poor\",\"order\":\"1\"},{\"value\":\"Average\",\"order\":\"2\"},{\"value\":\"Good\",\"order\":\"3\"},{\"value\":\"Excellent\",\"order\":\"4\"}]}}',76165519),(513,'2015-07-14 16:33:12','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"11\"}',NULL,76165519),(514,'2015-07-14 16:33:31','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"11\",\"page\":\"2\"}',NULL,76165519),(515,'2015-07-14 16:33:42','edit','activity_prototype_field',8,'accard_backend_activity_field_update','{\"id\":\"8\"}',NULL,NULL,76165519),(516,'2015-07-14 16:33:46','update','activity_prototype_field',8,'accard_backend_activity_field_update','{\"id\":\"8\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"urTHmaz85bljjx7LQq_S698fg-a4x9D_Wv9iZ66_JOg\",\"presentation\":\"Site\",\"name\":\"site\",\"type\":\"choice\",\"option\":\"5\",\"order\":\"alphabetical\"},\"_method\":\"PUT\"}',76165519),(517,'2015-07-14 16:33:58','edit','activity_prototype_field',8,'accard_backend_activity_field_update','{\"id\":\"8\"}',NULL,NULL,76165519),(518,'2015-07-14 16:34:17','edit','activity_prototype_field',10,'accard_backend_activity_field_update','{\"id\":\"10\"}',NULL,NULL,76165519),(519,'2015-07-14 16:34:23','update','activity_prototype_field',10,'accard_backend_activity_field_update','{\"id\":\"10\"}',NULL,'{\"accard_activity_prototype_field\":{\"_token\":\"urTHmaz85bljjx7LQq_S698fg-a4x9D_Wv9iZ66_JOg\",\"presentation\":\"Radiation Type\",\"name\":\"radiation-type\",\"type\":\"choice\",\"option\":\"15\",\"order\":\"alphabetical\"},\"_method\":\"PUT\"}',76165519),(520,'2015-07-14 16:34:37','edit','option',16,'accard_backend_option_update','{\"id\":\"16\"}',NULL,NULL,76165519),(521,'2015-07-14 16:34:46','update','option',16,'accard_backend_option_update','{\"id\":\"16\"}',NULL,'{\"_method\":\"PUT\",\"accard_option\":{\"_token\":\"f-Wc36j_PtzsHZu_N9ebHns0sx8WO419tiVdfB_jfQY\",\"presentation\":\"Routes\",\"name\":\"routes\",\"values\":[{\"value\":\"IV\",\"order\":\"1\"},{\"value\":\"Oral\",\"order\":\"2\"}]}}',76165519),(522,'2015-07-14 16:34:47','index','option',NULL,'accard_backend_option_index',NULL,'{\"id\":\"16\"}',NULL,76165519),(523,'2015-07-14 16:40:20','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(524,'2015-07-14 16:40:24','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(525,'2015-07-14 17:28:21','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(526,'2015-07-15 22:41:10','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(527,'2015-07-15 22:41:19','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(528,'2015-07-15 22:42:14','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(529,'2015-07-15 22:43:01','show','patient',1,'accard_frontend_patient_show','{\"id\":\"1\"}',NULL,NULL,76165519),(530,'2015-07-15 22:44:20','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(531,'2015-07-15 22:54:24','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(532,'2015-07-15 22:54:32','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(533,'2015-07-15 22:54:40','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(534,'2015-07-15 22:55:58','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"213458930\",\"firstName\":\"Jane\",\"lastName\":\"Doe\",\"gender\":\"female\",\"race\":\"asian\",\"dateOfBirth\":\"1974-07-19\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(535,'2015-07-15 22:55:59','show','patient',2,'accard_frontend_patient_show','{\"id\":\"2\"}',NULL,NULL,76165519),(536,'2015-07-15 22:56:28','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(537,'2015-07-15 22:57:53','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(538,'2015-07-15 22:58:04','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(539,'2015-07-15 22:58:18','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(540,'2015-07-15 22:58:55','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"938492102\",\"firstName\":\"Bella\",\"lastName\":\"Mitchell\",\"gender\":\"female\",\"race\":\"native hawaiian or other pacific islander\",\"dateOfBirth\":\"1985-06-13\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(541,'2015-07-15 22:58:55','show','patient',3,'accard_frontend_patient_show','{\"id\":\"3\"}',NULL,NULL,76165519),(542,'2015-07-15 22:59:21','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(543,'2015-07-15 23:00:41','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"283940004\",\"firstName\":\"Jonathon\",\"lastName\":\"Clark\",\"gender\":\"male\",\"race\":\"black or african american\",\"dateOfBirth\":\"1979-04-21\",\"dateOfDeath\":\"2013-06-07\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(544,'2015-07-15 23:00:41','show','patient',4,'accard_frontend_patient_show','{\"id\":\"4\"}',NULL,NULL,76165519),(545,'2015-07-15 23:00:47','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(546,'2015-07-15 23:01:04','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(547,'2015-07-15 23:01:38','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"394859200\",\"firstName\":\"Jessica\",\"lastName\":\"Forsyth\",\"gender\":\"female\",\"race\":\"unknown\",\"dateOfBirth\":\"1981-12-06\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(548,'2015-07-15 23:01:38','show','patient',5,'accard_frontend_patient_show','{\"id\":\"5\"}',NULL,NULL,76165519),(549,'2015-07-15 23:01:51','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(550,'2015-07-15 23:02:23','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"734904329\",\"firstName\":\"Isaac\",\"lastName\":\"Knox\",\"gender\":\"male\",\"race\":\"black or african american\",\"dateOfBirth\":\"1982-12-15\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(551,'2015-07-15 23:02:23','show','patient',6,'accard_frontend_patient_show','{\"id\":\"6\"}',NULL,NULL,76165519),(552,'2015-07-15 23:02:27','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(553,'2015-07-15 23:03:30','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"888394283\",\"firstName\":\"David\",\"lastName\":\"Harris\",\"gender\":\"male\",\"race\":\"white\",\"dateOfBirth\":\"1979-11-29\",\"dateOfDeath\":\"2014-08-14\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(554,'2015-07-15 23:03:30','show','patient',7,'accard_frontend_patient_show','{\"id\":\"7\"}',NULL,NULL,76165519),(555,'2015-07-15 23:03:40','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(556,'2015-07-15 23:04:30','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"558493092\",\"firstName\":\"Gabrielle\",\"lastName\":\"Butler\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1969-05-12\",\"dateOfDeath\":\"2014-06-27\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(557,'2015-07-15 23:04:31','show','patient',8,'accard_frontend_patient_show','{\"id\":\"8\"}',NULL,NULL,76165519),(558,'2015-07-15 23:04:35','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(559,'2015-07-15 23:04:48','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(560,'2015-07-15 23:05:19','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"001928885\",\"firstName\":\"Nicola\",\"lastName\":\"Mills\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1984-09-23\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(561,'2015-07-15 23:05:19','show','patient',9,'accard_frontend_patient_show','{\"id\":\"9\"}',NULL,NULL,76165519),(562,'2015-07-15 23:05:37','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(563,'2015-07-15 23:06:02','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"049382119\",\"firstName\":\"Chloe\",\"lastName\":\"Simpson\",\"gender\":\"female\",\"race\":\"black or african american\",\"dateOfBirth\":\"1987-09-09\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(564,'2015-07-15 23:06:02','show','patient',10,'accard_frontend_patient_show','{\"id\":\"10\"}',NULL,NULL,76165519),(565,'2015-07-15 23:06:09','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(566,'2015-07-15 23:07:18','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"647583559\",\"firstName\":\"Virginia\",\"lastName\":\"Walsh\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1973-02-27\",\"dateOfDeath\":\"2015-02-13\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(567,'2015-07-15 23:07:19','show','patient',11,'accard_frontend_patient_show','{\"id\":\"11\"}',NULL,NULL,76165519),(568,'2015-07-15 23:07:27','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(569,'2015-07-15 23:07:55','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"333849000\",\"firstName\":\"Audrey\",\"lastName\":\"Vaughan\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1976-07-17\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(570,'2015-07-15 23:07:55','show','patient',12,'accard_frontend_patient_show','{\"id\":\"12\"}',NULL,NULL,76165519),(571,'2015-07-15 23:08:07','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(572,'2015-07-15 23:08:35','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"\",\"firstName\":\"Una\",\"lastName\":\"Fraser-Lee\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1981-01-12\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(573,'2015-07-15 23:08:35','show','patient',13,'accard_frontend_patient_show','{\"id\":\"13\"}',NULL,NULL,76165519),(574,'2015-07-15 23:08:40','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(575,'2015-07-15 23:08:46','show','patient',13,'accard_frontend_patient_show','{\"id\":\"13\"}',NULL,NULL,76165519),(576,'2015-07-15 23:08:47','edit','patient',13,'accard_frontend_patient_update','{\"id\":\"13\"}',NULL,NULL,76165519),(577,'2015-07-15 23:09:02','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(578,'2015-07-15 23:09:09','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(579,'2015-07-15 23:09:57','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"227384966\",\"firstName\":\"Paul\",\"lastName\":\"Gray\",\"gender\":\"male\",\"race\":\"white\",\"dateOfBirth\":\"1985-12-19\",\"dateOfDeath\":\"2014-05-04\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(580,'2015-07-15 23:09:57','show','patient',14,'accard_frontend_patient_show','{\"id\":\"14\"}',NULL,NULL,76165519),(581,'2015-07-15 23:10:02','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(582,'2015-07-15 23:10:25','new','patient',NULL,'accard_frontend_patient_create',NULL,NULL,NULL,76165519),(583,'2015-07-15 23:10:59','create','patient',NULL,'accard_frontend_patient_create',NULL,NULL,'{\"accard_patient\":{\"_token\":\"H47-uq4HYDe4ZiCflYRXHXxHxazfCc9ayqLbVkdCHso\",\"mrn\":\"289302948\",\"firstName\":\"Anne\",\"lastName\":\"Fischer\",\"gender\":\"female\",\"race\":\"white\",\"dateOfBirth\":\"1976-11-17\",\"dateOfDeath\":\"\",\"fields\":[{\"value\":\"\"},{\"value\":\"\"}]}}',76165519),(584,'2015-07-15 23:11:00','show','patient',15,'accard_frontend_patient_show','{\"id\":\"15\"}',NULL,NULL,76165519),(585,'2015-07-15 23:11:04','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(586,'2015-07-15 23:12:18','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(587,'2015-07-15 23:30:32','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"dateOfBirth\":\"asc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(588,'2015-07-15 23:31:17','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"dateOfBirth\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(589,'2015-07-15 23:32:58','index','patient',NULL,'accard_api_patient_index',NULL,'{\"criteria\":{\"lastName\":\"M%\"},\"sorting\":{\"dateOfBirth\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(590,'2015-07-15 23:33:20','index','patient',NULL,'accard_api_patient_index',NULL,'{\"criteria\":{\"lastName\":\"Mi%\"},\"sorting\":{\"dateOfBirth\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(591,'2015-07-15 23:33:34','index','patient',NULL,'accard_api_patient_index',NULL,'{\"criteria\":{\"lastName\":\"Mills\"},\"sorting\":{\"dateOfBirth\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519),(592,'2015-07-16 14:53:18','index','patient',NULL,'accard_api_patient_index',NULL,'{\"sorting\":{\"id\":\"desc\"},\"page\":\"1\",\"limit\":\"25\"}',NULL,76165519);
/*!40000 ALTER TABLE `dag_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_option`
--

DROP TABLE IF EXISTS `accard_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_option`
--

LOCK TABLES `accard_option` WRITE;
/*!40000 ALTER TABLE `accard_option` DISABLE KEYS */;
INSERT INTO `accard_option` VALUES (1,'eye-colors','Eye Colors'),(2,'industries','Industries'),(3,'drug-types','Drug Types'),(4,'frequencies','Frequencies'),(5,'body-locations','Body Locations'),(6,'symptom-severities','Symptom Severities'),(7,'family-members','Family Members'),(8,'family-sides','Family Sides'),(9,'relevant-diseases','Relevant Diseases'),(10,'stress-test-methods','Stress Test Methods'),(11,'poorexcellent-rating','Poor-Excellent Rating'),(12,'surgeons','Surgeons'),(13,'surgery-procedures','Surgery Procedures'),(14,'surgery-methods','Surgery Methods'),(15,'radiation-types','Radiation Types'),(16,'routes','Routes'),(17,'overall-effects','Overall Effects'),(18,'best-responses','Best Responses'),(19,'reasons-for-discontinuation','Reasons for Discontinuation');
/*!40000 ALTER TABLE `accard_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_option_value`
--

DROP TABLE IF EXISTS `accard_option_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `optionId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_96657CDDCE78B7CC` (`optionId`),
  CONSTRAINT `FK_96657CDDCE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_option_value`
--

LOCK TABLES `accard_option_value` WRITE;
/*!40000 ALTER TABLE `accard_option_value` DISABLE KEYS */;
INSERT INTO `accard_option_value` VALUES (1,'Black',0,1,1),(2,'Blue',0,2,1),(3,'Brown',0,3,1),(4,'Hazel',0,4,1),(5,'Green',0,5,1),(6,'Other',0,99,1),(7,'Automotive',0,0,2),(8,'Chemical',0,0,2),(9,'Construction',0,0,2),(10,'Energy',0,0,2),(11,'Financial',0,0,2),(12,'Healthcare',0,0,2),(13,'Industrial',0,0,2),(14,'Infrastructure',0,0,2),(15,'Metal',0,0,2),(16,'Retail',0,0,2),(17,'Technology',0,0,2),(18,'Textile',0,0,2),(19,'Transportation',0,0,2),(20,'Travel',0,0,2),(21,'Alcohol',0,0,3),(22,'Amphetamines',0,0,3),(23,'Cannabis',0,0,3),(24,'Cocaine',0,0,3),(25,'Crack Cocaine',0,0,3),(26,'Ecstasy',0,0,3),(27,'Heroin',0,0,3),(28,'Inhalants',0,0,3),(29,'Ketamine',0,0,3),(30,'LSD',0,0,3),(31,'Mushrooms',0,0,3),(32,'Methamphetamines',0,0,3),(33,'PCP',0,0,3),(34,'Hourly',0,1,4),(35,'Daily',0,2,4),(36,'Weekly',0,3,4),(37,'Bi-Weekly',0,4,4),(38,'Monthly',0,5,4),(39,'Occasionally',0,6,4),(40,'Head',0,1,5),(41,'Neck',0,2,5),(42,'Shoulder',0,3,5),(43,'Chest',0,4,5),(44,'Abdomen',0,5,5),(45,'Not Severe',0,0,6),(46,'Severe',0,0,6),(47,'Very Severe',0,0,6),(48,'I Don\'t Know',0,0,6),(49,'Mother',0,0,7),(50,'Father',0,0,7),(51,'Brother',0,0,7),(52,'Sister',0,0,7),(53,'Aunt',0,0,7),(54,'Uncle',0,0,7),(55,'Grandmother',0,0,7),(56,'Grandfather',0,0,7),(57,'Maternal',0,1,8),(58,'Paternal',0,2,8),(59,'Diabetis',0,0,9),(60,'Heart Attack',0,0,9),(61,'High Blood Pressure',0,0,9),(62,'Treadmill',0,0,10),(63,'Stairs',0,0,10),(64,'Jumping Jacks',0,0,10),(65,'Poor',0,1,11),(66,'Average',0,2,11),(67,'Good',0,3,11),(68,'Excellent',0,4,11),(69,'Dr. Patel, MD.',0,3,12),(70,'Dr. Schmitt, MD.',0,2,12),(71,'Dr. Constantine, MD.',0,1,12),(72,'Procedure 1',0,0,13),(73,'Procedure 2',0,0,13),(74,'Procedure 3',0,0,13),(75,'Method 1',0,1,14),(76,'Method 2',0,1,14),(77,'Proton',0,0,15),(78,'Photon',0,0,15),(79,'IV',0,1,16),(80,'Oral',0,2,16),(81,'Patient performed better',0,0,17),(82,'Patient performance stayed the same',0,0,17),(83,'Patient performed worse',0,0,17),(84,'Partial Response (PR)',0,0,18),(85,'Complete Response (CR)',0,0,18),(86,'No Response (NR)',0,0,18),(87,'Patient completed regimen',0,0,19),(88,'Patient too sick to complete',0,0,19),(89,'Patient refused treatment',0,0,19),(90,'Patient died',0,0,19);
/*!40000 ALTER TABLE `accard_option_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient`
--

DROP TABLE IF EXISTS `accard_patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mrn` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfBirth` datetime NOT NULL,
  `dateOfDeath` datetime DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `race` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `targetId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_45453AFA84DD64A` (`mrn`),
  UNIQUE KEY `UNIQ_45453AFA39659675` (`targetId`),
  CONSTRAINT `FK_45453AFA39659675` FOREIGN KEY (`targetId`) REFERENCES `accard_import_patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient`
--

LOCK TABLES `accard_patient` WRITE;
/*!40000 ALTER TABLE `accard_patient` DISABLE KEYS */;
INSERT INTO `accard_patient` VALUES (1,'103495102','John','Smith','1974-05-16 00:00:00',NULL,'male','white',NULL),(2,'213458930','Jane','Doe','1974-07-19 00:00:00',NULL,'female','asian',NULL),(3,'938492102','Bella','Mitchell','1985-06-13 00:00:00',NULL,'female','native hawaiian or other pacific islander',NULL),(4,'283940004','Jonathon','Clark','1979-04-21 00:00:00','2013-06-07 00:00:00','male','black or african american',NULL),(5,'394859200','Jessica','Forsyth','1981-12-06 00:00:00',NULL,'female','unknown',NULL),(6,'734904329','Isaac','Knox','1982-12-15 00:00:00',NULL,'male','black or african american',NULL),(7,'888394283','David','Harris','1979-11-29 00:00:00','2014-08-14 00:00:00','male','white',NULL),(8,'558493092','Gabrielle','Butler','1969-05-12 00:00:00','2014-06-27 00:00:00','female','white',NULL),(9,'001928885','Nicola','Mills','1984-09-23 00:00:00',NULL,'female','white',NULL),(10,'049382119','Chloe','Simpson','1987-09-09 00:00:00',NULL,'female','black or african american',NULL),(11,'647583559','Virginia','Walsh','1973-02-27 00:00:00','2015-02-13 00:00:00','female','white',NULL),(12,'333849000','Audrey','Vaughan','1976-07-17 00:00:00',NULL,'female','white',NULL),(13,NULL,'Una','Fraser-Lee','1981-01-12 00:00:00',NULL,'female','white',NULL),(14,'227384966','Paul','Gray','1985-12-19 00:00:00','2014-05-04 00:00:00','male','white',NULL),(15,'289302948','Anne','Fischer','1976-11-17 00:00:00',NULL,'female','white',NULL);
/*!40000 ALTER TABLE `accard_patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient_field`
--

DROP TABLE IF EXISTS `accard_patient_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_54CED4B85E237E06` (`name`),
  KEY `IDX_54CED4B8CE78B7CC` (`optionId`),
  CONSTRAINT `FK_54CED4B8CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient_field`
--

LOCK TABLES `accard_patient_field` WRITE;
/*!40000 ALTER TABLE `accard_patient_field` DISABLE KEYS */;
INSERT INTO `accard_patient_field` VALUES (1,'eye-color','Eye Color','choice',0,0,'alphabetical','a:0:{}',1),(2,'last-contact-date','Last Contact Date','date',0,0,'numeric','a:0:{}',NULL);
/*!40000 ALTER TABLE `accard_patient_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient_field_value`
--

DROP TABLE IF EXISTS `accard_patient_field_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient_field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `patientId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E084E37081F9A87C` (`optionValueId`),
  KEY `IDX_E084E3708F803478` (`patientId`),
  KEY `IDX_E084E3705E697A44` (`fieldId`),
  CONSTRAINT `FK_E084E3705E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_patient_field` (`id`),
  CONSTRAINT `FK_E084E37081F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`),
  CONSTRAINT `FK_E084E3708F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient_field_value`
--

LOCK TABLES `accard_patient_field_value` WRITE;
/*!40000 ALTER TABLE `accard_patient_field_value` DISABLE KEYS */;
INSERT INTO `accard_patient_field_value` VALUES (1,NULL,NULL,NULL,3,1,1),(2,NULL,'2015-04-15 00:00:00',NULL,NULL,1,2),(3,NULL,NULL,NULL,NULL,2,1),(4,NULL,NULL,NULL,NULL,2,2),(5,NULL,NULL,NULL,NULL,3,1),(6,NULL,NULL,NULL,NULL,3,2),(7,NULL,NULL,NULL,NULL,4,1),(8,NULL,NULL,NULL,NULL,4,2),(9,NULL,NULL,NULL,NULL,5,1),(10,NULL,NULL,NULL,NULL,5,2),(11,NULL,NULL,NULL,NULL,6,1),(12,NULL,NULL,NULL,NULL,6,2),(13,NULL,NULL,NULL,NULL,7,1),(14,NULL,NULL,NULL,NULL,7,2),(15,NULL,NULL,NULL,NULL,8,1),(16,NULL,NULL,NULL,NULL,8,2),(17,NULL,NULL,NULL,NULL,9,1),(18,NULL,NULL,NULL,NULL,9,2),(19,NULL,NULL,NULL,NULL,10,1),(20,NULL,NULL,NULL,NULL,10,2),(21,NULL,NULL,NULL,NULL,11,1),(22,NULL,NULL,NULL,NULL,11,2),(23,NULL,NULL,NULL,NULL,12,1),(24,NULL,NULL,NULL,NULL,12,2),(25,NULL,NULL,NULL,NULL,13,1),(26,NULL,NULL,NULL,NULL,13,2),(27,NULL,NULL,NULL,NULL,14,1),(28,NULL,NULL,NULL,NULL,14,2),(29,NULL,NULL,NULL,NULL,15,1),(30,NULL,NULL,NULL,NULL,15,2);
/*!40000 ALTER TABLE `accard_patient_field_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient_fld_opt_map`
--

DROP TABLE IF EXISTS `accard_patient_fld_opt_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient_fld_opt_map` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_C6EC0E8B81F9A87C` (`optionValueId`),
  KEY `IDX_C6EC0E8BE8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_C6EC0E8B81F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_patient_field_value` (`id`),
  CONSTRAINT `FK_C6EC0E8BE8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient_fld_opt_map`
--

LOCK TABLES `accard_patient_fld_opt_map` WRITE;
/*!40000 ALTER TABLE `accard_patient_fld_opt_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_patient_fld_opt_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient_phase`
--

DROP TABLE IF EXISTS `accard_patient_phase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient_phase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient_phase`
--

LOCK TABLES `accard_patient_phase` WRITE;
/*!40000 ALTER TABLE `accard_patient_phase` DISABLE KEYS */;
INSERT INTO `accard_patient_phase` VALUES (1,'screening','Screening',1),(2,'consented','Consented',2),(3,'treatment','Treatment',3),(4,'post-treatment','Post Treatment',4),(5,'follow-up','Follow Up',5),(6,'archived','Archived',6);
/*!40000 ALTER TABLE `accard_patient_phase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_patient_phase_inst`
--

DROP TABLE IF EXISTS `accard_patient_phase_inst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_patient_phase_inst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` int(11) DEFAULT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_450F421158E0B66` (`target_id`),
  KEY `IDX_450F42199091188` (`phase_id`),
  CONSTRAINT `FK_450F421158E0B66` FOREIGN KEY (`target_id`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_450F42199091188` FOREIGN KEY (`phase_id`) REFERENCES `accard_patient_phase` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_patient_phase_inst`
--

LOCK TABLES `accard_patient_phase_inst` WRITE;
/*!40000 ALTER TABLE `accard_patient_phase_inst` DISABLE KEYS */;
INSERT INTO `accard_patient_phase_inst` VALUES (1,1,1,'2012-01-13 00:00:00','2012-04-22 00:00:00'),(2,1,2,'2012-04-20 00:00:00',NULL),(3,1,3,'2012-04-26 00:00:00','2013-07-17 00:00:00'),(4,1,5,'2013-07-18 00:00:00','2014-01-01 00:00:00'),(5,1,6,'2014-01-01 00:00:00',NULL);
/*!40000 ALTER TABLE `accard_patient_phase_inst` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen`
--

DROP TABLE IF EXISTS `accard_regimen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `drugId` int(11) DEFAULT NULL,
  `prototypeId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `diagnosisId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7E8EF59EDBA88346` (`drugId`),
  KEY `IDX_7E8EF59E9B116E9A` (`prototypeId`),
  KEY `IDX_7E8EF59E8F803478` (`patientId`),
  KEY `IDX_7E8EF59ED0EA680C` (`diagnosisId`),
  CONSTRAINT `FK_7E8EF59E8F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_7E8EF59E9B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_regimen_prototype` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7E8EF59ED0EA680C` FOREIGN KEY (`diagnosisId`) REFERENCES `accard_diagnosis` (`id`),
  CONSTRAINT `FK_7E8EF59EDBA88346` FOREIGN KEY (`drugId`) REFERENCES `accard_drug` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen`
--

LOCK TABLES `accard_regimen` WRITE;
/*!40000 ALTER TABLE `accard_regimen` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_regimen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_activity_map`
--

DROP TABLE IF EXISTS `accard_regimen_activity_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_activity_map` (
  `activityPrototypeId` int(11) NOT NULL,
  `regimenPrototypeId` int(11) NOT NULL,
  PRIMARY KEY (`activityPrototypeId`,`regimenPrototypeId`),
  KEY `IDX_447DEB5B2B242F3D` (`activityPrototypeId`),
  KEY `IDX_447DEB5B438AD5F2` (`regimenPrototypeId`),
  CONSTRAINT `FK_447DEB5B2B242F3D` FOREIGN KEY (`activityPrototypeId`) REFERENCES `accard_regimen_prototype` (`id`),
  CONSTRAINT `FK_447DEB5B438AD5F2` FOREIGN KEY (`regimenPrototypeId`) REFERENCES `accard_activity_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_activity_map`
--

LOCK TABLES `accard_regimen_activity_map` WRITE;
/*!40000 ALTER TABLE `accard_regimen_activity_map` DISABLE KEYS */;
INSERT INTO `accard_regimen_activity_map` VALUES (1,1),(1,2),(2,3),(2,4);
/*!40000 ALTER TABLE `accard_regimen_activity_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_proto_fld`
--

DROP TABLE IF EXISTS `accard_regimen_proto_fld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_proto_fld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E62A58515E237E06` (`name`),
  KEY `IDX_E62A5851CE78B7CC` (`optionId`),
  CONSTRAINT `FK_E62A5851CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_proto_fld`
--

LOCK TABLES `accard_regimen_proto_fld` WRITE;
/*!40000 ALTER TABLE `accard_regimen_proto_fld` DISABLE KEYS */;
INSERT INTO `accard_regimen_proto_fld` VALUES (1,'overall-effect','Overall Effect','choice',0,0,'numeric','a:0:{}',17),(2,'best-response','Best Response','choice',0,0,'numeric','a:0:{}',18),(3,'reason-for-discontinuation','Reason for Discontinuation','choice',0,0,'numeric','a:0:{}',19);
/*!40000 ALTER TABLE `accard_regimen_proto_fld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_proto_fld_opt_m`
--

DROP TABLE IF EXISTS `accard_regimen_proto_fld_opt_m`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_proto_fld_opt_m` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_CCCE7B6381F9A87C` (`optionValueId`),
  KEY `IDX_CCCE7B63E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_CCCE7B6381F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_regimen_proto_fldval` (`id`),
  CONSTRAINT `FK_CCCE7B63E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_proto_fld_opt_m`
--

LOCK TABLES `accard_regimen_proto_fld_opt_m` WRITE;
/*!40000 ALTER TABLE `accard_regimen_proto_fld_opt_m` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_regimen_proto_fld_opt_m` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_proto_fldval`
--

DROP TABLE IF EXISTS `accard_regimen_proto_fldval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_proto_fldval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `regimenId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5378E08E81F9A87C` (`optionValueId`),
  KEY `IDX_5378E08E85CA7E31` (`regimenId`),
  KEY `IDX_5378E08E5E697A44` (`fieldId`),
  CONSTRAINT `FK_5378E08E5E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_regimen_proto_fld` (`id`),
  CONSTRAINT `FK_5378E08E81F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`),
  CONSTRAINT `FK_5378E08E85CA7E31` FOREIGN KEY (`regimenId`) REFERENCES `accard_regimen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_proto_fldval`
--

LOCK TABLES `accard_regimen_proto_fldval` WRITE;
/*!40000 ALTER TABLE `accard_regimen_proto_fldval` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_regimen_proto_fldval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_prototype`
--

DROP TABLE IF EXISTS `accard_regimen_prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allowDrug` tinyint(1) DEFAULT NULL,
  `drugGroupId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1713F9E8A67C4099` (`drugGroupId`),
  CONSTRAINT `FK_1713F9E8A67C4099` FOREIGN KEY (`drugGroupId`) REFERENCES `accard_drug_group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_prototype`
--

LOCK TABLES `accard_regimen_prototype` WRITE;
/*!40000 ALTER TABLE `accard_regimen_prototype` DISABLE KEYS */;
INSERT INTO `accard_regimen_prototype` VALUES (1,'stressful-surgery-analysis','Stressful Surgery Analysis','field(resource, \'overall-effect\') ~ \"on stress test analysis\"',0,NULL),(2,'combination-radiation-chemotherapy','Combination Radiation & Chemotherapy','field(resource, \'best-response\') ~ \" to round of treatment\"',0,NULL),(3,'chemotherapy-regimen','Chemotherapy Regimen','field(resource, \'best-response\') ~ \": \" ~ field(resource, \'reason-for-discontinuation\')',1,1);
/*!40000 ALTER TABLE `accard_regimen_prototype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_regimen_prototype_map`
--

DROP TABLE IF EXISTS `accard_regimen_prototype_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_regimen_prototype_map` (
  `prototypeId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`prototypeId`,`subjectId`),
  KEY `IDX_9524569C9B116E9A` (`prototypeId`),
  KEY `IDX_9524569C3E0C34EB` (`subjectId`),
  CONSTRAINT `FK_9524569C3E0C34EB` FOREIGN KEY (`subjectId`) REFERENCES `accard_regimen_proto_fld` (`id`),
  CONSTRAINT `FK_9524569C9B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_regimen_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_regimen_prototype_map`
--

LOCK TABLES `accard_regimen_prototype_map` WRITE;
/*!40000 ALTER TABLE `accard_regimen_prototype_map` DISABLE KEYS */;
INSERT INTO `accard_regimen_prototype_map` VALUES (1,1),(2,2),(3,2),(3,3);
/*!40000 ALTER TABLE `accard_regimen_prototype_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample`
--

DROP TABLE IF EXISTS `accard_sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `sourceId` int(11) DEFAULT NULL,
  `prototypeId` int(11) NOT NULL,
  `patientId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6B6E6FFAEE155AE0` (`sourceId`),
  KEY `IDX_6B6E6FFA9B116E9A` (`prototypeId`),
  KEY `IDX_6B6E6FFA8F803478` (`patientId`),
  CONSTRAINT `FK_6B6E6FFA8F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`),
  CONSTRAINT `FK_6B6E6FFA9B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_sample_prototype` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6B6E6FFAEE155AE0` FOREIGN KEY (`sourceId`) REFERENCES `accard_sample_source` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample`
--

LOCK TABLES `accard_sample` WRITE;
/*!40000 ALTER TABLE `accard_sample` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_proto_fld`
--

DROP TABLE IF EXISTS `accard_sample_proto_fld`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_proto_fld` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `allowMultiple` tinyint(1) NOT NULL,
  `addable` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'numeric',
  `configuration` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `optionId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D7ABA2F35E237E06` (`name`),
  KEY `IDX_D7ABA2F3CE78B7CC` (`optionId`),
  CONSTRAINT `FK_D7ABA2F3CE78B7CC` FOREIGN KEY (`optionId`) REFERENCES `accard_option` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_proto_fld`
--

LOCK TABLES `accard_sample_proto_fld` WRITE;
/*!40000 ALTER TABLE `accard_sample_proto_fld` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample_proto_fld` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_proto_fld_opt_ma`
--

DROP TABLE IF EXISTS `accard_sample_proto_fld_opt_ma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_proto_fld_opt_ma` (
  `optionValueId` int(11) NOT NULL,
  `fieldValueId` int(11) NOT NULL,
  PRIMARY KEY (`optionValueId`,`fieldValueId`),
  KEY `IDX_9CECBE0481F9A87C` (`optionValueId`),
  KEY `IDX_9CECBE04E8ED26A9` (`fieldValueId`),
  CONSTRAINT `FK_9CECBE0481F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_sample_proto_fldval` (`id`),
  CONSTRAINT `FK_9CECBE04E8ED26A9` FOREIGN KEY (`fieldValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_proto_fld_opt_ma`
--

LOCK TABLES `accard_sample_proto_fld_opt_ma` WRITE;
/*!40000 ALTER TABLE `accard_sample_proto_fld_opt_ma` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample_proto_fld_opt_ma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_proto_fldval`
--

DROP TABLE IF EXISTS `accard_sample_proto_fldval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_proto_fldval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stringValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateValue` datetime DEFAULT NULL,
  `numberValue` int(11) DEFAULT NULL,
  `optionValueId` int(11) DEFAULT NULL,
  `sampleId` int(11) NOT NULL,
  `fieldId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD68D33081F9A87C` (`optionValueId`),
  KEY `IDX_FD68D330730CE27D` (`sampleId`),
  KEY `IDX_FD68D3305E697A44` (`fieldId`),
  CONSTRAINT `FK_FD68D3305E697A44` FOREIGN KEY (`fieldId`) REFERENCES `accard_sample_proto_fld` (`id`),
  CONSTRAINT `FK_FD68D330730CE27D` FOREIGN KEY (`sampleId`) REFERENCES `accard_sample` (`id`),
  CONSTRAINT `FK_FD68D33081F9A87C` FOREIGN KEY (`optionValueId`) REFERENCES `accard_option_value` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_proto_fldval`
--

LOCK TABLES `accard_sample_proto_fldval` WRITE;
/*!40000 ALTER TABLE `accard_sample_proto_fldval` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample_proto_fldval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_prototype`
--

DROP TABLE IF EXISTS `accard_sample_prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `presentation` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_prototype`
--

LOCK TABLES `accard_sample_prototype` WRITE;
/*!40000 ALTER TABLE `accard_sample_prototype` DISABLE KEYS */;
INSERT INTO `accard_sample_prototype` VALUES (1,'whole-blood','Whole Blood','\"Whole blood sample\"');
/*!40000 ALTER TABLE `accard_sample_prototype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_prototype_map`
--

DROP TABLE IF EXISTS `accard_sample_prototype_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_prototype_map` (
  `prototypeId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  PRIMARY KEY (`prototypeId`,`subjectId`),
  KEY `IDX_B953D8249B116E9A` (`prototypeId`),
  KEY `IDX_B953D8243E0C34EB` (`subjectId`),
  CONSTRAINT `FK_B953D8243E0C34EB` FOREIGN KEY (`subjectId`) REFERENCES `accard_sample_proto_fld` (`id`),
  CONSTRAINT `FK_B953D8249B116E9A` FOREIGN KEY (`prototypeId`) REFERENCES `accard_sample_prototype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_prototype_map`
--

LOCK TABLES `accard_sample_prototype_map` WRITE;
/*!40000 ALTER TABLE `accard_sample_prototype_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample_prototype_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_sample_source`
--

DROP TABLE IF EXISTS `accard_sample_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_sample_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sourceDate` datetime NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `parentSampleId` int(11) DEFAULT NULL,
  `patientId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5530F9C68C7A1510` (`parentSampleId`),
  KEY `IDX_5530F9C68F803478` (`patientId`),
  CONSTRAINT `FK_5530F9C68C7A1510` FOREIGN KEY (`parentSampleId`) REFERENCES `accard_sample` (`id`),
  CONSTRAINT `FK_5530F9C68F803478` FOREIGN KEY (`patientId`) REFERENCES `accard_patient` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_sample_source`
--

LOCK TABLES `accard_sample_source` WRITE;
/*!40000 ALTER TABLE `accard_sample_source` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_sample_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_setting`
--

DROP TABLE IF EXISTS `accard_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namespace` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_setting`
--

LOCK TABLES `accard_setting` WRITE;
/*!40000 ALTER TABLE `accard_setting` DISABLE KEYS */;
INSERT INTO `accard_setting` VALUES (1,'patient','enabled','b:1;'),(2,'patient','import_enabled','b:0;'),(3,'patient','collect_phases','b:1;'),(4,'patient','pds_enabled','b:0;'),(5,'general','title','s:16:\"Accard Framework\";'),(6,'general','logotype','s:7:\"Sandbox\";'),(7,'general','locale','s:2:\"en\";');
/*!40000 ALTER TABLE `accard_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accard_template`
--

DROP TABLE IF EXISTS `accard_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accard_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FD8FA09C5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accard_template`
--

LOCK TABLES `accard_template` WRITE;
/*!40000 ALTER TABLE `accard_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `accard_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dag_user`
--

DROP TABLE IF EXISTS `dag_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dag_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dag_user`
--

LOCK TABLES `dag_user` WRITE;
/*!40000 ALTER TABLE `dag_user` DISABLE KEYS */;
INSERT INTO `dag_user` VALUES (10209669,'wwormley','ROLE_USER,ROLE_ADMIN,ROLE_SUPERUSER'),(76165519,'bardonf','ROLE_USER,ROLE_ADMIN,ROLE_SUPERUSER');
/*!40000 ALTER TABLE `dag_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_log_entries`
--

DROP TABLE IF EXISTS `ext_log_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_log_entries`
--

LOCK TABLES `ext_log_entries` WRITE;
/*!40000 ALTER TABLE `ext_log_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `ext_log_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_trans_unit`
--

DROP TABLE IF EXISTS `lexik_trans_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_trans_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_domain_idx` (`key_name`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_trans_unit`
--

LOCK TABLES `lexik_trans_unit` WRITE;
/*!40000 ALTER TABLE `lexik_trans_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_trans_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_trans_unit_translation`
--

DROP TABLE IF EXISTS `lexik_trans_unit_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_trans_unit_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `trans_unit_id` int(11) DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trans_unit_locale_idx` (`trans_unit_id`,`locale`),
  KEY `IDX_75CB162F93CB796C` (`file_id`),
  KEY `IDX_75CB162FC3C583C9` (`trans_unit_id`),
  CONSTRAINT `FK_75CB162F93CB796C` FOREIGN KEY (`file_id`) REFERENCES `lexik_translation_file` (`id`),
  CONSTRAINT `FK_75CB162FC3C583C9` FOREIGN KEY (`trans_unit_id`) REFERENCES `lexik_trans_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_trans_unit_translation`
--

LOCK TABLES `lexik_trans_unit_translation` WRITE;
/*!40000 ALTER TABLE `lexik_trans_unit_translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_trans_unit_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lexik_translation_file`
--

DROP TABLE IF EXISTS `lexik_translation_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lexik_translation_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `extention` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_idx` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lexik_translation_file`
--

LOCK TABLES `lexik_translation_file` WRITE;
/*!40000 ALTER TABLE `lexik_translation_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `lexik_translation_file` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-16 12:47:09
