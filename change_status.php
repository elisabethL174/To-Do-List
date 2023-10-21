<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = $_POST['task_id'];
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update status in the database
    $update_sql = "UPDATE tasks SET status = '$new_status' WHERE id = '$task_id'";

    if (mysqli_query($conn, $update_sql)) {
        header('Location: home_page.php');
        exit();
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
