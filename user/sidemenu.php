<?php
if (basename($_SERVER["PHP_SELF"]) == "sidemenu.php") {
    header("Location: ../");
    exit();
}
?>

<aside>
    <ul>
        <li><a href="./price.php">
                <h5>Pricing</h5>
            </a></li>
    </ul>
</aside>