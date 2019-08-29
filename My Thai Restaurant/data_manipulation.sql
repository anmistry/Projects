SELECT server.id, server.first_name, server.last_name, tables.id, dish.id
FROM server
INNER JOIN tables ON server.table_id = tables.id
INNER JOIN dish ON server.dish_id = dish.id
WHERE server.last_name = "Roy";


SELECT dish.id, dish.dish_type, dish.dish_name, Customer.id, server.id 
FROM dish
INNER JOIN Customer ON dish.customer_id = Customer.id
INNER JOIN server ON dish.server_id = server.id
WHERE dish.dish_type = "Entree";

SELECT Customer.id, Customer.first_name, Customer.last_name, tables.id FROM Customer
INNER JOIN tables on Customer.table_id = tables.id
WHERE Customer.first_name = "Linda";