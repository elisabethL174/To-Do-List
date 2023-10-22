<?php
require 'db.php';

// Check if task id is provided
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$task_id = $_GET['id'];

// Fetch task details from the database
$sql = "SELECT * FROM tasks WHERE id = '$task_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$task = mysqli_fetch_assoc($result);

// Delete task from the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete_sql = "DELETE FROM tasks WHERE id = '$task_id'";

    if (mysqli_query($conn, $delete_sql)) {
        header('Location: home_page.php');
        exit();
    } else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Delete Task</title>
</head>
<body>
<style>
    .navbar-brand {
        font-weight: bold;
        color: white;
    }

    body {
        background-color: black !important; /* Set the background color to black */
    }

    .text {
        color: white;
    }

</style>
    <div class="container mt-5">
        <h2 class="text">Delete Task</h2>
        <p class="text">Are you sure you want to delete the task: <?= $task['title'] ?>?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="home_page.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
