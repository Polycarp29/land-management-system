/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - revenue
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`revenue` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `revenue`;

/*Table structure for table `audittrail` */

DROP TABLE IF EXISTS `audittrail`;

CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(80) DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `action` varchar(80) DEFAULT NULL,
  `table` varchar(80) DEFAULT NULL,
  `field` varchar(80) DEFAULT NULL,
  `keyvalue` longtext DEFAULT NULL,
  `oldvalue` longtext DEFAULT NULL,
  `newvalue` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=744 DEFAULT CHARSET=utf8mb4;

/*Data for the table `audittrail` */

insert  into `audittrail`(`id`,`datetime`,`script`,`user`,`action`,`table`,`field`,`keyvalue`,`oldvalue`,`newvalue`) values 
(1,'2021-07-03 20:06:06','/revenue/login.php','admin','login','::1','','','',''),
(2,'2021-07-03 20:07:53','/revenue/userlevelsedit.php','-1','U','userlevels','userlevelname','1','Revenue Collector','Revenue'),
(3,'2021-07-03 20:08:15','/revenue/userlevelsedit.php','-1','U','userlevels','userlevelname','1','Revenue','Revenue Collector'),
(4,'2021-07-04 08:55:00','/revenue/login.php','admin','login','::1','','','',''),
(5,'2021-07-04 11:01:01','/revenue/propertyedit.php','-1','U','property','ChargeableFee','1','5000.00','788888'),
(6,'2021-07-04 11:01:24','/revenue/propertyedit.php','-1','U','property','ChargeGropuDes','1','5',NULL),
(7,'2021-07-04 11:01:24','/revenue/propertyedit.php','-1','U','property','ChargeableFee','1','9999.99','788888'),
(8,'2021-07-04 11:01:24','/revenue/propertyedit.php','-1','U','property','PropertyUse','1','Commercial',NULL),
(9,'2021-07-04 11:03:40','/revenue/propertyedit.php','-1','U','property','ChargeGropuDes','1',NULL,'5'),
(10,'2021-07-04 11:03:40','/revenue/propertyedit.php','-1','U','property','ChargeableFee','1','9999.99','5000.00'),
(11,'2021-07-04 11:03:40','/revenue/propertyedit.php','-1','U','property','PropertyUse','1',NULL,'Commercial'),
(12,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','ClientId','2','','3289'),
(13,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','ChargeGroup','2','','2'),
(14,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','ChargeGropuDes','2','','5'),
(15,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','ChargeableFee','2','',NULL),
(16,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','AmountPayable','2','',NULL),
(17,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','Property','2','',NULL),
(18,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','PropertyUse','2','','Commercial'),
(19,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','CurrentBalance','2','',NULL),
(20,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','Description','2','',NULL),
(21,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','DataRegistered','2','',NULL),
(22,'2021-07-04 15:04:16','/revenue/propertyadd.php','-1','A','property','id','2','','2'),
(23,'2021-07-04 15:07:13','/revenue/propertyedit.php','-1','U','property','BalanceBF','2','0.00',NULL),
(24,'2021-07-04 15:07:13','/revenue/propertyedit.php','-1','U','property','Property','2',NULL,'Billboard'),
(25,'2021-07-04 15:07:13','/revenue/propertyedit.php','-1','U','property','AmountPaid','2','0.00',NULL),
(26,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','*** Batch delete begin ***','property','','','',''),
(27,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','id','2','2',''),
(28,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','ClientId','2','3289',''),
(29,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','Property','2','Billboard',''),
(30,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','ChargeGroup','2','2',''),
(31,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','ChargeGropuDes','2','5',''),
(32,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','PropertyUse','2','Commercial',''),
(33,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','ChargeableFee','2',NULL,''),
(34,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','BalanceBF','2',NULL,''),
(35,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','AmountPayable','2',NULL,''),
(36,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','DataRegistered','2',NULL,''),
(37,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','Description','2',NULL,''),
(38,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','AmountPaid','2',NULL,''),
(39,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','D','property','CurrentBalance','2',NULL,''),
(40,'2021-07-04 15:12:31','/revenue/propertydelete.php','-1','*** Batch delete successful ***','property','','','',''),
(41,'2021-07-04 18:07:58','/revenue/propertyedit.php','-1','U','property','AmountPayable','1',NULL,'5000'),
(42,'2021-07-04 18:07:58','/revenue/propertyedit.php','-1','U','property','CurrentBalance','1',NULL,'5000'),
(43,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','1','','3290'),
(44,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','1','','1'),
(45,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','1','','Commercial'),
(46,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','1','','5000.00'),
(47,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','1','','300'),
(48,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','1','','4700'),
(49,'2021-07-04 18:08:22','/revenue/property_revenuadd.php','-1','A','property_revenu','id','1','','1'),
(50,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(51,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','id','1','1',''),
(52,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','1','3290',''),
(53,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','1','1',''),
(54,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','1','Commercial',''),
(55,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','1','5000.00',''),
(56,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','1','300.00',''),
(57,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','1','4700.00',''),
(58,'2021-07-04 18:17:07','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(59,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','2','','3290'),
(60,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','2','','1'),
(61,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','2','','Commercial'),
(62,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','2','','5000.00'),
(63,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','2','','300'),
(64,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','2','','4700'),
(65,'2021-07-04 18:17:20','/revenue/property_revenuadd.php','-1','A','property_revenu','id','2','','2'),
(66,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(67,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','id','2','2',''),
(68,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','2','3290',''),
(69,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','2','1',''),
(70,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','2','Commercial',''),
(71,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','2','5000.00',''),
(72,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','2','300.00',''),
(73,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','2','4700.00',''),
(74,'2021-07-04 18:23:24','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(75,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','3','','3290'),
(76,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','3','','1'),
(77,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','3','','Commercial'),
(78,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','3','','5000.00'),
(79,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','3','','300'),
(80,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','3','','4700'),
(81,'2021-07-04 18:23:37','/revenue/property_revenuadd.php','-1','A','property_revenu','id','3','','3'),
(82,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(83,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','id','3','3',''),
(84,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','3','3290',''),
(85,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','3','1',''),
(86,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','3','Commercial',''),
(87,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','3','5000.00',''),
(88,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','3','300.00',''),
(89,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','3','4700.00',''),
(90,'2021-07-04 18:28:17','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(91,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','4','','3290'),
(92,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','4','','1'),
(93,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','4','','Commercial'),
(94,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','4','','5000.00'),
(95,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','4','','300'),
(96,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','4','','4700'),
(97,'2021-07-04 18:28:30','/revenue/property_revenuadd.php','-1','A','property_revenu','id','4','','4'),
(98,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','5','','3290'),
(99,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','5','','1'),
(100,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','5','','Commercial'),
(101,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','5','','4700.00'),
(102,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','5','','300'),
(103,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','5','','4400'),
(104,'2021-07-04 18:31:00','/revenue/property_revenuadd.php','-1','A','property_revenu','id','5','','5'),
(105,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','6','','3290'),
(106,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','6','','1'),
(107,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','6','','Commercial'),
(108,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','6','','4400.00'),
(109,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','6','','300'),
(110,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','6','','4100'),
(111,'2021-07-04 18:34:29','/revenue/property_revenuadd.php','-1','A','property_revenu','id','6','','6'),
(112,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','7','','3290'),
(113,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','7','','1'),
(114,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','7','','Commercial'),
(115,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','7','','4100.00'),
(116,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','7','','100'),
(117,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','7','','4000'),
(118,'2021-07-04 18:35:00','/revenue/property_revenuadd.php','-1','A','property_revenu','id','7','','7'),
(119,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(120,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','7','7',''),
(121,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','7','3290',''),
(122,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','7','1',''),
(123,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','7','Commercial',''),
(124,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','7','4100.00',''),
(125,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','7','100.00',''),
(126,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','7','4000.00',''),
(127,'2021-07-04 18:44:00','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(128,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(129,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','id','4','4',''),
(130,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','4','3290',''),
(131,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','4','1',''),
(132,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','4','Commercial',''),
(133,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','4','5000.00',''),
(134,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','4','300.00',''),
(135,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','4','4700.00',''),
(136,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','id','5','5',''),
(137,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','5','3290',''),
(138,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','5','1',''),
(139,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','5','Commercial',''),
(140,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','5','4700.00',''),
(141,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','5','300.00',''),
(142,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','5','4400.00',''),
(143,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','id','6','6',''),
(144,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','6','3290',''),
(145,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','6','1',''),
(146,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','6','Commercial',''),
(147,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','6','4400.00',''),
(148,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','6','300.00',''),
(149,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','6','4100.00',''),
(150,'2021-07-04 18:44:04','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(151,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','8','','3290'),
(152,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','8','','1'),
(153,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','8','','Commercial'),
(154,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','8','','5000.00'),
(155,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','8','','300'),
(156,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','8','','4700'),
(157,'2021-07-04 18:44:43','/revenue/property_revenuadd.php','-1','A','property_revenu','id','8','','8'),
(158,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','9','','3290'),
(159,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','9','','1'),
(160,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','9','','Commercial'),
(161,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','9','','4700.00'),
(162,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','9','','100'),
(163,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','9','','4600'),
(164,'2021-07-04 18:45:08','/revenue/property_revenuadd.php','-1','A','property_revenu','id','9','','9'),
(165,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','10','','3290'),
(166,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','10','','1'),
(167,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','10','','Commercial'),
(168,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','10','','4600.00'),
(169,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','10','','300'),
(170,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','10','','4300'),
(171,'2021-07-04 19:21:45','/revenue/property_revenuadd.php','-1','A','property_revenu','id','10','','10'),
(172,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','11','','3290'),
(173,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','11','','1'),
(174,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','11','','Commercial'),
(175,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','11','','4300.00'),
(176,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','11','','100'),
(177,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','11','','4200'),
(178,'2021-07-04 19:45:54','/revenue/property_revenuadd.php','-1','A','property_revenu','id','11','','11'),
(179,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','12','','3290'),
(180,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','12','','1'),
(181,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','12','','Commercial'),
(182,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','12','','4200.00'),
(183,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','12','','100'),
(184,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','12','','4100'),
(185,'2021-07-04 19:48:39','/revenue/property_revenuadd.php','-1','A','property_revenu','id','12','','12'),
(186,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','13','','3290'),
(187,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','13','','1'),
(188,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','13','','Commercial'),
(189,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','13','','4100.00'),
(190,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','13','','100'),
(191,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','13','','4000'),
(192,'2021-07-04 19:51:47','/revenue/property_revenuadd.php','-1','A','property_revenu','id','13','','13'),
(193,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','14','','3290'),
(194,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','14','','1'),
(195,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','14','','Commercial'),
(196,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','14','','4000.00'),
(197,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','14','','100'),
(198,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','14','','3900'),
(199,'2021-07-04 19:54:06','/revenue/property_revenuadd.php','-1','A','property_revenu','id','14','','14'),
(200,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','15','','3290'),
(201,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','15','','1'),
(202,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','15','','Commercial'),
(203,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','15','','4000.00'),
(204,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','15','','100'),
(205,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','15','','3900'),
(206,'2021-07-04 19:55:01','/revenue/property_revenuadd.php','-1','A','property_revenu','id','15','','15'),
(207,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','16','','3290'),
(208,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','16','','1'),
(209,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','16','','Commercial'),
(210,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','16','','3900.00'),
(211,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','16','','100'),
(212,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','16','','3800'),
(213,'2021-07-04 20:08:21','/revenue/property_revenuadd.php','-1','A','property_revenu','id','16','','16'),
(214,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','17','','3290'),
(215,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','17','','1'),
(216,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','17','','Commercial'),
(217,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','17','','3800.00'),
(218,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','17','','300'),
(219,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','17','','3500'),
(220,'2021-07-04 20:09:17','/revenue/property_revenuadd.php','-1','A','property_revenu','id','17','','17'),
(221,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','18','','3290'),
(222,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','18','','1'),
(223,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','18','','Commercial'),
(224,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','18','','3500.00'),
(225,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','18','','100'),
(226,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','18','','3400'),
(227,'2021-07-04 20:11:28','/revenue/property_revenuadd.php','-1','A','property_revenu','id','18','','18'),
(228,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(229,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','8','8',''),
(230,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','8','3290',''),
(231,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','8','1',''),
(232,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','8','Commercial',''),
(233,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','8','5000.00',''),
(234,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','8','300.00',''),
(235,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','8','4700.00',''),
(236,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','9','9',''),
(237,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','9','3290',''),
(238,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','9','1',''),
(239,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','9','Commercial',''),
(240,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','9','4700.00',''),
(241,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','9','100.00',''),
(242,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','9','4600.00',''),
(243,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','10','10',''),
(244,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','10','3290',''),
(245,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','10','1',''),
(246,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','10','Commercial',''),
(247,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','10','4600.00',''),
(248,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','10','300.00',''),
(249,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','10','4300.00',''),
(250,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','11','11',''),
(251,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','11','3290',''),
(252,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','11','1',''),
(253,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','11','Commercial',''),
(254,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','11','4300.00',''),
(255,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','11','100.00',''),
(256,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','11','4200.00',''),
(257,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','12','12',''),
(258,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','12','3290',''),
(259,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','12','1',''),
(260,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','12','Commercial',''),
(261,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','12','4200.00',''),
(262,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','12','100.00',''),
(263,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','12','4100.00',''),
(264,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','13','13',''),
(265,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','13','3290',''),
(266,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','13','1',''),
(267,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','13','Commercial',''),
(268,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','13','4100.00',''),
(269,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','13','100.00',''),
(270,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','13','4000.00',''),
(271,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','14','14',''),
(272,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','14','3290',''),
(273,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','14','1',''),
(274,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','14','Commercial',''),
(275,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','14','4000.00',''),
(276,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','14','100.00',''),
(277,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','14','3900.00',''),
(278,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','15','15',''),
(279,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','15','3290',''),
(280,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','15','1',''),
(281,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','15','Commercial',''),
(282,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','15','4000.00',''),
(283,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','15','100.00',''),
(284,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','15','3900.00',''),
(285,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','16','16',''),
(286,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','16','3290',''),
(287,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','16','1',''),
(288,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','16','Commercial',''),
(289,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','16','3900.00',''),
(290,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','16','100.00',''),
(291,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','16','3800.00',''),
(292,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','id','17','17',''),
(293,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','17','3290',''),
(294,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','17','1',''),
(295,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','17','Commercial',''),
(296,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','17','3800.00',''),
(297,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','17','300.00',''),
(298,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','17','3500.00',''),
(299,'2021-07-04 20:21:22','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(300,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(301,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','id','18','18',''),
(302,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','18','3290',''),
(303,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','18','1',''),
(304,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','18','Commercial',''),
(305,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','18','3500.00',''),
(306,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','18','100.00',''),
(307,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','18','3400.00',''),
(308,'2021-07-04 20:21:31','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(309,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','19','','3290'),
(310,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','19','','1'),
(311,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','19','','Commercial'),
(312,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','19','','3400.00'),
(313,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','19','','300'),
(314,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','19','','3100'),
(315,'2021-07-05 07:57:09','/revenue/property_revenuadd.php','-1','A','property_revenu','id','19','','19'),
(316,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','20','','3290'),
(317,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','20','','1'),
(318,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','20','','Commercial'),
(319,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','20','','3100.00'),
(320,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','20','','100'),
(321,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','20','','3000'),
(322,'2021-07-05 07:58:21','/revenue/property_revenuadd.php','-1','A','property_revenu','id','20','','20'),
(323,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','21','','3290'),
(324,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','21','','1'),
(325,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','21','','Commercial'),
(326,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','21','','3000.00'),
(327,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','21','','100'),
(328,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','21','','2900'),
(329,'2021-07-05 11:06:06','/revenue/property_revenuadd.php','-1','A','property_revenu','id','21','','21'),
(330,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','22','','3290'),
(331,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','22','','1'),
(332,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','22','','Commercial'),
(333,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','22','','2900.00'),
(334,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','22','','100'),
(335,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','22','','2800'),
(336,'2021-07-05 11:10:12','/revenue/property_revenuadd.php','-1','A','property_revenu','id','22','','22'),
(337,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','23','','3290'),
(338,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','23','','1'),
(339,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','23','','Commercial'),
(340,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','23','','2800.00'),
(341,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','23','','100'),
(342,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','23','','2700'),
(343,'2021-07-05 11:11:27','/revenue/property_revenuadd.php','-1','A','property_revenu','id','23','','23'),
(344,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','24','','3290'),
(345,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','24','','1'),
(346,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','24','','Commercial'),
(347,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','24','','2700.00'),
(348,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','24','','100'),
(349,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','24','','2600'),
(350,'2021-07-05 11:16:23','/revenue/property_revenuadd.php','-1','A','property_revenu','id','24','','24'),
(351,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','25','','3290'),
(352,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','25','','1'),
(353,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','25','','Commercial'),
(354,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','25','','2600.00'),
(355,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','25','','100'),
(356,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','25','','2500'),
(357,'2021-07-05 11:21:35','/revenue/property_revenuadd.php','-1','A','property_revenu','id','25','','25'),
(358,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','26','','3290'),
(359,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','26','','1'),
(360,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','26','','Commercial'),
(361,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','26','','2500.00'),
(362,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','26','','100'),
(363,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','26','','2400'),
(364,'2021-07-05 11:23:09','/revenue/property_revenuadd.php','-1','A','property_revenu','id','26','','26'),
(365,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','27','','3290'),
(366,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','27','','1'),
(367,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','27','','Commercial'),
(368,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','27','','2400.00'),
(369,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','27','','100'),
(370,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','27','','2300'),
(371,'2021-07-05 11:25:22','/revenue/property_revenuadd.php','-1','A','property_revenu','id','27','','27'),
(372,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(373,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','19','19',''),
(374,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','19','3290',''),
(375,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','19','1',''),
(376,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','19','Commercial',''),
(377,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','19','3400.00',''),
(378,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','19','300.00',''),
(379,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','19','3100.00',''),
(380,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','20','20',''),
(381,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','20','3290',''),
(382,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','20','1',''),
(383,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','20','Commercial',''),
(384,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','20','3100.00',''),
(385,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','20','100.00',''),
(386,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','20','3000.00',''),
(387,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','21','21',''),
(388,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','21','3290',''),
(389,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','21','1',''),
(390,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','21','Commercial',''),
(391,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','21','3000.00',''),
(392,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','21','100.00',''),
(393,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','21','2900.00',''),
(394,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','22','22',''),
(395,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','22','3290',''),
(396,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','22','1',''),
(397,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','22','Commercial',''),
(398,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','22','2900.00',''),
(399,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','22','100.00',''),
(400,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','22','2800.00',''),
(401,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','23','23',''),
(402,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','23','3290',''),
(403,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','23','1',''),
(404,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','23','Commercial',''),
(405,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','23','2800.00',''),
(406,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','23','100.00',''),
(407,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','23','2700.00',''),
(408,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','24','24',''),
(409,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','24','3290',''),
(410,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','24','1',''),
(411,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','24','Commercial',''),
(412,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','24','2700.00',''),
(413,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','24','100.00',''),
(414,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','24','2600.00',''),
(415,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','25','25',''),
(416,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','25','3290',''),
(417,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','25','1',''),
(418,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','25','Commercial',''),
(419,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','25','2600.00',''),
(420,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','25','100.00',''),
(421,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','25','2500.00',''),
(422,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','26','26',''),
(423,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','26','3290',''),
(424,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','26','1',''),
(425,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','26','Commercial',''),
(426,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','26','2500.00',''),
(427,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','26','100.00',''),
(428,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','26','2400.00',''),
(429,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','id','27','27',''),
(430,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','27','3290',''),
(431,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','27','1',''),
(432,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','27','Commercial',''),
(433,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','27','2400.00',''),
(434,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','27','100.00',''),
(435,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','27','2300.00',''),
(436,'2021-07-05 11:28:58','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(437,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','28','','3290'),
(438,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','28','','1'),
(439,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','28','','Commercial'),
(440,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','28','','2300.00'),
(441,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','28','','100'),
(442,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','28','','2200'),
(443,'2021-07-05 12:20:17','/revenue/property_revenuadd.php','-1','A','property_revenu','id','28','','28'),
(444,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','29','','3290'),
(445,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','29','','1'),
(446,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','29','','Commercial'),
(447,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','29','','2200.00'),
(448,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','29','','100'),
(449,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','29','','2100'),
(450,'2021-07-05 12:23:14','/revenue/property_revenuadd.php','-1','A','property_revenu','id','29','','29'),
(451,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','30','','3290'),
(452,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','30','','1'),
(453,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','30','','Commercial'),
(454,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','30','','2100.00'),
(455,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','30','','100'),
(456,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','30','','2000'),
(457,'2021-07-05 12:24:16','/revenue/property_revenuadd.php','-1','A','property_revenu','id','30','','30'),
(458,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','31','','3290'),
(459,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','31','','1'),
(460,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','31','','Commercial'),
(461,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','31','','2000.00'),
(462,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','31','','100'),
(463,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','31','','1900'),
(464,'2021-07-05 12:27:16','/revenue/property_revenuadd.php','-1','A','property_revenu','id','31','','31'),
(465,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','32','','3290'),
(466,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','32','','1'),
(467,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','32','','Commercial'),
(468,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','32','','1900.00'),
(469,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','32','','100'),
(470,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','32','','1800'),
(471,'2021-07-05 13:35:33','/revenue/property_revenuadd.php','-1','A','property_revenu','id','32','','32'),
(472,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','33','','3290'),
(473,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','33','','1'),
(474,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','33','','Commercial'),
(475,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','33','','1800.00'),
(476,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','33','','300'),
(477,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','33','','1500'),
(478,'2021-07-05 13:40:34','/revenue/property_revenuadd.php','-1','A','property_revenu','id','33','','33'),
(479,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','*** Batch delete begin ***','property_revenu','','','',''),
(480,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','28','28',''),
(481,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','28','3290',''),
(482,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','28','1',''),
(483,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','28','Commercial',''),
(484,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','28','2300.00',''),
(485,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','28','100.00',''),
(486,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','28','2200.00',''),
(487,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','29','29',''),
(488,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','29','3290',''),
(489,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','29','1',''),
(490,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','29','Commercial',''),
(491,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','29','2200.00',''),
(492,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','29','100.00',''),
(493,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','29','2100.00',''),
(494,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','30','30',''),
(495,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','30','3290',''),
(496,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','30','1',''),
(497,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','30','Commercial',''),
(498,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','30','2100.00',''),
(499,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','30','100.00',''),
(500,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','30','2000.00',''),
(501,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','31','31',''),
(502,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','31','3290',''),
(503,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','31','1',''),
(504,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','31','Commercial',''),
(505,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','31','2000.00',''),
(506,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','31','100.00',''),
(507,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','31','1900.00',''),
(508,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','32','32',''),
(509,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','32','3290',''),
(510,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','32','1',''),
(511,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','32','Commercial',''),
(512,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','32','1900.00',''),
(513,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','32','100.00',''),
(514,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','32','1800.00',''),
(515,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','id','33','33',''),
(516,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientId','33','3290',''),
(517,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','ClientProperty','33','1',''),
(518,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','PropertyUse','33','Commercial',''),
(519,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPayable','33','1800.00',''),
(520,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','AmountPaid','33','300.00',''),
(521,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','D','property_revenu','Balance','33','1500.00',''),
(522,'2021-07-05 15:28:00','/revenue/property_revenudelete.php','-1','*** Batch delete successful ***','property_revenu','','','',''),
(523,'2021-07-06 08:24:52','/revenue/logout.php','-1','logout','::1','','','',''),
(524,'2021-07-06 08:39:49','/revenue/login.php','admin','login','::1','','','',''),
(525,'2021-07-06 12:08:50','/revenue/login.php','admin','login','::1','','','',''),
(526,'2021-07-06 12:24:08','/revenue/login.php','admin','login','::1','','','',''),
(527,'2021-07-06 12:28:57','/revenue/propertyedit.php','-1','U','property','ClientId','1','78845','3290'),
(528,'2021-07-06 12:29:35','/revenue/propertyedit.php','-1','U','property','ClientId','1','3290','3289'),
(529,'2021-07-06 12:30:03','/revenue/propertyedit.php','-1','U','property','ClientId','1','3289','3288'),
(530,'2021-07-06 12:30:24','/revenue/propertyedit.php','-1','U','property','ClientId','1','3288','3290'),
(531,'2021-07-06 12:32:22','/revenue/propertyedit.php','-1','U','property','ClientId','1','3290','3288'),
(532,'2021-07-06 13:07:21','/revenue/login.php','admin','login','::1','','','',''),
(533,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','34','','3288'),
(534,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','34','','1'),
(535,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','34','','Commercial'),
(536,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','34','','1500.00'),
(537,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','34','','300'),
(538,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','34','','1200'),
(539,'2021-07-06 13:07:41','/revenue/property_revenuadd.php','-1','A','property_revenu','id','34','','34'),
(540,'2021-07-06 15:36:12','/revenue/login.php','admin','login','::1','','','',''),
(541,'2021-07-06 15:46:19','/revenue/propertyedit.php','-1','U','property','PropertyId','1',NULL,'BB4008'),
(542,'2021-07-06 15:47:30','/revenue/property_revenuedit.php','-1','U','property_revenu','PropertyId','34',NULL,'BB4008'),
(543,'2021-07-06 15:47:30','/revenue/property_revenuedit.php','-1','U','property_revenu','AmountPayable','34','1500.00','1200.00'),
(544,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','35','','3288'),
(545,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','35','','1'),
(546,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','35','','BB4008'),
(547,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','35','','Commercial'),
(548,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','35','','1200.00'),
(549,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','35','','300.00'),
(550,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','35','','900'),
(551,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','date','35','','2021-07-06'),
(552,'2021-07-06 16:06:10','/revenue/property_revenuadd.php','-1','A','property_revenu','id','35','','35'),
(553,'2021-07-07 09:00:41','/revenue/login.php','admin','login','::1','','','',''),
(554,'2021-07-07 09:02:15','/revenue/login.php','admin','login','::1','','','',''),
(555,'2021-07-07 10:14:26','/revenue/login.php','admin','login','::1','','','',''),
(556,'2021-07-07 11:43:33','/revenue/login.php','admin','login','::1','','','',''),
(557,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','ClientId','3','','3290'),
(558,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','ChargeGroup','3','','2'),
(559,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','ChargeGropuDes','3','','5'),
(560,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','ChargeableFee','3','','5000.00'),
(561,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','BalanceBF','3','','0'),
(562,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','AmountPayable','3','','5000'),
(563,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','Property','3','','Billboard'),
(564,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','PropertyId','3','','BB4008'),
(565,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','PropertyUse','3','','Commercial'),
(566,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','AmountPaid','3','','0'),
(567,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','CurrentBalance','3','','5000'),
(568,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','Description','3','',NULL),
(569,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','DataRegistered','3','','2021-07-07'),
(570,'2021-07-07 11:58:23','/revenue/propertyadd.php','-1','A','property','id','3','','3'),
(571,'2021-07-08 06:22:20','/revenue/login.php','admin','login','::1','','','',''),
(572,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','36','','3290'),
(573,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','36','','3'),
(574,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','36','','BB4008'),
(575,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','36','','Commercial'),
(576,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','36','','5000.00'),
(577,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','36','','300'),
(578,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','36','','4700'),
(579,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','date','36','','2021-07-08'),
(580,'2021-07-08 07:03:39','/revenue/property_revenuadd.php','-1','A','property_revenu','id','36','','36'),
(581,'2021-07-08 18:57:07','/revenue/property_revenuedit.php','-1','U','property_revenu','date','57','2021-07-08 11:16:10','2020-01-08'),
(582,'2021-07-08 19:00:35','/revenue/charge_grouplist.php','-1','U','charge_group','ChargeGroupName','2','Rates','Property Rates'),
(583,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','ChargeGroup','49','','1'),
(584,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','ChargeDesc','49','','Fire Certificate'),
(585,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','PropertyUse','49','','Commercial'),
(586,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','Fee','49','','1600'),
(587,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','Factor','49','','1'),
(588,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','UnitOfMeasure','49','','1 Form'),
(589,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','PeriodType','49','','A'),
(590,'2021-07-08 19:01:55','/revenue/chargesadd.php','-1','A','charges','ChargeCode','49','','49'),
(591,'2021-07-08 19:36:53','/revenue/login.php','admin','login','::1','','','',''),
(592,'2021-07-09 06:18:09','/revenue/login.php','admin','login','::1','','','',''),
(593,'2021-07-09 09:16:51','/revenue/login.php','admin','login','::1','','','',''),
(594,'2021-07-09 14:05:33','/revenue/login.php','admin','login','::1','','','',''),
(595,'2021-07-09 19:12:07','/revenue/login.php','admin','login','::1','','','',''),
(596,'2021-07-10 16:21:13','/revenue/login.php','admin','login','::1','','','',''),
(597,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','ClientId','4','','3288'),
(598,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','ChargeGroup','4','','2'),
(599,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','ChargeGropuDes','4','','5'),
(600,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','ChargeableFee','4','','5000.00'),
(601,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','BalanceBF','4','','.00'),
(602,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','AmountPayable','4','','5000.00'),
(603,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','Property','4','','Billboard'),
(604,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','PropertyId','4','','BB4007'),
(605,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','PropertyUse','4','','Commercial'),
(606,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','Location','4','','Lusaka'),
(607,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','AmountPaid','4','','2850.00'),
(608,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','CurrentBalance','4','','2150.00'),
(609,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','Description','4','',NULL),
(610,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','DataRegistered','4','','2021-07-07'),
(611,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','PhysicalAddress','4','',NULL),
(612,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','Status','4','','1'),
(613,'2021-07-10 19:35:36','/revenue/propertyadd.php','-1','A','property','id','4','','4'),
(614,'2021-07-10 20:57:16','/revenue/logout.php','Administrator','logout','::1','','','',''),
(615,'2021-07-10 21:06:34','/rates/admin/login.php','admin','login','::1','','','',''),
(616,'2021-07-11 16:15:02','/revenue/login.php','admin','login','::1','','','',''),
(617,'2021-07-11 16:18:25','/rates/admin/login.php','admin','login','::1','','','',''),
(618,'2021-07-11 16:21:17','/rates/admin/logout.php','Administrator','logout','::1','','','',''),
(619,'2021-07-11 16:36:14','/revenue/login.php','admin','login','::1','','','',''),
(620,'2021-07-12 03:15:48','/revenue/login.php','admin','login','::1','','','',''),
(621,'2021-07-12 04:16:09','/revenue/login.php','admin','login','::1','','','',''),
(622,'2021-07-12 04:24:11','/revenue/login.php','admin','login','::1','','','',''),
(623,'2021-07-12 13:22:28','/revenue/login.php','admin','login','::1','','','',''),
(624,'2021-07-12 14:12:39','/revenue/login.php','admin','login','::1','','','',''),
(625,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','59','','3290'),
(626,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','59','','3'),
(627,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','59','','BB4008'),
(628,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','59','','Commercial'),
(629,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','59','','4650.00'),
(630,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','59','','2000'),
(631,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','59','','2650'),
(632,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','date','59','','2021-02-26'),
(633,'2021-07-12 17:31:21','/revenue/property_revenuadd.php','-1','A','property_revenu','id','59','','59'),
(634,'2021-07-14 07:24:01','/revenue/login.php','admin','login','::1','','','',''),
(635,'2021-07-14 07:46:18','/rates/admin/login.php','admin','login','::1','','','',''),
(636,'2021-07-14 07:47:39','/revenue/clientedit.php','-1','U','client','Email','3288,77582','kapiya.developer@gmail.com','exampl@gmail.com'),
(637,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','ClientName','3291,1234','','Charles'),
(638,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','ClientType','3291,1234','','1'),
(639,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','IdentityType','3291,1234','','1'),
(640,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','ClientID','3291,1234','','1234'),
(641,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','Surname','3291,1234','','Charles'),
(642,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','FirstName','3291,1234','','Mukupa'),
(643,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','MiddleName','3291,1234','','K'),
(644,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','Gender','3291,1234','','Male'),
(645,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','MaritalStatus','3291,1234','','Single'),
(646,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','DateOfBirth','3291,1234','','2021-07-14'),
(647,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','PostalAddress','3291,1234','','85/10 Off Chimwemwe Street'),
(648,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','PhysicalAddress','3291,1234','','85/10 Off Chimwemwe Street Kabanana Site &amp; Service'),
(649,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','TownOrVillage','3291,1234','','Lusaka'),
(650,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','Mobile','3291,1234','','+260979848064'),
(651,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','Email','3291,1234','','kapiyacharles@gmail.com'),
(652,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','NextOfKin','3291,1234','',NULL),
(653,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','NextOfKinMobile','3291,1234','',NULL),
(654,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','NextOfKinEmail','3291,1234','',NULL),
(655,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','AdditionalInformation','3291,1234','',NULL),
(656,'2021-07-14 07:50:42','/revenue/clientadd.php','-1','A','client','id','3291,1234','','3291'),
(657,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','ClientId','5','','3291'),
(658,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','ChargeGroup','5','','2'),
(659,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','ChargeGropuDes','5','','5'),
(660,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','ChargeableFee','5','','5000.00'),
(661,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','BalanceBF','5','','.00'),
(662,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','AmountPayable','5','','5000.00'),
(663,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','Property','5','','Billboard'),
(664,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','PropertyId','5','','BB4009'),
(665,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','PropertyUse','5','','Commercial'),
(666,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','Location','5','','Lusaka'),
(667,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','AmountPaid','5','','0.00'),
(668,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','CurrentBalance','5','','5000.00'),
(669,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','Description','5','',NULL),
(670,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','DataRegistered','5','','2021-07-07'),
(671,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','PhysicalAddress','5','',NULL),
(672,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','Status','5','','1'),
(673,'2021-07-14 07:52:54','/revenue/propertyadd.php','-1','A','property','id','5','','5'),
(674,'2021-07-14 08:21:24','/revenue/login.php','admin','login','::1','','','',''),
(675,'2021-07-14 08:28:29','/revenue/clientedit.php','-1','U','client','ClientName','3290,GRZ4522','Ministry Of Finance','Client User'),
(676,'2021-07-14 08:29:46','/revenue/login.php','admin','login','::1','','','',''),
(677,'2021-07-14 08:31:06','/revenue/charge_grouplist.php','-1','*** Batch update begin ***','charge_group','','','',''),
(678,'2021-07-14 08:31:06','/revenue/charge_grouplist.php','-1','U','charge_group','ChargeGroupName','3','Personal Levy','Land Rates'),
(679,'2021-07-14 08:31:06','/revenue/charge_grouplist.php','-1','*** Batch update successful ***','charge_group','','','',''),
(680,'2021-07-14 08:44:09','/revenue/login.php','admin','login','::1','','','',''),
(681,'2021-07-14 08:52:29','/revenue/usersadd.php','-1','A','users','Fullname','1','','RC'),
(682,'2021-07-14 08:52:29','/revenue/usersadd.php','-1','A','users','Username','1','','charles'),
(683,'2021-07-14 08:52:29','/revenue/usersadd.php','-1','A','users','Passsword','1','','********'),
(684,'2021-07-14 08:52:29','/revenue/usersadd.php','-1','A','users','userLevelId','1','','1'),
(685,'2021-07-14 08:52:29','/revenue/usersadd.php','-1','A','users','id','1','','1'),
(686,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','*** Batch delete begin ***','users','','','',''),
(687,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','D','users','id','1','1',''),
(688,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','D','users','Fullname','1','RC',''),
(689,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','D','users','Username','1','charles',''),
(690,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','D','users','Passsword','1','********',''),
(691,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','D','users','userLevelId','1','1',''),
(692,'2021-07-14 08:52:37','/revenue/usersdelete.php','-1','*** Batch delete successful ***','users','','','',''),
(693,'2021-07-14 08:54:33','/revenue/login.php','admin','login','::1','','','',''),
(694,'2021-07-14 08:56:16','/revenue/logout.php','Administrator','logout','::1','','','',''),
(695,'2021-07-14 10:29:10','/revenue/login.php','admin','login','::1','','','',''),
(696,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','Fullname','2','','Charles Mukupa'),
(697,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','Username','2','','kupa'),
(698,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','Email','2','','kapiyacharles@gmail.com'),
(699,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','Passsword','2','','********'),
(700,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','userLevelId','2','','-1'),
(701,'2021-07-14 10:29:41','/revenue/usersadd.php','-1','A','users','id','2','','2'),
(702,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','*** Batch delete begin ***','users','','','',''),
(703,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','id','2','2',''),
(704,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','Fullname','2','Charles Mukupa',''),
(705,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','Username','2','kupa',''),
(706,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','Email','2','kapiyacharles@gmail.com',''),
(707,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','Passsword','2','********',''),
(708,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','D','users','userLevelId','2','-1',''),
(709,'2021-07-14 10:45:20','/revenue/usersdelete.php','-1','*** Batch delete successful ***','users','','','',''),
(710,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','Fullname','3','','Mukupa K Charles'),
(711,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','Username','3','','charles'),
(712,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','Email','3','','kapiyacharles@gmail.com'),
(713,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','Passsword','3','','********'),
(714,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','userLevelId','3','','-1'),
(715,'2021-07-14 10:46:15','/revenue/usersadd.php','-1','A','users','id','3','','3'),
(716,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','61','','3291'),
(717,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','61','','5'),
(718,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','61','','BB4009'),
(719,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','61','','Commercial'),
(720,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','61','','3000.00'),
(721,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','61','','100'),
(722,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','61','','2900'),
(723,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','date','61','','2021-07-14'),
(724,'2021-07-14 16:09:41','/revenue/property_revenuadd.php','-1','A','property_revenu','id','61','','61'),
(725,'2021-07-15 04:13:09','/revenue/login.php','admin','login','::1','','','',''),
(726,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','62','','3288'),
(727,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','62','','4'),
(728,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','62','','BB4007'),
(729,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','62','','Commercial'),
(730,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','62','','5000.00'),
(731,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','62','','300'),
(732,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','62','','4700'),
(733,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','date','62','','2021-06-26'),
(734,'2021-07-15 05:03:38','/revenue/property_revenuadd.php','-1','A','property_revenu','id','62','','62'),
(735,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientId','63','','3288'),
(736,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','ClientProperty','63','','4'),
(737,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyId','63','','BB4007'),
(738,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','PropertyUse','63','','Commercial'),
(739,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPayable','63','','4700.00'),
(740,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','AmountPaid','63','','300'),
(741,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','Balance','63','','4400'),
(742,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','date','63','','2021-07-14'),
(743,'2021-07-15 05:16:57','/revenue/property_revenuadd.php','-1','A','property_revenu','id','63','','63');

/*Table structure for table `billing_period` */

DROP TABLE IF EXISTS `billing_period`;

CREATE TABLE `billing_period` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `BillingYear` year(4) DEFAULT NULL,
  `BillingCycle` char(1) DEFAULT NULL,
  `From` date DEFAULT NULL,
  `To` date DEFAULT NULL,
  `Status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `billing_period` */

insert  into `billing_period`(`id`,`BillingYear`,`BillingCycle`,`From`,`To`,`Status`) values 
(1,2021,'A','2021-01-01','2021-12-31','1');

/*Table structure for table `charge_group` */

DROP TABLE IF EXISTS `charge_group`;

CREATE TABLE `charge_group` (
  `ChargeGroupCode` int(255) NOT NULL AUTO_INCREMENT,
  `ChargeGroupName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ChargeGroupCode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `charge_group` */

insert  into `charge_group`(`ChargeGroupCode`,`ChargeGroupName`) values 
(1,'Fire Certificate'),
(2,'Property Rates'),
(3,'Land Rates');

/*Table structure for table `charges` */

DROP TABLE IF EXISTS `charges`;

CREATE TABLE `charges` (
  `ChargeCode` int(255) NOT NULL AUTO_INCREMENT,
  `ChargeGroup` int(100) DEFAULT NULL,
  `ChargeDesc` varchar(100) DEFAULT NULL,
  `PropertyUse` varchar(100) DEFAULT NULL,
  `Fee` double(6,2) DEFAULT NULL,
  `UnitOfMeasure` varchar(30) DEFAULT NULL,
  `PeriodType` varchar(10) DEFAULT NULL,
  `Factor` double(6,2) DEFAULT 1.00,
  PRIMARY KEY (`ChargeCode`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

/*Data for the table `charges` */

insert  into `charges`(`ChargeCode`,`ChargeGroup`,`ChargeDesc`,`PropertyUse`,`Fee`,`UnitOfMeasure`,`PeriodType`,`Factor`) values 
(5,2,'Bill Board','Commercial',5000.00,'Mast','Q',1.00),
(49,1,'Fire Certificate','Commercial',1600.00,'1 Form','A',1.00);

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(255) DEFAULT NULL,
  `ClientType` int(10) DEFAULT 1,
  `IdentityType` varchar(100) DEFAULT '1' COMMENT '1=NRC, 2=PASSPORT, 3=DriverLicense, 4=VotersCard, 5=PACRA Number',
  `ClientID` varchar(20) NOT NULL DEFAULT '0',
  `Surname` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `MaritalStatus` varchar(100) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `PostalAddress` varchar(255) DEFAULT NULL,
  `PhysicalAddress` varchar(255) DEFAULT NULL,
  `TownOrVillage` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `NextOfKin` varchar(255) DEFAULT NULL,
  `NextOfKinMobile` varchar(255) DEFAULT NULL,
  `NextOfKinEmail` varchar(255) DEFAULT NULL,
  `AdditionalInformation` text DEFAULT NULL,
  PRIMARY KEY (`id`,`ClientID`)
) ENGINE=InnoDB AUTO_INCREMENT=3292 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`id`,`ClientName`,`ClientType`,`IdentityType`,`ClientID`,`Surname`,`FirstName`,`MiddleName`,`Gender`,`MaritalStatus`,`DateOfBirth`,`PostalAddress`,`PhysicalAddress`,`TownOrVillage`,`Mobile`,`Email`,`NextOfKin`,`NextOfKinMobile`,`NextOfKinEmail`,`AdditionalInformation`) values 
(3288,'J and P Markets',2,'5','77582',NULL,NULL,NULL,NULL,NULL,NULL,'ISHOP WORLDWIDE 733 59TH ST','Lusaka','Lusaka','7188389686','exampl@gmail.com',NULL,NULL,NULL,'Private Business'),
(3289,'Kim Jong-un',1,'1','124505/10/11','Jong-un','Kim',NULL,'Male',NULL,'1989-03-15','North Korea','Korea','Korea','485521189','kapiya.developer@gmail.com',NULL,NULL,NULL,'Individual applicant'),
(3290,'Client User',3,'5','GRZ4522',NULL,NULL,NULL,NULL,NULL,NULL,'Lusaka','lusa','Lusaka','+260972478562','kapiya.developer@gmail.com',NULL,NULL,NULL,'Government wing.'),
(3291,'Charles',1,'1','1234','Charles','Mukupa','K','Male','Single','2021-07-14','85/10 Off Chimwemwe Street','85/10 Off Chimwemwe Street Kabanana Site &amp; Service','Lusaka','+260979848064','kapiyacharles@gmail.com',NULL,NULL,NULL,NULL);

/*Table structure for table `client_login` */

DROP TABLE IF EXISTS `client_login`;

CREATE TABLE `client_login` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientId` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `client_login` */

insert  into `client_login`(`id`,`ClientId`,`Password`,`date`) values 
(3,'3290','81dc9bdb52d04dc20036dbd8313ed055','2021-07-07 04:44:42'),
(4,'3291','81dc9bdb52d04dc20036dbd8313ed055','2021-07-14 00:51:37');

/*Table structure for table `client_query` */

DROP TABLE IF EXISTS `client_query`;

CREATE TABLE `client_query` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientId` varchar(255) DEFAULT NULL,
  `Query` text DEFAULT NULL,
  `Reply` text DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp(),
  `Status` enum('1','2') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `client_query` */

insert  into `client_query`(`id`,`ClientId`,`Query`,`Reply`,`Date`,`Status`) values 
(6,'GRZ4522','Hellow',NULL,'2021-07-09 01:23:43','1'),
(7,'GRZ4522','Hellow',NULL,'2021-07-09 01:24:16','1'),
(8,'GRZ4522','Hello, i need assistance changing my clientName',NULL,'2021-07-09 01:25:33','1');

/*Table structure for table `client_type` */

DROP TABLE IF EXISTS `client_type`;

CREATE TABLE `client_type` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientType` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `client_type` */

insert  into `client_type`(`id`,`ClientType`) values 
(1,'Individual'),
(2,'Private/Public company'),
(3,'Government'),
(4,'NGO'),
(5,'Society');

/*Table structure for table `property` */

DROP TABLE IF EXISTS `property`;

CREATE TABLE `property` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientId` int(100) DEFAULT NULL,
  `Property` varchar(200) DEFAULT NULL,
  `PropertyId` varchar(10) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `ChargeGroup` int(100) DEFAULT NULL,
  `ChargeGropuDes` int(100) DEFAULT NULL,
  `PropertyUse` varchar(100) DEFAULT NULL,
  `ChargeableFee` double(10,2) NOT NULL DEFAULT 0.00,
  `BalanceBF` double(10,2) NOT NULL DEFAULT 0.00,
  `AmountPayable` double(10,2) NOT NULL DEFAULT 0.00,
  `AmountPaid` double(10,2) NOT NULL DEFAULT 0.00,
  `DataRegistered` date DEFAULT NULL,
  `CurrentBalance` double(10,2) NOT NULL DEFAULT 0.00,
  `Description` text DEFAULT NULL,
  `PhysicalAddress` text DEFAULT NULL,
  `Status` enum('1','2') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `property` */

insert  into `property`(`id`,`ClientId`,`Property`,`PropertyId`,`Location`,`ChargeGroup`,`ChargeGropuDes`,`PropertyUse`,`ChargeableFee`,`BalanceBF`,`AmountPayable`,`AmountPaid`,`DataRegistered`,`CurrentBalance`,`Description`,`PhysicalAddress`,`Status`) values 
(3,3290,'Billboard','BB4008',NULL,2,5,'Commercial',5000.00,0.00,5000.00,4850.00,'2021-07-07',2650.00,NULL,NULL,'1'),
(4,3288,'Billboard','BB4007','Lusaka',2,5,'Commercial',5000.00,0.00,5000.00,600.00,'2021-07-07',4400.00,NULL,NULL,'1'),
(5,3291,'Billboard','BB4009','Lusaka',2,5,'Commercial',5000.00,0.00,5000.00,2100.00,'2021-07-07',2900.00,NULL,NULL,'1');

/*Table structure for table `property_revenu` */

DROP TABLE IF EXISTS `property_revenu`;

CREATE TABLE `property_revenu` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientId` int(100) DEFAULT NULL,
  `ClientProperty` int(100) DEFAULT NULL,
  `PropertyId` varchar(10) DEFAULT NULL,
  `PropertyUse` varchar(100) DEFAULT NULL,
  `AmountPayable` double(10,2) DEFAULT NULL,
  `AmountPaid` double(10,2) DEFAULT NULL,
  `Balance` double(10,2) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

/*Data for the table `property_revenu` */

insert  into `property_revenu`(`id`,`ClientId`,`ClientProperty`,`PropertyId`,`PropertyUse`,`AmountPayable`,`AmountPaid`,`Balance`,`date`) values 
(56,3290,3,'BB4008','Commercial',5000.00,350.00,4650.00,'2021-07-08 11:09:46'),
(57,3290,3,'BB4008','Commercial',4650.00,1500.00,3150.00,'2020-01-08 00:00:00'),
(58,3290,3,'BB4008','Commercial',3150.00,1000.00,2150.00,'2021-07-08 11:23:08'),
(59,3290,3,'BB4008','Commercial',4650.00,2000.00,2650.00,'2021-02-26 00:00:00'),
(60,3291,5,'BB4009','Commercial',5000.00,2000.00,3000.00,'2021-07-14 00:56:33'),
(61,3291,5,'BB4009','Commercial',3000.00,100.00,2900.00,'2021-07-14 00:00:00'),
(62,3288,4,'BB4007','Commercial',5000.00,300.00,4700.00,'2021-06-26 00:00:00'),
(63,3288,4,'BB4007','Commercial',4700.00,300.00,4400.00,'2021-07-14 00:00:00');

/*Table structure for table `property_use` */

DROP TABLE IF EXISTS `property_use`;

CREATE TABLE `property_use` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `PropertyUse` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `property_use` */

insert  into `property_use`(`id`,`PropertyUse`) values 
(1,'Commercial'),
(2,'Residential');

/*Table structure for table `system_settings` */

DROP TABLE IF EXISTS `system_settings`;

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `system_settings` */

insert  into `system_settings`(`id`,`name`,`email`,`contact`,`address`,`cover_img`) values 
(1,'LCC1','revenuedepartment@infor.com','+260 979 865 768','Plot #23. Lusaka','');

/*Table structure for table `update_requests` */

DROP TABLE IF EXISTS `update_requests`;

CREATE TABLE `update_requests` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ClientId` int(255) DEFAULT NULL,
  `NewClientIdentity` varchar(100) DEFAULT NULL,
  `NewClientName` varchar(100) DEFAULT NULL,
  `NewAccountType` int(3) DEFAULT NULL,
  `NewMobileNumber` varchar(50) DEFAULT NULL,
  `NewEmail` varchar(100) DEFAULT NULL,
  `NewAdditionalInformation` text DEFAULT NULL,
  `Property` varchar(100) DEFAULT NULL,
  `PropertyId` varchar(20) DEFAULT NULL,
  `PropertyUse` varchar(100) DEFAULT NULL,
  `Comment` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `update_requests` */

insert  into `update_requests`(`id`,`ClientId`,`NewClientIdentity`,`NewClientName`,`NewAccountType`,`NewMobileNumber`,`NewEmail`,`NewAdditionalInformation`,`Property`,`PropertyId`,`PropertyUse`,`Comment`,`date`,`status`) values 
(4,3290,'GRZ4522','Client User',NULL,'+260972478562','kapiya.developer@gmail.com','Government wing.',NULL,NULL,NULL,NULL,'2021-07-14 01:22:07','0'),
(5,3290,'GRZ4522','Client User',NULL,'+260972478562','kapiya.developer@gmail.com','Government wing.',NULL,NULL,NULL,NULL,'2021-07-14 01:23:55','0'),
(6,3290,'GRZ4522','Client User',NULL,'+260972478562','kapiya.developer@gmail.com','Government wing.',NULL,NULL,NULL,NULL,'2021-07-14 01:27:17','0');

/*Table structure for table `userlevelpermissions` */

DROP TABLE IF EXISTS `userlevelpermissions`;

CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(191) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `userlevelpermissions` */

insert  into `userlevelpermissions`(`userlevelid`,`tablename`,`permission`) values 
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}audittrail',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charges',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charge_group',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_type',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_revenu',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_use',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevelpermissions',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevels',0),
(-2,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}users',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}allBills.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}audittrail',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}backup.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}backupFiles.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billing_period',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billRecords.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}bills.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billsPrint.php',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charges',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charge_group',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_login',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_query',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_type',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_revenu',369),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_use',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}Rates_Report',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}reportview',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}system_settings',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}update_requests',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevelpermissions',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevels',0),
(1,'{F82056AB-CEC6-48BF-AA9B-76524AD406BC}users',0);

/*Table structure for table `userlevels` */

DROP TABLE IF EXISTS `userlevels`;

CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `userlevels` */

insert  into `userlevels`(`userlevelid`,`userlevelname`) values 
(-2,'Anonymous'),
(-1,'Administrator'),
(0,'Default'),
(1,'Revenue Collector');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(100) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Passsword` varchar(255) DEFAULT NULL,
  `userLevelId` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`Fullname`,`Username`,`Email`,`Passsword`,`userLevelId`) values 
(3,'Mukupa K Charles','charles','kapiyacharles@gmail.com','43c1a51373d560a2270d3fd1dcf9ca1d',-1);

/*Table structure for table `reportview` */

DROP TABLE IF EXISTS `reportview`;

/*!50001 DROP VIEW IF EXISTS `reportview` */;
/*!50001 DROP TABLE IF EXISTS `reportview` */;

/*!50001 CREATE TABLE  `reportview`(
 `ChargeGroupName` varchar(100) ,
 `AmountPayable` double(10,2) ,
 `AmountPaid` double(10,2) ,
 `Balance` double(10,2) ,
 `date` datetime 
)*/;

/*View structure for view reportview */

/*!50001 DROP TABLE IF EXISTS `reportview` */;
/*!50001 DROP VIEW IF EXISTS `reportview` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reportview` AS select `charge_group`.`ChargeGroupName` AS `ChargeGroupName`,`property_revenu`.`AmountPayable` AS `AmountPayable`,`property_revenu`.`AmountPaid` AS `AmountPaid`,`property_revenu`.`Balance` AS `Balance`,`property_revenu`.`date` AS `date` from (((`charge_group` left join `charges` on(`charge_group`.`ChargeGroupCode` = `charges`.`ChargeGroup`)) left join `property` on(`charges`.`ChargeGroup` = `property`.`ChargeGroup`)) left join `property_revenu` on(`property`.`id` = `property_revenu`.`ClientProperty`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
