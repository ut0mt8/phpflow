/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `interface_map` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `router_ip` char(45) NOT NULL,
  `iface_id` int(4) DEFAULT NULL,
  `iface_desc` char(45) NOT NULL,
  `router_desc` char(20) DEFAULT NULL,
  `direction` char(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
