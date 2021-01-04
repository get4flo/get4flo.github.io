<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "arnulfhoffmann";

// Create connection
$con = new mysqli($servername, $username, $password,$db);

if (mysqli_connect_errno() != 0) {
	global $error;
	$error = 1;
	echo "<p><b> Mysql-Error </b></p>";
	echo "Errno: " . $con->connect_errno . "\n";
	echo "Error: " . $con->connect_error . "\n";
}

?>