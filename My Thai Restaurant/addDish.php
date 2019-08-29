<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("host-name","username","password","dbname");
if($mysqli ->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

/* Add data (dish type, dish name, dish price) to dish table.*/
if(isset($_POST['Add'])){
	echo "Dish Add";
	if(!($stmt = $mysqli->prepare("INSERT INTO dish(dish_type,dish_name,dish_price) VALUES (?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssd",$_POST['Dishtype'],$_POST['Dishname'], $_POST['Dishprice']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
}

/* Update price of dish (dish price) in dish table.*/
if(isset($_POST['Update'])){
	echo "Dish Update";
	if(!($stmt = $mysqli->prepare("UPDATE dish SET dish_price =? WHERE id=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("di",$_POST['Dishprice'],$_POST['DishId']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Delete data (dish type, dish name, dish price) from dish table.*/
if(isset($_POST['Delete'])){
	echo "Dish Delete";
	if(!($stmt = $mysqli->prepare("DELETE FROM dish WHERE id =?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['DishId']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Execute Succesful: " . $stmt->affected_rows . " rows to Dish.";
}

?>