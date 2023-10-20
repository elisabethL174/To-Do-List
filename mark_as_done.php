<?php
include "db.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = $_SESSION["user_id"];
    $task_id = $_GET["id"];

    // Periksa apakah tugas milik pengguna
    $sql_check_task = "SELECT id_task FROM tasks WHERE id_task = $task_id AND id_user = $user_id";
    $result_check_task = $conn->query($sql_check_task);

    if ($result_check_task->num_rows == 1) {
        // Tandai tugas sebagai selesai (is_done = 1)
        $sql_mark_done = "UPDATE tasks SET is_done = 1 WHERE id_task = $task_id";
        
        if ($conn->query($sql_mark_done) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $sql_mark_done . "<br>" . $conn->error;
        }
    } else {
        echo "Tugas tidak ditemukan atau bukan milik Anda.";
    }
}
?>
