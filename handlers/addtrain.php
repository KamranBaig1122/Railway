<?php

if (isset($_GET["routeid"])) {
    include_once "../classes/train.php";
    $route = $_GET["routeid"];
    $trainno = substr(strtoupper(md5(uniqid('', true))), 0, 5);    
    $train = new Train(null, $trainno, $route, 1, null, null);
    $train->addTrain();
    header("Location: ../admin/traindetails.php");
} else {
    header("Location: ../");
}
?>
