<?php



if (isset($_POST["signin"])) {
    include_once "../classes/user.php";
    $uname = $_POST["uname"];
    $password = $_POST["password"];

    if (empty($uname) || empty($password)) {
        $error = "Both Fields are required.";
        header("Location: ../signin.php?error=" . urlencode($error) . "&uname=" . urlencode($uname));
        exit();
    }

    $user = new User(null,null, null, $uname, null, $password);
    $result = $user->login();


    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if (!$row["status"]) {
            $error = "User is currently blocked by admin Try to contact your Admin.";
            header("Location: ../signin.php?error=" . urlencode($error) . "&uname=" . urlencode($uname));
            exit();
        }

        session_start();
        $_SESSION['username'] = $row["username"];
        $_SESSION['userid'] = $row["user_id"];
        
        if ($row["isadmin"]) {
            header("Location: ../admin/");
        } else {
            header("Location: ../user/");
        }
    } else {
        $error = "Invalid Username or Password.";
        header("Location: ../signin.php?error=" . urlencode($error) . "&uname=" . urlencode($uname));
    }
} else {
    header("Location: ../");
}
