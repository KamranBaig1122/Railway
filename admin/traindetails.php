<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2>Train Details</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>Train #</th>
                            <th>From</th>
                            <th>To</th>
                            <th>On Track</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        include_once "../classes/train.php";

                        $train = new Train();

                        $result = $train->allTrains();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row["trainno"] ?></td>
                                    <td><?php echo $row["from"] ?></td>
                                    <td><?php echo $row["to"] ?></td>
                                    <td><a style="background: <?php echo ($row["status"]) ? "green" : "rgb(255, 73, 73)"; ?>" href="../handlers/edittrain.php?status=<?php echo $row["train_id"] ?>"><?php echo ($row["status"]) ? "Yes" : "No" ?></a></td>
                                    <td><a class="red-danger" href="../handlers/delete.php?train_id=<?php echo $row["train_id"]; ?>">Delete</a></td>
                                </tr>
                        <?php }
                        } 
                        else {
                            echo "<tr><td colspan='5'><h2>No Trains Available</h2></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </section>
</body>

</html>
