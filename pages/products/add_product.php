<?php

require_once("../../config/database.php");
session_start();

//check if the user accessing this page is an admin else send the user to staff.php
if(!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../../index.php");
    exit;
}

//check if the submit button has been clicked and get the data from the form.
if(isset($_POST['submit'])){
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

$errors = array();

//check if all the fields are filled before submitting the form.
if(empty($product_name) || empty($category) || empty($price) || empty($stock_quantity)){
    array_push($errors, "Please fill in all the fields");
}

//Throw the errors to the user if any

if($errors){
    foreach($errors as $error){
        echo "<div class='alert alert-danger'> $error</div>";
    }

}

else{
    //if everything is okay then we insert the data into the database.
    $sql = "INSERT INTO products(name, category, price, stock_quantity)
            VALUES(?,?,?,?)";

    //establish a connection to the database
    $stmt = mysqli_stmt_init($conn);

    //prepare the query for execution, the arguments order must be followed
    $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

    //check if the query is correct and do the execution

    if($prepare_stmt){
        //bind the parameters for insert

        mysqli_stmt_bind_param($stmt, "ssii", $product_name, $category, $price, $stock_quantity);

        //execute the SQL
        mysqli_execute($stmt);
        echo "<div class='alert alert-success'> You have successfully added the product </div>";
        header("Location ../auth/admin.php");
    }

    else{
        die("<div class='alert alert-success'>Something went wrong</div>");
    }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Add New Product</h2>



    <!-- Product Form -->
    <form action="add_product.php" method="POST" class="shadow-sm p-4 bg-white rounded">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required>
                <option selected disabled value="">-- Select Category --</option>
                <option value="Electronics">Electronics</option>
                <option value="Groceries">Groceries</option>
                <option value="Stationery">Stationery</option>
                <option value="Clothing">Clothing</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (KES)</label>
            <input type="number" name="price" id="price" class="form-control" min="0" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" min="0" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Add Product</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
