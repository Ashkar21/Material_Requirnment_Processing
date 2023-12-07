<?php

$con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");

if (!$con) {
    die(mysqli_error($con));
}

if (isset($_POST['Submit'])) {
    $productNo = $con->real_escape_string($_POST['productNo']);
    $date = $con->real_escape_string($_POST['date']);
    $quantity = $con->real_escape_string($_POST['quantity']);

    $checkQuantity = "SELECT quantity FROM root_user WHERE productNo = '$productNo'";
    $result = $con->query($checkQuantity);

    if ($result) {
        $row = $result->fetch_assoc();
        $availableQuantity = $row['quantity'];

        if ($availableQuantity >= $quantity) {
            $sql = "INSERT INTO user (productNo, date, quantity) VALUES ('$productNo', '$date', '$quantity')";

            if ($con->query($sql) === TRUE) {
                if ($availableQuantity == $quantity) {
                    $deleteFromRootUser = "DELETE FROM root_user WHERE productNo = '$productNo'";
                    if ($con->query($deleteFromRootUser) === TRUE) {
                        echo "<script>alert('Item purchased and deleted from inventory successfully.');</script>";
                    } else {
                        echo "Error deleting item: " . $con->error;
                    }
                } else {
                    $updateQuantity = "UPDATE root_user SET quantity = quantity - '$quantity' WHERE productNo = '$productNo'";
                    if ($con->query($updateQuantity) === TRUE) {
                        // Quantity updated in root_user
                    } else {
                        echo "Error updating root_user table: " . $con->error;
                    }
                }
                header('Location: history.php');
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "<script>alert('Sorry, the requested quantity is not available.');</script>";
        }
    } else {
        echo "Error: " . $checkQuantity . "<br>" . $con->error;
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Requirement Processing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<style>
    h1 {
        text-align: center;
        font-size: 50px;
        color: #BD53ED;
        margin: 20px 0;
    }

    /* Navbar */
    .navbar {
        background-color: #BD53ED;
        height: 50px;
        width: 100%;
        display: flex;
        align-items: center; 
        justify-content: center; 
    }

    .navbar ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .navbar ul li {
        display: inline-block;
        margin: 0;
    }

    .navbar ul li a {
        text-decoration: none;
        color: #fff;
        padding: 15px;
        font-size: 18px;
        display: block;
        transition: color 0.3s ease-in-out;
    }

    .navbar ul li a:hover {
        color: #FF69B4;
    }
</style>




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
    <div class="container">
        <div class="typewriter" style="padding-bottom:50px;">
            <h1>ITEMS AVAILABLE</h1>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Item No:</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">MRP For Each:</th>
                    <th scope="col">Available Quantity</th>
                </tr>
            </thead>
            <tbody>
                <!--For Display Of Tables-->
                <?php
                $sql = "SELECT * FROM root_user";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        $productNo = $row['productNo'];
                        $name = $row['name'];
                        $date = $row['date'];
                        $mrp = $row['mrp'];
                        $quantity = $row['quantity'];
                        echo '<tr>
                                <th scope="row">' . $productNo . '</th>
                                <td>' . $name . '</td>
                                <td>' . $date . '</td>
                                <td>' . $mrp . '</td>
                                <td>' . $quantity . '</td>
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="typewriter">
            <h1>ORDER HERE</h1>
        </div>

        <form action="index.php" method="post" id="purchaseForm">

            <div class="form-group">
                <label for="productNo">Item No:</label>
                <select class="form-control" id="productNo" name="productNo">
                    <?php
                    $sql = "SELECT productNo FROM root_user";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) {
                            $productNo = $row['productNo'];
                            echo "<option value='$productNo'>$productNo</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date Of Purchase </label>
                    <!-- Set the value to today's date as the default value -->
                <input type="date" class="form-control" autocomplete="off" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" placeholder="Enter The Quantity Wanted ">
            </div>
            <div style="text-align:center;padding-top:20px;">
            <button type="submit" name="Submit">SUBMIT
                        <div class="star-1">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-2">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-3">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-4">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-5">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-6">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        
                </button>
            </div>

            
            <div style="text-align:right" >
            <button><a href="history.php" class="new">HISTORY
                        <div class="star-1">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-2">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-3">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-4">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-5">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        <div class="star-6">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 784.11 815.53" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><defs></defs><g id="Layer_x0020_1"><metadata id="CorelCorpID_0Corel-Layer"></metadata><path d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z" class="fil0"></path></g></svg>
                        </div>
                        </a>
                </button>
                </div>

        </form>
    </div>


</body>
</html>
