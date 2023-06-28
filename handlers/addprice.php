<?php

if (isset($_POST["add-price"])) {
    include_once "../classes/train.php";

    $price = $_POST["price"];
    $route = $_POST["route"];
    $class = $_POST["class"];

    if (empty($price)) {
        $error = "Price is required.";
        header("Location: ../admin/addprice.php?error=" . urlencode($error) . "&route=" . urlencode($route) . "&class=" . urlencode($class));
        exit();
    }

    $train =  new Train();

    $train->addPrice($price, $route, $class);

    header("Location: ../admin/ticketdetails.php");
} else {
    header("Location: ../");
}
