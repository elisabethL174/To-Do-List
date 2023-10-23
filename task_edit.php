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

// Update task in the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = $_POST['due_date'];

    $update_sql = "UPDATE tasks SET title = '$title', description = '$description', due_date = '$due_date' WHERE id = '$task_id'";

    if (mysqli_query($conn, $update_sql)) {
        header('Location: home_page.php');
        exit();
    } else {
        echo "Error updating task: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
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

    body {
        background-image: url("img/home_page.png");
        background-blend-mode: darken;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .text-center {
        color: white;
        padding-top: 25px;
    }

    .form-text {
        color: white;
    }

    .custom-btn {
        width: 150px; /* Adjust the width to your preference */
    }

    .container {
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        height: calc(100vh - 56px); /* Assuming the navbar's height is 56px, adjust as needed */
    }

    .btn.btn-secondary {
        transition: 0.3s;
    }

    .btn.btn-secondary:hover {
        background-color: #3B4044;
        border-color: #3B4044;
        transition: 0.3s;
    }

    .btn.btn-primary {
        transition: 0.3s;
    }

    .btn.btn-primary:hover {
        background-color: #00029B;
        border-color: #00029B;
        transition: 0.3s;
    }

</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Task</title>
</head>
<body>
    <!-- navbar.php -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home_page.php">Task Manager</a>
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
    <!-- form Task Edit -->
    <div class="container col-6">
        <h2 class="text-center">Edit Task</h2>
    <form method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $task['title'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"><?= $task['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="<?= $task['due_date'] ?>" required>
        </div>
        <div class="row mt-6">
            <div class="col-md-6 text-left">
                <button type="submit" class="btn btn-primary custom-btn" style="margin-top: 20px;">Update Task</button>
            </div>
            <div class="col-md-6 text-right">
                <a href="home_page.php" class="btn btn-secondary custom-btn" style="margin-top: 20px;">Cancel</a>
            </div>
        </div>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
