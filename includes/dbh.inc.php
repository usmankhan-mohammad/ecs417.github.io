<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "ec417";



$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn){
    die("Connection terminated: " . mysqli_connect_error());
}