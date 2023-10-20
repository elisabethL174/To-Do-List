<?php
include "db.php";
session_start();
if (!isset($_SESSION["user_code"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_code = $_SESSION["user_code"];
    $task_id = $_GET["id"];

    // Gunakan prepared statement untuk menghapus tugas
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_code = ? AND user_code = ?");
    $stmt->bind_param("ii", $task_code, $user_code);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

