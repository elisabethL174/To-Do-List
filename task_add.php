<?php
// Task addition process
require 'db.php';

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = $_POST['due_date'];

    // Insert task into the database
    $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES ('$user_id', '$title', '$description', '$due_date')";

    if (mysqli_query($conn, $sql)) {
        header('Location: home_page.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
