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
        <a class="navbar-brand" href="home_page.php">Task Manager</a>
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

    <div class="container mt-4">
        <h3>Task List</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['due_date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
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
                    echo '<a href="task_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm flex-fill mx-1">Edit</a>';
                    echo '<a href="task_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm flex-fill mx-1">Delete</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
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
