<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Gunakan prepared statement untuk memeriksa login
    $stmt = $conn->prepare("SELECT user_code, full_name, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_code"] = $row["user_code"];
            $_SESSION["full_name"] = $row["full_name"];
            header("Location: dashboard.php");
            exit();
        } else {
            $login_error = "Username atau Password salah.";
        }
        
    } else {
        $login_error = "Username atau Password salah.";
    }
}
?>

<!-- Form login -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<?php if (isset($login_error)) echo "<p>$login_error</p>"; ?>
