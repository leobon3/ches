<?php
include_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using MD5 to match the stored passwords in the database
    $hashedPassword = md5($password);

    // SQL query to check if the provided username and hashed password match a record in the database
    $sql = "SELECT * FROM account WHERE username='$username' AND password='$hashedPassword'";
    $result = mysqli_query($conn, $sql);

    // Check if there is a match
    if (mysqli_num_rows($result) == 1) {
        // Login successful, start the session and redirect to admin.php
        session_start();
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit;
    } else {
        // Login failed, redirect back to index.php with an error message
        header("Location: index.php?login_error=1");
        exit;
    }
}
?>
