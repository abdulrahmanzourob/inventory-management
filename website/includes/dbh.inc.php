<?php
$host = "localhost";
$dbName = "login_system";
$dbUsername = "root";
$dbPassword = "";

try {
  $dsn = "mysql:host=$host;dbname=$dbName";
  $pdo = new PDO($dsn, $dbUsername, $dbPassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}