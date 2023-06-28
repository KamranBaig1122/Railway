<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<?php
include_once "../classes/bookings.php";
if (isset($_GET["delete"])) {
    $booking = new Booking($_GET["delete"]);
    $booking->deleteBooking();
    header("Location: ./bookings.php");
}

?>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2>Bookings</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Ticket Number</th>
                            <th>Ticket Type</th>
                            <th>From</th>
                            <th></th>
                            <th>To</th>
                            <th>Train Number</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $booking = new Booking(null, $_SESSION["userid"]);
                        $result = $booking->getAllBookings();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["ticketno"]; ?></td>
                                    <td><?php if ($row["type"] == 1) echo "Business Class";
                                        if ($row["type"] == 2) echo "Echonomy Class";
                                        if ($row["type"] == 3) echo "Lower Class" ?></td>
                                    <td><?php echo $row["from"]; ?></td>
                                    <td>-</td>
                                    <td><?php echo $row["to"]; ?></td>
                                    <td><?php echo $row["trainno"]; ?></td>
                                    <td><a href="<?php echo $_SERVER["PHP_SELF"] . "?delete=$row[booking_id]" ?>" class="btn sm danger">Delete</a></td>
                                </tr>
                        <?php }
                        }else {
                            echo "<tr><td colspan='8'><h2>No Bookings Available</h2></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>
</body>

</html>