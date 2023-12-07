<?php

$con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");

if (!$con) {
    die(mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="history_user.css">
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
    <nav class="navbar">
        <ul>
            <li><a href="http://localhost/DBMS%20PROJECT/display.php">Home</a></li>
            <li><a href="http://localhost/DBMS%20PROJECT/Root.php">Add New Material</a></li>
            <li><a href="http://localhost/DBMS%20PROJECT/history_user.php">Orders</a></li>
            <li><a href="http://localhost/DBMS%20PROJECT/costomer/index.php">User View</a></li>
        </ul>
    </nav>
    <div class="typewriter" style="padding-bottom:50px;">
        <h1>ORDERS</h1>
    </div>
    <div class="container">



        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sn No:</th>
                    <th scope="col">Item No:</th>
                    <th scope="col">Date</th>
                    <th scope="col">Buy Quantity</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql = "SELECT * FROM user";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) {
                        $SnNo = $row["SnNo"];
                        $productNo = $row['productNo'];
                        $date = $row['date'];
                        $quantity = $row['quantity'];
                        echo '<tr>
                                <th scope="row">' . $SnNo . '</th>
                                <th scope="row">' . $productNo . '</th>
                                <td>' . $date . '</td>
                                <td>' . $quantity . '</td>
                                
                            </tr>';
                    }
                }
                ?>
            </tbody>
        </table>


    </div>




</body>

</html>