CREATE TABLE `markers` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `city1` varchar(60) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `area1` varchar(80) NOT NULL,
  `lat1` float(10,6) NOT NULL,
  `lng1` float(10,6) NOT NULL,
  `city2` varchar(60) NOT NULL,
  `area2` varchar(80) NOT NULL,
  `lat2` float(10,6) NOT NULL,
  `lng2` float(10,6) NOT NULL,
  `dist` float(10,6) NOT NULL
) ENGINE=MyISAM ;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `city1`, `lat`, `lng`, `area1`, `lat1`, `lng1`, `city2`, `area2`, `lat2`, `lng2`, `dist`) VALUES
(1, 'jakarta', -6.175110, 106.865036, 'pluit', -6.115550, 106.783783, 'jakarta', 'cililitan', -6.261060, 106.866142, 18.559999),
(2, 'jakarta', -6.175110, 106.865036, 'marunda', -6.114580, 106.961662, 'jakarta', 'cileduk', -6.236800, 106.758049, 26.290001),
(3, 'jakarta', -6.175110, 106.865036, 'bintaro', -6.271890, 106.764008, 'jakarta', 'sunter', -6.152940, 106.879417, 18.379999),
(4, 'jakarta', -6.175110, 106.865036, 'bekasi', -6.236010, 107.011253, 'jakarta', 'kalideres', -6.151010, 106.696678, 36.029999);