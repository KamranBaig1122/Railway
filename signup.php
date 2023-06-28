<?php
include_once "header.php";
?>
<title>Booking</title>
</head>

<body>
  <section class="form-section">
    <div class="container form-section-container">
      <h2 class="sign">Sign Up</h2>
      <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo '<p class="error" id="error-message">' . $error . '</p>';
      }
      ?>
      <form method="post" action="./handlers/signup.php">
        <input type="hidden" name="isadmin" value="<?php echo (isset($_GET["admin"])) ? 1 : 0; ?>"  id="">
        <input value="<?php if (isset($_GET["fname"])) echo $_GET["fname"]; ?>" type="text" name="fname" placeholder="Enter First Name">
        <input value="<?php if (isset($_GET["lname"])) echo $_GET["lname"]; ?>" type="text" name="lname" placeholder="Enter Last Name">
        <input value="<?php if (isset($_GET["uname"])) echo $_GET["uname"]; ?>" type="text" name="uname" placeholder="Enter UserName">
        <select name="gender" id="">
          <option value="" <?php if (isset($_GET["gender"]) && $_GET["gender"] === "") echo "selected"; ?>>Select Gender</option>
          <option value="1" <?php if (isset($_GET["gender"]) && $_GET["gender"] == "1") echo "selected"; ?>>Male</option>
          <option value="0" <?php if (isset($_GET["gender"]) && $_GET["gender"] == "0") echo "selected"; ?>>Female</option>
        </select>
        <input type="password" name="password" placeholder="Password">
        <button class="btn" type="submit" name="singin">Sign In</button>
        <small>Already Have an Account? <a href="signin.php">Sign In</a></small>
      </form>
    </div>
  </section>

  <script>
    setTimeout(function() {
      var errorMessage = document.getElementById("error-message");
      if (errorMessage) {
        errorMessage.style.display = "none";
      }
    }, 2000);
  </script>
</body>

</html>