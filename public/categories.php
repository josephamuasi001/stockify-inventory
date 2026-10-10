<?php
require '../config/database.php';

$stmt = $pdo->query(
    "SELECT name, description
    FROM categories 
");

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($categories as $category) {
    echo "<br>Name: " . $category["name"];
    echo "<br>Description: " . $category["description"];
}

?>
