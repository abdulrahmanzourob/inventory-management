<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="container">
    <div class="form-box">
      <h2>Login</h2>
      <form action="includes/login.inc.php" method="post">
        <div class="input-group">
          <input type="text" name="username" placeholder="Username">
        </div>
        <div class="input-group">
          <input type="password" name="pwd" placeholder="Password">
        </div>
        <button type="submit" class="btn">Login</button>
      </form>

      <p>Don't have an account? <a href="index.php">Register here</a></p>
    </div>

    <?php check_login_error(); ?>

  </div>


</body>
</html>
