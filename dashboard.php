<?php
include 'db.php';
session_start();
if (!isset($_SESSION["user_code"])) {
    header("Location: login.php");
    exit();
}

$user_code = $_SESSION["user_code"];
$full_name = $_SESSION["full_name"];

// Buat pernyataan SQL yang aman dengan prepared statement
$sql = "SELECT task_code, title, description, due_date, is_done FROM tasks WHERE user_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_code);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Tampilkan pesan selamat datang -->
<h2>Selamat datang, <?php echo $full_name; ?></h2>

<!-- Tampilkan daftar tugas -->
<ul>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <li>
            <?php echo htmlspecialchars($row["title"]); ?>
            <?php if ($row["is_done"] == 0) { ?>
                <a href="mark_as_done.php?id=<?php echo $row["task_code"]; ?>">Tandai Selesai</a>
            <?php } ?>
            <a href="edit_task.php?id=<?php echo $row["task_code"]; ?>">Edit</a>
            <a href="delete_task.php?id=<?php echo $row["task_code"]; ?>">Hapus</a>
        </li>
    <?php } ?>
</ul>

<!-- Tambahkan tombol "Tambah Task" -->
<a href="add_task.php">Tambah Task</a>

<!-- Tambahkan dropdown untuk memfilter tugas -->
<select>
    <option value="not_started">Not yet started</option>
    <option value="in_progress">In progress</option>
    <option value="waiting_on">Waiting on</option>
    <!-- Tambahkan opsi lain sesuai kebutuhan -->
</select>
