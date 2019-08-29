<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("host-name","username","password","dbname");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<link rel="stylesheet"  type="text/css" href="./Restaurant.css">
<body>
<h1><center> My Thai Cuisine </center></h1>
<h2> Dishes </h2>
<div>
	<table>
		<tr>
			<td>Dish Id</td>
			<td>Dish Type</td>
			<td>Dish Name</td>
			<td>Dish Price</td>
			<td>Customer Id</td>
			<td>Server Id</td>
		</tr>
		
<!-- Filtering dish table by dish type. Printing Dish Id, Dish Type, Dish Name, Dish Price, Customer Id amd Server Id in table form. This way we can keep track which customer have orederd which dish and which server is serving the dish.-->

<?php

if(!($stmt = $mysqli->prepare("SELECT dish.id, dish.dish_type, dish.dish_name, dish.dish_price, Customer.id, server.id FROM dish INNER JOIN Customer ON dish.customer_id = Customer.id INNER JOIN server ON dish.server_id = server.id WHERE dish_type = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['dish_type']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;

}
if(!$stmt->bind_result($id, $dish_type, $dish_name, $dish_price, $customer_id, $server_id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $dish_type . "\n</td>\n<td>\n" . $dish_name . "\n</td>\n<td>\n" . $dish_price . "\n</td>\n<td>\n" . $customer_id . "\n</td>\n<td>\n" . $server_id ."\n</td>\n</tr>";
}
$stmt->close();
?>

	</table>
</div>
</body>
</html>
	

