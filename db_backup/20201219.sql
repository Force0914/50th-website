/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: action_plan
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `action_plan` (
  `actionid` int(11) NOT NULL AUTO_INCREMENT,
  `proid` int(11) NOT NULL,
  `num` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `opinion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`actionid`),
  KEY `proid` (`proid`),
  CONSTRAINT `action_plan_ibfk_1` FOREIGN KEY (`proid`) REFERENCES `project` (`proid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 69 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: face
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `face` (
  `faceid` int(50) NOT NULL AUTO_INCREMENT,
  `proid` int(50) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `state` set('true', 'false') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`faceid`),
  KEY `proid` (`proid`),
  CONSTRAINT `face_ibfk_1` FOREIGN KEY (`proid`) REFERENCES `project` (`proid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 69 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: opinion
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `opinion` (
  `opid` int(50) NOT NULL AUTO_INCREMENT,
  `faceid` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `num` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `filetype` text COLLATE utf8_unicode_ci NOT NULL,
  `creattime` date NOT NULL DEFAULT current_timestamp(),
  `opinion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`opid`),
  KEY `faceid` (`faceid`, `userid`),
  KEY `userid` (`userid`),
  CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`faceid`) REFERENCES `face` (`faceid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 43 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: project
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `project` (
  `proid` int(50) NOT NULL AUTO_INCREMENT,
  `groupid` int(50) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `des` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`proid`),
  KEY `groupid` (`groupid`)
) ENGINE = InnoDB AUTO_INCREMENT = 26 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: score
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `score` (
  `scoreid` int(11) NOT NULL AUTO_INCREMENT,
  `opid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`scoreid`),
  KEY `userid` (`userid`),
  KEY `opid` (`opid`),
  CONSTRAINT `score_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `score_ibfk_2` FOREIGN KEY (`opid`) REFERENCES `opinion` (`opid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 19 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: score_item
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `score_item` (
  `siid` int(11) NOT NULL AUTO_INCREMENT,
  `proid` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`siid`),
  KEY `proid` (`proid`),
  CONSTRAINT `score_item_ibfk_1` FOREIGN KEY (`proid`) REFERENCES `project` (`proid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: user
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `pre` set('admin', 'user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `account` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# SCHEMA DUMP FOR TABLE: user_group
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user_group` (
  `groupid` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `pre` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `userid` (`userid`),
  KEY `groupid` (`groupid`),
  KEY `groupid_2` (`groupid`) USING BTREE,
  CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`groupid`) REFERENCES `project` (`groupid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: action_plan
# ------------------------------------------------------------

INSERT INTO
  `action_plan` (`actionid`, `proid`, `num`, `name`, `des`, `opinion`)
VALUES
  (56, 20, 'A001', '執行方案1', 'Opinion1,opinion1', '37,39');
INSERT INTO
  `action_plan` (`actionid`, `proid`, `num`, `name`, `des`, `opinion`)
VALUES
  (57, 20, 'A002', '執行方案2', 'Opinion1,opinion2', '37,40');
INSERT INTO
  `action_plan` (`actionid`, `proid`, `num`, `name`, `des`, `opinion`)
VALUES
  (58, 20, 'A003', '執行方案3', 'Opinion2,opinion1', '38,39');
INSERT INTO
  `action_plan` (`actionid`, `proid`, `num`, `name`, `des`, `opinion`)
VALUES
  (59, 20, 'A004', '執行方案4', 'Opinion2,opinion2', '38,40');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: face
# ------------------------------------------------------------

INSERT INTO
  `face` (`faceid`, `proid`, `name`, `des`, `state`)
VALUES
  (32, 20, 'Face 1', 'Test Face 1', 'true');
INSERT INTO
  `face` (`faceid`, `proid`, `name`, `des`, `state`)
VALUES
  (33, 20, 'Face 2', 'Test Face 2', 'true');
INSERT INTO
  `face` (`faceid`, `proid`, `name`, `des`, `state`)
VALUES
  (37, 21, 'Face 1', 'Test Face 1', 'true');
INSERT INTO
  `face` (`faceid`, `proid`, `name`, `des`, `state`)
VALUES
  (38, 21, 'Face 2', 'Test Face 2', 'true');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: opinion
# ------------------------------------------------------------

INSERT INTO
  `opinion` (
    `opid`,
    `faceid`,
    `userid`,
    `num`,
    `name`,
    `des`,
    `file`,
    `filetype`,
    `creattime`,
    `opinion`
  )
VALUES
  (
    37,
    32,
    2,
    '001',
    'Opinion1',
    'Test Opinion1',
    'files/A-Lin《有一種悲傷 A Kind of Sorrow》Official Music Video - 電影『比悲傷更悲傷的故事』主題曲.mp4',
    'video',
    '2020-11-18',
    ''
  );
INSERT INTO
  `opinion` (
    `opid`,
    `faceid`,
    `userid`,
    `num`,
    `name`,
    `des`,
    `file`,
    `filetype`,
    `creattime`,
    `opinion`
  )
VALUES
  (
    38,
    32,
    2,
    '002',
    'Opinion2',
    'Test Opinion 2',
    'files/Trumpwallpapers - 8K Wallpapers.jfif',
    'image',
    '2020-11-18',
    '37'
  );
INSERT INTO
  `opinion` (
    `opid`,
    `faceid`,
    `userid`,
    `num`,
    `name`,
    `des`,
    `file`,
    `filetype`,
    `creattime`,
    `opinion`
  )
VALUES
  (
    39,
    33,
    2,
    '001',
    'opinion1',
    'opinion1',
    '',
    '',
    '2020-11-22',
    ''
  );
INSERT INTO
  `opinion` (
    `opid`,
    `faceid`,
    `userid`,
    `num`,
    `name`,
    `des`,
    `file`,
    `filetype`,
    `creattime`,
    `opinion`
  )
VALUES
  (
    40,
    33,
    2,
    '002',
    'opinion2',
    'opinion2',
    '',
    '',
    '2020-11-22',
    ''
  );

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: project
# ------------------------------------------------------------

INSERT INTO
  `project` (`proid`, `groupid`, `name`, `des`)
VALUES
  (20, 2, 'P1', 'Test Project One');
INSERT INTO
  `project` (`proid`, `groupid`, `name`, `des`)
VALUES
  (21, 3, 'P2', 'Test Project Two');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: score
# ------------------------------------------------------------

INSERT INTO
  `score` (`scoreid`, `opid`, `userid`, `score`)
VALUES
  (14, 37, 2, 5);
INSERT INTO
  `score` (`scoreid`, `opid`, `userid`, `score`)
VALUES
  (15, 37, 4, 1);
INSERT INTO
  `score` (`scoreid`, `opid`, `userid`, `score`)
VALUES
  (18, 38, 2, 2);

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: score_item
# ------------------------------------------------------------

INSERT INTO
  `score_item` (`siid`, `proid`, `name`)
VALUES
  (3, 20, '美觀');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: user
# ------------------------------------------------------------

INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (2, 'admin', '1234', 'admin', 'admin');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (3, 'utest1', '1234', 'user', 'test1');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (4, 'utest2', '1234', 'user', 'test2');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (5, 'utest3', '1234', 'user', 'test3');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (6, 'utest4', '1234', 'user', 'test4');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (7, 'utest5', '1234', 'user', 'test5');
INSERT INTO
  `user` (`id`, `username`, `password`, `pre`, `account`)
VALUES
  (8, 'utest6', '1234', 'user', 'test6');

# ------------------------------------------------------------
# DATA DUMP FOR TABLE: user_group
# ------------------------------------------------------------

INSERT INTO
  `user_group` (`groupid`, `userid`, `pre`)
VALUES
  (3, 6, 'admin');
INSERT INTO
  `user_group` (`groupid`, `userid`, `pre`)
VALUES
  (3, 7, 'user');
INSERT INTO
  `user_group` (`groupid`, `userid`, `pre`)
VALUES
  (3, 8, 'user');
INSERT INTO
  `user_group` (`groupid`, `userid`, `pre`)
VALUES
  (2, 8, 'admin');
INSERT INTO
  `user_group` (`groupid`, `userid`, `pre`)
VALUES
  (2, 6, 'user');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
