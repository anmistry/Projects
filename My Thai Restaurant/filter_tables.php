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
<h2> Tables </h2>
<div>
	<table>
		<tr>
			<td>Table Id</td>
			<td>Table Type</td>
			<td>Table Capacity</td>
		</tr>

<!-- Filtering tables table by table type. Printing Table Id, Table Type amd Table Capacity in table form.-->

<?php

if(!($stmt = $mysqli->prepare("SELECT tables.id, tables.table_type, tables.table_capacity FROM tables WHERE table_type = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s",$_POST['table_type']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;

}
if(!$stmt->bind_result($id,$table_type, $table_capacity)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $table_type . "\n</td>\n<td>\n" . $table_capacity . "\n</td>\n</tr>";
}
$stmt->close();
?>

	</table>
</div>
</body>
</html>
	

