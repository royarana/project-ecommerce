-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `picture` text NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `cart_id` (`cart_id`),
  CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
INSERT INTO `cart_items` VALUES (15,6,1,1,19,787.0000,'Vel ab.','http://localhost/project-ecommerce/public/images/shoe18.jpg','5298353803507',1,'2019-05-20 10:26:02'),(16,6,1,2,20,18.0000,'Qui culpa voluptas.','http://localhost/project-ecommerce/public/images/shoe18.jpg','5786972737414',1,'2019-05-20 10:26:07'),(17,6,1,3,18,458.0000,'Est tenetur.','http://localhost/project-ecommerce/public/images/shoe18.jpg','3403035254535',1,'2019-05-20 10:26:12'),(18,7,1,3,19,787.0000,'Vel ab.','http://localhost/project-ecommerce/public/images/shoe18.jpg','5298353803507',1,'2019-05-20 10:27:16'),(19,7,1,3,18,458.0000,'Est tenetur.','http://localhost/project-ecommerce/public/images/shoe18.jpg','3403035254535',1,'2019-05-20 10:27:21'),(20,8,1,3,19,787.0000,'Vel ab.','http://localhost/project-ecommerce/public/images/shoe18.jpg','5298353803507',1,'2019-05-20 10:28:03'),(21,8,1,2,18,458.0000,'Est tenetur.','http://localhost/project-ecommerce/public/images/shoe18.jpg','3403035254535',1,'2019-05-20 10:28:08'),(22,9,1,1,18,458.0000,'Est tenetur.','http://localhost/project-ecommerce/public/images/shoe18.jpg','3403035254535',0,'2019-05-20 11:47:47'),(23,9,1,1,18,458.0000,'Est tenetur.','http://localhost/project-ecommerce/public/images/shoe18.jpg','3403035254535',1,'2019-05-20 11:48:06');
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(19,4) DEFAULT NULL,
  `address` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (6,1,2197.0000,'dasdasdsa','2019-05-20 10:26:16',0),(7,1,3735.0000,'dasdasdsa','2019-05-20 10:27:27',0),(8,1,3277.0000,'novaliches','2019-05-20 10:32:14',0),(9,1,458.0000,'dsadsada','2019-05-20 11:48:10',0);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'NIKE'),(2,'ADIDAS'),(3,'WORLD BALANCE');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `featured_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured`
--

