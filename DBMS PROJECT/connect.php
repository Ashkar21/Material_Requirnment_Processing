<?php

$con = new mysqli("localhost", "root", "ashkar@21", "material requirnment processing");

if (!$con) {
    die(mysqli_error($con));
}
