<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli(""host-name","username","password","dbname"");
if($mysqli ->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

/* Add data (first and last name of server) to server table.*/
if(isset($_POST['Add'])){
	echo "Server Add";
	if(!($stmt = $mysqli->prepare("INSERT INTO server(first_name,last_name) VALUES (?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ss",$_POST['FirstName'],$_POST['LastName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Update first name of server in server table.*/
if(isset($_POST['Update'])){
	echo "Server Update";
	if(!($stmt = $mysqli->prepare("UPDATE server SET first_name =?, last_name=? WHERE id=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssi",$_POST['FirstName'],$_POST['LastName'],$_POST['ServerId']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Delete data(first and last name of server) from server table.*/	
if(isset($_POST['Delete'])){
	echo "Server Delete";
	if(!($stmt = $mysqli->prepare("DELETE FROM server WHERE id=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['ServerId']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Execute Succesful: " . $stmt->affected_rows . " rows to server.";
}

?>