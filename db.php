<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'uts_lab';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
