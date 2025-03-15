<?php
require_once 'includes/config_session.inc.php';
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
  header("Location: ../login.php");
  exit();
}

echo "<h1>Welcome, " . $_SESSION["username"] . "!</h1>";
echo "<p>This is your user dashboard.</p>";
