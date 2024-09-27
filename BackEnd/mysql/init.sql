CREATE DATABASE IF NOT EXISTS swc;
USE swc;

-- Crear usuario con acceso desde cualquier host
CREATE USER 'swc'@'%' IDENTIFIED BY 'swc';

-- Conceder privilegios solo en la base de datos 'esignature'
GRANT ALL PRIVILEGES ON swc.* TO 'swc'@'%';

-- No es necesario FLUSH PRIVILEGES aquí después del GRANT

-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: swc
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deposits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `depositType_id` int NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `deposits_unique` (`name`),
  KEY `deposits_deposits_types_FK` (`depositType_id`),
  CONSTRAINT `deposits_deposits_types_FK` FOREIGN KEY (`depositType_id`) REFERENCES `deposits_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (1,'Quantum',1,'https://images.swcombine.com//materials/1/deposit.gif'),(2,'Meleenium',1,'https://images.swcombine.com//materials/2/deposit.gif'),(3,'Ardanium',2,'https://images.swcombine.com//materials/3/deposit.gif'),(4,'Rudic',3,'https://images.swcombine.com//materials/4/deposit.gif'),(5,'Ryll',4,'https://images.swcombine.com//materials/5/deposit.gif'),(6,'Duracrete',1,'https://images.swcombine.com//materials/6/deposit.gif'),(7,'Alazhi',4,'https://images.swcombine.com//materials/7/deposit.gif'),(8,'Laboi',3,'https://images.swcombine.com//materials/8/deposit.gif'),(9,'Adegan',3,'https://images.swcombine.com//materials/9/deposit.gif'),(10,'Rockivory',2,'https://images.swcombine.com//materials/10/deposit.gif'),(11,'Tibannagas',2,'https://images.swcombine.com//materials/11/deposit.gif'),(12,'Nova',3,'https://images.swcombine.com//materials/12/deposit.gif'),(13,'Varium',2,'https://images.swcombine.com//materials/13/deposit.gif'),(14,'Varmigio',2,'https://images.swcombine.com//materials/14/deposit.gif'),(15,'Lommite',1,'https://images.swcombine.com//materials/15/deposit.gif'),(16,'Hibridium',3,'https://images.swcombine.com//materials/16/deposit.gif'),(17,'Durelium',1,'https://images.swcombine.com//materials/17/deposit.gif'),(18,'Lowickan',3,'https://images.swcombine.com//materials/18/deposit.gif'),(19,'Vertex',3,'https://images.swcombine.com//materials/19/deposit.gif'),(20,'Berubian',3,'https://images.swcombine.com//materials/20/deposit.gif'),(21,'Bacta',4,'https://images.swcombine.com//materials/21/deposit.gif');
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits_types`
--

DROP TABLE IF EXISTS `deposits_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deposits_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits_types`
--

