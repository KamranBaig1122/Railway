<?php
if (isset($_GET["user_id"])) {
    include_once "../classes/user.php";
    $user = new User($_GET["user_id"]);
    echo $user->deleteUser();
    header("Location: ../admin/");
}
else if(isset($_GET["train_id"])){
    include_once "../classes/train.php";
    $train = new Train($_GET["train_id"]);
    echo $train->deleteTrain();
    header("Location: ../admin/traindetails.php");
    
}
else {
    header('Location: ../');
}
