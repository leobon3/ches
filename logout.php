<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If the user is logged in, destroy the session and redirect to the login page
    session_destroy();
    header("Location: index.php");
    exit;
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}
?>