LOCK TABLES `deposits_types` WRITE;
/*!40000 ALTER TABLE `deposits_types` DISABLE KEYS */;
INSERT INTO `deposits_types` VALUES (1,'Heavy Metals'),(2,'Light Metals'),(3,'Crystals'),(4,'Other');
/*!40000 ALTER TABLE `deposits_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planetTerrain_deposits`
--

DROP TABLE IF EXISTS `planetTerrain_deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planetTerrain_deposits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `terrain_id` int NOT NULL,
  `deposit_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `terrain_deposits_unique` (`terrain_id`),
  KEY `planetTerrain_deposits_deposits_FK` (`deposit_id`),
  CONSTRAINT `planetTerrain_deposits_deposits_FK` FOREIGN KEY (`deposit_id`) REFERENCES `deposits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `planetTerrain_deposits_planet_terrain_FK` FOREIGN KEY (`terrain_id`) REFERENCES `planet_terrain` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planetTerrain_deposits`
--

LOCK TABLES `planetTerrain_deposits` WRITE;
/*!40000 ALTER TABLE `planetTerrain_deposits` DISABLE KEYS */;
INSERT INTO `planetTerrain_deposits` VALUES (12,17,1,300000);
/*!40000 ALTER TABLE `planetTerrain_deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planet_terrain`
--

DROP TABLE IF EXISTS `planet_terrain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planet_terrain` (
  `id` int NOT NULL AUTO_INCREMENT,
  `planet_id` int NOT NULL,
  `terrain_coordX` int NOT NULL,
  `terrain_coordY` int NOT NULL,
  `terrain_have_deposit` int NOT NULL,
  `terrain_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `planet_terrain_unique` (`planet_id`,`terrain_coordX`,`terrain_coordY`),
  KEY `planet_terrain_terrain_types_FK` (`terrain_type_id`),
  CONSTRAINT `planet_terrain_planets_FK` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `planet_terrain_terrain_types_FK` FOREIGN KEY (`terrain_type_id`) REFERENCES `terrain_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planet_terrain`
--

LOCK TABLES `planet_terrain` WRITE;
/*!40000 ALTER TABLE `planet_terrain` DISABLE KEYS */;
INSERT INTO `planet_terrain` VALUES (16,10,0,0,0,1),(17,10,0,1,1,2),(18,10,1,0,0,3),(19,10,1,1,0,4);
/*!40000 ALTER TABLE `planet_terrain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planets`
--

DROP TABLE IF EXISTS `planets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `planets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sizeX` int NOT NULL,
  `sizeY` int NOT NULL,
  `sysX` int NOT NULL,
  `sysY` int NOT NULL,
  `galX` int NOT NULL,
  `galY` int NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `planets_unique` (`sysX`,`sysY`),
  UNIQUE KEY `planets_unique_1` (`name`),
  UNIQUE KEY `planets_unique_2` (`galX`,`galY`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planets`
--

LOCK TABLES `planets` WRITE;
/*!40000 ALTER TABLE `planets` DISABLE KEYS */;
INSERT INTO `planets` VALUES (10,'Ord Radama',2,2,8,12,229,328,'https://custom.swcombine.com/static/8/5974-large-1678833211.png');
/*!40000 ALTER TABLE `planets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terrain_types`
--

DROP TABLE IF EXISTS `terrain_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terrain_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `img_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terrain_types`
--

LOCK TABLES `terrain_types` WRITE;
/*!40000 ALTER TABLE `terrain_types` DISABLE KEYS */;
INSERT INTO `terrain_types` VALUES (1,'Black Hole Terrain','https://images.swcombine.com//galaxy/terrains/y/terrain.gif'),(2,'Cave','https://images.swcombine.com//galaxy/terrains/n/terrain.gif'),(3,'Crater','https://images.swcombine.com//galaxy/terrains/i/terrain.gif'),(4,'Desert','https://images.swcombine.com//galaxy/terrains/b/terrain.gif'),(5,'Forest','https://images.swcombine.com//galaxy/terrains/c/terrain.gif'),(6,'Gas Giant','https://images.swcombine.com//galaxy/terrains/o/terrain.gif'),(7,'Glacier','https://images.swcombine.com//galaxy/terrains/k/terrain.gif'),(8,'Grassland','https://images.swcombine.com//galaxy/terrains/f/terrain.gif'),(9,'Jungle','https://images.swcombine.com//galaxy/terrains/d/terrain.gif'),(10,'Mountain','https://images.swcombine.com//galaxy/terrains/l/terrain.gif'),(11,'Ocean','https://images.swcombine.com//galaxy/terrains/g/terrain.gif'),(12,'River','https://images.swcombine.com//galaxy/terrains/h/terrain.gif'),(13,'Rock','https://images.swcombine.com//galaxy/terrains/j/terrain.gif'),(14,'Sun Terrain','https://images.swcombine.com//galaxy/terrains/z/terrain.gif'),(15,'Swamp','https://images.swcombine.com//galaxy/terrains/e/terrain.gif'),(16,'Volcanic','https://images.swcombine.com//galaxy/terrains/m/terrain.gif');
/*!40000 ALTER TABLE `terrain_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'swc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-24 23:08:27


