<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "Anh_course";
// Create connection
$conn = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($conn, 'UTF8');
define('BASE_URL', 'http://localhost:3000/');


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
