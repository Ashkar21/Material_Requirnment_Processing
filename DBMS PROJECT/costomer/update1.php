<?php
$con=new mysqli("localhost","root","ashkar@21","material requirnment processing");

if(!$con){
    die(mysqli_error($con));
}

if (isset($_GET['updateid'])) {
    $SnNo = $_GET['updateid'];
    $query = "SELECT * FROM user WHERE SnNo = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $SnNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productNo = $row['productNo'];
        $date = $row['date'];
        $quantity = $row['quantity'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Requirement Processing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="update.css" rel="stylesheet" type="text/css":>
    
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


    <div class="typewriter" style="padding-bottom:50px;">
        <h1>UPDATE</h1>
    </div>
        <div class="container">
        <form method="post" action="">
            <input type="hidden" name="SnNo" value="<?php echo $SnNo; ?>">

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
                <label for="date">Date:</label>
                <input type="date" autocomplete="off" class="form-control" name="date" value="<?php echo $date; ?>">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" autocomplete="off" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
            </div>
            <button type="submit" name="Submit">Update</button>
            <div style="text-align: right;">
                <button style="position: relative; right: 0;" type="submit" >
                    <a style=" text-decoration: none; color:aliceblue;" href="history.php">Abort</a>
                </button>
            </div>
        </form>




<?php
    } else {
        echo "No data found for the provided ID.";
    }
}

if (isset($_POST['Submit'])) {
    $SnNo = $_POST['SnNo'];
    $productNo = $_POST['productNo'];
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE user SET productNo=?, date=?, quantity=? WHERE SnNo=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssi', $productNo, $date, $quantity, $SnNo);
    $result = $stmt->execute();

    if ($result) {
        echo "Update successful";
        header('location:history.php'); // Make sure the file name is correct
    } else {
        die(mysqli_error($con));
    }
}
?>
        </div>
</body>
</html>

