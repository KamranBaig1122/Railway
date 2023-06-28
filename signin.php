<?php
include_once "header.php";
?>

<title>Booking</title>
</head>

<body>
  <section class="form-section">
    <div class="container form-section-container">
      <h2 class="sign">Sign In</h2>
      <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        echo '<p class="error" id="error-message">' . $error . '</p>';
      }
      ?>
      <form method="post" action="./handlers/signin.php">
        <input value="<?php if (isset($_GET["uname"])) echo $_GET["uname"]; ?>" type="text" name="uname" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Your Password">
        <button class="btn" type="submit" name="signin">Sign in</button>
        <small>Dont't have an account? <a href="signup.php">Sign Up</a></small>
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