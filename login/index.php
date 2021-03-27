<?php

require_once('../config.inc.php');
// For local database only
// define("DB_SERVER",'localhost');
// define("DB_USERNAME", 'root');
// define("DB_PASSWORD", '');
// define("DB_NAME", '2020_comp10120_x9');

// First run (Local)
// $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);

// If database already created (Local)
// $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, DB_NAME);

$conn = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

if($conn === false){
	die("ERROR: COULDN'T CONNECT TO DATABASE " .  mysqli_connect_error());
}
else{
	$msgs = "Connected Successfully";
}

// First run only - Creating database

// $sql = "CREATE DATABASE ".DB_NAME;
// if(mysqli_query($conn, $sql)){
// 	echo "Created Database successfully";
// }
// else{
// 	echo("Error creating database : ". mysqli_error($conn));
// 	exit();
// }


// Creating table
// $sql = "CREATE TABLE users(
// 		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
// 		username VARCHAR(50) NOT NULL UNIQUE,
// 		password VARCHAR(255) NOT NULL,
// 		created_at DATETIME DEFAULT CURRENT_TIMESTAMP)";

// if(mysqli_query($conn, $sql)){
// 	echo("Created Table successfully");
// }
// else{
// 	echo("Error creating table : ". mysqli_error($conn));
// }


// To close the connection
// mysqli_close($conn);

?>
