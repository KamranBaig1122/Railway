<?php

session_start();

if (isset($_POST["logout"]) && isset($_SESSION["username"])) {
    session_destroy();
}
header("Location: ../");
