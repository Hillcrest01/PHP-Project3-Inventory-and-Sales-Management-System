<?php

session_start();
if (isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once("../../config/database.php");


    $errors = array();

    $login_query = "SELECT * FROM users WHERE name = '$username'";
    $result = mysqli_query($conn, $login_query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {

        if (password_verify($password, $user['password'])) {

            //start the session

            session_start();
            $_SESSION['user'] = 'yes';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];



            echo "<div class='alert alert-success'> Login successful </div>";
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: staff.php");
            }
            die();
        } else {
            echo "<div class='alert alert-danger'> Incorrect Password </div>";
        }
    } else {
        echo "<div class='alert alert-danger'> There is no user linked with this username </div>";
    }

    if (count($errors)) {
        foreach ($errors as $error) {
            echo "<div class alert alert-danger> $error</div>";
        }
    }
}


?>

<?php include("../../includes/header.php") ?>

<body>
    <h1>Hello, welcome to Unifie Systems</h1>

    <div class="container mt-4">
        <h2>Login to your Account</h2>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>