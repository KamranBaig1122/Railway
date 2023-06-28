<?php
if (basename($_SERVER["PHP_SELF"]) == "nav.php") {
    header("Location: ./");
    exit();
}
?>
<nav class="navbar p-3 pe-5 ">
    <div class="container-fluid">

        <ul class="navbar-nav d-flex flex-row justify-content-between w-100">
            <?php
            if (basename($_SERVER["PHP_SELF"]) != "index.php") {
            ?>
                <li class="nav-item username"><a href="index.php">Home</a></li>
            <?php } ?>
            <li class="nav-item w-100">
                <ul class="navbar-nav d-flex flex-row w-100 justify-content-end">
                    <li class="nav-item username"><?php if (isset($_SESSION["username"])) echo $_SESSION["username"]; ?></li>
                    <li class="nav-item">
                        <?php
                        if (basename($_SERVER["PHP_SELF"]) == "index.php") {
                        ?>
                            <form action="../handlers/signout.php" method="post"><button class="nav-link ms-5 sign-out-btn btn-dark" name="logout">Logout</button></form>
                        <?php } ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>