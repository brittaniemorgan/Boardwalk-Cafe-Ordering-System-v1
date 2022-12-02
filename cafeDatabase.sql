DROP DATABASE IF EXISTS cafeInfo;
CREATE DATABASE cafeInfo;
USE cafeInfo;

GRANT ALL PRIVILEGES ON cafeInfo.* TO 'boardwalk_user'@'localhost' IDENTIFIED BY 'password123';


DROP TABLE IF EXISTS `menuItems`;
CREATE TABLE `menuItems` (
    `id` int(11) NOT NULL AUTO_INCREMENT ,
    `name` varchar(50) NOT NULL default '',
    `category` varchar(35)  NOT NULL default '',
    `medium_size` char(3) NOT NULL default 'MED', 
    `large_size` char(3) NOT NULL default '', 
    `price` int(5)  NOT NULL default 0,
    `large_price` int(5) NOT NULL default 0,
    `image` varchar(50) NOT NULL default 'default-menu-image.jpg',
    `in_stock` varchar(3) NOT NULL default 'YES',
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `menuItems` VALUES (1, 'Chicken','Sandwiches', 'MED', '', 510, 0, "chicken-sandwich.jpg", "YES"),
    (2, 'B.L.T','Sandwiches', 'MED', '', 510, 0, "blt.jpg", "YES"),
    (3, 'Turkey Club','Sandwiches', 'MED', '', 570, 0, "turkey-club.jpg", "YES"),
    (4, 'Traditional Club','Sandwiches', 'MED', '', 570, 0, "traditional-club.jpg", "YES"),

    (5, 'Traditional Club','Wraps', 'MED', '', 635, 0, "trad-club-wrap.jpg", "YES"),
    (6, 'Turkey Club','Wraps', 'MED', '', 665, 0, "turkey-wrap.jpg", "YES"),
    (7, 'Chicken','Wraps', 'MED', '', 630, 0, "chicken-wrap.jpeg", "YES"),
    (8, 'Ham and Cheese','Wraps', 'MED', '', 630, 0, "ham-cheese-wrap.jpg", "YES"),

    (9, 'Fried Chicken','Jamaican', 'MED', 'LRG', 700, 850, "fried-chicken.jpg", "YES"),
    (10, 'Spicy Baked Chicken','Jamaican', 'MED', 'LRG', 700, 850, "spicy-baked-chicken.jpg", "YES"),
    (11, 'BBQ Pork','Jamaican', 'MED', 'LRG', 700, 850, "bbq-pork.jpg", "YES"),
    (12, 'Curried Chicken','Jamaican', 'MED', 'LRG', 700, 850, "curried-chicken.jpg", "YES"),

    (13, 'Latte','Beverages', 'MED', 'LRG', 300, 410, "latte.jpg", "YES"),
    (14, 'Cappuchino','Beverages', 'MED', 'LRG', 300, 410, "cappuccino.jpg", "YES"),
    (15, 'Mocha','Beverages', 'MED', 'LRG', 320, 435, "mocha.png", "YES"),
    (16, 'Hot Chocolate','Beverages', 'MED', 'LRG', 255, 290, "hot-chocolate.jpg", "YES"),
    (17, 'Mint Tea','Beverages', 'MED', 'LRG', 180, 200, "mint-tea.jpeg", "YES");



DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL default '',
    `password` varchar(300)  NOT NULL default '',
    `reward points` int(11) NOT NULL default 0,
    `phoneNum` int(10) NOT NULL default 0,
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` VALUES(1, "John", "3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2", 20,876948523),
(2, "Mary", "7b61e5b16e3f9d685578819e9ded8ca15f4095043895fc325da208255d91f7c8d6a166fe9b52cfdebb17960dab24687d91e7e4bff81f2468695387f804bf1a0d", 50,876468503);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `total` int(11) NOT NULL default 0,
    `items` varchar(300)  NOT NULL default '',
    `status` char(4) NOT NULL default 'OPEN',
    `delivered` varchar(3) NOT NULL default 'NO',
    `date` varchar(11) NOT NULL default '',
    `gen_del_location` varchar(80) NOT NULL default '',
    `address` varchar(100) NOT NULL default '',
    `start_time` varchar(10) NOT NULL default '',
    `end_time` varchar(10) NOT NULL default '',
    `cusId` int(11) NOT NULL default 0,
    `deliveryPersonnel` varchar(100) NOT NULL default '',
    `payment` varchar(4) NOT NULL default '',
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders` VALUES (1, 1550, '10 MED, 12 LRG', 'OPEN', 'NO', '26/Nov/2022', 'UWI', 'Sagicor ATM, Leslie Robinson Hall', '02:31 pm', '02:36 pm', 1,'Chad Williams', 'CARD'),
(2, 550, '1 MED', 'OPEN', 'NO', '26/Nov/2022', 'UWI', 'T5 Mighty Dragons, ELR Towers', '02:31 pm', '02:36 pm', 1,'Chad Williams', 'CARD'),
(3, 1890, '5 MED, 12 LRG', 'OPEN', 'NO', '02/Dec/2022', 'Papine', 'Tastee, Papine Square', '02:35 pm', '02:42 pm', 2, 'Jason Campbell', 'CARD'),
(4, 150, '4 MED', 'OPEN', 'NO', '02/Dec/2022', 'UWI', 'Taylor Block A', '08:01 am', '08:06 am', 2, 'Chad Williams', 'CARD'),
(5, 1350, '12 LRG', 'OPEN', 'NO', '02/Dec/2022', 'Mona', 'Mona Road', '08:11 am', '08:14 am',2, 'Jason Campbell', 'CARD'),
(6, 870, '1 MED', 'OPEN', 'NO', '02/Dec/2022', 'Hope Pastures', '67 During Drive', '08:45 am', '08:53 am', 1,'Jason Campbell', 'CARD'),
(7, 700, '1 LRG', 'OPEN', 'NO', '02/Dec/2022', 'Old Hope Road', 'Bob Marley Museum', '10:02 am', '10:07 am', 2,'Jason Campbell', 'CARD'),
(8, 950, '7 MED', 'OPEN', 'NO', '02/Dec/2022', 'Jamaica College', 'Jamaica College Front Gate', '12:31 pm', '12:36 pm', 2,'Jason Campbell', 'CASH'),
(9, 1990, '16 MED, 20 LRG', 'OPEN', 'NO', '02/Dec/2022', 'UWI', 'Irving Hall, Angels of Genesis Ground Floor', '01:24 pm', '01:30 pm', 1,'Chad Williams', 'CARD'),
(10, 570, '4 MED', 'OPEN', 'NO', '02/Dec/2022', 'UWI', 'T4 Orion, ELR Towers', '02:31 pm', '02:36 pm', 1, 'Chad Williams', 'CASH');
   
DROP TABLE IF EXISTS `adminUsers`;
CREATE TABLE `adminUsers` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL default '',
    `password` varchar(300)  NOT NULL default '',
    `role` varchar(50) NOT NULL default '',
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `adminUsers` VALUES(1, "Morell Parker", "2fc9a362afd9f22ccf6e48f655c790f448a9a15f5459f659a3c7ef9678b6cc190fc4b646acd3ba812e9185dd30e2a558fbcc797076bcc4a6da9e29989dc03c40", "manager"),
(2, "S.Morgan", "925f43c3cfb956bbe3c6aa8023ba7ad5cfa21d104186fffc69e768e55940d9653b1cd36fba614fba2e1844f4436da20f83750c6ec1db356da154691bdd71a9b1", "chef"),
(3, "Jason Campbell", "daef4953b9783365cad6615223720506cc46c5167cd16ab500fa597aa08ff964eb24fb19687f34d7665f778fcb6c5358fc0a5b81e1662cf90f73a2671c53f991", "delivery personnel"),
(4, "R.Brown", "daef4953b9783365cad6615223720506cc46c5167cd16ab500fa597aa08ff964eb24fb19687f34d7665f778fcb6c5358fc0a5b81e1662cf90f73a2671c53f991", "server"),
(5, "Chad Williams", "925f43c3cfb956bbe3c6aa8023ba7ad5cfa21d104186fffc69e768e55940d9653b1cd36fba614fba2e1844f4436da20f83750c6ec1db356da154691bdd71a9b1", "delivery personnel");
