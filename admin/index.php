<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main class="m-0">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h2>Manage User</h2>
                    <h6 class="me-5 add-user-btn"><a href="adduser.php">Add User</a></h6>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Gender</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <?php
                    include_once "../classes/user.php";
                    $user = new User(null, null, null, null, null, null);
                    $result = $user->allUsers();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row["firstname"] . " " . $row["lastname"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo ($row["gender"]) ? "Male" : "Femail" ?></td>
                                    <td><a href="edit.php?user_id=<?php echo $row["user_id"]; ?>" class="btn sm">Edit</a></td>
                                    <?php
                                    if ($row["username"] == $_SESSION["username"]) {
                                    ?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <?php } else {

                                    ?>
                                        <td><a href="../handlers/delete.php?user_id=<?php echo $row["user_id"]; ?>" class="btn sm danger">Delete</a></td>
                                        <td><a style="background: <?php echo ($row["isadmin"]) ? "green" : ""; ?>" href="../handlers/edituser.php?isddmin=<?php echo $row["user_id"] ?>"><?php echo ($row["isadmin"]) ? "Admin" : "User" ?></a></td>
                                        <td><a style="background: <?php echo ($row["status"]) ? "green" : "rgb(255, 73, 73)"; ?>" href="../handlers/edituser.php?status=<?php echo $row["user_id"] ?>"><?php echo ($row["status"]) ? "Active" : "Block" ?></a></td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                    <?php
                        }
                    } else {
                        echo "<tbody><tr><td colspan='7'>No users found.</td></tr></tbody>";
                    }
                    ?>
                </table>
            </main>
        </div>
    </section>
</body>

</html>