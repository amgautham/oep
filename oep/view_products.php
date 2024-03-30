<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>View Products</h2>
        <form action="" method="post">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter">
                <option value="all">All Products</option>
                <option value="below_reorder">Products Below Reorder Level</option>
            </select>
            <input type="submit" value="Apply Filter" name="">
        </form>
        <br>
        <table>
            <tr>
               
            </tr>
            <?php
            include('connection.php');
            $filter = isset($_POST['filter']) ? $_POST['filter'] : 'all';

            if ($filter == 'all') {
                $sql = "SELECT * FROM products";
            } elseif ($filter == 'below_reorder') {
                $sql = "SELECT * FROM products WHERE quantity < reorder_level";
            }
            
            // Echo table headers
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
            echo "<th>Quantity</th>";
            echo "<th>Reorder Level</th>";
            

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"]. "</td>";
                    echo "<td>" . $row["name"]. "</td>";
                    echo "<td>" . $row["description"]. "</td>";
                    echo "<td>" . $row["price"]. "</td>";
                    echo "<td>" . $row["quantity"]. "</td>";
                    echo "<td>" . $row["reorder_level"]. "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No products found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
