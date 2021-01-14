<?php
    $error = http_response_code();
    $Message = "Status: 200, Alles ok";

    if($error != 200){
        if($error == 403){
            global $Message;
            $Message = 'Error: 403, Seitenaufruf nicht erlaubt';
        }
        if($error == 404){
            global $Message;
            $Message = 'Error: 404, Seite nicht gefunden';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>AH-ArtGallery</title>
	<link rel="stylesheet" href="..\static\css\library\bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="..\static\pictures\logo\logo3-1.png">
</head>
<body>
    <?php
        include '../models/navbar.php';
    ?>
    <div style="margin: 10em 0em;">
        <div class="container">
            <h4><?php echo $Message?></h4>
    
        </div>
    
    </div>

    <?php
        include '../models/footer.php';
    ?>

</body>

</html>