CREATE DATABASE  IF NOT EXISTS `starbound_log` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `starbound_log`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: starbound_log
-- ------------------------------------------------------
-- Server version	5.6.13-log

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
-- Table structure for table `planets_visists`
--

DROP TABLE IF EXISTS `planets_visists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planets_visists` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit_planet_id` int(11) NOT NULL,
  `visit_user_id` int(11) NOT NULL,
  `visit_biome_id` int(11) NOT NULL,
  `visit_rating` int(10) unsigned NOT NULL,
  `visit_tier` int(11) NOT NULL,
  `visit_comment` text NOT NULL,
  `visit_shared` tinyint(1) NOT NULL,
  `visit_created` datetime NOT NULL,
  `visit_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`visit_id`),
  UNIQUE KEY `planet_user_unique` (`visit_planet_id`,`visit_user_id`),
  KEY `fk_planets_visits_users1_idx` (`visit_user_id`),
  KEY `fk_planets_visits_planets1_idx` (`visit_planet_id`),
  KEY `fk_planets_visits_biomes1_idx` (`visit_biome_id`),
  KEY `index6` (`visit_rating`),
  CONSTRAINT `fk_planets_visits_biomes1` FOREIGN KEY (`visit_biome_id`) REFERENCES `biomes` (`biome_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_planets_visits_planets1` FOREIGN KEY (`visit_planet_id`) REFERENCES `planets` (`planet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_planets_visits_users1` FOREIGN KEY (`visit_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planets_visists`
--

LOCK TABLES `planets_visists` WRITE;
/*!40000 ALTER TABLE `planets_visists` DISABLE KEYS */;
/*!40000 ALTER TABLE `planets_visists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-25 22:17:07
