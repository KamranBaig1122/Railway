<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2>Add a Ticket</h2>
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<p class="error" id="error-message">' . $error . '</p>';
                }
                ?>
                <form action="../handlers/booking.php?routeid=<?php if(isset($_GET["routeid"])) echo $_GET["routeid"]; ?>&class=<?php if(isset($_GET["class"])) echo $_GET["class"]; ?>" method="post">
                    <?php
                    include_once "../classes/train.php";
                    $train = new Train();
                    $routesResult = $train->getAuthRoutes();
                    if ($routesResult->num_rows > 0) {
                    ?>

                        <div class="dropdown">
                            <button class=" btn bg-light text-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php

                                if (isset($_GET["from"]) && isset($_GET["to"])) {
                                    echo $_GET["from"] . " - " . $_GET["to"];
                                } else {
                                    echo "Select Location";
                                }
                                ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php
                                while ($temp = $routesResult->fetch_assoc()) {
                                ?>
                                    <a class="dropdown-item" href="<?php $_SERVER["PHP_SELF"] ?>?routeid=<?php echo $temp["routeid"]; ?>&from=<?php echo $temp["from"]; ?>&to=<?php echo $temp["to"]; ?>">
                                        <?php echo $temp["from"] . " " . $temp["to"] ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>



                        <?php
                        if (isset($_GET["routeid"])) {
                            $result = $train->getAuthPricing($_GET["routeid"]);
                        ?>
                            <div class="dropdown">
                                <button class=" btn bg-light text-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php

                                    if (isset($_GET["class"])) {
                                        if ($_GET["class"] == 1) {
                                            echo "Business class";
                                        } else if ($_GET["class"] == 2) {
                                            echo "Economy class";
                                        } else {
                                            echo "Lower class";
                                        }
                                    } else {
                                        echo "Select Type";
                                    }
                                    ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                    while ($temp = $result->fetch_assoc()) {
                                    ?>
                                        <a class="dropdown-item" href="<?php $_SERVER["PHP_SELF"] ?>?routeid=<?php echo $_GET["routeid"]; ?>&from=<?php echo $_GET["from"]; ?>&to=<?php echo $_GET["to"]; ?>&class=<?php echo $temp["class"]; ?>">
                                            <?php
                                            if ($temp["class"] == 1) {
                                                echo "Business Class <b>Price: " . $temp["price"] . "</b>";
                                            } else if ($temp["class"] == 2) {
                                                echo "Economy Class <b>Price: " . $temp["price"] . "</b>";
                                            } else {
                                                echo "Lower Class <b>Price: " . $temp["price"] . "</b>";
                                            }; ?>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>


                            <?php
                            if (isset($_GET["class"])) {
                            ?>
                                <button class="btn" type="submit" name="book">Book Ticket</button>
                        <?php }
                        } ?>


                    <?php } ?>
                </form>
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