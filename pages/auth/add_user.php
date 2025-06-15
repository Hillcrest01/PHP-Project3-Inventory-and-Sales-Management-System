<?php

include_once("../../config/database.php");

//when the form is submitted,then the submit button will be set which will tirgger the following functionalities.
if(isset($_POST['submit'])){
    //we get the data from the form here
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $confirm_password = $_POST['confirm_password'];


//hash the password for security reasons

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//check and catch the errors that may arise during registration and display them
//we initialize an empty array then in case of any error, we will push them into the array.


$errors = array();


if(empty($username) or empty($password) or empty($role)){
    array_push($errors, "Please fill all the fields");
}

//check the length of password
if(strlen($password) < 8){
    array_push($errors, "Password should at least be 8 characters");
}

//ensure that the password field and confirm password field are matching

if( $password !== $confirm_password){
    array_push($errors, "password must match confirm password");
}

//check if the user with the name entered exists

$user_exists = "SELECT * from users WHERE name='$username'";
$result = mysqli_query($conn, $user_exists);
$row_count = mysqli_num_rows($result);

if($row_count){
    array_push($errors, "A user with that email already exists");
}

//now we can throw all our errors on the screen

if(count($errors)){
    foreach($errors as $error){
        echo "<div class='alert alert-danger'> $error</div>";
    }
}

//if everything is okay, then the user is now added to the database.

else{
    $sql = "INSERT INTO users(name, password, role) VALUES(?,?,?)";

    //establish a connection to the database
    $stmt = mysqli_stmt_init($conn);
    $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);

    if($prepare_stmt){
        mysqli_stmt_bind_param($stmt, "sss" , $username, $hashed_password, $role);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'> You have successfully registered the $role </div>";
    }

    //show the error when the preparation was not successful
    else{
        die("something went wrong");
    }
    
}
}



?>

<?php include("../../includes/header.php") ?>

<body>
    <h1>Hello, welcome to Unifie Systems</h1>

    <div class="container mt-4">
        <h2>Add New User</h2>

        <form method="POST" action="add_user.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
                        <div class="mb-3">
                <label for="password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin"> </option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Add User</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>