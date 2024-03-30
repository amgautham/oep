<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit/Delete Product</h2>
        <form action="" method="post">
            <label for="product_id">Product ID:</label><br>
            <input type="text" id="product_id" name="product_id" required><br><br>
            <input type="submit" name="edit" value="Edit Product">
            <input type="submit" name="delete" value="Delete Product" onclick="return confirm('Are you sure you want to delete this product?');">
        </form>
    </div>
</body>
</html>
<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        // Edit product
        $product_id = $_POST['product_id'];
        // Fetch product details from database
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display form with product details filled in
            echo "<h2>Edit Product</h2>";
            echo "<form action='update_product.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
            echo "Product Name: <input type='text' name='name' value='" . $row['name'] . "' required><br><br>";
            echo "Description: <textarea name='description'>" . $row['description'] . "</textarea><br><br>";
            echo "Price: <input type='text' name='price' value='" . $row['price'] . "' required><br><br>";
            echo "Quantity: <input type='text' name='quantity' value='" . $row['quantity'] . "' required><br><br>";
            echo "Reorder Level: <input type='text' name='reorder_level' value='" . $row['reorder_level'] . "' required><br><br>";
            echo "<input type='submit' name='submit' value='Update Product'>";
            echo "</form>";
        } else {
            echo "Product not found";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete product
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM products WHERE id = $product_id";
        if ($conn->query($sql) === TRUE) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    }
}

$conn->close();
?>
