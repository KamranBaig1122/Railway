<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h2>Bookings</h2>
                    <h6 class="me-5 add-user-btn"><a href="bookticket.php">Add Ticket</a></h6>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Ticket Number</th>
                            <th>Ticket Type</th>
                            <th>From</th>
                            <th></th>
                            <th>To</th>
                            <th>Train Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once "../classes/bookings.php";
                        $booking = new Booking(null, $_SESSION["userid"]);
                        $result = $booking->getBookings();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><b><?php echo $row["ticketno"]; ?></b></td>
                                    <td><?php if ($row["type"] == 1) echo "Business Class";
                                        if ($row["type"] == 2) echo "Echonomy Class";
                                        if ($row["type"] == 3) echo "Lower Class" ?></td>
                                    <td><?php echo $row["from"]; ?></td>
                                    <td><b>-</b></td>
                                    <td><?php echo $row["to"]; ?></td>
                                    <td><?php echo $row["trainno"]; ?></td>
                                </tr>
                        <?php }
                        } else {
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