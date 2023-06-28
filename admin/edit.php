<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
  <?php include_once "../nav.php"; ?>
  <section class="dashboard">
    <div class="d-container dashboard-container">
      <?php include_once "sidemenu.php" ?>
      <main class="m-0">
        <h2 class="sign">Edit</h2>
        <?php
        if (isset($_GET['error'])) {
          $error = $_GET['error'];
          echo '<p class="error" id="error-message">' . $error . '</p>';
        }
        ?>
        <form action="../handlers/edituser.php" method="post">
          <?php
          if (isset($_GET["user_id"])) {
            $id = $_GET["user_id"];
            $user = new User();
            $result = $user->getUserById($id);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $username = $row["username"];
                $gender = $row["gender"];
          ?>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <label for="fname">First Name</label>
                <input id="fname" type="text" name="fname" placeholder="Enter First Name" value="<?php echo $firstname ?>">
                <label for="lname">Last Name</label>
                <input id="lname" type="text" name="lname" placeholder="Enter Last Name" value="<?php echo $lastname ?>">
                <label for="uname">User Name</label>
                <input id="uname" type="text" name="uname" placeholder="Enter UserName" value="<?php echo $username ?>">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                  <option value="1" <?php if ($gender == 1) echo "selected"; ?>>Male</option>
                  <option value="0" <?php if ($gender == 0) echo "selected"; ?>>Female</option>
                </select>
                
                <button class="btn" type="submit" name="update">Update</button>
          <?php
              }
            }
          } else {
            header("Location: index.php");
            exit();
          }
          ?>
        </form>
      </main>
    </div>
  </section>
</body>

</html>
