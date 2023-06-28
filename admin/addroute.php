<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main>
                <h2 class="sign">Add Route</h2>
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    echo '<p class="error" id="error-message">' . $error . '</p>';
                }
                ?>
                <form action="../handlers/addroute.php" method="post">

                    <label for="source">Source</label>
                    <input id="source" type="text" name="from" value="<?php if (isset($_GET["from"])) echo $_GET["from"] ?>" placeholder="Starting Location">
                    <label for="dest">Destination</label>
                    <input id="dest" type="text" name="to" value="<?php if (isset($_GET["to"])) echo $_GET["to"] ?>" placeholder="Ending Location">
                    <button name="addroute" class="btn" type="submit">Add</button>
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