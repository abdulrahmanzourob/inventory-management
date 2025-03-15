<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];

  try {
    require_once 'dbh.inc.php';
    require_once 'login_model.inc.php';
    require_once 'login_contr.inc.php';

    //ERROR HANDELRS
    $errors = [];

    if (is_imput_empty($username, $pwd)) {
      $errors["empty_input"] = "Fill in all fields!";
    }

    $result = get_user($pdo, $username);

    if (is_username_wrong($result)) {
      $errors["login_incorrect"] = "Incorrect login info";
    }
    
    if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
      $errors["login_incorrect"] = "Incorrect password";
    }

    require_once 'config_session.inc.php';

    if ($errors) {
      $_SESSION["error_login"] = $errors;
      header("Location: ../login.php");
      die();
    }
    
    $new_session_id = session_create_id();
    $session_id = $new_session_id . "_" . $result["id"];
    session_id($session_id);
    
    $_SESSION["user_id"] = $result["id"];
    $_SESSION["username"] = $result["username"];
    $_SESSION["role"] = $result["role"];
    
    $_SESSION["last_regeneration"] = time();
    
    if ($_SESSION["role"] === "admin") {
      header("Location: ../admin_dashboard.php");
    } else {
      header("Location: ../user_dashboard.php");
    }
    
    $pdo = null;
    $stmt = null;
    die();
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
} else {
  header("../login.php");
  die();
}