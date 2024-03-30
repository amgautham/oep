<?php
include('connection.php');

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$reorder_level = $_POST['reorder_level'];

$sql = "INSERT INTO products (name, description, price, quantity, reorder_level) VALUES ('$name', '$description', $price, $quantity, $reorder_level)";
if ($conn->query($sql) === TRUE) {
    echo "New product added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
