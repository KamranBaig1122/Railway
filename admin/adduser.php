<?php include_once "header.php" ?>
<title>Booking</title>
</head>

<body style="background-color: #3D1766;">
    <?php include_once "../nav.php"; ?>
    <section class="dashboard">
        <div class="d-container dashboard-container">
            <?php include_once "sidemenu.php" ?>
            <main class="m-0">
            <h2 class="sign">Add User</h2>
      <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo '<p class="error" id="error-message">' . $error . '</p>';
      }
      ?>
      <form method="post" action="../handlers/signup.php?admin=">
        <input value="<?php if (isset($_GET["fname"])) echo $_GET["fname"]; ?>" type="text" name="fname" placeholder="Enter First Name">
        <input value="<?php if (isset($_GET["lname"])) echo $_GET["lname"]; ?>" type="text" name="lname" placeholder="Enter Last Name">
        <input value="<?php if (isset($_GET["uname"])) echo $_GET["uname"]; ?>" type="text" name="uname" placeholder="Enter UserName">
        <select name="gender" id="">
          <option value="" <?php if (isset($_GET["gender"]) && $_GET["gender"] === "") echo "selected"; ?>>Select Gender</option>
          <option value="1" <?php if (isset($_GET["gender"]) && $_GET["gender"] == "1") echo "selected"; ?>>Male</option>
          <option value="0" <?php if (isset($_GET["gender"]) && $_GET["gender"] == "0") echo "selected"; ?>>Female</option>
        </select>
        <input type="password" name="password" placeholder="Password">
        <button class="btn" type="submit" name="singin">Add user</button>
      </form>
            
              </main>
        </div>
    </section>
</body>

</html>