/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - ntw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ntw` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ntw`;

/*Table structure for table `application` */

DROP TABLE IF EXISTS `application`;

CREATE TABLE `application` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `software_exp` varchar(1) NOT NULL,
  `about_career` varchar(255) NOT NULL,
  `current_status` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `application` */

insert  into `application`(`id`,`name`,`email`,`mobile`,`qualification`,`software_exp`,`about_career`,`current_status`,`status`,`created_date`,`modified_date`) values 
(5,'','','','','N','','STUDYING','ACCEPTED','2021-05-27 22:08:33','2021-06-05 17:17:14'),
(6,'','','','','N','','STUDYING','COMPLETED','2021-05-27 22:09:03','2021-06-05 18:52:37'),
(7,'qqwert','gopiwrld@gmail.com','werty','BE','N','asd','STUDYING','USER','2021-05-27 22:13:02','2021-06-06 18:57:48'),
(8,'','','','','N','','STUDYING','USER','2021-05-28 15:16:25','2021-06-06 18:46:09'),
(9,'','','','','N','','STUDYING','USER','2021-05-29 10:41:38','2021-06-06 16:54:17'),
(10,'','','','','Y','','STUDYING','USER','2021-05-31 15:07:10','2021-06-06 18:46:25'),
(11,'','','','','N','','STUDYING','ACCEPTED','2021-05-31 15:07:27','2021-06-05 17:18:37'),
(12,'','','','','N','','STUDYING','COMPLETED','2021-06-05 16:48:15','2021-06-05 18:52:44'),
(13,'','','','','N','','STUDYING','COMPLETED','2021-06-05 16:54:24','2021-06-05 18:52:48'),
(14,'','','','','N','','STUDYING','PENDING','2021-06-05 18:54:03','2021-06-05 18:54:03'),
(15,'','','','','','','STUDYING','PENDING','2021-06-06 19:04:38','2021-06-06 19:04:38'),
(16,'','','','','','','STUDYING','PENDING','2021-06-06 19:04:47','2021-06-06 19:04:47'),
(17,'','','','','','','STUDYING','PENDING','2021-06-06 19:05:20','2021-06-06 19:05:20'),
(18,'','','','','N','','STUDYING','PENDING','2021-06-06 19:05:39','2021-06-06 19:05:39'),
(19,'','','','','N','','STUDYING','PENDING','2021-06-06 19:06:01','2021-06-06 19:06:01');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `url` varchar(75) DEFAULT NULL,
  `desc` varchar(150) DEFAULT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`name`,`url`,`desc`,`parent_id`,`created_date`,`modified_date`) values 
