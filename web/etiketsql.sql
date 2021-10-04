SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `datas`;
CREATE TABLE IF NOT EXISTS `datas` (
  `dataid` int(11) NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) DEFAULT NULL,
  `datas` text DEFAULT NULL,
  `datarow` int(11) DEFAULT NULL,
  `datacolumn` int(11) DEFAULT NULL,
  PRIMARY KEY (`dataid`),
  KEY `dataset_id` (`dataset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `dataset`;
CREATE TABLE IF NOT EXISTS `dataset` (
  `dataset_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `dscomment` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `dataset_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`dataset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `datas_tagged`;
CREATE TABLE IF NOT EXISTS `datas_tagged` (
  `taggedid` int(11) NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) DEFAULT NULL,
  `datarow` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `tagid` int(11) DEFAULT NULL,
  PRIMARY KEY (`taggedid`),
  KEY `dataset_id` (`dataset_id`),
  KEY `tagid` (`tagid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `data_column`;
CREATE TABLE IF NOT EXISTS `data_column` (
  `columnid` int(11) NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) DEFAULT NULL,
  `columnr` int(11) DEFAULT NULL,
  `column_name` varchar(50) DEFAULT NULL,
  `column_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`columnid`),
  KEY `dataset_id` (`dataset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `data_tag`;
CREATE TABLE IF NOT EXISTS `data_tag` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `dataset_id` int(11) DEFAULT NULL,
  `tagrow` int(11) DEFAULT NULL,
  `tagname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tagid`),
  KEY `dataset_id` (`dataset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(21) DEFAULT NULL,
  `userpass` varchar(21) DEFAULT NULL,
  `authority` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `datas`
  ADD CONSTRAINT `datas_ibfk_1` FOREIGN KEY (`dataset_id`) REFERENCES `dataset` (`dataset_id`);

ALTER TABLE `datas_tagged`
  ADD CONSTRAINT `datas_tagged_ibfk_1` FOREIGN KEY (`dataset_id`) REFERENCES `dataset` (`dataset_id`),
  ADD CONSTRAINT `datas_tagged_ibfk_2` FOREIGN KEY (`tagid`) REFERENCES `data_tag` (`tagid`),
  ADD CONSTRAINT `datas_tagged_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user_role` (`userid`);

ALTER TABLE `data_column`
  ADD CONSTRAINT `data_column_ibfk_1` FOREIGN KEY (`dataset_id`) REFERENCES `dataset` (`dataset_id`);

ALTER TABLE `data_tag`
  ADD CONSTRAINT `data_tag_ibfk_1` FOREIGN KEY (`dataset_id`) REFERENCES `dataset` (`dataset_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
