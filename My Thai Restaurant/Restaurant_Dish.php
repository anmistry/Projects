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
<body>
<div id ="table">
<table>
	<tr>
		<td>Dish Id</td>
		<td>Dish type</td>
		<td>Dish name</td>
		<td>Dish price</td>
	</tr> 
	
<?php 
if(!($stmt = $mysqli->prepare("SELECT dish.id, dish.dish_type, dish.dish_name, dish.dish_price FROM dish"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($Dish_Id, $Dish_type, $Dish_name, $Dish_price)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo  "<tr><td>" . $Dish_Id . "</td><td>" . $Dish_type . "</td><td>" . $Dish_name . "</td><td>" . $Dish_price . "</td></tr>" ;
}
$stmt->close();
 ?> 


</table>
</div>

<div id = "Dish">
	<fieldset>
	<form method= "post" action="addDish.php" >
	 
	        <!--<legend>DISH</legend>-->
	        <p>Dish type: <input type = "text" name="Dishtype"></p>
	        <p>Dish name: <input type = "text" name="Dishname"></p>
			<p>Dish price: <input type = "number" name="Dishprice" step="0.01"></p>
	  <div id = "submit1">
		 <input type = "submit" name = "Add" value = "Add Dish"/>
         <p>Dish Id: <input type = "number" name="DishId"></p>
		 <input type = "submit" name = "Update" value = "Update Dish Price"/> 
		 <input type = "submit" name = "Delete" value = "Delete Dish"/> 
		 </div> 
         	  </fieldset>
	</form>
</div>
</body>
</html>