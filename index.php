<?php
    include 'models/db.php';

    $bSql = 'select * from paintings where series_id = 1 limit 6';
    $nSql = 'select * from paintings where series_id = 2 limit 6';
    $kSql = 'select * from paintings where series_id = 3 limit 6';

    $bRes = $con->query($bSql);
    $nRes = $con->query($nSql);
    $kRes = $con->query($kSql);
    $res = [ 0 => $bRes, 1 => $nRes, 2 => $kRes];
    # hardcodet names
    $series = [ 0 => 'Natur | Landschaften', 1 => 'Stämme', 2 => 'Köpfe | Körper'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Arnulf Hoffmann Kunstgalerie</title>
    <link rel="stylesheet" href="static\css\library\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="static\css\style.css">
    <meta name="google-site-verification" content="BIhkjGFajk4WesSCjbaFJZjG3kQzFLyNc0b2DvzCMes" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="static\pictures\logo\logo3-1.png">
</head>

<body>
    <?php
    include 'models/navbar.php';
    ?>

    <div class="d-none d-md-block">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="static/pictures/carousel/opa-pendel1-1-cut.jpg" style="filter: brightness(90%);" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="static/pictures/carousel/IMG_5462-final.jpg" style="filter: brightness(70%);" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="static/pictures/carousel/IMG_5321-final.jpg" style="filter: brightness(80%);" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div id="overlay">
        <div class="container" style="height: 100%">
            <div class="row" style="height: 100%">
                <div class="col align-self-center">
                    <img src="" class="img-fluid" id="fullviewContainer">
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4 gallery">
        <div class="py-4 pl-3">
            <div class="row justify-content-center">
                <div class="col-xs-10 col-lg-8">
                    <h3 class="py-4 text-center">Kunstgalerie von Arnulf Hoffmann</h3>
                    <p class="py-4">
                        Arnulf Hoffmann war ein großartiger Künstler, 
                        Lehrer und Großvater. In seiner Zeit als Künstler stellte er u.a. in Paris, London,
                        Berlin, Warschau, Wien und in weiteren Metropolen der Welt aus. 
                        Er war bekannt für seine kinetischen Objekte bzw. Plastiken.
                        Mit diese Skulpturen aus Metall machte sich Hoffmann einen Namen und designte 
                        u.a. die 10+ Meter große Skulptur am Kölner Fehrnsehturm (Colonius).</p>
                </div>
            </div>
        </div>

        <hr style="width:80%;background-color:gray;text-align:center; margin-top: 100px; margin-bottom: 150px;">

        <?php
            for($i=0; $i<3; $i++){

                global $res;
                $crurrentI = $res[$i];
                $currentSeries = $series[$i];
                $currentSeriesId = 0;
                echo "
                <div class=\"row justify-content-center\">
				    <div class=\"col\">
					    <h3 class=\"py-4\" style=\"text-align: center\">$currentSeries</h3>
				    </div>
			    </div>";

                for($j=0; $j<2; $j++){
                    echo '<div class="row py-lg-4">';
                    for($k=0; $k<3; $k++){
                        global $currentK;
                        global $currentSeriesId;
                        $currentK = $crurrentI->fetch_assoc();
                        if($currentK == null) break;
                        $currentSeriesId = $currentK['series_id'];
                        $id = $currentK['paintings_id'];
                        $img = $currentK['picture_full'];
                        $num = $currentK['paintingNumber'];
                        $vertikal = $currentK['vertical'] ? "id=\"vertImg\"" : "";

                        echo "
                            <div class=\"col-4 py-2 py-lg-0\">
                                <div class=\"card\">
                                    <div id=\"cardImage\"><img $vertikal class=\"card-img-top shadowh\" src=\"static/pictures/preview/pre${id}.jpg\"></div>
                                    <div class=\"card-body\">
                                        <div class=\"row align-items-center\">
                                            <div class=\"col\">
                                                <h5 class=\"m-0\">#$num</h5>
                                            </div>
                                            <div class=\"col\">
                                                <span style=\"display: flex;flex-direction: row-reverse;\"><a href=\"${basUrl}/painting.php?p=$id\" class=\"btn btn-dark btn-sm pr-2 req\">mehr</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    }
                    echo '</div>';
                }
                echo "
                <div class=\"row py-lg-4\">
				    <div class=\"col\"> 
					    <div style=\"text-align: center\"><a class=\"btn btn-success\" href=\"${basUrl}/seriesView.php?s=$currentSeriesId&p=1\">mehr Bilder</a></div>
				    </div>
                </div>
                
                <div style=\"padding-top: 50px; padding-bottom: 50px\"></div>"; 
            }
        ?>

    </div>

    <hr class="my-lg-5" style="width:80%;background-color:gray;text-align:center;">

    <div class="container-fluid py-4" id="kuenstler">
			<div class="row">
				<div class="col-lg">
					<div class="text-center">
						<img class="img-fluid" src="static\pictures\arnulf-hoffmann.jpg">
					</div>
				</div>
				<div class="col-lg pt-3 pt-lg-0">
					<h3>Arnulf hoffmann</h3>
					<p class="mt-4">
                        Arnulf Hoffmann wurde inspiriert von Alexander Calder und Marcel Duchamp, 
                         die Anfang der 1930er Jahre mit dem »Mobile« die Skulpturen-Kunst revolutionierten.
                         Daran angelehnt entwickelte Hoffmann seine eigene Handschrift bewegter Kunst. 
                         Bewegungslos stehend wirken seine Pendel-Objekte wie grafische Bilder. 
                         Einmal angestoßen verändern diese kontinuierlich ihre Erscheinung, schwingen von 
                         selbst weiter und versetzen die Betrachter in einen meditativen Zustand. 
                         Diese Bewegung setzt sich auch in seinen, bisher noch nie gezeigten, Bildern fort. 
                         Hier finden sich fließende Formen in surrealen Landschaften, die von Hoffmanns 
                         gewohnt strukturierter schwarz-weiß Ästhetik abweichen und durch intensive 
                         Farben herausstechen.
                    </p>
				</div>
			</div>
		<div style="height: 200px"></div>
    </div>
    
    <?php
        include 'models/footer.php';
    ?>



    <script type="text/javascript" src="static\js\runViewer.js"></script>
    <script src="static\js\library\jquery-3.5.1.slim.min.js"></script>
    <script src="static\js\library\bootstrap.bundle.min.js"></script>
    <script src="static\js\library\all.js"></script>
</body>

</html>