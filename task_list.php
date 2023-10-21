<!-- Display the list of tasks -->
<div class="container mt-4">
    <h3>Task List</h3>
    <ul class="list-group">
        <?php
        require 'db.php';

        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM tasks WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="list-group-item">';
            echo '<strong>Title: </strong>' . $row['title'] . '<br>';
            echo '<p><strong>Description: </strong>' . $row['description'] . '</p>';
            echo '<p><strong>Due Date: </strong>' . $row['due_date'] . '</p>';
            echo '<p><strong>Status: </strong>' . $row['status'] . '</p>';

            // Dropdown menu for changing status
            echo '<form action="change_status.php" method="post">';
            echo '<input type="hidden" name="task_id" value="' . $row['id'] . '">';
            echo '<div class="form-group">';
            echo '<label for="status">Change Status:</label>';
            echo '<select class="form-control" name="status">';
            echo '<option value="Not Yet Started" ' . ($row['status'] === 'Not Yet Started' ? 'selected' : '') . '>Not Yet Started</option>';
            echo '<option value="In Progress" ' . ($row['status'] === 'In Progress' ? 'selected' : '') . '>In Progress</option>';
            echo '<option value="Completed" ' . ($row['status'] === 'Completed' ? 'selected' : '') . '>Completed</option>';
            echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary btn-sm">Update Status</button>';
            echo '</form>';

            echo '<a href="task_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>';
            echo '<a href="task_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>';
            echo '</li>';
        }
        ?>
    </ul>
</div>
