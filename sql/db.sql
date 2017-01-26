-- Dumping structure for table wapi.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `author` text,
  `pages` int(11) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `isbn` int(10) unsigned zerofill DEFAULT NULL,
  `publishdate` varchar(50) DEFAULT NULL,
  `cover` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumping data for table wapi.books: ~3 rows (approximately)
DELETE FROM `books`;
INSERT INTO `books` (`id`, `title`, `author`, `pages`, `format`, `isbn`, `publishdate`, `cover`) VALUES
	(30, 'Scrappy Little Nobody', 'Anna Kendrick', 1024, 'A4', 0000123456, '11/12/2016', 'uploads/cfcd208495d565ef66e7dff9f98764da.png'),
	(33, 'testbook123', 'no one', 123456, 'A4', 0000123456, '11/12/2016', 'uploads/62cdbfceb26eae76cd28c1f221b901aa.jpg'),
	(35, 'Scrappy Little Nobody', 'Anna Kendrick', 1024, 'A4', 0000123456, '11/12/2016', 'uploads/cfcd208495d565ef66e7dff9f98764da.png'),
	(36, 'testbook123', 'no one', 123456, 'A4', 0000123456, '11/12/2016', 'uploads/62cdbfceb26eae76cd28c1f221b901aa.jpg'),
	(37, 'fag', 'fag', 1024, 'A4', 0000123456, '11/12/2016', 'uploads/cba38c1129c3004521b7bec51650a7d0.png'),
	(38, 'Scrappy Little Nobody', 'Anna Kendrick', 1024, 'A4', 0000123456, '11/12/2016', 'uploads/cfcd208495d565ef66e7dff9f98764da.png'),
	(39, 'testbook123', 'no one', 123456, 'A4', 0000123456, '11/12/2016', 'uploads/62cdbfceb26eae76cd28c1f221b901aa.jpg'),
	(41, 'Scrappy Little Nobody', 'Anna Kendrick', 1024, 'A4', 0000123456, '11/12/2016', 'uploads/cfcd208495d565ef66e7dff9f98764da.png'),
	(42, 'testbook123', 'no one', 123456, 'A4', 0000123456, '11/12/2016', 'uploads/62cdbfceb26eae76cd28c1f221b901aa.jpg');

-- Dumping structure for table wapi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `password` text COMMENT 'sha512',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table wapi.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `password`) VALUES
	(1, 'test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff ');
