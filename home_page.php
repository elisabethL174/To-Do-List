<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'db.php';

// Pagination setup
$tasksPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $tasksPerPage;

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = '$user_id' LIMIT $offset, $tasksPerPage";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<style>
    .navbar-brand {
        font-weight: bold;
        color: white;
    }

    .button-container {
        display: flex;
        justify-content: space-around;
    }

    body{
        background-image: url("img/home_page.png");
        background-color: rgba(0, 0, 0, 0.5);
        background-blend-mode: darken;
        background-size: cover; /* Scale the background image to cover the entire container */
        background-repeat: no-repeat; /* Prevent image repetition */
        background-attachment: fixed; /* Fixed background image */
    }

    .text {
        color: white;
    }

    .container.header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .add-task-button {
        display: flex;
        font-size: 1vw;
        position: relative; /* Set the parent container to a relative position */
        text-decoration: none;
        margin-bottom: 0;
    }

    .add-task {
        padding-top: 1vw;
        padding-bottom: 1vw;
        padding-left: 1vw;
        padding-right: 1vw;
        color: white;
        font-size: 1vw;
        border-radius: 0.5vw 0 0 0.5vw;
        background: linear-gradient(to left, #0052AA, #6095FF); /* Gradient background for the overlay */
        text-align: center;
        z-index: 2;
        position: relative; /* Add relative positioning for z-index */
        text-decoration: none; /* Remove underline on the main element */
        margin-bottom: 0;
    }

    .add-task::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, #0052AA, #6095FF); /* Gradient background for the overlay */
        opacity: 0;
        border-radius: 0.5vw 0 0 0.5vw;
        z-index: -1;
        transition: opacity 0.3s; /* Transition opacity for fade effect */
    }

    .add-task-button:hover .add-task::before {
        opacity: 1; /* Make the overlay visible on hover */
        transition: opacity 0.3s; /* Apply transition to opacity for the fade effect */
    }

    .add-task-plus {
        margin-left: 0.2vw;
        padding-top: 1vw;
        padding-bottom: 1vw;
        padding-left: 1.5vw;
        padding-right: 1.5vw;
        color: white;
        font-size: 1vw;
        border-radius: 0 0.5vw 0.5vw 0;
        background-color: #0052AA;
        text-align: center;
        z-index: 2;
        font-weight: bold;
        transition: 0.3s; /* Apply the transition to the background property */
        text-decoration: none; /* Remove underline on the main element */
        margin-bottom: 0;
    }

    .add-task-button:hover .add-task-plus {
        background-color: #6095FF;
        transition: 0.3s; /* Apply the transition to the background property */
    }

    .add-task-button:hover {
        text-decoration: none;
    }

    .odd-row {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .even-row {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .table-header {
        background: linear-gradient(to right, #0052AA, #6095FF); /* White background for the table header row */
    }

    .text-header {
        color: white;
    }

    .table-header th {
        border-top: 0px !important;
        border-bottom: 0px !important;
    }

    .table-header th:first-child {
        border-radius: 5px 0 0 0;
    }

    .table-header th:last-child {
        border-radius: 0 10px 0 0;
    }

    .text-top {
        color: white;
        text-shadow: 0px 0px 50px rgba(0, 0, 0, 0.7); /* Text shadow */
    }

    .btn.btn-warning {
        transition: 0.3s;
    }

    .btn.btn-warning:hover {
        background-color: #9E8300;
        border-color: #9E8300;
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

    .btn.btn-danger {
        transition: 0.3s;
    }

    .btn.btn-danger:hover {
        background-color: #990007;
        border-color: #990007;
        transition: 0.3s;
    }

</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- navbar.php -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home_page.php">To Do List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="task_form.php">Tambah Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container header mt-4">
        <h3 class="text-top">Task List</h3>
        <a class="add-task-button" href="task_form.php">
            <p class="add-task">Add New Task</p>
            <p class="add-task-plus">+</p>
        </a>
    </div>

        <div class="container mt-2">
        <table class="table">
            <thead class="table-header">
                <tr>
                    <th class="text-header">Title</th>
                    <th class="text-header">Description</th>
                    <th class="text-header">Due Date</th>
                    <th class="text-header">Status</th>
                    <th class="text-header">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Define a variable to toggle background colors
                $evenRow = true;

                while ($row = mysqli_fetch_assoc($result)) {
                    // Use the $evenRow variable to toggle between background colors
                    $rowClass = $evenRow ? 'even-row' : 'odd-row';
                    echo '<tr class="' . $rowClass . '">';
                    echo '<td class="text">' . $row['title'] . '</td>';
                    echo '<td class="text">' . $row['description'] . '</td>';
                    echo '<td class="text">' . $row['due_date'] . '</td>';
                    echo '<td class="text">' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<form action="change_status.php" method="post" style="display:inline;">';
                    echo '<input type="hidden" name="task_id" value="' . $row['id'] . '">';
                    echo '<div class="form-group">';
                    echo '<select class="form-control" name="status">';
                    $statuses = ['Not Yet Started', 'In Progress', 'Completed'];
                    foreach ($statuses as $status) {
                        echo '<option value="' . $status . '" ' . ($row['status'] === $status ? 'selected' : '') . '>' . $status . '</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="button-container">';
                    echo '<button type="submit" class="btn btn-primary btn-sm flex-fill mx-1">Update Status</button>';
                    echo '</form>';
                    echo '<a href="task_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm flex-fill mx-1"><img src="img/edit.png" style="width: 20px; height: 20px;" /></a>';
                    echo '<a href="task_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm flex-fill mx-1"><img src="img/delete.png" style="width: 20px; height: 20px;" /></a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';

                    // Toggle the $evenRow variable for the next row
                    $evenRow = !$evenRow;
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <?php
        $paginationSql = "SELECT COUNT(*) as total FROM tasks WHERE user_id = '$user_id'";
        $paginationResult = mysqli_query($conn, $paginationSql);
        $totalTasks = mysqli_fetch_assoc($paginationResult)['total'];
        $totalPages = ceil($totalTasks / $tasksPerPage);
        ?>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
