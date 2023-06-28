<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<?php
include_once "../classes/train.php";
if (isset($_GET["deleteprice"])) {
    $train = new Train();
    $train->deletePrice($_GET["deleteprice"]);
    header("Location: ticketdetails.php");
}
?>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>

                <h2>Ticket Details</h2>

                <table>
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $train = new Train();
                        $result = $train->displayPrice();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr class="<?php if (isset($_GET["route"]) && $_GET["route"] == $row["routeid"]) echo "tr-bg-color" ?>">
                                    <td><?php echo $row["from"] ?></td>
                                    <td><?php echo $row["to"] ?></td>
                                    <td><?php
                                        if ($row["class"] == 1) {
                                            echo "Business Class";
                                        } else if ($row["class"] == 2) {
                                            echo "Economy Class";
                                        } else {
                                            echo "Lower Class";
                                        }
                                        ?></td>
                                    <td><?php echo "$" . $row["price"] ?></td>
                                    <td><a href="ticket-edit.php?route=<?php echo $row["route"] ?>&class=<?php echo $row["class"] ?>&price=<?php echo $row["price"] ?>&priceid=<?php echo $row["price_id"] ?>" class="btn sm">Edit</a></td>
                                    <td><a href="<?php echo $_SERVER["PHP_SELF"] ?>?deleteprice=<?php echo $row["price_id"]?>" class="btn sm danger">Delete</a></td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'><h2>No Tickets Detail vailable</h2></td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </main>
        </div>
    </section>
</body>

</html>