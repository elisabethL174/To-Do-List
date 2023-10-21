<?php
// Login process
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Retrieve user from the database
    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header('Location: home_page.php');
            exit();
        } else {
            echo 'Invalid password';
        }
    } else {
        echo 'User not found';
    }

    mysqli_close($conn);
}
