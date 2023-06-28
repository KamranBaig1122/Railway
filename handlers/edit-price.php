<?php

if (isset($_POST["update-price"])) {
    include_once "../classes/train.php";

    $price = $_POST["price"];
    $route = $_POST["route"];
    $class = $_POST["class"];
    $priceid = $_POST["priceid"];

    if (empty($price)) {
        $error = "Price is required.";
        header("Location: ../admin/ticket-edit.php?error=" . urlencode($error) . "&route=" . urlencode($route) . "&class=" . urlencode($class) . "&priceid=" . urlencode($priceid));
        exit();
    }

    $train =  new Train();
    $train->editPrice($priceid , $price);
    header("Location: ../admin/ticketdetails.php");
} else {
    header("Location: ../");
}
