<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h2 class="main">Product Management</h2>
    <div class="container">
        <div class="controls">
            <input type="text" id="productName" placeholder="Name">
            <input type="text" id="productPrice" placeholder="Price">
            <input type="text" id="productCount" placeholder="Count">
            <button onclick="addProduct()">Add Product</button>

            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search for products...">
                <button onclick="searchProducts()">Search</button>
            </div>
        </div>
        
        <div class="table-container">
            <table id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Products will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/script.js"></script>


</body>
</html>
