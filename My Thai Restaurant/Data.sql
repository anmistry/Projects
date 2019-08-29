SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

/* Insert data into Customer table.*/
SET AUTOCOMMIT=0;

insert  into `Customer`(`first_name`,`last_name`,`table_id`) values 
	('Vivek','Krishnan', 4), ('James', 'Henry', 3),('Danya','Krishnan', 5), ('Deavan', 'Krishnan', 9), ('Benjamin','Lee', 2),('Lily','Samy', 11), ('Dean', 'Joah', 6),('Linda', 'Joya', 15), ('Vanessa', 'Williams', 8), ('Veni', 'Samy', 9),
	('Linda', 'Ambreen', 1), ('Diane', 'Williams',4), ('Jack', 'Maniam', 3), ('Diane', 'Smith',6), ('Brad', 'Williams',  17), ('Vani', 'Karuppiah', 13), ('Amelie', 'Johnson', 5), ('Kevin', 'Wong', 11), 
	('Thomas', 'Roberto', 12), ('Joy', 'Williams', 10),('Alex','Lee', 1), ('Micah', 'Grossman',9);  
	COMMIT;

/* Insert data into Tables table.*/
SET AUTOCOMMIT=0;

insert into `tables`(`table_type`,`table_capacity`) values 
	('bar', 10),('bar', 10),('booth', 4), ('booth', 4),('booth', 4),('booth', 4),('booth', 4),('2 seater', 2),('2 seater', 2),('2 seater', 2),('2 seater', 2),('wide table', 8),
	('wide table', 8),('wide table', 8),('wide table', 8),('wide table', 8),('family room', 15),('family room', 15),('family room', 20),('family room', 20);
	COMMIT;



SET AUTOCOMMIT=0;

/* Insert data into dish table.*/

INSERT INTO dish(`dish_type`, `dish_name`, `dish_price`, `customer_id`, `server_id`) VALUES ("Appetizer", "THAI FRIED SPRING ROLL",4.95, 1, 4),("Appetizer", "FRIED TOFU",4.99, 4, 8),("Appetizer", "CHICKEN SATAY",6.99, 12, 9),
("Appetizer", "STEAMED CHICKEN DUMPLINGS",5.95, 7, 3),("Appetizer", "FRESH SHRIMP SALAD ROLL",5.99, 17, 10),("Appetizer", "FRIED CALAMARI",6.99, 2, 2),
("Appetizer", "GARLIC CHICKEN WINGS",5.75, 13, 6), ("Appetizer", "VEGETERIAN SALAD ROLL",5.99,3, 4 ),
("Entree", "SPICY LEMON GRASS CHICKEN",7.99,5, 1 ),("Entree", "SPICY SEAFOOD WITH EGGPLANT",9.99, 9, 5),
("Entree", "FERSH GINGER SALMON",10.99, 10, 2), ("Entree", "HOLY BASIL STIR FRY WITH VEGETABLES",7.95, 15, 8),
("Entree", "PANANG CURRY",8.99, 6, 9),("Entree", "COCONUT GREEN CURRY",8.99, 20, 7),("Entree", "GARLIC PRAWNS",11.95, 8, 3),
("Entree", "VEGETABLES IN GARLIC SAUCE",9.75, 11, 9),("Entree", "THAI HOLY BASIL FRIED RICE",7.95, 18, 4),
("Entree", "PINEAPPLE FIRED RICE",8.99, 16, 5), ("Dessert", "THAI STYLE FRIED ICE CREAM",4.95, 14, 1), ("Dessert", "FRIED BANANA ICE CREAM",3.95, 19, 6), ("Dessert", "SWEET STICKY RICE WITH MANGO",4.95, 2, 7),
("Drinks","SODA",1.99, 1, 8),("Drinks","THAI ICED TEA",2.95, 20, 5),("Drinks","ICED COFFEE",2.99, 4, 10),("Drinks","HOT COFFEE",1.95, 11, 3),("Drinks","FLAVORED ICED TEA",1.95, 4, 7);
COMMIT;

SET AUTOCOMMIT=0;

/* Insert data into server table.*/

INSERT INTO server(`first_name`, `last_name`,`table_id`, `dish_id`) VALUES ("Adam", "Williams", 2, 3),("Danielle", "Smith", 10, 6),("Andria", "Marcias", 5, 18),
("Cheri", "Thomas", 7, 9),("Conny", "Travis", 12, 22),("Erika", "Nguyen", 17, 1),("Mark", "Johnson", 1, 8),("Bob",	"Chiu", 9, 15),
("Victor", "Yiu",11, 4),("Vikram", "Roy", 3, 16);
COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;