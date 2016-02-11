/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `intervals` (
  `seconds` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`seconds`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
