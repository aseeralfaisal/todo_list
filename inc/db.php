<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "2021->2022";
$dbName = "todos";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("DB connection faild".mysqli_connect_error());
}