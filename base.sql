-- MariaDB dump 10.19  Distrib 10.8.3-MariaDB, for osx10.17 (x86_64)
--
-- Host: localhost    Database: timtim
-- ------------------------------------------------------
-- Server version	10.8.3-MariaDB

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
-- Table structure for table `boitMessagerie`
--

DROP TABLE IF EXISTS `boitMessagerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boitMessagerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` varchar(45) NOT NULL,
  `recevorId` varchar(45) NOT NULL,
  `sujet_message` varchar(255) NOT NULL,
  `lastBoxDate` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boitMessagerie`
--

LOCK TABLES `boitMessagerie` WRITE;
/*!40000 ALTER TABLE `boitMessagerie` DISABLE KEYS */;
INSERT INTO `boitMessagerie` VALUES
(1,'12','17','Test Messagerie','1671659948'),
(2,'12','17','Suite de notre conversation','1671734277'),
(3,'12','17','Suite de notre conversation','1671603057'),
(4,'22','17','sdfsfsdfsdf','1673769513'),
(5,'22','17','wcwcwxcwc','1671693909'),
(6,'17','18','Sujet basket','1671736107'),
(7,'22','12','sfsdsfsdfsd','1671737278'),
(8,'22','12','fhffhf','1671737319'),
(9,'22','17','fjhfghjfjfg','1672435020'),
(10,'12','17','Test Admin','1671777316');
/*!40000 ALTER TABLE `boitMessagerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonusLogin`
--

DROP TABLE IF EXISTS `bonusLogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonusLogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `winner` varchar(250) NOT NULL,
  `actif` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonusLogin`
--

LOCK TABLES `bonusLogin` WRITE;
/*!40000 ALTER TABLE `bonusLogin` DISABLE KEYS */;
INSERT INTO `bonusLogin` VALUES
(3,'0.10','','',0);
/*!40000 ALTER TABLE `bonusLogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boutique`
--

DROP TABLE IF EXISTS `boutique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boutique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorieId` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `actif` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boutique`
--

