/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `netflow_asn_in` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `tag` int(4) unsigned NOT NULL,
  `tag2` int(4) unsigned NOT NULL,
  `as_src` int(4) unsigned NOT NULL,
  `packets` int(10) unsigned NOT NULL,
  `bytes` bigint(20) unsigned NOT NULL,
  `stamp_inserted` datetime NOT NULL,
  `stamp_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`stamp_inserted`),
  KEY `a` (`as_src`),
  KEY `h` (`stamp_updated`),
  KEY `g` (`stamp_inserted`),
  KEY `j` (`tag2`)
) ENGINE=InnoDB AUTO_INCREMENT=11442224 DEFAULT CHARSET=utf8;
