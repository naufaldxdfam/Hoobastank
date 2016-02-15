/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.0.21-community-nt : Database - tickit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tickit` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;

USE `tickit`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(9) NOT NULL auto_increment,
  `username` varchar(25) collate latin1_general_ci default NULL,
  `password` varchar(15) collate latin1_general_ci default NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`name`) values (1,'admin','admin123','Irham Mustofa');

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id` varchar(9) collate latin1_general_ci NOT NULL default '',
  `id_show` varchar(9) collate latin1_general_ci default NULL,
  `username` varchar(25) collate latin1_general_ci default NULL,
  `time` datetime default NULL,
  `invoice_payment` varchar(25) collate latin1_general_ci default NULL,
  `totalPrice` double default NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `invoice_payment` (`invoice_payment`),
  KEY `id_show` (`id_show`),
  CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`invoice_payment`) REFERENCES `payment` (`invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`id_show`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `booking` */

insert  into `booking`(`id`,`id_show`,`username`,`time`,`invoice_payment`,`totalPrice`) values ('BM-0001','FM-0001','tidakasli','2016-02-14 22:35:19',NULL,1100000);

/*Table structure for table `format` */

DROP TABLE IF EXISTS `format`;

CREATE TABLE `format` (
  `id` int(9) NOT NULL auto_increment,
  `table` varchar(20) collate latin1_general_ci default NULL,
  `code` varchar(9) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `format` */

insert  into `format`(`id`,`table`,`code`) values (1,'plane','MA'),(2,'booking','BM'),(3,'show','FM');

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `invoice` varchar(25) collate latin1_general_ci NOT NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `payment` */

insert  into `payment`(`invoice`,`name`) values ('1231433','Mandiri');

/*Table structure for table `plane` */

DROP TABLE IF EXISTS `plane`;

CREATE TABLE `plane` (
  `id` varchar(9) collate latin1_general_ci NOT NULL,
  `name` varchar(25) collate latin1_general_ci default NULL,
  `seat` int(9) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `plane` */

insert  into `plane`(`id`,`name`,`seat`) values ('MA-0001','Airbus-709',12),('MA-0002','Airbus-231',96),('MA-0003','Boeing-0342',60),('MA-0004','Airbus-123',90),('MA-0005','Airbus-123',60),('MA-0006','Adlan',8);

/*Table structure for table `seat` */

DROP TABLE IF EXISTS `seat`;

CREATE TABLE `seat` (
  `id` int(9) NOT NULL auto_increment,
  `id_show` varchar(9) collate latin1_general_ci default NULL,
  `no` int(9) default NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  `status` int(9) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_show` (`id_show`),
  CONSTRAINT `seat_ibfk_2` FOREIGN KEY (`id_show`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `seat` */

insert  into `seat`(`id`,`id_show`,`no`,`name`,`status`) values (187,'FM-0003',1,'HAI',0),(188,'FM-0003',2,'HAI',0),(189,'FM-0003',3,'HAI',0),(190,'FM-0003',4,'HAI',0),(191,'FM-0003',5,'HAI',0),(192,'FM-0003',6,'HAI',0),(193,'FM-0003',7,'HAI',0),(194,'FM-0003',8,'HAI',0),(195,'FM-0003',9,'HAI',0),(196,'FM-0003',10,'HAI',0),(197,'FM-0003',11,'HAI',0),(198,'FM-0003',12,'HAI',0),(199,'FM-0003',13,'HAI',0),(200,'FM-0003',14,'HAI',0),(201,'FM-0003',15,'HAI',0),(202,'FM-0003',16,'HAI',0),(203,'FM-0003',17,'HAI',0),(204,'FM-0003',18,'HAI',0),(205,'FM-0003',19,'HAI',0),(206,'FM-0003',20,'HAI',0),(207,'FM-0003',21,'HAI',0),(208,'FM-0003',22,'HAI',0),(209,'FM-0003',23,'HAI',0),(210,'FM-0003',24,'HAI',0),(211,'FM-0003',25,'HAI',0),(212,'FM-0003',26,'HAI',0),(213,'FM-0003',27,'HAI',0),(214,'FM-0003',28,'HAI',0),(215,'FM-0003',29,'HAI',0),(216,'FM-0003',30,'HAI',0),(217,'FM-0003',31,'HAI',0),(218,'FM-0003',32,'HAI',0),(219,'FM-0003',33,'HAI',0),(220,'FM-0003',34,'HAI',0),(221,'FM-0003',35,'HAI',0),(222,'FM-0003',36,'HAI',0),(223,'FM-0003',37,'HAI',0),(224,'FM-0003',38,'HAI',0),(225,'FM-0003',39,'HAI',0),(226,'FM-0003',40,'HAI',0),(227,'FM-0003',41,'HAI',0),(228,'FM-0003',42,'HAI',0),(229,'FM-0003',43,'HAI',0),(230,'FM-0003',44,'HAI',0),(231,'FM-0003',45,'HAI',0),(232,'FM-0003',46,'HAI',0),(233,'FM-0003',47,'HAI',0),(234,'FM-0003',48,'HAI',0),(235,'FM-0003',49,'HAI',0),(236,'FM-0003',50,'HAI',0),(237,'FM-0003',51,'HAI',0),(238,'FM-0003',52,'HAI',0),(239,'FM-0003',53,'HAI',0),(240,'FM-0003',54,'HAI',0),(241,'FM-0003',55,'HAI',0),(242,'FM-0003',56,'HAI',0),(243,'FM-0003',57,'HAI',0),(244,'FM-0003',58,'HAI',0),(245,'FM-0003',59,'HAI',0),(246,'FM-0003',60,'HAI',0),(326,'FM-0004',1,'HAI',0),(327,'FM-0004',2,'HAI',0),(328,'FM-0004',3,'HAI',0),(329,'FM-0004',4,'HAI',0),(330,'FM-0004',5,'HAI',0),(331,'FM-0004',6,'HAI',0),(332,'FM-0004',7,'HAI',0),(333,'FM-0004',8,'HAI',0),(334,'FM-0004',9,'HAI',0),(335,'FM-0004',10,'HAI',0),(336,'FM-0004',11,'HAI',0),(337,'FM-0004',12,'HAI',0),(338,'FM-0004',13,'HAI',0),(339,'FM-0004',14,'HAI',0),(340,'FM-0004',15,'HAI',0),(341,'FM-0004',16,'HAI',0),(342,'FM-0004',17,'HAI',0),(343,'FM-0004',18,'HAI',0),(344,'FM-0004',19,'HAI',0),(345,'FM-0004',20,'HAI',0),(346,'FM-0004',21,'HAI',0),(347,'FM-0004',22,'HAI',0),(348,'FM-0004',23,'HAI',0),(349,'FM-0004',24,'HAI',0),(350,'FM-0004',25,'HAI',0),(351,'FM-0004',26,'HAI',0),(352,'FM-0004',27,'HAI',0),(353,'FM-0004',28,'HAI',0),(354,'FM-0004',29,'HAI',0),(355,'FM-0004',30,'HAI',0),(356,'FM-0004',31,'HAI',0),(357,'FM-0004',32,'HAI',0),(358,'FM-0004',33,'HAI',0),(359,'FM-0004',34,'HAI',0),(360,'FM-0004',35,'HAI',0),(361,'FM-0004',36,'HAI',0),(362,'FM-0004',37,'HAI',0),(363,'FM-0004',38,'HAI',0),(364,'FM-0004',39,'HAI',0),(365,'FM-0004',40,'HAI',0),(366,'FM-0004',41,'HAI',0),(367,'FM-0004',42,'HAI',0),(368,'FM-0004',43,'HAI',0),(369,'FM-0004',44,'HAI',0),(370,'FM-0004',45,'HAI',0),(371,'FM-0004',46,'HAI',0),(372,'FM-0004',47,'HAI',0),(373,'FM-0004',48,'HAI',0),(374,'FM-0004',49,'HAI',0),(375,'FM-0004',50,'HAI',0),(376,'FM-0004',51,'HAI',0),(377,'FM-0004',52,'HAI',0),(378,'FM-0004',53,'HAI',0),(379,'FM-0004',54,'HAI',0),(380,'FM-0004',55,'HAI',0),(381,'FM-0004',56,'HAI',0),(382,'FM-0004',57,'HAI',0),(383,'FM-0004',58,'HAI',0),(384,'FM-0004',59,'HAI',0),(385,'FM-0004',60,'HAI',0),(386,'FM-0001',1,'HAI',1),(387,'FM-0001',2,'HAI',1),(388,'FM-0001',3,'HAI',0),(389,'FM-0001',4,'HAI',0),(390,'FM-0001',5,'HAI',0),(391,'FM-0001',6,'HAI',0),(392,'FM-0001',7,'HAI',0),(393,'FM-0001',8,'HAI',0),(394,'FM-0001',9,'HAI',0),(395,'FM-0001',10,'HAI',0),(396,'FM-0001',11,'HAI',0),(397,'FM-0001',12,'HAI',0),(398,'FM-0001',13,'HAI',0),(399,'FM-0001',14,'HAI',0),(400,'FM-0001',15,'HAI',0),(401,'FM-0001',16,'HAI',0),(402,'FM-0001',17,'HAI',0),(403,'FM-0001',18,'HAI',0),(404,'FM-0001',19,'HAI',0),(405,'FM-0001',20,'HAI',0),(406,'FM-0001',21,'HAI',0),(407,'FM-0001',22,'HAI',0),(408,'FM-0001',23,'HAI',0),(409,'FM-0001',24,'HAI',0),(410,'FM-0001',25,'HAI',0),(411,'FM-0001',26,'HAI',0),(412,'FM-0001',27,'HAI',0),(413,'FM-0001',28,'HAI',0),(414,'FM-0001',29,'HAI',0),(415,'FM-0001',30,'HAI',0),(416,'FM-0001',31,'HAI',0),(417,'FM-0001',32,'HAI',0),(418,'FM-0001',33,'HAI',0),(419,'FM-0001',34,'HAI',0),(420,'FM-0001',35,'HAI',0),(421,'FM-0001',36,'HAI',0),(422,'FM-0001',37,'HAI',0),(423,'FM-0001',38,'HAI',0),(424,'FM-0001',39,'HAI',0),(425,'FM-0001',40,'HAI',0),(426,'FM-0001',41,'HAI',0),(427,'FM-0001',42,'HAI',0),(428,'FM-0001',43,'HAI',0),(429,'FM-0001',44,'HAI',0),(430,'FM-0001',45,'HAI',0),(431,'FM-0001',46,'HAI',0),(432,'FM-0001',47,'HAI',0),(433,'FM-0001',48,'HAI',0),(434,'FM-0001',49,'HAI',0),(435,'FM-0001',50,'HAI',0),(436,'FM-0001',51,'HAI',0),(437,'FM-0001',52,'HAI',0),(438,'FM-0001',53,'HAI',0),(439,'FM-0001',54,'HAI',0),(440,'FM-0001',55,'HAI',0),(441,'FM-0001',56,'HAI',0),(442,'FM-0001',57,'HAI',0),(443,'FM-0001',58,'HAI',0),(444,'FM-0001',59,'HAI',0),(445,'FM-0001',60,'HAI',0),(3597,'FM-0002',1,'HAI',0),(3598,'FM-0002',2,'HAI',0),(3599,'FM-0002',3,'HAI',0),(3600,'FM-0002',4,'HAI',0),(3601,'FM-0002',5,'HAI',0),(3602,'FM-0002',6,'HAI',0),(3603,'FM-0002',7,'HAI',0),(3604,'FM-0002',8,'HAI',0),(3605,'FM-0002',9,'HAI',0),(3606,'FM-0002',10,'HAI',0),(3607,'FM-0002',11,'HAI',0),(3608,'FM-0002',12,'HAI',0),(3609,'FM-0005',1,'HAI',0),(3610,'FM-0005',2,'HAI',0),(3611,'FM-0005',3,'HAI',0),(3612,'FM-0005',4,'HAI',0),(3613,'FM-0005',5,'HAI',0),(3614,'FM-0005',6,'HAI',0),(3615,'FM-0005',7,'HAI',0),(3616,'FM-0005',8,'HAI',0),(3617,'FM-0005',9,'HAI',0),(3618,'FM-0005',10,'HAI',0),(3619,'FM-0005',11,'HAI',0),(3620,'FM-0005',12,'HAI',0),(3621,'FM-0006',1,'HAI',0),(3622,'FM-0006',2,'HAI',0),(3623,'FM-0006',3,'HAI',0),(3624,'FM-0006',4,'HAI',0),(3625,'FM-0006',5,'HAI',0),(3626,'FM-0006',6,'HAI',0),(3627,'FM-0006',7,'HAI',0),(3628,'FM-0006',8,'HAI',0),(3629,'FM-0006',9,'HAI',0),(3630,'FM-0006',10,'HAI',0),(3631,'FM-0006',11,'HAI',0),(3632,'FM-0006',12,'HAI',0),(3633,'FM-0007',1,'HAI',0),(3634,'FM-0007',2,'HAI',0),(3635,'FM-0007',3,'HAI',0),(3636,'FM-0007',4,'HAI',0),(3637,'FM-0007',5,'HAI',0),(3638,'FM-0007',6,'HAI',0),(3639,'FM-0007',7,'HAI',0),(3640,'FM-0007',8,'HAI',0),(3641,'FM-0007',9,'HAI',0),(3642,'FM-0007',10,'HAI',0),(3643,'FM-0007',11,'HAI',0),(3644,'FM-0007',12,'HAI',0);

/*Table structure for table `show` */

DROP TABLE IF EXISTS `show`;

CREATE TABLE `show` (
  `id` varchar(9) collate latin1_general_ci NOT NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  `id_plane` varchar(9) collate latin1_general_ci default NULL,
  `id_type` int(9) default NULL,
  `code_venue_departure` varchar(9) collate latin1_general_ci default NULL,
  `code_venue_destination` varchar(9) collate latin1_general_ci default NULL,
  `departure_time` datetime default NULL,
  `arrive_time` datetime default NULL,
  `default_price` double default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_plane` (`id_plane`),
  KEY `code_venue_departure` (`code_venue_departure`),
  KEY `code_venue_destination` (`code_venue_destination`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `show_ibfk_3` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `show_ibfk_4` FOREIGN KEY (`code_venue_departure`) REFERENCES `venue` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `show_ibfk_5` FOREIGN KEY (`code_venue_destination`) REFERENCES `venue` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `show_ibfk_6` FOREIGN KEY (`id_type`) REFERENCES `show_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `show` */

insert  into `show`(`id`,`name`,`id_plane`,`id_type`,`code_venue_departure`,`code_venue_destination`,`departure_time`,`arrive_time`,`default_price`) values ('FM-0001','HI','MA-0003',1,'PDG','HLP','2016-08-17 20:24:00','2016-03-08 21:24:00',50000),('FM-0002','HI','MA-0001',2,'CGK','LPT','2016-03-09 06:30:00','2016-03-09 19:30:00',NULL),('FM-0003','HI','MA-0003',2,'SIN','KLT','2016-03-09 18:30:00','2016-03-09 18:30:00',NULL),('FM-0004','HI','MA-0005',3,'SIN','LPT','2016-03-11 18:30:00','2016-03-09 20:30:00',NULL),('FM-0005','HI','MA-0001',3,'CGK','CGK','2016-03-11 12:45:00','2016-03-11 01:46:00',NULL),('FM-0006','HI','MA-0001',3,'LPT','PDG','2016-03-11 12:47:00','2016-03-11 02:48:00',100000),('FM-0007','HI','MA-0001',3,'SIN','PDG','2016-03-10 20:25:00','2016-03-10 20:25:00',200000);

/*Table structure for table `show_type` */

DROP TABLE IF EXISTS `show_type`;

CREATE TABLE `show_type` (
  `id` int(9) NOT NULL auto_increment,
  `type` varchar(25) collate latin1_general_ci default NULL,
  `price` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `show_type` */

insert  into `show_type`(`id`,`type`,`price`) values (1,'Bussiness',500000),(2,'Economy',300000),(3,'First',1000000);

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `id` int(9) NOT NULL,
  `id_booking` varchar(9) collate latin1_general_ci default NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_booking` (`id_booking`),
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`id`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `ticket` */

insert  into `ticket`(`id`,`id_booking`,`name`) values (386,'BM-0001','Irham'),(387,'BM-0001','Iqbal');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(25) collate latin1_general_ci NOT NULL default '',
  `password` varchar(15) collate latin1_general_ci default NULL,
  `email` varchar(50) collate latin1_general_ci default NULL,
  `firstname` varchar(25) collate latin1_general_ci default NULL,
  `lastname` varchar(25) collate latin1_general_ci default NULL,
  `address` text collate latin1_general_ci,
  `town` varchar(25) collate latin1_general_ci default NULL,
  `country` varchar(25) collate latin1_general_ci default NULL,
  `postcode` varchar(9) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `user` */

insert  into `user`(`username`,`password`,`email`,`firstname`,`lastname`,`address`,`town`,`country`,`postcode`) values ('alpin','alpin','alpin','Ahmad','Faqih','Jakarta','Jakarta','Indonesia','13720'),('faqih','faqih','faqih','Faqih','Hadya','Jakarta','Jakarta','Indonesia','13720'),('irham','irham','irham','Irham','Mustofa','irham','Jakarta','Indonesia','13720'),('Robin','123','aaaa','Himansyah','Muqorrobin','Indonesia','Jakarta','Indonesia','111111'),('tdksli','irham','irhamustofa@yahoo.com','Irham','Mustofa','Jakarta','Jakarta','Indonesia','13720'),('tidakasli','irham','irhamustofa@yahoo.com','Irham','Mustofa','Jakarta Timur 2','Jakarta','Indonesia','13720');

/*Table structure for table `venue` */

DROP TABLE IF EXISTS `venue`;

CREATE TABLE `venue` (
  `code` varchar(9) collate latin1_general_ci NOT NULL,
  `name` varchar(50) collate latin1_general_ci default NULL,
  `location` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `venue` */

insert  into `venue`(`code`,`name`,`location`) values ('CGK','Soekarno-Hatta','Jakarta, Indonesia'),('DPS','Ngurah Rai','Bali, Indonesia'),('HLP','Halim Perdana Kusuma','Jakarta, Indonesia'),('KLT','Klaten Jaya','Klaten, Indonesia'),('LPT','Lapangan Tembak','Jakarta, Indonesia'),('PDG','Minangkabau','Padang, Indonesia'),('SIN','Changi','Singapura, Singapura');

/*Table structure for table `view_book` */

DROP TABLE IF EXISTS `view_book`;

/*!50001 DROP VIEW IF EXISTS `view_book` */;
/*!50001 DROP TABLE IF EXISTS `view_book` */;

/*!50001 CREATE TABLE  `view_book`(
 `id_booking` varchar(9) ,
 `invoice_payment` varchar(25) ,
 `id_show` varchar(9) ,
 `booking_time` datetime ,
 `firstname` varchar(25) ,
 `lastname` varchar(25) ,
 `code_venue_departure` varchar(9) ,
 `code_venue_destination` varchar(9) ,
 `id_plane` varchar(9) ,
 `departure_time` datetime ,
 `arrive_time` datetime ,
 `default_price` double ,
 `venue_departure_name` varchar(50) ,
 `venue_departure_location` varchar(50) ,
 `venue_destination_name` varchar(50) ,
 `venue_destination_location` varchar(50) ,
 `show_type` varchar(25) 
)*/;

/*Table structure for table `view_plane` */

DROP TABLE IF EXISTS `view_plane`;

/*!50001 DROP VIEW IF EXISTS `view_plane` */;
/*!50001 DROP TABLE IF EXISTS `view_plane` */;

/*!50001 CREATE TABLE  `view_plane`(
 `id` varchar(9) ,
 `name` varchar(25) ,
 `seat` int(9) 
)*/;

/*Table structure for table `view_seat` */

DROP TABLE IF EXISTS `view_seat`;

/*!50001 DROP VIEW IF EXISTS `view_seat` */;
/*!50001 DROP TABLE IF EXISTS `view_seat` */;

/*!50001 CREATE TABLE  `view_seat`(
 `id` int(9) ,
 `id_show` varchar(9) ,
 `status` int(9) ,
 `no` int(9) 
)*/;

/*Table structure for table `view_show` */

DROP TABLE IF EXISTS `view_show`;

/*!50001 DROP VIEW IF EXISTS `view_show` */;
/*!50001 DROP TABLE IF EXISTS `view_show` */;

/*!50001 CREATE TABLE  `view_show`(
 `show_id` varchar(9) ,
 `show_name` varchar(50) ,
 `code_venue_departure` varchar(9) ,
 `code_venue_destination` varchar(9) ,
 `id_plane` varchar(9) ,
 `departure_time` datetime ,
 `arrive_time` datetime ,
 `default_price` double ,
 `show_type` varchar(25) ,
 `show_type_price` double ,
 `venue_name_departure` varchar(50) ,
 `venue_name_destination` varchar(50) ,
 `venue_location_departure` varchar(50) ,
 `venue_location_destination` varchar(50) ,
 `name` varchar(25) 
)*/;

/*Table structure for table `view_show_type` */

DROP TABLE IF EXISTS `view_show_type`;

/*!50001 DROP VIEW IF EXISTS `view_show_type` */;
/*!50001 DROP TABLE IF EXISTS `view_show_type` */;

/*!50001 CREATE TABLE  `view_show_type`(
 `id` int(9) ,
 `type` varchar(25) ,
 `price` double 
)*/;

/*Table structure for table `view_ticket` */

DROP TABLE IF EXISTS `view_ticket`;

/*!50001 DROP VIEW IF EXISTS `view_ticket` */;
/*!50001 DROP TABLE IF EXISTS `view_ticket` */;

/*!50001 CREATE TABLE  `view_ticket`(
 `id` int(9) ,
 `ticket_name` varchar(50) ,
 `id_booking` varchar(9) ,
 `no_seat` int(9) 
)*/;

/*Table structure for table `view_venue` */

DROP TABLE IF EXISTS `view_venue`;

/*!50001 DROP VIEW IF EXISTS `view_venue` */;
/*!50001 DROP TABLE IF EXISTS `view_venue` */;

/*!50001 CREATE TABLE  `view_venue`(
 `code` varchar(9) ,
 `name` varchar(50) ,
 `location` varchar(50) 
)*/;

/*View structure for view view_book */

/*!50001 DROP TABLE IF EXISTS `view_book` */;
/*!50001 DROP VIEW IF EXISTS `view_book` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book` AS select `booking`.`id` AS `id_booking`,`booking`.`invoice_payment` AS `invoice_payment`,`booking`.`id_show` AS `id_show`,`booking`.`time` AS `booking_time`,`user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`show`.`code_venue_departure` AS `code_venue_departure`,`show`.`code_venue_destination` AS `code_venue_destination`,`show`.`id_plane` AS `id_plane`,`show`.`departure_time` AS `departure_time`,`show`.`arrive_time` AS `arrive_time`,`show`.`default_price` AS `default_price`,`venue_departure`.`name` AS `venue_departure_name`,`venue_departure`.`location` AS `venue_departure_location`,`venue_destination`.`name` AS `venue_destination_name`,`venue_destination`.`location` AS `venue_destination_location`,`show_type`.`type` AS `show_type` from ((((((`booking` join `user` on((`booking`.`username` = `user`.`username`))) left join `payment` on((`booking`.`invoice_payment` = `payment`.`invoice`))) join `show` on((`booking`.`id_show` = `show`.`id`))) join `venue` `venue_departure` on((`venue_departure`.`code` = `show`.`code_venue_departure`))) join `venue` `venue_destination` on((`venue_destination`.`code` = `show`.`code_venue_destination`))) join `show_type` on((`show`.`id_type` = `show_type`.`id`))) */;

/*View structure for view view_plane */

/*!50001 DROP TABLE IF EXISTS `view_plane` */;
/*!50001 DROP VIEW IF EXISTS `view_plane` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_plane` AS select `plane`.`id` AS `id`,`plane`.`name` AS `name`,`plane`.`seat` AS `seat` from `plane` */;

/*View structure for view view_seat */

/*!50001 DROP TABLE IF EXISTS `view_seat` */;
/*!50001 DROP VIEW IF EXISTS `view_seat` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_seat` AS select `seat`.`id` AS `id`,`seat`.`id_show` AS `id_show`,`seat`.`status` AS `status`,`seat`.`no` AS `no` from (`seat` join `show` on((`seat`.`id_show` = `show`.`id`))) */;

/*View structure for view view_show */

/*!50001 DROP TABLE IF EXISTS `view_show` */;
/*!50001 DROP VIEW IF EXISTS `view_show` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_show` AS select `show`.`id` AS `show_id`,`show`.`name` AS `show_name`,`show`.`code_venue_departure` AS `code_venue_departure`,`show`.`code_venue_destination` AS `code_venue_destination`,`show`.`id_plane` AS `id_plane`,`show`.`departure_time` AS `departure_time`,`show`.`arrive_time` AS `arrive_time`,`show`.`default_price` AS `default_price`,`show_type`.`type` AS `show_type`,`show_type`.`price` AS `show_type_price`,`v1`.`name` AS `venue_name_departure`,`v2`.`name` AS `venue_name_destination`,`v1`.`location` AS `venue_location_departure`,`v2`.`location` AS `venue_location_destination`,`plane`.`name` AS `name` from ((((`show` join `venue` `v1` on((`v1`.`code` = `show`.`code_venue_departure`))) join `venue` `v2` on((`v2`.`code` = `show`.`code_venue_destination`))) join `plane` on((`show`.`id_plane` = `plane`.`id`))) join `show_type` on((`show`.`id_type` = `show_type`.`id`))) */;

/*View structure for view view_show_type */

/*!50001 DROP TABLE IF EXISTS `view_show_type` */;
/*!50001 DROP VIEW IF EXISTS `view_show_type` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_show_type` AS select `show_type`.`id` AS `id`,`show_type`.`type` AS `type`,`show_type`.`price` AS `price` from `show_type` */;

/*View structure for view view_ticket */

/*!50001 DROP TABLE IF EXISTS `view_ticket` */;
/*!50001 DROP VIEW IF EXISTS `view_ticket` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ticket` AS select `ticket`.`id` AS `id`,`ticket`.`name` AS `ticket_name`,`booking`.`id` AS `id_booking`,`seat`.`no` AS `no_seat` from ((`ticket` join `booking` on((`ticket`.`id_booking` = `booking`.`id`))) join `seat` on((`ticket`.`id` = `seat`.`id`))) */;

/*View structure for view view_venue */

/*!50001 DROP TABLE IF EXISTS `view_venue` */;
/*!50001 DROP VIEW IF EXISTS `view_venue` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_venue` AS select `venue`.`code` AS `code`,`venue`.`name` AS `name`,`venue`.`location` AS `location` from `venue` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
