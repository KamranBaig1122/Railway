<?php


if (isset($_POST["singin"])) {

    include_once "../classes/user.php";
    $isadmin = $_POST["isadmin"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];


    if (empty($fname) || empty($lname) || empty($uname) || empty($password) || !($_POST["gender"] == 0 || $_POST["gender"] == 1)) {
        $error = "All Fields are required.";
        header("Location: ../signup.php?error=" . urlencode($error) . "&fname=" . urlencode($fname) . "&lname=" . urlencode($lname) . "&uname=" . urlencode($uname) . "&gender=" . urlencode($gender) . "&phno=" . urlencode($phno));
        exit();
    }


    $db = new Db();
    $fname = mysqli_real_escape_string($db->getConnection(), $fname);
    $lname = mysqli_real_escape_string($db->getConnection(), $lname);
    $uname = mysqli_real_escape_string($db->getConnection(), $uname);
    $gender = mysqli_real_escape_string($db->getConnection(), $gender);
    $password = mysqli_real_escape_string($db->getConnection(), $password);
    $user = new User(null, $fname, $lname, $uname, $gender, $password);

    if (!$user->isUserAlreadyRegister()) {
        $user->insert($isadmin);
        session_start();
        header("Location: ../signin.php");
    } else {
        $error = "Username already taken.";
        header("Location: ../signup.php?error=" . urlencode($error) . "&fname=" . urlencode($fname) . "&lname=" . urlencode($lname) . "&gender=" . urlencode($gender) . "&phno=" . urlencode($phno) . "&email=" . urlencode($email));
    }
} else {
    header("Location: ../");
}
