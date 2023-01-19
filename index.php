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

    $useragent=$_SERVER['HTTP_USER_AGENT'];
    $isMobile = false;
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $isMobile = true;
    }
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
                    <div class="text-center">
                        <img src="" class="img-fluid" id="fullviewContainer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-4 gallery">
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

        <hr style="width:80%;background-color:gray;text-align:center; margin-top: 50px; margin-bottom: 75px;">

        <?php
            $cards = $isMobile == true ? 4 : 3;
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

                for($j=0; $j<1; $j++){
                    echo '<div class="row py-lg-4">';
                    for($k=0; $k<$cards; $k++){
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
                            <div class=\"col-6 col-lg-4 py-2 py-lg-0\">
                                <div class=\"card\">
                                    <div id=\"cardImage\"><img $vertikal class=\"card-img-top shadowh\" src=\"static/pictures/preview/pre${id}.jpg\"></div>
                                    <div class=\"card-body\">
                                        <div class=\"row align-items-center\">
                                            <div class=\"col\">
                                                <h5 class=\"m-0\">#$id</h5>
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

    <div class="container pb-4" id="kuenstler">
        <hr style="width:80%;background-color:gray;text-align:center; margin-bottom: 100px;">

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
		<div style="height: 100px"></div>
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