<?php
session_start();

// Determine if user is logged in (set during successful login)
$isLoggedIn = isset($_SESSION['user']) && $_SESSION['user'] === 'yes';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../staff/index.php");
    exit();
} 
?>

<?php include_once("../../includes/header.php") ?>


<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Unifie Systems</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <?php if ($isLoggedIn): ?>
                    <a href="logout.php" class="btn btn-outline-light ms-lg-3">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light ms-lg-3">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-5">
        <h1 class="text-center mb-5">Inventory & Sales Dashboard</h1>

        <div class="row g-4">
            <!-- Add Product Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Add Product</h5>
                        <p class="card-text flex-grow-1">Quickly register new items into your inventory.</p>
                        <a href="../products/add_product.php" class="btn btn-primary mt-auto">Add Product</a>
                    </div>
                </div>
            </div>

            <!-- Edit Products Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Edit Products</h5>
                        <p class="card-text flex-grow-1">Update product details or deactivate items that are out of stock.</p>
                        <a href="pages/products/edit_products.php" class="btn btn-primary mt-auto">Edit Products</a>
                    </div>
                </div>
            </div>

            <!-- View Inventory Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">View Inventory</h5>
                        <p class="card-text flex-grow-1">See real‑time stock levels and product categories.</p>
                        <a href="pages/products/inventory.php" class="btn btn-primary mt-auto">View Inventory</a>
                    </div>
                </div>
            </div>

            <!-- Record Sale Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Record Sale</h5>
                        <p class="card-text flex-grow-1">Log new sales and automatically update stock.</p>
                        <a href="pages/sales/record_sale.php" class="btn btn-primary mt-auto">Record Sale</a>
                    </div>
                </div>
            </div>

            <!-- Sales Reports Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Sales Reports</h5>
                        <p class="card-text flex-grow-1">Generate daily, weekly, or monthly sales summaries.</p>
                        <a href="pages/sales/reports.php" class="btn btn-primary mt-auto">View Reports</a>
                    </div>
                </div>
            </div>

            <!-- Manage Users Card (Admins only) -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text flex-grow-1">Create, edit, or deactivate system users and set roles.</p>
                        <a href="add_user.php" class="btn btn-primary mt-auto">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
