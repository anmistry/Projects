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
<h2> Servers </h2>
<div>
	<table>
		<tr>
			<td>Server Id</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Table Id</td>
			<td>Dish Id</td>
		</tr>
<!-- Filtering server table by last name of the server. Printing Server Id, First Name, Last Name, Table Id amd Dish Id in table form. This way we can keep track of the server that which table and dish server is serving to.-->

<?php

if(!($stmt = $mysqli->prepare("SELECT server.id, server.first_name, server.last_name, tables.id, dish.id FROM server INNER JOIN tables ON server.table_id = tables.id INNER JOIN dish ON server.dish_id = dish.id WHERE server.last_name =  ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("s",$_POST['last_name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;

}
if(!$stmt->bind_result($id, $first_name, $last_name, $table_id, $dish_id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name . "\n</td>\n<td>\n" . $table_id . "\n</td>\n<td>\n" . $dish_id . "\n</td>\n</tr>";
}
$stmt->close();
?>

</table>
</div>

</body>
</html>


