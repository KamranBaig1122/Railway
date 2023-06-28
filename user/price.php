<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2>Pricing</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Train #</th>
                            <th>From</th>
                            <th>-</th>
                            <th>To</th>
                            <th>Ticket Type</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once '../classes/train.php';
                        $train = new Train();
                        $result = $train->getPriceDetails();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                <td><?php echo $row["trainno"] ?></td>
                                    <td><b><?php echo $row["from"] ?></b></td>
                                    <td>-</td>
                                    <td><b><?php echo $row["to"] ?></b></td>
                                    <td><?php if ($row["class"] == 1) echo "Business Class";
                                        else if ($row["class"] == 2) echo "Echonomy Class";
                                        else echo "Lower Class"; ?></td>
                                    <td><?php echo "$" . $row["price"] ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'><h2>No Pricing Available</h2></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>
</body>

</html>