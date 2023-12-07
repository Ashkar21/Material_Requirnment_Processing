<?php



$con=new mysqli("localhost","root","ashkar@21","material requirnment processing");

if(!$con){
    die(mysqli_error($con));
}


if(isset($_GET['deleteid'])){

    $SnNo=$_GET['deleteid'];

    $sql="delete from  user where SnNo=$SnNo";
    $result=mysqli_query($con,$sql);

    if($result){
        header('location:history.php');
    }else{
        die(mysqli_error($con));
    }
}
?>