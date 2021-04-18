<?php
include 'models/db.php';

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
$sql = "select * FROM paintings where series_id = $series_id and reserved = false";

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
$rows = ceil($resultSize / 3);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>AH-ArtGallery</title>
	    <link rel="stylesheet" href="static\css\library\bootstrap.min.css"> 
	    <link rel="stylesheet" type="text/css" href="static\css\style.css">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="static\pictures\logo\logo3-1.png">
    </head>
    <body>
        <?php
            include 'models/navbar.php';
        ?>
        <div class="container">
            <?php
                for($i=0; $i<$rows; $i++){
                    echo '<div class="row py-lg-4">';
                    for($j=0; $j<3; $j++){

                        global $resultSize;                      
                        if($resultSize>0){
                            $resultSize--;
                            $result = $resultobj->fetch_assoc();
                            $number = $result['paintingNumber'];
                            $vertikal = $result['vertical'] ? "id=\"vertImg\"" : "";
                            $id = $result['paintings_id'];
                            echo "
                            <div class='col-lg-4 py-2 py-lg-0'>
                                <div class='card'>
                                    <div id=\"cardImage\">
                                        <img $vertikal class='card-img-top shadowh' src='static/pictures/preview/pre${id}.jpg' alt='Picture'>
                                    </div>
                                    <div class='card-body'>
                                        <div class='row align-items-center'>
                                            <div class='col'>
                                                <h5 class=' m-0'>#$number</h5>
                                            </div>
                                            <div class='col'>
                                                <span style='display: flex;flex-direction: row-reverse;'><a href='${basUrl}/painting.php?p=$id' class='btn btn-dark btn-sm pr-2 req'>mehr</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <?php
            include 'models/footer.php';
        ?>

    </body>
</html>

