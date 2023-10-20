<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $repeat_password = $_POST["repeat_password"];

    // Ambil nilai maksimum dari kolom "user_code" dalam tabel users
    $idQuery = "SELECT MAX(SUBSTRING(user_code, 2)) AS max_code FROM users";
    $idResult = mysqli_query($conn, $idQuery);
    $idRow = mysqli_fetch_assoc($idResult);
    $maxCode = $idRow['max_code'];

    if ($maxCode === null) {
        // Tidak ada pengguna dalam basis data
        $newCode = "U0001";
    } else {
        // Menambah 1 ke kode maksimum yang ada
        $newCode = "U" . str_pad($maxCode + 1, 4, '0', STR_PAD_LEFT);
    }

    // Gunakan prepared statement untuk mendaftar dengan kode pengguna yang telah dihasilkan
    $stmt = $conn->prepare("INSERT INTO users (user_code, full_name, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $newCode, $full_name, $username, $password);

    // Eksekusi perintah SQL untuk mendaftar
    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!-- Form pendaftaran -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
    <label for="full_name">Nama Lengkap:</label>
    <input type="text" name="full_name" required>

    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="repeat_password">Ulangi Password:</label>
    <input type="password" name="repeat_password" id="repeat_password" required>

    <button type="submit">Daftar</button>
</form>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("repeat_password").value;

        if (password !== repeatPassword) {
            alert("Error: Passwords do not match");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
