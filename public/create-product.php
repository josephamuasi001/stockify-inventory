<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>

    <?php
require '../config/database.php';

$stmt = $pdo->query("SELECT id, name FROM suppliers");
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT id, name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $sku = $_POST['sku'] ?? '';
    $description = $_POST["description"] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $supplier_id = ($_POST['supplier_id'] ?? '') !== ''
    ? (int) $_POST['supplier_id']
    :null;
    $costPrice = $_POST['cost_price'] ?? 0;
    $sellingPrice = $_POST['selling_price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;
    $minStockLevel = $_POST['min_stock_level'] ?? 0;
    $isActive = isset($_POST['is_active']) ? (int) $_POST['is_active'] : 0;

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO products (category_id, supplier_id, name, sku, description, cost_price, selling_price, quantity, min_stock_level, is_active)
             VALUES (:category_id, :supplier_id, :name, :sku, :description, :cost_price, :selling_price, :quantity, :min_stock_level, :is_active)"
        );

        $stmt->execute([
            ':name' => $name,
            ':sku' => $sku,
            ':description' => $description,
            ':cost_price' => $costPrice,
            ':selling_price' => $sellingPrice,
            ':quantity' => (int) $quantity,
            ':min_stock_level' => (int) $minStockLevel,
            ':is_active' => $isActive,
            ":category_id" => $category_id,
            ":supplier_id" => $supplier_id
        ]);

        echo '<p>Product added successfully.</p>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>


    <h1>Create Products</h1>
    <p>Add new products in your stock</p>



<form action="create-product.php" method="POST">
    <label>Name
        <input type="text" name="name" required>
    </label>
    <br><br>
    <label>SKU:
        <input type="text" name="sku" required>
    </label>
    <br><br>
    <label>Description:
        <textarea name="description"></textarea>
    </label>
    <br><br>
    <label>Cost Price:
        <input type="number" name="cost_price" step="0.01" required>
    </label>
    <br><br>
    <label>Selling Price:
        <input type="number" name="selling_price" step="0.01" required>
    </label>
    <br><br>
    <label>Quantity:
        <input type="number" name="quantity" required>
    </label>
    <br><br>
    <label>Supplier:
    <select name="supplier_id">
        <option value="null">No supplier selected</option>

        <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= $supplier['id'] ?>">
                <?= htmlspecialchars($supplier['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    </label>
    <br><br>
    <label>Category:
    <select name="category_id" required>
        <option value="">Select a category</option>

        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>">
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    </label>
    <br><br>
    <label>Minimum Stock Level:
        <input type="number" min="0" step="1" name="min_stock_level" required>
    </label>
    <br><br>
    <label>Is Active:
        <select name="is_active" required>
            <option value="">Select an option</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </label>
    <br><br>
    <button type="submit">
        Add Product
    </button>
</form>
</body>
</html>