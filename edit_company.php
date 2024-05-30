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

// Handle form submission for updating company details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
    // Update the company name in the database
    $newCompanyName = $_POST['new_company_name'];
    $updateQuery = "UPDATE company SET companyName = '$newCompanyName' WHERE id = $companyId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Company name updated successfully, redirect to the company list page
        header("Location: admin_building.php");
        exit;
    } else {
        // Error occurred while updating, handle appropriately (display error message, redirect, etc.)
        echo "Error updating company name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company - <?php echo htmlspecialchars($companyName); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Company - <?php echo htmlspecialchars($companyName); ?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?name=<?php echo urlencode($companyName); ?>" method="post">
            <div class="form-group">
                <label for="newCompanyName">New Company Name:</label>
                <input type="text" class="form-control" id="newCompanyName" name="new_company_name" value="<?php echo htmlspecialchars($companyName); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>


