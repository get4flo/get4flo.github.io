<?php
include '../db.php';

$error = 0;
$errorMessage = "";
$series_id = 1;

if(array_count_values($_GET)==0){
	$error = 1;
	$errorMessage = "Argument fehlt";
}
if(!(array_key_exists('s', $_GET)) && $error == 0){
	$error = 1;
	$errorMessage = "Argument s wurde nicht gesetzt";
} else {
	$series_id = $_GET['s'];
}
$sql = "select * FROM paintings where series_id = $series_id";

if (mysqli_connect_errno() != 0 && $error == 0) {
	global $error;
	$error = 1;
	echo "<p><b> Mysql-Error </b></p>";
	echo "Errno: " . $con->connect_errno . "\n";
	echo "Error: " . $con->connect_error . "\n";
} 

if(!is_numeric($series_id) && $error == 0){
	$error = 1;
	$errorMessage = "s ist keine Zahl";
}

# 3 Hardcodet amount of Series
if($series_id < 0 || $series_id > 3 && $error == 0){
	$error = 1;
	$errorMessage = "s außerhalb erlaubter Grenzen";
}

$resultSize;
if($error == 0) {
    $resultobj =  $con->query($sql);
    $resultSize = mysqli_num_rows($resultobj);
}
$rows = $resultSize % 3 + 1;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>AH-ArtGallery</title>
	    <link rel="stylesheet" href="..\static\css\library\bootstrap.min.css"> 
	    <link rel="stylesheet" type="text/css" href="static\css\style.css">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="..\static\pictures\logo\logo3-1.png">
    </head>
    <body>
        <?php
            include 'navbar.php';
        ?>
        <div class="container">
            <?php
                for($i=0; $i<$rows; $i++){
                    echo '<div class="row py-lg-4">';
                    for($j=0; $j<3; $j++){
                        $result = $resultobj->fetch_assoc();
                        $img = $result['picture_full'];
                        $number = $result['paintingNumber'];
                        echo "
                        <div class='col-lg py-2 py-lg-0'>
                            <div class='card'>
                                <div>
                                    <img class='card-img-top shadowh' src='..\static\pictures\detail\\$img' alt='Picture'>
                                </div>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h5 class=' m-0'>#$number</h5>
                                        </div>
                                        <div class='col'>
                                            <span style='display: flex;flex-direction: row-reverse;'><a href='mailto:name@bla.de?subject=Anfrage Bild #1' class='btn btn-dark btn-sm pr-2 req'>mehr</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <?php
            include 'footer.php';
        ?>

    </body>
</html>

