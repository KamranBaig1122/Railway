<?php

include_once "../classes/user.php";
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $gender = $_POST["gender"];

    if (empty($fname) || empty($lname) || empty($uname)  || !($_POST["gender"] == 0 || $_POST["gender"] == 1)) {
        $error = "All Fields are required.";
        header("Location: ../admin/edit.php?error=" . urlencode($error) . "&user_id=" . urlencode($id));
        exit();
    }

    $user = new User($id, $fname, $lname, $uname, $gender, null);
    $user->updateUser();
    if ($user->updateUser()) {
        header('Location: ../admin/');
    }
} else if (isset($_GET["isddmin"])) {
    $user = new User($_GET["isddmin"]);
    session_start();
    if ($user->switchAdmin()) {
        header('Location: ../admin/');
    }
} else if (isset($_GET["status"])) {
    $user = new User($_GET["status"]);
    if ($user->switchStatus()) {
        header('Location: ../admin/');
    }
} else {
    header('Location: ../admin/');
}
