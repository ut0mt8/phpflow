/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `asn` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `as_number` int(4) unsigned NOT NULL,
  `as_name` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `a` (`as_number`),
  KEY `b` (`as_name`)
) ENGINE=InnoDB AUTO_INCREMENT=43606 DEFAULT CHARSET=latin1;
