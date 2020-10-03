<?php
error_reporting(0);

$localhost = "localhost";
$username = "root";
$password = "";
$database = "cms1";

$connection = mysqli_connect($localhost,$username,$password,$database);

if(!$connection)
{
    echo "<div class='alert alert-danger h3 text-center'>Database not connected</div>";
}