<?php
$servername='localhost';
$username='root';
$password='';
$dbname = "servicelagbe";
$con = mysqli_connect($servername, $username, $password, "$dbname");
if(!$con)
{
    die('Failed');
}
?>