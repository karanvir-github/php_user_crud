-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for Linux (x86_64)
--
-- Host: mysql.hostinger.ro    Database: u574849695_22
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `emps`
--
CREATE DATABASE `flighthub`;
USE `flighthub`;
DROP TABLE IF EXISTS `emps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emps`
--

LOCK TABLES `emps` WRITE;
/*!40000 ALTER TABLE `emps` DISABLE KEYS */;
INSERT INTO `emps` VALUES (1,'Major','Dibbert','carter.laverne@example.net','1980-08-04'),(2,'Thurman','Runolfsdottir','mitchell56@example.org','1995-05-16'),(3,'Sherman','Boyer','dooley.timothy@example.net','1995-12-02'),(4,'Keyon','Gerhold','reynolds.brant@example.net','1974-04-29'),(5,'Edison','Zieme','brendon39@example.org','1972-06-01'),(6,'Gardner','Lind','madaline29@example.net','2015-07-07'),(7,'Joel','Reinger','moses52@example.net','1984-12-31'),(8,'Richie','Windler','fabiola53@example.com','2016-11-08'),(9,'Cyril','Langworth','ncorwin@example.org','2016-05-15'),(10,'Kenyon','Greenholt','gulgowski.sandra@example.org','2020-08-29'),(11,'Jacey','Hansen','vincenza.hane@example.org','2017-12-01'),(12,'Gardner','Marvin','donna.kuvalis@example.net','1989-02-06'),(13,'Philip','Purdy','delmer.wiza@example.org','1977-01-06'),(14,'Bobby','Donnelly','cummings.jovani@example.com','1986-09-25'),(15,'Broderick','O\'Reilly','pleffler@example.com','1993-06-30'),(16,'Manuela','Ledner','west.eden@example.org','1989-07-19'),(17,'Robin','Turner','johnson.urban@example.net','2019-03-22'),(18,'Darien','Bradtke','hwalsh@example.org','1993-01-06'),(19,'Alexie','Bins','abdiel41@example.org','1997-08-21'),(20,'Allen','Beatty','tyra84@example.org','1989-07-06'),(21,'Richie','West','wmosciski@example.com','1971-01-18'),(22,'Peter','Spinka','fbergnaum@example.net','2015-02-14'),(23,'Ladarius','Stiedemann','adeline10@example.com','1992-03-21'),(24,'Emilio','Marquardt','pat58@example.com','1979-03-30'),(25,'Carlo','Kreiger','boehm.nigel@example.com','2022-05-02'),(26,'Michale','Witting','zgreenfelder@example.net','1978-10-26'),(27,'Jayson','Kub','marta82@example.com','2008-05-30'),(28,'Isaias','Wolff','brionna74@example.org','1973-04-25'),(29,'Elwin','Swaniawski','gokuneva@example.net','1981-02-28'),(30,'Reece','Dickens','agnes.braun@example.org','1998-04-26'),(31,'Jimmie','Romaguera','jacobs.aurelio@example.com','1980-07-11'),(32,'Jett','Graham','jermaine.casper@example.org','2003-06-01'),(33,'Arvel','Borer','karli09@example.org','2007-11-09'),(34,'Merl','Bashirian','dana15@example.org','1987-10-31'),(35,'Antwon','Bergstrom','wyman.genevieve@example.com','1990-08-08'),(36,'Ethel','Emard','sallie53@example.com','1995-09-13'),(37,'Antonio','Kassulke','lavinia.mueller@example.org','2006-09-24'),(38,'Bruce','Hilpert','dhudson@example.com','1999-01-01'),(39,'Henri','Bechtelar','zakary40@example.net','1989-07-30'),(40,'Cletus','Schimmel','hirthe.stanford@example.org','2012-02-08'),(41,'Jerrell','Lesch','stracke.richie@example.com','2001-10-13'),(42,'Derick','Rosenbaum','halvorson.chance@example.com','1994-09-25'),(43,'Craig','Weimann','selina.langosh@example.net','1973-11-07'),(44,'Claude','Zulauf','abbie71@example.com','1970-02-05'),(45,'Gerardo','Abbott','sofia73@example.org','1996-08-27'),(46,'Devonte','Erdman','gaetano.kshlerin@example.com','1990-12-29'),(47,'Keegan','Cassin','amos.lindgren@example.net','2016-01-19'),(48,'Frederic','Purdy','lemmerich@example.org','1981-04-09'),(49,'Rowan','Beahan','brant47@example.net','2009-05-21'),(50,'Kaleb','Johnson','nzulauf@example.org','2005-10-04'),(51,'Misael','Cassin','ila29@example.net','2018-11-26'),(52,'Dangelo','Sipes','lind.albert@example.org','2007-04-05'),(53,'Rocky','McLaughlin','wolff.robb@example.org','2013-01-06'),(54,'Ronaldo','Fisher','daisy28@example.com','2018-01-25'),(55,'Anderson','Emard','andreane.mcglynn@example.org','2005-05-03'),(56,'Richie','Pfeffer','collins.alexandre@example.org','2022-09-24'),(57,'Faustino','Witting','botsford.wilmer@example.net','2004-02-09'),(58,'Dejon','Thompson','afarrell@example.com','2021-07-07'),(59,'Deangelo','Pfeffer','zfeil@example.net','2013-10-16'),(60,'Felix','Graham','ulockman@example.org','2018-08-02'),(61,'Bradford','Kiehn','lila58@example.org','1985-12-11'),(62,'Brennan','Barrows','devin71@example.org','1993-10-27'),(63,'Osborne','Treutel','mitchel.hickle@example.org','1979-09-28'),(64,'Haley','Bode','bosco.katlyn@example.org','2020-07-15'),(65,'Garret','Lemke','wbashirian@example.net','1979-04-13'),(66,'Mike','Welch','kelsie06@example.com','1983-12-30'),(67,'Rey','Kovacek','dorthy19@example.org','2002-10-12'),(68,'Casimer','Pollich','berta89@example.org','1975-03-23'),(69,'Jarrell','Mraz','gcormier@example.com','2021-10-08'),(70,'Judd','Wunsch','casey36@example.org','2021-08-30'),(71,'Jasen','Hettinger','lhyatt@example.org','1973-10-23'),(72,'Waylon','Muller','christy.waelchi@example.net','1973-02-21'),(73,'Kristoffer','McGlynn','arely80@example.com','2014-02-13'),(74,'Keven','Kunde','laverne.stehr@example.com','1996-02-22'),(75,'Evert','Parisian','rschaefer@example.net','1981-07-22'),(76,'Pietro','Collier','sporer.ariane@example.org','2002-05-13'),(77,'Madyson','Bogisich','anjali43@example.net','2012-04-02'),(78,'Raleigh','Considine','magdalena.moen@example.com','2020-04-22'),(79,'Juwan','DuBuque','obie65@example.com','2006-08-28'),(80,'Gregg','Willms','deckow.roselyn@example.com','2013-07-05'),(81,'Enos','Fritsch','octavia40@example.net','2018-01-23'),(82,'Jennings','Schowalter','rebeca69@example.net','1986-10-29'),(83,'Arely','Schultz','nwalsh@example.com','2010-12-03'),(84,'Jarrett','Jacobs','hschmidt@example.com','1994-02-27'),(85,'Isaias','Cassin','ryan.mclaughlin@example.com','1992-05-05'),(86,'Uriah','Littel','raegan.koelpin@example.com','2016-07-07'),(87,'Spencer','Strosin','misty.maggio@example.com','1970-12-09'),(88,'Thomas','Steuber','christelle00@example.com','1971-09-18'),(89,'Jared','Yost','iabshire@example.org','2020-09-07'),(90,'Oran','Goodwin','felicita.schroeder@example.org','1997-11-22'),(91,'Jeramy','Cormier','keebler.graham@example.net','2002-01-08'),(92,'Jonathan','Farrell','conn.zackary@example.com','1990-03-20'),(93,'Lenny','Larson','madisyn22@example.com','2011-07-15'),(94,'Sid','Goyette','hryan@example.net','1993-10-21'),(95,'Oswaldo','Howell','wilderman.lonnie@example.net','2004-09-14'),(96,'Tyler','Ondricka','hrempel@example.org','2007-04-12'),(97,'Garrick','Treutel','white.candice@example.com','1978-04-01'),(98,'Scot','Hoppe','rowe.jasmin@example.com','2005-03-05'),(99,'Haley','Jacobs','nkuphal@example.com','2006-11-18'),(100,'Arne','Little','daphnee45@example.com','2006-08-30');
/*!40000 ALTER TABLE `emps` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-25 10:06:20
