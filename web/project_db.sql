CREATE TABLE IF NOT EXISTS `Clients` (
`Id` int(2) NOT NULL auto_increment,
`Name` varchar(40) NOT NULL,
`Business` varchar(40) NOT NULL,
`SenderLat` float NOT NULL,
`SenderLong` float NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `Clients` (`Id`, `Name`, `Business`, `SenderLat`, `SenderLong` ) VALUES
(01, 'Will Christie', 'WTC', 39.7555, -105.2211),
(02, 'Paul Laliberte', 'PRKL', 39.7392, -104.9903),
(03, 'Kylee Budai', 'K.B', 30.0150, -105.2705),
(04, 'Nicholas Johnston', 'NIJO', 39.9205, -105.0867),
(05, 'Bill Christie', 'BTC', 39.8028, -105.0875);

CREATE TABLE IF NOT EXISTS `Orders` (
`OrderId` int(6) NOT NULL auto_increment,
`ClientId` int(2) NOT NULL,
`DroneId` int(6) NOT NULL,
`OrderTimestamp` int(10) NOT NULL,
`RecieverLat` float NOT NULL,
`RecieverLong` float NOT NULL,
`Status` int(1) NOT NULL,
PRIMARY KEY (`OrderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ; 

INSERT INTO `Orders` (`OrderId`, `ClientId`, `DroneId`, `OrderTimestamp`, `RecieverLat`, `RecieverLong`, `Status`) VALUES
(121112, 1, 111111, 2016061512, 39.8367, -105.0372, 1),
(121113, 1, 111113, 2016061501, 39.9528, -105.1686, 1),
(121114, 2, 111114, 2016052611, 39.9778, -105.1319, 2),
(121115, 3, 111115, 2016042803, 39.9614, -105.5108, 2),
(121116, 4, 111116, 2016061504, 39.0639, -108.5506, 1),
(121117, 5, 111117, 2016061409, 40.0861, -105.9395, 1),
(121118, 5, 111118, 2016061404, 37.9375, -107.8123, 2);

CREATE TABLE IF NOT EXISTS `Drones` (
`Id` int(6) NOT NULL auto_increment,
`Status` int(1) NOT NULL,
`Details` varchar(128) NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ; 

INSERT INTO `Drones` (`Id`, `Status`, `Details`) VALUES
(111111, 1, 'in transit'),
(111113, 1, 'in transit'),
(111114, 1, 'deliver complete'),
(111115, 1, 'delivery complete'),
(111116, 1, 'in transit'),
(111117, 1, 'in transit'),
(111118, 0, 'returning');


CREATE TABLE IF NOT EXISTS `OrderStatus` (
`Status` int(1) NOT NULL auto_increment,
`Description` varchar(128) NOT NULL,
PRIMARY KEY (`Status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `OrderStatus` (`Status`, `Description`) VALUES
(1, 'in transit'),
(2, 'delivered');
