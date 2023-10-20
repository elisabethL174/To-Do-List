<?php
// Include the database connection file
include("db.php"); // Make sure to replace "db_connection.php" with the actual filename or path

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $taskCode = $_POST["task_code"];
    $userCode = $_POST["user_code"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $dueDate = $_POST["due_date"];
    $isDone = isset($_POST["is_done"]) ? 1 : 0; // Checkbox handling

    // Update the task in the database
    $sql = "UPDATE `tasks` SET 
            `title` = '$title',
            `description` = '$description',
            `due_date` = '$dueDate',
            `is_done` = $isDone
            WHERE `task_code` = '$taskCode' AND `user_code` = '$userCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

// Retrieve the task details for editing
$taskCodeToEdit = isset($_GET["task_code"]) ? $_GET["task_code"] : '';
$userCodeToEdit = isset($_GET["user_code"]) ? $_GET["user_code"] : '';

// Fetch task details from the database
$sql = "SELECT * FROM `tasks` WHERE `task_code` = '$taskCodeToEdit' AND `user_code` = '$userCodeToEdit'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Rest of your code for displaying the form with the current task details
} else {
    echo "Task not found";
}
    // Display the form with the current task details
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Task</title>
    </head>

    <body>
        <h2>Edit Task</h2>
        <form method="post" action="">
            <input type="hidden" name="task_code" value="<?php echo $row['task_code']; ?>">
            <input type="hidden" name="user_code" value="<?php echo $row['user_code']; ?>">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
            <label>Description:</label>
            <textarea name="description"><?php echo $row['description']; ?></textarea><br>
            <label>Due Date:</label>
            <input type="date" name="due_date" value="<?php echo $row['due_date']; ?>" required><br>
            <label>Is Done:</label>
            <input type="checkbox" name="is_done" <?php echo $row['is_done'] ? 'checked' : ''; ?>><br>
            <input type="submit" value="Update Task">
        </form>
    </body>

    </html>

