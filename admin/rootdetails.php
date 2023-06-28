<?php include_once "header.php";
include_once "../classes/train.php";
include_once "../classes/bookings.php";
?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">

    <?php
    if (isset($_GET["deleteroute"])) {
        $train = new Train();
        $train->deleteRoute($_GET["deleteroute"]);
        header("Location: rootdetails.php");
    }
    ?>

    <?php include_once "../nav.php"; ?>

    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <?php
                $train = new Train();
                $result = $train->getAvailableRoutes();
                $total = $result->num_rows;
                ?>

                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h2><?php echo $total; ?> Routes Available</h2>
                    <h6 class="me-5 add-user-btn"><a href="addroute.php">Add Route</a></h6>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Train #</th>
                            <th>From</th>
                            <th></th>
                            <th>To</th>
                            <th>Add Price</th>
                            <th>View Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <?php
                                    if ($row["trainno"] == NULL) {
                                    ?>
                                        <td><a href="../handlers/addtrain.php?routeid=<?php echo $row["routeid"] ?>" class="btn sm">Add Train</a></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td><?php echo $row["trainno"] ?></td>
                                    <?php } ?>
                                    <td><?php echo $row["from"]; ?></td>
                                    <td>-</td>
                                    <td><?php echo $row["to"]; ?></td>
                                    <?php
                                    $pricing = $train->getPriceByRoute($row["routeid"]);
                                    if ($pricing->num_rows > 0) {
                                    ?>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Add Price
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <?php
                                                    while ($temp = $pricing->fetch_assoc()) {
                                                    ?>

                                                        <a class="dropdown-item" href="addprice.php?route=<?php echo $row["routeid"]; ?>&class=<?php echo $temp["class"]; ?>">
                                                            <?php if ($temp["class"] == 1) echo "Business Class";
                                                            else if ($temp["class"] == 2) echo "Economy Class";
                                                            else echo "Lower Class" ?>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </td>

                                    <?php } else {
                                        echo "<td></td>";
                                    }
                                    ?>

                                    <?php
                                    $pricing = $train->getPriceByRoute($row["routeid"]);
                                    if ($pricing->num_rows < 3) {
                                    ?>
                                        <td>
                                            <a href="ticketdetails.php?route=<?php echo $row["routeid"]; ?>">See</a>
                                        </td>
                                    <?php } else {
                                        echo "<td></td>";
                                    }
                                    ?>

                                    <?php
                                    $booking =  new Booking();
                                    $res = $booking->getBookingById($row["routeid"]);
                                    if ($res->num_rows > 0) {

                                    ?>
                                        <td></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <td><a href="root-edit.php?routeid=<?php echo $row["routeid"]; ?>" class="btn sm">Edit</a></td>
                                        <td><a href="<?php echo $_SERVER["PHP_SELF"] . "?deleteroute=" . $row["routeid"]; ?>" class="btn sm danger">Delete</a></td>
                                    <?php } ?>

                                </tr>

                        <?php }
                        } else {
                            echo "<tr><td colspan='8'><h2>No Routes Available</h2></td></tr>";
                        } ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>
    <script>
        setTimeout(function() {
            var errorMessage = document.getElementById("error-message");
            if (errorMessage) {
                errorMessage.style.display = "none";
            }
        }, 2000);
    </script>
</body>

</html>