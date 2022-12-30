<?php
$server = "localhost";
$username = "root";
$password = "test123";
$database = "servicelagbe";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

?>