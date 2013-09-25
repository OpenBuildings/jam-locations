DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `locations_branches`;
CREATE TABLE `locations_branches` (
  `ansestor_id` int(11) UNSIGNED NOT NULL,
  `descendant_id` int(11) UNSIGNED NOT NULL,
  `depth` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` int(11) UNSIGNED NULL,
  `city_id` int(11) UNSIGNED NULL,
  `email` varchar(100) NULL,
  `phone` varchar(100) NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) UNSIGNED NULL,
  `city_id` int(11) UNSIGNED NULL,
  `ip` varchar(100) NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `locations` (`id`, `name`, `short_name`, `type`)
VALUES
  (1,'Everywhere', NULL, 'region'),
  (2,'Europe', NULL, 'region'),
  (3,'France', 'FR', 'country'),
  (4,'Turkey', 'TR', 'country'),
  (5,'Germany', 'GR', 'country'),
  (6,'Australia', 'AU', 'country'),
  (7,'United Kingdom', 'UK', 'country'),
  (8,'Russia', 'RU', 'country'),
  (9,'London', NULL, 'city');

INSERT INTO `locations_branches` (`ansestor_id`, `descendant_id`, `depth`)
VALUES
  (1,1,0),
  (2,2,0),
  (3,3,0),
  (4,4,0),
  (5,5,0),
  (6,6,0),
  (7,7,0),
  (8,8,0),
  (9,9,0),
  (1,2,1),
  (1,4,1),
  (1,5,1),
  (1,6,1),
  (1,7,1),
  (1,8,1),
  (1,9,1),
  (1,3,2),
  (1,7,2),
  (1,9,3),
  (2,3,1),
  (2,5,1),
  (2,7,1),
  (2,9,2),
  (7,9,1);