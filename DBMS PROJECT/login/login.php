<?php
$con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");

if (!$con) {
    die(mysqli_error($con));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    // Check if the provided username and password match the admin credentials
    if ($username == "ashkar@21" && $password == "shamla") {
        // Redirect to admin panel
        header("Location: http://localhost/DBMS%20PROJECT/Root.php");
        exit();
    }
}









    $con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");
    
    if (!$con) {
        die(mysqli_error($con));
    }
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Prepare and execute a query to retrieve user information
        $sql = "SELECT * FROM login_new WHERE username = '$username' AND password = '$password'";
        $result = $con->query($sql);
    
        if ($result) {
            // Check if any rows are returned
            if ($result->num_rows > 0) {
                // Fetch user information from the first row
                $row = $result->fetch_assoc();
    
                // Now $row contains user information, and you can access it like $row["column_name"]
                $dbUsername = $row["username"];
                $dbPassword = $row["password"];
                $dbEmail = $row["email"];
    
                // Perform any further actions with the retrieved information
                // For example, you can redirect to index.php or display user details
                header("Location: http://localhost/DBMS%20PROJECT/costomer/index.php");
                exit();
            } else {
                // Display an error message if the credentials are invalid
                $error_message = "Invalid username or password";
            }
        } else {
            // Display an error message if the query fails
            $error_message = "Error executing query: " . $con->error;
        }
    }
    ?>   





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="register.css">
    <style>
        .password-container {
            position: relative;
        }

        .eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Material Requirement Processing</h1>

    <div class="nav">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/DBMS%20PROJECT/costomer/index.php">Home</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/costomer/history.php"> Orders</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </div>

    <div class="registration-form">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required autocomplete="off">
            </div>
            <div class="form-group password-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="off">
                <span class="eye-icon" onclick="togglePasswordVisibility()">
                    👁️
                </span>
            </div> 

            <button type="submit" name="Submit">Login</button>
        </form>

        <?php
        // Display error message if set
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>

</html>


