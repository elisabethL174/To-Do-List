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

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .navbar-brand {
        font-weight: bold;
        color: white;
    }

    .text {
        color: white;
    }

    .btn.btn-primary {
        transition: 0.3s;
    }

    .btn.btn-primary:hover {
        background-color: #00029B;
        border-color: #00029B;
        transition: 0.3s;
    }

    .btn.btn-danger {
        transition: 0.3s;
    }

    .btn.btn-danger:hover {
        background-color: #990007;
        border-color: #990007;
        transition: 0.3s;
    }

    body {
        background-image: url("img/home_page.png");
        background-blend-mode: darken;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        height: calc(100vh - 56px); /* Assuming the navbar's height is 56px, adjust as needed */
    }

    .custom-btn {
        width: 150px; /* Adjust the width to your preference */
    }

</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home_page.php">To Do List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home_page.php">Lihat Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2 class="text">Delete Task</h2>
        <p class="text">Are you sure you want to delete the task: <?= $task['title'] ?>?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger custom-btn">Yes</button>
            <a href="home_page.php" class="btn btn-primary custom-btn">No</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
