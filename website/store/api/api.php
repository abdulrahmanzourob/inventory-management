<?php
header("Content-Type: application/json");
require "db.php";

require_once "function.php";


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        if (isset($_GET['search']) && strlen(trim($_GET['search'])) > 0) {
            searchProducts($pdo, $_GET['search']);
        } else {
            getAllProducts($pdo);
        }
        break;

    case "POST":
        addProduct($pdo);
        break;

    case "PUT":
        updateProduct($pdo);
        break;

    case "DELETE":
        deleteProduct($pdo);
        break;

    default:
        echo json_encode(["error" => "Invalid request method"]);
        break;
}