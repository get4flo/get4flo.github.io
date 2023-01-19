<?php
include 'models/db.php';

$error = 0;
$errorMessage = "";
$series_id = 1;
$page = 1;
$serieses = [ 0 => 'Natur | Landschaften', 1 => 'Stämme', 2 => 'Köpfe | Körper'];

if (array_count_values($_GET) == 0) {
    $error = 1;
    $errorMessage = "Argumente fehlen";
}
if (!(array_key_exists('s', $_GET)) && !(array_key_exists('p', $_GET)) && $error == 0) {
    $error = 1;
    $errorMessage = "Argument s oder p wurden nicht gesetzt";
} else {
    $series_id = $_GET['s'];
    $page = $_GET['p'];
}

$sqlSize = "select count(*) FROM paintings where series_id = $series_id and reserved = false";

if (mysqli_connect_errno() != 0 && $error == 0) {
    global $error;
    $error = 1;
    echo "<p><b> Mysql-Error </b></p>";
    echo "Errno: " . $con->connect_errno . "\n";
    echo "Error: " . $con->connect_error . "\n";
}

if (!is_numeric($series_id) && !is_numeric($page) && $error == 0) {
    $error = 1;
    $errorMessage = "s oder p ist keine Zahl";
}

# 3 Hardcodet amount of Series
if ($series_id < 0 || $series_id > 3 && $error == 0) {
    $error = 1;
    $errorMessage = "s außerhalb erlaubter Grenzen";
}

if($error == 0){
    $total = $con->query($sqlSize)->fetch_row()[0];
    $limit = 18;
    $pages = ceil($total / $limit);
    if($page <= 0 || $page > $pages){
        $error = 1;
        $errorMessage = "p außerhalb erlaubter Grenzen";
    }
    $offset = ($page - 1)  * $limit;
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);
}

if($error != 0){
    header("Location: ${basUrl}/error/error.php?e=$error", true,  301);
}

$resultSize;
if ($error == 0) {
    $sql = "select * FROM paintings where series_id = $series_id and reserved = false limit $limit offset $offset";

    $resultobj =  $con->query($sql);
    $resultSize = mysqli_num_rows($resultobj);

    $columns = 3;
    $rows = ceil($resultSize / $columns);
    $series = $serieses[$series_id - 1];
}

$useragent=$_SERVER['HTTP_USER_AGENT'];
$isMobile = true;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
    $isMobile = true;
    $columns = 2;
    $rows = ceil($resultSize / $columns);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Arnulf Hoffmann Kunstgalerie</title>
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

    <div class="container">
        <div class="row justify-content-center mt-4 mb-2">
            <div class="col">
                <h3 class="py-4" style="text-align: center"><?= $series ?></h3>
            </div>
        </div>
        <?php
        for ($i = 0; $i < $rows; $i++) {
            echo '<div class="row py-lg-4">';
            for ($j = 0; $j < $columns; $j++) {

                global $resultSize;
                if ($resultSize > 0) {
                    $resultSize--;
                    $result = $resultobj->fetch_assoc();
                    $number = $result['paintingNumber'];
                    $vertikal = $result['vertical'] ? "id=\"vertImg\"" : "";
                    $id = $result['paintings_id'];
                    echo "
                            <div class='col-6 col-lg-4 py-2 py-lg-0'>
                                <div class='card'>
                                    <div id=\"cardImage\">
                                        <img $vertikal class='card-img-top shadowh' src='static/pictures/preview/pre${id}.jpg' alt='Picture'>
                                    </div>
                                    <div class='card-body'>
                                        <div class='row align-items-center'>
                                            <div class='col'>
                                                <h5 class=' m-0'>#$id</h5>
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
        <nav aria-label="Page navigation example" class="my-5">
            <?php
                $isStart = $page == 1;
                $isEnd = $page == $pages;
                $pagePrevious = $isStart ? 1 : $page - 1;
                $pageNext = $isEnd ? $pages : $page + 1;
                $linkPrevious = "${basUrl}/seriesView.php?s=${series_id}&p=${pagePrevious}";
                $linkNext = "${basUrl}/seriesView.php?s=${series_id}&p=${pageNext}";
            ?>
            <ul class="pagination justify-content-center">
                <li class="page-item<?= $isStart ? " disabled" : ""?>">
                    <a class="page-link" href="<?= $linkPrevious ?>" tabindex="-1">Vorherige</a>
                </li>
                <?php
                    for($i = 1; $i <= $pages; $i++){
                        $toBeAddedTag = ($i === $page) ? ' active' : '';
                        echo "<li class=\"page-item${toBeAddedTag}\"><a class=\"page-link\" href=\"${basUrl}/seriesView.php?s=${series_id}&p=${i}\">${i}</a></li>";
                    }
                ?>
                <li class="page-item <?= $isEnd ? " disabled" : ""?>">
                    <a class="page-link" href="<?= $linkNext ?>">Nächste</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php
    include 'models/footer.php';
    ?>

    <script type="text/javascript" src="static\js\runViewer.js"></script>
</body>

</html>