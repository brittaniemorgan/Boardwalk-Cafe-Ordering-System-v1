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
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `menuItems` VALUES (1, 'Chicken','Sandwiches', 'MED', '', 510, 0, "chicken-sandwich.jpg"),
    (2, 'B.L.T','Sandwiches', 'MED', '', 510, 0, "blt.jpg"),
    (3, 'Turkey Club','Sandwiches', 'MED', '', 570, 0, "turkey-club.jpg"),
    (4, 'Traditional Club','Sandwiches', 'MED', '', 570, 0, "traditional-club.jpg"),

    (5, 'Traditional Club','Wraps', 'MED', '', 635, 0, "trad-club-wrap.jpg"),
    (6, 'Turkey Club','Wraps', 'MED', '', 665, 0, "turkey-wrap.jpg"),
    (7, 'Chicken','Wraps', 'MED', '', 630, 0, "chicken-wrap.jpeg"),
    (8, 'Ham and Cheese','Wraps', 'MED', '', 630, 0, "ham-cheese-wrap.jpg"),

    (9, 'Fried Chicken','Jamaican', 'MED', 'LRG', 700, 850, "fried-chicken.jpg"),
    (10, 'Spicy Baked Chicken','Jamaican', 'MED', 'LRG', 700, 850, "spicy-baked-chicken.jpg"),
    (11, 'BBQ Pork','Jamaican', 'MED', 'LRG', 700, 850, "bbq-pork.jpg"),
    (12, 'Curried Chicken','Jamaican', 'MED', 'LRG', 700, 850, "curried-chicken.jpg"),
    
    (13, 'Rice and Peas','Jamaican Sides', 'MED', '', 0, 0, "rice-and-peas.jpg"),
    (14, 'Plain Rice','Jamaican Sides', 'MED', '', 0, 0, "white-rice.jpg"),
    (15, 'Spicy Pasta','Jamaican Sides', 'MED', '', 0, 0, "spicy-pasta.jpg"),

    (16, 'Latte','Beverages', 'MED', 'LRG', 300, 410, "latte.jpg"),
    (17, 'Cappuchino','Beverages', 'MED', 'LRG', 300, 410, "cappuccino.jpg"),
    (18, 'Mocha','Beverages', 'MED', 'LRG', 320, 435, "mocha.png"),
    (19, 'Hot Chocolate','Beverages', 'MED', 'LRG', 255, 290, "hot-chocolate.jpg"),
    (20, 'Mint Tea','Beverages', 'MED', 'LRG', 180, 200, "mint-tea.jpeg");



DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `name` varchar(50) NOT NULL default '',
    `password` varchar(300)  NOT NULL default '',
    `reward points` int(11) NOT NULL default 0,
    PRIMARY KEY (`name`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT ,
    `total` int(11) NOT NULL default 0,
    `items` varchar(300)  NOT NULL default '',
    `status` char(4) NOT NULL default 'OPEN',
    `delivered` varchar(3) NOT NULL default 'NO',
    `date` varchar(20) NOT NULL default '',
    PRIMARY KEY (`id`)

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders` VALUES (1, 1550, '10 MED, 12 LRG', 'OPEN', 'NO', '26/11/2022');
    