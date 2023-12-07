<?php
$con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");

if (!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['Submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO login_new (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($con->query($sql) === true) {
        // echo "Data inserted successfully";
        header('location:login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <h1>Material Requirement Processing</h1>
    <div class="nav">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/DBMS%20PROJECT/costomer/index.php">Home</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/costomer/history.php"> Orders</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/login/login.php">Login</a></li>
            </ul>
        </nav>
    </div>

    <div class="registration-form">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" name="Submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>

</html>



