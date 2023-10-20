<?php
include 'db.php';
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION["user_code"])) {
    header("Location: login.php");
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user code from the session
    $user_code = $_SESSION["user_code"];

    // Retrieve the maximum task code
    $idQuery = "SELECT MAX(SUBSTRING(task_code, 2)) AS max_code FROM tasks";
    $idResult = mysqli_query($conn, $idQuery);
    $idRow = mysqli_fetch_assoc($idResult);
    $maxCode = $idRow['max_code'];

    // Generate a new task code
    if ($maxCode === null) {
        $newCode = "T0001";
    } else {
        $newCode = "T" . str_pad($maxCode + 1, 4, '0', STR_PAD_LEFT);
    }

    // Retrieve other form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $due_date = $_POST["due_date"];

    // Use a prepared statement to insert a new task
    $stmt = $conn->prepare("INSERT INTO tasks (task_code, user_code, title, description, due_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $newCode, $user_code, $title, $description, $due_date);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect to the dashboard or another page after successful insertion
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!-- Form tambah task -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="title">Judul Task:</label>
    <input type="text" name="title" required>

    <label for="description">Deskripsi:</label>
    <textarea name="description"></textarea>

    <label for="due_date">Tanggal Jatuh Tempo:</label>
    <input type="date" name="due_date" required>

    <button type="submit">Tambah Task</button>
</form>
