CREATE TABLE IF NOT EXISTS `Clients` (
`Id` int(2) NOT NULL auto_increment,
`Name` varchar(40) NOT NULL,
`Business` varchar(40) NOT NULL,
`SenderLat` float NOT NULL,
`SenderLong` float NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `Clients` (`Id`, `Name`, `Business`, `SenderLat`, `SenderLong` ) VALUES
(12, 'name', 'business', 0010, 0100);

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
(121111, 12, 111112, 1211111111, 12, 12, 2);

CREATE TABLE IF NOT EXISTS `Drones` (
`Id` int(6) NOT NULL auto_increment,
`Status` int(1) NOT NULL,
`Details` varchar(128) NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ; 

INSERT INTO `Drones` (`Id`, `Status`, `Details`) VALUES
(121111, 1, 'words');

CREATE TABLE IF NOT EXISTS `OrderStatus` (
`Status` int(1) NOT NULL auto_increment,
`Description` varchar(128) NOT NULL,
PRIMARY KEY (`Status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

INSERT INTO `OrderStatus` (`Status`, `Description`) VALUES
(1, 'words')
