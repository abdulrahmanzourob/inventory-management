
<?php

function getAllProducts($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
}    

function addProduct($pdo) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name'], $data['price'], $data['quantity'])) {
        echo json_encode(["error" => "Missing parameters"]);
        return;
    }    
    
    $sql = "INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => htmlspecialchars($data['name']),
        ':price' => floatval($data['price']),
        ':quantity' => intval($data['quantity']),
    ]);    
    
    echo json_encode(["message" => "Product added successfully"]);
}    



function deleteProduct($pdo) {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode(["success" => false, "message" => "Missing product ID"]);
        return;
    }
    $id = $data['id'];
    try {
        // تحضير وتنفيذ استعلام الحذف
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        // التحقق مما إذا كان قد تم حذف أي صف
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Product not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
    }
}


function updateProduct($pdo) {
    // استقبال البيانات بصيغة JSON وتحويلها إلى مصفوفة
    $data = json_decode(file_get_contents("php://input"), true);

    // التحقق من توفر جميع القيم المطلوبة
    if (!isset($data['id'], $data['name'], $data['price'], $data['quantity'])) {
        echo json_encode(["error" => "Missing parameters"]);
        return;
    }

    // تنظيف القيم المدخلة
    $id = filter_var($data['id'], FILTER_VALIDATE_INT);
    $name = trim($data['name']);
    $price = filter_var($data['price'], FILTER_VALIDATE_FLOAT);
    $quantity = filter_var($data['quantity'], FILTER_VALIDATE_INT);

    // التحقق من أن القيم صحيحة
    if ($id === false || empty($name) || $price === false || $quantity === false) {
        echo json_encode(["error" => "Invalid input data"]);
        return;
    }

    try {
        // تحديث المنتج باستخدام prepared statement
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
        $stmt->execute([$name, $price, $quantity, $id]);

        // التحقق مما إذا كان التحديث ناجحًا
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => "Product updated successfully"]);
        } else {
            echo json_encode(["error" => "No changes made or product not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}

function searchProducts($pdo, $search) {
    try {
        $search = trim($search); // إزالة الفراغات الزائدة

        if (strlen($search) === 0) { 
            echo json_encode([]); // إعادة مصفوفة فارغة إذا كان البحث فارغًا
            return;
        }

        $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->execute(["%$search%"]);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
}

