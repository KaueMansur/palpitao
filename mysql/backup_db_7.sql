-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: palpitao_db
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `jogadores`
--

DROP TABLE IF EXISTS `jogadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jogadores` (
  `id_jogadores` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `foto_perfil` blob DEFAULT NULL,
  `pontos` int(11) DEFAULT 0,
  `colocacao_atual` int(11) DEFAULT 1,
  `pontos_na_rodada` int(11) DEFAULT NULL,
  `reposicionamento` char(1) DEFAULT NULL,
  `adm` tinyint(4) DEFAULT 0,
  `colocacao_anterior` int(11) DEFAULT NULL,
  `titulo_de_posicao` varchar(20) DEFAULT NULL,
  `divida` float DEFAULT 0,
  `cem_porcento` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id_jogadores`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogadores`
--

LOCK TABLES `jogadores` WRITE;
/*!40000 ALTER TABLE `jogadores` DISABLE KEYS */;
INSERT INTO `jogadores` VALUES (1,'Kauê','40bd001563085fc35165329ea1ff5c5ecbdbbeef',NULL,7,8,1,'m',1,8,NULL,11,0,1),(2,'Luizinho',NULL,NULL,8,7,3,'s',1,9,NULL,10.5,0.5,1),(3,'Bruno',NULL,NULL,12,3,1,'m',0,3,NULL,9,0,1),(4,'Derna',NULL,NULL,6,9,0,'d',0,8,NULL,11,0,1),(5,'Léo',NULL,NULL,9,6,1,'m',0,6,NULL,10.5,0,1),(6,'Juliano',NULL,NULL,11,4,3,'s',0,6,NULL,9.5,0.5,1),(7,'Édson Ortiz',NULL,NULL,9,6,3,'s',0,8,NULL,10.5,0.5,1),(8,'Serginho',NULL,NULL,12,3,0,'d',0,2,NULL,9.5,0,1),(9,'Felipe Paixão',NULL,NULL,14,1,3,'s',0,3,'Líder',8.5,0.5,1),(10,'Gustavo Santiago',NULL,NULL,10,5,1,'m',0,5,NULL,9.5,0,1),(11,'Tafarel',NULL,NULL,5,10,0,'d',0,9,NULL,11.5,0,1),(12,'Perdigão',NULL,NULL,8,7,3,'s',0,9,NULL,10.5,0.5,1),(13,'Maninho',NULL,NULL,8,7,1,'m',0,7,NULL,10.5,0,1),(14,'André',NULL,NULL,10,5,1,'m',0,5,NULL,9.5,0,1),(15,'Dalvir',NULL,NULL,12,3,1,'m',0,3,NULL,9,0,1),(16,'Camilo',NULL,NULL,8,7,1,'m',0,7,NULL,10,0,1),(17,'Maurício',NULL,NULL,9,6,1,'m',0,6,NULL,10,0,1),(18,'Paulinho',NULL,NULL,12,3,1,'m',0,3,NULL,9,0,1),(19,'Diomar',NULL,NULL,8,7,1,'m',0,7,NULL,10,0,1),(20,'Zé',NULL,NULL,11,4,1,'m',0,4,NULL,9,0,1),(21,'Alemão',NULL,NULL,10,5,1,'m',0,5,NULL,9.5,0,1),(22,'Didi',NULL,NULL,13,2,0,'d',0,1,NULL,9,0,1),(23,'Xande',NULL,NULL,8,7,0,'d',0,6,NULL,10,0,1),(24,'Chiquinho',NULL,NULL,11,4,0,'d',0,3,NULL,9.5,0,1),(25,'Fábio Macedo',NULL,NULL,0,13,0,'d',0,12,NULL,14,0,0),(26,'Fábio',NULL,NULL,8,7,1,'m',0,7,NULL,10,0,1),(27,'Mano',NULL,NULL,14,1,4,'s',0,4,'Líder',8,0.5,1),(28,'Pancada Boxer',NULL,NULL,3,12,0,'d',0,11,'Lanterna',12.5,0,1),(29,'Edson',NULL,NULL,13,2,3,'s',0,4,NULL,9,0.5,1),(30,'Ailton',NULL,NULL,11,4,1,'m',0,4,NULL,9,0,1),(31,'Lucas Mazin',NULL,NULL,10,5,0,'d',0,4,NULL,10,0,1),(32,'Gabriel Dornelles',NULL,NULL,11,4,1,'m',0,4,NULL,9,0,1),(33,'Juliano Tondim',NULL,NULL,10,5,3,'s',0,7,NULL,10,0.5,1),(34,'Jonas',NULL,NULL,8,7,3,'s',0,9,NULL,10.5,0.5,1),(35,'Chico',NULL,NULL,5,10,0,'d',0,9,NULL,11.5,0,1),(36,'Yuri Ismael',NULL,NULL,4,11,0,'d',0,10,NULL,10,0,1),(37,'Rafael',NULL,NULL,4,11,0,'d',0,10,NULL,12,0,0),(38,'Ederson',NULL,NULL,0,13,0,'d',0,12,NULL,14,0,0);
/*!40000 ALTER TABLE `jogadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jogos_da_rodada`
--

DROP TABLE IF EXISTS `jogos_da_rodada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jogos_da_rodada` (
  `id_jogo` int(11) NOT NULL AUTO_INCREMENT,
  `quantida_gols_casa` int(11) DEFAULT NULL,
  `quantidade_gols_fora` int(11) DEFAULT NULL,
  `resultado_casa` char(1) DEFAULT NULL,
  `time_casa` varchar(40) DEFAULT NULL,
  `time_fora` varchar(40) DEFAULT NULL,
  `id_rodada` int(11) DEFAULT 1,
  `numero_do_jogo` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Em andamento',
  PRIMARY KEY (`id_jogo`),
  KEY `fk_jogos_rodada` (`id_rodada`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jogos_da_rodada`
--

LOCK TABLES `jogos_da_rodada` WRITE;
/*!40000 ALTER TABLE `jogos_da_rodada` DISABLE KEYS */;
INSERT INTO `jogos_da_rodada` VALUES (1,NULL,NULL,NULL,'Avenida','Grêmio',1,1,'Encerrada'),(2,NULL,NULL,NULL,'Inter','Novo Hamburgo',1,2,'Encerrada'),(3,NULL,NULL,NULL,'Grêmio','São José',2,1,'Encerrada'),(4,NULL,NULL,NULL,'Monsoon','Inter',2,2,'Encerrada'),(5,NULL,NULL,NULL,'Grêmio','São Luiz',3,1,'Encerrada'),(6,NULL,NULL,NULL,'Ypiranga','Inter',3,2,'Encerrada'),(7,NULL,NULL,NULL,'Inter','Inter(SM)',4,1,'Encerrada'),(8,NULL,NULL,NULL,'Guarany','Grêmio',4,2,'Encerrada'),(9,NULL,NULL,NULL,'Inter','Grêmio',5,1,'Encerrada'),(10,NULL,NULL,NULL,'Inter','Atlético PR',6,1,'Encerrada'),(11,NULL,NULL,NULL,'Fluminense','Grêmio',6,2,'Encerrada'),(12,NULL,NULL,NULL,'Grêmio','Juventude',7,1,'Em Andamento'),(13,NULL,NULL,NULL,'Caxias','Inter',7,2,'Em Andamento');
/*!40000 ALTER TABLE `jogos_da_rodada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `valor` float NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_jogador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagamento`),
  KEY `fk_pagamentos_jogadores` (`id_jogador`),
  CONSTRAINT `fk_pagamentos_jogadores` FOREIGN KEY (`id_jogador`) REFERENCES `jogadores` (`id_jogadores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `palpites`
--

DROP TABLE IF EXISTS `palpites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `palpites` (
  `id_palpites` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade_gols_casa` int(11) DEFAULT NULL,
  `quantidade_gols_fora` int(11) DEFAULT NULL,
  `resultado_casa` char(1) DEFAULT NULL,
  `time_casa` varchar(30) DEFAULT NULL,
  `time_fora` varchar(30) DEFAULT NULL,
  `id_jogadores` int(11) DEFAULT NULL,
  `id_jogos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_palpites`),
  KEY `fk_palpites_jogadores` (`id_jogadores`),
  KEY `fk_palpites_jogos` (`id_jogos`),
  CONSTRAINT `fk_palpites_jogadores` FOREIGN KEY (`id_jogadores`) REFERENCES `jogadores` (`id_jogadores`),
  CONSTRAINT `fk_palpites_jogos` FOREIGN KEY (`id_jogos`) REFERENCES `jogos_da_rodada` (`id_jogo`)
) ENGINE=InnoDB AUTO_INCREMENT=446 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `palpites`
--

LOCK TABLES `palpites` WRITE;
/*!40000 ALTER TABLE `palpites` DISABLE KEYS */;
INSERT INTO `palpites` VALUES (1,1,2,'D','Avenida','Grêmio',3,1),(2,2,1,'V','Inter','Novo Hamburgo',3,2),(3,0,2,'D','Avenida','Grêmio',16,1),(4,3,0,'V','Inter','Novo Hamburgo',16,2),(5,1,1,'E','Avenida','Grêmio',1,1),(6,1,1,'E','Inter','Novo Hamburgo',1,2),(7,0,3,'D','Avenida','Grêmio',31,1),(8,2,1,'V','Inter','Novo Hamburgo',31,2),(9,1,2,'D','Avenida','Grêmio',27,1),(10,1,0,'V','Inter','Novo Hamburgo',27,2),(11,2,1,'V','Avenida','Grêmio',12,1),(12,1,0,'V','Inter','Novo Hamburgo',12,2),(13,0,2,'D','Avenida','Grêmio',23,1),(14,1,0,'V','Inter','Novo Hamburgo',23,2),(15,1,2,'D','Avenida','Grêmio',30,1),(16,2,1,'V','Inter','Novo Hamburgo',30,2),(17,0,3,'D','Avenida','Grêmio',35,1),(18,1,1,'E','Inter','Novo Hamburgo',35,2),(19,1,2,'D','Avenida','Grêmio',24,1),(20,1,0,'V','Inter','Novo Hamburgo',24,2),(21,1,2,'D','Avenida','Grêmio',15,1),(22,2,1,'V','Inter','Novo Hamburgo',15,2),(23,0,2,'D','Avenida','Grêmio',4,1),(24,1,0,'V','Inter','Novo Hamburgo',4,2),(25,0,2,'D','Avenida','Grêmio',22,1),(26,2,1,'V','Inter','Novo Hamburgo',22,2),(27,0,3,'D','Avenida','Grêmio',19,1),(28,3,0,'V','Inter','Novo Hamburgo',19,2),(29,0,3,'D','Avenida','Grêmio',29,1),(30,3,0,'V','Inter','Novo Hamburgo',29,2),(31,0,2,'D','Avenida','Grêmio',26,1),(32,2,0,'V','Inter','Novo Hamburgo',26,2),(33,0,1,'D','Avenida','Grêmio',9,1),(34,2,0,'V','Inter','Novo Hamburgo',9,2),(35,0,2,'D','Avenida','Grêmio',32,1),(36,3,0,'V','Inter','Novo Hamburgo',32,2),(37,1,1,'E','Avenida','Grêmio',5,1),(38,2,1,'V','Inter','Novo Hamburgo',5,2),(39,1,2,'D','Avenida','Grêmio',2,1),(40,2,0,'V','Inter','Novo Hamburgo',2,2),(41,0,2,'D','Avenida','Grêmio',13,1),(42,2,0,'V','Inter','Novo Hamburgo',13,2),(43,1,2,'D','Avenida','Grêmio',18,1),(44,2,1,'V','Inter','Novo Hamburgo',18,2),(45,0,2,'D','Avenida','Grêmio',37,1),(46,1,0,'V','Inter','Novo Hamburgo',37,2),(47,1,2,'D','Avenida','Grêmio',8,1),(48,0,0,'E','Inter','Novo Hamburgo',8,2),(49,1,1,'E','Avenida','Grêmio',11,1),(50,1,1,'E','Inter','Novo Hamburgo',11,2),(51,0,2,'D','Avenida','Grêmio',21,1),(52,2,0,'V','Inter','Novo Hamburgo',21,2),(53,0,1,'D','Avenida','Grêmio',14,1),(54,1,0,'V','Inter','Novo Hamburgo',14,2),(55,1,1,'E','Avenida','Grêmio',7,1),(56,1,1,'E','Inter','Novo Hamburgo',7,2),(57,1,2,'D','Avenida','Grêmio',10,1),(58,1,0,'V','Inter','Novo Hamburgo',10,2),(59,1,3,'D','Avenida','Grêmio',34,1),(60,4,1,'V','Inter','Novo Hamburgo',34,2),(61,0,2,'D','Avenida','Grêmio',6,1),(62,1,1,'E','Inter','Novo Hamburgo',6,2),(63,0,2,'D','Avenida','Grêmio',33,1),(64,2,1,'V','Inter','Novo Hamburgo',33,2),(65,0,2,'D','Avenida','Grêmio',17,1),(66,2,1,'V','Inter','Novo Hamburgo',17,2),(67,1,3,'D','Avenida','Grêmio',20,1),(68,2,1,'V','Inter','Novo Hamburgo',20,2),(69,2,1,'V','Grêmio','São José',30,3),(70,1,3,'D','Monsoon','Inter',30,4),(71,3,1,'V','Grêmio','São José',3,3),(72,1,2,'D','Monsoon','Inter',3,4),(73,3,1,'V','Grêmio','São José',15,3),(74,1,2,'D','Monsoon','Inter',15,4),(75,2,1,'V','Grêmio','São José',22,3),(76,0,1,'D','Monsoon','Inter',22,4),(77,2,0,'V','Grêmio','São José',33,3),(78,1,1,'E','Monsoon','Inter',33,4),(79,4,0,'V','Grêmio','São José',31,3),(80,0,2,'D','Monsoon','Inter',31,4),(81,3,0,'V','Grêmio','São José',17,3),(82,1,3,'D','Monsoon','Inter',17,4),(83,2,1,'V','Grêmio','São José',18,3),(84,1,1,'E','Monsoon','Inter',18,4),(85,2,1,'V','Grêmio','São José',20,3),(86,1,2,'D','Monsoon','Inter',20,4),(87,3,1,'V','Grêmio','São José',5,3),(88,0,1,'D','Monsoon','Inter',5,4),(89,2,1,'V','Grêmio','São José',21,3),(90,0,2,'D','Monsoon','Inter',21,4),(91,2,1,'V','Grêmio','São José',14,3),(92,0,1,'D','Monsoon','Inter',14,4),(93,4,0,'V','Grêmio','São José',16,3),(94,1,3,'D','Monsoon','Inter',16,4),(95,3,0,'V','Grêmio','São José',24,3),(96,0,1,'D','Monsoon','Inter',24,4),(97,2,0,'V','Grêmio','São José',4,3),(98,1,1,'E','Monsoon','Inter',4,4),(99,3,0,'V','Grêmio','São José',19,3),(100,0,3,'D','Monsoon','Inter',19,4),(101,3,1,'V','Grêmio','São José',29,3),(102,0,2,'D','Monsoon','Inter',29,4),(103,3,0,'V','Grêmio','São José',26,3),(104,1,2,'D','Monsoon','Inter',26,4),(105,2,0,'V','Grêmio','São José',9,3),(106,0,1,'D','Monsoon','Inter',9,4),(107,3,0,'V','Grêmio','São José',32,3),(108,0,2,'D','Monsoon','Inter',32,4),(109,3,0,'V','Grêmio','São José',10,3),(110,0,2,'D','Monsoon','Inter',10,4),(111,2,0,'V','Grêmio','São José',34,3),(112,0,1,'D','Monsoon','Inter',34,4),(113,3,0,'V','Grêmio','São José',2,3),(114,1,0,'V','Monsoon','Inter',2,4),(115,3,0,'V','Grêmio','São José',13,3),(116,1,1,'E','Monsoon','Inter',13,4),(117,2,0,'V','Grêmio','São José',27,3),(118,0,1,'D','Monsoon','Inter',27,4),(119,2,0,'V','Grêmio','São José',37,3),(120,1,2,'D','Monsoon','Inter',37,4),(121,2,0,'V','Grêmio','São José',23,3),(122,0,1,'D','Monsoon','Inter',23,4),(123,4,0,'V','Grêmio','São José',35,3),(124,0,2,'D','Monsoon','Inter',35,4),(125,4,0,'V','Grêmio','São José',6,3),(126,1,2,'D','Monsoon','Inter',6,4),(127,2,0,'V','Grêmio','São José',12,3),(128,0,2,'D','Monsoon','Inter',12,4),(129,3,1,'V','Grêmio','São José',8,3),(130,1,2,'D','Monsoon','Inter',8,4),(131,2,0,'V','Grêmio','São José',7,3),(132,0,1,'D','Monsoon','Inter',7,4),(133,3,0,'V','Grêmio','São José',1,3),(134,1,2,'D','Monsoon','Inter',1,4),(135,3,1,'V','Grêmio','São José',28,3),(136,1,1,'E','Monsoon','Inter',28,4),(137,2,1,'V','Grêmio','São José',11,3),(138,1,3,'D','Monsoon','Inter',11,4),(139,3,0,'V','Grêmio','São José',36,3),(140,0,3,'D','Monsoon','Inter',36,4),(141,2,1,'V','Grêmio','São Luiz',3,5),(142,1,2,'D','Ypiranga','Inter',3,6),(143,3,1,'V','Grêmio','São Luiz',15,5),(144,1,2,'D','Ypiranga','Inter',15,6),(145,2,1,'V','Grêmio','São Luiz',22,5),(146,0,2,'D','Ypiranga','Inter',22,6),(147,3,0,'V','Grêmio','São Luiz',31,5),(148,1,3,'D','Ypiranga','Inter',31,6),(149,3,1,'V','Grêmio','São Luiz',20,5),(150,1,2,'D','Ypiranga','Inter',20,6),(151,3,0,'V','Grêmio','São Luiz',5,5),(152,1,2,'D','Ypiranga','Inter',5,6),(153,2,1,'V','Grêmio','São Luiz',14,5),(154,1,2,'D','Ypiranga','Inter',14,6),(155,2,0,'V','Grêmio','São Luiz',16,5),(156,0,3,'D','Ypiranga','Inter',16,6),(157,4,0,'V','Grêmio','São Luiz',19,5),(158,0,3,'D','Ypiranga','Inter',19,6),(159,3,0,'V','Grêmio','São Luiz',26,5),(160,1,3,'D','Ypiranga','Inter',26,6),(161,3,0,'V','Grêmio','São Luiz',32,5),(162,0,2,'D','Ypiranga','Inter',32,6),(163,2,0,'V','Grêmio','São Luiz',27,5),(164,1,2,'D','Ypiranga','Inter',27,6),(165,2,0,'V','Grêmio','São Luiz',23,5),(166,1,0,'V','Ypiranga','Inter',23,6),(167,3,0,'V','Grêmio','São Luiz',2,5),(168,1,2,'D','Ypiranga','Inter',2,6),(169,4,0,'V','Grêmio','São Luiz',12,5),(170,0,2,'D','Ypiranga','Inter',12,6),(171,2,0,'V','Grêmio','São Luiz',8,5),(172,0,2,'D','Ypiranga','Inter',8,6),(173,2,0,'V','Grêmio','São Luiz',1,5),(174,1,2,'D','Ypiranga','Inter',1,6),(175,3,0,'V','Grêmio','São Luiz',36,5),(176,1,1,'E','Ypiranga','Inter',36,6),(177,5,1,'V','Grêmio','São Luiz',28,5),(178,2,2,'E','Ypiranga','Inter',28,6),(179,2,0,'V','Grêmio','São Luiz',30,5),(180,0,1,'D','Ypiranga','Inter',30,6),(181,3,1,'V','Grêmio','São Luiz',17,5),(182,1,3,'D','Ypiranga','Inter',17,6),(183,3,0,'V','Grêmio','São Luiz',33,5),(184,0,1,'D','Ypiranga','Inter',33,6),(185,2,1,'V','Grêmio','São Luiz',24,5),(186,0,1,'D','Ypiranga','Inter',24,6),(187,2,1,'V','Grêmio','São Luiz',29,5),(188,2,2,'E','Ypiranga','Inter',29,6),(189,3,0,'V','Grêmio','São Luiz',9,5),(190,0,1,'D','Ypiranga','Inter',9,6),(191,3,0,'V','Grêmio','São Luiz',10,5),(192,1,3,'D','Ypiranga','Inter',10,6),(193,3,0,'V','Grêmio','São Luiz',37,5),(194,0,2,'D','Ypiranga','Inter',37,6),(195,4,0,'V','Grêmio','São Luiz',35,5),(196,1,1,'E','Ypiranga','Inter',35,6),(197,3,0,'V','Grêmio','São Luiz',4,5),(198,1,0,'V','Ypiranga','Inter',4,6),(199,3,0,'V','Grêmio','São Luiz',6,5),(200,1,3,'D','Ypiranga','Inter',6,6),(201,3,0,'V','Grêmio','São Luiz',13,5),(202,1,2,'D','Ypiranga','Inter',13,6),(203,2,0,'V','Grêmio','São Luiz',11,5),(204,1,2,'D','Ypiranga','Inter',11,6),(205,4,1,'V','Inter','Inter(SM)',30,7),(206,1,2,'D','Guarany','Grêmio',30,8),(207,2,1,'V','Inter','Inter(SM)',3,7),(208,1,2,'D','Guarany','Grêmio',3,8),(209,3,1,'V','Inter','Inter(SM)',15,7),(210,1,2,'D','Guarany','Grêmio',15,8),(211,3,1,'V','Inter','Inter(SM)',22,7),(212,0,2,'D','Guarany','Grêmio',22,8),(213,2,1,'V','Inter','Inter(SM)',31,7),(214,0,2,'D','Guarany','Grêmio',31,8),(215,3,1,'V','Inter','Inter(SM)',17,7),(216,0,4,'D','Guarany','Grêmio',17,8),(217,3,1,'V','Inter','Inter(SM)',20,7),(218,1,2,'D','Guarany','Grêmio',20,8),(219,3,1,'V','Inter','Inter(SM)',33,7),(220,0,1,'D','Guarany','Grêmio',33,8),(221,2,0,'V','Inter','Inter(SM)',5,7),(222,1,1,'E','Guarany','Grêmio',5,8),(223,1,0,'V','Inter','Inter(SM)',23,7),(224,1,2,'D','Guarany','Grêmio',23,8),(225,2,1,'V','Inter','Inter(SM)',14,7),(226,1,2,'D','Guarany','Grêmio',14,8),(227,3,0,'V','Inter','Inter(SM)',16,7),(228,0,4,'D','Guarany','Grêmio',16,8),(229,2,0,'V','Inter','Inter(SM)',24,7),(230,0,2,'D','Guarany','Grêmio',24,8),(231,3,0,'V','Inter','Inter(SM)',4,7),(232,1,2,'D','Guarany','Grêmio',4,8),(233,3,0,'V','Inter','Inter(SM)',19,7),(234,0,3,'D','Guarany','Grêmio',19,8),(235,2,0,'V','Inter','Inter(SM)',29,7),(236,0,2,'D','Guarany','Grêmio',29,8),(237,4,0,'V','Inter','Inter(SM)',26,7),(238,1,3,'D','Guarany','Grêmio',26,8),(239,2,0,'V','Inter','Inter(SM)',9,7),(240,0,2,'D','Guarany','Grêmio',9,8),(241,4,0,'V','Inter','Inter(SM)',32,7),(242,1,1,'E','Guarany','Grêmio',32,8),(243,3,0,'V','Inter','Inter(SM)',10,7),(244,1,3,'D','Guarany','Grêmio',10,8),(245,2,0,'V','Inter','Inter(SM)',27,7),(246,1,2,'D','Guarany','Grêmio',27,8),(247,2,1,'V','Inter','Inter(SM)',18,7),(248,1,3,'D','Guarany','Grêmio',18,8),(249,2,0,'V','Inter','Inter(SM)',21,7),(250,0,4,'D','Guarany','Grêmio',21,8),(251,3,0,'V','Inter','Inter(SM)',35,7),(252,1,3,'D','Guarany','Grêmio',35,8),(253,3,0,'V','Inter','Inter(SM)',34,7),(254,0,4,'D','Guarany','Grêmio',34,8),(255,4,0,'V','Inter','Inter(SM)',6,7),(256,1,2,'D','Guarany','Grêmio',6,8),(257,3,0,'V','Inter','Inter(SM)',2,7),(258,0,1,'D','Guarany','Grêmio',2,8),(259,3,1,'V','Inter','Inter(SM)',13,7),(260,0,2,'D','Guarany','Grêmio',13,8),(261,6,0,'V','Inter','Inter(SM)',12,7),(262,1,1,'E','Guarany','Grêmio',12,8),(263,2,0,'V','Inter','Inter(SM)',8,7),(264,0,2,'D','Guarany','Grêmio',8,8),(265,2,1,'V','Inter','Inter(SM)',1,7),(266,0,2,'D','Guarany','Grêmio',1,8),(267,4,1,'V','Inter','Inter(SM)',11,7),(268,1,2,'D','Guarany','Grêmio',11,8),(269,4,0,'V','Inter','Inter(SM)',36,7),(270,1,3,'D','Guarany','Grêmio',36,8),(271,3,0,'V','Inter','Inter(SM)',7,7),(272,0,2,'D','Guarany','Grêmio',7,8),(273,2,1,'V','Inter','Inter(SM)',28,7),(274,1,2,'D','Guarany','Grêmio',28,8),(275,1,2,'D','Inter','Grêmio',24,9),(276,1,1,'E','Inter','Grêmio',22,9),(277,1,2,'D','Inter','Grêmio',29,9),(278,1,1,'E','Inter','Grêmio',9,9),(279,1,3,'D','Inter','Grêmio',31,9),(280,1,2,'D','Inter','Grêmio',8,9),(281,1,2,'D','Inter','Grêmio',30,9),(282,1,3,'D','Inter','Grêmio',3,9),(283,2,2,'E','Inter','Grêmio',15,9),(284,1,1,'E','Inter','Grêmio',5,9),(285,1,0,'V','Inter','Grêmio',27,9),(286,1,3,'D','Inter','Grêmio',17,9),(287,2,1,'V','Inter','Grêmio',20,9),(288,2,1,'V','Inter','Grêmio',21,9),(289,1,2,'D','Inter','Grêmio',33,9),(290,0,2,'D','Inter','Grêmio',13,9),(291,1,4,'D','Inter','Grêmio',23,9),(292,0,1,'D','Inter','Grêmio',14,9),(293,2,2,'E','Inter','Grêmio',16,9),(294,0,2,'D','Inter','Grêmio',4,9),(295,0,2,'D','Inter','Grêmio',19,9),(296,1,1,'E','Inter','Grêmio',26,9),(297,1,1,'E','Inter','Grêmio',10,9),(298,0,2,'D','Inter','Grêmio',1,9),(299,2,1,'V','Inter','Grêmio',18,9),(300,1,3,'D','Inter','Grêmio',35,9),(301,1,1,'E','Inter','Grêmio',7,9),(302,2,0,'V','Inter','Grêmio',32,9),(303,0,1,'D','Inter','Grêmio',34,9),(304,0,1,'D','Inter','Grêmio',6,9),(305,0,4,'D','Inter','Grêmio',2,9),(306,1,1,'E','Inter','Grêmio',12,9),(307,1,1,'E','Inter','Grêmio',11,9),(308,1,2,'D','Inter','Grêmio',36,9),(309,2,2,'E','Inter','Grêmio',28,9),(310,2,0,'V','Inter','Atlético PR',24,10),(311,2,0,'V','Fluminense','Grêmio',24,11),(312,2,0,'V','Inter','Atlético PR',22,10),(313,2,1,'V','Fluminense','Grêmio',22,11),(314,1,0,'V','Inter','Atlético PR',29,10),(315,0,1,'D','Fluminense','Grêmio',29,11),(316,1,0,'V','Inter','Atlético PR',9,10),(317,1,0,'V','Fluminense','Grêmio',9,11),(318,2,0,'V','Inter','Atlético PR',31,10),(319,1,1,'E','Fluminense','Grêmio',31,11),(320,2,1,'V','Inter','Atlético PR',27,10),(321,1,1,'E','Fluminense','Grêmio',27,11),(322,3,1,'V','Inter','Atlético PR',20,10),(323,2,2,'E','Fluminense','Grêmio',20,11),(324,2,0,'V','Inter','Atlético PR',21,10),(325,1,1,'E','Fluminense','Grêmio',21,11),(326,2,0,'V','Inter','Atlético PR',8,10),(327,2,1,'V','Fluminense','Grêmio',8,11),(328,1,2,'D','Inter','Atlético PR',30,10),(329,3,1,'V','Fluminense','Grêmio',30,11),(330,2,1,'V','Inter','Atlético PR',3,10),(331,2,1,'V','Fluminense','Grêmio',3,11),(332,2,1,'V','Inter','Atlético PR',15,10),(333,2,1,'V','Fluminense','Grêmio',15,11),(334,2,0,'V','Inter','Atlético PR',5,10),(335,2,2,'E','Fluminense','Grêmio',5,11),(336,2,1,'V','Inter','Atlético PR',17,10),(337,1,2,'D','Fluminense','Grêmio',17,11),(338,2,1,'V','Inter','Atlético PR',18,10),(339,2,1,'V','Fluminense','Grêmio',18,11),(340,2,0,'V','Inter','Atlético PR',32,10),(341,2,1,'V','Fluminense','Grêmio',32,11),(342,2,1,'V','Inter','Atlético PR',33,10),(343,1,1,'E','Fluminense','Grêmio',33,11),(344,3,1,'V','Inter','Atlético PR',13,10),(345,2,2,'E','Fluminense','Grêmio',13,11),(346,1,1,'E','Inter','Atlético PR',23,10),(347,1,0,'V','Fluminense','Grêmio',23,11),(348,1,0,'V','Inter','Atlético PR',14,10),(349,2,1,'V','Fluminense','Grêmio',14,11),(350,2,0,'V','Inter','Atlético PR',16,10),(351,2,0,'V','Fluminense','Grêmio',16,11),(352,2,0,'V','Inter','Atlético PR',4,10),(353,1,1,'E','Fluminense','Grêmio',4,11),(354,3,0,'V','Inter','Atlético PR',19,10),(355,3,0,'V','Fluminense','Grêmio',19,11),(356,2,0,'V','Inter','Atlético PR',26,10),(357,3,1,'V','Fluminense','Grêmio',26,11),(358,3,1,'V','Inter','Atlético PR',10,10),(359,2,1,'V','Fluminense','Grêmio',10,11),(360,2,0,'V','Inter','Atlético PR',1,10),(361,2,2,'E','Fluminense','Grêmio',1,11),(362,2,1,'V','Inter','Atlético PR',35,10),(363,1,1,'E','Fluminense','Grêmio',35,11),(364,2,1,'V','Inter','Atlético PR',7,10),(365,2,0,'V','Fluminense','Grêmio',7,11),(366,1,0,'V','Inter','Atlético PR',34,10),(367,1,1,'E','Fluminense','Grêmio',34,11),(368,1,1,'E','Inter','Atlético PR',6,10),(369,2,1,'V','Fluminense','Grêmio',6,11),(370,1,1,'E','Inter','Atlético PR',2,10),(371,1,1,'E','Fluminense','Grêmio',2,11),(372,2,1,'V','Inter','Atlético PR',12,10),(373,2,0,'V','Fluminense','Grêmio',12,11),(374,2,0,'V','Inter','Atlético PR',11,10),(375,2,0,'V','Fluminense','Grêmio',11,11),(376,2,0,'V','Inter','Atlético PR',36,10),(377,1,2,'D','Fluminense','Grêmio',36,11),(378,2,1,'V','Inter','Atlético PR',28,10),(379,1,2,'D','Fluminense','Grêmio',28,11),(380,2,1,'V','Grêmio','Juventude',22,12),(381,1,1,'E','Caxias','Inter',22,13),(382,3,1,'V','Grêmio','Juventude',8,12),(383,1,1,'E','Caxias','Inter',8,13),(384,2,1,'V','Grêmio','Juventude',3,12),(385,1,2,'D','Caxias','Inter',3,13),(386,3,1,'V','Grêmio','Juventude',15,12),(387,1,2,'D','Caxias','Inter',15,13),(388,2,1,'V','Grêmio','Juventude',18,12),(389,1,2,'D','Caxias','Inter',18,13),(390,2,1,'V','Grêmio','Juventude',29,12),(391,0,1,'D','Caxias','Inter',29,13),(392,3,1,'V','Grêmio','Juventude',32,12),(393,0,2,'D','Caxias','Inter',32,13),(394,1,1,'E','Grêmio','Juventude',27,12),(395,1,2,'D','Caxias','Inter',27,13),(396,2,1,'V','Grêmio','Juventude',20,12),(397,1,2,'D','Caxias','Inter',20,13),(398,2,1,'V','Grêmio','Juventude',14,12),(399,1,2,'D','Caxias','Inter',14,13),(400,2,1,'V','Grêmio','Juventude',10,12),(401,1,2,'D','Caxias','Inter',10,13),(402,1,1,'E','Grêmio','Juventude',6,12),(403,1,0,'V','Caxias','Inter',6,13),(404,2,1,'V','Grêmio','Juventude',5,12),(405,1,2,'D','Caxias','Inter',5,13),(406,3,1,'V','Grêmio','Juventude',17,12),(407,1,2,'D','Caxias','Inter',17,13),(408,2,0,'V','Grêmio','Juventude',23,12),(409,1,0,'V','Caxias','Inter',23,13),(410,2,0,'V','Grêmio','Juventude',16,12),(411,0,2,'D','Caxias','Inter',16,13),(412,3,1,'V','Grêmio','Juventude',19,12),(413,1,2,'D','Caxias','Inter',19,13),(414,2,1,'V','Grêmio','Juventude',26,12),(415,1,2,'D','Caxias','Inter',26,13),(416,2,1,'V','Grêmio','Juventude',4,12),(417,1,1,'E','Caxias','Inter',4,13),(418,2,1,'V','Grêmio','Juventude',35,12),(419,1,0,'V','Caxias','Inter',35,13),(420,1,1,'E','Grêmio','Juventude',34,12),(421,1,1,'E','Caxias','Inter',34,13),(422,2,0,'V','Grêmio','Juventude',2,12),(423,0,1,'D','Caxias','Inter',2,13),(424,1,1,'E','Grêmio','Juventude',12,12),(425,2,1,'V','Caxias','Inter',12,13),(426,2,0,'V','Grêmio','Juventude',11,12),(427,1,1,'E','Caxias','Inter',11,13),(428,2,0,'V','Grêmio','Juventude',36,12),(429,1,0,'V','Caxias','Inter',36,13),(430,1,0,'V','Grêmio','Juventude',9,12),(431,0,1,'D','Caxias','Inter',9,13),(432,3,1,'V','Grêmio','Juventude',30,12),(433,0,2,'D','Caxias','Inter',30,13),(434,1,0,'V','Grêmio','Juventude',31,12),(435,1,1,'E','Caxias','Inter',31,13),(436,2,1,'V','Grêmio','Juventude',21,12),(437,1,2,'D','Caxias','Inter',21,13),(438,1,1,'E','Grêmio','Juventude',33,12),(439,1,1,'E','Caxias','Inter',33,13),(440,3,0,'V','Grêmio','Juventude',13,12),(441,1,2,'D','Caxias','Inter',13,13),(442,2,1,'V','Grêmio','Juventude',7,12),(443,0,1,'D','Caxias','Inter',7,13),(444,2,0,'V','Grêmio','Juventude',1,12),(445,1,2,'D','Caxias','Inter',1,13);
/*!40000 ALTER TABLE `palpites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-01  9:49:14
