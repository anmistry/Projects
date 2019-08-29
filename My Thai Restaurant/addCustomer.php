<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("host-name","username","password","dbname");
if($mysqli ->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

/* Add data (fisrt name, last name and table number) to Customer table.*/
if(isset($_POST['Add'])){
	echo " Customer Add";
	if(!($stmt = $mysqli->prepare("INSERT INTO Customer(first_name,last_name,table_id) VALUES (?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssi",$_POST['FirstName'],$_POST['LastName'],$_POST['TableNumber']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Update table Id in Customer table.*/
if(isset($_POST['Update'])){
	echo "Customer Update";
	if(!($stmt = $mysqli->prepare("UPDATE Customer SET table_id =? WHERE id=? AND first_name=? AND last_name=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("iiss",$_POST['TableNumber'],$_POST['CustomerId'],$_POST['FirstName'],$_POST['LastName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Delete data (fisrt name, last name and table number) from Customer table.*/
if(isset($_POST['Delete'])){
	echo "Customer Delete";
	if(!($stmt = $mysqli->prepare("DELETE FROM Customer WHERE id=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['CustomerId']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	
	}
}
	
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Execute succesful: " . $stmt->affected_rows . " rows to Customer.";
}

?>

