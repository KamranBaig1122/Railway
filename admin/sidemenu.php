<?php
if (basename($_SERVER["PHP_SELF"]) == "sidemenu.php") {
    header("Location: ../");
    exit();
}
?>
<aside>
    <ul>
    <li><a href="bookings.php">
                <h5>Bookings</h5>
            </a></li>
            <li><a href="rootdetails.php">
                <h5>Route Details</h5>
            </a></li>
        <li><a href="ticketdetails.php">
                <h5>Ticket Detail</h5>
            </a></li>
            <li><a href="traindetails.php">
                <h5>Train Details</h5>
            </a></li>
    </ul>
</aside>