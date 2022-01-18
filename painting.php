<?php

$error = 0;
$errorMessage = "";
$product_id = 0;
$method = $_SERVER['REQUEST_METHOD'];

include 'models/db.php';

if($method == 'GET'){
	if(array_count_values($_GET)==0){
		$error = 1;
		$errorMessage = "Argument fehlt";
	}
	if(!(array_key_exists('p', $_GET)) && $error == 0){
		$error = 1;
		$errorMessage = "Argument p wurde nicht gesetzt";
	} else {
		$product_id = $_GET['p'];
	}
}

$sql = "select * FROM paintings where paintings_id = $product_id";
$sqlSize = "select count(*) FROM paintings"; 

$sizeObj = $con->query($sqlSize);
$size = $sizeObj->fetch_assoc()['count(*)'];

if(!is_numeric($product_id) && $error == 0){
	$error = 1;
	$errorMessage = "p ist keine Zahl";
}

if($product_id < 0 || $product_id > $size && $error == 0){
	$error = 1;
	$errorMessage = "p außerhalb erlaubter Grenzen";
}

$result;
if($error == 0) {
	$resultobj =  $con->query($sql);
	$result = $resultobj->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Arnulf Hoffmann Kunstgalerie</title>
	<link rel="stylesheet" href="static\css\library\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static\css\painting.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="static\pictures\logo\logo3-1.png">
</head>

<body>

	<?php
		include 'models/navbar.php';
		if($error == 0){
			include 'models/paintingsBody.php';
		} else {
			echo $errorMessage;
		}
	?>
	<script type="text/javascript" src="static\js\painting.js"></script>
	<script src="static\js\library\all.js"></script>
</body>

</html>