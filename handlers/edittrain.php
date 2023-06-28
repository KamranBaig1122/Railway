<?php

include_once "../classes/train.php";
if (isset($_GET["status"])) {
    include_once "../classes/train.php";
    $train = new Train($_GET["status"]);
    if ($train->switchStatus()) {
        header('Location: ../admin/traindetails.php');
    }
} else {
    header('Location: ../admin/');
}
