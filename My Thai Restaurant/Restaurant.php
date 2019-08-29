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
	<h1><center> My Thai Cuisine </center></h1>
	<div>
<?php include 'popular_dish.php'; ?>
</div>
    <hr></hr>
    <fieldset>
	<!-- Customer List-->
	<h2> Customer List</h2>
<div id ="table">
<table>
	<tr>
		<td><strong>Customer Id</strong></td>
		<td><strong>First Name</strong></td>
		<td><strong>Last Name</strong></td>
        <td><strong>Table Number</strong></td>
	</tr>
	
<!-- Displaying data for Customer table.-->
<?php 
if(!($stmt = $mysqli->prepare("SELECT Customer.id, Customer.first_name, Customer.last_name, Customer.table_id FROM Customer"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $first_name, $last_name, $table_id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr><td>" . $id . "</td><td>" . $first_name . "</td><td>" . $last_name .  "</td><td>" . $table_id . "</td></tr>";
}
$stmt->close();
 ?> 
</table>
</div> 

<!-- Filtering Customer by First Name.-->
<div>
	<form method= "post" action="addCustomer.php" >
        <fieldset>
	    <!-- <legend>CUSTOMER</legend> -->
	    <p>First name: <input type = "text" name="FirstName"></p>
	    <p>Last name: <input type = "text" name="LastName"></p>
	    <p>Table Number (1-20): <input type = "number" name="TableNumber" min="1" max="20"></p>
        <input type = "submit" name = "Add" value = "Add customer"/>
        <p>Customer Id (1-100) : <input type = "number" name="CustomerId" min="1" max="100"</p>
		<input type = "submit" name = "Update" value = "Update customer Table Number"/> 
		<input type = "submit" name = "Delete" value = "Delete customer"/>    
        </fieldset>   
    </form>

	<form method="post" action="filter_customers.php">
		<fieldset>
			<legend>Filter By First Name</legend>
				<?php 
				$types = mysqli_query($mysqli,'SELECT DISTINCT first_name FROM Customer');
	
				echo "<select name='first_name'>";
				while ($item = mysqli_fetch_array($types)) {
				if ($item['first_name'] == '')
				break;
			echo "<option value='".$item['first_name']."'>".$item['first_name']."</option>";
			}
			echo "</select>";
			?>
			
		<input type="submit" value="Filter" />
	</fieldset>
	</form>    
</div>
</fieldset>
<br>
<br>


<!-- Table List-->
<fieldset>
<h2> Table List</h2>
<!-- tables table displaying data and include "addTables.php" file which add, update and delete.-->
<?php include 'Restaurant_Tables.php';?>

<!-- Filtering tables by table type.-->
<form method="post" action="filter_tables.php">
		<fieldset>
			<legend>Filter By Table Type</legend>
				<?php 
				$types = mysqli_query($mysqli,'SELECT DISTINCT table_type FROM tables');
	
				echo "<select name='table_type'>";
				while ($item = mysqli_fetch_array($types)) {
				if ($item['table_type'] == '')
				break;
			echo "<option value='".$item['table_type']."'>".$item['table_type']."</option>";
			}
			echo "</select>";
			?>
			<input type="submit" value="Filter" />
	</fieldset>
	</form>
</div>
</fieldset>
<br>
<br>

<!-- server List-->
<fieldset>
<h2> Server List </h2>
<!-- server table displaying data and include "addServer.php" file which add, update and delete.-->
<?php include 'Restaurant_Server.php'; ?>

<!-- Filtering sever by last name.-->
<form method="post" action="filter_servers.php">
		<fieldset>
			<legend>Filter By Last Name</legend>
				<?php 
				$types = mysqli_query($mysqli,'SELECT DISTINCT last_name FROM server');
	
				echo "<select name='last_name'>";
				while ($item = mysqli_fetch_array($types)) {
				if ($item['last_name'] == '')
				break;
			echo "<option value='".$item['last_name']."'>".$item['last_name']."</option>";
			}
			echo "</select>";
			?>
			
		<input type="submit" value="Filter" />
	</fieldset>
	</form>
</div>
</fieldset>
<br>
<br>


<!-- Dish List-->
<fieldset>
<h2> Dish List </h2>
<div id="dish">
<!-- dish table displaying data and include "addDish.php" file which add, update and delete.-->
<?php include 'Restaurant_Dish.php';?> 
<!-- Filtering dish by dish type.-->
<div>
	<form method="post" action="filter_dishes.php">
		<fieldset>
			<legend>Filter By Dish Type</legend>
				<?php 
				$types = mysqli_query($mysqli,'SELECT DISTINCT dish_type FROM dish');
	
				echo "<select name='dish_type'>";
				while ($item = mysqli_fetch_array($types)) {
				if ($item['dish_type'] == '')
				break;
			echo "<option value='".$item['dish_type']."'>".$item['dish_type']."</option>";
			}
			echo "</select>";
			?>
			
		
		<input type="submit" value="Filter" />
	</fieldset>
	</form>
</div>
</fieldset>

</body>
</html>