<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Requirement Processing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

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

</style> 


</head>

<body>
    <h1>Admin User Table</h1>


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
        


        <table style="color:white; font-size:25px; margin-top: 90px;" class="table">
            <thead>
                <tr>
                    <th scope="col">Item No:</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">MRP</th>
                    <th scope="col">Available Quantity</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

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
                                <td>
                                    <button class="btn btn-primary"><a href="update.php? update_id=' . $productNo . '" class="text-light">Update</a></button>
                                    <button class="btn btn-danger"><a href="delete.php? delete_id=' . $productNo . '"  class="text-light">Delete</a></button>
                                </td>
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>


    </div>
</body>

</html>