LOCK TABLES `featured` WRITE;
/*!40000 ALTER TABLE `featured` DISABLE KEYS */;
INSERT INTO `featured` VALUES (1,9,1,'2019-05-19 14:37:15'),(2,4,1,'2019-05-19 14:37:38'),(3,16,1,'2019-05-19 14:37:46'),(4,6,1,'2019-05-19 14:37:54');
/*!40000 ALTER TABLE `featured` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender` (
  `gender` varchar(1) NOT NULL,
  `description` varchar(10) NOT NULL,
  PRIMARY KEY (`gender`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES ('F','FEMALE'),('M','MALE'),('U','UNISEX');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `info` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `picture` text NOT NULL,
  `inventory` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `barcode` (`barcode`),
  KEY `gender` (`gender`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender` (`gender`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Aspernatur et.','5962789525004','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','F',2,435.0000,'2019-05-19 14:18:50','2019-05-20 14:39:39','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(2,'Omnis soluta et.','1683832903245','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','F',2,548.0000,'2019-05-19 14:18:50','2019-05-20 14:39:36','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(3,'Aut voluptas officia.','2339365395475','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,1944.0000,'2019-05-19 14:18:50','2019-05-20 14:39:31','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(4,'Inventore voluptatem omnis.','9711084864051','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','F',2,678.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(5,'Totam expedita.','0511365804214','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,7503.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(6,'Non maxime.','8714149592518','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,3.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(7,'Repudiandae laborum.','2899343472012','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,2083.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(8,'Mollitia praesentium voluptatem.','0503405740958','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,82.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(9,'Impedit asperiores voluptatem.','9640505807127','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,93.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(10,'Accusamus reiciendis deleniti.','2967104920048','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,3.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(11,'Tempora qui.','4406975307049','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,8.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(12,'Deleniti laboriosam.','3729940562320','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,3403.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(13,'Aut suscipit at.','1973841206384','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','F',2,739.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(14,'Iste praesentium quidem.','6347034009680','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,68.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(15,'Quos sed magnam.','6263513740038','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,2911.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(16,'Neque explicabo voluptatum.','9531286489551','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,5064.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(17,'Adipisci recusandae.','3865532672043','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,28.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(18,'Est tenetur.','3403035254535','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','U',3,458.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(19,'Vel ab.','5298353803507','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','F',2,787.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(20,'Qui culpa voluptas.','5786972737414','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed maiores provident enim iste quisquam q','M',1,18.0000,'2019-05-19 14:18:50','2019-05-20 14:41:26','http://localhost/project-ecommerce/public/images/shoe18.jpg',0.0000,1),(25,'1231231','12321331','dsadasdsa','M',1,15.0000,'2019-05-20 15:54:33','2019-05-20 15:54:33','http://localhost/project-ecommerce/public/uploads/eef4a901a4f7661ed41d7477b4db1596547616a8.jpg',15.0000,1),(26,'3123123123','312321','12312333','F',1,3123123.0000,'2019-05-20 15:58:58','2019-05-20 15:58:58','http://localhost/project-ecommerce/public/uploads/c7fac4eea14265c77df480dfb89673caee856e03.jpg',123.0000,1),(27,'dasd123123','412321313131','33','F',1,100.0000,'2019-05-20 15:59:25','2019-05-20 15:59:25','http://localhost/project-ecommerce/public/uploads/d9bff8458623af36cdec40737d82e5a1c3d9352e.png',3.0000,1),(28,'dsad123','141232131','123','M',2,13.0000,'2019-05-20 16:00:33','2019-05-20 16:00:33','http://localhost/project-ecommerce/public/uploads/88a1cfd8f4b57e090f3278845c1b16505eaf288f.png',1.0000,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tokens`
--

LOCK TABLES `user_tokens` WRITE;
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
INSERT INTO `user_tokens` VALUES (1,1,'e25b7653fe39d889ee7e0bdebf344f33adb1cfd5',0,'2019-05-19 14:37:04'),(2,1,'87ca64282ace7be2a1f44db24854e99e0e1566b0',0,'2019-05-19 20:44:03'),(3,1,'8b7a338f43cec8107c5dac91adb140544d0fc90e',0,'2019-05-19 21:07:02'),(4,1,'fb20fad8c9d2fc71fe422b8696c72a8e1abf3cc2',0,'2019-05-19 21:09:52'),(5,1,'1f6707a7577e418655f01591ce7ad5c4e6fcf95b',0,'2019-05-19 21:37:25'),(6,1,'0261d4ede80253284cda1206e7f6fd5bb5bce237',0,'2019-05-19 21:40:25'),(7,1,'b2591da05df0fcbacbfdf7303f928a948d094b4e',0,'2019-05-19 21:41:00'),(8,1,'34d6132fc291ea7f191f8e308b8e8d87c833721e',0,'2019-05-19 21:41:52'),(9,1,'7d4e4e482f19fd270c43dcb70d6e8405ccf4472b',0,'2019-05-19 21:42:31'),(10,1,'38a4652c9872c793326128183588d3499ceef780',0,'2019-05-20 11:14:51'),(11,1,'e61a68f848e357c8c39e832c2b5b147e702334f0',0,'2019-05-20 11:16:00'),(12,1,'60fd1f8f1fd44f521a3399df061f08bb222378e4',1,'2019-05-20 11:34:07'),(13,2,'7ba407bd0b7aa6aafb473fde24606f941538efbc',0,'2019-05-20 12:58:49'),(14,2,'d356c2ea116222bd4f313bd3ee54046f825a9483',1,'2019-05-20 12:59:37');
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mossie74@hotmail.com','Esse ducimus.','1995-01-01','F','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','2019-05-19 14:36:46','2019-05-19 14:36:46',0),(2,'lysanne11@gmail.com','Dolor asperiores aut.','1995-01-01','M','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','2019-05-19 14:36:46','2019-05-20 12:51:34',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-20 16:27:16
