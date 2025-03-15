<?php
require_once 'includes/config_session.inc.php';
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: ../login.php");

} else {
  header("Location: ../website/store/index.php");
  exit();
}


