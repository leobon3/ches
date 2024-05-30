<?php
// Include database connection
include_once 'db_config.php';

session_start();

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit;
}

// Check if company name is provided in the URL
if (!isset($_GET['name'])) {
    header("Location: admin_building.php");
    exit;
}

$companyName = $_GET['name'];

// Fetch company data from the database based on the company name
$query = "SELECT * FROM company WHERE companyName = '$companyName'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // If company not found, redirect to company list
    header("Location: admin_building.php");
    exit;
}

$row = mysqli_fetch_assoc($result);
$companyId = $row['id'];

// Handle form submission for deleting company
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
    // Delete the company from the database
    $deleteQuery = "DELETE FROM company WHERE id = $companyId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Company deleted successfully, redirect to the company list page
        header("Location: admin_building.php");
        exit;
    } else {
        // Error occurred while deleting, handle appropriately (display error message, redirect, etc.)
        echo "Error deleting company.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Company - <?php echo htmlspecialchars($companyName); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Delete Company - <?php echo htmlspecialchars($companyName); ?></h1>
        <p>Are you sure you want to delete this company?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?name=<?php echo urlencode($companyName); ?>" method="post">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="admin_building.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
