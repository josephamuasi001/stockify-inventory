<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Products</h1>
    <p>Add new products in your stock</p>

    <?php
    require '../config/database.php';

    $stmt = $pdo->query(
        "INSERT INTO products ( id, category_id, supplier_id, name, sku, description, cost_price, selling_price, quantity, min_stock_level, is_active

    ") 
    ?>


<form action="create-product.php"></form>
</body>
</html>