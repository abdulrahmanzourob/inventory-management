<?php
  //////////////////// SAFE METHOD //////////////////
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $email = $_POST["email"];
  
  try {
    require_once 'dbh.inc.php';
    require_once 'register.model.inc.php';
    require_once 'register.contr.inc.php';
    
    //ERROR HANDELRS
    $errors = [];

    if (is_imput_empty($username, $pwd, $email)) {
      $errors["empty_input"] = "Fill in all fields!";
    }
    if (is_email_invalid($email)) {
      $errors["invalid_email"] = "Inavalid email used!";
    }
    if (is_username_taken($pdo, $username)) {
      $errors["username_taken"] = "username already taken!";
    }
    if (is_email_registred($pdo, $email)) {
      $errors["email_used"] = "email already registered!";
    }

    require_once 'config_session.inc.php';

    if ($errors) {
      $_SESSION["error_signup"] = $errors;
      header("Location: ../index.php");
      die();
    }

    create_user($pdo, $username, $pwd, $email);
    header("Location: ../index.php?signup=success");

    $pdo = null;
    $stmt = null;
    die();

  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
  
} else {
  header("Location: ../index.php");
  die();
}