(1,'JavaScript','javascript',NULL,0,'2021-07-10 13:12:36','2021-07-10 13:12:36'),
(2,'JQuery','jquery',NULL,0,'2021-07-12 13:17:25','2021-07-12 13:17:25'),
(3,'Angular','angular',NULL,0,'2021-07-12 13:17:47','2021-07-12 13:17:47'),
(4,'Java','java',NULL,0,'2021-07-12 13:17:57','2021-07-12 13:17:57'),
(5,'Spring Boot','springboot',NULL,0,'2021-07-12 13:18:07','2021-07-12 13:18:07'),
(6,'MySQL','mysql',NULL,0,'2021-07-12 13:18:54','2021-07-12 13:18:54'),
(7,'HTML DOM Event','htmldomevent',NULL,1,'2021-07-22 18:50:50','2021-07-22 19:16:35'),
(8,'Arithmetic','js-arithmetic',NULL,1,'2021-07-22 18:53:01','2021-07-22 19:16:30'),
(9,'Array Const','js-array-const',NULL,1,'2021-07-22 18:53:19','2021-07-22 19:16:51'),
(10,'Array Iteration','js-array-Iteration',NULL,1,'2021-07-22 18:53:38','2021-07-22 19:16:55'),
(11,'Array Methods','js-array-methods',NULL,1,'2021-07-22 18:53:58','2021-07-22 19:17:35'),
(12,'Array Sort','js-array-sort',NULL,1,'2021-07-22 18:54:51','2021-07-22 19:17:40'),
(13,'Arrays','js-arrays',NULL,1,'2021-07-22 18:55:11','2021-07-22 19:17:45'),
(14,'Arrow Function','js-arrow-function',NULL,1,'2021-07-22 18:55:27','2021-07-22 19:17:50'),
(15,'Best Practices','js-best-practices',NULL,1,'2021-07-22 18:55:43','2021-07-22 19:18:25'),
(16,'Break and Continue','js-break-and-continue',NULL,1,'2021-07-22 18:56:10','2021-07-22 19:18:31'),
(17,'Classes','js-classes',NULL,1,'2021-07-22 18:56:22','2021-07-22 19:18:36'),
(18,'Comparison&Logical','js-comparison-logical',NULL,1,'2021-07-22 18:57:35','2021-07-22 19:18:48'),
(19,'Const','js-const',NULL,1,'2021-07-22 18:57:49','2021-07-22 19:19:05'),
(20,'Data Types','js-data-types',NULL,1,'2021-07-22 18:58:24','2021-07-22 19:19:10'),
(21,'Date Formats','js-date-formats',NULL,1,'2021-07-22 18:58:44','2021-07-22 19:19:14'),
(22,'Date Methods','js-date-methods',NULL,1,'2021-07-22 18:59:03','2021-07-22 19:19:18'),
(23,'Date Objects','js-date-objects',NULL,1,'2021-07-22 18:59:17','2021-07-22 19:19:23'),
(24,'Date Set Methods','js-date-set-methods',NULL,1,'2021-07-22 18:59:45','2021-07-22 19:19:34'),
(25,'Debugging','js-debugging',NULL,1,'2021-07-22 19:00:07','2021-07-22 19:19:38'),
(26,'Errors Handle','js-errors-handling',NULL,1,'2021-07-22 19:00:25','2021-07-22 19:19:46'),
(27,'Events','js-events',NULL,1,'2021-07-22 19:00:36','2021-07-22 19:19:51'),
(28,'For In','js-for-in',NULL,1,'2021-07-22 19:00:58','2021-07-22 19:19:57'),
(29,'For Loop','js-for-loop',NULL,1,'2021-07-22 19:01:13','2021-07-22 19:20:02'),
(30,'For Of','js-for-of',NULL,1,'2021-07-22 19:01:30','2021-07-22 19:20:14'),
(31,'Functions','js-functions',NULL,1,'2021-07-22 19:01:46','2021-07-22 19:20:19'),
(32,'If Else','js-if-else',NULL,1,'2021-07-22 19:03:37','2021-07-22 19:20:27'),
(33,'JSON','js-json',NULL,1,'2021-07-22 19:03:57','2021-07-22 19:20:31'),
(34,'Let','js-let',NULL,1,'2021-07-22 19:04:10','2021-07-22 19:20:36'),
(35,'Math','js-math-object',NULL,1,'2021-07-22 19:04:48','2021-07-22 19:20:57'),
(36,'Mistakes','js-mistakes',NULL,1,'2021-07-22 19:05:03','2021-07-22 19:21:00'),
(37,'Number Methods','js-number-methods',NULL,1,'2021-07-22 19:06:01','2021-07-22 19:21:11'),
(38,'Numbers','js-numbers',NULL,1,'2021-07-22 19:06:23','2021-07-22 19:21:15'),
(39,'Objects','js-objects',NULL,1,'2021-07-22 19:06:40','2021-07-22 19:21:20'),
(40,'Operators','js-operators',NULL,1,'2021-07-22 19:06:55','2021-07-22 19:21:24'),
(41,'Performance','js-performance',NULL,1,'2021-07-22 19:07:06','2021-07-22 19:21:28'),
(42,'Random','js-random',NULL,1,'2021-07-22 19:07:17','2021-07-22 19:21:33'),
(43,'RegExp','js-regexp-object',NULL,1,'2021-07-22 19:07:41','2021-07-22 19:21:38'),
(44,'Scope','js-scope',NULL,1,'2021-07-22 19:08:38','2021-07-22 19:22:58'),
(45,'String Methods','js-string-methods',NULL,1,'2021-07-22 19:08:54','2021-07-22 19:22:53'),
(46,'String Search','js-string-search',NULL,1,'2021-07-22 19:09:08','2021-07-22 19:22:48'),
(47,'Strings','js-strings',NULL,1,'2021-07-22 19:09:51','2021-07-22 19:22:44'),
(48,'Style Guide','js-style-guide',NULL,1,'2021-07-22 19:10:03','2021-07-22 19:22:39'),
(49,'Switch','js-switch-statement',NULL,1,'2021-07-22 19:10:18','2021-07-22 19:22:33'),
(50,'Template Literals','js-template-literals',NULL,1,'2021-07-22 19:11:11','2021-07-22 19:22:28'),
(51,'This','js-this',NULL,1,'2021-07-22 19:11:20','2021-07-22 19:22:22'),
(52,'Type Conversions','js-type-conversions',NULL,1,'2021-07-22 19:11:33','2021-07-22 19:22:16'),
(53,'Typeof','js-typeof',NULL,1,'2021-07-22 19:11:47','2021-07-22 19:22:11'),
(54,'Use Strict','js-use-strict',NULL,1,'2021-07-22 19:12:00','2021-07-22 19:22:07'),
(55,'Variables','js-variables',NULL,1,'2021-07-22 19:12:13','2021-07-22 19:21:57'),
(56,'While Loop','js-while-loop',NULL,1,'2021-07-22 19:12:28','2021-07-22 19:21:53');

