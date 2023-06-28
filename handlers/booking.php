<?php
if (isset($_POST["book"])) {

    $class = $_GET["class"];
    $routeid = $_GET["routeid"];

    include_once "../classes/bookings.php";
    $ticketno = substr(strtoupper(md5(uniqid('', true))), 0, 5);
    session_start();
    $booking = new Booking(null, $_SESSION['userid'], $class, $routeid, $ticketno);
    $booking->bookTicket();
    header("Location: ../");
} else {
    header("Location: ../");
}
