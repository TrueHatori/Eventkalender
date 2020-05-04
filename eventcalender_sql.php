CREATE TABLE IF NOT EXISTS `e107_eventcalender` (
  `ec_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ec_Name` varchar(255) NOT NULL COMMENT 'Name des Events',
  `ec_URL` varchar(255) NOT NULL COMMENT 'URL des Ausrichters',
  `ec_Beginn` datetime NOT NULL COMMENT 'Beginn, Datum und Uhrzeit',
  `ec_Ende` datetime NOT NULL COMMENT 'Ende, Datum und Uhrzeit',
  `ec_Beschreibung` text NOT NULL COMMENT 'Beschreibung',
  PRIMARY KEY (`ec_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Seminare, Events, Parties' AUTO_INCREMENT=1 ;