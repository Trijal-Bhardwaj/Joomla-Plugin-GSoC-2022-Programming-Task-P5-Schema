CREATE TABLE IF NOT EXISTS `#__customform` (
  `articleID` int(10) NOT NULL AUTO_INCREMENT, 
  `formField1` varchar(30) NOT NULL, 
  `formField2` varchar(30) NOT NULL, 
  PRIMARY KEY (`articleID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;
