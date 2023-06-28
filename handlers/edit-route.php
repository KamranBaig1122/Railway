<?php

if (isset($_POST["update-route"])) {
    $routeid = $_POST["routeid"];
    $from = $_POST["from"];
    $to = $_POST["to"];

    if (empty($from) || empty($to)) {
        $error = "All Fields are required.";
        header("Location: ../admin/root-edit.php?error=" . urlencode($error) . "&routeid=" . urlencode($routeid));
        exit();
    }

include_once "../classes/train.php";
    $train = new Train(null,null, null, null, $from,$to);

    if($train->updateRoot($routeid)){
        header('Location: ../admin/rootdetails.php');
    }
    else{
        $error = "Same Root already Available.";
        header("Location: ../admin/root-edit.php?error=" . urlencode($error) . "&routeid=" . urlencode($routeid));
    }
    
} else {
    header('Location: ../admin/');
}
