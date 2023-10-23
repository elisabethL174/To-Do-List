<?php
session_start();


require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: home_page.php');
        exit();
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-image: url("img/login.png");
        background-color: rgba(0, 0, 0, 0.5);
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

    .text-center {
        color: white;
    }

    .form-text {
        color: white;
    }

    .navbar-brand {
        font-weight: bold;
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

</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">To Do List</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="Register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    <div class="container" style="width: 35%;">
        <div class="row justify-content-center">
            <h2 class="text-center">Login</h2>
        </div>

            <form method="post" action="login_process.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control col-12" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control col-12" id="password" name="password" placeholder="Password" required>
                </div>
                <div id="loginHelp" class="form-text">Tidak punya akun? Mohon <a href="register.php">register</a> terlebih dahulu.</div>
            <br>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto">Login</button>
            </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
