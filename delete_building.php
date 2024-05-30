<?php
session_start(); // Start the session

include_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['username'])) {
        // Check if building ID is provided
        if (isset($_POST['building_id'])) {
            $building_id = $_POST['building_id'];

            // Prepare the SQL statement to delete the building
            $deleteQuery = "DELETE FROM buildings WHERE id = ?";
            $stmt = mysqli_prepare($conn, $deleteQuery);

            // Bind the building ID parameter to the prepared statement
            mysqli_stmt_bind_param($stmt, "i", $building_id);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Building deleted successfully
                header("Location: admin_building.php");
                exit;
            } else {
                // Error occurred while deleting the building
                $_SESSION['error'] = "An error occurred while deleting the building.";
                header("Location: error.php");
                exit;
            }
        } else {
            // Building ID not provided
            $_SESSION['error'] = "Building ID not provided.";
            
            echo "Building ID not provided.";
            exit;
        }
    } else {
        // User is not logged in
        $_SESSION['error'] = "";
        echo "You are not authorized to perform this action.";
        exit;
    }
} else {
    // Invalid request method
    $_SESSION['error'] = "Invalid request method.";
    header("Location: error.php");
    exit;
}
?>
