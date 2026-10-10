<?php
require '../config/database.php';

$stmt = $pdo->query(
    "SELECT name, phone, email, address 
    FROM suppliers
");

$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($suppliers as $supplier) {
    echo "<br>Name: " . $supplier["name"];
    echo "<br>Phone: " . $supplier["phone"];
    echo "<br>Email: " . $supplier["email"];
    echo "<br>Address: " . $supplier["address"] . "<br>";

}

?>