/*Table structure for table `category_content` */

DROP TABLE IF EXISTS `category_content`;

CREATE TABLE `category_content` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text DEFAULT NULL,
  `file_url` varchar(200) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `category_content` */

insert  into `category_content`(`id`,`content`,`file_url`,`category_id`,`created_date`,`modified_date`) values 
(1,'PGRpdj48ZGl2PjxiPiZsdDtvYmplY3Q8L2I+PC9kaXY+PGRpdj48Yj4mIzE2MDsgZGF0YT0mIzM0O2h0dHBzOi8vZXhhbXBsZS5jb20vdGVzdC5wZGYjcGFnZT0yJiMzNDs8L2I+PC9kaXY+PGRpdj48Yj4mIzE2MDsgdHlwZT0mIzM0O2FwcGxpY2F0aW9uL3BkZiYjMzQ7PC9iPjwvZGl2PjxkaXY+PGI+JiMxNjA7IHdpZHRoPSYjMzQ7MTAwJSYjMzQ7PC9iPjwvZGl2PjxkaXY+PGI+JiMxNjA7IGhlaWdodD0mIzM0OzEwMCUmIzM0OyZndDs8L2I+PC9kaXY+PGRpdj48Yj4mIzE2MDsgJmx0O3AmZ3Q7WW91ciBicm93c2VyIGRvZXMgbm90IHN1cHBvcnQgUERGcy48L2I+PC9kaXY+PGRpdj48Yj4mIzE2MDsgJiMxNjA7ICZsdDthIGhyZWY9JiMzNDtodHRwczovL2V4YW1wbGUuY29tL3Rlc3QucGRmJiMzNDsmZ3Q7RG93bmxvYWQgdGhlIFBERiZsdDsvYSZndDsuJmx0Oy9wJmd0OzwvYj48L2Rpdj48ZGl2PjxiPiZsdDsvb2JqZWN0Jmd0OzwvYj48L2Rpdj48L2Rpdj4=',NULL,1,'2021-07-12 12:30:24','2021-07-22 09:47:21'),
(2,NULL,'JS/HTML DOM Event Object.pdf',2,'2021-07-22 09:47:06','2021-07-22 11:09:27'),
(3,NULL,'JS/HTML DOM Event Object.pdf',7,'2021-07-22 19:42:10','2021-07-22 19:42:10'),
(4,NULL,'JS/JavaScript Arithmetic.pdf',8,'2021-07-22 19:42:48','2021-07-22 19:42:48'),
(5,NULL,'JS/JavaScript Array const.pdf',9,'2021-07-22 19:52:24','2021-07-22 19:52:24'),
(6,NULL,'JS/JavaScript Array Iteration.pdf',10,'2021-07-22 19:52:34','2021-07-22 19:52:34'),
(7,NULL,'JS/JavaScript Array Methods.pdf',11,'2021-07-22 19:52:47','2021-07-22 19:52:47'),
(8,NULL,'JS/JavaScript Array Sort.pdf',12,'2021-07-22 19:52:56','2021-07-22 19:52:56'),
(9,NULL,'JS/JavaScript Arrays.pdf',13,'2021-07-22 19:53:08','2021-07-22 19:53:08'),
(10,NULL,'JS/JavaScript Arrow Function.pdf',14,'2021-07-22 19:53:34','2021-07-22 19:53:34'),
(11,NULL,'JS/JavaScript Best Practices.pdf',15,'2021-07-22 19:54:11','2021-07-22 19:54:11'),
(12,NULL,'JS/JavaScript Break and Continue.pdf',16,'2021-07-22 19:54:20','2021-07-22 19:54:20'),
(13,NULL,'JS/JavaScript Classes.pdf',17,'2021-07-22 19:54:28','2021-07-22 19:54:28'),
(14,NULL,'JS/JavaScript Comparison and Logical Operators.pdf',18,'2021-07-22 19:54:36','2021-07-22 19:54:36'),
(15,NULL,'JS/JavaScript const.pdf',19,'2021-07-22 19:54:45','2021-07-22 19:54:45'),
(16,NULL,'JS/JavaScript Data Types.pdf',20,'2021-07-22 19:54:54','2021-07-22 19:54:54'),
(17,NULL,'JS/JavaScript Date Formats.pdf',21,'2021-07-22 19:55:02','2021-07-22 19:55:02'),
(18,NULL,'JS/JavaScript Date Methods.pdf',22,'2021-07-22 19:55:11','2021-07-22 19:55:11'),
(19,NULL,'JS/JavaScript Date Objects.pdf',23,'2021-07-22 19:55:29','2021-07-22 19:55:29'),
(20,NULL,'JS/JavaScript Date Set Methods.pdf',24,'2021-07-22 19:55:40','2021-07-22 19:55:40'),
(21,NULL,'JS/JavaScript Debugging.pdf',25,'2021-07-22 19:55:48','2021-07-22 19:55:48'),
(22,NULL,'JS/JavaScript Errors Try Catch Throw.pdf',26,'2021-07-22 19:55:55','2021-07-22 19:55:55'),
(23,NULL,'JS/JavaScript Events.pdf',27,'2021-07-22 19:56:03','2021-07-22 19:56:03'),
(24,NULL,'JS/JavaScript For In.pdf',28,'2021-07-22 19:56:12','2021-07-22 19:56:12');

