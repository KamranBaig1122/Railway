<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2 class="sign">Root Edit</h2>
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<p class="error" id="error-message">' . $error . '</p>';
                }
                ?>
                <form action="../handlers/edit-route.php" method="post">
                    <?php
                    if (isset($_GET["routeid"])) {
                        include_once "../classes/train.php";
                        $train = new Train();
                        $res = $train->getRouteById($_GET["routeid"]);
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                    ?>
                                <input name="routeid" type="hidden" value="<?php echo $_GET["routeid"]; ?>">
                                <label for="source">Source</label>
                                <input id="source" type="text" name="from" value="<?php echo $row["from"] ?>" placeholder="Starting Location">
                                <label for="dest">Destination</label>
                                <input id="dest" type="text" name="to" value="<?php echo $row["to"] ?>" placeholder="Ending Location">
                                <button name="update-route" class="btn" type="submit">Update Route</button>

                    <?php }
                        }
                    } ?>
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