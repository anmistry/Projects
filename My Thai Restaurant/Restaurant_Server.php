<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("host-name","username","password","dbname");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet"  type="text/css" href="./Restaurant.css">
<div id ="server">
<table>
	
	<tr>
		<td><strong>Server Id</strong></td>
		<td><strong>First Name</strong></td>
		<td><strong>Last Name</strong></td>
	</tr>
	
<?php 
if(!($stmt = $mysqli->prepare("SELECT server.id, server.first_name, server.last_name FROM server"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id,$first_name, $last_name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr><td>" . $id . "</td><td>" . $first_name . "</td><td>" . $last_name .  "</td></tr>";
}
$stmt->close();
 ?> 

</table>
</div> 
	<form method= "post" action="addServer.php" >
	 	<fieldset>
	        <!--<legend>DISH</legend>-->
	        <p>First Name: <input type = "text" name="FirstName"></p>
	        <p>Last Name: <input type = "text" name="LastName"></p>
			
	  <div id = "submit1">
		 <input type = "submit" name = "Add" value = "Add Server"/>
         	 <p>Server Id(1-15): <input type = "number" name="ServerId" min="1" max="15"></p>
		 <input type = "submit" name = "Update" value = "Update Server Names"/> 
		 <input type = "submit" name = "Delete" value = "Delete Server"/>
	</div>
    	  </fieldset>
	</form>
</div>

</html>