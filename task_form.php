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
    <title>Document</title>
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
                    <a class="nav-link" href="home_page.php">Lihat Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Form for adding a new task -->
    <div class="container col-6">
        <h2 class="text-center">Add Task</h2>
    <form method="post" action="task_add.php">
    <div class="form-group">
        <label for="title" class="form-text">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description" class="form-text">Description:</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="due_date" class="form-text">Due Date:</label>
        <input type="date" class="form-control" id="due_date" name="due_date" required>
    </div>
    <div class="row mt-6">
            <div class="col-md-6 text-left">
                <button type="submit" class="btn btn-primary custom-btn" style="margin-top: 20px;">Add Task</button>
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