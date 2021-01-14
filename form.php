<?php
    include 'models/db.php';

    $vorname = $_POST['firstname'];
    $nachname = $_POST['surname'];
    $email = $_POST['email'];
    $product_id = $_POST['paintId'];

	$interestSql = "insert into db59690.prospect values (0,\"$email\",\"$vorname\",\"$nachname\",$product_id)";
	#$numInterest = "select count(*) from prospect where email=$email";
	
    $insert = $con->query($interestSql);
    
    header("Location: https://www.arnulfhoffmann.de/painting.php?p=$product_id&r=$insert", true,  301);

?>