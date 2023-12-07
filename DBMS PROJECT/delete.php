<?php
include 'connect.php';
if (isset($_GET['delete_id'])) {

    $productNo = $_GET['delete_id'];

    $sql = "delete from  root_user where productNo=$productNo";
    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:display.php');
    } else {
        die(mysqli_error($con));
    }
}
