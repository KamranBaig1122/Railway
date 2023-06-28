<?php
if (isset($_POST["addroute"])) {

    include_once "../classes/train.php";

    $from = $_POST["from"];
    $to = $_POST["to"];
    

    if (empty($from) || empty($to)) {
        $error = "All Fields are required.";
        header("Location: ../admin/addroute.php?error=" . urlencode($error) . "&from=" . urlencode($from) . "&to=" . urlencode($to));
        exit();
    }

    if($from == $to){
        $error = "Starting and Ending Destination Must be change.";
        header("Location: ../admin/addroute.php?error=" . urlencode($error) . "&from=" . urlencode($from) . "&to=" . urlencode($to));
        exit();
    }
    
    $train = new Train(null,null,null,null,$from,$to);

    $from = mysqli_real_escape_string($train->getConnection(), $from);
    $to = mysqli_real_escape_string($train->getConnection(), $to);

    if ($train->addRoute()) {

        $res = $train->getRouteId($from,$to);
        $row = $res->fetch_assoc();       
        $train->addTicket(0,$row["routeid"],1);
        $train->addTicket(0,$row["routeid"],2);
        $train->addTicket(0,$row["routeid"],3);
        header("Location: ../admin/rootdetails.php");
    } else {
        $error = "Root is Already There.";
        header("Location: ../admin/addroute.php?error=" . urlencode($error) . "&from=" . urlencode($from) . "&to=" . urlencode($to));
    }
} else {
    header("Location: ../");
}