/*Table structure for table `inquiry` */

DROP TABLE IF EXISTS `inquiry`;

CREATE TABLE `inquiry` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(15) DEFAULT NULL,
  `message` varchar(15) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'NEW',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `inquiry` */

insert  into `inquiry`(`id`,`name`,`email`,`subject`,`message`,`status`,`created_date`,`modified_date`) values 
(12,'asasd123','gopiwrld@gmail.com','qwertyuiop','ertyuiop[','NEW','2021-05-27 22:30:26','2021-05-27 22:30:26'),
(13,'','','','','ACCEPTED','2021-05-28 15:17:46','2021-06-05 20:28:29'),
(14,'Gopinath Madheswaran','gopiwrld@gmail.com','qwertyuio','134253647586970','DONE','2021-05-28 15:19:01','2021-06-05 20:28:34'),
(15,'Gopinath Madheswaran','gopiwrld@gmail.com','asdsa','asdfsd','NEW','2021-05-31 15:07:03','2021-05-31 15:07:03');

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `login` */

insert  into `login`(`id`,`username`,`email`,`password`,`type`,`created_date`,`modified_date`) values 
(1,'admin','admin','1111','ADMIN','2021-05-29 18:22:13','2021-05-29 18:22:13'),
(2,'user1','user1','1111','USER','2021-07-15 22:04:09','2021-07-15 22:04:09');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `qualification` varchar(10) DEFAULT NULL,
  `software_exp` varchar(1) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `relieve_date` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`email`,`mobile`,`qualification`,`software_exp`,`address`,`city`,`state`,`country`,`join_date`,`relieve_date`,`note`,`user_type`,`created_date`,`modified_date`) values 
(3,'QQQQ','gopiwrld2@gmail.com','096377522622','BE','Y','35/1 Muniappan kovil street','Erode','Tamil Nadu','India','2021-06-23','2021-06-24','qwerty qertyu werwteyu werwteyruti ertyu','EMPLOYEE','2021-06-06 14:47:06','2021-06-06 17:02:10'),
(4,'ZZZZZZZZ','gopiwrld3@gmail.com','096377522623','BE','Y','35/1 Muniappan kovil street','Erode','Tamil Nadu','India','2021-06-30','2021-07-02','Sample notes are the very best stuff to protect','EMPLOYEE','2021-06-06 15:09:55','2021-06-06 18:58:43'),
(5,'qqwert','gopiwrld5@gmail.com','werty1','BE','N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-06 18:23:11','2021-06-06 18:38:23'),
(6,'qqwert','gopiwrld6@gmail.com','werty6','BE','N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-06 18:38:28','2021-06-06 18:38:42'),
(7,'qqwert','gopiwrld@gmail.com7','werty7','BE','N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-06 18:39:12','2021-06-06 18:40:33'),
(8,'qqwert','gopiwrld@gmail.com8','werty8','BE','N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-06-06 18:40:54','2021-06-06 18:43:53'),
(12,'qqwert','gopiwrld@gmail.com','werty','BE','N','','','','','0000-11-30','0000-11-30','','TRAINEE','2021-06-06 18:57:48','2021-06-06 19:01:39');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
