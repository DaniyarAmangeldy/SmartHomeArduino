<?php
	$servername = "localhost";
	$username = "admin_baspro";
	$password = "6E2t5D2d";
	$dbname = "db_baspro";
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	
	
	if (isset($_GET["ID"])){
		$id = $_GET["ID"];
		$sql = "SELECT * FROM table_inputs WHERE `ID` = $id;";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "{" . $row["VALUE"]. "}";
			}
		}
	}
	
	$conn->close();
?>			