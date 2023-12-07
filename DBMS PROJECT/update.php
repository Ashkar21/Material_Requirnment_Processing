<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Material Requirement Processing</title>

    <style>
        body {
            background-color: black;
            color: white;
        }

        form {
            padding: 20px;
            border: 1px solid white;
            border-radius: 5px;
            background-color: white;
            color: black;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        button {
            margin-top: 10px;
        }
    </style>


</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                include 'connect.php';

                if (isset($_GET['update_id'])) {
                    $productNo = $_GET['update_id'];
                    $query = "SELECT * FROM root_user WHERE productNo = '$productNo'";
                    $result = mysqli_query($con, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $name = $row['name'];
                        $date = $row['date'];
                        $mrp = $row['mrp'];
                        $quantity = $row['quantity'];
                ?>

                        <form method="post" action="">
                            <h2 style="text-align:center;color:red;padding-bottom:20px;">Admin Update Values</h2>


                            <input type="hidden" name="productNo" value="<?php echo $productNo; ?>">
                            <div class="form-group">
                                <label for="name">Item Name:</label>
                                <input type="text" autocomplete="off" class="form-control" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" autocomplete="off" class="form-control" name="date" value="<?php echo $date; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mrp">MRP:</label>
                                <input type="text" autocomplete="off" class="form-control" name="mrp" value="<?php echo $mrp; ?>">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="text" autocomplete="off" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="Submit">Update</button>
                            <div style="text-align: right;">
                                <button style="position: relative; right: 0;" type="submit" class="btn btn-primary">
                                    <a style="color: #e8e8e8; text-decoration: none;" href="display.php">Abort</a>
                                </button>
                            </div>
                        </form>
                <?php
                    } else {
                        echo "No data found for the provided ID.";
                    }
                }

                if (isset($_POST['Submit'])) {
                    $productNo = $_POST['productNo'];
                    $name = $_POST['name'];
                    $date = $_POST['date'];
                    $mrp = $_POST['mrp'];
                    $quantity = $_POST['quantity'];

                    $sql = "UPDATE root_user SET name='$name', date='$date', mrp='$mrp', quantity='$quantity' WHERE productNo='$productNo'";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        echo "Update successful";
                        header('location:display.php');
                    } else {
                        die(mysqli_error($con));
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>