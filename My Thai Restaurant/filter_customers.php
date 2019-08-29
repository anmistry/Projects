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
<h2> Customer </h2>
<div>
	<table>
		<tr>
			<td>Customer Id</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Table Id</td>
		</tr>

<!-- Filtering Customer table by first name of the customer. Printing Customer Id, First Name, Last Name, Table Id in table form. This way we can keep track which customer is seating on which table.-->
	
<?php

if(!($stmt = $mysqli->prepare("SELECT Customer.id, Customer.first_name, Customer.last_name, tables.id FROM Customer INNER JOIN tables on Customer.table_id = tables.id WHERE Customer.first_name= ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['first_name']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;

}
if(!$stmt->bind_result($id, $first_name, $last_name,$table_id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $first_name . "\n</td>\n<td>\n" . $last_name .  "\n</td>\n<td>\n" . $table_id . "\n</td>\n</tr>";
}
$stmt->close();
?>

	</table>
</div>
</body>
</html>
	

