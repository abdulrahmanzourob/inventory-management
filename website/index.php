<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/register.view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container">
    <div class="form-box">
      <h2>Register</h2>
      <form action="includes/register.inc.php" method="post">
        <div class="input-group">
          <input type="text" name="username" placeholder="Username">
        </div>
        <div class="input-group">
          <input type="password" name="pwd" placeholder="Password">
        </div>
        <div class="input-group">
          <input type="email" name="email" placeholder="Email">
        </div>
        <button type="submit" class="btn">Register</button>
      </form>

      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <?php check_signup_errors(); ?>

  </div>

</body>
</html>
