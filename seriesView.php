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

    $rows = ceil($resultSize / 3);
    $series = $serieses[$series_id - 1];
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
    <div class="container">
        <div class="row justify-content-center mt-4 mb-2">
            <div class="col">
                <h3 class="py-4" style="text-align: center"><?= $series ?></h3>
            </div>
        </div>
        <?php
        for ($i = 0; $i < $rows; $i++) {
            echo '<div class="row py-lg-4">';
            for ($j = 0; $j < 3; $j++) {

                global $resultSize;
                if ($resultSize > 0) {
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

</body>

</html>