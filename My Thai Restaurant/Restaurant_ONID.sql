
SET FOREIGN_KEY_CHECKS=0;

/*Table structure for table `Customer` */

DROP TABLE IF EXISTS `Customer`; 
CREATE Table `Customer`( 
`id` int(11) NOT NULL AUTO_INCREMENT,  
`first_name` varchar(255) NOT NULL, 
`last_name` varchar(255) NOT NULL, 
PRIMARY KEY(`id`),
`table_id` int(11) DEFAULT NULL, 
KEY `table_id` (`table_id`), 
UNIQUE KEY(`first_name`,`last_name`),
FOREIGN KEY (`table_id`) REFERENCES `tables`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*Table structure for table `tables` */

DROP TABLE IF EXISTS `tables`;
CREATE Table `tables`(  
`id` int(11) NOT NULL AUTO_INCREMENT,   
`table_type` varchar(255) NOT NULL, 
`table_capacity` int(11) DEFAULT NUll,
PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `server` */

DROP TABLE IF EXISTS `server`;
CREATE Table `server`(  
`id` int(11) NOT NULL AUTO_INCREMENT,  
`first_name` varchar(255) NOT NULL,  
`last_name` varchar(255) NOT NULL, 
`table_id` int(11) DEFAULT NULL,
`dish_id` int(11) DEFAULT NULL,   
PRIMARY KEY(`id`),
KEY `dish_id` (`dish_id`), 
KEY `table_id` (`table_id`), 
UNIQUE KEY(`first_name`,`last_name`), 
FOREIGN KEY (`dish_id`) REFERENCES `dish`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (`table_id`) REFERENCES `tables`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `dish` */

DROP TABLE IF EXISTS `dish`; 
CREATE Table `dish`( 
`id` int(11) NOT NULL AUTO_INCREMENT,  
`dish_type` varchar(255) NOT NULL,  
`dish_name` varchar(255) NOT NULL,   
`dish_price` double NOT NULL, 
`customer_id` int(11) DEFAULT NULL,
`server_id` int(11) DEFAULT NULL,  
PRIMARY KEY(`id`),
KEY `customer_id` (`customer_id`),
KEY `server_id` (`server_id`), 
FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
FOREIGN KEY (`server_id`) REFERENCES `server`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET FOREIGN_KEY_CHECKS=1;





