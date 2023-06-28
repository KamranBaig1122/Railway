<?php
$filename = $_SERVER["PHP_SELF"];
$basename = basename($filename);

if ($basename == "index.php") {
  $path = "./css/style2.css";
} else {
  $path = "./css/styles.css";
}

session_start();

if (isset($_SESSION['username'])) {

  if ($_SESSION["isadmin"]) {
    header("Location: ./admin/");
  } else {
    header("Location: ./user/");
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $path; ?>">
  