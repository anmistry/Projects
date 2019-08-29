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
<fieldset>
<h2>Top 5 Popular Dishes </h2>
<div>

	<table>
		<tr>
			<td><strong>Dish Name</strong></td>
			<td><strong>Total Orders</strong></td>
			
		</tr>
		</fieldset>

<!-- Showing popular dish of the restaurant..-->
	
<?php


if(!($stmt = $mysqli->prepare("SELECT  dish.dish_name,  COUNT(customer_id) FROM dish GROUP BY customer_id ORDER BY 2 DESC LIMIT 5"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($dish_name,$COUNT)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr><td>" . $dish_name . "</td><td>" .$COUNT ."</td></tr>";
}
$stmt->close();
 ?> 
	</table>
</div> 
</body>
</html>