LOCK TABLES `boutique` WRITE;
/*!40000 ALTER TABLE `boutique` DISABLE KEYS */;
INSERT INTO `boutique` VALUES
(1,1,'Virement Bancaire','images/magasin/virement bancaire.png',1),
(2,2,'Amazon','images/magasin/amazon.jpg',1),
(3,2,'google play','images/magasin/googleplay.jpg',1),
(4,2,'Itunes','images/magasin/itunes.jpg',1),
(5,2,'Psn','images/magasin/psn.jpg',1),
(6,2,'Xbox','images/magasin/xbox.jpg',1),
(7,2,'Zalando','images/magasin/zalando.jpg',1),
(8,2,'Paysafecard','images/magasin/paysafecard.jpg',1),
(12,1,'Paypal','images/magasin/paypal.jpg',1),
(13,3,'AWcode','http://www.multi-cadeaux.com/images/magasin/awcode.jpg',1),
(14,3,'NewPack','http://www.multi-cadeaux.com/images/magasin/newpack.png',1),
(15,3,'CaraPass','http://www.multi-cadeaux.com/images/magasin/carapass.png',1);
/*!40000 ALTER TABLE `boutique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boutiqueMontant`
--

DROP TABLE IF EXISTS `boutiqueMontant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boutiqueMontant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boutiqueId` int(11) NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boutiqueMontant`
--

LOCK TABLES `boutiqueMontant` WRITE;
/*!40000 ALTER TABLE `boutiqueMontant` DISABLE KEYS */;
INSERT INTO `boutiqueMontant` VALUES
(2,2,10.00),
(3,2,20.00),
(6,4,10.00),
(7,4,20.00),
(8,8,10.00),
(10,5,10.00),
(11,5,20.00),
(12,6,10.00),
(13,6,20.00),
(14,7,10.00),
(15,7,20.00),
(16,5,50.00),
(17,3,15.00),
(18,3,25.00),
(19,3,50.00),
(20,6,5.00),
(21,6,15.00),
(22,6,25.00),
(23,6,30.00),
(24,1,10.00),
(25,1,20.00),
(26,9,20.00),
(27,9,30.00),
(28,9,40.00),
(29,9,50.00),
(30,10,10.00),
(31,10,20.00),
(32,10,25.00),
(33,10,30.00),
(34,1,10.00),
(35,10,5.00),
(36,11,5.00),
(37,11,10.00),
(38,11,15.00),
(39,11,20.00),
(40,11,1.00),
(41,11,2.00),
(42,11,3.00),
(43,1,1.00),
(44,12,1.00),
(45,12,5.00),
(46,12,10.00),
(47,12,10.00),
(48,12,20.00),
(49,13,1.30),
(50,14,1.50),
(51,15,1.00);
/*!40000 ALTER TABLE `boutiqueMontant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boutiquecategorie`
--

DROP TABLE IF EXISTS `boutiquecategorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boutiquecategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boutiquecategorie`
--

LOCK TABLES `boutiquecategorie` WRITE;
/*!40000 ALTER TABLE `boutiquecategorie` DISABLE KEYS */;
INSERT INTO `boutiquecategorie` VALUES
(1,'Paiement'),
(2,'Carte-Cadeaux'),
(3,'Code jeux');
/*!40000 ALTER TABLE `boutiquecategorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concours`
--

DROP TABLE IF EXISTS `concours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `actif` int(11) NOT NULL,
  `gagnant1` varchar(250) NOT NULL,
  `gagnant2` varchar(250) NOT NULL,
  `gagnant3` varchar(250) NOT NULL,
  `gagnant4` varchar(250) NOT NULL,
  `gagnant5` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concours`
--

LOCK TABLES `concours` WRITE;
/*!40000 ALTER TABLE `concours` DISABLE KEYS */;
INSERT INTO `concours` VALUES
(1,'Concours Missions','concours du 02.06.2018 au 31.07.2018 12h00','2018-06-02 21:00:00','2018-07-31 12:15:00',0,'30.00','20.00','10.00','5.00','5.00'),
(2,'Concours Offerwalls','Le concours du 28.08.2018 au 28.10.2018  \r\nIl vous reste 10 jours pour le concours!!!!\r\nAttention: les membres qui atteindrons pas les gains proposer auront pas de gains Merci\r\n','2018-08-28 16:00:00','2018-10-28 23:59:00',0,'60.00','40.00','30.00','20.00','10.00'),
(3,'Concours Parrainage','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,'','','','','');
/*!40000 ALTER TABLE `concours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connectes`
--

DROP TABLE IF EXISTS `connectes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connectes` (
  `ip` varchar(250) NOT NULL,
  `timestamp` varchar(250) NOT NULL,
  `idUser` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connectes`
--

LOCK TABLES `connectes` WRITE;
/*!40000 ALTER TABLE `connectes` DISABLE KEYS */;
INSERT INTO `connectes` VALUES
('127.0.0.1','1674567578','sMayVic4vFY882OMUuIfN51tS');
/*!40000 ALTER TABLE `connectes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcoupon` varchar(50) DEFAULT NULL,
  `typecoupon` varchar(32) NOT NULL DEFAULT 'Code',
  `nom` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `description2` mediumtext DEFAULT NULL,
  `pays` varchar(250) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT 0,
  `actif` int(11) NOT NULL DEFAULT 0,
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES
(1,'1','coupon','lorem','upsom','dolores','&lt;p&gt;Dolore nulla dolore est consequat in incididunt irure exercitation. Nostrud velit duis mollit occaecat incididunt laboris velit magna deserunt ut dolor sit. Mollit officia qui tempor culpa ullamco ut excepteur laboris incididunt velit nisi et est duis. Duis magna occaecat aute nulla.&lt;/p&gt;','','Madagascar',1,1,'2018-04-01 18:00:00','2023-04-01 00:00:00','../images/coupon/TdB9jQNjHJRAUj3TRkesEzvbGKLLofBg8i2.jpg',4),
(2,'1','coupon','Laborum','Fracta','Mopler','&lt;p&gt;Lorem occaecat cillum consectetur officia esse irure aliqua cillum officia. Laboris officia do duis excepteur sunt voluptate aute voluptate amet velit. Exercitation dolore cupidatat non minim ea id. Exercitation minim eiusmod dolor commodo est voluptate nostrud et in incididunt esse. Ex quis elit fugiat et occaecat. Dolore enim non qui non.&lt;/p&gt;','','Madagascar',1,1,'2018-04-01 18:00:00','2023-04-01 18:00:00','../images/coupon/9xHClRhUW1etr8LAS9ttyTKUJtKREdCWxcW.jpg',1),
(3,'5','coupon','Malga','Plus','Hecto','&lt;p&gt;Dolore nulla dolore est consequat in incididunt irure exercitation. Nostrud velit duis mollit occaecat incididunt laboris velit magna deserunt ut dolor sit. Mollit officia qui tempor culpa ullamco ut excepteur laboris incididunt velit nisi et est duis. Duis magna occaecat aute nulla.&lt;/p&gt;','','Madagascar',1,1,'2018-04-01 00:00:00','2021-04-01 00:00:00','../images/coupon/7QyLI8CaVe3TpXxqZbl9qCEEX8HPRsK46x2.jpg',3),
(4,'6','coupon','Fondal124','Poschil','Forita','&lt;p&gt;Officia esse non ipsum voluptate aute aute id ipsum incididunt fugiat. Aliquip velit commodo do exercitation minim incididunt eu in eu. Pariatur pariatur ex ut officia. Aliquip deserunt tempor cillum et eiusmod aliqua ipsum laborum aute fugiat enim id occaecat. Irure pariatur ullamco incididunt cillum dolore occaecat in.&lt;/p&gt;','','maroc, madagascar',1,1,'2018-04-01 18:00:00','2022-04-01 18:00:00','../images/coupon/b9TiOHZlcBHawlOdUTjWNiKkrwnc4cTwEvc.jpg',0);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_offers`
--

DROP TABLE IF EXISTS `e_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `e_idoffre` varchar(50) NOT NULL,
  `e_nom` varchar(250) NOT NULL,
  `e_url` varchar(250) NOT NULL,
  `e_description` mediumtext NOT NULL,
  `e_description2` mediumtext DEFAULT NULL,
  `e_pays` varchar(250) DEFAULT NULL,
  `e_remuneration` decimal(15,2) NOT NULL DEFAULT 0.00,
  `e_montant` decimal(15,2) NOT NULL DEFAULT 0.00,
  `e_valid` int(10) NOT NULL DEFAULT 0,
  `e_actif` int(10) NOT NULL DEFAULT 0,
  `e_date` varchar(250) NOT NULL,
  `e_regie` varchar(250) DEFAULT NULL,
  `e_annonceur` varchar(255) DEFAULT NULL,
  `e_quota` int(11) NOT NULL,
  `e_premium` int(11) NOT NULL DEFAULT 0,
  `e_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `e_pays` (`e_pays`),
  KEY `e_actif` (`e_actif`),
  KEY `e_nom` (`e_nom`),
  KEY `e_annonceur` (`e_annonceur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_offers`
--

LOCK TABLES `e_offers` WRITE;
/*!40000 ALTER TABLE `e_offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES
(2,'En quoi consistent les campagnes ?','Les missions sont des actions Ã  effectuer pour recevoir de l\'argent. Les campagnes peuvent te demander de :\r\nâ€¢Participer Ã  des tirages au sort\r\nâ€¢Participer Ã  des sondages\r\nâ€¢Jouer Ã  des jeux en ligne\r\nâ€¢S\'inscrire Ã  des communautÃ©s'),
(3,'Combien de comptes membres sont autorisÃ©s ?','Un seul compte par personne est autorisÃ©.\r\nDes comptes membres supplÃ©mentaires n\'apportent aucun avantage, car les campagnes sont bloquÃ©es en fonction de l\'adresse IP, et non par compte membre.'),
(4,'Parrainage et combien rapporte-t-il ?','Multi-cadeaux Ã  un systÃ¨me de Parrainage, oui. Vous gagnez 15% des gains de vos filleuls, cependant, les clics ne sont pas pris en compte dans le systÃ¨me. Vous pouvez recrutez des filleuls de diffÃ©rentes maniÃ¨res.'),
(5,'Qui sont les filleuls ?','Les membres qui s\'inscrivent grÃ¢ce Ã  la publicitÃ© que tu as faite sont appelÃ©s des filleuls. Dans le menu &quot;Parrainage et filleul&quot;, tu trouveras plusieurs moyens d\'inviter des amis ou des visiteurs.\r\n\r\n'),
(6,'Qu\'est-ce que le &quot;faking&quot;?','Le &quot;Faking&quot; est le fait de participer Ã  une campagne en utilisant de fausses informations personnelles dans le but de gagner plus d\'argent. Cela inclut les \r\nfausses informations, l\'usurpation d\'identitÃ©, ou le spam. Bien sÃ»r, ce comportement est interdit et sera puni par une suppression de compte et une remise Ã  zÃ©ro de son solde.'),
(7,'Puis-je signaler un membre ou un site Web qui triche ?','Oui, contacte notre service assistance pour signaler ce genre de comportement.\r\nBien sÃ»r, nous traitons ta demande de maniÃ¨re strictement confidentielle !');
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoris_mission`
--

DROP TABLE IF EXISTS `favoris_mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoris_mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mission` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoris_mission`
--

LOCK TABLES `favoris_mission` WRITE;
/*!40000 ALTER TABLE `favoris_mission` DISABLE KEYS */;
INSERT INTO `favoris_mission` VALUES
(2,'ylIz2IFXk4vuhkHtgmt9Mv4j3IHu1L',1),
(3,'O96ROM2YA6kXodhZxZ1qYe4W8y55X2',3),
(5,'dR61TatVxfBqySZxeSX1J6MRIK1GPR',0),
(6,'XKkrbFL6XtP2jFQaN6nnSD54YQ4vft',0);
/*!40000 ALTER TABLE `favoris_mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gagnants`
--

DROP TABLE IF EXISTS `gagnants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gagnants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(20) NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `type` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `categorie` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `dateSend` varchar(250) NOT NULL,
  `etat` varchar(250) NOT NULL DEFAULT 'En attente',
  `ip` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gagnants`
--

LOCK TABLES `gagnants` WRITE;
/*!40000 ALTER TABLE `gagnants` DISABLE KEYS */;
INSERT INTO `gagnants` VALUES
(1,22,10.00,'Virement Bancaire','','Paiement','22/12/2022 à 15:13:48','2022-12-22 14:15:13','Valid&eacute;','80.9.194.21'),
(2,22,10.00,'Amazon','fkjsdfhkdsjfhsdkf','Carte-Cadeaux','22/12/2022 à 15:13:55','2022-12-22 14:14:33','Valid&eacute;','80.9.194.21'),
(3,22,10.00,'Virement Bancaire','','Paiement','22/12/2022 à 18:45:59','2022-12-31 13:42:51','Valid&eacute;','80.9.194.21'),
(4,22,10.00,'Paypal','','Paiement','22/12/2022 à 18:46:11','2022-12-31 13:42:44','Valid&eacute;','80.9.194.21'),
(5,17,2.00,'Virement Bancaire','','Paiement','03/01/2023 à 16:26:58','','En attente','41.77.16.139'),
(6,22,100.00,'google play','','Carte-Cadeaux','04/01/2023 à 14:37:38','','En attente','90.1.234.98');
/*!40000 ALTER TABLE `gagnants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_offers`
--

DROP TABLE IF EXISTS `group_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_offers`
--

LOCK TABLES `group_offers` WRITE;
/*!40000 ALTER TABLE `group_offers` DISABLE KEYS */;
INSERT INTO `group_offers` VALUES
(1,'Youtube'),
(2,'Amazon'),
(3,'Forecast'),
(4,'Tubevide');
/*!40000 ALTER TABLE `group_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histo_offers`
--

DROP TABLE IF EXISTS `histo_offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histo_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` varchar(50) NOT NULL,
  `offerwall` varchar(250) NOT NULL,
  `idt` varchar(250) NOT NULL,
  `regie` varchar(250) NOT NULL,
  `remuneration` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `date` varchar(250) NOT NULL,
  `dateUsTime` datetime NOT NULL,
  `data` varchar(250) NOT NULL,
  `etat` varchar(250) NOT NULL DEFAULT 'En cours',
  `ip` varchar(250) NOT NULL,
  `vu` int(11) DEFAULT 0,
  `vu_header` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idt` (`idt`),
  KEY `date` (`date`),
  KEY `etat` (`etat`),
  KEY `ip` (`ip`),
  KEY `idm` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histo_offers`
--

LOCK TABLES `histo_offers` WRITE;
/*!40000 ALTER TABLE `histo_offers` DISABLE KEYS */;
INSERT INTO `histo_offers` VALUES
(34,'','OfferToro','BabyCare-eBook ','',0.000300,'01/01/2023 à 18:23:03','2023-01-01 18:23:03','1wVtmIXYWHwpABicukKZjXTrzAeGbg','En attente','',0,0),
(35,'','OfferToro','GiveUsYour2Cents','',0.000300,'01/01/2023 à 18:40:03','2023-01-01 18:40:03','YiyAc6EQI9UWD5PkxtEuqSVz13Ckk4','En attente','',0,0),
(36,'','OfferToro','My Web Reward Survey - INTL','',0.000300,'01/01/2023 à 18:41:02','2023-01-01 18:41:02','CpXfiFCcGcq8rObXxB8jKKduwIPq3f','En attente','',0,0),
(38,'','OfferToro','MyThoughtCounts - CA','',0.000300,'01/01/2023 à 19:17:02','2023-01-01 19:17:02','C6aM88OeMUXeNAnV9byZ2Dl4xMbf7A','En attente','',0,0),
(39,'','OfferToro','Clansman BE','',0.000300,'01/01/2023 à 19:23:03','2023-01-01 19:23:03','6vzDCrWcvIIHz2wjwaERATq7exbKLJ','En attente','',0,0),
(40,'','Wannads','Test','',0.300000,'01/01/2023 à 20:20:06','2023-01-01 20:20:06','10974','En attente','2a01:cb19:8ed9:3600:6bb3:b5b5:30e4:b878',0,0),
(41,'','OfferToro','My Web Reward Survey - INTL','',0.000300,'01/01/2023 à 21:46:04','2023-01-01 21:46:04','VPho81DDL6ADKYqwANJhnDW6K1GtT8','En attente','',0,0);
/*!40000 ALTER TABLE `histo_offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `boit_message_id` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `senderId` varchar(250) NOT NULL,
  `recevorId` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `minute` varchar(50) DEFAULT NULL,
  `lu` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagerie`
--

LOCK TABLES `messagerie` WRITE;
/*!40000 ALTER TABLE `messagerie` DISABLE KEYS */;
INSERT INTO `messagerie` VALUES
(21,'1','Hello','12','17','1667659171',NULL,1),
(22,'1','Hello, toujours pret pour la suite?','12','17','1671577234',NULL,1),
(23,'1','Bonjour, je vous attend','17','12','1671598346',NULL,1),
(24,'2','Bonjour, je suis en train d\\\'écrire','12','17','1671602945',NULL,1),
(25,'3','Bonjour, je suis en train d\\\'écrire','12','17','1671603057',NULL,1),
(26,'1','ok, je vais vous répondre','12','17','1671659748',NULL,1),
(27,'1','par cette message','12','17','1671659859',NULL,1),
(28,'1','Attend voir','12','17','1671659948',NULL,1),
(29,'4','svxcvxfdsfsfsfs','22','17','1671693874',NULL,1),
(30,'5','wxcwxcwxcwx','22','17','1671693909',NULL,1),
(31,'2','Hello ok, c\\\'est noté','17','12','1671734277',NULL,1),
(32,'6','Hello Marc, comment ça va?','17','18','1671736107',NULL,0),
(33,'7','sfsdfsdfsfsdfsdfsfsdfsdfsdfsd','22','12','1671737195',NULL,1),
(34,'7','Hello','12','22','1671737218',NULL,1),
(35,'7','Timothee Duda','12','22','1671737230',NULL,1),
(36,'7','ok ','22','12','1671737278',NULL,1),
(37,'8','test','22','12','1671737319',NULL,1),
(38,'9','bcvbcbcvbcv','22','17','1671737363',NULL,1),
(39,'10','Hello Admin','12','17','1671737661',NULL,1),
(40,'10','je tsetes ktesl ','17','12','1671772075',NULL,1),
(50,'10','onjoru a vours','17','12','1671773841',NULL,1),
(51,'10','onjoru a vours','17','12','1671777316',NULL,0),
(52,'9','test','17','22','1672425360',NULL,1),
(53,'9','dfgdfgdfgdf','22','17','1672435020',NULL,0),
(54,'4','Oui oui<br />\r\n','17','22','1673769513',NULL,0);
/*!40000 ALTER TABLE `messagerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagerie_all`
--

DROP TABLE IF EXISTS `messagerie_all`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagerie_all` (
  `id` int(11) NOT NULL,
  `id_send` int(11) NOT NULL,
  `id_recive` int(11) NOT NULL,
  `titre_text` text NOT NULL,
  `message_text` text NOT NULL,
  `id_response` int(11) NOT NULL,
  `message_lu` int(11) NOT NULL DEFAULT 0,
  `date_time_publish` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagerie_all`
--

LOCK TABLES `messagerie_all` WRITE;
/*!40000 ALTER TABLE `messagerie_all` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagerie_all` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newletter`
--

DROP TABLE IF EXISTS `newletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newLetter_email` text NOT NULL,
  `newLetter_prenom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newletter`
--

LOCK TABLES `newletter` WRITE;
/*!40000 ALTER TABLE `newletter` DISABLE KEYS */;
INSERT INTO `newletter` VALUES
(1,'andrysahaedena@gmail.com','andrysahaedena'),
(2,'siobhhubert@laposte.net','siobhhubert'),
(3,'duddatimotee@gmail.com',''),
(4,'duddatimotee@gmail.com',''),
(5,'teste@gmail.com','teste'),
(12,'duddatimothe@gmail.com',''),
(17,'ddfgdfgf@live.fr','ddfgdfgf'),
(18,'fsdfsdfsdfsdfdsfsdfsdfdsf@pol.fr','fsdfsdfsdfsdfdsfsdfsdfdsf'),
(19,'11111111111@gmail.com','11111111111'),
(20,'sdqsd@llll.cv','sdqsd'),
(21,'sal.jennyfer@gmail.com',''),
(22,'calvetanais@laposte.net',''),
(23,'neausandra@laposte.net',''),
(24,'duddatimotee@gmail.com',''),
(25,'kesaja2434@fanneat.com',''),
(26,'duddatimotee@gmail.com','');
/*!40000 ALTER TABLE `newletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES
(4,'Vous avez gagné un lot',12),
(5,'Bienvenue dans maxiconcour',12),
(7,'Les documents ont bien été envoyés.',12),
(34,'Offres bien validées',12),
(37,'Offres refusées : DEEDE - 0.06 €',12),
(57,'Votre profil a bien été modifié.',17),
(58,'Votre profil a bien été modifié.',17),
(59,'Vos infomartion a bien été modifié.',17),
(60,'Votre profil a bien été modifié.',17),
(61,'Votre profil a bien été modifié.',17),
(62,'Votre profil a bien été modifié.',17),
(64,'Votre profil a bien été modifié.',17),
(65,'Votre profil a bien été modifié.',17),
(66,'Votre profil a bien été modifié.',17),
(67,'Votre profil a bien été modifié.',17),
(68,'Votre profil a bien été modifié.',17),
(69,'Votre profil a bien été modifié.',17),
(70,'Votre profil a bien été modifié.',17),
(71,'Votre profil a bien été modifié.',17),
(72,'Votre profil a bien été modifié.',17),
(73,'Votre profil a bien été modifié.',17),
(74,'Votre profil a bien été modifié.',17),
(75,'Votre profil a bien été modifié.',17),
(76,'Votre profil a bien été modifié.',17),
(77,'Votre profil a bien été modifié.',17),
(78,'Votre profil a bien été modifié.',17),
(79,'Votre profil a bien été modifié.',17),
(80,'Votre profil a bien été modifié.',17),
(81,'Votre profil a bien été modifié.',17),
(82,'Votre profil a bien été modifié.',17),
(83,'Votre profil a bien été modifié.',17),
(84,'Votre profil a bien été modifié.',17),
(85,'Votre profil a bien été modifié.',17),
(86,'Votre profil a bien été modifié.',17),
(87,'Votre profil a bien été modifié.',17),
(88,'Votre profil a bien été modifié.',17),
(89,'Votre profil a bien été modifié.',17),
(90,'Votre profil a bien été modifié.',17),
(94,'Votre profil a bien été modifié.',17),
(95,'Votre profil a bien été modifié.',17),
(96,'Votre profil a bien été modifié.',28),
(97,'Votre profil a bien été modifié.',28),
(98,'Vos infomartion a bien été modifié.',28),
(99,'Vos infomartion a bien été modifié.',28),
(100,'Vos infomartion a bien été modifié.',28),
(101,'Votre profil a bien été modifié.',28);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idoffre` varchar(50) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `pays` varchar(250) NOT NULL,
  `remuneration` decimal(15,2) NOT NULL DEFAULT 0.00,
  `valid` int(10) NOT NULL DEFAULT 0,
  `actif` int(10) NOT NULL DEFAULT 0,
  `date` varchar(250) NOT NULL,
  `regie` varchar(250) NOT NULL,
  `quota` int(11) NOT NULL,
  `premium` int(11) NOT NULL DEFAULT 0,
  `image` varchar(225) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pays` (`pays`),
  KEY `actif` (`actif`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES
(1,'dR61TatVxfBqySZxeSX1J6MRIK1GPR','danne','https://www.youtube.com/watch?v=3RbcZsKkGOw,https://web-mail.laposte.net/','','mg,fr',0.02,0,1,'19/12/2022 à 20:17:55','',2,0,'../images/missions/cCyEbHVwb4SM8RO8GK6uZE795bzk69Ash3q.png',1),
(2,'kDv5MgBnmfHftpLfSjjvXUBBNBPqQp','DEEDE','https://www.youtube.com/watch?v=3RbcZsKkGOw','Dolore nulla dolore est consequat in incididunt irure exercitation. Nostrud velit duis mollit occaecat incididunt laboris velit magna deserunt ut dolor sit.','MG',0.06,0,1,'09/10/2021 à 17:59:04','',1,0,'../images/missions/VLNh1CfyjCEtE2bETfk2OIbJru5NzKtGNo9.png',1),
(3,'spQkClymObP1uMDycehzZWDjyztlw4','youtube','https://www.youtube.com/watch?v=tihrdI4r-XQ','','BELGIQUE',0.01,0,1,'19/12/2022 à 20:16:40','',1,0,'../images/missions/3V3PBeKTkLkFKHvIDbkfJThnqbXlv9VkatL.jpg',2),
(4,'AIEMDXxOYw6Mg9uyebY7j1e9WQzwan','youtube1','https://www.youtube.com/watch?v=tihrdI4r-XQ,https://web-mail.laposte.net/','Lorem occaecat cillum consectetur officia esse irure aliqua cillum officia. Laboris officia do duis excepteur sunt voluptate aute voluptate amet velit.','mg',0.01,0,1,'13/10/2021 à 15:17:23','',2,0,'../images/missions/OQzmJgorl8ZKWYGD4TnEwUxf2SmrZKIbrQt.jpg',3),
(5,'XKkrbFL6XtP2jFQaN6nnSD54YQ4vft','fffff','https://web-mail.laposte.net/','','fr',0.01,0,1,'13/10/2021 à 15:18:29','',1,0,'../images/missions/BFMgzFS9Ir6Oc6Hi4BGqIobUtwRZFNlDFHW.jpg',4),
(6,'BJG9SnXeXofhpyYvJtAxeM4QQSjm3u','aaaaaaaaaaaaaaaaaaaa','https://my.ionos.fr/mysql-overview','aaaaa','CM',0.01,0,1,'24/12/2022 à 19:09:16','',1,0,'../images/missions/oYEqVixUcULJgbVcREZG1eaeY1XZNzp3Iwb.jpg',4),
(7,'AABkT7hbLCGD9wIluk4XsQDrk3OBFj','https://maxiconcour.com/missions','https://maxiconcour.com/missions,https://maxiconcour.com/missions','','fr',0.01,0,1,'23/12/2022 à 18:34:07','',2,1,'../images/missions/q9cCKXXwb2NssuqEIdHU2YLQ773dG1F1vL4.jpg',NULL),
(8,'RZ3HovzoWi3XldKclGtXCvbV87aFDN','fsdfsfsd788','https://login.ionos.fr/?redirect_url=https%3A%2F%2Fmy.ionos.fr%2Fmysql-overview','sdfsdfsdfsdf','fr',0.01,0,1,'23/12/2022 à 15:05:26','',1,0,'../images/missions/9apea2pEL6nDOhwOwA1nHA8k1wQUbM8NeiQ.jpg',NULL),
(9,'mtKO1MNUCHKHH3fQe5MhSm6Ihad4vv','f78978987978','https://maxiconcour.com/missions','78978978978','fr',0.01,0,1,'23/12/2022 à 18:34:58','',1,0,'../images/missions/qRGdHHFb5czDMVS1sHCyBCNIH55hJMSZG2C.jpg',NULL);
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers_clics`
--

DROP TABLE IF EXISTS `offers_clics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers_clics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idoffre` varchar(50) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `pays` varchar(250) NOT NULL,
  `remuneration` decimal(15,3) NOT NULL,
  `actif` int(10) NOT NULL,
  `date` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers_clics`
--

LOCK TABLES `offers_clics` WRITE;
/*!40000 ALTER TABLE `offers_clics` DISABLE KEYS */;
INSERT INTO `offers_clics` VALUES
(1,'BDyrjgVu2iF6rYrwJClmPHhw6ScuiY','FHGFHF','http://afflight.postaffiliatepro.com/scripts/c2q2a879kk?a_aid=cameron12300&a_bid=b1a330f2&data1=#IDM','fr',0.200,0,'13/04/2018 Ã  22:56:06'),
(2,'FcIQpHYJT63HUs3nVFW8kRHHT4uxF2','gfgfd','http://afflight.postaffiliatepro.com/scripts/c2q2a879kk?a_aid=cameron12300&a_bid=b1a330f2&data1=#IDM','fr',0.200,0,'13/04/2018 Ã  22:58:12'),
(3,'bmzFVkBHj8QaSlXOBsZ9b1VpZFSqSl','roro','http://afflight.postaffiliatepro.com/scripts/c2q2a879kk?a_aid=cameron12300&a_bid=2dba7b2a&data1=#IDM','fr',0.020,0,'13/04/2018 Ã  22:58:22');
/*!40000 ALTER TABLE `offers_clics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `contenu` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES
(1,'Mentions lÃ©gales','\r\n\r\n\r\n');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parrainage`
--

DROP TABLE IF EXISTS `parrainage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parrainage` (
  `id` int(11) NOT NULL,
  `inscription` float NOT NULL,
  `ami` float NOT NULL,
  `commission` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parrainage`
--

LOCK TABLES `parrainage` WRITE;
/*!40000 ALTER TABLE `parrainage` DISABLE KEYS */;
INSERT INTO `parrainage` VALUES
(1,5,1,1);
/*!40000 ALTER TABLE `parrainage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tchat`
--

DROP TABLE IF EXISTS `tchat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idUser` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `pays` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1116 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tchat`
--

LOCK TABLES `tchat` WRITE;
/*!40000 ALTER TABLE `tchat` DISABLE KEYS */;
INSERT INTO `tchat` VALUES
(1100,'2023-01-19 15:00:49','sMayVic4vFY882OMUuIfN51tS','jddjdj','19/01/2023 à 16:00',NULL),
(1101,'2023-01-19 15:08:58','sMayVic4vFY882OMUuIfN51tS','Bonjour','19/01/2023 à 16:08',NULL),
(1102,'2023-01-19 15:11:34','sMayVic4vFY882OMUuIfN51tS','bb','19/01/2023 à 16:11',NULL),
(1103,'2023-01-19 15:12:50','sMayVic4vFY882OMUuIfN51tS','jj','19/01/2023 à 16:12',NULL),
(1104,'2023-01-19 15:14:16','sMayVic4vFY882OMUuIfN51tS','banjo','19/01/2023 à 16:14',NULL),
(1105,'2023-01-19 15:17:48','sMayVic4vFY882OMUuIfN51tS','dd','19/01/2023 à 16:17',NULL),
(1106,'2023-01-19 15:21:27','z7uJXeSjwOzLLwgH6UYGV8dRA','Salut','19/01/2023 à 16:21',NULL),
(1107,'2023-01-19 15:23:07','z7uJXeSjwOzLLwgH6UYGV8dRA','Somary gaga ah hoe tonga ato reto message reto','19/01/2023 à 16:23',NULL),
(1108,'2023-01-19 16:39:05','z7uJXeSjwOzLLwgH6UYGV8dRA','Salut','19/01/2023 à 17:39',NULL),
(1109,'2023-01-19 20:42:27','sMayVic4vFY882OMUuIfN51tS','Banjo','19/01/2023 à 21:42','FR'),
(1110,'2023-01-19 20:44:32','sMayVic4vFY882OMUuIfN51tS','Bonjour la Belgique','19/01/2023 à 21:44','BE'),
(1111,'2023-01-19 20:45:14','z7uJXeSjwOzLLwgH6UYGV8dRA','Salut, Ooh !! Je suis en Belgique !','19/01/2023 à 21:45','BE'),
(1113,'2023-01-21 06:42:19','sMayVic4vFY882OMUuIfN51tS','jdjdj','21/01/2023 à 07:42','BE'),
(1114,'2023-01-21 06:43:16','sMayVic4vFY882OMUuIfN51tS','coucou','21/01/2023 à 07:43','BE');
/*!40000 ALTER TABLE `tchat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hashId` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `adresse` text DEFAULT NULL,
  `ville` varchar(250) NOT NULL DEFAULT '',
  `codePostal` varchar(50) NOT NULL DEFAULT '',
  `pays` varchar(250) NOT NULL DEFAULT '',
  `pmessage` text DEFAULT NULL,
  `euros` decimal(20,6) NOT NULL DEFAULT 0.000000,
  `euros_histo` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ip` varchar(250) NOT NULL DEFAULT '',
  `actif` int(11) NOT NULL DEFAULT 0,
  `level` int(15) NOT NULL DEFAULT 1,
  `premium` int(11) NOT NULL DEFAULT 0,
  `idParrain` int(11) DEFAULT 0,
  `eurosParrain` decimal(15,3) NOT NULL DEFAULT 0.000,
  `barrePrcnt` decimal(15,2) NOT NULL DEFAULT 0.00,
  `barrePrcntNb` int(11) NOT NULL DEFAULT 0,
  `banni` int(11) NOT NULL DEFAULT 0,
  `banni_chat` int(11) NOT NULL DEFAULT 0,
  `iban` varchar(250) DEFAULT '',
  `swift` varchar(250) DEFAULT NULL,
  `paypal` varchar(250) DEFAULT NULL,
  `skrill` varchar(250) DEFAULT NULL,
  `code_verif` varchar(50) DEFAULT NULL,
  `code_verif_date` varchar(250) DEFAULT NULL,
  `ident_recto` text DEFAULT NULL,
  `ident_verso` text DEFAULT NULL,
  `ident_verif` int(11) NOT NULL DEFAULT 0,
  `datelastco` date DEFAULT NULL,
  `ticketTombola` int(12) NOT NULL DEFAULT 0,
  `news` int(11) NOT NULL DEFAULT 0,
  `view_ident_verf` int(11) NOT NULL DEFAULT 0,
  `view_message_notif` int(11) NOT NULL DEFAULT 0,
  `view_bani_notif` int(11) NOT NULL DEFAULT 0,
  `date_Inscription` date DEFAULT NULL,
  `profil_photo` varchar(255) DEFAULT 'default_profil_photo.png',
  `last_activity` datetime DEFAULT NULL,
  `pays_chat` varchar(10) DEFAULT `pays`,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(17,'sMayVic4vFY882OMUuIfN51tS','email@gmail.com','bf50f99415493622eab1417da27bba5c58affdf5','TestNOM ','TestPre ','5 avenue de la république','Paris','75011','FR',NULL,18.060000,0.06,'154.126.11.64',1,99999,0,0,0.000,0.05,0,0,0,'','','','',NULL,NULL,'images/identites/hiXrv5XBcoRDtOdgKQRaoln7rsTi4StDP9j.jpg','images/identites/d9Gq89Nvl9gx1H4OgEAImVluCFY6kdRf6om.jpg',1,NULL,1,0,0,0,0,'2022-12-12','2023-01-05-37-email@gmail.com.jpg','2023-01-24 14:39:38','BE'),
(22,'gMAkIXOdTbMcq798Dhuhc1DgW','duddatimotee@gmail.com','bf50f99415493622eab1417da27bba5c58affdf5','Duda','Timothee','rue masse','decazeivmmm','78000','FR',NULL,5.200000,0.20,'86.201.194.24',1,9,0,0,0.000,0.65,0,0,0,'','','','',NULL,NULL,'images/identites/if3wHBZhhjWnlmK9cAoUrycXrBtNqgMXSlD.jpg','images/identites/JAr61xkIgXesqu8idKdNsWVpi1FyPC5OFVH.jpg',1,NULL,13,1,0,0,0,'2022-12-21','2023-01-04-09-duddatimotee@gmail.com.jpg','2023-01-18 10:00:56','FR'),
(27,'3a824154b16ed7dab899bf000b80eeee','jrakoto280@gmail.com','bf50f99415493622eab1417da27bba5c58affdf5','Rakoto','Jean Baptiste','96000 Paris France','Paris','96000','BE','Teste',0.000000,0.00,'',0,1,0,0,0.000,0.00,0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,0,0,0,0,NULL,'',NULL,'BE'),
(28,'bGDqPcDOzt9V9m4KenwEIIUwf','web.HassineZarrat@gmail.com','bf50f99415493622eab1417da27bba5c58affdf5','Zarrat','Hassine','06 Rue algérie','Bembla','5021','FR',NULL,0.000000,0.00,'127.0.0.1',1,99,0,0,0.000,0.00,0,0,0,'23123123','uuuu','1111111111122','111111111133',NULL,NULL,NULL,NULL,1,NULL,0,1,0,0,0,'2023-01-01','2023-01-05-22-web.HassineZarrat@gmail.com.png',NULL,'FR'),
(33,'z7uJXeSjwOzLLwgH6UYGV8dRA','goodcloud68@gmail.com','bf50f99415493622eab1417da27bba5c58affdf5','Loic','Mcquincyan',NULL,'','','FR',NULL,5.000000,0.00,'127.0.0.1',1,1,0,0,0.000,0.00,0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,0,0,0,0,0,'2023-01-18','default_profil_photo.png','2023-01-21 15:43:02','BE');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_infos`
--

DROP TABLE IF EXISTS `users_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_infos` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `sexe` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `birth` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_infos`
--

LOCK TABLES `users_infos` WRITE;
/*!40000 ALTER TABLE `users_infos` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_infos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-24 22:13:31
