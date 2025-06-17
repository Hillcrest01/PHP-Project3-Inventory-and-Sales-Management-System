<?php
//get the database connection
include_once("../../config/database.php");

//perform the query to select all the items from the database
$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);

//convert the data received into an array for easy data reading

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Manage Products</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price (KES)</th>
                        <th>Stock Qty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php while($row = mysqli_fetch_array($result)){?>
                    <tr>
                        <td><?php echo $row['id'] ?> </td>
                        <td><?php echo $row['name'] ?> </td>
                        <td><?php echo $row['category'] ?> </td>
                        <td><?php echo $row['price'] ?> </td>
                        <td><?php echo $row['stock_quantity'] ?> </td>
                        <td>
                            <a href="edit_product.php?id=1" class="btn btn-sm btn-warning me-2">Edit</a>
                            <a href="delete_product.php?id=1" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
