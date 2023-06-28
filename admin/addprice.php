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
                    <h2>Add Price</h2>
                    <h6 class="me-5 add-user-btn"><?php
                                                    if (isset($_GET["class"])) {
                                                        if ($_GET["class"] == 1) {
                                                            echo "Business Class";
                                                        } else if ($_GET["class"] == 2) {
                                                            echo "Economy Class";
                                                        } else {
                                                            echo "Lower Class";
                                                        }
                                                    }
                                                    ?></h6>
                </div>

                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<p class="error" id="error-message">' . $error . '</p>';
                }
                ?>

                <form action="../handlers/addprice.php" method="post">
                    <label for="price">Price</label>
                    <?php
                    if (isset($_GET["route"])) {
                        include_once "../classes/train.php";
                        $train = new Train();
                        $res = $train->getRouteById($_GET["route"]);
                        $res = $res->fetch_assoc();
                    }
                    ?>
                    <input type="hidden" name="route" value="<?php echo $_GET["route"];?>" id="">
                    <input type="hidden" name="class" value="<?php echo $_GET["class"];?>" id="">
                    <input type="text" name="price" placeholder="Enter Price <?php echo $res["from"] . " to " . $res["to"] ?>" id="price">
                    <button name="add-price" class="btn" type="submit">Add Price</button>
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