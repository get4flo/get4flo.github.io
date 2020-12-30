<?php
	include '../db.php';
    $product_id = $_GET['p'];
	$sql = "select * FROM paintings where paintings_id = $product_id";
	$error = 0;

	if(mysqli_connect_errno() != 0) {
		global $error;
		$error = 1;
		echo "<p><b> Mysql-Error </b></p>";
		echo "Errno: " . $con->connect_errno . "\n";
    	echo "Error: " . $con->connect_error . "\n";
	} 
	else{
		$resultobj =  $con->query($sql);
		$result = $resultobj -> fetch_assoc();
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>AH-ArtGallery</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="icon" href="..\static\pictures\logo\logo3-1.png">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
		<a class="navbar-brand py-0" href="https://get4flo.github.io/">
			<img src="..\static\pictures\logo\logo3-1.png">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active px-lg-2 ml-lg-3">
					<a class="nav-link" href="#gallery">Gallerie<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item px-lg-2">
					<a class="nav-link" href="#kuenstler">Künstler</a>
				</li>
				<li class="nav-item px-lg-2">
					<a class="nav-link" href="#impressum">Impressum</a>
				</li>
			</ul>
			<div class="d-none d-lg-block">
			<form class="form-inline my-2 my-lg-0">
				<a class="px-2" href="https://www.pinterest.de/hansjrgenseifer/arnulf-hoffmann-mobile-skulpturen/">
					<span style="color: #E60023"><i class="fab fa-pinterest fa-2x"></i></span>
				</a>
				<a class="px-3 mr-2" href="mailto:florianhoffmann97@yahoo.com">
					<span style="color: Grey;"><i class="fas fa-envelope fa-2x"></i></span>
				</a>
				<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
				</form>
				</div>
			</div>
		</nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-8 p-0">
					<div class="text-fluid p-5">
					<?php
						$pic = $result['picture_full'];
						echo "<img src=\"..\static\pictures\\$pic\" class=\"img-fluid\" alt=\"Responsive image\">";
					?>
					</div>

                </div>
				<div class="col-4 p-0" style="background-color: #f8f8f8;">
					<div class="d-flex h-100 justify-content-center"> <!--  align-items-center -->
						<div class="mt-5">
							<h3>Bild Nr. 5</h3>
							<div class="row pt-3">
								<div class="col">
								<p>Entstehungsjahr:</p>
								</div>
								<div class="col">
									<p>2011</p>
								</div>
							</div>
							<div class="row">
								<div class="col">
								<p>Maße:</p>
								</div>
								<div class="col">
									<p>120 x 120</p>
								</div>
							</div>
							<label style="font-size: small; color:grey;">Generelle Preisinformationen</label>
							<div><button type="button" class="btn btn-dark">Anfragen</button></div>
						</div>
					</div>
                    
                </div>
            </div>

        </div>
    </body>

</html>