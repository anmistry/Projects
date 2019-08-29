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
<div id = "Tables">
<table>
	<tr>
		<td><strong>Table Id</strong></td>
		<td><strong>Table Type</strong></td>
		<td><strong>Table Capacity</strong></td>
	</tr>
	
<?php 
if(!($stmt = $mysqli->prepare("SELECT tables.id, tables.table_type, tables.table_capacity FROM tables"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id,$table_type, $table_capacity)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr><td>" . $id . "</td><td>" . $table_type . "</td><td>" . $table_capacity .  "</td></tr>";
}
$stmt->close();
 ?> 

</table>
</div>
	<form method= "post" action="addTables.php" >
        <fieldset>    
	    <!--<legend>Tables</legend>-->
	    <p>Table type: <input type = "text" name="Tabletype"></p>
	    <p>Table capacity(1-20): <input type = "number" name="Tablecapacity" min="1" max="20"></p>
			
	  <div id = "submit1">
		 <input type = "submit" name = "Add" value = "Add Tables"/>
         	 <p>Table Id: <input type = "number" name="TableId"></p>
		 <input type = "submit" name = "Update" value = "Update Table Capacity"/> 
		 <input type = "submit" name = "Delete" value = "Delete Tables"/> 
		 </div> 
	  </fieldset>		 
		 
	</form>
</div>
</html>
