<?php
include 'connect.php';

if (isset($_POST['Submit'])) {
    $productNo = $_POST['productNo'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $mrp = $_POST['mrp'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO root_user (productNo, name, date, mrp, quantity) VALUES ('$productNo', '$name', '$date', '$mrp', '$quantity')";

    if ($con->query($sql) === true) {
        // echo "Data inserted successfully";
        header('location:display.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Material Requirement Processing</title>
</head>

<body>

    <style>
        h1 {
            text-align: center;
            font-size: 50px;
            color: #BD53ED;
            margin: 20px 0;
        }

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


        body {
            background-color: #121111;
        }

        .container {
            max-width: 500px;
            background-color: #fff;
            padding: 30px;
            border: 4px solid #BD53ED;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>




    <h1>Material Requirement Processing</h1>
    <div class="nav">
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/DBMS%20PROJECT/display.php">Home</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/Root.php">Add New Material</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/history_user.php">Orders</a></li>
                <li><a href="http://localhost/DBMS%20PROJECT/costomer/index.php">User View</a></li>
            </ul>
        </nav>
    </div>





    <div class="container">
        <h1 style="text-align:center;color:red;padding-bottom:20px;">ADMIN</h1>

        <h2 class="mb-4">Add Materials </h2>
        <form action="root.php" method="post">
            <div class="form-group">
                <label for="productNo">Item No:</label>
                <input type="number" class="form-control" autocomplete="off" id="productNo" name="productNo" placeholder="Enter the Product No">
            </div>

            <div class="form-group">
                <label for="name">Item Name:</label>
                <input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="Enter The Product Name">
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" autocomplete="off" id="date" name="date">
            </div>

            <div class="form-group">
                <label for="mrp">MRP:</label>
                <input type="number" class="form-control" autocomplete="off" id="mrp" name="mrp" placeholder="Enter The MRP">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" autocomplete="off" class="form-control" id="quantity" name="quantity" placeholder="Enter The Quantity Available">
            </div>

            <button type="submit" class="btn btn-primary" name="Submit">Submit</button>

            <div style="text-align: right;">
                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary">
                    <a style="color: #e8e8e8; text-decoration: none;" href="display.php">Go To Table</a>
                </button>
            </div>





        </form>
    </div>
</body>

</html>