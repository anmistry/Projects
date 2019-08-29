<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("host-name","username","password","dbname");
if($mysqli ->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

/* Add data (table type and table capacity) to tables table.*/
if(isset($_POST['Add'])){
	echo "Table Add";
	if(!($stmt = $mysqli->prepare("INSERT INTO tables(table_type,table_capacity) VALUES (?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("si",$_POST['Tabletype'],$_POST['Tablecapacity']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Update table cpapcity of tables table.*/
if(isset($_POST['Update'])){
	echo "Table Update";
	if(!($stmt = $mysqli->prepare("UPDATE tables SET table_capacity =? WHERE id = ? AND table_type=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("iis",$_POST['Tablecapacity'],$_POST['TableId'],$_POST['Tabletype']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

/* Delete data (table type and table capacity) of tables table.*/
if(isset($_POST['Delete'])){
	echo "Table Delete";
	if(!($stmt = $mysqli->prepare("DELETE FROM tables WHERE id =?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['TableId']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Execute Succesful: " . $stmt->affected_rows . " rows to Tables.";
}

?>